<?php

namespace Database\Factories;

use App\Models\Order;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class OrderFactory extends Factory
{
    protected $model = Order::class;

    public function definition()
    {
        return [
            'user_id' => User::factory(), // Crea un usuario asociado
            'total' => $this->faker->randomFloat(2, 10, 1000), // Total aleatorio entre 10 y 1000
            'status' => 'pending', // Estado por defecto
        ];
    }
}