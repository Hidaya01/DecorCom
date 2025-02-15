@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Liste des décors</h2>
    @if(auth()->user()->isArtisan())
    <a href="{{ route('decors.create') }}" class="btn btn-primary mb-3">Ajouter un décor</a>
    @endif
    
    <div class="row">
        @foreach($decors as $decor)
            <div class="col-md-4 mb-4">
                <div class="card">
                    <img src="{{ asset('storage/' . $decor->image) }}" class="card-img-top" alt="{{ $decor->name }}">
                    <div class="card-body">
                        <h5 class="card-title">{{ $decor->name }}</h5>
                        <p class="card-text">{{ Str::limit($decor->description, 100) }}</p>
                        <p class="card-text"><strong>{{ $decor->price }} MAD</strong></p>
                        <div class="d-flex justify-content-between">
                            @if(auth()->user()->isClient())
                            <form action="{{ route('cart.add', $decor->id) }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-success btn-sm">Ajouter au panier</button>
                            </form>
                            <a href="{{ route('decors.show', $decor->id) }}">voir details</a>
                            @endif
                            @if(auth()->user()->isArtisan())
                                <div class="d-flex justify-content-between">
                                    <a href="{{ route('decors.edit', $decor) }}" class="btn btn-warning btn-sm mr-2 ">Modifier</a>
                                    <form action="{{ route('decors.destroy', $decor) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">Supprimer</button>
                                    </form>
                                </div>
                            @endif

                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection
