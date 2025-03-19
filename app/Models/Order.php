<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    // Définir la relation "Order has many OrderItems"
    public function orderItems()
    {
        return $this->hasMany(OrderItem::class); // Assurez-vous que le modèle OrderItem est correctement défini
    }
}
