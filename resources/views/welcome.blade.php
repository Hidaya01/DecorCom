<!-- resources/views/home.blade.php -->

@extends('layouts.app')

@section('content')
<div class="container mt-5 text-center">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <!-- Hero Section -->
            <div class="jumbotron bg-light p-5 shadow-sm">
                <h1 class="display-4" style="color: #95674d;">Welcome to Decorkom!</h1>
                <p class="lead">Discover unique handmade decorations from talented artisans.</p>
                <hr class="my-4">
                <p>Join us today to explore, buy, or sell beautiful handcrafted decor.</p>

                <!-- Buttons -->
                <div class="mt-4">
                    @if (Route::has('login'))
                        <a href="{{ route('login') }}" class="btn btn-primary btn-lg" style="background-color: #95674d; border: none;">
                            <i class="fas fa-sign-in-alt"></i> Login
                        </a>
                    @endif
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="btn btn-success btn-lg">
                            <i class="fas fa-user-plus"></i> Register
                        </a>
                    @endif
                    <a href="{{ route('decors.index') }}" class="btn btn-outline-dark btn-lg">
                        <i class="fas fa-store"></i> Explore Products
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
