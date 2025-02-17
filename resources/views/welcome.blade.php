<!-- resources/views/welcome.blade.php -->

@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-10 col-lg-8">
            <!-- Hero Section -->
            <div class="hero-section p-5 text-center shadow-lg rounded-4 overflow-hidden position-relative" 
                 style="background-image: url('{{ asset('images/hero-bg.jpg') }}'); background-size: cover; background-position: center;">
                
                <!-- Dynamic Gradient Overlay -->
                <div class="overlay position-absolute top-0 start-0 w-100 h-100" 
                     style="background: linear-gradient(180deg, #95674d,rgb(220, 164, 131);"></div>

                <!-- Particle Effects Container -->
                <div id="particles-js" class="position-absolute top-0 start-0 w-100 h-100"></div>

                <div class="position-relative z-index-1">
                    <!-- Logo with Floating Animation -->
                    <img src="{{ asset('images/decorcom.png') }}" alt="DecorCom Logo" class="w-50 mb-4 animate__animated animate__fadeInDown floating" 
                         style="max-width: 300px;">

                    <!-- Heading -->
                    <h1 class="display-4 fw-bold mb-3 animate__animated animate__fadeIn" 
                        style="color: white; text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.3);">
                        Welcome to DecorCom!
                    </h1>

                    <!-- Subheading -->
                    <p class="lead mb-4 animate__animated animate__fadeIn animate__delay-1s" 
                       style="color: rgba(255, 255, 255, 0.9);">
                        Discover unique handmade decorations from talented artisans.
                    </p>

                    <!-- Divider -->
                    <hr class="my-4 mx-auto animate__animated animate__fadeIn animate__delay-1s" 
                        style="border-color: rgba(255, 255, 255, 0.5); width: 50%;">

                    <!-- Call to Action -->
                    <p class="mb-5 animate__animated animate__fadeIn animate__delay-2s" 
                       style="color: rgba(255, 255, 255, 0.9);">
                        Join us today to explore, buy, or sell beautiful handcrafted decor.
                    </p>

                    <!-- Buttons with Glass Morphism Effect -->
                    <div class="mt-4 d-flex justify-content-center gap-3 animate__animated animate__fadeIn animate__delay-2s">
                        @if (Route::has('login'))
                            <a href="{{ route('login') }}" class="btn btn-lg px-4 py-2 shadow-sm glass-effect" 
                               style="background: rgba(255, 255, 255, 0.2); border: 1px solid rgba(255, 255, 255, 0.3); color: white; backdrop-filter: blur(10px);">
                                <i class="fas fa-sign-in-alt me-2"></i> Login
                            </a>
                        @endif
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="btn btn-lg px-4 py-2 shadow-sm glass-effect" 
                               style="background: rgba(255, 255, 255, 0.2); border: 1px solid rgba(255, 255, 255, 0.3); color: white; backdrop-filter: blur(10px);">
                                <i class="fas fa-user-plus me-2"></i> Register
                            </a>
                        @endif
                        <a href="{{ route('decors.index') }}" class="btn btn-lg px-4 py-2 shadow-sm glass-effect" 
                           style="background: rgba(255, 255, 255, 0.2); border: 1px solid rgba(255, 255, 255, 0.3); color: white; backdrop-filter: blur(10px);">
                            <i class="fas fa-store me-2"></i> Explore Products
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Add Animate.css for animations -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">

<!-- Add Particle.js for dynamic background effects -->
<script src="https://cdn.jsdelivr.net/particles.js/2.0.0/particles.min.js"></script>

<!-- Optional: Add custom CSS for hover effects and animations -->
<style>
    /* Floating Animation for Logo */
    @keyframes float {
        0%, 100% {
            transform: translateY(0);
        }
        50% {
            transform: translateY(-10px);
        }
    }
    .floating {
        animation: float 4s ease-in-out infinite;
    }

    /* Glass Morphism Effect */
    .glass-effect {
        transition: all 0.3s ease;
    }
    .glass-effect:hover {
        background: rgba(255, 255, 255, 0.3) !important;
        border-color: rgba(255, 255, 255, 0.5) !important;
        transform: translateY(-2px);
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.3);
    }

    /* Hero Section Hover Effect */
    .hero-section {
        transition: transform 0.3s ease;
    }
    .hero-section:hover {
        transform: scale(1.02);
    }

    /* Custom Cursor Effect */
    body {
        cursor: url('{{ asset('images/cursor.png') }}'), auto;
    }
</style>

<!-- Initialize Particle.js -->
<script>
    particlesJS.load('particles-js', '{{ asset('particles.json') }}', function() {
        console.log('Particles.js loaded!');
    });
</script>
@endsection