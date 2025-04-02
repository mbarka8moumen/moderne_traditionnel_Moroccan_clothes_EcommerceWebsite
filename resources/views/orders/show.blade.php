@extends('layout')

@section('content')
<div class="container">
    <h2>Détails de la commande #{{ $order->id }}</h2>
    
    <p><strong>Nom :</strong> {{ $order->name }}</p>
    <p><strong>Email :</strong> {{ $order->email }}</p>
    <p><strong>Total :</strong> {{ $order->total_amount }} €</p>
    <p><strong>Statut :</strong> {{ $order->status }}</p>
    <p><strong>Paiement :</strong> {{ $order->payment_status }}</p>
    
    <h3>Produits commandés</h3>
    <table class="table">
        <thead>
            <tr>
                <th>Produit</th>
                <th>Quantité</th>
                <th>Prix</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($order->orderItems as $item)
                <tr>
                    <td>{{ $item->product_name }}</td>
                    <td>{{ $item->quantity }}</td>
                    <td>{{ $item->price }} €</td>
                    <td>{{ $item->total_price }} €</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <h4>Total général : {{ $order->total_amount }} €</h4>
    <a href="{{ route('orders.index') }}" class="btn btn-secondary">Retour à la liste des commandes</a>
</div>
@endsection
