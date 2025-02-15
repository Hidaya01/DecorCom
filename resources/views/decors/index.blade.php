@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Liste des décors</h2>
    @if(auth()->user()->isArtisan())
    <a href="{{ route('decors.create') }}" class="btn btn-primary">Ajouter un décor</a>
    @endif
    
    <table class="table mt-3">
        <thead>
            <tr>
                <th>Nom</th>
                <th>Image</th>
                <th>Description</th>
                <th>Prix</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($decors as $decor)
                <tr>
                    <td>{{ $decor->name }}</td>
                    <td>{{ $decor->image }}</td>
                    <td>{{ $decor->description }}</td>
                    <td>{{ $decor->price }} MAD</td>
                    <td>
                    @if(auth()->user()->isClient())
                        <form action="{{ route('cart.add', $decor->id) }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-success btn-sm">Ajouter au panier</button>
                        </form>
                    @endif
                    @if(auth()->user()->isArtisan())
                    <a href="{{ route('decors.edit', $decor) }}" class="btn btn-warning btn-sm">Modifier</a>
                        <form action="{{ route('decors.destroy', $decor) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Supprimer</button>
                        </form>
                    @endif                        
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
