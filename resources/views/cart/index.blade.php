<!-- resources/views/cart.blade.php -->

@extends('layout')

@section('title', 'Your Cart')

@section('content')
<section class="cart" id="cart">
    <h1 class="heading">Your Cart</h1>

    @if($cartItems->isEmpty())
        <p>Your cart is empty!</p>
    @else
        <div class="cart-items">
            @foreach ($cartItems as $cartItem)
                <div class="cart-item">
                    <img src="{{ asset('storage/images/' . $cartItem->product->image) }}" alt="{{ $cartItem->product->name }}">
                    <div class="cart-item-details">
                        <h3>{{ $cartItem->product->name }}</h3>
                        <p>Quantity: {{ $cartItem->quantity }}</p>
                        <p>Price: ${{ $cartItem->total_price }}</p>

                        <form action="{{ route('cart.remove', $cartItem->product->id) }}" method="POST">
                            @csrf
                            <button type="submit" class="remove-btn">Remove</button>
                        </form>
                    </div>
                </div>
            @endforeach
        </div>
        <a href="{{ route('checkout') }}" class="checkout-btn">Proceed to Checkout</a>
    @endif
</section>
@endsection
