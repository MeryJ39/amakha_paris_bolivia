<footer class="bg-gray-100 text-gray-800 py-8">
    <div class="max-w-6xl mx-auto px-4">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
            <!-- Logo and Description -->
            <div>
                <img src="https://amakha.vtexassets.com/assets/vtex/assets-builder/amakha.store-theme/5.0.10/icons/logo___54cb50138c4f563e9175381f6f9c5831.svg" class="mb-4">
                <p class="text-sm">El nombre Amakha proviene del idioma zulú, uno de los 11 idiomas oficiales de Sudáfrica, y significa perfume, esencia. Este nombre fue elegido debido al origen de esta lengua, que...</p>
                <a href="#" class="text-blue-500 text-sm">Ver más</a>
            </div>

            <!-- Links Institucional -->
            <div>
                <h5 class="font-semibold mb-4">INSTITUCIONAL</h5>
                <ul class="space-y-2">
                    <li><a href="{{ url('/quienes-somos') }}" class="text-sm hover:text-blue-500">Quiénes somos</a></li>
                    <li><a href="{{ url('/mapa-del-sitio') }}" class="text-sm hover:text-blue-500">Mapa del sitio</a></li>
                    <li><a href="{{ url('/nuestro-catalogo') }}" class="text-sm hover:text-blue-500">Nuestro catálogo</a></li>
                </ul>
            </div>

            <!-- Links Ayuda -->
            <div>
                <h5 class="font-semibold mb-4">AYUDA</h5>
                <ul class="space-y-2">
                    <li><a href="{{ url('/politica-de-privacidad') }}" class="text-sm hover:text-blue-500">Política de privacidad</a></li>
                    <li><a href="{{ url('/cambios-devoluciones') }}" class="text-sm hover:text-blue-500">Cambios Devoluciones/Reembolsos</a></li>
                    <li><a href="{{ url('/condiciones-de-uso') }}" class="text-sm hover:text-blue-500">Condiciones de uso</a></li>
                    <li><a href="{{ url('/contactenos') }}" class="text-sm hover:text-blue-500">Contáctenos</a></li>
                </ul>
            </div>

            <!-- Servicio y texto a la par -->
            <div class="flex flex-col">
                <!-- Columna de Servicio -->
                <div class="flex-1">
                    <h5 class="font-semibold mb-4">SERVICIO</h5>
                    <ul class="space-y-2">
                        <li><span class="text-sm">Teléfono: +591 78 133 857</span></li>
                        <li><span class="text-sm">Correo: soporte@amakhaparis.com.bo</span></li>
                        <li><span class="text-sm">Punto de Apoyo AMAKHA PARIS BOLIVIA</span></li>
                        <li><span class="text-sm">Comercial Indana Santa Cruz de la Sierra</span></li>
                    </ul>
                </div>

                <!-- Columna de texto adicional alineado a la izquierda -->
                <div class="flex-1 mt-4">
                    <ul class="space-y-2">
                        <li><span class="text-sm">Esta página pertenece a Consultora Independiente de Amakha Paris, NO ES UNA PÁGINA OFICIAL DE LA EMPRESA</span></li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- Payment methods and footer bottom -->
        <div class="mt-8 flex justify-between items-center border-t pt-4">
            <div class="flex space-x-4">
                <img src="https://cdn.jsdelivr.net/npm/simple-icons@v6/icons/visa.svg" alt="Visa" class="h-6">
                <img src="https://cdn.jsdelivr.net/npm/simple-icons@v6/icons/mastercard.svg" alt="Mastercard" class="h-6">
                <img src="https://cdn.jsdelivr.net/npm/simple-icons@v6/icons/pix.svg" alt="Pix" class="h-6">
            </div>
            <div class="flex space-x-4">
                <img src="https://cdn.jsdelivr.net/npm/simple-icons@v6/icons/vtex.svg" alt="VTEX" class="h-6">
            </div>
        </div>
    </div>
</footer>
