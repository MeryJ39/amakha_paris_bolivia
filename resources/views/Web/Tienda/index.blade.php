@extends('welcome')


@section('contenido')
<!-- Carrusel de banners -->
<div id="default-carousel" class="relative w-full z-0" data-carousel="slide">
    <!-- Carousel wrapper -->
    <div class="relative h-56 rounded-lg md:h-96">
        <!-- Item 1 -->
        <div class="hidden duration-700 ease-in-out" data-carousel-item>
            <img src="https://amakha.vtexassets.com/assets/vtex.file-manager-graphql/images/14d91d68-4f89-47d0-8983-035229d3e9bd___cbafdfb19d5de201666b2a6f4bde2c46.webp" class="absolute block w-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2" alt="Banner 1">
        </div>
        <!-- Item 2 -->
        <div class="hidden duration-700 ease-in-out" data-carousel-item>
            <img src="https://amakha.vtexassets.com/assets/vtex.file-manager-graphql/images/9585d304-d7d7-4b04-b3d4-79a9262c7683___c4333d150329f393a6a4e7d057bbbd7d.webp" class="absolute block w-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2" alt="Banner 2">
        </div>
        <!-- Item 3 -->
        <div class="hidden duration-700 ease-in-out" data-carousel-item>
            <img src="https://amakha.vtexassets.com/assets/vtex.file-manager-graphql/images/df3dbd5c-4118-4b85-a7fb-1fdb6469a121___7ccff7a7168c0c6750c9b2c9a780310c.webp" class="absolute block w-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2" alt="Banner 3">
        </div>
        <!-- Item 4 -->
        <div class="hidden duration-700 ease-in-out" data-carousel-item>
            <img src="https://amakha.vtexassets.com/assets/vtex.file-manager-graphql/images/bf388327-da13-4ff6-a17b-462b6fa03c51___21871e4c250a94ec91fc75fe5384b786.webp" class="absolute block w-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2" alt="Banner 4">
        </div>
    </div>

    <!-- Slider indicators -->
    <div class="absolute z-30 flex -translate-x-1/2 bottom-5 left-1/2 space-x-3 rtl:space-x-reverse">
        <button type="button" class="w-3 h-3 rounded-full" aria-current="true" aria-label="Slide 1" data-carousel-slide-to="0"></button>
        <button type="button" class="w-3 h-3 rounded-full" aria-current="false" aria-label="Slide 2" data-carousel-slide-to="1"></button>
        <button type="button" class="w-3 h-3 rounded-full" aria-current="false" aria-label="Slide 3" data-carousel-slide-to="2"></button>
        <button type="button" class="w-3 h-3 rounded-full" aria-current="false" aria-label="Slide 4" data-carousel-slide-to="3"></button>
    </div>

    <!-- Slider controls -->
    <button type="button" class="absolute top-0 start-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none" data-carousel-prev>
        <span class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-white/30 dark:bg-gray-800/30 group-hover:bg-white/50 dark:group-hover:bg-gray-800/60 group-focus:ring-4 group-focus:ring-white dark:group-focus:ring-gray-800/70 group-focus:outline-none">
            <svg class="w-4 h-4 text-white dark:text-gray-800 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 1 1 5l4 4"/>
            </svg>
            <span class="sr-only">Previous</span>
        </span>
    </button>
    <button type="button" class="absolute top-0 end-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none" data-carousel-next>
        <span class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-white/30 dark:bg-gray-800/30 group-hover:bg-white/50 dark:group-hover:bg-gray-800/60 group-focus:ring-4 group-focus:ring-white dark:group-focus:ring-gray-800/70 group-focus:outline-none">
            <svg class="w-4 h-4 text-white dark:text-gray-800 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4"/>
            </svg>
            <span class="sr-only">Next</span>
        </span>
    </button>
</div>


<div id="tienda" class="container mx-auto px-4 py-6">
    <div class="text-center mb-6">
        <h4 class="text-2xl font-semibold">Productos</h4>
        <hr class="my-4 border-gray-300">
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
        @foreach($products as $pro)
        <div class="bg-white border rounded-lg shadow-md overflow-hidden">
            <img src="{{ URL::asset('storage/img/carrito/'.$pro->image_path) }}" alt="{{ $pro->image_path }}" class="w-full h-48 object-cover">
            <div class="p-4 text-center">
                <a href="#">
                    <h6 class="text-lg font-medium text-gray-800">{{ $pro->name }}</h6>
                </a>
                <p class="text-xl font-semibold text-gray-600">${{ $pro->price }}</p>
                <form action="{{ route('cart.store') }}" method="POST" class="mt-4">
                    @csrf
                    <input type="hidden" value="{{ $pro->id }}" name="id">
                    <input type="hidden" value="{{ $pro->name }}" name="name">
                    <input type="hidden" value="{{ $pro->price }}" name="price">
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




