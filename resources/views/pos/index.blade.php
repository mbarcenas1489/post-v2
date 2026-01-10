<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-3xl font-bold text-gray-900">Punto de Venta</h1>
                <p class="text-gray-600 mt-1">Sistema de ventas profesional</p>
            </div>
            <div class="flex items-center space-x-4">
                <div class="bg-gradient-to-r from-green-500 to-green-600 text-white px-4 py-2 rounded-lg text-sm font-medium shadow-lg">
                    <svg class="w-4 h-4 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"></path>
                    </svg>
                    Modo Efectivo
                </div>
                <div class="bg-blue-100 text-blue-800 px-3 py-1 rounded-full text-sm font-medium">
                    <svg class="w-4 h-4 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    {{ now()->format('H:i') }}
                </div>
            </div>
        </div>
    </x-slot>

    <div class="grid grid-cols-1 xl:grid-cols-4 gap-6 h-full">
        <!-- Productos - Izquierda -->
        <div class="xl:col-span-3 order-1 xl:order-1">
            <div class="bg-white rounded-2xl shadow-xl border border-gray-200 overflow-hidden">
                <!-- Header de Productos -->
                <div class="bg-gradient-to-r from-blue-600 to-indigo-700 px-6 py-5 text-white">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center space-x-3">
                            <div class="w-10 h-10 bg-white bg-opacity-20 rounded-lg flex items-center justify-center">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                                </svg>
                            </div>
                            <div>
                                <h3 class="text-xl font-bold">Catálogo de Productos</h3>
                                <p class="text-blue-100 text-sm">{{ $products->count() }} productos disponibles</p>
                            </div>
                        </div>
                        <div class="flex items-center space-x-3">
                            <div class="bg-white bg-opacity-20 rounded-lg px-3 py-1">
                                <span class="text-sm font-medium" id="filteredCount">{{ $products->count() }}</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="p-6">
                    <!-- Barra de Búsqueda y Filtros -->
                    <div class="mb-6 space-y-4">
                        <!-- Búsqueda Principal -->
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                </svg>
                            </div>
                            <input type="text" id="productSearch" placeholder="Buscar productos por nombre, código o categoría..." 
                                   class="block w-full pl-12 pr-4 py-4 border-2 border-gray-200 rounded-xl leading-5 bg-white placeholder-gray-500 focus:outline-none focus:placeholder-gray-400 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 text-base transition-all duration-200">
                        </div>

                        <!-- Filtros Rápidos -->
                        <div class="flex flex-wrap gap-2">
                            <button class="filter-btn active" data-filter="all">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 10h16M4 14h16M4 18h16"></path>
                                </svg>
                                Todos
                            </button>
                            @foreach($products->pluck('category.name')->unique()->filter() as $category)
                                <button class="filter-btn" data-filter="category" data-value="{{ $category }}">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                                    </svg>
                                    {{ $category }}
                                </button>
                            @endforeach
                            <button class="filter-btn" data-filter="low-stock">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.732 16.5c-.77.833.192 2.5 1.732 2.5z"></path>
                                </svg>
                                Stock Bajo
                            </button>
                        </div>
                    </div>

                    <!-- Grid de Productos -->
                    <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-6 gap-4" id="productsGrid">
                        @foreach($products as $product)
                            <div class="product-card group bg-white border-2 border-gray-100 rounded-2xl p-4 hover:shadow-xl hover:border-blue-400 transition-all duration-300 cursor-pointer transform hover:scale-105 hover:-translate-y-1"
                                 data-product-id="{{ $product->id }}"
                                 data-product-name="{{ $product->name }}"
                                 data-product-price="{{ $product->sale_price }}"
                                 data-product-stock="{{ $product->stock }}"
                                 data-product-category="{{ $product->category->name ?? '' }}">
                                <div class="text-center">
                                    <!-- Imagen del Producto -->
                                    <div class="relative w-20 h-20 mx-auto mb-4 bg-gradient-to-br from-blue-50 to-indigo-100 rounded-2xl flex items-center justify-center group-hover:from-blue-100 group-hover:to-indigo-200 transition-all duration-300 shadow-sm">
                                        <svg class="w-10 h-10 text-blue-600 group-hover:text-blue-700 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                                        </svg>
                                        <!-- Indicador de stock bajo -->
                                        @if($product->stock <= 5)
                                            <div class="absolute -top-1 -right-1 w-6 h-6 bg-red-500 rounded-full flex items-center justify-center">
                                                <svg class="w-3 h-3 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.732 16.5c-.77.833.192 2.5 1.732 2.5z"></path>
                                                </svg>
                                            </div>
                                        @endif
                                    </div>
                                    
                                    <!-- Información del Producto -->
                                    <h4 class="text-sm font-bold text-gray-900 mb-2 line-clamp-2 group-hover:text-blue-600 transition-colors leading-tight">{{ $product->name }}</h4>
                                    
                                    <!-- Categoría -->
                                    <div class="mb-3">
                                        <span class="inline-flex items-center px-2 py-1 rounded-lg text-xs font-medium bg-gray-100 text-gray-600">
                                            <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                                            </svg>
                                            {{ $product->category->name ?? 'Sin categoría' }}
                                        </span>
                                    </div>
                                    
                                    <!-- Precio -->
                                    <div class="mb-3">
                                        <span class="text-xl font-bold text-green-600 group-hover:text-green-700 transition-colors">${{ number_format($product->sale_price, 2) }}</span>
                                    </div>
                                    
                                    <!-- Stock -->
                                    <div class="flex items-center justify-center">
                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold {{ $product->stock > 10 ? 'bg-green-100 text-green-800' : ($product->stock > 5 ? 'bg-yellow-100 text-yellow-800' : 'bg-red-100 text-red-800') }}">
                                            <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                                            </svg>
                                            {{ $product->stock }}
                                        </span>
                                    </div>

                                    <!-- Botón de agregar rápido -->
                                    <div class="mt-3 opacity-0 group-hover:opacity-100 transition-opacity duration-200">
                                        <button class="w-full bg-gradient-to-r from-blue-500 to-blue-600 hover:from-blue-600 hover:to-blue-700 text-white px-3 py-2 rounded-lg text-xs font-semibold shadow-lg transform hover:scale-105 transition-all duration-200">
                                            <svg class="w-4 h-4 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                            </svg>
                                            Agregar
                                        </button>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <!-- Mensaje cuando no hay productos -->
                    <div id="noProductsMessage" class="hidden text-center py-12">
                        <div class="w-16 h-16 mx-auto mb-4 bg-gray-200 rounded-full flex items-center justify-center">
                            <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                            </svg>
                        </div>
                        <h3 class="text-lg font-medium text-gray-900 mb-2">No se encontraron productos</h3>
                        <p class="text-gray-500">Intenta con otros términos de búsqueda</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Carrito de Compras - Derecha -->
        <div class="xl:col-span-1 order-2 xl:order-2">
            <div class="bg-white rounded-2xl shadow-xl border border-gray-200 sticky top-6 overflow-hidden">
                <!-- Header del Carrito -->
                <div class="bg-gradient-to-r from-green-600 to-emerald-600 px-6 py-5 text-white">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center space-x-3">
                            <div class="w-10 h-10 bg-white bg-opacity-20 rounded-lg flex items-center justify-center">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4m0 0L7 13m0 0l-2.5 5M7 13l2.5 5m6-5v6a2 2 0 01-2 2H9a2 2 0 01-2-2v-6m8 0V9a2 2 0 00-2-2H9a2 2 0 00-2 2v4.01"></path>
                                </svg>
                            </div>
                            <div>
                                <h3 class="text-lg font-bold">Carrito de Venta</h3>
                                <p class="text-green-100 text-sm" id="cartSummary">0 productos</p>
                            </div>
                        </div>
                        <div class="bg-white bg-opacity-20 rounded-lg px-3 py-1">
                            <span id="cartCount" class="text-sm font-bold">0</span>
                        </div>
                    </div>
                </div>

                <div class="p-6">
                    <!-- Items del Carrito -->
                    <div id="cartItems" class="space-y-3 mb-6 max-h-80 overflow-y-auto">
                        <div class="text-center text-gray-500 py-12">
                            <div class="w-16 h-16 mx-auto mb-4 bg-gray-200 rounded-full flex items-center justify-center">
                                <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4m0 0L7 13m0 0l-2.5 5M7 13l2.5 5m6-5v6a2 2 0 01-2 2H9a2 2 0 01-2-2v-6m8 0V9a2 2 0 00-2-2H9a2 2 0 00-2 2v4.01"></path>
                                </svg>
                            </div>
                            <p class="text-gray-500 font-medium">Carrito vacío</p>
                            <p class="text-sm text-gray-400">Agrega productos para comenzar</p>
                        </div>
                    </div>

                    <!-- Resumen de Compra -->
                    <div class="bg-gray-50 rounded-xl p-5 border border-gray-200">
                        <!-- Total -->
                        <div class="bg-white rounded-lg p-4 mb-4 shadow-sm">
                            <div class="flex justify-between items-center">
                                <span class="text-lg font-semibold text-gray-900">Total a Pagar:</span>
                                <span id="cartTotal" class="text-3xl font-bold text-green-600">$0.00</span>
                            </div>
                        </div>

                        <!-- Cliente -->
                        <div class="mb-4">
                            <label class="block text-sm font-semibold text-gray-700 mb-3">
                                <svg class="w-4 h-4 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                </svg>
                                Cliente
                            </label>
                            <select id="customerSelect" class="w-full border-2 border-gray-200 rounded-lg shadow-sm focus:border-green-500 focus:ring-green-500 text-sm py-3 px-4 transition-colors">
                                <option value="">Cliente General</option>
                                @foreach($customers as $customer)
                                    <option value="{{ $customer->id }}">{{ $customer->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Efectivo Recibido -->
                        <div class="mb-4">
                            <label class="block text-sm font-semibold text-gray-700 mb-3">
                                <svg class="w-4 h-4 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"></path>
                                </svg>
                                Efectivo Recibido
                            </label>
                            <div class="relative">
                                <span class="absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-500 font-bold">$</span>
                                <input type="number" id="cashReceived" step="0.01" min="0" 
                                       class="w-full border-2 border-gray-200 rounded-lg shadow-sm focus:border-green-500 focus:ring-green-500 text-lg py-3 pl-8 pr-4 transition-colors"
                                       placeholder="0.00">
                            </div>
                        </div>

                        <!-- Cambio -->
                        <div class="mb-6 p-4 bg-green-50 rounded-lg border-2 border-green-200">
                            <div class="flex justify-between items-center">
                                <span class="text-sm font-semibold text-green-700">Cambio:</span>
                                <span id="changeAmount" class="text-2xl font-bold text-green-600">$0.00</span>
                            </div>
                        </div>

                        <!-- Botones de Acción -->
                        <div class="space-y-3">
                            <button id="printTicket" class="w-full bg-gradient-to-r from-green-600 to-emerald-600 hover:from-green-700 hover:to-emerald-700 text-white px-6 py-4 rounded-xl font-bold shadow-xl transform hover:scale-105 transition-all duration-200 disabled:from-gray-400 disabled:to-gray-500 disabled:cursor-not-allowed disabled:transform-none text-lg">
                                <svg class="w-6 h-6 inline mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"></path>
                                </svg>
                                VENDER E IMPRIMIR
                            </button>
                            
                            <div class="grid grid-cols-2 gap-3">
                                <button id="clearCart" class="bg-gradient-to-r from-red-500 to-red-600 hover:from-red-600 hover:to-red-700 text-white px-4 py-3 rounded-lg font-semibold shadow-lg transform hover:scale-105 transition-all duration-200">
                                    <svg class="w-5 h-5 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                    </svg>
                                    Limpiar
                                </button>
                                <button id="holdCart" class="bg-gradient-to-r from-yellow-500 to-orange-500 hover:from-yellow-600 hover:to-orange-600 text-white px-4 py-3 rounded-lg font-semibold shadow-lg transform hover:scale-105 transition-all duration-200">
                                    <svg class="w-5 h-5 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4"></path>
                                    </svg>
                                    Guardar
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal de Cantidad -->
    <div id="quantityModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 modal-backdrop hidden z-50">
        <div class="flex items-center justify-center min-h-screen p-4">
            <div class="bg-white rounded-xl shadow-2xl p-6 w-full max-w-sm transform transition-all duration-300 scale-95">
                <div class="text-center mb-6">
                    <div class="w-16 h-16 mx-auto mb-4 bg-blue-100 rounded-full flex items-center justify-center">
                        <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-2">Cantidad del Producto</h3>
                    <p class="text-gray-600">Ingresa la cantidad a agregar al carrito</p>
                </div>
                
                <div class="mb-6">
                    <label class="block text-sm font-medium text-gray-700 mb-3">
                        <svg class="w-4 h-4 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                        </svg>
                        Cantidad:
                    </label>
                    <input type="number" id="quantityInput" min="1" value="1" 
                           class="w-full border-gray-300 rounded-lg shadow-sm focus:border-blue-500 focus:ring-blue-500 text-center text-lg font-semibold py-3">
                </div>
                
                <div class="flex space-x-3">
                    <button id="addToCartBtn" class="flex-1 bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800 text-white px-4 py-3 rounded-lg font-semibold shadow-lg transform hover:scale-105 transition-all duration-200">
                        <svg class="w-5 h-5 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                        </svg>
                        Agregar al Carrito
                    </button>
                    <button id="cancelQuantity" class="flex-1 bg-gray-200 hover:bg-gray-300 text-gray-700 px-4 py-3 rounded-lg font-medium transition-all duration-200">
                        <svg class="w-5 h-5 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                        Cancelar
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal de Confirmación -->
    <div id="confirmModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 modal-backdrop hidden z-50">
        <div class="flex items-center justify-center min-h-screen p-4">
            <div class="bg-white rounded-xl shadow-2xl p-6 w-full max-w-md transform transition-all duration-300 scale-95">
                <div class="text-center mb-6">
                    <div class="w-16 h-16 mx-auto mb-4 bg-green-100 rounded-full flex items-center justify-center">
                        <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-2">Confirmar Venta</h3>
                    <p class="text-gray-600">Revisa los detalles antes de procesar</p>
                </div>
                
                <div id="saleSummary" class="mb-6 p-4 bg-gray-50 rounded-lg border border-gray-200"></div>
                
                <div class="flex space-x-3">
                    <button id="confirmSale" class="flex-1 bg-gradient-to-r from-green-600 to-green-700 hover:from-green-700 hover:to-green-800 text-white px-4 py-3 rounded-lg font-semibold shadow-lg transform hover:scale-105 transition-all duration-200">
                        <svg class="w-5 h-5 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        Confirmar Venta
                    </button>
                    <button id="cancelSale" class="flex-1 bg-gray-200 hover:bg-gray-300 text-gray-700 px-4 py-3 rounded-lg font-medium transition-all duration-200">
                        <svg class="w-5 h-5 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                        Cancelar
                    </button>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script>
        let selectedProduct = null;
        let cart = {};

        // Cargar carrito desde sesión
        function loadCart() {
            fetch('/pos/cart')
                .then(response => response.json())
                .then(data => {
                    cart = data.cart || {};
                    updateCartDisplay();
                });
        }

        // Actualizar display del carrito
        function updateCartDisplay() {
            const cartItems = document.getElementById('cartItems');
            const cartTotal = document.getElementById('cartTotal');
            const cartCount = document.getElementById('cartCount');
            const cartSummary = document.getElementById('cartSummary');
            
            if (Object.keys(cart).length === 0) {
                cartItems.innerHTML = `
                    <div class="text-center text-gray-500 py-12 empty-cart">
                        <div class="w-20 h-20 mx-auto mb-4 bg-gray-100 rounded-full flex items-center justify-center">
                            <svg class="w-10 h-10 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4m0 0L7 13m0 0l-2.5 5M7 13l2.5 5m6-5v6a2 2 0 01-2 2H9a2 2 0 01-2-2v-6m8 0V9a2 2 0 00-2-2H9a2 2 0 00-2 2v4.01"></path>
                            </svg>
                        </div>
                        <p class="text-gray-500 font-semibold text-lg">Carrito vacío</p>
                        <p class="text-sm text-gray-400 mt-1">Haz clic en los productos para agregarlos</p>
                    </div>
                `;
                cartTotal.textContent = '$0.00';
                cartCount.textContent = '0';
                cartSummary.textContent = '0 productos';
                return;
            }

            let total = 0;
            let totalItems = 0;
            let itemsHtml = '';

            Object.values(cart).forEach(item => {
                const subtotal = item.price * item.quantity;
                total += subtotal;
                totalItems += item.quantity;
                
                itemsHtml += `
                    <div class="cart-item bg-white border-2 border-gray-100 rounded-xl p-4 shadow-sm hover:shadow-lg transition-all duration-300">
                        <div class="flex items-start justify-between mb-3">
                            <div class="flex-1">
                                <h4 class="text-sm font-bold text-gray-900 mb-1">${item.name}</h4>
                                <p class="text-xs text-gray-500">$${item.price.toFixed(2)} c/u</p>
                            </div>
                            <button onclick="removeFromCart(${item.id})" 
                                    class="w-8 h-8 bg-red-100 hover:bg-red-200 rounded-full flex items-center justify-center transition-all duration-200 hover:scale-110">
                                <svg class="w-4 h-4 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                </svg>
                            </button>
                        </div>
                        
                        <div class="flex items-center justify-between">
                            <div class="flex items-center space-x-3">
                                <button onclick="updateQuantity(${item.id}, ${item.quantity - 1})" 
                                        class="w-8 h-8 bg-blue-100 hover:bg-blue-200 rounded-full flex items-center justify-center transition-all duration-200 hover:scale-110">
                                    <svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4"></path>
                                    </svg>
                                </button>
                                <span class="text-lg font-bold text-gray-900 w-10 text-center">${item.quantity}</span>
                                <button onclick="updateQuantity(${item.id}, ${item.quantity + 1})" 
                                        class="w-8 h-8 bg-blue-100 hover:bg-blue-200 rounded-full flex items-center justify-center transition-all duration-200 hover:scale-110">
                                    <svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                    </svg>
                                </button>
                            </div>
                            <div class="text-right">
                                <p class="text-lg font-bold text-green-600">$${subtotal.toFixed(2)}</p>
                            </div>
                        </div>
                    </div>
                `;
            });

            cartItems.innerHTML = itemsHtml;
            cartTotal.textContent = `$${total.toFixed(2)}`;
            cartCount.textContent = totalItems;
            cartSummary.textContent = `${totalItems} producto${totalItems !== 1 ? 's' : ''}`;
            updateChange();
        }

        // Actualizar cambio
        function updateChange() {
            const total = Object.values(cart).reduce((sum, item) => sum + (item.price * item.quantity), 0);
            const cashReceived = parseFloat(document.getElementById('cashReceived').value) || 0;
            const change = cashReceived - total;
            
            document.getElementById('changeAmount').textContent = `$${Math.max(0, change).toFixed(2)}`;
            
            const printBtn = document.getElementById('printTicket');
            if (printBtn) {
                printBtn.disabled = cashReceived < total || Object.keys(cart).length === 0;
            }
        }

        // Procesar venta e imprimir ticket
        function processSaleAndPrint() {
            const total = Object.values(cart).reduce((sum, item) => sum + (item.price * item.quantity), 0);
            const cashReceived = parseFloat(document.getElementById('cashReceived').value) || 0;
            const customerId = document.getElementById('customerSelect').value;
            const change = cashReceived - total;

            // Crear datos de la venta
            const saleData = {
                items: Object.values(cart),
                total: total,
                cash_received: cashReceived,
                change: change,
                customer_id: customerId || null,
                _token: document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            };

            // Procesar venta
            fetch('/pos/process-sale', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify(saleData)
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Imprimir ticket
                    printTicket(data.sale);
                    
                    // Limpiar carrito
                    cart = {};
                    updateCartDisplay();
                    document.getElementById('cashReceived').value = '';
                    document.getElementById('customerSelect').value = '';
                    updateChange();
                    
                    // Mostrar mensaje de éxito
                    showSuccessMessage('Venta procesada e impresa correctamente');
                } else {
                    alert('Error al procesar la venta: ' + (data.message || 'Error desconocido'));
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Error al procesar la venta');
            });
        }

        // Imprimir ticket
        function printTicket(sale) {
            const ticketContent = generateTicketHTML(sale);
            
            // Crear ventana de impresión
            const printWindow = window.open('', '_blank', 'width=400,height=600');
            printWindow.document.write(ticketContent);
            printWindow.document.close();
            
            // Imprimir automáticamente
            printWindow.focus();
            printWindow.print();
            
            // Cerrar ventana después de imprimir
            setTimeout(() => {
                printWindow.close();
            }, 1000);
        }

        // Generar HTML del ticket
        function generateTicketHTML(sale) {
            const now = new Date();
            const dateStr = now.toLocaleDateString('es-ES');
            const timeStr = now.toLocaleTimeString('es-ES');
            
            return `
                <!DOCTYPE html>
                <html>
                <head>
                    <title>Ticket de Venta</title>
                    <style>
                        body {
                            font-family: 'Courier New', monospace;
                            font-size: 12px;
                            line-height: 1.4;
                            margin: 0;
                            padding: 10px;
                            width: 300px;
                        }
                        .ticket {
                            text-align: center;
                            border: 1px solid #000;
                            padding: 10px;
                        }
                        .header {
                            border-bottom: 1px dashed #000;
                            padding-bottom: 10px;
                            margin-bottom: 10px;
                        }
                        .company-name {
                            font-size: 16px;
                            font-weight: bold;
                            margin-bottom: 5px;
                        }
                        .company-info {
                            font-size: 10px;
                            margin-bottom: 5px;
                        }
                        .sale-info {
                            text-align: left;
                            margin-bottom: 10px;
                        }
                        .items {
                            border-bottom: 1px dashed #000;
                            padding-bottom: 10px;
                            margin-bottom: 10px;
                        }
                        .item {
                            display: flex;
                            justify-content: space-between;
                            margin-bottom: 3px;
                        }
                        .item-name {
                            flex: 1;
                        }
                        .item-qty {
                            margin: 0 5px;
                        }
                        .item-price {
                            text-align: right;
                            min-width: 60px;
                        }
                        .totals {
                            text-align: right;
                            margin-bottom: 10px;
                        }
                        .total-line {
                            display: flex;
                            justify-content: space-between;
                            margin-bottom: 2px;
                        }
                        .grand-total {
                            font-weight: bold;
                            font-size: 14px;
                            border-top: 1px solid #000;
                            padding-top: 5px;
                            margin-top: 5px;
                        }
                        .payment-info {
                            border-top: 1px dashed #000;
                            padding-top: 10px;
                            text-align: left;
                        }
                        .footer {
                            margin-top: 15px;
                            font-size: 10px;
                            text-align: center;
                        }
                        @media print {
                            body { margin: 0; }
                            .ticket { border: none; }
                        }
                    </style>
                </head>
                <body>
                    <div class="ticket">
                        <div class="header">
                            <div class="company-name">MI TIENDA</div>
                            <div class="company-info">Dirección: Calle Principal #123</div>
                            <div class="company-info">Tel: (555) 123-4567</div>
                            <div class="company-info">RUC: 12345678901</div>
                        </div>
                        
                        <div class="sale-info">
                            <div><strong>Ticket #:</strong> ${sale.id || 'N/A'}</div>
                            <div><strong>Fecha:</strong> ${dateStr}</div>
                            <div><strong>Hora:</strong> ${timeStr}</div>
                            <div><strong>Cliente:</strong> ${sale.customer_name || 'Cliente General'}</div>
                        </div>
                        
                        <div class="items">
                            <div style="text-align: center; font-weight: bold; margin-bottom: 5px;">PRODUCTOS</div>
                            ${sale.items.map(item => `
                                <div class="item">
                                    <span class="item-name">${item.name}</span>
                                    <span class="item-qty">${item.quantity}</span>
                                    <span class="item-price">$${(item.price * item.quantity).toFixed(2)}</span>
                                </div>
                            `).join('')}
                        </div>
                        
                        <div class="totals">
                            <div class="total-line">
                                <span>Subtotal:</span>
                                <span>$${sale.total.toFixed(2)}</span>
                            </div>
                            <div class="total-line">
                                <span>Efectivo:</span>
                                <span>$${sale.cash_received.toFixed(2)}</span>
                            </div>
                            <div class="total-line">
                                <span>Cambio:</span>
                                <span>$${sale.change.toFixed(2)}</span>
                            </div>
                            <div class="total-line grand-total">
                                <span>TOTAL:</span>
                                <span>$${sale.total.toFixed(2)}</span>
                            </div>
                        </div>
                        
                        <div class="payment-info">
                            <div><strong>Método de Pago:</strong> Efectivo</div>
                            <div><strong>Vendedor:</strong> Sistema POS</div>
                        </div>
                        
                        <div class="footer">
                            <div>¡Gracias por su compra!</div>
                            <div>Vuelva pronto</div>
                            <div style="margin-top: 10px;">
                                ${dateStr} ${timeStr}
                            </div>
                        </div>
                    </div>
                </body>
                </html>
            `;
        }

        // Mostrar notificaciones mejoradas
        function showNotification(message, type = 'success') {
            const colors = {
                success: 'bg-green-500',
                error: 'bg-red-500',
                warning: 'bg-yellow-500',
                info: 'bg-blue-500'
            };
            
            const icons = {
                success: `<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>`,
                error: `<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>`,
                warning: `<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.732 16.5c-.77.833.192 2.5 1.732 2.5z"></path>
                </svg>`,
                info: `<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>`
            };
            
            // Crear elemento de notificación
            const notification = document.createElement('div');
            notification.className = `fixed top-4 right-4 ${colors[type]} text-white px-6 py-4 rounded-xl shadow-xl z-50 transform transition-all duration-300 notification`;
            notification.style.transform = 'translateX(100%)';
            
            notification.innerHTML = `
                <div class="flex items-center space-x-3">
                    <div class="flex-shrink-0">
                        ${icons[type]}
                    </div>
                    <div class="flex-1">
                        <p class="font-semibold">${message}</p>
                    </div>
                    <button onclick="this.parentElement.parentElement.remove()" class="flex-shrink-0 ml-4">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>
            `;
            
            document.body.appendChild(notification);
            
            // Animar entrada
            setTimeout(() => {
                notification.style.transform = 'translateX(0)';
            }, 100);
            
            // Remover después de 4 segundos
            setTimeout(() => {
                if (notification.parentElement) {
                    notification.style.transform = 'translateX(100%)';
                    setTimeout(() => {
                        if (notification.parentElement) {
                            document.body.removeChild(notification);
                        }
                    }, 300);
                }
            }, 4000);
        }

        // Mostrar mensaje de éxito (compatibilidad)
        function showSuccessMessage(message) {
            showNotification(message, 'success');
        }

        // Event Listeners
        document.addEventListener('DOMContentLoaded', function() {
            loadCart();

            // Búsqueda y filtros de productos
            let currentFilter = 'all';
            let currentSearchTerm = '';

            function filterProducts() {
                const productCards = document.querySelectorAll('.product-card');
                const noProductsMessage = document.getElementById('noProductsMessage');
                const filteredCount = document.getElementById('filteredCount');
                let visibleCount = 0;
                
                productCards.forEach(card => {
                    const productName = card.dataset.productName.toLowerCase();
                    const productCategory = card.dataset.productCategory.toLowerCase();
                    const productStock = parseInt(card.dataset.productStock);
                    
                    let showCard = true;
                    
                    // Filtro por búsqueda
                    if (currentSearchTerm && !productName.includes(currentSearchTerm) && !productCategory.includes(currentSearchTerm)) {
                        showCard = false;
                    }
                    
                    // Filtro por categoría
                    if (currentFilter === 'category') {
                        const filterValue = document.querySelector('.filter-btn.active').dataset.value.toLowerCase();
                        if (productCategory !== filterValue) {
                            showCard = false;
                        }
                    } else if (currentFilter === 'low-stock') {
                        if (productStock > 5) {
                            showCard = false;
                        }
                    }
                    
                    if (showCard) {
                        card.style.display = 'block';
                        card.style.animation = 'fadeInUp 0.4s ease-out';
                        visibleCount++;
                    } else {
                        card.style.display = 'none';
                    }
                });

                // Actualizar contador
                filteredCount.textContent = visibleCount;

                // Mostrar/ocultar mensaje de no productos
                if (visibleCount === 0) {
                    noProductsMessage.classList.remove('hidden');
                } else {
                    noProductsMessage.classList.add('hidden');
                }
            }

            // Búsqueda de productos
            document.getElementById('productSearch').addEventListener('input', function(e) {
                currentSearchTerm = e.target.value.toLowerCase();
                filterProducts();
            });

            // Filtros por categoría
            document.querySelectorAll('.filter-btn').forEach(btn => {
                btn.addEventListener('click', function() {
                    // Remover clase active de todos los botones
                    document.querySelectorAll('.filter-btn').forEach(b => b.classList.remove('active'));
                    
                    // Agregar clase active al botón clickeado
                    this.classList.add('active');
                    
                    // Actualizar filtro actual
                    currentFilter = this.dataset.filter;
                    
                    // Aplicar filtro
                    filterProducts();
                });
            });

            // Click en producto
            document.querySelectorAll('.product-card').forEach(card => {
                card.addEventListener('click', function() {
                    selectedProduct = {
                        id: this.dataset.productId,
                        name: this.dataset.productName,
                        price: parseFloat(this.dataset.productPrice),
                        stock: parseInt(this.dataset.productStock)
                    };
                    
                    document.getElementById('quantityInput').max = selectedProduct.stock;
                    document.getElementById('quantityInput').value = 1;
                    document.getElementById('quantityModal').classList.remove('hidden');
                });
            });

            // Modal de cantidad
            document.getElementById('addToCartBtn').addEventListener('click', function() {
                const quantity = parseInt(document.getElementById('quantityInput').value);
                
                if (quantity > 0 && quantity <= selectedProduct.stock) {
                    addToCart(selectedProduct.id, quantity);
                    document.getElementById('quantityModal').classList.add('hidden');
                }
            });

            document.getElementById('cancelQuantity').addEventListener('click', function() {
                document.getElementById('quantityModal').classList.add('hidden');
            });

            // Efectivo recibido
            document.getElementById('cashReceived').addEventListener('input', updateChange);

            // Atajos de teclado
            document.addEventListener('keydown', function(e) {
                // Enter para procesar venta
                if (e.key === 'Enter' && !e.shiftKey && !e.ctrlKey) {
                    const activeElement = document.activeElement;
                    if (activeElement.id === 'cashReceived' || activeElement.id === 'customerSelect') {
                        e.preventDefault();
                        const printBtn = document.getElementById('printTicket');
                        if (!printBtn.disabled) {
                            printBtn.click();
                        }
                    }
                }
                
                // Escape para limpiar carrito
                if (e.key === 'Escape') {
                    document.getElementById('clearCart').click();
                }
                
                // Ctrl + Enter para agregar cantidad 1
                if (e.ctrlKey && e.key === 'Enter') {
                    const quantityInput = document.getElementById('quantityInput');
                    if (quantityInput) {
                        quantityInput.value = 1;
                        document.getElementById('addToCartBtn').click();
                    }
                }
            });

            // Auto-focus en efectivo recibido cuando hay productos
            function checkAutoFocus() {
                const total = Object.values(cart).reduce((sum, item) => sum + (item.price * item.quantity), 0);
                if (total > 0) {
                    const cashInput = document.getElementById('cashReceived');
                    if (cashInput && !cashInput.value) {
                        cashInput.focus();
                    }
                }
            }

            // Mejorar la experiencia de usuario
            document.getElementById('cashReceived').addEventListener('focus', function() {
                this.select();
            });

            // Agregar funcionalidad de "Guardar carrito"
            document.getElementById('holdCart').addEventListener('click', function() {
                if (Object.keys(cart).length === 0) {
                    showNotification('El carrito está vacío', 'warning');
                    return;
                }
                
                // Guardar carrito en localStorage
                localStorage.setItem('pos_cart_hold', JSON.stringify(cart));
                showNotification('Carrito guardado temporalmente', 'success');
            });

            // Cargar carrito guardado al iniciar
            function loadHeldCart() {
                const heldCart = localStorage.getItem('pos_cart_hold');
                if (heldCart) {
                    const shouldLoad = confirm('¿Deseas cargar el carrito guardado anteriormente?');
                    if (shouldLoad) {
                        cart = JSON.parse(heldCart);
                        updateCartDisplay();
                        localStorage.removeItem('pos_cart_hold');
                        showNotification('Carrito restaurado', 'success');
                    }
                }
            }

            // Cargar carrito guardado
            loadHeldCart();

            // Vender e Imprimir
            document.getElementById('printTicket').addEventListener('click', function() {
                const total = Object.values(cart).reduce((sum, item) => sum + (item.price * item.quantity), 0);
                const cashReceived = parseFloat(document.getElementById('cashReceived').value) || 0;
                const customerId = document.getElementById('customerSelect').value;
                
                if (cashReceived < total) {
                    alert('El efectivo recibido es menor al total');
                    return;
                }

                // Procesar venta e imprimir ticket directamente
                processSaleAndPrint();
            });

            // Confirmar venta
            document.getElementById('confirmSale').addEventListener('click', function() {
                const total = Object.values(cart).reduce((sum, item) => sum + (item.price * item.quantity), 0);
                const cashReceived = parseFloat(document.getElementById('cashReceived').value) || 0;
                const customerId = document.getElementById('customerSelect').value;

                fetch('/pos/process-sale', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                    body: JSON.stringify({
                        customer_id: customerId,
                        cash_received: cashReceived
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        alert('Venta procesada exitosamente');
                        // Abrir ticket en nueva ventana
                        window.open(`/pos/ticket/${data.sale_id}`, '_blank');
                        // Recargar página
                        location.reload();
                    } else {
                        alert('Error: ' + data.message);
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Error al procesar la venta');
                });

                document.getElementById('confirmModal').classList.add('hidden');
            });

            document.getElementById('cancelSale').addEventListener('click', function() {
                document.getElementById('confirmModal').classList.add('hidden');
            });

            // Vaciar carrito
            document.getElementById('clearCart').addEventListener('click', function() {
                if (confirm('¿Estás seguro de vaciar el carrito?')) {
                    fetch('/pos/clear-cart', {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                        }
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            cart = {};
                            updateCartDisplay();
                        }
                    });
                }
            });
        });

        // Funciones globales
        function addToCart(productId, quantity) {
            fetch('/pos/add-to-cart', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({
                    product_id: productId,
                    quantity: quantity
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    cart = data.cart.items.reduce((acc, item) => {
                        acc[item.id] = item;
                        return acc;
                    }, {});
                    updateCartDisplay();
                } else {
                    alert(data.message);
                }
            });
        }

        function updateQuantity(productId, newQuantity) {
            if (newQuantity <= 0) {
                removeFromCart(productId);
                return;
            }

            fetch('/pos/update-cart', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({
                    product_id: productId,
                    quantity: newQuantity
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    cart = data.cart.items.reduce((acc, item) => {
                        acc[item.id] = item;
                        return acc;
                    }, {});
                    updateCartDisplay();
                } else {
                    alert(data.message);
                }
            });
        }

        function removeFromCart(productId) {
            fetch('/pos/remove-from-cart', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({
                    product_id: productId
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    cart = data.cart.items.reduce((acc, item) => {
                        acc[item.id] = item;
                        return acc;
                    }, {});
                    updateCartDisplay();
                }
            });
        }
    </script>
    @endpush

    <style>
        /* Estilos principales del POS */
        .product-card {
            animation: fadeInUp 0.6s ease-out;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }
        
        .product-card:hover {
            transform: translateY(-4px) scale(1.02);
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
        }
        
        /* Botones de filtro */
        .filter-btn {
            @apply px-4 py-2 rounded-lg text-sm font-medium transition-all duration-200 border-2 border-gray-200 bg-white text-gray-600 hover:border-blue-400 hover:text-blue-600 hover:bg-blue-50;
        }
        
        .filter-btn.active {
            @apply border-blue-500 bg-blue-500 text-white hover:bg-blue-600;
        }
        
        /* Scrollbar personalizado */
        #cartItems::-webkit-scrollbar {
            width: 8px;
        }
        
        #cartItems::-webkit-scrollbar-track {
            background: #f1f5f9;
            border-radius: 4px;
        }
        
        #cartItems::-webkit-scrollbar-thumb {
            background: linear-gradient(180deg, #3b82f6, #1d4ed8);
            border-radius: 4px;
        }
        
        #cartItems::-webkit-scrollbar-thumb:hover {
            background: linear-gradient(180deg, #2563eb, #1e40af);
        }
        
        /* Animaciones */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        @keyframes slideInRight {
            from {
                opacity: 0;
                transform: translateX(30px);
            }
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }
        
        @keyframes pulse {
            0%, 100% {
                transform: scale(1);
            }
            50% {
                transform: scale(1.05);
            }
        }
        
        @keyframes bounce {
            0%, 20%, 53%, 80%, 100% {
                transform: translate3d(0,0,0);
            }
            40%, 43% {
                transform: translate3d(0, -8px, 0);
            }
            70% {
                transform: translate3d(0, -4px, 0);
            }
            90% {
                transform: translate3d(0, -2px, 0);
            }
        }
        
        /* Efectos especiales */
        .cart-item {
            animation: slideInRight 0.4s ease-out;
        }
        
        .success-animation {
            animation: bounce 0.6s ease-out;
        }
        
        .pulse-animation {
            animation: pulse 2s infinite;
        }
        
        /* Mejoras para el modal */
        .modal-backdrop {
            backdrop-filter: blur(8px);
            background: rgba(0, 0, 0, 0.5);
        }
        
        /* Efectos de gradiente animados */
        .bg-gradient-to-r {
            background-size: 200% 200%;
            animation: gradientShift 3s ease infinite;
        }
        
        @keyframes gradientShift {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }
        
        /* Mejoras para el carrito sticky */
        .sticky {
            position: sticky;
            top: 1.5rem;
        }
        
        /* Efectos de hover mejorados */
        .hover\:scale-105:hover {
            transform: scale(1.05);
        }
        
        .hover\:-translate-y-1:hover {
            transform: translateY(-4px);
        }
        
        /* Estilos para notificaciones */
        .notification {
            animation: slideInRight 0.3s ease-out;
        }
        
        /* Efectos de sombra mejorados */
        .shadow-xl {
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
        }
        
        /* Estilos para el estado vacío del carrito */
        .empty-cart {
            animation: fadeInUp 0.5s ease-out;
        }
        
        /* Efectos de transición suaves */
        .transition-all {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }
        
        /* Estilos para botones de acción rápida */
        .quick-action-btn {
            transition: all 0.2s ease;
        }
        
        .quick-action-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 15px rgba(0, 0, 0, 0.2);
        }
        
        /* Efectos de loading */
        .loading {
            animation: pulse 1.5s ease-in-out infinite;
        }
        
        /* Estilos para el indicador de stock bajo */
        .low-stock-indicator {
            animation: pulse 2s infinite;
        }
        
        /* Mejoras para la búsqueda */
        .search-input:focus {
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
        }
        
        /* Efectos para las tarjetas de productos */
        .product-card .product-image {
            transition: all 0.3s ease;
        }
        
        .product-card:hover .product-image {
            transform: scale(1.1);
        }
        
        /* Estilos para el resumen del carrito */
        .cart-summary {
            background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
        }
        
        /* Efectos de hover para botones del carrito */
        .cart-action-btn {
            transition: all 0.2s ease;
        }
        
        .cart-action-btn:hover {
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
        }
    </style>
</x-app-layout>

