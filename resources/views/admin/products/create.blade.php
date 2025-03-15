<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Añadir Producto') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <!-- Nombre -->
                        <div class="mb-4">
                            <label for="name" class="block text-sm font-medium text-gray-700">{{ __('Nombre del Producto') }}</label>
                            <input type="text" name="name" id="name" value="{{ old('name') }}" class="mt-1 block w-full p-2 border rounded-md @error('name') border-red-500 @enderror" required>
                            @error('name') <p class="text-sm text-red-500">{{ $message }}</p> @enderror
                        </div>

                        <!-- Descripción -->
                        <div class="mb-4">
                            <label for="description" class="block text-sm font-medium text-gray-700">{{ __('Descripción') }}</label>
                            <textarea name="description" id="description" rows="4" class="mt-1 block w-full p-2 border rounded-md @error('description') border-red-500 @enderror">{{ old('description') }}</textarea>
                            @error('description') <p class="text-sm text-red-500">{{ $message }}</p> @enderror
                        </div>

                        <!-- Precio -->
                        <div class="mb-4">
                            <label for="price" class="block text-sm font-medium text-gray-700">{{ __('Precio') }}</label>
                            <input type="number" name="price" id="price" value="{{ old('price') }}" step="0.01" class="mt-1 block w-full p-2 border rounded-md @error('price') border-red-500 @enderror" required>
                            @error('price') <p class="text-sm text-red-500">{{ $message }}</p> @enderror
                        </div>

                        <!-- Descuento -->
                        <div class="mb-6">
                            <label for="discount" class="block text-gray-700">{{ __('Descuento') }} (Bs o %)</label>
                            <div class="flex items-center space-x-6">
                                <!-- Radio Buttons para seleccionar tipo de descuento -->
                                <div class="flex items-center">
                                    <input type="radio" id="discount_type_bs" name="discount_type" value="bs" class="form-radio text-blue-500" @checked(old('discount_type') == 'bs') />
                                    <label for="discount_type_bs" class="ml-2 text-sm text-gray-700">Descuento en Bs</label>
                                </div>
                                <div class="flex items-center">
                                    <input type="radio" id="discount_type_percentage" name="discount_type" value="percentage" class="form-radio text-green-500" @checked(old('discount_type') == 'percentage') />
                                    <label for="discount_type_percentage" class="ml-2 text-sm text-gray-700">Descuento en %</label>
                                </div>
                            </div>

                            <!-- Input de Descuento en Bs o % -->
                            <div class="mt-4">
                                <input type="number" id="discount" name="discount" value="{{ old('discount') }}" step="0.01" class="form-input w-full @error('discount') border-red-500 @enderror" placeholder="Introduce descuento" required>
                                @error('discount') <p class="text-sm text-red-500">{{ $message }}</p> @enderror
                            </div>

                            <!-- Slider solo visible si el descuento es porcentual -->
                            <div id="discount_slider" class="mt-6 hidden">
                                <label for="percentage_slider" class="block text-sm font-medium text-gray-700">Descuento en %</label>
                                <div class="relative">
                                    <input type="range" id="percentage_slider" name="percentage_slider" min="1" max="50" step="1" value="{{ old('discount', 1) }}" class="w-full h-2 bg-gray-200 rounded-lg appearance-none cursor-pointer dark:bg-gray-700">
                                    <div class="flex justify-between mt-2 text-sm text-gray-500">
                                        <span>1%</span>
                                        <span>50%</span>
                                    </div>
                                </div>
                            </div>

                            <small class="text-gray-500">Si seleccionas "Descuento en %", el valor se tomará como porcentaje sobre el precio del producto.</small>
                        </div>

                        <script>
                            // Lógica para mostrar u ocultar el slider dependiendo de la selección de tipo de descuento
                            document.addEventListener('DOMContentLoaded', function () {
                                const discountTypeBs = document.getElementById('discount_type_bs');
                                const discountTypePercentage = document.getElementById('discount_type_percentage');
                                const discountSlider = document.getElementById('discount_slider');
                                const discountInput = document.getElementById('discount');
                                const percentageSlider = document.getElementById('percentage_slider');

                                // Al cargar la página, verificamos cuál tipo de descuento estaba seleccionado previamente
                                if (discountTypePercentage.checked) {
                                    discountSlider.classList.remove('hidden');
                                    discountInput.setAttribute('readonly', true); // Hacemos el input de Bs solo lectura
                                } else {
                                    discountSlider.classList.add('hidden');
                                    discountInput.removeAttribute('readonly');
                                }

                                // Al seleccionar un radio button, ajustamos el comportamiento
                                discountTypeBs.addEventListener('change', function () {
                                    discountSlider.classList.add('hidden');
                                    discountInput.removeAttribute('readonly');
                                });

                                discountTypePercentage.addEventListener('change', function () {
                                    discountSlider.classList.remove('hidden');
                                    discountInput.setAttribute('readonly', true); // Hacemos el input de Bs solo lectura
                                    discountInput.value = percentageSlider.value; // Sincronizar el valor del slider al input
                                });

                                // Sincronizar el valor del slider con el input de descuento
                                percentageSlider.addEventListener('input', function () {
                                    discountInput.value = percentageSlider.value; // Cambiar valor del input con el slider
                                });
                            });
                        </script>

                        <!-- Stock -->
                        <div class="mb-4">
                            <label for="stock" class="block text-sm font-medium text-gray-700">{{ __('Stock') }}</label>
                            <input type="number" name="stock" id="stock" value="{{ old('stock') }}" class="mt-1 block w-full p-2 border rounded-md @error('stock') border-red-500 @enderror" required>
                            @error('stock') <p class="text-sm text-red-500">{{ $message }}</p> @enderror
                        </div>

                        <!-- Subcategoría -->
                        <div class="mb-4">
                            <label for="subcategory_id" class="block text-sm font-medium text-gray-700">{{ __('Subcategoría') }}</label>
                            <select name="subcategory_id" id="subcategory_id" class="mt-1 block w-full p-2 border rounded-md @error('subcategory_id') border-red-500 @enderror">
                                @foreach ($subcategories as $subcategory)
                                    <option value="{{ $subcategory->id }}">{{ $subcategory->name }}</option>
                                @endforeach
                            </select>
                            @error('subcategory_id') <p class="text-sm text-red-500">{{ $message }}</p> @enderror
                        </div>

                        <!-- Imagen -->
                        <div class="mb-4">
                            <label for="image" class="block text-sm font-medium text-gray-700">{{ __('Imagen') }}</label>
                            <input type="file" name="image" id="image" class="mt-1 block w-full p-2 border rounded-md @error('image') border-red-500 @enderror" required>
                            @error('image') <p class="text-sm text-red-500">{{ $message }}</p> @enderror
                        </div>

                        <div class="flex justify-end">
                            <button type="submit" class="bg-primary text-white px-6 py-2 rounded-lg">{{ __('Guardar Producto') }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
