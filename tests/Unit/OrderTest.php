<?php

namespace Tests\Unit;

use App\Models\Category;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class OrderTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_can_create_an_order(): void
    {
        $user = User::factory()->create();

        $order = Order::create([
            'user_id' => $user->id,
            'total' => 100.00,
            'status' => 'pending',
        ]);

        $this->assertEquals($user->id, $order->user_id);
        $this->assertEquals(100.00, $order->total);
        $this->assertEquals('pending', $order->status);
    }

    /** @test */
    public function it_belongs_to_a_user(): void
    {
        $user = User::factory()->create();
        $order = Order::create([
            'user_id' => $user->id,
            'total' => 100.00,
            'status' => 'pending',
        ]);

        $this->assertInstanceOf(User::class, $order->user);
        $this->assertEquals($user->id, $order->user->id);
    }

    /** @test */
public function it_can_have_order_items(): void
{
    // Crea una categoría
    $category = Category::factory()->create();

    // Crea un producto con una categoría válida
    $product = Product::factory()->create([
        'category_id' => $category->id, // Asigna la categoría creada
    ]);

    // Luego crea una orden
    $order = Order::factory()->create();

    // Ahora crea el order_item con el product_id válido
    $orderItem = $order->orderItems()->create([
        'product_id' => $product->id, // Usa el ID del producto creado
        'quantity' => 2,
        'price' => 50.00,
    ]);

    $this->assertCount(1, $order->orderItems);
    $this->assertEquals($orderItem->id, $order->orderItems->first()->id);
}



}