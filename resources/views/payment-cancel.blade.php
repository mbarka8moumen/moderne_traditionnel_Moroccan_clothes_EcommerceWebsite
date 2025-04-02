@extends('layout')

@section('title', 'Payment Canceled')

@section('content')
    <div class="container">
        <h1>Payment Canceled</h1>
        <p>Your order has been canceled. If you have any questions, please contact us.</p>
        <a href="{{ route('home') }}" class="btn btn-primary">Return to Homepage</a>
    </div>
@endsection
