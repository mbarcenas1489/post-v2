<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'POS') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body>
        <div class="min-h-screen flex items-center justify-center p-4">
            <div class="w-full max-w-md">
                <!-- Logo y título -->
                <div class="mb-8 text-center fade-in-up">
                    <div class="inline-flex items-center justify-center w-20 h-20 login-logo mb-6">
                        <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <h1 class="text-3xl font-bold text-gray-900 mb-2">POS System</h1>
                    <p class="text-gray-600">Sistema de Inventario y Facturación</p>
                </div>

                <!-- Formulario -->
                <div class="login-container fade-in-up">
                    {{ $slot }}
                </div>

                <!-- Footer -->
                <div class="mt-8 text-center fade-in-up">
                    <p class="text-sm text-gray-500">
                        © {{ date('Y') }} POS System • Todos los derechos reservados
                    </p>
                </div>
            </div>
        </div>
    </body>
</html>