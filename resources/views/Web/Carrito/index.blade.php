@extends('welcome')
@section('titulo', 'Obed Sánchez | Tienda')
@section ('imagen' , ('storage/img/uploads/blog-tecnologia-informatica-redes.jpg'))
@section('url' , '')
@section('estracto' , 'Bienvenido a mi blog oficial, sitio dedicado a la tienda')
@section('contenido')
<div class="container mx-auto my-5 py-3 bg-white shadow-lg rounded-lg">
    <div id="carrito">
        <section class="text-gray-700">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-100">
                        <tr>
                            <th></th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Producto
                            </th>
                            <th></th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Precio
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Cantidad
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @if(session()->has('success_msg'))
                        <div class="alert alert-success bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                            {{ session()->get('success_msg') }}
                        </div>
                        @endif
                        @if(session()->has('alert_msg'))
                        <div class="alert alert-warning bg-yellow-100 border border-yellow-400 text-yellow-700 px-4 py-3 rounded relative" role="alert">
                            {{ session()->get('alert_msg') }}
                            <button type="button" class="absolute top-0 right-0 px-4 py-3">
                                <svg class="fill-current h-6 w-6 text-yellow-700" role="button" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M14.293 6.293a1 1 0 010 1.414L11.414 11l2.879 2.879a1 1 0 01-1.414 1.414L10 12.414l-2.879 2.879a1 1 0 01-1.414-1.414L8.586 11 5.707 8.121a1 1 0 011.414-1.414L10 9.586l2.879-2.879a1 1 0 011.414 0z"/></svg>
                            </button>
                        </div>
                        @endif
                        @if(count($errors) > 0)
                        @foreach($errors->all() as $error)
                        <div class="alert alert-error bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                            {{ $error }}
                            <button type="button" class="absolute top-0 right-0 px-4 py-3">
                                <svg class="fill-current h-6 w-6 text-red-700" role="button" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M14.293 6.293a1 1 0 010 1.414L11.414 11l2.879 2.879a1 1 0 01-1.414 1.414L10 12.414l-2.879 2.879a1 1 0 01-1.414-1.414L8.586 11 5.707 8.121a1 1 0 011.414-1.414L10 9.586l2.879-2.879a1 1 0 011.414 0z"/></svg>
                            </button>
                        </div>
                        @endforeach
                        @endif
                        @if(\Cart::getTotalQuantity() > 0)
                        <tr>
                            <td colspan="5" class="px-6 py-4 text-center text-lg font-semibold text-gray-900">
                                {{ \Cart::getTotalQuantity() }} Producto(s) en el carrito
                            </td>
                        </tr>
                        @else
                        <tr>
                            <td colspan="5" class="px-6 py-4 text-center">
                                <h4 class="text-xl font-semibold">No Product(s) In Your Cart</h4>
                                <a href="/" class="mt-4 inline-block bg-gray-800 text-white px-4 py-2 rounded-md hover:bg-gray-700">Ir a la tienda</a>
                            </td>
                        </tr>
                        @endif
                        @foreach($cartCollection as $item)
                        <tr>
                            <td class="px-6 py-4">
                                <img src="{{ URL::asset('storage/img/carrito/'.$item->attributes->image) }}" alt="" class="w-24 h-24 object-cover rounded-lg">
                                <p class="mt-3 text-gray-900">{{ $item->description }}</p>
                            </td>
                            <td class="px-6 py-4 text-gray-900">{{ $item->name }}</td>
                            <td></td>
                            <td class="px-6 py-4 text-gray-900">${{ $item->price }}</td>
                            <td class="px-6 py-4">
                                <form action="{{ route('cart.update') }}" method="POST" class="inline-flex items-center">
                                    {{ csrf_field() }}
                                    <input type="hidden" value="{{ $item->id }}" name="id">
                                    <input type="number" class="form-input form-input-sm rounded-md border border-gray-600 " value="{{ $item->quantity }}" name="quantity" style="width: 70px;">
                                    <button class="ml-2 bg-blue-500 text-white px-2 py-1  rounded-md hover:bg-blue-600" type="submit">
                                        <i class="fa fa-edit"></i>
                                    </button>
                                </form>
                                <form action="{{ route('cart.remove') }}" method="POST" class="inline-flex items-center">
                                    {{ csrf_field() }}
                                    <input type="hidden" value="{{ $item->id }}" name="id">
                                    <button class="ml-2 bg-red-500 text-white px-2 py-1   rounded-md hover:bg-red-600" type="submit">
                                        <i class="fa fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="text-center mt-5">
                    <h2 class="text-2xl font-bold text-gray-900">${{ \Cart::getTotal() }}</h2>
                    <div class="mt-4">
                        <a href="{{ route('checkout.index') }}" class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600">Proceder al CheckOut</a>
                        <a href="{{ route('index') }}" class="ml-4 bg-green-500 text-white px-4 py-2 rounded-md hover:bg-green-600">Seguir comprando</a>
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>
@endsection
@push('estilos')
<link rel="stylesheet" href="{{ URL::asset('FrontEnd/css/tienda.css') }}">
@endpush
