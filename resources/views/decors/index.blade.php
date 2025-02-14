@extends('layouts.app')

@section('content')
    <h1>Liste des décors</h1>
    <a href="{{ route('decors.create') }}">Ajouter un nouveau décor</a>
    <ul>
        @foreach($decors as $decor)
            <li>
                {{ $decor->name }} - {{ $decor->price }} €
                <a href="{{ route('decors.edit', $decor) }}">Modifier</a>
                <form action="{{ route('decors.destroy', $decor) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit">Supprimer</button>
                </form>
            </li>
        @endforeach
    </ul>
@endsection
