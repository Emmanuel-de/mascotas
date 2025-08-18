<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Nueva venta') }}
            </h2>
            <a href="{{ route('sales.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                Volver a la lista
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Validation Errors -->
            @if ($errors->any())
                <div class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded">
                    <strong>Por favor corrija los siguientes errores:</strong>
                    <ul class="mt-2 list-disc list-inside">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('sales.store') }}" id="saleForm">
                @csrf

                <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                    <!-- Customer Selection -->
                    <div class="lg:col-span-1">
                        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                            <div class="p-6 bg-white border-b border-gray-200">
                                <h3 class="text-lg font-semibold text-gray-900 mb-4">Información del cliente</h3>
                                
                                <div>
                                    <label for="customer_id" class="block text-sm font-medium text-gray-700">Cliente *</label>
                                    <select name="customer_id" 
                                            id="customer_id" 
                                            required
                                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 @error('customer_id') border-red-500 @enderror">
                                        <option value="">Seleccione un cliente</option>
                                        @foreach($customers as $customer)
                                            <option value="{{ $customer->id }}" {{ old('customer_id') == $customer->id ? 'selected' : '' }}>
                                                {{ $customer->name }} - {{ $customer->email }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('customer_id')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="mt-4 p-4 bg-gray-50 rounded-lg" id="customerInfo" style="display: none;">
                                    <h4 class="font-medium text-gray-900">Información del cliente:</h4>
                                    <div id="customerDetails" class="mt-2 text-sm text-gray-600"></div>
                                </div>
                            </div>
                        </div>

                        <!-- Sale Summary -->
                        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mt-6">
                            <div class="p-6 bg-white border-b border-gray-200">
                                <h3 class="text-lg font-semibold text-gray-900 mb-4">Resumen de venta</h3>
                                
                                <div class="space-y-2">
                                    <div class="flex justify-between">
                                        <span class="text-gray-600">Subtotal:</span>
                                        <span id="subtotal" class="font-medium">$0.00</span>
                                    </div>
                                    <div class="flex justify-between">
                                        <span class="text-gray-600">Impuestos (16%):</span>
                                        <span id="taxes" class="font-medium">$0.00</span>
                                    </div>
                                    <div class="border-t pt-2">
                                        <div class="flex justify-between">
                                            <span class="text-lg font-semibold text-gray-900">Total:</span>
                                            <span id="total" class="text-lg font-semibold text-gray-900">$0.00</span>
                                        </div>
                                    </div>
                                </div>

                                <button type="submit" 
                                        id="submitBtn"
                                        disabled
                                        class="w-full mt-6 bg-blue-500 hover:bg-blue-700 text-white font-bold py-3 px-4 rounded disabled:bg-gray-300 disabled:cursor-not-allowed">
                                    Procesar venta
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Items Selection -->
                    <div class="lg:col-span-2">
                        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                            <div class="p-6 bg-white border-b border-gray-200">
                                <div class="flex justify-between items-center mb-4">
                                    <h3 class="text-lg font-semibold text-gray-900">Artículos de venta</h3>
                                    <div class="flex space-x-2">
                                        <button type="button" 
                                                onclick="addProductRow()" 
                                                class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded text-sm">
                                            + Producto
                                        </button>
                                        <button type="button" 
                                                onclick="addPetRow()" 
                                                class="bg-purple-500 hover:bg-purple-700 text-white font-bold py-2 px-4 rounded text-sm">
                                            + Mascota
                                        </button>
                                    </div>
                                </div>

                                <!-- Items Table -->
                                <div class="overflow-x-auto">
                                    <table class="min-w-full divide-y divide-gray-200">
                                        <thead class="bg-gray-50">
                                            <tr>
                                                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Tipo</th>
                                                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Artículo</th>
                                                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Cantidad</th>
                                                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Precio</th>
                                                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Subtotal</th>
                                                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Acciones</th>
                                            </tr>
                                        </thead>
                                        <tbody id="itemsTable" class="bg-white divide-y divide-gray-200">
                                            <!-- Items will be added dynamically -->
                                        </tbody>
                                    </table>
                                </div>

                                <div id="emptyState" class="text-center py-8">
                                    <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                                    </svg>
                                    <h3 class="mt-2 text-sm font-medium text-gray-900">No hay artículos agregados</h3>
                                    <p class="mt-1 text-sm text-gray-500">Agregue productos o mascotas para comenzar la venta.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <script>
        let itemCounter = 0;
        const products = @json($products);
        const pets = @json($pets);
        const customers = @json($customers);

        // Customer selection handler
        document.getElementById('customer_id').addEventListener('change', function() {
            const customerId = this.value;
            const customerInfo = document.getElementById('customerInfo');
            const customerDetails = document.getElementById('customerDetails');

            if (customerId) {
                const customer = customers.find(c => c.id == customerId);
                if (customer) {
                    customerDetails.innerHTML = `
                        <p><strong>Nombre:</strong> ${customer.name}</p>
                        <p><strong>Email:</strong> ${customer.email}</p>
                        <p><strong>Teléfono:</strong> ${customer.phone || 'N/A'}</p>
                    `;
                    customerInfo.style.display = 'block';
                }
            } else {
                customerInfo.style.display = 'none';
            }
            updateSubmitButton();
        });

        function addProductRow() {
            const tbody = document.getElementById('itemsTable');
            const emptyState = document.getElementById('emptyState');
            
            const row = document.createElement('tr');
            row.innerHTML = `
                <td class="px-4 py-4">
                    <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800">
                        Producto
                    </span>
                    <input type="hidden" name="items[${itemCounter}][type]" value="product">
                </td>
                <td class="px-4 py-4">
                    <select name="items[${itemCounter}][id]" onchange="updatePrice(this, ${itemCounter})" class="block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" required>
                        <option value="">Seleccione un producto</option>
                        ${products.map(p => `<option value="${p.id}" data-price="${p.price}" data-stock="${p.stock}">${p.name} - Stock: ${p.stock}</option>`).join('')}
                    </select>
                </td>
                <td class="px-4 py-4">
                    <input type="number" name="items[${itemCounter}][quantity]" min="1" value="1" onchange="updateSubtotal(${itemCounter})" class="block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" required>
                </td>
                <td class="px-4 py-4">
                    <span id="price_${itemCounter}" class="text-sm text-gray-900">$0.00</span>
                </td>
                <td class="px-4 py-4">
                    <span id="subtotal_${itemCounter}" class="font-medium text-gray-900">$0.00</span>
                </td>
                <td class="px-4 py-4">
                    <button type="button" onclick="removeRow(this)" class="text-red-600 hover:text-red-900">
                        Eliminar
                    </button>
                </td>
            `;
            
            tbody.appendChild(row);
            emptyState.style.display = 'none';
            itemCounter++;
        }

        function addPetRow() {
            const tbody = document.getElementById('itemsTable');
            const emptyState = document.getElementById('emptyState');
            
            const row = document.createElement('tr');
            row.innerHTML = `
                <td class="px-4 py-4">
                    <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-purple-100 text-purple-800">
                        Mascota
                    </span>
                    <input type="hidden" name="items[${itemCounter}][type]" value="pet">
                </td>
                <td class="px-4 py-4">
                    <select name="items[${itemCounter}][id]" onchange="updatePrice(this, ${itemCounter})" class="block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" required>
                        <option value="">Seleccione una mascota</option>
                        ${pets.map(p => `<option value="${p.id}" data-price="${p.price}">${p.name} - ${p.breed.replace('_', ' ')} ($${p.price})</option>`).join('')}
                    </select>
                </td>
                <td class="px-4 py-4">
                    <input type="number" name="items[${itemCounter}][quantity]" value="1" readonly class="block w-full bg-gray-100 border-gray-300 rounded-md shadow-sm" required>
                </td>
                <td class="px-4 py-4">
                    <span id="price_${itemCounter}" class="text-sm text-gray-900">$0.00</span>
                </td>
                <td class="px-4 py-4">
                    <span id="subtotal_${itemCounter}" class="font-medium text-gray-900">$0.00</span>
                </td>
                <td class="px-4 py-4">
                    <button type="button" onclick="removeRow(this)" class="text-red-600 hover:text-red-900">
                        Eliminar
                    </button>
                </td>
            `;
            
            tbody.appendChild(row);
            emptyState.style.display = 'none';
            itemCounter++;
        }

        function updatePrice(select, index) {
            const option = select.selectedOptions[0];
            const price = option.dataset.price || 0;
            document.getElementById(`price_${index}`).textContent = `$${parseFloat(price).toFixed(2)}`;
            updateSubtotal(index);
        }

        function updateSubtotal(index) {
            const price = parseFloat(document.getElementById(`price_${index}`).textContent.replace('$', '')) || 0;
            const quantity = parseInt(document.querySelector(`input[name="items[${index}][quantity]"]`).value) || 0;
            const subtotal = price * quantity;
            document.getElementById(`subtotal_${index}`).textContent = `$${subtotal.toFixed(2)}`;
            updateTotals();
        }

        function removeRow(button) {
            const row = button.closest('tr');
            row.remove();
            
            const tbody = document.getElementById('itemsTable');
            const emptyState = document.getElementById('emptyState');
            
            if (tbody.children.length === 0) {
                emptyState.style.display = 'block';
            }
            
            updateTotals();
        }

        function updateTotals() {
            const subtotals = document.querySelectorAll('[id^="subtotal_"]');
            let total = 0;
            
            subtotals.forEach(subtotalElement => {
                const value = parseFloat(subtotalElement.textContent.replace('$', '')) || 0;
                total += value;
            });
            
            const taxes = total * 0.16;
            const finalTotal = total + taxes;
            
            document.getElementById('subtotal').textContent = `$${total.toFixed(2)}`;
            document.getElementById('taxes').textContent = `$${taxes.toFixed(2)}`;
            document.getElementById('total').textContent = `$${finalTotal.toFixed(2)}`;
            
            updateSubmitButton();
        }

        function updateSubmitButton() {
            const customerId = document.getElementById('customer_id').value;
            const hasItems = document.getElementById('itemsTable').children.length > 0;
            const submitBtn = document.getElementById('submitBtn');
            
            if (customerId && hasItems) {
                submitBtn.disabled = false;
                submitBtn.classList.remove('disabled:bg-gray-300', 'disabled:cursor-not-allowed');
            } else {
                submitBtn.disabled = true;
                submitBtn.classList.add('disabled:bg-gray-300', 'disabled:cursor-not-allowed');
            }
        }

        // Form validation before submit
        document.getElementById('saleForm').addEventListener('submit', function(e) {
            const items = document.querySelectorAll('#itemsTable tr');
            if (items.length === 0) {
                e.preventDefault();
                alert('Debe agregar al menos un artículo a la venta.');
                return false;
            }
        });
    </script>
</x-app-layout>