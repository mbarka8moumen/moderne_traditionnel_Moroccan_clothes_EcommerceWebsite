@extends('layout')

@section('title', 'Tous les Produits')

@section('content')
    <section class="shop" id="shop">
        <h1 class="heading" style="text-align: center; margin-bottom: 5px;">Our Collection</h1>
        <div class="button-container" style="display: flex; justify-content: center; gap: 10px; margin-bottom: 15px;">
            <a href="{{ route('all') }}"><button class="custom-btn" style="background-color: #808080; color: white; padding: 8px 16px; border: none; border-radius: 5px; cursor: pointer;">All</button></a>
            <a href="{{ route('traditionnel') }}"><button class="custom-btn" style="background-color: #808080; color: white; padding: 8px 16px; border: none; border-radius: 5px; cursor: pointer;">Traditional</button></a>
            <a href="{{ route('moderne') }}"><button class="custom-btn" style="background-color: #808080; color: white; padding: 8px 16px; border: none; border-radius: 5px; cursor: pointer;margin-bottom: 20px;">Modern</button></a>
        </div>
        
        <div class="box-container">
            @foreach ($products as $product)
                <div class="product">
                    <img src="{{ asset('images/' . $product->image) }}" alt="{{ $product->name }}">
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
