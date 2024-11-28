<?php

namespace App\Livewire;

use App\Models\CartItem;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\On;
use Livewire\Component;

class CartItemComponent extends Component
{
    public int $cartItemId;
    public int $quantity;
    public float $price;
    public float $unitDiscount;
    public string $productName;
    public string $productImage;

    public function mount(int $cartItemId): void
    {
        $cartItem = CartItem::with('product')->findOrFail($cartItemId);

        $this->cartItemId = $cartItem->id;
        $this->quantity = $cartItem->quantity;
        $this->price = $cartItem->price;
        $this->unitDiscount = $cartItem->unit_discount;
        $this->productName = $cartItem->product->name;
        $this->productImage = $cartItem->product->image;
    }



    public function incrementQuantity(): void
    {
        DB::transaction(function () {
            $this->quantity++;

            CartItem::where('id', $this->cartItemId)
                ->update(['quantity' => $this->quantity]);
        });

        $this->dispatch('cartUpdated');
    }

    public function decrementQuantity(): void
    {
        if ($this->quantity > 1) {
            DB::transaction(function () {
                $this->quantity--;

                CartItem::where('id', $this->cartItemId)
                    ->update(['quantity' => $this->quantity]);
            });

            $this->dispatch('cartUpdated');
        }
    }

    public function removeItem(): void
    {
        DB::transaction(function () {
            CartItem::destroy($this->cartItemId);
        });

        $this->dispatch('cartUpdated');
    }


    public function render()
    {
        return view('livewire.cart-item-component');
    }
}