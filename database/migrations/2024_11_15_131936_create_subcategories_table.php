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
        Schema::create('subcategories', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Nombre de la subcategoría
            $table->text('description')->nullable(); // Descripción de la subcategoría
            $table->foreignId('category_id')->constrained('categories')->onDelete('cascade'); // Relación con la categoría principal
            $table->timestamps(); // Fechas de creación y actualización
        });
    }

    public function down()
    {
        Schema::dropIfExists('subcategories');
    }
};