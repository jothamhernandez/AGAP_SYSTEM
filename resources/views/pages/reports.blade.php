@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1>Reports</h1>
            <table class="table table-fluid table-striped">
                <thead>
                    <tr class="text-center">
                        <th>Event</th>
                        <th>Registered</th>
                        <th>Pending Payment</th>
                        <th>Paid</th>
                        <th>Funds</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($events as $event)
                    <tr class="text-center">
                        <td>{{$event->title}}</td>
                        <td>{{$event->registered->count()}}</td>
                        <td>{{$event->pending->count()}}</td>
                        <td>{{$event->paid->count()}}</td>
                        <td>Php @convert($event->fund())</td>
                        <td>
                            <a class="btn btn-primary btn-sm" href="{{route('report.print.event', ['event_id'=> $event->id])}}" target="__blank">Print Report</a>
                            <a href="{{route('payment.review',['event_id'=>$event->id])}}" class="btn btn-primary btn-sm">View Payments</a>
                            <a href="{{route('validator.page',['event_id'=>encrypt($event->id)])}}" class="btn btn-primary btn-sm">Validate</a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection