<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Crear Usuario') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form action="{{ route('admin.users.store') }}" method="POST">
                        @csrf
                        <div class="grid grid-cols-1 gap-6">
                            <div class="flex flex-col">
                                <label for="name" class="text-gray-700 dark:text-gray-300">{{ __('Nombre') }}</label>
                                <input type="text" name="name" id="name" class="rounded-md" required>
                            </div>
                            <div class="flex flex-col">
                                <label for="last_name" class="text-gray-700 dark:text-gray-300">{{ __('Apellido') }}</label>
                                <input type="text" name="last_name" id="last_name" class="rounded-md" required>
                            </div>
                            <div class="flex flex-col">
                                <label for="email" class="text-gray-700 dark:text-gray-300">{{ __('Correo Electrónico') }}</label>
                                <input type="email" name="email" id="email" class="rounded-md" required>
                            </div>
                            <div class="flex flex-col">
                                <label for="password" class="text-gray-700 dark:text-gray-300">{{ __('Contraseña') }}</label>
                                <input type="password" name="password" id="password" class="rounded-md" required>
                            </div>
                            <div class="flex flex-col">
                                <label for="password_confirmation" class="text-gray-700 dark:text-gray-300">{{ __('Confirmar Contraseña') }}</label>
                                <input type="password" name="password_confirmation" id="password_confirmation" class="rounded-md" required>
                            </div>
                            <div class="flex flex-col">
                                <label for="phone" class="text-gray-700 dark:text-gray-300">{{ __('Teléfono') }}</label>
                                <input type="text" name="phone" id="phone" class="rounded-md">
                            </div>
                            <div class="flex flex-col">
                                <label for="role_id" class="text-gray-700 dark:text-gray-300">{{ __('Rol') }}</label>
                                <select name="role_id" id="role_id" class="rounded-md" required>
                                    @foreach ($roles as $role)
                                        <option value="{{ $role->id }}">{{ $role->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="mt-4">
                            <button type="submit" class="bg-primary text-white px-4 py-2 rounded-md">
                                {{ __('Crear Usuario') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
