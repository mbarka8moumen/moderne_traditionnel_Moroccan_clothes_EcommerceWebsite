@extends('layout')

@section('content')
<div class="container">
    <h2>Order Confirmation</h2>
    <p>Thank you for your order, {{ $order->name }}!</p>
    <p>Order Number: <strong>#{{ $order->id }}</strong></p>
    <p>Total Amount: <strong>{{ $order->total_amount+5 }} €</strong></p>

    <a href="{{ route('orders.index') }}" class="btn btn-primary">View My Orders</a>
</div>
@endsection
