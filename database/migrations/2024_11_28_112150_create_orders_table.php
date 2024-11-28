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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();  // ID del pedido
            $table->foreignId('user_id')->constrained()->onDelete('cascade');  // Relación con el usuario
            $table->foreignId('address_id')->constrained()->onDelete('cascade');  // Relación con la dirección de envío
            $table->string('payment_method');  // Método de pago (por ejemplo, tarjeta de crédito, PayPal, etc.)
            $table->decimal('total_amount', 10, 2);  // Total de la compra
            $table->enum('status', ['pending', 'processing', 'shipped', 'delivered'])->default('pending');  // Estado del pedido
            $table->timestamps();  // Marca de tiempo
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};