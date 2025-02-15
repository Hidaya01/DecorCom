@extends('layouts.app')

@section('title', 'Modifier le Panier')

@section('content')
    <h1>Modifier un article du panier</h1>

    <form action="{{ route('cart.update', $cartItem->id) }}" method="POST">
        @csrf
        @method('PUT')

        <label for="quantity">Quantité :</label>
        <input type="number" name="quantity" value="{{ $cartItem->quantity }}" min="1">

        <button type="submit">Modifier</button>
    </form>
@endsection
