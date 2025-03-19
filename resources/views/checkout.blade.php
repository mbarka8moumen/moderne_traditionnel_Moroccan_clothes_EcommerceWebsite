@extends('layout')

@section('title', 'Checkout')

@section('content')
<section class="checkout" id="checkout">
    <h1 class="heading">Checkout</h1>
    
    <form action="{{ route('checkout') }}" method="POST">
        @csrf
        <fieldset class="checkout-fieldset">
            <legend class="checkout-legend">Customer Information</legend>
            <label class="checkout-label" for="name">Name:</label>
            <input class="checkout-input" type="text" id="name" name="name" required>
            <label class="checkout-label" for="email">Email:</label>
            <input class="checkout-input" type="email" id="email" name="email" required>
            <label class="checkout-label" for="phone">Phone:</label>
            <input class="checkout-input" type="tel" id="phone" name="phone" required>
            <label class="checkout-label" for="city">City:</label>
            <input class="checkout-input" type="text" id="city" name="city" required>
            <label class="checkout-label" for="zipcode">Zipcode:</label>
            <input class="checkout-input" type="text" id="zipcode" name="zipcode" required>
            <label class="checkout-label" for="address">Address:</label>
            <input class="checkout-input" type="text" id="address" name="address" required>
        </fieldset>

        <fieldset class="checkout-fieldset checkout-summary">
            <legend class="checkout-legend">Order Summary</legend>
            <p>total price: <span id="product-price">${{ $totalAmount - 5.00 }}</span></p> <!-- Sans les frais de livraison -->
            <p>Delivery Charges: <span id="delivery-charges">$5.00</span></p>
            <p>Total Amount: <span id="total-amount">{{ $totalAmount }}</span></p>
        </fieldset>

        <button type="submit" class="checkout-button">Proceed to Payment</button>
    </form>
</section>
@endsection
