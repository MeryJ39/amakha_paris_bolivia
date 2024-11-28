<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('discounts', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('role_id'); // Relación con el rol
            $table->unsignedBigInteger('product_id'); // Relación con el producto
            $table->decimal('discount_amount', 10, 2); // Monto fijo del descuento
            $table->date('start_date')->nullable(); // Fecha de inicio del descuento
            $table->date('end_date')->nullable(); // Fecha de fin del descuento
            $table->boolean('is_active')->default(true); // Si el descuento está activo
            $table->timestamps();

            // Relación con el rol
            $table->foreign('role_id')->references('id')->on('roles')->onDelete('cascade');

            // Relación con el producto
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('discounts');
    }
};
