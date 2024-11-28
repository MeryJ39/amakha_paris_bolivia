<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Gestión de Usuarios') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    @if (session('success'))
                        <div class="mb-4 text-green-600">
                            {{ session('success') }}
                        </div>
                    @endif

                    <div class="mb-4">
                        <a href="{{ route('admin.users.create') }}" class="bg-primary text-white px-4 py-2 rounded-lg">
                            {{ __('Añadir Usuario') }}
                        </a>
                    </div>

                    <table class="min-w-full bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-700 rounded-lg">
                        <thead class="bg-primary text-white">
                            <tr>
                                <th class="px-6 py-3 text-sm font-medium text-left border-b border-gray-300 dark:border-gray-700">
                                    {{ __("Nombre") }}
                                </th>
                                <th class="px-6 py-3 text-sm font-medium text-left border-b border-gray-300 dark:border-gray-700">
                                    {{ __("Correo Electrónico") }}
                                </th>
                                <th class="px-6 py-3 text-sm font-medium text-left border-b border-gray-300 dark:border-gray-700">
                                    {{ __("Rol") }}
                                </th>
                                <th class="px-6 py-3 text-sm font-medium text-left border-b border-gray-300 dark:border-gray-700">
                                    {{ __("Acciones") }}
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $user)
                                <tr class="hover:bg-gray-100 dark:hover:bg-gray-700">
                                    <td class="px-6 py-4 text-sm text-gray-900 dark:text-gray-100 border-b border-gray-300 dark:border-gray-700">
                                        {{ $user->name }} {{ $user->last_name }}
                                    </td>
                                    <td class="px-6 py-4 text-sm text-gray-900 dark:text-gray-100 border-b border-gray-300 dark:border-gray-700">
                                        {{ $user->email }}
                                    </td>
                                    <td class="px-6 py-4 text-sm text-gray-900 dark:text-gray-100 border-b border-gray-300 dark:border-gray-700">
                                        {{ $user->role->name }}
                                    </td>
                                    <td class="px-6 py-4 text-sm text-gray-900 dark:text-gray-100 border-b border-gray-300 dark:border-gray-700">
                                        <a href="{{ route('admin.users.edit', $user->id) }}" class="text-primary hover:text-primary-dark transition-all">{{ __('Editar') }}</a> |
                                        <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:text-red-800">{{ __('Eliminar') }}</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <!-- Paginación -->
                    <div class="mt-4">
                        {{ $users->links('pagination::tailwind') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
