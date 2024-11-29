<?php

namespace App\Http\Controllers;

use App\Models\Address;
use App\Models\CartItem;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;


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
    // URL base de la API de Libélula
    protected $apiUrl = 'https://api.libelula.bo/rest/deuda/registrar'; // URL de la API de Libélula para registrar la deuda

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

        // Generar un identificador único para este pedido
        $uniqueIdentifier = (string) Str::uuid();  // O puedes usar uniqid() si prefieres no usar UUID

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

        // Datos para la petición a Libélula
        $paymentData = [
            'appkey' => '11bb10ce-68ba-4af1-8eb7-4e6624fed729', // Reemplaza con tu appkey de Libélula
            'email_cliente' => Auth::user()->email,  // El email del cliente
            'identificador' => $uniqueIdentifier,  // Identificador único generado
            'callback_url' => url("/api/pago-exitoso?id={$order->id}"), // Notificación interna de pago completado
            'url_retorno' => route('shop.confirmation', ['orderId' => $order->id]), // Redirigir al cliente a la confirmación de la compra
            'descripcion' => 'Pago Compra Online',  // Descripción del pago
            'nombre_cliente' => Auth::user()->name, // Nombre del cliente
            'apellido_cliente' => Auth::user()->last_name, // Apellido del cliente
            'valor_envio'=> 2,
            'fecha_vencimiento' => now()->addDays(1)->toDateString(), // Fecha de vencimiento para el pago
            'lineas_detalle_deuda' => $cartItems->map(function ($cartItem) {
                return [
                    'concepto' => $cartItem->product->name, // Nombre del producto
                    'cantidad' => $cartItem->quantity, // Cantidad de productos
                    'costo_unitario' => $cartItem->price, // Precio unitario
                    'descuento_unitario' => $cartItem->unit_discount, // Descuento unitario
                ];
            })->toArray(),  // Detalle de los productos y sus descuentos
            'lineas_metadatos' => [
                ['nombre' => 'Tienda', 'dato' => 'Tienda Amakha'], // Ejemplo de metadata
            ],
        ];

        // Enviar la solicitud de pago a Libélula
        try {
            $response = Http::post($this->apiUrl, $paymentData);

            if ($response->successful()) {
                // Obtener la URL para redirigir al usuario
                $paymentUrl = $response->json()['url_pasarela_pagos'];

                // Loggear la respuesta exitosa
                Log::info('Respuesta exitosa de Libélula', [
                    'response' => $response->json(),
                    'paymentUrl' => $paymentUrl,
                ]);

                // Redirigir al usuario a la URL de la pasarela de pago
                return redirect()->to($paymentUrl);
            }

            // Loggear el error de la respuesta
            Log::error('Error al procesar el pago con Libélula', [
                'response_body' => $response->body(),
                'status_code' => $response->status(),
            ]);

            // Si la respuesta de la API no es exitosa, redirigir de vuelta al carrito con error
            return redirect()->route('checkout.error')->with('error', 'Error al procesar el pago: ' . $response->body());

        } catch (\Exception $e) {

            // Loggear el error de la excepción
            Log::error('Excepción al procesar el pago con Libélula', [
                'message' => $e->getMessage(),
                'stack' => $e->getTraceAsString(),
            ]);
            // Manejar cualquier error de la API de Libélula
            return redirect()->route('checkout.error')->with('error', 'Error al procesar el pago: ' . $e->getMessage());
        }
    }

    public function paymentSuccess(Request $request)
    {
        // Obtener el ID del pedido desde el parámetro 'id' en la query string
        $orderId = $request->get('id');

        // Buscar el pedido y asegurarse de que exista
        $order = Order::findOrFail($orderId);

        // Verificar si el pago fue exitoso (esto depende de los parámetros enviados por Libélula)
        // Supongamos que Libélula envía un parámetro 'estado_pago' que indica si el pago fue exitoso
        if ($order && $request->get('estado_pago') == 'exitoso') {  // 'estado_pago' es un ejemplo de cómo Libélula puede enviar el estado del pago
            // Actualizar el estado del pedido a 'procesado'
            $order->status = 'processed';
            $order->save();
        }

        // Redirigir al cliente a la página de confirmación del pedido
        return redirect()->route('shop.confirmation', ['orderId' => $orderId])
                         ->with('success', 'Pago confirmado, ¡gracias por tu compra!');
    }

    public function showError(Request $request)
    {
        // Obtener el mensaje de error desde la sesión
        $errorMessage = $request->session()->get('error');

        // Pasar el mensaje de error a la vista
        return view('checkout.error', compact('errorMessage'));
    }

}