<?php

namespace Database\Seeders;

use App\Models\CartItem;
use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CartItemsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // Obtener el usuario con id 3
        $user = User::find(3);

        // Obtener todos los productos disponibles (6 productos en total)
        $products = Product::all();

        // Iterar sobre los productos y agregar al carrito
        foreach ($products as $product) {
            CartItem::create([
                'user_id' => $user->id,             // Usuario con id 3
                'product_id' => $product->id,       // ID del producto
                'quantity' => rand(1, 5),           // Cantidad aleatoria entre 1 y 5
                'price' => $product->price,         // Precio del producto
                'unit_discount' => rand(5, 20),     // Descuento unitario aleatorio entre 5 y 20
            ]);
        }
    }
}