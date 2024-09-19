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
        $categories = [
            ['description' => 'Perfumes'],
            ['description' => 'Hidratante'],
            ['description' => 'Higiene Personal'],
            ['description' => 'Nutricional'],
            ['description' => 'Capilar'],
            // Añade más categorías según sea necesario
        ];
        //
        DB::table('categories')->insert($categories);
    }
}
