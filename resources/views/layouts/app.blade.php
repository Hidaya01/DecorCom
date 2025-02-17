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
    
    <!-- Custom CSS -->
     <link rel="stylesheet" href="{{ asset('css/navbar.css') }}"> 

    <!-- Laravel Mix (Bootstrap and app.scss) -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])

    @stack('styles')
</head>
<body>
    <div id="app">
        <nav class="navbar custom-navbar">
            <div class="container">
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

        <!-- Footer -->
        <footer class="text-white text-center" style="background-color:#95674d;">
            <div class="container p-4">
                <div class="row">
                    <div class="col-lg-6 col-md-12 mb-4 mb-md-0">
                        <h5 class="text-uppercase">About Us</h5>
                        <p>Welcome to DecorCom! Discover unique handmade decorations from talented artisans.</p>
                    </div>
                    <div class="col-lg-3 col-md-6 mb-4 mb-md-0">
                        <h5 class="text-uppercase">Links</h5>
                        <ul class="list-unstyled mb-0">
                            <li><a href="{{ url('/') }}" class="text-white">Home</a></li>
                            <li><a href="{{ route('decors.index') }}" class="text-white">Products</a></li>
                            <li><a href="{{ route('login') }}" class="text-white">Login</a></li>
                            <li><a href="{{ route('register') }}" class="text-white">Register</a></li>
                        </ul>
                    </div>
                    <div class="col-lg-3 col-md-6 mb-4 mb-md-0">
                        <h5 class="text-uppercase">Contact Us</h5>
                        <ul class="list-unstyled">
                            <li><p class="text-white mb-0">Email: support@decorcom.com</p></li>
                            <li><p class="text-white mb-0">Phone: +212 700 091 574</p></li>
                        </ul>
                    </div>
                </div>
            </div>
            <p class="text-center mb-0">© 2025 DecorCom. All rights reserved.</p>
        </footer>
        <!-- End Footer -->
    </div>
</body>
@push('styles')
<style>
/* General Reset */
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

body, html {
    margin: 0;
    padding: 0;
    min-height: 100vh;
    display: flex;
    flex-direction: column;
}

#app {
    flex: 1;
    display: flex;
    flex-direction: column;
}

main {
    flex: 1;
}


/* Navbar styling */
.custom-navbar {
    background-color: #95674d;
    color: white;
    display: flex;
    justify-content: space-between;
    align-items: center;
    height: 70px; 
    padding: 0 20px; 
    position: relative;
}

.custom-navbar .logo {
    width: auto; 
    height: 69px; 
    object-fit: contain; 
    position: absolute; 
    top: 50%; 
    left: 0; 
    transform: translateY(-50%); /* Vertically centers the logo */
}

.custom-navbar .navbar-toggler {
    display: none;
    background: none;
    border: none;
    color: white;
    font-size: 30px;
    cursor: pointer;
}

/* Navbar links */
.custom-navbar .navbar-links {
    display: flex;
    gap: 20px;
}

.custom-navbar .navbar-links ul {
    list-style-type: none;
    display: flex;
    flex-direction: row;
    gap: 20px;
}

.custom-navbar .navbar-links a {
    color: white;
    text-decoration: none;
    transition: background-color 0.3s;
}

.custom-navbar .navbar-links a:hover {
    background-color: #985e3d;
    border-radius: 5px;
}

.custom-navbar .dropdown {
    position: relative;
}

.custom-navbar .dropdown-menu {
    position: absolute;
    top: 100%;
    left: 0;
    background-color: #95674d;
    display: none;
    padding: 10px;
    border-radius: 5px;
    box-shadow: 0 8px 16px rgba(0, 0, 0, 0.3);
}

.custom-navbar .dropdown:hover .dropdown-menu {
    display: block;
}

.custom-navbar .dropdown-menu a {
    color: white;
    text-decoration: none;
    display: block;
}

.custom-navbar .dropdown-menu a:hover {
    background-color: #95674d;
}

/* Mobile view */
@media screen and (max-width: 768px) {
    .custom-navbar .navbar-links {
        display: none;
        flex-direction: column;
        width: 100%;
    }

    .custom-navbar .navbar-links.active {
        display: flex;
    }

    .custom-navbar .navbar-toggler {
        display: block;
    }

    .custom-navbar .navbar-links ul {
        flex-direction: column;
        gap: 0;
    }

    .custom-navbar .navbar-links a {
        text-align: center;
        padding: 15px;
        width: 100%;
    }
}
</style>

</html>
