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
            // Obtener el ID del rol 'admin', 'consultor', 'cliente' y 'personal'
            $adminRole = Role::where('name', 'Admin')->first();
            $consultorRole = Role::where('name', 'Consultor')->first();
            $clienteRole = Role::where('name', 'Cliente')->first();
            $personalRole = Role::where('name', 'Personal')->first();  // Nuevo rol para 'Personal'

         // Crear un usuario con rol 'admin'
        User::create([
            'name' => 'michaelka',  // Nombre del usuario
            'last_name' => 'Admin',  // Apellido del usuario
            'email' => 'michaelka@gmail.com',  // Correo electrónico
            'password' => Hash::make('password123'),  // Contraseña cifrada
            'phone' => '555-5678',  // Teléfono del usuario
            'role_id' => $adminRole->id,  // Asignar el rol 'admin'
        ]);

        // Crear un usuario con rol 'consultor'
        User::create([
            'name' => 'Mery',  // Nombre del usuario
            'last_name' => 'Consultora',  // Apellido del usuario
            'email' => 'mery@gmail.com',  // Correo electrónico
            'password' => Hash::make('password123'),  // Contraseña cifrada
            'phone' => '555-8765',  // Teléfono del usuario
            'role_id' => $consultorRole->id,  // Asignar el rol 'consultor'
        ]);

        // Crear un usuario con rol 'cliente'
        User::create([
            'name' => 'Fidel',  // Nombre del usuario
            'last_name' => 'Cliente',  // Apellido del usuario
            'email' => 'fidel@gmail.com',  // Correo electrónico
            'password' => Hash::make('password123'),  // Contraseña cifrada
            'phone' => '555-4321',  // Teléfono del usuario
            'role_id' => $clienteRole->id,  // Asignar el rol 'cliente'
        ]);

        // Crear un usuario con rol 'personal' (Atención al cliente)
        User::create([
            'name' => 'Dulia',  // Nombre del usuario
            'last_name' => 'Atención',  // Apellido del usuario
            'email' => 'dulia@gmail.com',  // Correo electrónico
            'password' => Hash::make('password123'),  // Contraseña cifrada
            'phone' => '555-6789',  // Teléfono del usuario
            'role_id' => $personalRole->id,  // Asignar el rol 'personal'
        ]);


    }
}
