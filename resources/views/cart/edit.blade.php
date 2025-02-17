@extends('layouts.app')

@section('title', 'Edit Cart')

@section('content')
<div class="container mt-5">
    <h2>Edit Quantity</h2>

    <form action="{{ route('cart.update', $cartItem->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="quantity" class="form-label">Quantity:</label>
            <input type="number" name="quantity" class="form-control" value="{{ $cartItem->quantity }}" min="1" max="10">
        </div>

        <button type="submit" class="btn btn-success m-2">Update</button>
        <a href="{{ route('cart.index') }}" class="btn btn-outline-danger">Cancel</a>
    </form>
</div>
@endsection
