@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1>Reports</h1>
            <table class="table table-fluid">
                <thead>
                    <tr>
                        <th>Event</th>
                        <th>Registered</th>
                        <th>Paid</th>
                        <th>Funds</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($events as $event)
                    <tr>
                        <td>{{$event->title}}</td>
                        <td>{{$event->registered->count()}}</td>
                        <td>{{$event->paid->count()}}</td>
                        <td>Php @convert($event->fund())</td>
                        <td>
                            <button class="btn btn-primary btn-sm">Print Report</button>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection