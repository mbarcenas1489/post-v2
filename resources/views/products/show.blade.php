<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Detalle de Producto</h2>
            <a href="{{ route('products.edit',$product) }}" class="inline-flex items-center px-4 py-2 bg-blue-600 text-white rounded">Editar</a>
        </div>
    </x-slot>

    <div class="p-4 max-w-3xl">
        <div class="bg-white p-6 rounded shadow space-y-2">
            <div><strong>SKU:</strong> {{ $product->sku }}</div>
            <div><strong>Nombre:</strong> {{ $product->name }}</div>
            <div><strong>Categoría:</strong> {{ $product->category->name ?? '-' }}</div>
            <div><strong>Proveedor:</strong> {{ $product->supplier->name ?? '-' }}</div>
            <div><strong>Precio:</strong> $ {{ number_format($product->sale_price,2) }}</div>
            <div><strong>Stock:</strong> {{ $product->stock }}</div>
            <div><strong>Descripción:</strong> {{ $product->description }}</div>
        </div>
    </div>
</x-app-layout>
