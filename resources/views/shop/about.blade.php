<!-- resources/views/shop/about.blade.php -->

@extends('shop.app')

@section('content')
    <div class="max-w-7xl mx-auto px-6 py-12">
        <h1 class="text-3xl font-semibold text-center mb-6">Sobre Nosotros</h1>

        <div class="text-gray-700 space-y-6">
            <p>
                <strong>Quiénes somos:</strong> Somos una empresa dedicada a ofrecer los mejores productos de calidad para nuestros clientes. Nuestra misión es proporcionar una experiencia de compra única y personalizada, satisfaciendo todas tus necesidades.
            </p>

            <p>
                <strong>Nuestros Valores:</strong> Compromiso, calidad, confianza y servicio. Creemos en la importancia de cuidar de nuestros clientes y ofrecer productos que mejoren sus vidas.
            </p>

            <h2 class="text-2xl font-semibold">Nuestros Servicios</h2>
            <ul class="list-disc pl-6 space-y-2">
                <li>Envíos rápidos y seguros</li>
                <li>Atención al cliente 24/7</li>
                <li>Descuentos especiales para clientes frecuentes</li>
                <li>Garantía de satisfacción</li>
            </ul>

            <h2 class="text-2xl font-semibold">Nuestra Historia</h2>
            <p>
                Fundada en 2010, nuestra empresa comenzó con la visión de ofrecer productos de calidad a precios accesibles. Desde entonces, hemos crecido y ampliado nuestras operaciones, logrando ser un referente en el mercado.
            </p>

            <h2 class="text-2xl font-semibold">Contáctanos</h2>
            <p>Si tienes alguna pregunta o necesitas más información, no dudes en ponerte en contacto con nosotros. Estamos para ayudarte.</p>

            <ul class="space-y-2">
                <li><strong>Email:</strong> contacto@empresa.com</li>
                <li><strong>Teléfono:</strong> +1 800 123 4567</li>
                <li><strong>Dirección:</strong> Calle Ejemplo 123, Ciudad, País</li>
            </ul>
        </div>
    </div>
@endsection
