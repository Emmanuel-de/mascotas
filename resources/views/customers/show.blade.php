<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <!-- Título de la página con el nombre del cliente -->
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Detalles del cliente: ') . $customer->name }}
            </h2>
            <!-- Botón para regresar a la lista de clientes -->
            <a href="{{ route('customers.index') }}" class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded">
                Regresar
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Success Message -->
            @if(session('success'))
                <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded">
                    {{ session('success') }}
                </div>
            @endif

            <!-- Customer Details Card -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6 bg-white border-b border-gray-200">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Información del Cliente</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <p class="text-sm font-medium text-gray-500">Nombre</p>
                            <p class="mt-1 text-sm text-gray-900">{{ $customer->name }}</p>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-gray-500">Correo Electrónico</p>
                            <p class="mt-1 text-sm text-gray-900">{{ $customer->email }}</p>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-gray-500">Teléfono</p>
                            <p class="mt-1 text-sm text-gray-900">{{ $customer->phone }}</p>
                        </div>
                        <div class="md:col-span-2">
                            <p class="text-sm font-medium text-gray-500">Dirección</p>
                            <p class="mt-1 text-sm text-gray-900">{{ $customer->address }}</p>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-gray-500">Fecha de Registro</p>
                            <p class="mt-1 text-sm text-gray-900">{{ $customer->created_at->format('d/m/Y H:i A') }}</p>
                        </div>
                    </div>
                    
                    <!-- Action Buttons -->
                    <div class="mt-6 flex space-x-2">
                        <a href="{{ route('customers.edit', $customer) }}" class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700">
                            Editar
                        </a>
                        <form action="{{ route('customers.destroy', $customer) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" 
                                    class="inline-flex items-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-700"
                                    onclick="return confirm('¿Está seguro de que desea eliminar este cliente y todas sus ventas asociadas?')">
                                Eliminar
                            </button>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Customer Sales Card -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Historial de Ventas</h3>
                    @if($customer->sales->count() > 0)
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Venta #
                                        </th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Monto Total
                                        </th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Fecha
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    @foreach($customer->sales as $sale)
                                        <tr class="hover:bg-gray-50">
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                                {{ $sale->id }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                                ${{ number_format($sale->total, 2) }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                                {{ $sale->created_at->format('d/m/Y H:i A') }}
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <!-- Mensaje si no hay ventas -->
                        <div class="text-center py-4 text-gray-500">
                            <p>Este cliente no tiene ventas registradas.</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>