<?php
namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    // Liste des produits
    public function index()
    {
        $products = Product::with('category')->get();
        return view('products.index', compact('products'));
    }

    // Formulaire d'ajout
    public function create()
    {
        $categories = Category::all();
        return view('products.create', compact('categories'));
    }

    // Sauvegarde d'un produit
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'description' => 'nullable|string',
            'stock' => 'required|integer',
            'category_id' => 'required|exists:categories,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('products', 'public');
            $validatedData['image'] = $imagePath;
        }

        Product::create($validatedData);

        return redirect()->route('products.index')->with('success', 'Produit ajouté avec succès.');
    }

    // Formulaire d'édition
    public function edit($id)
    {
        $product = Product::findOrFail($id);
        $categories = Category::all();
        return view('products.edit', compact('product', 'categories'));
    }

    // Mise à jour du produit
    public function update(Request $request, $id)
    {
        // Trouver le produit à mettre à jour
        $product = Product::findOrFail($id);

        // Validation des champs
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'category_id' => 'required|exists:categories,id',
            'stock' => 'required|integer',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Gérer l’image (si une nouvelle est téléchargée)
        if ($request->hasFile('image')) {
            // Supprimer l'ancienne image s'il y en a une
            if ($product->image) {
                if (file_exists(storage_path('app/public/'.$product->image))) {
                    unlink(storage_path('app/public/'.$product->image));
                }
            }
            $imagePath = $request->file('image')->store('products', 'public');
            $validatedData['image'] = $imagePath;
        }

        // Mise à jour du produit
        $product->update($validatedData);

        return redirect()->route('products.index')->with('success', 'Produit mis à jour avec succès !');
    }

    // Suppression du produit
    public function destroy($id)
    {
        $product = Product::find($id);
    
        if ($product) {
            // Supprimer le produit
            $product->delete();
    
            // Retourner une réponse JSON de succès
            return response()->json(['success' => true]);
        } else {
            // Si le produit n'est pas trouvé, retourner une réponse JSON d'erreur
            return response()->json(['success' => false]);
        }
    }
    
}
