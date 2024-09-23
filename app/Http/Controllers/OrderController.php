<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Log;

use App\Models\OrderItem;
use Illuminate\Support\Facades\Http;




class OrderController extends Controller
{
    public function store(Request $request)
    {
        // Validar los datos
        $request->validate([
            'total' => 'required|numeric',
            'items' => 'required|array',
            'items.*.product_id' => 'required|exists:products,id',
            'items.*.quantity' => 'required|integer|min:1',
        ]);

        // Crear la orden
        $order = Order::create([
            'user_id' => Auth::id(), // Suponiendo que el usuario está autenticado
            'total' => $request->total,
            'status' => 'pending', // Estado inicial
        ]);

        // Agregar los elementos de la orden
        foreach ($request->items as $item) {
            $order->orderItems()->create([
                'product_id' => $item['product_id'],
                'quantity' => $item['quantity'],
                'price' => $item['price'], // Asegúrate de obtener el precio correcto
            ]);
        }

        return response()->json(['message' => 'Order created successfully', 'order' => $order], 201);
    }




    public function process(Request $request)
{
    // Debug: Verifica qué datos llegan al controlador
    Log::info('Datos recibidos en el checkout:', $request->all());

    // Validar los datos
    $request->validate([
        'total_amount' => 'required|numeric',
        'cart_items' => 'required|json', // Validar que cart_items sea JSON
    ]);

    // Obtener el usuario autenticado
    $user = Auth::user();

    // Crear la orden
    $order = Order::create([
        'user_id' => $user->id,
        'total' => $request->total_amount,
        'status' => 'pending',
    ]);

    // Decodificar los artículos del carrito
    $cartItems = json_decode($request->cart_items, true);

    // Agregar los elementos de la orden
    foreach ($cartItems as $item) {
        OrderItem::create([
            'order_id' => $order->id,
            'product_id' => $item['id'], // Asumimos que 'id' es el ID del producto
            'quantity' => $item['quantity'], // Cantidad
            'price' => $item['price'], // Precio
        ]);
    }

    // Preparar los datos para la API de Libélula
    $libelulaData = [
        'appkey' => '588e5e10-d794-4910-91d2-b3952b54df4d',
        'email_cliente' => $user->email, // Correo del cliente
        'identificador_deuda' => (string) $order->id, // ID de la orden como identificador
        'descripcion' => 'Pago Compra Online', // Descripción de la deuda
        'lineas_detalle_deuda' => array_map(function($item) {
            return [
                'concepto' => (string) $item['name'], // Nombre del producto
                'cantidad' => (int) $item['quantity'], // Asegúrate que sea un entero
                'costo_unitario' => (float) $item['price'], // Precio como decimal
                'descuento_unitario' => 0, // Agrega si hay algún descuento
            ];
        }, $cartItems),
    ];

    // Enviar solicitud a la API de Libélula
    $response = Http::post('https://api.libelula.bo/rest/deuda/registrar', $libelulaData);

    // Comprobar la respuesta de la API
    if ($response->successful()) {
        $responseData = $response->json();

        // Verificar si hay un error
        if ($responseData['error'] === 0) {
            // Redirigir al usuario a la URL de la pasarela de pagos
            return redirect($responseData['url_pasarela_pagos']);
        } else {
            // Si hay un error, loguear y retornar el mensaje completo
            Log::error('Error al registrar el pago en Libélula: ', $responseData);

            return response()->json([
                'message' => $responseData['mensaje'],
                'error_code' => $responseData['error'],
                'order_id' => $order->id,
                'total' => $order->total,
                'status' => $order->status,
                'full_response' => $responseData // Muestra la respuesta completa
            ], 500);
        }
    } else {
        // Manejo de errores en la solicitud
        Log::error('Error al registrar el pago en Libélula: ', $response->json());

        return response()->json([
            'message' => 'Orden creada, pero error al registrar el pago.',
            'order_id' => $order->id,
            'total' => $order->total,
            'status' => $order->status,
            'full_response' => $response->json() // Muestra la respuesta completa de la solicitud
        ], 500);
    }
}







}
