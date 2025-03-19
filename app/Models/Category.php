<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    // Les champs autorisés à l'assignation en masse
    protected $fillable = ['name', 'description'];

    /**
     * Relation: Une catégorie peut avoir plusieurs produits
     */
    public function products()
    {
        return $this->hasMany(Product::class);  // Une catégorie a plusieurs produits
    }
}
