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
                    <span class="navbar-toggler-icon">
                        <div style="height:5px; background-color: green; margin: 2px; border-radius: 3px;"></div>
                        <div style="height:5px; background-color: green; margin: 2px; border-radius: 3px;"></div>
                        <div style="height:5px; background-color: green; margin: 2px; border-radius: 3px;"></div>
                    </span>
                    
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    @guest

                    @else
                        @if(Auth::user()->email_verified_at != null)
                        <ul class="navbar-nav mr-auto">
                        
                            @if(Auth::user()->roles->contains('role','Super Admin') || Auth::user()->roles->contains('role','Admin'))
                            <li class="nav-item">
                                <a href="" class="nav-link">Dashboard</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{route('page.departments')}}" class="nav-link">Departments</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{route('page.agencies')}}" class="nav-link">Agencies</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{route('page.member')}}" class="nav-link">Members</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{route('page.reports')}}" class="nav-link">Reports</a>
                            </li>
                            @endif
                            <li class="nav-item">
                                <a href="{{route('page.events')}}" class="nav-link">Events</a>
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
                                    <a class="dropdown-item" href="{{ route('page.account_info') }}">
                                        {{ __('Account Information') }}
                                    </a>
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

        <main class="py-4 d-flex" style="min-height: 75vh;">
            @yield('content')
        </main>
    </div>
    <footer class="agap-primary-color py-4">
        <div class="container">
            <div class="row">
                <div class="col-md-12 text-center">
                        <strong>Copyright &copy; {{ Carbon\Carbon::now()->format('Y')}} - Association of Government Accountants of the Philippines @if(env('WITH_FOOTER', 0)) by  <a href="https://www.pinwheel-developers.com" style="color: white">Pinwheel-Developers</a> @endif</strong>
                </div>
            </div>
        </div>
    </footer>
    @yield('scripts')
</body>
</html>
