@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Votre Panier</h2>
    
    @if(session('cart'))
        <table class="table">
            <thead>
                <tr>
                    <th>Produit</th>
                    <th>Prix</th>
                    <th>Quantité</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach(session('cart') as $id => $item)
                    <tr>
                        <td>{{ $item['name'] }}</td>
                        <td>{{ $item['price'] }} MAD</td>
                        <td>{{ $item['quantity'] }}</td>
                        <td>
                            <form action="{{ route('cart.remove', $id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Retirer</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <form action="{{ route('cart.clear') }}" method="POST">
            @csrf
            <button type="submit" class="btn btn-warning">Vider le panier</button>
        </form>
    @else
        <p>Votre panier est vide.</p>
    @endif
</div>
@endsection
