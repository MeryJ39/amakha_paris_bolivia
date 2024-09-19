@extends('welcome')
@section('titulo', 'Checkout')
@section('contenido')
<div class="container mx-auto my-5 py-3 bg-white shadow-lg rounded-lg">
    <h2 class="text-center text-2xl font-bold mb-6">Resumen de tu compra</h2>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <div>
            @foreach($cartCollection as $item)
            <div class="flex justify-between border-b py-3">
                <span>{{ $item->name }} ({{ $item->quantity }})</span>
                <span>${{ $item->price }}</span>
            </div>
            @endforeach
        </div>
        <div>
            <h3 class="text-xl font-bold">Total a pagar: ${{ $totalAmount }}</h3>

            <div id="paypal-button-container" class="mt-5"></div>
        </div>
    </div>
</div>

<!-- PayPal SDK -->
<script src="https://www.paypal.com/sdk/js?client-id={{ env('PAYPAL_CLIENT_ID') }}&currency=USD"></script>

<script>
    paypal.Buttons({
        createOrder: function(data, actions) {
            return actions.order.create({
                purchase_units: [{
                    amount: {
                        value: '{{ $totalAmount }}' // Total amount to be paid
                    }
                }]
            });
        },
        onApprove: function(data, actions) {
            return actions.order.capture().then(function(details) {
                // Redirige al usuario para procesar el pedido
                window.location.href = '{{ route("checkout.process") }}?orderID=' + data.orderID;
            });
        }
    }).render('#paypal-button-container');
</script>
@endsection
