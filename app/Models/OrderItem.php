<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    use HasFactory;

    // Propriétés assignables
    protected $fillable = [
        'order_id',   // L'ID de la commande
        'product_name', // Nom du produit
        'quantity',    // Quantité commandée
        'price',       // Prix unitaire
    ];

    // Définir la relation "OrderItem belongs to Order"
    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
