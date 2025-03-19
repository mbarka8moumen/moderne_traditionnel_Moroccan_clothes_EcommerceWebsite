@extends('layout')

@section('title', 'Sign Up - Tradition & Style')

@section('content')
<div class="auth-container">
    <div class="auth-box">
        <h2 class="auth-title">Create an Account</h2>

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

        <form action="{{ route('register.post') }}" method="POST" class="auth-form">
            @csrf
            <div class="auth-input">
                <label for="name"></label>
                <input type="text" id="name" name="name" placeholder="Your name" required value="{{ old('name') }}">
                @error('name')
                    <div class="auth-error">{{ $message }}</div>
                @enderror
            </div>
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
            <div class="auth-input">
                <label for="password_confirmation"></label>
                <input type="password" id="password_confirmation" name="password_confirmation" placeholder="Confirm your password" required>
                @error('password_confirmation')
                    <div class="auth-error">{{ $message }}</div>
                @enderror
            </div>
            <button type="submit" class="auth-btn">Sign Up</button>
        </form>
        <p class="auth-footer">Already have an account? <a href="{{ route('login') }}">Log in here</a></p>
    </div>
</div>
@endsection
