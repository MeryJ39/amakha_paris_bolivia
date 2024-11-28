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
        Schema::create('order_items', function (Blueprint $table) {
            $table->id();  // ID del ítem de la orden
            $table->foreignId('order_id')->constrained()->onDelete('cascade');  // Relación con el pedido
            $table->foreignId('product_id')->constrained()->onDelete('cascade');  // Relación con el producto
            $table->integer('quantity');  // Cantidad del producto
            $table->decimal('price_at_purchase', 10, 2);  // Precio en el momento de la compra
            $table->decimal('unit_discount', 10, 2)->default(0);  // Descuento aplicado en ese momento
            $table->decimal('total_at_purchase', 10, 2);  // Total por esa cantidad de producto con el descuento
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_items');
    }
};