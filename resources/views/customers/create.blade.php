<x-app-layout>
    <x-slot name="header">
        Nuevo Cliente
    </x-slot>

    <div class="mb-6">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-2xl font-bold text-gray-900">Crear Nuevo Cliente</h1>
                <p class="text-gray-600">Agrega un nuevo cliente a tu base de datos</p>
            </div>
            <a href="{{ route('customers.index') }}" class="bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded-lg flex items-center">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
                Volver
            </a>
        </div>
    </div>

    <div class="bg-white shadow rounded-lg">
        <form method="POST" action="{{ route('customers.store') }}" class="p-6 space-y-6">
            @csrf
            
            <!-- Basic Information -->
            <div class="border-b border-gray-200 pb-6">
                <h3 class="text-lg font-medium text-gray-900 mb-4">Información Básica</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <x-input-label for="name" :value="__('Nombre Completo')" />
                        <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus />
                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                    </div>

                    <div>
                        <x-input-label for="email" :value="__('Email')" />
                        <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" />
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>

                    <div>
                        <x-input-label for="phone" :value="__('Teléfono')" />
                        <x-text-input id="phone" class="block mt-1 w-full" type="text" name="phone" :value="old('phone')" />
                        <x-input-error :messages="$errors->get('phone')" class="mt-2" />
                    </div>

                    <div>
                        <x-input-label for="document_number" :value="__('Número de Documento')" />
                        <x-text-input id="document_number" class="block mt-1 w-full" type="text" name="document_number" :value="old('document_number')" />
                        <x-input-error :messages="$errors->get('document_number')" class="mt-2" />
                    </div>
                </div>
            </div>

            <!-- Address Information -->
            <div class="border-b border-gray-200 pb-6">
                <h3 class="text-lg font-medium text-gray-900 mb-4">Información de Dirección</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="md:col-span-2">
                        <x-input-label for="address" :value="__('Dirección')" />
                        <x-text-input id="address" class="block mt-1 w-full" type="text" name="address" :value="old('address')" />
                        <x-input-error :messages="$errors->get('address')" class="mt-2" />
                    </div>

                    <div>
                        <x-input-label for="city" :value="__('Ciudad')" />
                        <x-text-input id="city" class="block mt-1 w-full" type="text" name="city" :value="old('city')" />
                        <x-input-error :messages="$errors->get('city')" class="mt-2" />
                    </div>

                    <div>
                        <x-input-label for="state" :value="__('Estado/Provincia')" />
                        <x-text-input id="state" class="block mt-1 w-full" type="text" name="state" :value="old('state')" />
                        <x-input-error :messages="$errors->get('state')" class="mt-2" />
                    </div>

                    <div>
                        <x-input-label for="country" :value="__('País')" />
                        <x-text-input id="country" class="block mt-1 w-full" type="text" name="country" :value="old('country')" />
                        <x-input-error :messages="$errors->get('country')" class="mt-2" />
                    </div>

                    <div>
                        <x-input-label for="zip" :value="__('Código Postal')" />
                        <x-text-input id="zip" class="block mt-1 w-full" type="text" name="zip" :value="old('zip')" />
                        <x-input-error :messages="$errors->get('zip')" class="mt-2" />
                    </div>
                </div>
            </div>

            <!-- Actions -->
            <div class="flex justify-end space-x-4">
                <a href="{{ route('customers.index') }}" class="bg-gray-300 hover:bg-gray-400 text-gray-800 px-6 py-2 rounded-lg">
                    Cancelar
                </a>
                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-lg">
                    Crear Cliente
                </button>
            </div>
        </form>
    </div>
</x-app-layout>
