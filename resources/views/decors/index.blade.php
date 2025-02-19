@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h1 class="text-center m-2" style="color: #95674d;">List of Decors</h1>

    @auth
        @if(auth()->user()->isArtisan())
            <a href="{{ route('decors.create') }}" class="btn mb-3 text-white hover-scale" style="background-color: #6B8E23;">Add Decor</a>
        @endif
    @endauth
    
    <div class="row">
        @foreach($decors as $decor)
            <div class="col-md-4 mb-4">
                <div class="card shadow-sm hover-scale">
                    <img class="card-img-top custom-img" src="{{ $decor->image ? asset('storage/' . $decor->image) : asset('images/default-decor.jpg') }}" alt="{{ $decor->name }}">
                    <div class="card-body">
                        <h5 class="card-title" style="color: #95674d;">{{ $decor->name }}</h5>
                        <p class="card-text">{{ Str::limit($decor->description, 100) }}</p>
                        <p class="card-text"><strong>{{ $decor->price }} MAD</strong></p>

                        @auth
                            @if(auth()->user()->isClient())
                                <div class="d-flex align-items-center">
                                    <form action="{{ route('cart.store') }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="decor_id" value="{{ $decor->id }}">
                                        <button type="submit" class="btn btn-success d-flex m-2 hover-scale">Add to Cart</button>
                                    </form>
                                    <a href="{{ route('decors.show', $decor->id) }}" class="btn btn-outline-dark hover-scale">View Details</a>
                                </div>    
                            @endif

                            @if(auth()->user()->isArtisan())
                                <div class="d-flex align-items-center">
                                    <a href="{{ route('decors.edit', $decor) }}" class="btn btn-warning m-2 hover-scale">Edit</a>
                                    <form action="{{ route('decors.destroy', $decor) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger m-2 hover-scale" onclick="return confirm('Are you sure you want to delete this decor?')">Delete</button>
                                    </form>
                                </div>
                            @endif
                        @endauth
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection

@push('styles')
<style>
    .custom-img {
        width: 100%;       
        height: 250px;      
        object-fit: cover;  
        object-position: center; 
    }

    .card {
        border: none;
        border-radius: 15px;
        overflow: hidden;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
    }

    .card-title {
        color: #95674d;
        font-weight: bold;
    }

    .card-text {
        color: #5a5a5a;
    }

    .btn {
        font-size: 16px;
        border-radius: 30px;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .btn-success {
        background-color: #6B8E23;
        border-color: #6B8E23;
    }

    .btn-outline-dark {
        color: #343a40;
        border-color: #343a40;
    }

    .btn-warning {
        background-color: #f0ad4e;
        border-color: #f0ad4e;
    }

    .btn-danger {
        background-color: #dc3545;
        border-color: #dc3545;
    }

    .btn-primary {
        background-color: #6B8E23;
        border-color: #6B8E23;
    }

    .hover-scale:hover {
        transform: scale(1.05);
        box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
    }
</style>
@endpush
