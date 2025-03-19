@extends('layout')

@section('title', 'Shop - Style & Tradition')

@section('content')

@auth
    <section class="shop" id="shop" style="background-color:#f4f4f4; padding: 50px 0;">
        
        <!-- Section Bienvenue -->
        <h1 class="heading" style="text-align: center; margin-bottom: 30px;">Bienvenue sur Style & Tradition</h1>
        <p class="intro-text" style="text-align: center; font-size: 1.2rem; color: #333; max-width: 600px; margin: 0 auto 30px;">Explorez notre collection diversifiée alliant le meilleur du traditionnel et du moderne. Choisissez votre style préféré et découvrez des pièces uniques qui correspondent à vos goûts.</p>
        
        <!-- Buttons: All, Traditionnel, Moderne -->
        <div class="button-container" style="display: flex; justify-content: center; gap: 15px; margin-bottom: 30px;">
            <a href="{{ route('all') }}">
                <button class="custom-btn">ALL</button>
            </a>
            <a href="{{ route('traditionnel') }}">
                <button class="custom-btn">Traditionnel</button>
            </a>
            <a href="{{ route('moderne') }}">
                <button class="custom-btn">Modern</button>
            </a>
        </div>

    </section>
@else
    <div style="text-align: center; margin-top: 50px;">
        <h2>Veuillez vous connecter pour accéder à notre boutique.</h2>
        <a href="{{ route('login') }}">
            <button class="login-btn">Se connecter</button>
        </a>
    </div>
@endauth

@endsection
