<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        return redirect()->route('admin.manageProducts');
    }

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
}

