@extends('layout')

@section('title', 'Traditional')

@section('content')
    <section class="shop" id="shop">
        <h1 class="heading" style="margin-bottom: 5px;">Traditional</h1>

        <!-- Boutons de filtre -->
        <div class="button-container" style="display: flex; justify-content: center; gap: 10px; margin-bottom: 15px;">
            <a href="{{ route('all') }}"><button class="custom-btn" style="background-color: #808080; color: white; padding: 8px 16px; border: none; border-radius: 5px; cursor: pointer;">All</button></a>

            <a href="{{ route('traditionnel') }}"><button class="custom-btn" style="background-color: #808080; color: white; padding: 8px 16px; border: none; border-radius: 5px; cursor: pointer;">Traditional</button></a>
            <a href="{{ route('moderne') }}"><button class="custom-btn" style="background-color: #808080; color: white; padding: 8px 16px; border: none; border-radius: 5px; cursor: pointer;margin-bottom: 20px;">Modern</button></a>
        </div>

        <!-- Affichage des produits traditionnels -->
        <div class="box-container" id="product-list">
            @foreach ($products as $product)
                <div class="box" data-id="{{ $product->id }}" data-name="{{ $product->name }}" data-price="{{ $product->price }}" data-description="{{ $product->description }}" data-stock="{{ $product->stock }}">
                    <img src="{{ asset('storage/' . $product->image) }}" alt="Image de {{ $product->name }}">
                    <div class="content">
                        <h3>{{ $product->name }}</h3>
                        <p>{{ $product->description }}</p>
                        <p><span class="price">${{ $product->price }}</span> <span class="original-price">${{ $product->original_price }}</span></p>
                        
                        <!-- Formulaire pour ajouter au panier -->
                        <form action="{{ route('cart.add', $product->id) }}" method="POST">
                            @csrf
                            <button type="submit" class="btn">Add to Cart</button>
                        </form>

                        <p>Stock: <span class="stock">{{ $product->stock }}</span></p>
                    </div>
                </div>
            @endforeach
        </div>
    </section>
@endsection
