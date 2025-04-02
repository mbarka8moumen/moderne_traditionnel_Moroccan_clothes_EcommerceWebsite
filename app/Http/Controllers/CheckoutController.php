<?php
namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    public function show()
    {
        // Récupérer les éléments du panier à partir de la session
        $cartItems = session()->get('cart', []);

        // Calculer le montant total du panier
        $totalAmount = 0;
        $deliveryCharges = 5; // Exemple de frais de livraison

        foreach ($cartItems as $item) {
            $totalAmount += $item['total_price']; // Total des produits dans le panier
        }

        // Passer les données à la vue
        return view('checkout', compact('cartItems', 'totalAmount', 'deliveryCharges'));
    }

    public function store(Request $request)
    {
        // Validation des données
        $data = $request->validate([
            'name' => 'required|string',
            'email' => 'required|email',
            'phone' => 'required|string',
            'city' => 'required|string',
            'address' => 'required|string',
            'zipcode' => 'required|string',
        ]);

        // Créer la commande avec les données du formulaire
        $order = Order::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'phone' => $data['phone'],
            'city' => $data['city'],
            'address' => $data['address'],
            'zipcode' => $data['zipcode'],
            'total_amount' => $data['totalAmount'],
            'status' => 'en attente',
            'payment_status' => 'non payé',
        ]);

        // Ajouter les éléments de la commande
        foreach ($cartItems as $item) {
            $order->orderItems()->create([
                'product_id' => $item['product_id'], // Assurez-vous que c'est bien le product_id
                'quantity' => $item['quantity'],
                'price' => $item['price'],
            ]);
        }

        // Vider le panier après la commande
        session()->forget('cart');

        // Rediriger vers la page de détails de la commande
        return redirect()->route('orders.show', ['order' => $order->id]);
    }
}
