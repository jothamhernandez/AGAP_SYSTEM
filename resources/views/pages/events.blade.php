@extends('layouts.app')

@section('content')
    

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                @if (Auth::user()->email_verified_at == null)
                <div class="card">
                    <div class="card-header bg-danger text-white">Verification Needed</div>
                    <div class="card-body">
                        You need to verify your email first before you can do anything
                    </div>
                </div>
                @else
                <div class="card card-default my-3">
                    <div class="card-header agap-primary-color">
                        My Events
                    </div>
                    <div class="card-body">
                    <div class="row">
                        @if(count($myEvents) == 0)
                        <div class="col-md-12">
                            <div class="jumbotron text-center">
                                <h1>No Registered Event</h1>
                            </div>
                        </div>
                        @endif
                        @foreach($myEvents as $event)
                        <div class="col-md-3">
                            <div class="card card-default">
                                <div class="card-header agap-primary-color">
                                    {{$event->title}} ({{$event->fee->status}})
                                </div>
                                <div class="card-body">
                                    @if($event->header_image != null)
                                    <figure>
                                        <img src="{{route('image.viewer',['event',encrypt($event->id)])}}" alt="" class="img img-thumbail img-fluid"> 
                                    </figure>
                                    @endif
                                    <p>{{date('F d, Y', strtotime($event->start))}} - {{date('F d, Y', strtotime($event->end))}}</p>
                                </div>
                                <div class="card-footer">
                                    @if(Auth::user()->roles->contains('role','Admin') || Auth::user()->roles->contains('role','Super Admin'))
                                    <button class="btn btn-info">
                                        Edit
                                    </button>
                                    <button class="btn btn-danger">
                                        Delete
                                    </button>
                                    @endif
                                    @if(Auth::user()->roles->contains('role','Member'))
                                    <a class="btn btn-primary float-right" href="{{route('event.view', $event->id)}}">
                                        View
                                    </a>
                                    @endif
                                </div>
                            </div>
                        </div>
                        @endforeach
                        </div>
                    </div>
                </div>


                <div class="card card-default">
                    <div class="card-header agap-primary-color">
                        Events
                    </div>
                    <div class="card-body">
                        @if(Auth::user()->roles->contains('role','Admin') || Auth::user()->roles->contains('role','Super Admin'))
                        <div class="row mb-4">
                            <div class="col-md-12">
                                <button class="btn btn-primary" data-toggle="modal" data-target="#addEventModal">Add Event  <i class="fa fa-plus"></i></button>
                            </div>
                        </div>
                        @endif

                        @if(count($events) == 0)
                        <div class="jumbotron text-center">
                            <h1>No Available Event</h1>
                        </div>
                        @endif

                        <div class="row">
                        @foreach($events as $event)
                        <div class="col-md-3">
                            <div class="card card-default">
                                <div class="card-header agap-primary-color">
                                    {{$event->title}}
                                </div>
                                <div class="card-body">
                                    @if($event->header_image != null)
                                    <figure>
                                        <img src="{{route('image.viewer',['event',encrypt($event->id)])}}" alt="" class="img img-thumbail img-fluid"> 
                                    </figure>
                                    @endif
                                    <p>{{date('F d, Y', strtotime($event->start))}} - {{date('F d, Y', strtotime($event->end))}}</p>
                                </div>
                                <div class="card-footer">
                                    @if(Auth::user()->roles->contains('role','Admin') || Auth::user()->roles->contains('role','Super Admin'))
                                    <button class="btn btn-info">
                                        Edit
                                    </button>
                                    <button class="btn btn-danger">
                                        Delete
                                    </button>
                                    @endif
                                    @if(Auth::user()->roles->contains('role','Member'))
                                    <a class="btn btn-primary float-right" href="{{route('event.view', $event->id)}}">
                                        View
                                    </a>
                                    @endif
                                </div>
                            </div>
                        </div>
                        @endforeach
                        </div>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>

    <div class="modal fade" id="addEventModal" tabindex="-1" role="dialog" aria-labelledby="addEventModalTitle" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header agap-primary-color">
                <h5 class="modal-title" id="addEventModalTitle">Modal title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{route('page.add-event')}}" method="POST" id="eventForm" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group row">
                        <div class="col-md-3 col-form-label text-right">
                            <label for="">Event Title</label>
                        </div>
                        <div class="col-md-9">
                            <input type="text" class="form-control" name="title">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-3 col-form-label text-right">
                            <label for="">Event Title</label>
                        </div>
                        <div class="col-md-9 input-group">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="inputGroupFile02" name="header_image">
                                <label class="custom-file-label" for="inputGroupFile02">Choose file</label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-3 col-form-label text-right">
                            <label for="">Description</label>
                        </div>
                        <div class="col-md-9">
                            <textarea name="description" style="resize: none;" id="" cols="30" rows="10" class="form-control"></textarea>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-3 col-form-label text-right">
                            <label for="">Event Start</label>
                        </div>
                        <div class="col-md-9">
                            <input type="date" class="form-control" name="start">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-3 col-form-label text-right">
                            <label for="">Event End</label>
                        </div>
                        <div class="col-md-9">
                            <input type="date" class="form-control" name="end">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-3 col-form-label text-right">
                            <label for="">Event Regular Fee</label>
                        </div>
                        <div class="col-md-9">
                            <input type="text" class="form-control" name="fee">
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" onclick="eventForm.submit()">Save</button>
            </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
<script type="text/javascript">
    @if(session('success'))
        $.notify("{{session('succes')}}");
    @endif
    @if(session('error'))
        $.notify("session('error')");
    @endif
    
    (function(doc){
        console.log(doc);
        register = function(e){
            
        }
    })(window);
    
</script>
@endsection