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
    public function run(): void
    {
        // Categorías principales
        $categories = [
            ['name' => 'Perfumes'],
            ['name' => 'Cuidado Capilar'],
            ['name' => 'Nutricionales'],
            ['name' => 'Cuidado Personal'],
            ['name' => 'Productos Bucales'],
            ['name' => 'Infantiles'],
        ];

        // Inserta las categorías
        DB::table('categories')->insert($categories);

        // Inserta subcategorías
        $subcategories = [
            ['name' => 'Hombres', 'parent_id' => 1],
            ['name' => 'Femeninos', 'parent_id' => 1],
            ['name' => 'Unisex', 'parent_id' => 1],
            ['name' => 'Infantiles', 'parent_id' => 1],
            ['name' => 'Champús', 'parent_id' => 2],
            ['name' => 'Acondicionadores', 'parent_id' => 2],
            ['name' => 'Tratamientos capilares', 'parent_id' => 2],
            ['name' => 'Suplementos alimenticios', 'parent_id' => 3],
            ['name' => 'Suplementos para el deseo sexual', 'parent_id' => 3],
            ['name' => 'Complementos alimenticios antioxidantes', 'parent_id' => 3],
            ['name' => 'Gel de ducha 3 en 1', 'parent_id' => 4],
            ['name' => 'Espumas de afeitar', 'parent_id' => 4],
            ['name' => 'Cremas dentales regeneradoras', 'parent_id' => 5],
            ['name' => 'Perfumes', 'parent_id' => 6],
            ['name' => 'Champús y acondicionadores hipoalergénicos', 'parent_id' => 6],
        ];

        DB::table('categories')->insert($subcategories);
    }
}