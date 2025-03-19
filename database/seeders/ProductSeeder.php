<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Product;
use App\Models\Category;

class ProductSeeder extends Seeder
{
    // database/seeders/ProductSeeder.php


public function run()
{
    // Récupérer les catégories
    $moderneCategory = Category::where('name', 'Moderne')->first();
    $traditionnelCategory = Category::where('name', 'Traditionnel')->first();

    // Créer des produits de test
    Product::create([
        'name' => 'Produit Moderne 1',
        'price' => 99.99,
        'description' => 'Description du produit moderne 1.',
        'stock' => 10,
        'image' => 'images/4.jpg',
        'category_id' => $moderneCategory->id,
    ]);

    Product::create([
        'name' => 'Produit Traditionnel 1',
        'price' => 89.99,
        'description' => 'Description du produit traditionnel 1.',
        'stock' => 15,
        'image' => 'public/images/4.jpg',
        'category_id' => $traditionnelCategory->id,
    ]);
}

}

