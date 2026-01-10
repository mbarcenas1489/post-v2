<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Editar Producto</h2>
    </x-slot>

    <div class="p-4 max-w-3xl">
        <form method="POST" action="{{ route('products.update',$product) }}" class="space-y-4 bg-white p-6 rounded shadow">
            @csrf
            @method('PUT')
            <div>
                <label class="block text-sm">Nombre</label>
                <input name="name" value="{{ old('name',$product->name) }}" class="w-full border rounded p-2" required>
                @error('name')<div class="text-red-600 text-sm">{{ $message }}</div>@enderror
            </div>
            <div>
                <label class="block text-sm">SKU</label>
                <input name="sku" value="{{ old('sku',$product->sku) }}" class="w-full border rounded p-2" required>
                @error('sku')<div class="text-red-600 text-sm">{{ $message }}</div>@enderror
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm">Categoría</label>
                    <select name="category_id" class="w-full border rounded p-2">
                        <option value="">--</option>
                        @foreach($categories as $c)
                            <option value="{{ $c->id }}" @selected($product->category_id==$c->id)>{{ $c->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="block text-sm">Proveedor</label>
                    <select name="supplier_id" class="w-full border rounded p-2">
                        <option value="">--</option>
                        @foreach($suppliers as $s)
                            <option value="{{ $s->id }}" @selected($product->supplier_id==$s->id)>{{ $s->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm">Precio Costo</label>
                    <input type="number" step="0.01" name="cost_price" value="{{ old('cost_price',$product->cost_price) }}" class="w-full border rounded p-2" required>
                </div>
                <div>
                    <label class="block text-sm">Precio Venta</label>
                    <input type="number" step="0.01" name="sale_price" value="{{ old('sale_price',$product->sale_price) }}" class="w-full border rounded p-2" required>
                </div>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm">Stock</label>
                    <input type="number" name="stock" value="{{ old('stock',$product->stock) }}" class="w-full border rounded p-2" required>
                </div>
                <div>
                    <label class="block text-sm">Stock Mínimo</label>
                    <input type="number" name="min_stock" value="{{ old('min_stock',$product->min_stock) }}" class="w-full border rounded p-2">
                </div>
            </div>
            <div>
                <label class="block text-sm">Descripción</label>
                <textarea name="description" class="w-full border rounded p-2">{{ old('description',$product->description) }}</textarea>
            </div>
            <div class="flex items-center gap-3">
                <button class="px-4 py-2 bg-blue-600 text-white rounded">Guardar</button>
                <a href="{{ route('products.index') }}" class="px-4 py-2 bg-gray-200 rounded">Cancelar</a>
            </div>
        </form>
    </div>
</x-app-layout>


