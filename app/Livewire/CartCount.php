<?php

namespace App\Livewire;

use App\Models\CartItem;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\On;
use Livewire\Component;

class CartCount extends Component
{
    public int $productCount = 0;  // Contador de productos únicos

    public function mount(): void
    {
        $this->updateCartCount();
    }

    // Método para contar los productos únicos
    public function updateCartCount(): void
    {
        $user = Auth::user();

        if ($user) {
            // Obtener los productos únicos (sin duplicados) basados en el product_id
            $cartItems = CartItem::where('user_id', $user->id)
                ->select('product_id')
                ->get();

            // Contar los productos únicos (eliminando duplicados)
            $this->productCount = $cartItems->unique('product_id')->count();
        } else {
            $this->productCount = 0;  // Si no hay usuario, no hay productos en el carrito
        }
    }

    // Usamos el atributo #[On()] para escuchar el evento 'cartUpdated'
    #[On('cartUpdated')]
    public function handleCartUpdated(): void
    {
        // Al actualizar el carrito, recalcular el conteo de productos únicos
        $this->updateCartCount();
    }

    public function render()
    {
        return view('livewire.cart-count');
    }
}