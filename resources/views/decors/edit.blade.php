@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header  text-black text-center">{{ __('Edit Decor') }}</div>
                <div class="card-body">
                    <form action="{{ route('decors.update', $decor) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label for="name" class="form-label">{{ __('Name') }}</label>
                            <input type="text" id="name" name="name" class="form-control" value="{{ $decor->name }}" required>
                        </div>
                        
                        <div class="mb-3">
                            <label for="description" class="form-label">{{ __('Description') }}</label>
                            <textarea id="description" name="description" class="form-control" rows="4" required>{{ $decor->description }}</textarea>
                        </div>
                        
                        <div class="mb-3">
                            <label for="price" class="form-label">{{ __('Price') }}</label>
                            <input type="number" id="price" name="price" class="form-control" value="{{ $decor->price }}" required>
                        </div>
                        
                        <div class="text-center">
                            <button type="submit" class="btn btn-success">{{ __('Update') }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
