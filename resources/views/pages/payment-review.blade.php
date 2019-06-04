@extends('layouts.app')

@section('content')
<div class="container">
    @if(session('message'))
    <div class="row">
        <div class="col-md-12">
            <div class="alert alert-{{session('class')}}" role="alert">
                {{session('message')}}
            </div>
        </div>
    </div>
    @endif
    <div class="row">
        <div class="col-md-12">
        <a href="{{route('page.reports')}}" class="btn btn-primary btn-sm">Back</a>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <h1>Payment Review: {{$event->title}}</h1>
        </div>
        <div class="col-md-12">
            <table class="table table-striped table-fluid table-sm">
                <thead>
                    
                    <tr>
                        <td>Member</td>
                        <!-- <td>Sector</td> -->
                        <td>Agency</td>
                        <td>Fee</td>
                        <td>Status</td>
                        <td>Action</td>
                    </tr>
                    
                </thead>
                <tbody>
                @foreach($event->registered as $registered)
                    <tr>
                        <td style="vertical-align: middle;">{{$registered->user->info->fullname()}}</td>
                        <!-- <td>{{$registered->user->info->agency->sector}}</td> -->
                        <td style="vertical-align: middle;">{{$registered->user->info->agency->name}}</td>
                        <td style="vertical-align: middle;">Php @convert($registered->fee->fee)</td>
                        <td style="vertical-align: middle;" class="text-center">
                            @if($registered->supporting_doc != null)
                            <a class="btn btn-primary btn-sm btn-block" href="{{ route('image.viewer',['slip', encrypt($registered->id)]) }}" target="__blank">
                                View Slip
                            </a>
                            @endif
                            @if($registered->status != "Paid")
                            <select name="" id="" class="form-control" data-status="{{$registered->id}}">
                                @foreach($registered->getEnumValues()['status'] as $val)
                                <option value="{{$val}}" @if($val == $registered->status) selected  @endif>{{$val}}</option>
                                @endforeach
                            </select>
                            @else
                            <div class="badge badge-success badge-sm">{{$registered->status}}</div>
                            @endif
                        </td>
                        <td style="vertical-align: middle;">
                            @if($registered->status != "Paid")
                            <form action="{{route('payment.paid',['registered_id'=>$registered->id])}}" method="POST" id="registered-{{$registered->id}}">
                            @csrf
                            </form>
                            <button class="btn btn-success btn-sm btn-block" data-toggle="confirmation" data-title="Save Status Change" data-focus="{{$registered->id}}">Save</button>
                            @endif
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection

@section('scripts')
<script>
    window.onload = function(){
        $('[data-status]').on('change', function(e){
            var option = this;
            if($(`#changer-${$(this).data('status')}`).length < 1){
                $(`#registered-${$(this).data('status')}`).append($(`<input type="hidden" id="changer-${$(this).data('status')}" name="status" value="${$(this).val()}"/>`))
            } else {
                $(`#changer-${$(this).data('status')}`).val($(this).val());
            }
        });

        $('[data-toggle=confirmation]').confirmation({
            rootSelector: '[data-toggle=confirmation]',
            // other options
            onConfirm: function(e){
                var form = $(`#registered-${$(this).data('focus')}`);
                form.submit();
            }
        });

    }
</script>
@endsection