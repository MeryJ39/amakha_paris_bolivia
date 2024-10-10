@extends('welcome')



@section('contenido')
<div class="p-4">
    {{-- @include('Web.Home.portada') --}}
</div>

<!-- Carrusel de banners -->
<div class="relative">
    <div class="slick-carousel">
        <div>
            <img src="https://amakha.vtexassets.com/assets/vtex.file-manager-graphql/images/14d91d68-4f89-47d0-8983-035229d3e9bd___cbafdfb19d5de201666b2a6f4bde2c46.webp" alt="Banner 1" class="w-full h-64 object-cover">
        </div>
        <div>
            <img src="https://amakha.vtexassets.com/assets/vtex.file-manager-graphql/images/9585d304-d7d7-4b04-b3d4-79a9262c7683___c4333d150329f393a6a4e7d057bbbd7d.webp" alt="Banner 2" class="w-full h-64 object-cover">
        </div>
        <div>
            <img src="https://amakha.vtexassets.com/assets/vtex.file-manager-graphql/images/df3dbd5c-4118-4b85-a7fb-1fdb6469a121___7ccff7a7168c0c6750c9b2c9a780310c.webp" alt="Banner 3" class="w-full h-64 object-cover">
        </div>
        <div>
            <img src="https://amakha.vtexassets.com/assets/vtex.file-manager-graphql/images/bf388327-da13-4ff6-a17b-462b6fa03c51___21871e4c250a94ec91fc75fe5384b786.webp" alt="Banner 4" class="w-full h-64 object-cover">
        </div>
    </div>

    <!-- Opcional: Controles de navegación si los necesitas -->
    <button class="slick-prev">Prev</button>
    <button class="slick-next">Next</button>
</div>


<h1>{{ $category->name }}</h1>
    <h2>Productos</h2>
    <ul>
        @foreach($category->products as $product)
            <li>{{ $product->name }}</li>
        @endforeach
    </ul>

    <h2>Subcategorías</h2>
    <ul>
        @foreach($category->subcategories as $subcategory)
            <li>{{ $subcategory->name }}</li>
        @endforeach
    </ul>

<div id="tienda" class="container mx-auto px-4 py-6">
    <div class="text-center mb-6">
        <h4 class="text-2xl font-semibold">Productos en Oferta</h4>
        <hr class="my-4 border-gray-300">
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
        @foreach($products as $pro)
        <div class="bg-white border rounded-lg shadow-md overflow-hidden relative">
            @if($pro->image_path)
                <img src="{{ URL::asset('storage/img/carrito/' . $pro->image_path) }}" alt="{{ $pro->name }}" class="w-full h-48 object-cover">
            @endif
            @if($pro->precio_venta < $pro->price)
                <div class="absolute top-0 right-0 bg-red-500 text-white text-xs font-bold px-2 py-1 rounded-bl-lg">
                    ¡Oferta!
                </div>
            @endif
            <div class="p-4 text-center">
                <a href="#">
                    <h6 class="text-lg font-medium text-gray-800">{{ $pro->name }}</h6>
                </a>
                <div class="text-xl font-semibold text-gray-600">
                    @if($pro->precio_venta > $pro->price)
                        <span class="line-through text-gray-500">${{ number_format($pro->price, 2) }}</span><br>
                        ${{ number_format($pro->precio_venta, 2) }}
                    @else
                        ${{ number_format($pro->price, 2) }}
                    @endif
                </div>
                <form action="{{ route('cart.store') }}" method="POST" class=" mt-4">
                    @csrf
                    <input type="hidden" value="{{ $pro->id }}" name="id">
                    <input type="hidden" value="{{ $pro->name }}" name="name">
                    <input type="hidden" value="{{ $pro->precio_venta < $pro->price ? $pro->precio_venta : $pro->price }}" name="price">
                    <input type="hidden" value="{{ $pro->description }}" name="description">
                    <input type="hidden" value="{{ $pro->image_path }}" name="img">
                    <input type="hidden" value="{{ $pro->slug }}" name="slug">
                    <input type="hidden" value="1" name="quantity">
                    <div class="mt-4">
                        <button type="submit" class="w-full py-2 px-4 bg-green-500 text-white rounded-md hover:bg-green-600 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-opacity-50">
                            <i class="fa fa-shopping-cart"></i> Agregar al carrito
                        </button>
                    </div>
                </form>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection

