<x-app-layout>
    <x-slot name="header">
        Ventas
    </x-slot>

    <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-900">Creando nueva Venta</h1>
    </div>

    <form id="saleForm" action="{{ route('sales.store') }}" method="POST">
        @csrf
        <input type="hidden" name="products" id="productsField">
        <input type="hidden" name="subtotal" id="subtotalField">
        <input type="hidden" name="total" id="totalField">
    </form>
    <div class="bg-white p-6 rounded shadow-md max-w-4xl mx-auto">

        {{-- FORMULARIO PARA AGREGAR PRODUCTOS --}}
        <div class="grid grid-cols-3 gap-4">

            {{-- PRODUCTO --}}
            <div>
                <label class="font-semibold">Producto</label>
                <select id="product_id" class="w-full border rounded p-2">
                    <option value="">Seleccione</option>

                    @foreach ($products as $product)
                        <option value="{{ $product->id }}"
                                data-name="{{ $product->name }}"
                                data-price="{{ $product->sale_price }}">
                            {{ $product->name }} ({{ $product->sku }})
                        </option>
                    @endforeach
                </select>
            </div>

            {{-- CANTIDAD --}}
            <div>
                <label class="font-semibold">Cantidad</label>
                <input type="number" id="quantity" min="1" value="1"
                       class="w-full border rounded p-2">
            </div>

            {{-- BOTÓN AGREGAR --}}
            <div class="flex items-end">
                <button id="addProduct"
                        class="mt-6 bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">
                    Agregar
                </button>
            </div>
        </div>

        {{-- TABLA DE PRODUCTOS AGREGADOS --}}
        <div class="mt-6">
            <table class="w-full table-auto border-collapse" id="productsTable">
                <thead>
                <tr class="bg-gray-200 text-left">
                    <th class="p-2">Producto</th>
                    <th class="p-2">Cantidad</th>
                    <th class="p-2">Precio</th>
                    <th class="p-2">Subtotal</th>
                    <th class="p-2">Acciones</th>
                </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>

        {{-- TOTAL --}}
        <div class="text-right mt-4 text-xl font-bold">
            Total: $<span id="totalAmount">0.00</span>
        </div>

        {{-- BOTÓN GUARDAR VENTA --}}
        <button id="saveSale"
                class="mt-6 bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded w-full">
            Guardar Venta
        </button>
    </div>


    {{-- SCRIPT --}}
    <script>
        const addButton = document.getElementById('addProduct');
        const tableBody = document.querySelector('#productsTable tbody');
        const totalAmount = document.getElementById('totalAmount');
        const quantityInput = document.getElementById('quantity');
        const classIsDisabled = "mt-6 bg-gray-500 text-white px-4 py-2 rounded cursor-not-allowed";
        const classNotDisabled = "mt-6 bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded";

        quantityInput.addEventListener("input", () => {
            const value = quantityInput.value.trim();
            const isDisabled =  (value === "" || value <= 0)
            addButton.disabled = isDisabled;
            addButton.className = isDisabled ? classIsDisabled: classNotDisabled;
        });

        let productsInSale = [];

        addButton.addEventListener('click', () => {
            const select = document.getElementById('product_id');
            const quantity = parseInt(document.getElementById('quantity').value);

            const option = select.options[select.selectedIndex];

            if (!option.value) {
                alert("Seleccione un producto");
                return;
            }

            const product = {
                id: option.value,
                name: option.dataset.name,
                price: parseFloat(option.dataset.price),
                quantity: quantity,
                subtotal: quantity * parseFloat(option.dataset.price)
            };

            productsInSale.push(product);

            const row = `
                <tr>
                    <td class="p-2">${product.name}</td>
                    <td class="p-2">${product.quantity}</td>
                    <td class="p-2">$${product.price.toFixed(2)}</td>
                    <td class="p-2">$${product.subtotal.toFixed(2)}</td>
                    <td class="p-2">
                        <button class="text-red-600 deleteBtn">Eliminar</button>
                    </td>
                </tr>
            `;
            tableBody.insertAdjacentHTML('beforeend', row);
            updateTotal();
            document.getElementById('quantity').value = 1;
        });

        document.addEventListener('click', function (e) {
            if (e.target.classList.contains('deleteBtn')) {
                const row = e.target.closest('tr');
                const index = Array.from(tableBody.children).indexOf(row);
                productsInSale.splice(index, 1);
                row.remove();
                updateTotal();
            }
        });

        function updateTotal() {
            const total = productsInSale.reduce((acc, item) => acc + item.subtotal, 0);
            totalAmount.textContent = total.toFixed(2);
        }

        document.getElementById('saveSale').addEventListener('click', () => {
            if (productsInSale.length === 0) {
                alert("Agregue al menos un producto.");
                return;
            }

            document.getElementById('productsField').value = JSON.stringify(productsInSale);

            const subtotal = productsInSale.reduce((acc, p) => acc + p.subtotal, 0);
            document.getElementById('subtotalField').value = subtotal.toFixed(2);
            document.getElementById('totalField').value = subtotal.toFixed(2); // si no hay impuestos

            document.getElementById('saleForm').submit();
        });
    </script>

</x-app-layout>
