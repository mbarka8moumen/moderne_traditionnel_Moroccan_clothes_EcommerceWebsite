<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;
use App\Models\CartItem;


class TraditionnelController extends Controller
{
    public function index()
    {
        $traditionnel = Category::where('name', 'Traditionnel')->first();
        $products = Product::where('category_id', $traditionnel->id)->get();
        return view('traditionnel', compact('products'));
    }
}