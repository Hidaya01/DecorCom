@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="row">
        <!-- Sidebar -->
        <div class="col-md-3">
            <div class="card shadow-sm p-3">
                <h4 class="text-center">{{ Auth::user()->name }}</h4>
                <p class="text-muted text-center">{{ ucfirst(Auth::user()->role) }}</p>
            </div>
        </div>

        <!-- Main Content -->
        <div class="col-md-9">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">
                    <h4>Dashboard</h4>
                </div>
                <div class="card-body">
                    <p class="lead">
                        Welcome, <strong>{{ Auth::user()->name }}</strong>! You are logged in as <strong>{{ Auth::user()->role }}</strong>.
                    </p>

                    @if(Auth::user()->isAdmin())
                        <!-- <a href="{{ route('users.index') }}" class="btn btn-success">
                            <i class="fas fa-users"></i> Manage Users
                        </a> -->
                        <p>View dashboard</p>
                    @endif

                    @if(Auth::user()->isArtisan())
                        <a href="{{ route('decors.create') }}" class="btn btn-primary">
                            <i class="fas fa-plus"></i> Add New Decor
                        </a>
                        <a href="{{ route('decors.index') }}" class="btn btn-info">
                            <i class="fas fa-store"></i> My Products
                        </a>
                    @endif

                    @if(Auth::user()->isClient())
                        <a href="{{ route('decors.index') }}" class="btn btn-info">
                            <i class="fas fa-shopping-bag"></i> Browse Decors
                        </a>
                        <a href="{{ route('cart.index') }}" class="btn btn-warning">
                            <i class="fas fa-shopping-cart"></i> View Cart
                        </a>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
