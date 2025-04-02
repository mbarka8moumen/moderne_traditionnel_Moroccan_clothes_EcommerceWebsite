<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    // Ajouter un produit au panier
    public function addToCart($id)
    {
        $product = Product::findOrFail($id);
        $userId = Auth::id(); // Récupérer l'ID de l'utilisateur connecté

        $cartItem = Cart::where('user_id', $userId)->where('product_id', $id)->first();

        if ($cartItem) {
            // Si le produit est déjà dans le panier, on incrémente la quantité
            $cartItem->quantity += 1;
            $cartItem->total_price = $cartItem->quantity * $product->price;
            $cartItem->save();
        } else {
            // Ajouter un nouvel article au panier
            Cart::create([
                'user_id' => $userId,
                'product_id' => $id,
                'quantity' => 1,
                'total_price' => $product->price
            ]);
        }

        return redirect()->route('cart.index')->with('success', 'Produit ajouté au panier.');
    }

    // Afficher le panier de l'utilisateur connecté
    public function index()
    {
        $userId = Auth::id();
        $cartItems = Cart::where('user_id', $userId)->get();
        $totalPrice = $cartItems->sum('total_price');

        return view('cart.index', compact('cartItems', 'totalPrice'));
    }

    // Supprimer un article du panier
    public function removeFromCart($id)
    {
        $userId = Auth::id();
        Cart::where('user_id', $userId)->where('product_id', $id)->delete();

        return redirect()->route('cart.index')->with('success', 'Produit supprimé du panier.');
    }

    // Vider complètement le panier
    public function clearCart()
    {
        $userId = Auth::id();
        Cart::where('user_id', $userId)->delete();

        return redirect()->route('cart.index')->with('success', 'Panier vidé.');
    }
}
