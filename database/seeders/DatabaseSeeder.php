<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Database\Seeders\RolesTableSeeder;
use Database\Seeders\UserSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Llamar al seeder de roles
        $this->call(RolesTableSeeder::class);

        // Llamar al seeder de usuarios
        $this->call(UserSeeder::class);

        // Llamar a los seeders
        $this->call([
            CategorySeeder::class,
            SubcategorySeeder::class,
            // Llama al seeder de productos cuando estés listo
            ProductSeeder::class,
        ]);

        $this->call(CartItemsSeeder::class);

    }
}