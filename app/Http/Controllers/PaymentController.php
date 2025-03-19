<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Stripe\Stripe;
use Stripe\PaymentIntent;
use App\Models\Order;



class PaymentController extends Controller
{
    public function showPaymentForm()
    {
        return view('payment');
    }

    public function processPayment(Request $request)
    {
        // Configuration de Stripe avec la clé API
        Stripe::setApiKey(env('STRIPE_SECRET'));

        // Créer un PaymentIntent avec le montant total de la commande
        $paymentIntent = PaymentIntent::create([
            'amount' => $request->amount, // Montant total à payer
            'currency' => 'usd', // La devise, ici USD, mais tu peux la changer
            'payment_method' => $request->payment_method_id, // Le token de paiement envoyé par le frontend
            'confirmation_method' => 'manual',
            'confirm' => true,
        ]);

        // Vérifier l'état du paiement
        if ($paymentIntent->status == 'succeeded') {
            // Mettre à jour la commande, marquer comme payée
            $order = Order::find($request->order_id);
            $order->status = 'paid';
            $order->save();

            return response()->json([
                'success' => true,
                'message' => 'Payment successful!',
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Payment failed!',
            ]);
        }
    }
}
