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
    <div class="row mb-5">
        <div class="col-md-12">
            <a href="{{route('page.events')}}" class="btn btn-primary">Back</a>
        </div>
    </div>
    <div class="card card-default">
        <div class="card-header agap-primary-color">Event Info</div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-12">
                    <img src="{{asset('storage/'.$event->header_image)}}" alt="" class="img img-fluid">
                </div>
                <div class="col-md-12 my-3">
                    <h3>{{$event->title}}</h3>
                    <p>{{$event->description}}</p>
                </div>
                @if(!$registered)
                <div class="col-md-12">
                    <h3>Register</h3>

                    @foreach($fees as $fee)
                    <p>{{$fee->description}} - {{$fee->fee}} <a href="{{route('event.register', ['id'=>$event->id, 'fee'=>$fee->id])}}" class="btn btn-success">Register</a></p>
                    @endforeach
                </div>
            </div>
            @else
            <div class="col-md-12">
                <h3>Registered ({{$registered->status}})</h3>
                <p>{{$registered->fee->description}} {{$registered->fee->fee}}</p>
            </div>
        </div>
        @if($registered->status == "Pending" && $registered->supporting_doc == null)
        <form action="{{route('event.pay', ['id'=>$registered->event_id,'fee'=>$registered->fee_id])}}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row align-items-center">
                <div class="col-md-6">
                    <div class="custom-file">
                        <input type="file" class="custom-file-input" id="submit-docs" name="supporting_docs">
                        <label class="custom-file-label" for="submit-docs">Upload Deposit Slip</label>
                    </div>
                    <span class="small">Please upload the image of your deposit slip for us to verify your payment</span>
                    <button href="" class="btn btn-primary btn-block mt-3 disabled" id="submit-button">
                        Upload
                    </button>
                </div>
                <div class="col-md-6">
                    <div class="col-md-12">
                        <img src="" alt="" id="docs-preview" class="img img-fluid">
                    </div>
                </div>
            </div>
        </form>
        @else
        <div class="row">
            <div class="col-md-12">
            <h3>Payment Proof</h3>
            </div>
            <div class="col-md-6 offset-md-3">
                
                <img src="{{asset('storage/'.$registered->supporting_doc)}}" alt="" class="img img-fluid">
            </div>
        </div>
        @endif
        @endif
    </div>
</div>



</div>
@endsection

@section('scripts')

<script>
    window.onload = function() {
        var docs = $('#submit-docs');
        docs.on('change', function(e) {
            $('#docs-preview').attr('src', URL.createObjectURL(this.files[0]));
            $('[for=submit-docs]').text(this.files[0].name);
            $('#submit-button').removeClass('disabled');
        });
    }
</script>

@endsection