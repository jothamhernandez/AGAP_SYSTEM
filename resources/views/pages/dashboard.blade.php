@extends('layouts.app')

@section('content')

<div class="container">
    <div class="card">
        <div class="card-header">
            <div class="card-title">Logged Sessions</div>
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
@endsection