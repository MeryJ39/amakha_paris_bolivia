<?php

namespace App\Livewire;

use App\Models\CartItem;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Livewire\Attributes\On;
use Livewire\Component;

class CartComponent extends Component
{
    public Collection $cartItems;
    public float $total = 0.0;




    // Inicializamos $cartItems con una instancia de Eloquent\Collection vacía
    public function mount(): void
    {
        $this->cartItems = new Collection();
        $this->loadCartItems();
    }

    public function loadCartItems(): void
    {
        $user = Auth::user();

        if ($user) {
            $this->cartItems = CartItem::where('user_id', $user->id)
                ->join('products', 'cart_items.product_id', '=', 'products.id')
                ->select(
                    'cart_items.id as cart_item_id',
                    'cart_items.quantity',
                    'cart_items.price',
                    'cart_items.unit_discount',
                    'products.name as product_name',
                    'products.image as product_image'
                )
                ->get(); // Devuelve una instancia de Eloquent\Collection
        } else {
            $this->cartItems = new Collection(); // Instancia vacía de Eloquent\Collection
        }

        Log::info('Carrito cargado:', $this->cartItems->toArray()); // Imprime todos los ítems


        $this->calculateTotal();
    }

    public function calculateTotal(): void
    {
        $this->total = $this->cartItems->sum(function ($item) {
            $price = $item->price ?? 0;
            $discount = $item->unit_discount ?? 0;
            $quantity = $item->quantity ?? 0;

            return ($price - $discount) * $quantity;
        });
    }

    #[On('cartUpdated')]
    public function handleCartUpdated(): void
    {
        $this->loadCartItems();
        Log::info('Cart items updated:', $this->cartItems->toArray()); // Usamos toArray() para convertir la colección a un array


    }

    public function render()
    {
        return view('livewire.cart-component');
    }
}