@extends('layout')

@section('title', 'Shop - Style & Tradition')

@section('content')

@auth
    <section class="shop" id="shop" style="background-color:#f4f4f4; padding: 50px 0;">
        
        <!-- Welcome Section -->
        <h1 class="heading" style="text-align: center; margin-bottom: 30px;">Welcome to Style & Tradition</h1>
        <p class="intro-text" style="text-align: center; font-size: 1.2rem; color: #333; max-width: 600px; margin: 0 auto 30px;">Explore our diverse collection blending the best of traditional and modern styles. Choose your favorite and discover unique pieces that match your taste.</p>
        
        <!-- Buttons: All, Traditional, Modern -->
        <div class="button-container" style="display: flex; justify-content: center; gap: 15px; margin-bottom: 30px;">
            <a href="{{ route('all') }}">
                <button class="custom-btn">ALL</button>
            </a>
            <a href="{{ route('traditionnel') }}">
                <button class="custom-btn">Traditional</button>
            </a>
            <a href="{{ route('moderne') }}">
                <button class="custom-btn">Modern</button>
            </a>
        </div>

    </section>
@else
    <div style="text-align: center; margin-top: 50px;">
        <h2>Please log in to access our shop.</h2>
        <a href="{{ route('login') }}">
            <button class="login-btn">Log In</button>
        </a>
    </div>
@endauth

@endsection
