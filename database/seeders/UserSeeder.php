<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Role;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Obtener el ID del rol 'admin', 'consultor' y 'cliente'
        $adminRole = Role::where('name', 'admin')->first();
        $consultorRole = Role::where('name', 'consultor')->first();
        $clienteRole = Role::where('name', 'cliente')->first();

        // Crear un usuario con rol 'admin'
        User::create([
            'name' => 'Juan Pérez',
            'email' => 'juan@example.com',
            'password' => Hash::make('password123'),
            'role_id' => $adminRole->id, // Asignar el rol 'admin'
        ]);

        // Crear un usuario con rol 'consultor'
        User::create([
            'name' => 'Ana Gómez',
            'email' => 'ana@example.com',
            'password' => Hash::make('password123'),
            'role_id' => $consultorRole->id, // Asignar el rol 'consultor'
        ]);

        // Crear un usuario con rol 'cliente'
        User::create([
            'name' => 'Carlos Rodríguez',
            'email' => 'carlos@example.com',
            'password' => Hash::make('password123'),
            'role_id' => $clienteRole->id, // Asignar el rol 'cliente'
        ]);
    }
}