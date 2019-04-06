@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">

            <div class="col-md-12">
                <div class="card">
                    <div class="card-header"><h1>Members</h1></div>
                    <div class="card-body">
                        <form action="#" method="GET">
                            <div class="from-group row">
                                <div class="col-md-10">
                                    <input type="text" class="form-control" name="key" value="{{ app('request')->input('key') }}" placeholder="search">
                                </div>
                                <div class="col-md-2">
                                    <button class="btn btn-primary btn-block">Search</button>    
                                </div>
                            
                            </div>
                        </form>
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Member</th>
                                    <th>Email</th>
                                    <th>Verified</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($members as $member)
                                <tr>
                                    <td>{{$member->first_name == null ? "N/A" : $member->first_name . " " . $member->last_name}}</td>
                                    <td><a href="mailto:{{$member->email}}">{{$member->email}}</a></td>
                                    <td>@if($member->email_verified_at == null) <div class="badge badge-sm badge-danger">No</div> @else <div class="badge badge-sm badge-success">Yes</div> @endif</td>
                                    <td>
                                        <button class="btn btn-info btn-sm">View</button>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                            
                        </table>
                        <div>
                        {{$members->links()}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection