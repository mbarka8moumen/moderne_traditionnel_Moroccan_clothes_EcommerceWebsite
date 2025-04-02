@extends('layout')

@section('title', 'Your Cart')

@section('content')
<link rel="stylesheet" href="{{ asset('css/cart.css') }}">

<section class="cart" id="cart">
    <h1 class="heading">Your Cart</h1>

    @if($cartItems->isEmpty())
        <p class="empty-cart">Your cart is empty!</p>
    @else
        <div class="cart-items">
            @foreach ($cartItems as $cartItem)
                <div class="cart-item">
                    <div class="cart-item-image-container">
                        <img src="{{ asset('storage/' . $cartItem->product->image) }}" alt="{{ $cartItem->product->name }}" class="cart-item-image">
                    </div>
                    <div class="cart-item-details">
                        <h3 class="cart-item-name">{{ $cartItem->product->name }}</h3>
                        <p class="cart-item-quantity">Quantity: <span>{{ $cartItem->quantity }}</span></p>
                        <p class="cart-item-price">Price: ${{ $cartItem->total_price }}</p>

                        <form action="{{ route('cart.remove', $cartItem->product->id) }}" method="POST" class="remove-form">
                            @csrf
                            <button type="submit" class="remove-btn">Remove</button>
                        </form>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="cart-footer">
            <a href="{{ route('checkout') }}" class="checkout-btn">Proceed to Checkout</a>
        </div>
    @endif
</section>

@endsection


