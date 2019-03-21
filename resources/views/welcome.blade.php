<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{env("APP_NAME", "AGAP Information System")}}</title>
        <link rel="stylesheet" href="{{asset('css/app.css')}}">

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                background-image: url('/imgs/login-bg.png');
                background-size: cover;
                background-attachment: fixed;
                background-position: center;
                color: #636b6f;
                font-family: 'Nunito', sans-serif;
                font-weight: 200;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 13px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
        </style>
    </head>
    <body>
        <div class="flex-center position-ref full-height">
            @if (Route::has('login'))
                <div class="top-right links">
                    @auth
                        <a href="{{ url('/home') }}">Home</a>
                    @else
                        <a href="{{ route('login') }}" class="text-white">Login</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="text-white">Register</a>
                        @endif
                    @endauth
                </div>
            @endif

            <div class="content">
                <div class="title m-b-md w-25 m-auto py-5">
                    <img src="{{asset('imgs/Logo-New.png')}}" alt="" class="img img-fluid">
                </div>
                <div class="links">
                    <a href="">Home</a>
                    <a href="">History</a>
                    <a href="">Past Presidents</a>
                    <a href="">Officers</a>
                    <a href="">News & Events</a>
                    <a href="">Conventions/Seminars</a>
                    <a href="">Constitution & By Laws</a>
                    <a href="">Contact Us</a>
                </div>
            </div>
        </div>
    </body>
</html>
