@extends('layout')

@section('title', 'Home - Tradition & Style')

@section('content')
    <!-- Home section starts -->
    <section class="home" id="home">
        <div class="content">
            <a href="{{ route('shop') }}" class="btn">Shop Now</a>
        </div>
    </section>
    <!-- Home section ends -->

    <!-- Blog section starts -->
    <section class="blog" id="blog">
        <h1 class="heading">From Our Blog</h1>
        <div class="box-container">
            <div class="box">
                <img src="{{ asset('images/1.jfif') }}" alt="Blog 1">
                <div class="content">
                    <h3>Style Tips for Every Season</h3>
                    <p>Discover our tips to stay stylish and comfortable during summer. The latest trends and must-follow fashion advice!</p>
                    <span>by admin / 21st June, 2024</span>
                    <a href="#" class="btn">Read More</a>
                </div>
            </div>
            <div class="box">
                <img src="{{ asset('images/4.jpg') }}" alt="Blog 2">
                <div class="content">
                    <h3>Latest Men's Fashion Trends</h3>
                    <p>Stay updated with the newest trends in men's fashion. Check out our blog for style tips and fashion insights.</p>
                    <span>by admin / 10th August, 2024</span>
                    <a href="#" class="btn">Read More</a>
                </div>
            </div>

            <div class="box">
                <img src="{{ asset('images/jlaba.jpeg') }}" alt="Blog 3">
                <div class="content">
                    <h3>Elegance in Traditional Wear</h3>
                    <p>Learn how to mix traditional clothing with a modern touch for a sophisticated look suitable for any occasion.</p>
                    <span>by admin / 5th July, 2024</span>
                    <a href="#" class="btn">Read More</a>
                </div>
            </div>
        </div>
    </section>
    <!-- Blog section ends -->
@endsection
