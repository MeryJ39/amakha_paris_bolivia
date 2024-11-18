<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('ratings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Relación con el usuario
            $table->foreignId('product_id')->constrained()->onDelete('cascade'); // Relación con el producto
            $table->integer('rating')->default(0); // Calificación de 1 a 5
            $table->timestamps();

            // Asegurar que un usuario solo pueda calificar un producto una vez
            $table->unique(['user_id', 'product_id']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('ratings');
    }
};
