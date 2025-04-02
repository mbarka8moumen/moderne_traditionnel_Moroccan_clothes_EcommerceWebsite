<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Cart;
use App\Models\OrderItem;
use Illuminate\Support\Facades\Auth;
use App\Models\OrderTracking;
;


class OrderController extends Controller
{
   


   
   
    public function store(Request $request)
{
    // Validation des données de la commande
    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|max:255',
        'phone' => 'required|string|max:15',
        'city' => 'required|string|max:100',
        'address' => 'required|string|max:255',
        'zipcode' => 'required|string|max:20',
    ]);

    // Récupérer les éléments du panier
    $cartItems = Cart::all();
    $totalPrice = $cartItems->sum('total_price'); // Montant total des articles dans le panier

    // Ajouter les frais de livraison
    $deliveryCharges = 5.00;
    $totalAmount = $totalPrice + $deliveryCharges; // Montant total incluant la livraison

    // Créer la commande
    $order = Order::create([
        'user_id' => auth()->user()->id,
        'name' => $validated['name'],
        'email' => $validated['email'],
        'phone' => $validated['phone'],
        'city' => $validated['city'],
        'address' => $validated['address'],
        'zipcode' => $validated['zipcode'],
        'status' => 'pending',  // Statut initial de la commande
        'payment_status' => 'paid',  // Exemple de statut de paiement
    ]);

    // Passer les informations à la vue
    return view('payment', compact('order', 'totalAmount', 'deliveryCharges'));
}

    
    // Fonction pour calculer le montant total
    private function calculateTotalAmount($order)
    {
        // Supposons que tu as une relation avec les articles de la commande
        $orderItems = $order->orderItems; // Récupérer les items associés à la commande
        $totalPrice = $orderItems->sum(function ($item) {
            return $item->price * $item->quantity; // Calculer le prix total des items
        });
    
        return $totalPrice;
    }
    
    
    

    
    public function show($id)
    {
        $order = Order::with('orderItems')->findOrFail($id); // Charge la commande avec les éléments associés
        return view('confirmation', compact('order'));
    }
    

    
        // ✅ Afficher la confirmation de la commande
        public function confirmation($orderId)
        {
            $order = Order::findOrFail($orderId);
            return view('confirmation', compact('order'));
        }
        public function payment($orderId)
{
    // Trouver la commande
    $order = Order::findOrFail($orderId);
    
    // Mettre à jour le statut de paiement à "paid"
    $order->payment_status = 'paid';
    $order->save();

    // Rediriger vers une page de confirmation de paiement avec un message de succès
    return redirect()->route('payment-success', $order->id)->with('success', 'Paiement effectué avec succès.');
}
public function paymentSuccess($orderId)
{
    // Trouver la commande
    $order = Order::findOrFail($orderId);
    
    // Retourner la vue de succès avec les informations de la commande
    return view('payment-success', compact('order'));
}


public function cancel($orderId)
{
    // Trouver la commande
    $order = Order::findOrFail($orderId);
    
    // Mettre à jour le statut de la commande à "cancelled"
    $order->status = 'cancelled';
    
    // Mettre à jour le statut de paiement à "cancelled" (si nécessaire)
    $order->payment_status = 'cancelled';
    
    $order->save();
    
    // Rediriger vers la page de confirmation d'annulation avec un message de succès
    return redirect()->route('payment-cancel', $order->id)->with('success', 'Commande annulée avec succès.');
}

        

        public function paymentCancel($orderId)
{
    // Trouver la commande annulée
    $order = Order::findOrFail($orderId);

    // Afficher la vue d'annulation
    return view('payment-cancel', compact('order'));
}

    
        // ✅ Mettre à jour le statut de la commande
        public function updateStatus(Request $request, $orderId)
        {
            $validated = $request->validate([
                'status' => 'required|in:pending,shipped,completed,cancelled'
            ]);
    
            $order = Order::findOrFail($orderId);
            $order->status = $request->status;
            $order->save();
    
            return redirect()->route('order.show', $orderId)->with('success', 'Statut de la commande mis à jour.');
        }
    
        // ✅ Mettre à jour le statut de paiement
        public function updatePaymentStatus($orderId)
        {
            $order = Order::findOrFail($orderId);
            $order->payment_status = 'paid'; // Mettre à jour le statut de paiement
            $order->save();
    
            return redirect()->route('order.show', $orderId)->with('success', 'Paiement effectué avec succès.');
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
        'totalAmount' => $totalAmount,  // Assurer que la variable totalAmount est envoyée à la vue
    ]);

}





public function index()
{
    $orders = Order::with('orderItems')->orderBy('created_at', 'desc')->get();
    return view('orders.index', compact('orders'));
}

    // Afficher le formulaire d'édition de la commande
    public function edit($id)
    {
        $order = Order::findOrFail($id);
        return view('orders.edit', compact('order'));
    }

    // Mettre à jour une commande
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'phone' => 'required|string|max:20',
            'city' => 'required|string|max:255',
            'zipcode' => 'required|string|max:20',
            'address' => 'required|string|max:500',
            'status' => 'required|string', // Ajouter une validation pour le statut
        ]);

        $order = Order::findOrFail($id);
        $order->update($validated);

        return redirect()->route('orders.index')->with('message', 'Commande mise à jour avec succès!');
    }

    // Supprimer une commande
    public function destroy($id)
    {
        $order = Order::findOrFail($id);
        $order->delete();

        return redirect()->route('orders.index')->with('message', 'Commande supprimée avec succès!');
    }


  
    


// Contrôleur
 // Afficher les commandes de l'utilisateur connecté
 public function myOrders()
 {
     // Récupérer les commandes de l'utilisateur connecté avec les éléments de commande associés
     $orders = Order::where('user_id', auth()->id())  // Filtrer par l'utilisateur connecté
                    ->with(['orderItems.product'])  // Charger les produits associés à chaque item de commande
                    ->orderBy('created_at', 'desc')  // Trier les commandes par date
                    ->get();
 
     // Définir les frais de livraison (tu peux les rendre dynamiques si tu le souhaites)
     $deliveryCharges = 5.00;  // Exemple : frais de livraison fixes
 
     // Calculer le total de chaque commande, incluant les frais de livraison
     foreach ($orders as $order) {
         // Utiliser la méthode calculateTotalPayment() pour obtenir le total réel du paiement
         $order->total_payment_amount = $order->calculateTotal($deliveryCharges);  // Total réel avec paiement
     }
 
     // Retourner la vue avec les données des commandes et le montant du paiement
     return view('orders.myOrders', compact('orders', 'deliveryCharges'));
 }
 
 


}

   

