@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">
                        <h3>Logged Sessions</h3>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table table-fluid table-stripped">
                        <thead>
                            <tr>
                                <th>IP Address</th>
                                <th>Location</th>
                                <th>Region</th>
                                <th>City</th>
                                <th>Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($sessions as $session)
                            <tr>
                                <td>{{$session->ip_address}}</td>
                                <td>{{$session->country_code}}</td>
                                <td>{{$session->region_name}}</td>
                                <td>{{$session->city_name}}</td>
                                <td>{{$session->created_at}}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="row mt-4">
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <h3>Registered Event</h3>
                </div>
                <div class="card-body">
                    <div class="jumbotron text-center"><h2>{{$events}}</h2></div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection