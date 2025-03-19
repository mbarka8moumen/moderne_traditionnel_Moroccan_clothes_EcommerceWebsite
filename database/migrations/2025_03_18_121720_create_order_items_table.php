<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;


  
class CreateOrderItemsTable extends Migration
{
    public function up()
    {
        Schema::create('order_items', function (Blueprint $table) {
            $table->id(); // ID de l'article de commande
            $table->foreignId('order_id')->constrained()->onDelete('cascade'); // Référence à la commande
            $table->string('product_name'); // Nom du produit
            $table->integer('quantity'); // Quantité commandée
            $table->decimal('price', 10, 2); // Prix du produit
            $table->timestamps(); // Les timestamps (created_at, updated_at)
        });
    }

    public function down()
    {
        Schema::dropIfExists('order_items');
    }
}
