<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;

class ModerneController extends Controller
{
    public function index()
    {
        $moderne = Category::where('name', 'Moderne')->first();
        $products = Product::where('category_id', $moderne->id)->get();
        return view('moderne', compact('products'));
    }
}
