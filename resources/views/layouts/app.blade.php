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

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="shortcut icon" href="{{ asset('imgs/agap.ico')}}" type="image/x-icon">
</head>
<body>
    <div id="app">
        <header class="agap-primary-color">
            <div class="container">
                <div class="row py-4">
                    <div class="col-md-12">
                        <a href="{{ url('/') }}"><img src="{{asset('imgs/logo.png')}}" alt="" class="img img-fluid"></a>
                    </div>
                </div>
            </div>
        </header>
        <nav class="navbar navbar-expand-md navbar-laravel">
            <div class="container">
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    @guest

                    @else
                        @if(Auth::user()->email_verified_at != null)
                        <ul class="navbar-nav mr-auto">
                            <li class="nav-item">
                                <a href="" class="nav-link">Dashboard</a>
                            </li>
                            <li class="nav-item">
                                <a href="" class="nav-link">Members</a>
                            </li>
                            <li class="nav-item">
                                <a href="" class="nav-link">Events</a>
                            </li>
                            <li class="nav-item">
                                <a href="" class="nav-link">Reports</a>
                            </li>
                        </ul>
                        @endif
                    @endguest

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->username }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4 d-flex justify-content-center align-items-center" style="min-height: 75vh;">
            @yield('content')
        </main>
    </div>
    <footer class="agap-primary-color py-4">
        <div class="container">
            <div class="row">
                <div class="col-md-12 text-center">
                        <strong>Copyright &copy; {{ Carbon\Carbon::now()->format('Y')}} - Association of Government Accountants of the Philippines by <a href="https://www.pinwheel-developers.com" style="color: white">Pinwheel-Developers</a></strong>
                </div>
            </div>
        </div>
    </footer>
</body>
</html>
