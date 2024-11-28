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
                            <input type="file" name="image" id="image" class="mt-1 block w-full p-2 border rounded-md @error('image') border-red-500 @enderror">
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
