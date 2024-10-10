<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Routing\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Support\Facades\Http;

class CheckoutController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
    }

    public function index()
    {
        // Obtener el usuario autenticado
        $userId = Auth::user();
        // Obtener los productos en el carrito de este usuario
        $cartCollection = \Cart::session(Auth::user())->getContent();
        // Calcular el total del carrito
        $totalAmount = \Cart::session(Auth::user())->getTotal();
        // Carga todas las categorías principales y sus subcategorías
        $categories = Category::with('subcategories', 'products')->whereNull('parent_id')->get();

        // Retornar la vista del checkout con los productos en el carrito y el total
        return view('Web.Checkout.index', compact('cartCollection', 'totalAmount', 'categories'));
    }

    public function process(Request $request)
    {
        $userId = Auth::id();
        $orderID = $request->query('orderID');
        // Carga todas las categorías principales y sus subcategorías
        $categories = Category::with('subcategories', 'products')->whereNull('parent_id')->get();

        // Validar el ID de la orden con la API de PayPal
        $response = Http::withBasicAuth(env('PAYPAL_CLIENT_ID'), env('PAYPAL_SECRET'))
            ->get('https://api-m.paypal.com/v2/checkout/orders/' . $orderID);

        if ($response->successful() && $response->json('status') == 'COMPLETED') {
            // Guardar la orden en la base de datos
            $order = new Order();
            $order->user_id = $userId;
            $order->total = \Cart::session($userId)->getTotal();
            $order->save();

            // Guardar los detalles de los productos en la tabla `order_items`
            foreach (\Cart::session($userId)->getContent() as $item) {
                $orderItem = new OrderItem();
                $orderItem->order_id = $order->id;
                $orderItem->product_id = $item->id;
                $orderItem->quantity = $item->quantity;
                $orderItem->price = $item->price;
                $orderItem->save();
            }

            // Limpiar el carrito después del checkout
            \Cart::session($userId)->clear();

        // Redirigir al usuario a la página principal o a una página de confirmación
        return redirect()->route('index')->with('success_msg', 'Su pedido ha sido procesado exitosamente!');
        } else {
            return redirect()->route('checkout.index')->with('error_msg', 'Hubo un problema al procesar su pago. Por favor, intente de nuevo.');
        }
}}