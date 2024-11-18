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
        Schema::create('cart_items', function (Blueprint $table) {
            $table->id(); // ID del ítem en el carrito
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Relación con el usuario
            $table->foreignId('product_id')->constrained()->onDelete('cascade'); // Relación con el producto
            $table->integer('quantity')->default(1); // Cantidad del producto
            $table->decimal('price', 10, 2); // Precio del producto
            $table->decimal('unit_discount', 10, 2)->default(0); // Descuento unitario en dinero
            $table->timestamps(); // Fecha de creación y actualización
        });
    }

    public function down()
    {
        Schema::dropIfExists('cart_items');
    }
};