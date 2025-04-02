@extends('layout')

@section('content')
<div class="container">
<h2>Order #{{ $order->id }}</h2>
<h4>Total: €{{ number_format($totalAmount, 2) }} (including €{{ number_format($deliveryCharges, 2) }} for delivery)</h4>

    <form action="{{ route('payment', $order->id) }}" method="POST">
        @csrf
        <button type="submit" class="btn btn-success">Confirm Payment</button>
    </form>
    <form action="{{ route('cancel', $order->id) }}" method="POST" style="display:inline;">
    @csrf
    <button type="submit" class="btn btn-danger">Cancel Order</button>
</form>
</div>
@endsection
