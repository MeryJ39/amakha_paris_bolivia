<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Log;

use App\Models\OrderItem;
use Illuminate\Support\Facades\Http;

use Illuminate\Support\Str;



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
    // Validar los datos
    $request->validate([
        'total_amount' => 'required|numeric',
        'cart_items' => 'required|json',
    ]);

    // Obtener el usuario autenticado
    $user = Auth::user();

    // Crear la orden
    $order = Order::create([
        'user_id' => $user->id,
        'total' => $request->total_amount,
        'status' => 'pending',
    ]);

    // Preparar los datos para la API de Libélula
    $libelulaData = [
        'appkey' => '11bb10ce-68ba-4af1-8eb7-4e6624fed729',
        'email_cliente' => $user->email,
        'identificador' => (string) Str::uuid(), // Generar un UUID único
        'callback_url' => 'https://www.amakhaparis.com.bo/api/pago-exitoso?id=' . $order->id,
        'url_retorno' => 'http://127.0.0.1:8000/',
        'descripcion' => 'Pago Compra Online',
        'nombre_cliente' => $user->name,
        'apellido_cliente' => 'Gutierrez',
        'nit' => '33221144',
        'razón_social' => 'CGuiterrez',
        'ci' => '321654987',
        'fecha_vencimiento' => '2024-12-31 23:59',
        'lineas_detalle_deuda' => [] // Asegúrate de inicializarlo como un array
    ];

    // Decodificar los artículos del carrito
    $cartItems = json_decode($request->cart_items, true);

    // Agregar los elementos de la orden y llenar `lineas_detalle_deuda`
    foreach ($cartItems as $item) {
        OrderItem::create([
            'order_id' => $order->id,
            'product_id' => $item['id'],
            'quantity' => $item['quantity'],
            'price' => $item['price'],
        ]);

        $libelulaData['lineas_detalle_deuda'][] = [
            'concepto' => (string) $item['name'], // Asegúrate de que el nombre del producto esté disponible
            'cantidad' => (int) $item['quantity'],
            'costo_unitario' => (float) $item['price'],
            'descuento_unitario' => 0, // Cambia esto si hay descuentos
        ];
    }

    // Debug: Loguear los datos que se enviarán a la API
    Log::info('Datos enviados a la API de Libélula:', $libelulaData);

    // Enviar solicitud a la API de Libélula
    $response = Http::post('https://api.libelula.bo/rest/deuda/registrar', $libelulaData);

    // Comprobar la respuesta de la API
    if ($response->successful()) {
        $responseData = $response->json();

        // Verificar si hay un error
        if ($responseData['error'] === 0) {
            return redirect($responseData['url_pasarela_pagos']);
        } else {
            Log::error('Error al registrar el pago en Libélula: ', $responseData);

            return response()->json([
                'message' => $responseData['mensaje'],
                'error_code' => $responseData['error'],
                'order_id' => $order->id,
                'total' => $order->total,
                'status' => $order->status,
                'full_response' => $responseData
            ], 500);
        }
    } else {
        Log::error('Error al registrar el pago en Libélula: ', $response->json());

        return response()->json([
            'message' => 'Orden creada, pero error al registrar el pago.',
            'order_id' => $order->id,
            'total' => $order->total,
            'status' => $order->status,
            'full_response' => $response->json()
        ], 500);
    }
}











}