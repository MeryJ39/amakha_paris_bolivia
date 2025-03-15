<?php

namespace App\Livewire;

use App\Models\CartItem;
use App\Models\Discount;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\On;
use Livewire\Component;

class ProductDetails extends Component
{
    public $product;
    public $quantity = 1;  // Variable para la cantidad seleccionada por el usuario
    public $isInCart = false; // Variable para saber si el producto está en el carrito
    public $cartItemId; // Almacenamos el ID del ítem del carrito
    public $discountAmount = 0; // Descuento en el producto
    public $finalPrice; // Precio final después de aplicar el descuento

    public $consultorPrice; // Precio para consultores

    // Recibe el ID del producto cuando se inicializa el componente
    public function mount($productId)
    {
        // Obtener el producto por su ID
        $this->product = Product::findOrFail($productId);

        // Aplicar el descuento al producto
        $this->applyDiscounts($this->product);

        // Verificar si el producto está en el carrito del usuario
        $this->checkIfProductIsInCart();
    }

    // Aplicar descuento al producto según el rol del usuario
    public function applyDiscounts($product)
    {
        $user = Auth::user();
        $discountAmount = 0;  // Inicializamos el descuento a 0
        $consultorPrice = $product->price; // Aseguramos que siempre haya un precio de consultor (por defecto es el precio original)

        if ($user) {
            // Si el rol del usuario es 2, aplicamos el descuento de consultor
            if ($user->role_id == 2) {
                $discountAmount = 0;  // El descuento es 0
                $consultorPrice = $product->price / 2; // El precio se reduce a la mitad
            } else {
                // Si el rol del usuario no es 2, aplicamos el descuento del producto
                // Aquí usamos el campo 'discount' del producto
                $discountAmount = $product->discount ?? 0;  // Si no hay descuento en el producto, será 0
            }
        } else {
            // Si no hay usuario autenticado, usamos el descuento del producto
            $discountAmount = $product->discount ?? 0;  // Si no hay descuento, es 0
        }

        // Calcular el precio final después del descuento
        $this->discountAmount = $discountAmount;
        $this->finalPrice = $discountAmount > 0 ? $product->price - $discountAmount : $product->price;
        $this->consultorPrice = $consultorPrice;
    }

    // Método para agregar al carrito
    public function addToCart()
    {
        $user = Auth::user();

        // Verificar que el usuario esté autenticado
        if (!$user) {
            session()->flash('error', 'You need to be logged in to add items to the cart.');
            return redirect()->route('login');  // Redirige al login
        }

        // Verificar si el producto ya está en el carrito
        $existingCartItem = CartItem::where('user_id', $user->id)
            ->where('product_id', $this->product->id)
            ->first();

        if ($existingCartItem) {
            // Si el producto ya está en el carrito, actualizar la cantidad
            $existingCartItem->quantity += $this->quantity;
            $existingCartItem->save();

            session()->flash('info', 'Product quantity updated in your cart.');
        } else {
            // Crear el nuevo ítem en el carrito
            CartItem::create([
                'user_id' => $user->id,
                'product_id' => $this->product->id,
                'quantity' => $this->quantity,
                'price' => $this->product->price > $this->consultorPrice ? $this->consultorPrice : $this->product->price,  // Precio del producto
                'unit_discount' => $this->discountAmount,  // Descuento aplicado
            ]);

            session()->flash('success', 'Product added to the cart!');
        }

        // Emitir el evento para actualizar el carrito
        $this->dispatch('cartUpdated');
    }

    // Método para aumentar la cantidad
    public function increaseQuantity()
    {
        $this->quantity++;

        // Actualizar la cantidad en el carrito si el producto ya está en el carrito
        $this->updateCartItemQuantity();

        // Emitir el evento para actualizar el carrito después de la actualización en base de datos
        $this->dispatch('cartUpdated');
    }

    // Método para disminuir la cantidad
    public function decreaseQuantity()
    {
        if ($this->quantity > 1) {
            $this->quantity--;

            // Actualizar la cantidad en el carrito si el producto ya está en el carrito
            $this->updateCartItemQuantity();

            // Emitir el evento para actualizar el carrito después de la actualización en base de datos
            $this->dispatch('cartUpdated');
        }
    }

    // Método para actualizar la cantidad en el carrito
    private function updateCartItemQuantity()
    {
        if ($this->isInCart) {
            DB::transaction(function () {
                CartItem::where('id', $this->cartItemId)
                    ->update(['quantity' => $this->quantity]);
            });
        }
    }

    // Método para eliminar el producto del carrito
    public function removeFromCart()
    {
        DB::transaction(function () {
            CartItem::destroy($this->cartItemId);
        });

        $this->dispatch('cartUpdated');
    }

    // Método para verificar si el producto está en el carrito y obtener la cantidad
    public function checkIfProductIsInCart()
    {
        $user = Auth::user();

        if (!$user) {
            // Si no hay un usuario autenticado, el producto no está en el carrito
            $this->isInCart = false;
            $this->quantity = 1; // Restablecer cantidad
            return;
        }

        // Buscar el ítem del carrito
        $existingCartItem = CartItem::where('user_id', $user->id)
            ->where('product_id', $this->product->id)
            ->first();

        if ($existingCartItem) {
            // Actualizar estado si el producto está en el carrito
            $this->isInCart = true;
            $this->quantity = $existingCartItem->quantity;
            $this->cartItemId = $existingCartItem->id;
        } else {
            // Restablecer estado si el producto ya no está en el carrito
            $this->isInCart = false;
            $this->quantity = 1; // Restablecer cantidad
        }
    }

    // Escuchar el evento 'cartUpdated' cuando se despacha
    #[On('cartUpdated')]
    public function handleCartUpdated()
    {
        // Recargar los productos en el carrito y verificar si el producto actual está en el carrito
        $this->checkIfProductIsInCart();
    }

    public function render()
    {
        return view('livewire.product-details');
    }
}