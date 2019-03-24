@extends('layouts.app')


@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12 mb-3">
                <div class="card card-default">
                    <div class="card-header">
                        Account Information
                    </div>
                    <div class="card-body">
                        <div class="form-group row">
                            <div class="col-md-3 col-form-label text-right">
                                Username:
                            </div>
                            <div class="col-md-9">
                                <span class="form-control">{{Auth::user()->email}}</span>
                            </div>
                        </div>
                        <div class="col-md-9 offset-md-3">
                            <button class="btn btn-warning">Reset Password</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="card card-default">
                    <div class="card-header">
                        Personal Information
                    </div>
                    <div class="card-body">
                        <div class="form-group row">
                            <div class="col-md-3 col-form-label text-right">
                                <label for="">First Name:</label>
                            </div>
                            <div class="col-md-9">
                                <input type="text" class="form-control" value="{{$user_info->first_name}}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-3 col-form-label text-right">
                                <label for="">Last Name:</label>
                            </div>
                            <div class="col-md-9">
                                <input type="text" class="form-control" value="{{$user_info->last_name}}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-3 col-form-label text-right">
                                <label for="">Middle Name:</label>
                            </div>
                            <div class="col-md-9">
                                <input type="text" class="form-control" value="{{$user_info->middle_name}}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-3 col-form-label text-right">
                                <label for="">Birthdate:</label>
                            </div>
                            <div class="col-md-9">
                                <input type="date" class="form-control" value="{{$user_info->birthdate}}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-3 col-form-label text-right">
                                <label for="">Gender:</label>
                            </div>
                            <div class="col-md-9">
                                <div class="form-control">
                                    <span>
                                        <input type="radio" value="male" {{ ($user_info->gender == 'male') ? 'checked' : ''}}> Male
                                    </span>
                                    <span>
                                        <input type="radio" value="male" {{ ($user_info->gender == 'female') ? 'checked' : ''}}> Female
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-3 col-form-label text-right">
                                <label for="">Agency:</label>
                            </div>
                            <div class="col-md-9">
                                <select name="" id="" class="form-control">
                                    @foreach($agencies as $agency)
                                    <option value="{{$agency->id}}" {{ ($agency->id == $user_info->agency_id) ? 'selected' : ''}}>{{$agency->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection