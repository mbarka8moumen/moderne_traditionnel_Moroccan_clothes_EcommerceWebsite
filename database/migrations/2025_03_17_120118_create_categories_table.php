<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;


    
    return new class extends Migration {
        public function up()
        {
            Schema::create('categories', function (Blueprint $table) {
                $table->id();
                $table->string('name')->unique(); // Nom de la catégorie
                $table->text('description')->nullable(); // Description optionnelle
                $table->timestamps(); // created_at & updated_at
            });
        }
    
        public function down()
        {
            Schema::dropIfExists('categories');
        }
    };
    
