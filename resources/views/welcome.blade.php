<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bienvenido - Amakha Paris Bolivia</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-gray-100">

    <div class="min-h-screen flex flex-col items-center justify-center py-12 px-6 sm:px-8">

        <div class="text-center">
            <h1 class="text-4xl font-extrabold text-gray-900">Bienvenido a Amakha Paris Bolivia</h1>
            <p class="mt-2 text-sm text-gray-600">Inicia sesión con tu código de colaborador.</p>
        </div>

        <!-- Formulario de Login -->
        <div class="mt-6 w-full max-w-md space-y-8">
            <div class="bg-white py-8 px-6 shadow-lg sm:rounded-lg sm:px-10">
                <form method="POST" action="{{ route('login') }}" class="space-y-6">
                    @csrf

                    <!-- Campo de Código de Colaborador -->
                    <div>
                        <label for="collaborator_code" class="block text-sm font-medium text-gray-700">Código de Colaborador</label>
                        <div class="mt-1">
                            <input id="collaborator_code" name="collaborator_code" type="text" required class="block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" autofocus>
                        </div>
                    </div>

                    <!-- Campo de Contraseña -->
                    <div>
                        <label for="password" class="block text-sm font-medium text-gray-700">Contraseña</label>
                        <div class="mt-1">
                            <input id="password" name="password" type="password" required class="block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                        </div>
                    </div>

                    <!-- Botón de Iniciar Sesión -->
                    <div>
                        <button type="submit" class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            Iniciar Sesión
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

</body>
</html>
