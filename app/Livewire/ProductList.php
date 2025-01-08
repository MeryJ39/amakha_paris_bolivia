<?php

namespace App\Livewire;

use App\Models\CartItem;
use App\Models\Discount;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\Attributes\On;
use Illuminate\Support\Facades\Log;

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

    // Aplicar descuento a los productos según el rol del usuario
    public function applyDiscounts($product)
    {
        $discountAmount = 0;  // Inicializamos el descuento a 0
        $consultor_price = $product->price;  // Aseguramos que siempre haya un precio de consultor (por defecto es el precio original)

        $user = Auth::user();  // Verificamos si el usuario está autenticado

        if ($user) {
            // Si el rol del usuario es 2 (por ejemplo, un rol especial), se aplica un descuento especial
            if ($user->role_id == 2) {
                $discountAmount = 0;  // Descuento de 0
                $consultor_price = $product->price / 2;  // El precio se reduce a la mitad
            } else {
                // Si el rol del usuario es diferente, se aplica el descuento del producto (si existe)
                $discountAmount = $product->discount ?? 0;  // Descuento del producto (si existe)
             }
        } else {
            // Si no hay usuario autenticado, simplemente verificamos si el producto tiene descuento
            $discountAmount = $product->discount ?? 0;  // Descuento del producto (si existe)
         }

        // Registrar en los logs el descuento y el precio actual
        Log::info('Discount applied:', [
            'product_id' => $product->id,
            'original_price' => $product->price,
            'discount_amount' => $discountAmount,
         ]);

        // Devolver el precio original y la cantidad del descuento
        return [
            'original_price' => $product->price,  // Precio original
            'discount_amount' => $discountAmount, // Monto del descuento
            'consultor_price' => $consultor_price,  // Precio para consultores
         ];
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

            'price' => $discountData['consultor_price']<$discountData['original_price'] ? $discountData['consultor_price']: $discountData['original_price'],  // Precio con descuento para consultores


            'unit_discount' => $discountData['discount_amount'],  // Monto del descuento
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