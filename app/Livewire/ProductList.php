<?php

namespace App\Livewire;

use App\Models\CartItem;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\Attributes\On;

class ProductList extends Component
{
    public $products;
    public $cartProductIds = [];

    // Método que se ejecuta al cargar el componente
    public function mount()
    {
        // Cargar todos los productos
        $this->products = Product::all();

        // Obtener los productos en el carrito del usuario
        $this->loadCartItems();
    }

    // Cargar los productos que están en el carrito del usuario
    public function loadCartItems()
    {
        $user = Auth::user();

        if ($user) {
            // Obtener los IDs de los productos que están en el carrito
            $cartItems = CartItem::where('user_id', $user->id)->pluck('product_id');

            // Almacenar los IDs de los productos en el carrito
            $this->cartProductIds = $cartItems->toArray();
        }
    }

    // Escuchar el evento 'cartUpdated' cuando se despacha
    #[On('cartUpdated')]
    public function handleCartUpdated()
    {
        $this->loadCartItems();  // Recargar los productos en el carrito
    }

    // Método para agregar un producto al carrito
    public function addToCart($productId)
    {
        $user = Auth::user();

        // Verificar que el usuario esté autenticado
        if (!$user) {
            // Establecer el mensaje de error y redirigir al login
            session()->flash('error', 'You need to be logged in to add items to the cart.');
            return redirect()->route('login');  // Redirige al login
        }

        // Verificar si el producto ya está en el carrito
        $existingCartItem = CartItem::where('user_id', $user->id)
            ->where('product_id', $productId)
            ->first();

        if ($existingCartItem) {
            session()->flash('info', 'This product is already in your cart.');
            return;
        }

        // Crear el nuevo ítem en el carrito
        CartItem::create([
            'user_id' => $user->id,
            'product_id' => $productId,
            'quantity' => 1,  // Establecer cantidad inicial
            'price' => Product::find($productId)->price,  // Precio del producto
            'unit_discount' => 0,  // Sin descuento inicial
        ]);

        // Emitir el evento de carrito actualizado
        $this->dispatch('cartUpdated');

        session()->flash('success', 'Product added to the cart!');
    }


    public function render()
    {
        return view('livewire.product-list');
    }
}