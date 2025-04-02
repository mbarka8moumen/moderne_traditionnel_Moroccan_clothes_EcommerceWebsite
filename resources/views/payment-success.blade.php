@extends('layout')

@section('title', 'Payment Successful')

@section('content')
    <div class="container">
        <h1>Payment Successful!</h1>
        <p>Thank you for your purchase. Your order has been confirmed.</p>
        <a href="{{ route('home') }}" class="btn btn-primary">Return to Homepage</a>
    </div>
@endsection
