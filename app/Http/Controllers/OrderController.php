<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Cart;
use App\Models\OrderItem; // Importer la classe OrderItem
 // Importer la classe OrderItem

class OrderController extends Controller
{
    public function store(Request $request)
    {
        // Validation des données envoyées par le formulaire
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'phone' => 'required|string|max:20',
            'city' => 'required|string|max:255',
            'zipcode' => 'required|string|max:20',
            'address' => 'required|string|max:500',
        ]);
    
        // Création de la commande dans la base de données
        $order = new Order();
        $order->name = $validated['name'];
        $order->email = $validated['email'];
        $order->phone = $validated['phone'];
        $order->city = $validated['city'];
        $order->zipcode = $validated['zipcode'];
        $order->address = $validated['address'];
        $order->save();
    
        // Ajouter des articles de la commande en utilisant les éléments du panier
        $cartItems = Cart::all();
        foreach ($cartItems as $cartItem) {
            $orderItem = new OrderItem();
            $orderItem->order_id = $order->id; // Relier l'article à la commande
            $orderItem->product_name = $cartItem->product->name; // Nom du produit (à adapter selon ton modèle)
            $orderItem->quantity = $cartItem->quantity;
            $orderItem->price = $cartItem->total_price; // Le prix de l'article
            $orderItem->save();
        }
    
        // Rediriger vers la confirmation avec l'ID de la commande
        return redirect()->route('payment')->with('message', 'Commande réussie!');
    }

    public function showCheckoutForm()
    {
        // Récupérer les éléments du panier
        $cartItems = Cart::all();
    
        // Calculer le total du panier
        $totalPrice = $cartItems->sum('total_price');
    
        // Ajouter les frais de livraison
        $deliveryCharges = 5.00;
        $totalAmount = $totalPrice + $deliveryCharges;
    
        return view('checkout', [
            'cartItems' => $cartItems,
            'totalPrice' => $totalPrice,
            'deliveryCharges' => $deliveryCharges,
            'totalAmount' => $totalAmount,
        ]);
    }

    public function confirmation()
    {
        // Récupérer toutes les commandes
        $orders = Order::all();

        return view('confirmation', [
            'orders' => $orders,
        ]);
    }
}
