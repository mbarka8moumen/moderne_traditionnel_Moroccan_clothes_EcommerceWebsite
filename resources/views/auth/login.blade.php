@extends('layout')

@section('title', 'Login - Tradition & Style')

@section('content')
<div class="auth-container">
    <div class="auth-box">
        <h2 class="auth-title">Login</h2>

        <!-- Affichage des erreurs -->
        @if ($errors->any())
            <div class="auth-error">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('login.post') }}" method="POST" class="auth-form">
            @csrf
            <div class="auth-input">
                <label for="email"></label>
                <input type="email" id="email" name="email" placeholder="Your email" required value="{{ old('email') }}">
                @error('email')
                    <div class="auth-error">{{ $message }}</div>
                @enderror
            </div>
            <div class="auth-input">
                <label for="password"></label>
                <input type="password" id="password" name="password" placeholder="Your password" required>
                @error('password')
                    <div class="auth-error">{{ $message }}</div>
                @enderror
            </div>
            <button type="submit" class="auth-btn">Log In</button>
        </form>
        <p class="auth-footer">Don't have an account yet? <a href="{{ route('register') }}">Sign up here</a></p>
    </div>
</div>
@endsection
