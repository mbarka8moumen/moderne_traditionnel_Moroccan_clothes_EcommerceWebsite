<!-- resources/views/confirmation.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Confirmation - Tradition & Style</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</head>
<body class="confirmation-body">
    <div class="confirmation-container">
        <h1 class="confirmation-heading">Order Confirmation</h1>

        <!-- Vérification si des commandes existent -->
        @if($orders->isEmpty())
            <p>No orders found!</p>
        @else
            @foreach($orders as $order)
                <div class="confirmation-details">
                    <h3>Customer Information:</h3>
                    <p><strong>Name:</strong> {{ $order->name }}</p>
                    <p><strong>Email:</strong> {{ $order->email }}</p>
                    <p><strong>Phone:</strong> {{ $order->phone }}</p>
                    <p><strong>Address:</strong> {{ $order->address }}, {{ $order->city }}, {{ $order->zipcode }}</p>

                    <h3>Order Summary:</h3>
                    @foreach($order->orderItems as $item)
                        <p><strong>Product Name:</strong> {{ $item->product_name }}</p>
                        <p><strong>Quantity:</strong> {{ $item->quantity }}</p>
                        <p><strong>Price:</strong> ${{ $item->price }}</p>
                    @endforeach
                    <p><strong>Total Price:</strong> ${{ $order->orderItems->sum('price') }}</p>

                    <p><strong>Delivery Charges:</strong> $5.00</p>
                    <p><strong>Total Amount:</strong> ${{ $order->orderItems->sum('price') + 5.00 }}</p>
                </div>
                <hr>
            @endforeach
        @endif

        <div class="confirmation-actions">
            <a href="{{ route('checkout') }}" class="confirmation-button">Edit Order</a>
            <a href="{{ route('payment') }}" class="confirmation-button">Confirm and Pay</a>
        </div>
    </div>

</body>
</html>
