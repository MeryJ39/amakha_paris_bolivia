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
        // Insertar categorías de ejemplo sin el campo "image"
        DB::table('categories')->insert([
            [
                'name' => 'Perfumes',
                'description' => 'Variedad de perfumes y fragancias.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Cuidado Capilar',
                'description' => 'Productos para el cuidado del cabello.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Nutricionales',
                'description' => 'Suplementos alimenticios para la salud.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Cuidado Personal',
                'description' => 'Productos para el cuidado de la piel y el cuerpo.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Productos Bucales',
                'description' => 'Artículos para la higiene bucal.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Infantiles',
                'description' => 'Productos para bebés e infantes.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}