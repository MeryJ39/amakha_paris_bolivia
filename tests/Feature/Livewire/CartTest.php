<?php

namespace Tests\Feature\Livewire;

use App\Livewire\Cart;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;

class CartTest extends TestCase
{
    /** @test */
    public function renders_successfully()
    {
        Livewire::test(Cart::class)
            ->assertStatus(200);
    }
}
