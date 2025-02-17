@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="form-container">
                <h1 class="text-center">{{ __('Add a new decor') }}</h1>
                <form action="{{ route('decors.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label for="name" class="form-label">{{ __('Nom') }}</label>
                        <input type="text" id="name" name="name" class="form-control" required>
                    </div>
                    
                    <div class="mb-3">
                        <label for="image" class="form-label">{{ __('Image') }}</label>
                        <input type="file" id="image" name="image" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label for="description" class="form-label">{{ __('Description') }}</label>
                        <textarea id="description" name="description" class="form-control" rows="4" required></textarea>
                    </div>
                    
                    <div class="mb-3">
                        <label for="price" class="form-label">{{ __('Prix') }}</label>
                        <input type="number" id="price" name="price" class="form-control" required>
                    </div>
                    
                    <div class="text-center">
                        <button type="submit" class="btn btn-success text-white" >{{ __('Ajouter') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
