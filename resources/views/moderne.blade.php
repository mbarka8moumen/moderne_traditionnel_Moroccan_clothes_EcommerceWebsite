@extends('layout')

@section('title', 'Modern')

@section('content')
    <section class="shop" id="shop">
        <h1 class="heading" style="margin-bottom: 5px;">Modern</h1>

        <div class="button-container" style="display: flex; justify-content: center; gap: 10px; margin-bottom: 15px;">
            <a href="{{ route('all') }}"><button class="custom-btn">All</button></a>
            <a href="{{ route('traditionnel') }}"><button class="custom-btn">Traditional</button></a>
            <a href="{{ route('moderne') }}"><button class="custom-btn">Modern</button></a>
        </div>

        <div class="box-container" id="product-list">
            @foreach ($products as $product)
                <div class="box">
                    <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}">
                    <div class="content">
                        <h3>{{ $product->name }}</h3>
                        <p>{{ $product->description }}</p>
                        <p><span class="price">${{ $product->price }}</span></p>

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
