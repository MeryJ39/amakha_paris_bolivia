<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // Insertar categorías de ejemplo
        DB::table('categories')->insert([
            [
                'name' => 'Perfumes',
                'description' => 'Variedad de perfumes y fragancias.',
                'image' => 'images/categories/perfumes.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Cuidado Capilar',
                'description' => 'Productos para el cuidado del cabello.',
                'image' => 'images/categories/cuidado_capilar.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Nutricionales',
                'description' => 'Suplementos alimenticios para la salud.',
                'image' => 'images/categories/nutricionales.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Cuidado Personal',
                'description' => 'Productos para el cuidado de la piel y el cuerpo.',
                'image' => 'images/categories/cuidado_personal.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Productos Bucales',
                'description' => 'Artículos para la higiene bucal.',
                'image' => 'images/categories/productos_bucales.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Infantiles',
                'description' => 'Productos para bebés e infantes.',
                'image' => 'images/categories/infantiles.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}