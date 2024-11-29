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
        $adminRole = Role::where('name', 'Admin')->first();
        $consultorRole = Role::where('name', 'Consultor')->first();
        $clienteRole = Role::where('name', 'Cliente')->first();

        // Crear un usuario con rol 'admin'
        User::create([
            'name' => 'Juan',
            'last_name' => 'Pérez',  // Nuevo campo apellido
            'email' => 'juan@example.com',
            'password' => Hash::make('password123'),
            'phone' => '555-1234',  // Nuevo campo teléfono
            'role_id' => $adminRole->id, // Asignar el rol 'admin'
        ]);

        // Crear un usuario con rol 'consultor'
        User::create([
            'name' => 'Ana',
            'last_name' => 'Gómez',  // Nuevo campo apellido
            'email' => 'ana@example.com',
            'password' => Hash::make('password123'),
            'phone' => '555-5678',  // Nuevo campo teléfono
            'role_id' => $consultorRole->id, // Asignar el rol 'consultor'
        ]);

        // Crear un usuario con rol 'cliente'
        User::create([
            'name' => 'Carlos',
            'last_name' => 'Rodríguez',  // Nuevo campo apellido
            'email' => 'carlos@example.com',
            'password' => Hash::make('password123'),
            'phone' => '555-9876',  // Nuevo campo teléfono
            'role_id' => $clienteRole->id, // Asignar el rol 'cliente'
        ]);
    }
}