<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="shortcut icon" href="{{ asset('imgs/agap.ico')}}" type="image/x-icon">
</head>

<body style="background-color: whitesmoke;">
    <div id="app">
        <div class="container">
            <div class="row" style="width: 200px; margin:auto; padding: 30px;">
                <img src="{{asset('imgs/Logo-New.png')}}" alt="" style="width: 100%;">
            </div>
            <div class="row">
                @yield('content')
            </div>
            <div class="row">
                <p style="color: gray; text-align: center;">Copyright &copy; {{ now()->year }} • Association of Government Accountants of the Philippines</p>
            </div>
        </div>
    </div>
</body>

</html>