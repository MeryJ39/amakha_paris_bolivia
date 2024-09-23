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

            <form action="{{ route('checkout.process') }}" method="POST">
                @csrf
                <input type="hidden" name="total_amount" value="{{ $totalAmount }}">
                <input type="hidden" name="cart_items" value="{{ json_encode($cartCollection) }}">
                <button type="submit" class="mt-5 bg-blue-500 text-white px-4 py-2 rounded">Realizar Pago</button>
            </form>

        </div>
    </div>
</div>
@endsection
