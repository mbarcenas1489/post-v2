<x-app-layout>
    <x-slot name="header">
        Detalles del Proveedor
    </x-slot>

    <div class="mb-6">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-2xl font-bold text-gray-900">{{ $supplier->name }}</h1>
                <p class="text-gray-600">Información detallada del proveedor</p>
            </div>
            <div class="flex space-x-3">
                <a href="{{ route('suppliers.edit', $supplier) }}" class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-lg flex items-center">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                    </svg>
                    Editar
                </a>
                <a href="{{ route('suppliers.index') }}" class="bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded-lg flex items-center">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                    </svg>
                    Volver
                </a>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Supplier Information -->
        <div class="lg:col-span-2">
            <div class="bg-white shadow rounded-lg">
                <div class="px-6 py-4 border-b border-gray-200">
                    <h3 class="text-lg font-medium text-gray-900">Información del Proveedor</h3>
                </div>
                <div class="p-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Basic Info -->
                        <div class="space-y-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-500">Nombre Completo</label>
                                <p class="mt-1 text-sm text-gray-900">{{ $supplier->name }}</p>
                            </div>
                            
                            @if($supplier->email)
                            <div>
                                <label class="block text-sm font-medium text-gray-500">Email</label>
                                <p class="mt-1 text-sm text-gray-900">
                                    <a href="mailto:{{ $supplier->email }}" class="text-blue-600 hover:text-blue-800">
                                        {{ $supplier->email }}
                                    </a>
                                </p>
                            </div>
                            @endif

                            @if($supplier->phone)
                            <div>
                                <label class="block text-sm font-medium text-gray-500">Teléfono</label>
                                <p class="mt-1 text-sm text-gray-900">
                                    <a href="tel:{{ $supplier->phone }}" class="text-blue-600 hover:text-blue-800">
                                        {{ $supplier->phone }}
                                    </a>
                                </p>
                            </div>
                            @endif

                            @if($supplier->document_number)
                            <div>
                                <label class="block text-sm font-medium text-gray-500">Número de Documento</label>
                                <p class="mt-1 text-sm text-gray-900">{{ $supplier->document_number }}</p>
                            </div>
                            @endif
                        </div>

                        <!-- Address Info -->
                        <div class="space-y-4">
                            @if($supplier->address)
                            <div>
                                <label class="block text-sm font-medium text-gray-500">Dirección</label>
                                <p class="mt-1 text-sm text-gray-900">{{ $supplier->address }}</p>
                            </div>
                            @endif

                            @if($supplier->city)
                            <div>
                                <label class="block text-sm font-medium text-gray-500">Ciudad</label>
                                <p class="mt-1 text-sm text-gray-900">{{ $supplier->city }}</p>
                            </div>
                            @endif

                            @if($supplier->state)
                            <div>
                                <label class="block text-sm font-medium text-gray-500">Estado/Provincia</label>
                                <p class="mt-1 text-sm text-gray-900">{{ $supplier->state }}</p>
                            </div>
                            @endif

                            @if($supplier->country)
                            <div>
                                <label class="block text-sm font-medium text-gray-500">País</label>
                                <p class="mt-1 text-sm text-gray-900">{{ $supplier->country }}</p>
                            </div>
                            @endif

                            @if($supplier->zip)
                            <div>
                                <label class="block text-sm font-medium text-gray-500">Código Postal</label>
                                <p class="mt-1 text-sm text-gray-900">{{ $supplier->zip }}</p>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Supplier Stats & Actions -->
        <div class="space-y-6">
            <!-- Supplier Avatar -->
            <div class="bg-white shadow rounded-lg p-6 text-center">
                <div class="mx-auto h-20 w-20 rounded-full bg-green-100 flex items-center justify-center mb-4">
                    <svg class="h-12 w-12 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                    </svg>
                </div>
                <h3 class="text-lg font-medium text-gray-900">{{ $supplier->name }}</h3>
                <p class="text-sm text-gray-500">Proveedor desde {{ $supplier->created_at ? $supplier->created_at->format('M Y') : 'N/A' }}</p>
            </div>

            <!-- Registration Info -->
            <div class="bg-white shadow rounded-lg p-6">
                <h3 class="text-lg font-medium text-gray-900 mb-4">Información de Registro</h3>
                <div class="space-y-3">
                    <div class="flex justify-between">
                        <span class="text-sm text-gray-500">Fecha de Registro:</span>
                        <span class="text-sm text-gray-900">{{ $supplier->created_at ? $supplier->created_at->format('d/m/Y H:i') : 'N/A' }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-sm text-gray-500">Última Actualización:</span>
                        <span class="text-sm text-gray-900">{{ $supplier->updated_at ? $supplier->updated_at->format('d/m/Y H:i') : 'N/A' }}</span>
                    </div>
                </div>
            </div>

            <!-- Actions -->
            <div class="bg-white shadow rounded-lg p-6">
                <h3 class="text-lg font-medium text-gray-900 mb-4">Acciones</h3>
                <div class="space-y-3">
                    <a href="{{ route('suppliers.edit', $supplier) }}" class="w-full bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-lg flex items-center justify-center">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                        </svg>
                        Editar Proveedor
                    </a>
                    
                    <form method="POST" action="{{ route('suppliers.destroy', $supplier) }}" onsubmit="return confirm('¿Estás seguro de eliminar este proveedor? Esta acción no se puede deshacer.')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="w-full bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-lg flex items-center justify-center">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                            </svg>
                            Eliminar Proveedor
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
