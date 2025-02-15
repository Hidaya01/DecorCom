@extends('layouts.app')

@section('title', 'Ajouter au Panier')

@section('content')
    <h1>Ajouter un article au panier</h1>

    <form action="{{ route('cart.add', $decor->id) }}" method="POST">
        @csrf
        <p><strong>Produit :</strong> {{ $decor->name }} - {{ $decor->price }} €</p>

        <button type="submit">🛒 Ajouter au panier</button>
    </form>
@endsection
