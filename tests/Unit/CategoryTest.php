<?php

namespace Tests\Unit;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CategoryTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_can_have_products(): void
    {
        $category = Category::factory()->create();

        $product = Product::factory()->create([
            'category_id' => $category->id,
        ]);

        $this->assertCount(1, $category->products);
        $this->assertEquals($product->id, $category->products->first()->id);
    }

    /** @test */
    public function it_can_have_subcategories(): void
    {
        $parentCategory = Category::factory()->create();
        $subcategory = Category::factory()->create([
            'parent_id' => $parentCategory->id,
        ]);

        $this->assertCount(1, $parentCategory->subcategories);
        $this->assertEquals($subcategory->id, $parentCategory->subcategories->first()->id);
    }

    /** @test */
    public function it_can_belong_to_a_parent_category(): void
    {
        $parentCategory = Category::factory()->create();
        $childCategory = Category::factory()->create([
            'parent_id' => $parentCategory->id,
        ]);

        $this->assertEquals($parentCategory->id, $childCategory->parent->id);
    }
}