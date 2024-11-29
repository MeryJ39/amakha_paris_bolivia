<!-- resources/views/shop/products/index.blade.php -->

@extends('shop.app')

@section('content')
<div class="max-w-7xl mx-auto px-6">

    <!-- Lista de productos -->
    <livewire:product-subcategory-list :subcategory="$subcategory" :products="$products" />

</div>
@endsection
