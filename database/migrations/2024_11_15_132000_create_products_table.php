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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Nombre del producto
            $table->text('description')->nullable(); // Descripción del producto
            $table->decimal('price', 10, 2); // Precio del producto
            $table->integer('stock')->default(0); // Stock disponible del producto
            $table->string('image')->nullable(); // Imagen del producto (ruta de la imagen)
            $table->foreignId('subcategory_id')->constrained('subcategories')->onDelete('cascade'); // Relación con la subcategoría
            $table->timestamps(); // Fechas de creación y actualización
        });
    }

    public function down()
    {
        Schema::dropIfExists('products');
    }
};