<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SubcategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // Insertar subcategorías de ejemplo
        DB::table('subcategories')->insert([
            // Subcategorías para 'Perfumes'
            ['name' => 'Hombres', 'category_id' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Femeninos', 'category_id' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Unisex', 'category_id' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Infantiles', 'category_id' => 1, 'created_at' => now(), 'updated_at' => now()],

            // Subcategorías para 'Cuidado Capilar'
            ['name' => 'Champús', 'category_id' => 2, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Acondicionadores', 'category_id' => 2, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Tratamientos capilares', 'category_id' => 2, 'created_at' => now(), 'updated_at' => now()],

            // Subcategorías para 'Nutricionales'
            ['name' => 'Suplementos alimenticios', 'category_id' => 3, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Suplementos para el deseo sexual', 'category_id' => 3, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Complementos alimenticios antioxidantes', 'category_id' => 3, 'created_at' => now(), 'updated_at' => now()],

            // Subcategorías para 'Cuidado Personal'
            ['name' => 'Gel de ducha 3 en 1', 'category_id' => 4, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Espumas de afeitar', 'category_id' => 4, 'created_at' => now(), 'updated_at' => now()],

            // Subcategorías para 'Productos Bucales'
            ['name' => 'Cremas dentales regeneradoras', 'category_id' => 5, 'created_at' => now(), 'updated_at' => now()],

            // Subcategorías para 'Infantiles'
            ['name' => 'Perfumes', 'category_id' => 6, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Champús y acondicionadores hipoalergénicos', 'category_id' => 6, 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
