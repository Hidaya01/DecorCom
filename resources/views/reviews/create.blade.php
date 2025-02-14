@extends('layouts.app')

@section('content')
    <h1>Ajouter un Avis</h1>
    <form action="{{ route('reviews.store') }}" method="POST">
        @csrf
        <label for="content">Contenu</label>
        <textarea id="content" name="content" required></textarea>
        <label for="rating">Note</label>
        <input type="number" id="rating" name="rating" min="1" max="5" required>
        <label for="user_id">ID Utilisateur</label>
        <input type="number" id="user_id" name="user_id" required>
        <label for="decor_id">ID Décor</label>
        <select id="decor_id" name="decor_id" required>
            @foreach($decors as $decor)
                <option value="{{ $decor->id }}">{{ $decor->name }}</option>
            @endforeach
        </select>
        <button type="submit">Soumettre</button>
    </form>
@endsection
