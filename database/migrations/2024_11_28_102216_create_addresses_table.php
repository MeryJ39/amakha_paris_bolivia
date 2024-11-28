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
        Schema::create('addresses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');  // Relación con el usuario
            $table->string('address');  // Dirección completa
            $table->string('city');  // Ciudad
            $table->string('department');  // Departamento (anteriormente estado)
            $table->string('phone_number', 8);  // Número de teléfono (solo 8 dígitos)
            $table->boolean('is_default')->default(false);  // Dirección por defecto
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('addresses');
    }

};
