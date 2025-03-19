<?php

namespace App\Http\Controllers;

use App\Models\Product;

class AllController extends Controller
{
    public function index()
    {
        // Récupérer tous les produits
        $products = Product::all();

        // Passer les produits à la vue
        return view('all', compact('products'));
    }
}
