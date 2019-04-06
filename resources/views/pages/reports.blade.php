@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1>Reports</h1>
            @foreach($events as $event)
                <div>
                    <p>Event: {{$event->title}}</p>
                    <p>Registered: {{$event->registered->count()}}</p>
                    <p>Paid: {{$event->paid->count()}}</p>
                    <p>Total: {{$event->fund()}}</p>
                </div>
            @endforeach
        </div>
    </div>
</div>

@endsection