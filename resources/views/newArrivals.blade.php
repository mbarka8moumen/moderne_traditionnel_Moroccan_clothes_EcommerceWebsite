@extends('layout')

@section('title', 'New Arrivals')

@section('content')

@guest
    <script>window.location.href = "{{ route('login') }}";</script>
@else
<section class="new-arrivals" id="new-arrivals">
    <h1 class="heading">New Arrivals</h1>
    <div class="box-container">
        <div class="box">
            <img src="{{ asset('images/assets/Modern/2.png') }}" alt="">
            <a href="{{ route('shop') }}" class="btn"> Heritage Luxe</a>
            <p>Timeless craftsmanship with a fresh, contemporary twist.</p>
        </div>
        <div class="box">
            <img src="{{ asset('images/assets/Modern/img12.jpg') }}" alt="">
            <a href="{{ route('shop') }}" class="btn">Eastern Elegance</a>
            <p>Refined tradition with a stylish modern feel.</p>
        </div>
        <div class="box">
            <img src="{{ asset('images/assets/Modern/img10.jpg') }}" alt="">
            <a href="{{ route('shop') }}" class="btn"> Classic Essence</a>
            <p>Inspired by the past, designed for the present.</p>
        </div>
        <div class="box">
            <img src="{{ asset('images/Linen Crep blend Thobe Moroccan.jpeg') }}" alt="">
            <a href="{{ route('shop') }}" class="btn"> Modern Tradition</a>
            <p>Where cultural heritage meets today’s fashion</p>
        </div>
        <div class="box">
            <img src="{{ asset('images/assets/Modern/img13.jpg') }}" alt="">
            <a href="{{ route('shop') }}" class="btn"> Timeless Heritage</a>
            <p>Classic elegance with a contemporary touch.</p>
        </div>
        <div class="box">
            <img src="{{ asset('images/assets/traditionnal/Moroccan Jabador.jpeg') }}" alt="">
            <a href="{{ route('shop') }}" class="btn">Royal Grace</a>
            <p>A fusion of traditional luxury and modern sophistication.</p>
        </div>
    </div>
</section>
@endguest

@endsection
