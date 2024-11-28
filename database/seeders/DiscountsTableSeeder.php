<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DiscountsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // Crear descuentos para el rol con id 3 y productos con id 1, 3 y 5
        DB::table('discounts')->insert([
            [
                'role_id' => 2, // Asignado al rol con id 3
                'product_id' => 1, // Producto con id 1
                'discount_amount' => 10.00, // Descuento de 10 Bs
                'start_date' => Carbon::now()->toDateString(), // Descuento activo desde hoy
                'end_date' => Carbon::now()->addMonths(1)->toDateString(), // Válido hasta dentro de un mes
                'is_active' => true, // Descuento activo
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'role_id' => 3, // Asignado al rol con id 3
                'product_id' => 3, // Producto con id 3
                'discount_amount' => 5.50, // Descuento de 5.50 Bs
                'start_date' => Carbon::now()->toDateString(), // Descuento activo desde hoy
                'end_date' => Carbon::now()->addMonths(1)->toDateString(), // Válido hasta dentro de un mes
                'is_active' => true, // Descuento activo
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'role_id' => 3, // Asignado al rol con id 3
                'product_id' => 5, // Producto con id 5
                'discount_amount' => 7.00, // Descuento de 7 Bs
                'start_date' => Carbon::now()->toDateString(), // Descuento activo desde hoy
                'end_date' => Carbon::now()->addMonths(1)->toDateString(), // Válido hasta dentro de un mes
                'is_active' => true, // Descuento activo
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);
    }
}