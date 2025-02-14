@extends('layouts.app')

@section('content')
    <h1>Liste des avis</h1>
    <ul>
        @foreach($reviews as $review)
            <li>
                <strong>Utilisateur :</strong> {{ $review->user->name }}<br>
                <strong>Décor :</strong> {{ $review->decor->name }}<br>
                <strong>Note :</strong> {{ $review->rating }}<br>
                <strong>Contenu :</strong> {{ $review->content }}<br>
                <form action="{{ route('reviews.destroy', $review) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit">Supprimer</button>
                </form>
            </li>
        @endforeach
    </ul>

    <h2>Liste des décors</h2>
    <ul>
        @foreach($decors as $decor)
            <li>
                {{ $decor->name }} - {{ $decor->price }} €
            </li>
        @endforeach
    </ul>
@endsection
