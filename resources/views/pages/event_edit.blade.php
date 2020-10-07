@extends('layouts.app')


@section('content')

<div class="container">
    @if(session('message'))
    <div class="row">
        <div class="col-md-12">
            <div class="alert alert-{{session('class')}} agap-primary-color" role="alert">
                {{session('message')}}
            </div>
        </div>
    </div>
    @endif
    <div class="row">
        <div class="col-md-12">
            <div class="card card-default">
                <div class="card-header agap-primary-color">Edit Event</div>
                <div class="card-body">
                    <form action="{{route('event.update',['id'=>encrypt($event->id)])}}" method="POST" id="eventForm" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group row">
                            <div class="col-md-3 col-form-label text-right">
                                <label for="">Event Title</label>
                            </div>
                            <div class="col-md-9">
                                <input type="text" class="form-control" name="title" value="{{$event->title}}">
                            </div>
                        </div>
                        {{-- <div class="form-group row">
                            <div class="col-md-3 col-form-label text-right">
                                <label for="">Event Title</label>
                            </div>
                            <div class="col-md-9 input-group">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="inputGroupFile02" name="header_image">
                                    <label class="custom-file-label" for="inputGroupFile02">Choose file</label>
                                </div>
                            </div>
                        </div> --}}
                        <div class="form-group row">
                            <div class="col-md-3 col-form-label text-right">
                                <label for="">Description</label>
                            </div>
                            <div class="col-md-9">
                                <textarea name="description" style="resize: none;" id="" cols="30" rows="10" class="form-control">{{$event->description}}</textarea>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-3 col-form-label text-right">
                                <label for="">Event Start</label>
                            </div>
                            <div class="col-md-9">
                                <input type="date" class="form-control" name="start" value="{{$event->start}}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-3 col-form-label text-right">
                                <label for="">Event End</label>
                            </div>
                            <div class="col-md-9">
                                <input type="date" class="form-control" name="end" value="{{$event->end}}">
                            </div>
                        </div>
                        {{-- <div class="form-group row">
                            <div class="col-md-3 col-form-label text-right">
                                <label for="">Event Regular Fee</label>
                            </div>
                            <div class="col-md-9">
                                <input type="text" class="form-control" name="fee" value="{{$event->fee}}">
                            </div>
                        </div> --}}
                        
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn agap-primary-color" onclick="eventForm.submit()">Save</button>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection