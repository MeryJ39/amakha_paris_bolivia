<?php

namespace Database\Seeders;

use App\Models\Address;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AddressSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // Obtener los usuarios con user_id 2 y 3
        $user2 = User::find(2);  // Usuario con ID 2
        $user3 = User::find(3);  // Usuario con ID 3

        // Verificar que los usuarios existen
        if ($user2 && $user3) {
            // Crear direcciones para el usuario con user_id 2
            Address::create([
                'user_id' => $user2->id,
                'address' => 'Av. Siempre Viva 123',
                'city' => 'Santa Cruz',
                'department' => 'Santa Cruz',  // Departamento en Bolivia
                'phone_number' => '71234567',  // Número de teléfono de 8 dígitos
                'is_default' => true,  // Definir como dirección por defecto
            ]);

            // Crear direcciones para el usuario con user_id 3
            Address::create([
                'user_id' => $user3->id,
                'address' => 'Calle Falsa 456',
                'city' => 'Cochabamba',
                'department' => 'Cochabamba',
                'phone_number' => '71654321',
                'is_default' => false,
            ]);

            Address::create([
                'user_id' => $user3->id,
                'address' => 'Calle A 789',
                'city' => 'La Paz',
                'department' => 'La Paz',
                'phone_number' => '71897654',
                'is_default' => false,
            ]);
        } else {
            // Si los usuarios no existen, se podría agregar un manejo de error o mensaje
            echo "Usuarios no encontrados.";
        }
    }
}
