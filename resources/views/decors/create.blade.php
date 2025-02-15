@extends('layouts.app')

@section('content')
    <h1>Ajouter un nouveau décor</h1>
    <form action="{{ route('decors.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <label for="name">Nom</label>
        <input type="text" id="name" name="name" required>
        
        <label for="image">Image</label>
        <input type="file" id="image" name="image" required>

        <label for="description">Description</label>
        <textarea id="description" name="description" required></textarea>
        
        <label for="price">Prix</label>
        <input type="number" id="price" name="price" required>
        
        <button type="submit">Ajouter</button>
    </form>
@endsection
