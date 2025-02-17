@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="row">
        <!-- Sidebar -->
        <div class="col-md-3">
            <div class="card shadow-lg p-4 mb-4 animate__animated animate__fadeInLeft" style="border-radius: 20px; background-color: #fafafa;">
                <div class="text-center">
                    <h4 style="color: #95674d; font-weight: bold;">{{ Auth::user()->name }}</h4>
                    <p class="text-muted">{{ ucfirst(Auth::user()->role) }}</p>
                </div>
            </div>
        </div>

        <!-- Main Content -->
        <div class="col-md-9">
            <div class="card shadow-lg animate__animated animate__fadeInRight" style="border-radius: 20px;">
                <div class="card-header bg-white" style="border-bottom: 4px solid #95674d;">
                    <h4 style="color: #95674d; font-weight: bold; text-align: center;">Dashboard</h4>
                </div>
                <div class="card-body text-center">
                    <p class="lead">
                        Welcome to DecorCom, <strong>{{ Auth::user()->name }}</strong>! You are logged in as <strong>{{ Auth::user()->role }}</strong>.
                    </p>

                    @if(Auth::user()->isAdmin())
                        <p>View dashboard</p>
                    @endif

                    @if(Auth::user()->isArtisan())
                        <a href="{{ route('decors.create') }}" class="btn btn-lg text-white m-2 hover-scale" style="background-color: #6B8E23; border-radius: 30px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">
                            <i class="fas fa-plus"></i> Add New Decor
                        </a>
                        <a href="{{ route('decors.index') }}" class="btn btn-lg text-dark m-2 hover-scale" style="background-color: #EDE8D0; border-radius: 30px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">
                            <i class="fas fa-store"></i> My Products
                        </a>
                    @endif

                    @if(Auth::user()->isClient())
                        <a href="{{ route('decors.index') }}" class="btn btn-lg text-dark m-2 hover-scale" style="background-color: #EDE8D0; border-radius: 30px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">
                            <i class="fas fa-shopping-bag"></i> Browse Decors
                        </a>
                        <a href="{{ route('cart.index') }}" class="btn btn-lg text-white m-2 hover-scale" style="background-color: #6B8E23; border-radius: 30px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">
                            <i class="fas fa-shopping-cart"></i> View Cart
                        </a>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Add Animate.css for animations -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">

<!-- Custom CSS for hover effects -->
<style>
    /* Hover Scale Effect */
    .hover-scale {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }
    .hover-scale:hover {
        transform: scale(1.05);
        box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2) !important;
    }

    /* Smooth Animations */
    .animate__animated {
        animation-duration: 1s;
    }
</style>
@endsection