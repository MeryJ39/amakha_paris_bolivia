<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Crear Descuento') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form action="{{ route('admin.discounts.store') }}" method="POST">
                        @csrf

                        <div class="mb-4">
                            <label for="role_id" class="block text-sm font-medium text-gray-700">{{ __('Rol') }}</label>
                            <select name="role_id" id="role_id" class="block w-full mt-1">
                                @foreach ($roles as $role)
                                    <option value="{{ $role->id }}">{{ $role->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-4">
                            <label for="product_id" class="block text-sm font-medium text-gray-700">{{ __('Producto') }}</label>
                            <select name="product_id" id="product_id" class="block w-full mt-1">
                                @foreach ($products as $product)
                                    <option value="{{ $product->id }}">{{ $product->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-4">
                            <label for="discount_amount" class="block text-sm font-medium text-gray-700">{{ __('Monto del Descuento') }}</label>
                            <input type="number" name="discount_amount" id="discount_amount" class="block w-full mt-1" value="{{ old('discount_amount') }}" required>
                        </div>

                        <div class="mb-4">
                            <label for="start_date" class="block text-sm font-medium text-gray-700">{{ __('Fecha de Inicio') }}</label>
                            <input type="date" name="start_date" id="start_date" class="block w-full mt-1" value="{{ old('start_date') }}" required>
                        </div>

                        <div class="mb-4">
                            <label for="end_date" class="block text-sm font-medium text-gray-700">{{ __('Fecha de Fin') }}</label>
                            <input type="date" name="end_date" id="end_date" class="block w-full mt-1" value="{{ old('end_date') }}" required>
                        </div>

                        <div class="mb-4">
                            <button type="submit" class="bg-primary text-white px-4 py-2 rounded-md">{{ __('Guardar Descuento') }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
