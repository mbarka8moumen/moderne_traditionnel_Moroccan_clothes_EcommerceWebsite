<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Relation avec User
            $table->string('name');
            $table->string('email');
            $table->string('phone');
            $table->string('city');
            $table->string('zipcode');
            $table->string('address');
            $table->string('status')->default('en attente'); // Ajout du statut de commande
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('orders');
    }
};
