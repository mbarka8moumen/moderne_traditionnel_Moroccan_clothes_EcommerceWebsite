<?php
namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Order; // Assurez-vous d'importer le modèle Order
use Illuminate\Http\Request;

class AdminController extends Controller
{
    // Méthode index qui redirige vers la gestion des produits
    public function index()
    {
        return redirect()->route('admin.manageProducts');
    }

    // Gérer les produits
    public function manageProducts()
    {
        // Vérifier si l'utilisateur est authentifié et est un admin
        if (!auth()->check() || !auth()->user()->isAdmin()) {
            abort(403, 'Accès interdit');
        }

        // Récupérer tous les produits
        $products = Product::all();

        return view('admin.products', compact('products'));
    }

    // Gérer les commandes
   
        public function manageOrders()
{
    // Vérifie si l'utilisateur est authentifié et est un admin
    if (!auth()->check() || !auth()->user()->isAdmin()) {
        abort(403, 'Accès interdit');
    }

    // Récupérer toutes les commandes avec les articles associés
    $orders = Order::with('orderItems')->get();

    return view('orders.index', compact('orders'));
}

public function viewOrder($id)
{
    // Vérifie si l'utilisateur est authentifié et est un admin
    if (!auth()->check() || !auth()->user()->isAdmin()) {
        abort(403, 'Accès interdit');
    }

    // Récupérer la commande avec ses items
    $order = Order::with('orderItems')->findOrFail($id);

    return view('orders.view', compact('order'));}
}
