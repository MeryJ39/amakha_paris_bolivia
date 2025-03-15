<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    // Mostrar todos los pedidos del usuario
    // Mostrar todos los pedidos del usuario
    public function index()
    {
        // Obtener los pedidos del usuario autenticado
        $orders = Order::where('user_id', Auth::id())->get();

        // Devolver la vista con los pedidos del usuario
        return view('orders', compact('orders'));
    }

    // Mostrar los detalles de un pedido específico
    public function show($orderId)
    {
        // Buscar el pedido por ID y asegurarse de que pertenece al usuario autenticado
        $order = Order::where('id', $orderId)
            ->where('user_id', Auth::id())
            ->firstOrFail();  // Si no se encuentra, lanza una excepción

        // Cargar los ítems del pedido (relación con OrderItems)
        $orderItems = $order->items;

        // Devolver la vista de detalles con los datos del pedido
        return view('orders.show', compact('order', 'orderItems'));  // Cambié 'orders' por 'orders.show'
    }
    public function showConfirmation($orderId)
    {
        // Buscar el pedido por ID y asegurarse de que pertenece al usuario autenticado
        $order = Order::where('id', $orderId)
            ->where('user_id', Auth::id())
            ->firstOrFail();  // Si no se encuentra, lanza una excepción

        // Cargar los ítems del pedido (relación con OrderItems)
        $orderItems = $order->items;

        return view('shop.confirmation', compact('order', 'orderItems'));
    }

    // En OrderController.php

    public function startChat(Order $order)
    {
          // Verificar si el usuario puede ver este pedido

        // Redirigir al usuario al chat o a la página para crear el chat si no existe
        if ($order->chat) {
            return redirect()->route('chat.show', $order->chat);
        } else {
            return redirect()->route('chat.create', $order); // Ruta para crear el chat (ej: orders/{order}/chat/create)
        }
    }
}