<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Detalles de la venta') }} #{{ $sale->id }}
            </h2>
            <div class="flex space-x-2">
                <a href="{{ route('sales.index') }}" 
                   class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                    Volver
                </a>
                <button onclick="window.print()" 
                        class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                    Imprimir
                </button>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <!-- Success Message -->
            @if(session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6">
                    {{ session('success') }}
                </div>
            @endif

            <!-- Sale Information Card -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Sale Details -->
                        <div class="space-y-4">
                            <h3 class="text-lg font-semibold text-gray-900 border-b pb-2">Información de la venta</h3>
                            
                            <div class="space-y-3">
                                <div class="flex justify-between">
                                    <span class="text-sm font-medium text-gray-500">ID de venta:</span>
                                    <span class="text-sm text-gray-900">#{{ $sale->id }}</span>
                                </div>
                                
                                <div class="flex justify-between">
                                    <span class="text-sm font-medium text-gray-500">Fecha de venta:</span>
                                    <span class="text-sm text-gray-900">{{ $sale->sale_date->format('d/m/Y H:i') }}</span>
                                </div>
                                
                                <div class="flex justify-between">
                                    <span class="text-sm font-medium text-gray-500">Total:</span>
                                    <span class="text-lg font-bold text-green-600">${{ number_format($sale->total, 2) }}</span>
                                </div>
                                
                                @if($sale->user)
                                <div class="flex justify-between">
                                    <span class="text-sm font-medium text-gray-500">Vendedor:</span>
                                    <span class="text-sm text-gray-900">{{ $sale->user->name }}</span>
                                </div>
                                @endif
                            </div>
                        </div>

                        <!-- Customer Details -->
                        <div class="space-y-4">
                            <h3 class="text-lg font-semibold text-gray-900 border-b pb-2">Información del cliente</h3>
                            
                            <div class="space-y-3">
                                <div class="flex justify-between">
                                    <span class="text-sm font-medium text-gray-500">Nombre:</span>
                                    <span class="text-sm text-gray-900">{{ $sale->customer->name }}</span>
                                </div>
                                
                                <div class="flex justify-between">
                                    <span class="text-sm font-medium text-gray-500">Email:</span>
                                    <span class="text-sm text-gray-900">{{ $sale->customer->email }}</span>
                                </div>
                                
                                @if($sale->customer->phone)
                                <div class="flex justify-between">
                                    <span class="text-sm font-medium text-gray-500">Teléfono:</span>
                                    <span class="text-sm text-gray-900">{{ $sale->customer->phone }}</span>
                                </div>
                                @endif
                                
                                @if($sale->customer->address)
                                <div class="flex justify-between">
                                    <span class="text-sm font-medium text-gray-500">Dirección:</span>
                                    <span class="text-sm text-gray-900">{{ $sale->customer->address }}</span>
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Sale Items Table -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-6">Artículos vendidos</h3>
                    
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Artículo
                                    </th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Tipo
                                    </th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Cantidad
                                    </th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Precio unitario
                                    </th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Subtotal
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach($sale->saleItems as $item)
                                    <tr class="hover:bg-gray-50">
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="flex items-center">
                                                @if($item->item_type === 'product')
                                                    @php $product = App\Models\Product::find($item->item_id) @endphp
                                                    @if($product)
                                                        <div class="flex-shrink-0 h-10 w-10">
                                                            @if($product->image)
                                                                <img class="h-10 w-10 rounded-full object-cover" 
                                                                     src="{{ asset('storage/products/' . $product->image) }}" 
                                                                     alt="{{ $product->name }}">
                                                            @else
                                                                <div class="h-10 w-10 rounded-full bg-blue-100 flex items-center justify-center">
                                                                    <svg class="w-6 h-6 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                                                                    </svg>
                                                                </div>
                                                            @endif
                                                        </div>
                                                        <div class="ml-4">
                                                            <div class="text-sm font-medium text-gray-900">{{ $product->name }}</div>
                                                            @if($product->description)
                                                                <div class="text-sm text-gray-500">{{ Str::limit($product->description, 30) }}</div>
                                                            @endif
                                                        </div>
                                                    @else
                                                        <div class="text-sm text-gray-500">Producto eliminado</div>
                                                    @endif
                                                @else
                                                    @php $pet = App\Models\Pet::find($item->item_id) @endphp
                                                    @if($pet)
                                                        <div class="flex-shrink-0 h-10 w-10">
                                                            @if($pet->image)
                                                                <img class="h-10 w-10 rounded-full object-cover" 
                                                                     src="{{ asset('storage/pets/' . $pet->image) }}" 
                                                                     alt="{{ $pet->name }}">
                                                            @else
                                                                <div class="h-10 w-10 rounded-full bg-green-100 flex items-center justify-center">
                                                                    <svg class="w-6 h-6 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                                                                    </svg>
                                                                </div>
                                                            @endif
                                                        </div>
                                                        <div class="ml-4">
                                                            <div class="text-sm font-medium text-gray-900">{{ $pet->name }}</div>
                                                            <div class="text-sm text-gray-500">{{ $pet->species ?? '' }} - {{ $pet->breed ?? '' }}</div>
                                                        </div>
                                                    @else
                                                        <div class="text-sm text-gray-500">Mascota no encontrada</div>
                                                    @endif
                                                @endif
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full 
                                                {{ $item->item_type === 'product' ? 'bg-blue-100 text-blue-800' : 'bg-green-100 text-green-800' }}">
                                                {{ $item->item_type === 'product' ? 'Producto' : 'Mascota' }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                            {{ $item->quantity }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                            ${{ number_format($item->price, 2) }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                            ${{ number_format($item->subtotal, 2) }}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot class="bg-gray-50">
                                <tr>
                                    <td colspan="4" class="px-6 py-4 text-right text-sm font-medium text-gray-900">
                                        Total:
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-lg font-bold text-green-600">
                                        ${{ number_format($sale->total, 2) }}
                                    </td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Summary Cards -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-6">
                <!-- Items Count -->
                <div class="bg-blue-50 border border-blue-200 rounded-lg p-6">
                    <div class="flex items-center">
                        <svg class="w-8 h-8 text-blue-600 mr-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.99 1.99 0 013 12V7a4 4 0 014-4z"></path>
                        </svg>
                        <div>
                            <div class="text-2xl font-bold text-blue-900">{{ $sale->saleItems->sum('quantity') }}</div>
                            <div class="text-sm text-blue-700">Artículos vendidos</div>
                        </div>
                    </div>
                </div>

                <!-- Products Count -->
                <div class="bg-green-50 border border-green-200 rounded-lg p-6">
                    <div class="flex items-center">
                        <svg class="w-8 h-8 text-green-600 mr-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                        </svg>
                        <div>
                            <div class="text-2xl font-bold text-green-900">{{ $sale->saleItems->where('item_type', 'product')->count() }}</div>
                            <div class="text-sm text-green-700">Productos</div>
                        </div>
                    </div>
                </div>

                <!-- Pets Count -->
                <div class="bg-purple-50 border border-purple-200 rounded-lg p-6">
                    <div class="flex items-center">
                        <svg class="w-8 h-8 text-purple-600 mr-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                        </svg>
                        <div>
                            <div class="text-2xl font-bold text-purple-900">{{ $sale->saleItems->where('item_type', 'pet')->count() }}</div>
                            <div class="text-sm text-purple-700">Mascotas</div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Print Styles -->
            <style>
                @media print {
                    .no-print { display: none !important; }
                    body { background: white !important; }
                    .bg-gray-50 { background: #f9fafb !important; }
                }
            </style>
        </div>
    </div>
</x-app-layout>