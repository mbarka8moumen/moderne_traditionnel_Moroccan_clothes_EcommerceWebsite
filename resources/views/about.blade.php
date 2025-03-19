@extends('layout')

@section('title', 'About Us')

@section('content')

@guest
    <script>window.location.href = "{{ route('login') }}";</script>
@else
    <!-- About section starts -->
    <section class="about" id="about">
        <h1 class="heading">About Us</h1>
        <div class="content">
            <div class="image" style="margin-bottom:80px;">
                <img src="{{ asset('images/about-img.png') }}" alt="About Tradition & Style">
            </div>
            <div class="text">
                <p>Tradition & Style is a brand dedicated to men's fashion, combining the elegance of traditional clothing with the modernity of contemporary style. We offer collections that strike the perfect balance between cultural heritage and current trends.</p>
                <p>We believe that fashion is much more than just a clothing choice—it’s a means to express one's identity and personal style. Every piece we select is designed to provide comfort, quality, and distinction.</p>
                <p>For any questions or further information, please do not hesitate to contact us.</p>
            </div>
        </div>
    </section>
@endguest

@endsection
