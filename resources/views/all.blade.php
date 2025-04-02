@extends('layout')

@section('title', 'Tous les Produits')

@section('content')
    <section class="shop" id="shop">
        <h1 class="heading">Our Collection</h1>

        <!-- Boutons de filtre -->
        <div class="button-container">
            <a href="{{ route('all') }}"><button class="custom-btn">All</button></a>
            <a href="{{ route('traditionnel') }}"><button class="custom-btn">Traditional</button></a>
            <a href="{{ route('moderne') }}"><button class="custom-btn">Modern</button></a>
        </div>
        
        <!-- Affichage des produits -->
        <div class="box-container">
            @foreach ($products as $product)
                <div class="product">
                    <img class="product-image" src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}">
                    <h3>{{ $product->name }}</h3>
                    <p>{{ $product->description }}</p>
                    <span>{{ $product->price }}$</span>
                    <form action="{{ route('cart.add', $product->id) }}" method="POST">
                        @csrf
                        <button type="submit" class="btn">Add to Cart</button>
                    </form>
                </div>
            @endforeach
        </div>
    </section>
@endsection
