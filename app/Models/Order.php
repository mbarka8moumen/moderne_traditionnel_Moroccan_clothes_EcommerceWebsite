<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', // ID de l'utilisateur qui a passé la commande
        'name',
        'email',
        'phone',
        'city',
        'zipcode',
        'address',
        'status', // État de la commande
    ];

    // Relation avec OrderItem
    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }
    // Modèle Order
    public function calculateTotal($deliveryCharges)
    {
        // Calculer le total en fonction des éléments de commande
        $total = 0;
    
        // Vérifier s'il y a des éléments dans la commande
        if ($this->orderItems->isEmpty()) {
            return $total + $deliveryCharges; // Si aucun élément, retourner uniquement les frais de livraison
        }
    
        // Ajouter le total de chaque article de commande
        foreach ($this->orderItems as $item) {
            $total += $item->quantity * $item->price;
        }
    
        // Ajouter les frais de livraison
        $total += $deliveryCharges;
    
        // Retourner le montant total à payer (total de la commande + frais de livraison)
        return $total;
    }
    

    
    // Relation avec User
    public function user()
    {
        return $this->belongsTo(User::class);
    }
 
    public function getStatusLabelAttribute()
    {
        return match ($this->status) {
            'pending' => '🟠 En attente',
            'paid' => '🟢 Payée',
            'shipped' => '🚚 Expédiée',
            'delivered' => '✅ Livrée',
            default => '❓ Inconnu',
        };
    }
   
}


