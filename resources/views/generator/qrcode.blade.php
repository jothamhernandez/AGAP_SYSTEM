

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Event Registration</title>
</head>
<body style="height: 100vh; display: flex; justify-content: center; align-items: center; padding: 0; margin: 0;">
<div>
    <div style="text-align: center">
        @if($event->start > \Carbon\Carbon::now())
        <h1>Event doesn't started yet</h1>
        @else
        <h1>Get Your Materials At</h1>
        {!! QrCode::size(500)->generate($event->event_materials_link); !!}
        <p>{{$event->event_materials_link}}</p>
        @endif
    </div>
</div>
</body>
</html>