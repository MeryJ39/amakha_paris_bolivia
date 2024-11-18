<?php

namespace App\Http\Controllers;

use App\Models\CartItem;
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


        return view('checkout.index', compact('cartItems', 'total'));
    }

    /**
     * Procesar el checkout y crear el pedido
     */
    public function process(Request $request)
    {
        // Validar los datos del formulario de checkout
        $validated = $request->validate([
            'address' => 'required|string|max:255',
            'payment_method' => 'required|string',
        ]);

        // Procesar la compra, puedes agregar aquí la lógica para reducir stock, registrar el pedido, etc.
        // Por ejemplo, registrar un pedido en una tabla de orders, o procesar un pago

        // Limpiar el carrito del usuario después de completar la compra
        CartItem::where('user_id', Auth::id())->delete();



        // Aquí, puedes redirigir al usuario a una página de confirmación de compra o mostrar un mensaje de éxito.
        return redirect()->route('checkout')->with('success', 'Compra realizada con éxito.');
    }
}