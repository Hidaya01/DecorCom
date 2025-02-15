<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'DecorCom') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    
    <link rel="stylesheet" href="{{ asset('css/navbar.css') }}"> <!-- Path to your custom CSS file -->

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>
<body>
    <div id="app">
    <nav class="navbar">
            <div class="container">
                <!-- if the user is logged in route to home else to welcome page -->
            <a class="navbar-brand" href="{{ Auth::user() ? url('/home') : url('/') }}" style="color:white">
                <img src="{{ asset('images/decorcom.png') }}" alt="DecorCom Logo" class="logo">   
                DECORCOM
            </a>

                <!-- Toggler for mobile view -->
                <button class="navbar-toggler" id="navbar-toggler">
                    &#9776; <!-- Hamburger icon -->
                </button>

                <div class="navbar-links" id="navbar-links">
                    <ul class="navbar-nav">
                        @guest
                            @if (Route::has('login'))
                                <li><a href="{{ route('login') }}">{{ __('Login') }}</a></li>
                            @endif

                            @if (Route::has('register'))
                                <li><a href="{{ route('register') }}">{{ __('Register') }}</a></li>
                            @endif
                        @else

                            @if (Auth::user()->role === 'client')
                                <!-- navbar client -->
                                <li><a href="{{ route('decors.index') }}">Décors</a></li>
                                <li><a href="{{ route('cart.index') }}">🛒 Cart</a></li>
                            @endif
                            @if (Auth::user()->role === 'artisan')
                                <!-- Artisan Links -->
                                <li><a href="{{ route('decors.create') }}"> Add Décor</a></li>
                                <li><a href="{{ route('decors.index') }}"> My Products</a></li>
                            @endif
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle">
                                    {{ Auth::user()->name }}
                                </a>
                                <div class="dropdown-menu">
                                    <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>
</body>
</html>
