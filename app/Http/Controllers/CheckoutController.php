<?php

namespace App\Http\Controllers;

use App\Models\Address;
use App\Models\CartItem;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{
    /**
     * Muestra el formulario de checkout con los ítems del carrito
     */
    public function index()
    {
        // Obtener el carrito del usuario autenticado
        $cartItems = CartItem::where('user_id', Auth::id())->get();

        // Calcular el total del carrito
        $total = $cartItems->sum(function ($item) {
            return $item->total_with_discount; // Usamos el accesor para obtener el total con descuento
        });

        // Obtener las direcciones del usuario autenticado
        $addresses = Address::where('user_id', Auth::id())->get();

        return view('checkout.index', compact('cartItems', 'total', 'addresses'));  // Asegúrate de pasar $addresses
    }

    /**
     * Procesar el checkout y crear el pedido.
     */
    public function process(Request $request)
    {
        // Validar los datos del formulario de checkout
        $validated = $request->validate([
            'address' => 'required|exists:addresses,id', // Validar que la dirección exista en la tabla de direcciones
            'payment_method' => 'required|string', // Validar que el método de pago sea una cadena de texto
        ]);

        // Obtener los productos del carrito del usuario autenticado
        $cartItems = CartItem::where('user_id', Auth::id())->get();

        // Calcular el total del pedido (con precios y descuentos)
        $totalAmount = $cartItems->sum(function ($cartItem) {
            return ($cartItem->price - $cartItem->unit_discount) * $cartItem->quantity;
        });

        // Crear el pedido en la tabla orders
        $order = Order::create([
            'user_id' => Auth::id(),
            'address_id' => $request->address,  // Dirección seleccionada por el usuario
            'payment_method' => $request->payment_method,  // Método de pago
            'total_amount' => $totalAmount,  // Total calculado de la compra
            'status' => 'pending',  // El estado inicial del pedido es 'pending'
        ]);

        // Crear los ítems del pedido en la tabla order_items
        foreach ($cartItems as $cartItem) {
            $order->items()->create([
                'product_id' => $cartItem->product_id,
                'quantity' => $cartItem->quantity,
                'price_at_purchase' => $cartItem->price,  // El precio en el momento de la compra
                'unit_discount' => $cartItem->unit_discount,  // El descuento unitario aplicado en ese momento
                'total_at_purchase' => ($cartItem->price - $cartItem->unit_discount) * $cartItem->quantity,  // Total por esa cantidad de producto con el descuento
            ]);
        }

        // Limpiar el carrito después de completar la compra
        CartItem::where('user_id', Auth::id())->delete();

       // Redirigir al usuario a la página de confirmación del pedido
        return redirect()->route('shop.confirmation', ['orderId' => $order->id])
        ->with('success', 'Compra realizada con éxito.');
    }
}