@extends('layouts.app')

@section('content')
<div class="container mt-5">
<h1 class="text-center">Decor Details:</h1>

    <div class="d-flex justify-content-center">
        <div class="col-md-6 mb-4">
            <div class="card h-100">
                <img src="{{ $decor->image ? asset('storage/' . $decor->image) : asset('images/default-decor.jpg') }}" 
                     class="card-img-top" 
                     alt="{{ $decor->name }}">
                
                <div class="card-body">
                    <h2 class="card-title">{{ $decor->name }}</h2>
                    <p class="card-text">{{ Str::limit($decor->description, 100) }}</p>
                    <p class="card-text"><strong>{{ $decor->price }} MAD</strong></p>
                </div>
            </div>
        </div>
    </div>

   
    <div class="mt-4">
        <h3>Reviews</h3>
        @forelse($decor->reviews as $review)
            <div class="card mt-2 p-3 shadow-sm">
                <strong>{{ $review->user->name }}</strong>
                <small class="text-muted">{{ $review->created_at->format('d M, Y') }}</small>
                <p>⭐ {{ $review->rating }}/5</p>
                <p>{{ $review->content }}</p>

              
                @if (Auth::check() && Auth::id() === $review->user_id)
                    <div class="d-flex">
                        <button class="btn btn-sm btn-warning me-2" data-bs-toggle="modal" data-bs-target="#editReviewModal{{ $review->id }}">
                            Edit
                        </button>
                        <!-- Delete Form -->
                        <form action="{{ route('reviews.destroy', $review->id) }}" method="POST" onsubmit="return confirm('Are you sure?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                        </form>
                    </div>

                    <!-- Edit Review -->
                    <div class="modal fade" id="editReviewModal{{ $review->id }}" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Edit Review</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form action="{{ route('reviews.update', $review->id) }}" method="POST">
                                        @csrf
                                        @method('PUT')

                                        <div class="mb-3">
                                            <label for="rating" class="form-label">Rating:</label>
                                            <select name="rating" class="form-control" required>
                                                <option value="5" {{ $review->rating == 5 ? 'selected' : '' }}>⭐️⭐️⭐️⭐️⭐️</option>
                                                <option value="4" {{ $review->rating == 4 ? 'selected' : '' }}>⭐️⭐️⭐️⭐️</option>
                                                <option value="3" {{ $review->rating == 3 ? 'selected' : '' }}>⭐️⭐️⭐️</option>
                                                <option value="2" {{ $review->rating == 2 ? 'selected' : '' }}>⭐️⭐️</option>
                                                <option value="1" {{ $review->rating == 1 ? 'selected' : '' }}>⭐️</option>
                                            </select>
                                        </div>

                                        <div class="mb-3">
                                            <label for="content" class="form-label">Your Review:</label>
                                            <textarea name="content" class="form-control" required>{{ $review->content }}</textarea>
                                        </div>

                                        <button type="submit" class="btn btn-primary">Update Review</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        @empty
            <p>No reviews yet. Be the first to review!</p>
        @endforelse
    </div>

    <!-- Add Review Form -->
    @auth
    <form action="{{ route('reviews.store') }}" method="POST" class="mt-4">
        @csrf
        <input type="hidden" name="decor_id" value="{{ $decor->id }}">

        <div class="mb-3">
            <label for="rating" class="form-label">Rating:</label>
            <select name="rating" class="form-control" required>
                <option value="5">⭐️⭐️⭐️⭐️⭐️</option>
                <option value="4">⭐️⭐️⭐️⭐️</option>
                <option value="3">⭐️⭐️⭐️</option>
                <option value="2">⭐️⭐️</option>
                <option value="1">⭐️</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="content" class="form-label">Your Review:</label>
            <textarea name="content" class="form-control" required></textarea>
        </div>
        
        <button type="submit" class="btn btn-success">Submit Review</button>
    </form>
    @else
        <p><a href="{{ route('login') }}">Login</a> to leave a review.</p>
    @endauth
</div>
@endsection
