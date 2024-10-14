<?php

namespace Tests\Unit;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProductTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_can_create_a_product(): void
    {
        $category = Category::create(['name' => 'Test Category']);


        $product = Product::create([
            'name' => 'Test Product',
            'slug' => 'test-product',
            'details' => 'Some details',
            'description' => 'Some description',
            'price' => 100.00,
            'precio_venta' => 80.00,
            'category_id' => $category->id,
            'image_path' => 'path/to/image.jpg', // Proporciona un valor aquí


        ]);

        $this->assertEquals('Test Product', $product->name);
        $this->assertEquals(100.00, $product->price);
        $this->assertEquals(80.00, $product->precio_venta);
        $this->assertEquals(20.00, $product->getDiscountAttribute());
        $this->assertEquals(20.00, $product->getDiscountPercentageAttribute());
    }

    /** @test */
    public function it_can_relate_to_category(): void
{
    $category = Category::create(['name' => 'Test Category']);

    $product = Product::create([
        'name' => 'Test Product',
        'slug' => 'test-product',
        'price' => 100.00,
        'precio_venta' => 80.00,
        'category_id' => $category->id,
        'image_path' => 'path/to/image.jpg', // Asegúrate de proporcionar el valor requerido
    ]);

    // Cambié este assert para que use la relación correctamente
    $this->assertEquals($category->id, $product->categories->id);
}

/** @test */
public function it_can_calculate_discount(): void
{
    $category = Category::create(['name' => 'Test Category']); // Agregar categoría

    $product = Product::create([
        'name' => 'Test Product',
        'slug' => 'test-product',
        'price' => 100.00,
        'precio_venta' => 80.00,
        'category_id' => $category->id, // Asegúrate de incluir category_id
        'image_path' => 'path/to/image.jpg', // Valor requerido
    ]);

    $this->assertEquals(20.00, $product->getDiscountAttribute());
}

/** @test */
public function it_can_calculate_discount_percentage(): void
{
    $category = Category::create(['name' => 'Test Category']); // Agregar categoría

    $product = Product::create([
        'name' => 'Test Product',
        'slug' => 'test-product',
        'price' => 100.00,
        'precio_venta' => 80.00,
        'category_id' => $category->id, // Asegúrate de incluir category_id
        'image_path' => 'path/to/image.jpg', // Valor requerido
    ]);

    $this->assertEquals(20.00, $product->getDiscountPercentageAttribute());
}

/** @test */
public function it_returns_zero_discount_percentage_when_price_is_zero(): void
{
    $category = Category::create(['name' => 'Test Category']); // Agregar categoría

    $product = Product::create([
        'name' => 'Test Product',
        'slug' => 'test-product',
        'price' => 0.00,
        'precio_venta' => 80.00,
        'category_id' => $category->id, // Asegúrate de incluir category_id
        'image_path' => 'path/to/image.jpg', // Valor requerido
    ]);

    $this->assertEquals(0, $product->getDiscountPercentageAttribute());
}
}