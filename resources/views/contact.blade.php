@extends('layout')

@section('title', 'Contact')

@section('content')

@guest
    <script>window.location.href = "{{ route('login') }}";</script>
@else
<section class="contact" id="contact">
    <div class="container">
        <h1 class="heading">Contactez-nous</h1>

        @if(session('success'))
            <script>
                Swal.fire({
                    title: "Message Envoyé !",
                    text: "{{ session('success') }}",
                    icon: "success",
                    confirmButtonText: "OK",
                    timer: 5000,
                    timerProgressBar: true
                });
            </script>
        @endif

        <div class="box-container">
            <div class="box contact-info">
                <h3>Nos Coordonnées</h3>
                <p>Nous sommes là pour vous aider. Contactez-nous pour toute question.</p>
                <p><i class="fas fa-phone"></i> +2126528631</p>
                <p><i class="fas fa-envelope"></i> TraditionStyle.com</p>
            </div>
            <div class="box follow-us">
                <h3>Suivez-nous</h3>
                <div class="share">
                    <a href="#" class="fab fa-facebook-f"></a>
                    <a href="#" class="fab fa-twitter"></a>
                    <a href="#" class="fab fa-instagram"></a>
                    <a href="#" class="fab fa-linkedin"></a>
                </div>
            </div>
            <div class="box contact-form">
                <h3>Envoyez-nous un message</h3>
                <form action="{{ route('contact.store') }}" method="POST">
                    @csrf
                    <input type="text" name="name" placeholder="Votre nom" required value="{{ old('name') }}">
                    <input type="email" name="email" placeholder="Votre email" required value="{{ old('email') }}">
                    <input type="tel" name="phone" placeholder="Votre numéro de téléphone" required value="{{ old('phone') }}">
                    <textarea name="message" rows="5" placeholder="Votre message" required>{{ old('message') }}</textarea>
                    <button type="submit" class="btn">Envoyer</button>
                </form>
            </div>
        </div>
    </div>
</section>
@endguest

@endsection
