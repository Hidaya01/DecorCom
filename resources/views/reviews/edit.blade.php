@extends('layouts.app')

@section('content')
    <h1>Modifier le décor</h1>
    <form action="{{ route('decors.update', $decor) }}" method="POST">
        @csrf
        @method('PUT')
        <label for="name">Nom</label>
        <input type="text" id="name" name="name" value="{{ $decor->name }}" required>
        <label for="description">Description</label>
        <textarea id="description" name="description" required>{{ $decor->description }}</textarea>
        <label for="price">Prix</label>
        <input type="number" id="price" name="price" value="{{ $decor->price }}" required>
        <button type="submit">Mettre à jour</button>
    </form>
@endsection
