<?php

namespace App\Livewire;

use App\Models\CartItem;
use App\Models\Discount;
use App\Models\Product;
use App\Models\Subcategory;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\On;
use Livewire\Component;

class ProductSubcategoryList extends Component
{
    public $subcategory;
    public $products = [];
    public $cartProductIds = [];

    // Método que se ejecuta al montar el componente
    // Método que se ejecuta al montar el componente
    public function mount($subcategory, $products)
    {
        $this->subcategory = $subcategory;
        $this->products = $products;
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

    // Aplicar descuento a los productos según el rol del usuario
    public function applyDiscounts($product)
    {
        $user = Auth::user();
        $discountAmount = 0;

        if ($user) {
            // Obtener el descuento correspondiente para el rol del usuario y el producto
            $discount = Discount::where('role_id', $user->role_id)
                ->where('product_id', $product->id)
                ->where('is_active', true)
                ->where('start_date', '<=', now())
                ->where('end_date', '>=', now())
                ->first();

            // Si hay un descuento, calcular el monto del descuento
            if ($discount) {
                $discountAmount = $discount->discount_amount;
            }


        }



        return [
            'original_price' => $product->price,
            'discount_amount' => $discountAmount,
        ];
    }

    // Método para agregar un producto al carrito
    public function addToCart($productId)
    {
        $user = Auth::user();

        // Verificar que el usuario esté autenticado
        if (!$user) {
            session()->flash('error', 'You need to be logged in to add items to the cart.');
            return redirect()->route('login');  // Redirige al login
        }

        // Obtener el producto
        $product = Product::find($productId);

        // Aplicar descuento al producto si está disponible
        $discountData = $this->applyDiscounts($product);

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
            'price' => $discountData['original_price'],  // Precio original del producto
            'unit_discount' => $discountData['discount_amount'],  // Monto del descuento
        ]);

        // Emitir el evento de carrito actualizado
        $this->dispatch('cartUpdated');

        session()->flash('success', 'Product added to the cart!');
    }

    // Escuchar el evento 'cartUpdated' cuando se despacha
    #[On('cartUpdated')]
    public function handleCartUpdated()
    {
        $this->loadCartItems();  // Recargar los productos en el carrito
    }

    public function render()
    {
        return view('livewire.product-subcategory-list');
    }
}