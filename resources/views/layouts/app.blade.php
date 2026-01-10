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
    <body class="font-sans antialiased bg-gray-50">
        <div class="min-h-screen flex">
            <!-- Sidebar -->
            <div class="hidden lg:flex lg:w-64 lg:flex-col lg:fixed lg:inset-y-0">
                <div class="flex flex-col flex-grow bg-gradient-to-b from-blue-600 to-indigo-700 pt-5 pb-4 overflow-y-auto">
                    <!-- Logo -->
                    <div class="flex items-center flex-shrink-0 px-4">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <div class="w-8 h-8 bg-white rounded-lg flex items-center justify-center">
                                    <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                </div>
                            </div>
                            <div class="ml-3">
                                <h1 class="text-xl font-bold text-white">POS System</h1>
                            </div>
                        </div>
                    </div>

                    <!-- Navigation -->
                    <div class="mt-8 flex-grow flex flex-col">
                        <nav class="flex-1 px-2 space-y-1">
                            <!-- Dashboard -->
                            <a href="{{ route('dashboard') }}" class="group flex items-center px-2 py-2 text-sm font-medium rounded-md {{ request()->routeIs('dashboard') ? 'bg-blue-800 text-white' : 'text-blue-100 hover:bg-blue-700 hover:text-white' }}">
                                <svg class="mr-3 h-6 w-6 {{ request()->routeIs('dashboard') ? 'text-blue-300' : 'text-blue-400 group-hover:text-blue-300' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2H5a2 2 0 00-2-2z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 5a2 2 0 012-2h4a2 2 0 012 2v2H8V5z"></path>
                                </svg>
                                Dashboard
                            </a>

                            <!-- Products -->
                            <a href="{{ route('products.index') }}" class="group flex items-center px-2 py-2 text-sm font-medium rounded-md {{ request()->routeIs('products.*') ? 'bg-blue-800 text-white' : 'text-blue-100 hover:bg-blue-700 hover:text-white' }}">
                                <svg class="mr-3 h-6 w-6 {{ request()->routeIs('products.*') ? 'text-blue-300' : 'text-blue-400 group-hover:text-blue-300' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                                </svg>
                                Productos
                            </a>

                            <!-- Customers -->
                            <a href="{{ route('customers.index') }}" class="group flex items-center px-2 py-2 text-sm font-medium rounded-md {{ request()->routeIs('customers.*') ? 'bg-blue-800 text-white' : 'text-blue-100 hover:bg-blue-700 hover:text-white' }}">
                                <svg class="mr-3 h-6 w-6 {{ request()->routeIs('customers.*') ? 'text-blue-300' : 'text-blue-400 group-hover:text-blue-300' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z"></path>
                                </svg>
                                Clientes
                            </a>

                            <!-- Suppliers -->
                            <a href="{{ route('suppliers.index') }}" class="group flex items-center px-2 py-2 text-sm font-medium rounded-md {{ request()->routeIs('suppliers.*') ? 'bg-blue-800 text-white' : 'text-blue-100 hover:bg-blue-700 hover:text-white' }}">
                                <svg class="mr-3 h-6 w-6 {{ request()->routeIs('suppliers.*') ? 'text-blue-300' : 'text-blue-400 group-hover:text-blue-300' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                                </svg>
                                Proveedores
                            </a>

                            <!-- Categories -->
                            <a href="{{ route('categories.index') }}" class="group flex items-center px-2 py-2 text-sm font-medium rounded-md {{ request()->routeIs('categories.*') ? 'bg-blue-800 text-white' : 'text-blue-100 hover:bg-blue-700 hover:text-white' }}">
                                <svg class="mr-3 h-6 w-6 {{ request()->routeIs('categories.*') ? 'text-blue-300' : 'text-blue-400 group-hover:text-blue-300' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                                </svg>
                                Categorías
                            </a>

                            <!-- POS -->
                            <a href="{{ route('pos.index') }}" class="group flex items-center px-2 py-2 text-sm font-medium rounded-md {{ request()->routeIs('pos.*') ? 'bg-blue-800 text-white' : 'text-blue-100 hover:bg-blue-700 hover:text-white' }}">
                                <svg class="mr-3 h-6 w-6 {{ request()->routeIs('pos.*') ? 'text-blue-300' : 'text-blue-400 group-hover:text-blue-300' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4m0 0L7 13m0 0l-2.5 5M7 13l2.5 5m6-5v6a2 2 0 01-2 2H9a2 2 0 01-2-2v-6m8 0V9a2 2 0 00-2-2H9a2 2 0 00-2 2v4.01"></path>
                                </svg>
                                Punto de Venta
                            </a>

                            <!-- Sales -->
                            <a href="{{ route('sales.index') }}" class="group flex items-center px-2 py-2 text-sm font-medium rounded-md {{ request()->routeIs('sales.*') ? 'bg-blue-800 text-white' : 'text-blue-100 hover:bg-blue-700 hover:text-white' }}">
                                <svg class="mr-3 h-6 w-6 {{ request()->routeIs('sales.*') ? 'text-blue-300' : 'text-blue-400 group-hover:text-blue-300' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                </svg>
                                Ventas
                            </a>

                            <!-- Reports -->
                            <div class="pt-4">
                                <div class="px-2">
                                    <h3 class="px-3 text-xs font-semibold text-blue-300 uppercase tracking-wider">Reportes</h3>
                                </div>
                                <div class="mt-2 space-y-1">
                                    <a href="{{ route('reports.sales') }}" class="group flex items-center px-2 py-2 text-sm font-medium rounded-md {{ request()->routeIs('reports.sales') ? 'bg-blue-800 text-white' : 'text-blue-100 hover:bg-blue-700 hover:text-white' }}">
                                        <svg class="mr-3 h-6 w-6 {{ request()->routeIs('reports.sales') ? 'text-blue-300' : 'text-blue-400 group-hover:text-blue-300' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                                        </svg>
                                        Ventas
                                    </a>
                                    <a href="{{ route('reports.low_stock') }}" class="group flex items-center px-2 py-2 text-sm font-medium rounded-md {{ request()->routeIs('reports.low_stock') ? 'bg-blue-800 text-white' : 'text-blue-100 hover:bg-blue-700 hover:text-white' }}">
                                        <svg class="mr-3 h-6 w-6 {{ request()->routeIs('reports.low_stock') ? 'text-blue-300' : 'text-blue-400 group-hover:text-blue-300' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.732 16.5c-.77.833.192 2.5 1.732 2.5z"></path>
                                        </svg>
                                        Stock Bajo
                                    </a>
                                </div>
                            </div>
                        </nav>
                    </div>

                    <!-- User Profile -->
                    <div class="flex-shrink-0 flex border-t border-blue-800 p-4">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <div class="w-8 h-8 bg-blue-800 rounded-full flex items-center justify-center">
                                    <span class="text-sm font-medium text-blue-200">{{ substr(Auth::user()->name, 0, 1) }}</span>
                                </div>
                            </div>
                            <div class="ml-3">
                                <p class="text-sm font-medium text-white">{{ Auth::user()->name }}</p>
                                <p class="text-xs text-blue-300">{{ Auth::user()->email }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Main Content -->
            <div class="lg:pl-64 flex flex-col flex-1">
                <!-- Top Navigation -->
                <div class="sticky top-0 z-10 flex-shrink-0 flex h-16 bg-white shadow">
                    <button type="button" class="px-4 border-r border-gray-200 text-gray-500 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-indigo-500 lg:hidden">
                        <span class="sr-only">Open sidebar</span>
                        <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h7"></path>
                        </svg>
                    </button>
                    <div class="flex-1 px-4 flex justify-between">
                        <div class="flex-1 flex items-center">
                            @isset($header)
                                <h1 class="text-2xl font-semibold text-gray-900">{{ $header }}</h1>
            @endisset
                        </div>
                        <div class="ml-4 flex items-center md:ml-6">
                            <!-- Profile dropdown -->
                            <div class="ml-3 relative">
                                <div class="flex items-center space-x-4">
                                    <span class="text-sm text-gray-700">{{ Auth::user()->name }}</span>
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <button type="submit" class="text-sm text-gray-500 hover:text-gray-700 focus:outline-none focus:text-gray-700 transition-colors">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                                            </svg>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            <!-- Page Content -->
                <main class="flex-1 relative overflow-y-auto focus:outline-none">
                    <div class="py-6">
                        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                {{ $slot }}
                        </div>
                    </div>
            </main>
            </div>
        </div>
    </body>
</html>
