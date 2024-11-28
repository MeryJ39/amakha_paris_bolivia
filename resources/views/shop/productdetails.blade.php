@extends('shop.app') <!-- Usamos la plantilla principal de la tienda -->

@section('content')
<div>
    <!-- Incluir el componente de Livewire -->
    @livewire('product-details', ['productId' => $product->id])
</div>
@endsection
