@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-lg" style="border-radius: 20px;">
                <div class="card-header text-center" style="background-color: #28a745; color: white; border-radius: 20px 20px 0 0;">
                    <h4>{{ __('Login') }}</h4>
                </div>

                <div class="card-body p-5">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="row mb-4">
                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus style="border-radius: 10px; background-color: #f5f5f5;">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-4">
                            <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" style="border-radius: 10px; background-color: #f5f5f5;">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-4">
                            <div class="col-md-6 offset-md-4 d-flex align-items-center">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-8 offset-md-2 d-flex flex-column align-items-center">
                                @if (Route::has('password.request'))
                                    <a class="btn btn-link mb-2" href="{{ route('password.request') }}" style="color: #95674d;">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif
                                <button type="submit" class="btn btn-lg text-white text-center" style="background-color: #28a745; border-radius: 30px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">
                                    {{ __('Login') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
