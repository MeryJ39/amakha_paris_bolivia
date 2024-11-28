@extends('shop.app') <!-- Usamos la plantilla principal de la tienda -->

@section('content')
<div class="container mx-auto py-8">
    <div class="bg-white shadow-md rounded-lg p-6">
        <h2 class="text-3xl font-semibold mb-4">¡Gracias por tu compra!</h2>

        <p class="text-xl">Tu pedido ha sido procesado con éxito. Aquí están los detalles de tu compra:</p>

        <!-- Detalles del pedido -->
        <div class="mt-6">
            <h3 class="text-2xl font-semibold mb-3">Detalles del Pedido</h3>
            <ul>
                <li><strong>Pedido #:</strong> {{ $order->id }}</li>
                <li><strong>Fecha:</strong> {{ $order->created_at->format('d-m-Y H:i') }}</li>
                <li><strong>Método de pago:</strong> {{ ucfirst($order->payment_method) }}</li>
                <li><strong>Dirección de envío:</strong> {{ $order->address->address }}, {{ $order->address->city }}, {{ $order->address->department }}</li>
                <li><strong>Estado:</strong> {{ ucfirst($order->status) }}</li>
            </ul>
        </div>

        <!-- Ítems del pedido -->
        <div class="mt-6">
            <h3 class="text-2xl font-semibold mb-3">Productos Comprados</h3>
            <table class="w-full border-collapse">
                <thead>
                    <tr>
                        <th class="border p-2">Producto</th>
                        <th class="border p-2">Cantidad</th>
                        <th class="border p-2">Precio</th>
                        <th class="border p-2">Descuento</th>
                        <th class="border p-2">Total</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($orderItems as $item)
                        <tr>
                            <td class="border p-2">{{ $item->product->name }}</td>
                            <td class="border p-2">{{ $item->quantity }}</td>
                            <td class="border p-2">${{ number_format($item->price_at_purchase, 2) }}</td>
                            <td class="border p-2">${{ number_format($item->unit_discount, 2) }}</td>
                            <td class="border p-2">${{ number_format($item->total_at_purchase, 2) }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Total de la compra -->
        <div class="mt-6 text-right">
            <h3 class="text-xl font-semibold">Total: ${{ number_format($order->total_amount, 2) }}</h3>
        </div>
    </div>
</div>
@endsection
