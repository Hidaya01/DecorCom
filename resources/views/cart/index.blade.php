@extends('layouts.app')

@section('title', 'Votre Panier')

@section('content')
    <h1>Votre Panier</h1>

    @if(session('success'))
        <p style="color: green;">{{ session('success') }}</p>
    @endif

    @if(empty($cart))
        <p>Votre panier est vide.</p>
    @else
        <table>
            <thead>
                <tr>
                    <th>Produit</th>
                    <th>Prix</th>
                    <th>Quantité</th>
                    <th>Total</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($cart as $id => $item)
                    <tr>
                        <td>{{ $item['name'] }}</td>
                        <td>{{ $item['price'] }} €</td>
                        <td>{{ $item['quantity'] }}</td>
                        <td>{{ $item['price'] * $item['quantity'] }} €</td>
                        <td>
                            <form action="{{ route('cart.remove', $id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit">❌ Retirer</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <p><strong>Total: {{ array_sum(array_map(fn($item) => $item['price'] * $item['quantity'], $cart)) }} €</strong></p>

        <form action="{{ route('cart.clear') }}" method="POST">
            @csrf
            <button type="submit">🗑️ Vider le Panier</button>
        </form>
    @endif
@endsection
