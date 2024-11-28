<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Crear Nueva Subcategoría') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <!-- Formulario para crear subcategoría -->
                    <form action="{{ route('admin.subcategories.store') }}" method="POST">
                        @csrf

                        <div class="mb-4">
                            <label for="name" class="block text-gray-700 dark:text-gray-200">{{ __('Nombre de la Subcategoría') }}</label>
                            <input type="text" name="name" id="name" class="w-full px-4 py-2 border border-gray-300 rounded-lg" required>
                        </div>

                        <div class="mb-4">
                            <label for="category_id" class="block text-gray-700 dark:text-gray-200">{{ __('Categoría') }}</label>
                            <select name="category_id" id="category_id" class="w-full px-4 py-2 border border-gray-300 rounded-lg" required>
                                <option value="">{{ __('Seleccionar categoría') }}</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-4">
                            <label for="description" class="block text-gray-700 dark:text-gray-200">{{ __('Descripción') }}</label>
                            <textarea name="description" id="description" class="w-full px-4 py-2 border border-gray-300 rounded-lg"></textarea>
                        </div>

                        <div class="mb-4">
                            <button type="submit" class="bg-primary text-white px-4 py-2 rounded-lg">{{ __('Crear Subcategoría') }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
