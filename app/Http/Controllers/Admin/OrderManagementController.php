<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderManagementController extends Controller
{
    // Mostrar todos los pedidos con su estado y filtros
    public function index(Request $request)
    {
        // Recibir filtros desde la solicitud
        $status = $request->get('status'); // Filtro por estado
        $search = $request->get('search'); // Filtro por número de pedido
        $startDate = $request->get('start_date'); // Filtro por fecha de inicio
        $endDate = $request->get('end_date'); // Filtro por fecha de fin

        // Filtrar pedidos según los parámetros proporcionados
        $orders = Order::with('user', 'address')  // Incluir relaciones
            ->when($status, function ($query) use ($status) {
                // Filtro por estado: Asegurarse de que el estado sea uno válido
                $validStatuses = ['pending', 'processing', 'shipped', 'delivered'];
                if (in_array($status, $validStatuses)) {
                    return $query->where('status', $status);
                }
            })
            ->when($search, function ($query) use ($search) {
                // Filtro por número de pedido (asumiendo que es el id del pedido)
                return $query->where('id', 'like', '%' . $search . '%');
            })
            ->when($startDate, function ($query) use ($startDate) {
                // Filtro por fecha de inicio (asegurarse de que sea una fecha válida)
                return $query->whereDate('created_at', '>=', $startDate);
            })
            ->when($endDate, function ($query) use ($endDate) {
                // Filtro por fecha de fin (asegurarse de que sea una fecha válida)
                return $query->whereDate('created_at', '<=', $endDate);
            })
            ->paginate(10); // Paginación con 10 elementos por página

        return view('admin.orders.index', compact('orders'));
    }

    // Cambiar el estado del pedido
    public function updateStatus(Request $request, $id)
    {
        // Validar el estado
        $validStatuses = ['pending', 'processing', 'shipped', 'delivered'];
        if (!in_array($request->status, $validStatuses)) {
            return redirect()->route('admin.orders.index')->with('error', 'Estado inválido.');
        }

        // Actualizar el estado del pedido
        $order = Order::findOrFail($id);
        $order->status = $request->status; // Cambiar estado
        $order->save();

        return redirect()->route('admin.orders.index')->with('success', 'Estado del pedido actualizado correctamente.');
    }

    // Ver detalles del pedido (productos, cliente, dirección)
    public function show($id)
    {
        // Traer pedido con todas las relaciones necesarias
        $order = Order::with(['user', 'address', 'items.product'])->findOrFail($id);
        return view('admin.orders.show', compact('order'));
    }
}