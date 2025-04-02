@extends('layout')

@section('content')
<div class="container">
    <h2>My Orders</h2>

    @if($orders->isEmpty())
        <p>You haven't placed any orders yet.</p>
    @else
        @foreach($orders as $order)
        <div class="order-box" style="
            border: 1px solid #ddd;
            padding: 20px;
            margin-bottom: 15px;
            background-color: 
                @if($order->status == 'completed') #d4edda;
                @elseif($order->status == 'pending') #fff3cd;
                @elseif($order->status == 'cancelled') #f8d7da;
                @else #f9f9f9;
                @endif
            border-radius: 8px;
        ">
            <h3>Order #{{ $order->id }}</h3>
            <p><strong>Order Date:</strong> {{ $order->created_at->format('d/m/Y') }}</p>
            <p><strong>Order Status:</strong> 
                @if($order->status == 'completed')
                    <span style="color: green;">Completed</span>
                @elseif($order->status == 'pending')
                    <span style="color: orange;">Pending</span>
                @elseif($order->status == 'cancelled')
                    <span style="color: red;">Cancelled</span>
                @else
                    <span>Unknown</span>
                @endif
            </p>
            <p><strong>Payment Status:</strong> 
                @if($order->payment_status)
                    <span style="color: green;">{{ $order->payment_status }}</span>
                @else
                    <span style="color: gray;">Unpaid</span>
                @endif
            </p>
        </div>
        @endforeach
    @endif
</div>
@endsection
