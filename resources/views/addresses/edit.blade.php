<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Editar Dirección') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form action="{{ route('addresses.update', $address) }}" method="POST">
                        @csrf
                        @method('PUT') <!-- Es necesario para indicar que es una solicitud de actualización -->

                        <div class="space-y-6">
                            <div>
                                <label for="address" class="block text-gray-700 dark:text-gray-200">{{ __('Dirección') }}</label>
                                <input type="text" name="address" id="address" class="w-full p-3 border rounded-md" value="{{ old('address', $address->address) }}" required>
                            </div>

                            <div>
                                <label for="city" class="block text-gray-700 dark:text-gray-200">{{ __('Ciudad') }}</label>
                                <input type="text" name="city" id="city" class="w-full p-3 border rounded-md" value="{{ old('city', $address->city) }}" required>
                            </div>

                            <div>
                                <label for="department" class="block text-gray-700 dark:text-gray-200">{{ __('Departamento') }}</label>
                                <select name="department" id="department" class="w-full p-3 border rounded-md" required>
                                    <option value="">Seleccionar Departamento</option>
                                    @foreach(['La Paz', 'Santa Cruz', 'Cochabamba', 'Potosí', 'Chuquisaca', 'Tarija', 'Oruro', 'Beni', 'Pando'] as $department)
                                        <option value="{{ $department }}" {{ old('department', $address->department) == $department ? 'selected' : '' }}>{{ $department }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div>
                                <label for="phone_number" class="block text-gray-700 dark:text-gray-200">{{ __('Número de Teléfono') }}</label>
                                <input type="text" name="phone_number" id="phone_number" class="w-full p-3 border rounded-md" value="{{ old('phone_number', $address->phone_number) }}" required>
                            </div>

                            <div>
                                <label for="is_default" class="inline-block text-gray-700 dark:text-gray-200">{{ __('Establecer como predeterminada') }}</label>
                                <!-- Campo oculto para is_default=0 -->
                                <input type="hidden" name="is_default" value="0">
                                <!-- El checkbox será marcado si la dirección es predeterminada -->
                                <input type="checkbox" name="is_default" id="is_default" value="1" {{ old('is_default', $address->is_default) ? 'checked' : '' }}>
                            </div>

                            <div class="mt-6">
                                <button type="submit" class="bg-primary text-white px-4 py-2 rounded-md">{{ __('Actualizar Dirección') }}</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
