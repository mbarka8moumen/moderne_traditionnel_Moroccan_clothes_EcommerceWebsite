@extends('layout')

@section('content')
<link rel="stylesheet" href="{{ asset('css/checkout.css') }}">

<div class="container">
    <h2>Place Order</h2>

    <div class="order-summary">
        @foreach ($cartItems as $item)
            <div class="order-item">
                <p><strong>Product:</strong> {{ $item->product->name }}</p>
                <p><strong>Quantity:</strong> {{ $item->quantity }}</p>
                <p><strong>Unit Price:</strong> {{ $item->product->price }} €</p>
                <p><strong>Total:</strong> {{ $item->quantity * $item->product->price }} €</p>
            </div>
            <hr> <!-- Separation line -->
        @endforeach
    </div>

    <h4>Total: {{ $totalAmount }} € (Including {{ $deliveryCharges }} € Delivery Charges)</h4>

    <form action="{{ route('orders.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input type="text" class="form-control" name="name" required>
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" name="email" required>
        </div>
        <div class="mb-3">
            <label for="phone" class="form-label">Phone</label>
            <input type="text" class="form-control" name="phone" required>
        </div>
        <div class="mb-3">
            <label for="city" class="form-label">City</label>
            <input type="text" class="form-control" name="city" required>
        </div>
        <div class="mb-3">
            <label for="address" class="form-label">Address</label>
            <input type="text" class="form-control" name="address" required>
        </div>
        <div class="mb-3">
            <label for="zipcode" class="form-label">Zip Code</label>
            <input type="text" class="form-control" name="zipcode" required>
        </div>
        <button type="submit" class="btn btn-primary">Place Order</button>
    </form>
</div>
@endsection
