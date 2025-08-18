
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Inicio') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Statistics Cards -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-6 mb-8">
                <!-- Total Products -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <div class="w-8 h-8 bg-blue-500 rounded-full flex items-center justify-center">
                                    <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                                    </svg>
                                </div>
                            </div>
                            <div class="ml-4">
                                <div class="text-2xl font-bold text-gray-900">{{ $totalProducts }}</div>
                                <div class="text-sm text-gray-500">Productos totales</div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Available Pets -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <div class="w-8 h-8 bg-green-500 rounded-full flex items-center justify-center">
                                    <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                                    </svg>
                                </div>
                            </div>
                            <div class="ml-4">
                                <div class="text-2xl font-bold text-gray-900">{{ $totalPets }}</div>
                                <div class="text-sm text-gray-500">Mascotas disponibles</div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Total Sales -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <div class="w-8 h-8 bg-yellow-500 rounded-full flex items-center justify-center">
                                    <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path>
                                    </svg>
                                </div>
                            </div>
                            <div class="ml-4">
                                <div class="text-2xl font-bold text-gray-900">{{ $totalSales }}</div>
                                <div class="text-sm text-gray-500">Ventas totales</div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Total Customers -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <div class="w-8 h-8 bg-purple-500 rounded-full flex items-center justify-center">
                                    <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z"></path>
                                    </svg>
                                </div>
                            </div>
                            <div class="ml-4">
                                <div class="text-2xl font-bold text-gray-900">{{ $totalCustomers }}</div>
                                <div class="text-sm text-gray-500">Total de clientes</div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Low Stock Alert -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <div class="w-8 h-8 {{ $lowStockProducts > 0 ? 'bg-red-500' : 'bg-gray-400' }} rounded-full flex items-center justify-center">
                                    <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.732 16.5c-.77.833.192 2.5 1.732 2.5z"></path>
                                    </svg>
                                </div>
                            </div>
                            <div class="ml-4">
                                <div class="text-2xl font-bold {{ $lowStockProducts > 0 ? 'text-red-600' : 'text-gray-900' }}">{{ $lowStockProducts }}</div>
                                <div class="text-sm text-gray-500">Artículos con bajo stock</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Quick Actions -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-8">
                <div class="p-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Acciones rápidas</h3>
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                        <a href="http://127.0.0.1:8000/products/create" class="flex items-center p-4 bg-blue-50 rounded-lg hover:bg-blue-100 transition duration-150">
                            <svg class="w-6 h-6 text-blue-600 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                            </svg>
                            <span class="text-blue-800 font-medium">Agregar producto</span>
                        </a>
                        <a href="http://127.0.0.1:8000/pets/create" class="flex items-center p-4 bg-green-50 rounded-lg hover:bg-green-100 transition duration-150">
                            <svg class="w-6 h-6 text-green-600 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                            </svg>
                            <span class="text-green-800 font-medium">Registrar mascota</span>
                        </a>
                        <a href="http://127.0.0.1:8000/sales/create" class="flex items-center p-4 bg-yellow-50 rounded-lg hover:bg-yellow-100 transition duration-150">
                            <svg class="w-6 h-6 text-yellow-600 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"></path>
                            </svg>
                            <span class="text-yellow-800 font-medium">Nueva venta</span>
                        </a>
                        <a href="http://127.0.0.1:8000/customers/create" class="flex items-center p-4 bg-purple-50 rounded-lg hover:bg-purple-100 transition duration-150">
                            <svg class="w-6 h-6 text-purple-600 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                            </svg>
                            <span class="text-purple-800 font-medium">Agregar cliente</span>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Recent Sales and Low Stock Alerts -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                <!-- Recent Sales -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <h3 class="text-lg font-semibold text-gray-900 mb-4">Ventas recientes</h3>
                        @if($recentSales->count() > 0)
                            <div class="space-y-4">
                                @foreach($recentSales as $sale)
                                    <div class="flex items-center justify-between p-4 bg-gray-50 rounded-lg">
                                        <div>
                                            <div class="font-medium text-gray-900">{{ $sale->customer->name }}</div>
                                            <div class="text-sm text-gray-500">Sale #{{ $sale->id }} • {{ $sale->created_at->diffForHumans() }}</div>
                                            <div class="text-sm text-gray-500">Sold by: {{ $sale->user->name }}</div>
                                        </div>
                                        <div class="text-right">
                                            <div class="font-bold text-green-600">${{ number_format($sale->total, 2) }}</div>
                                            <div class="text-xs text-gray-500">{{ $sale->saleItems->count() }} items</div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            <div class="mt-4">
                                <a href="#" class="text-blue-600 hover:text-blue-800 text-sm font-medium">View all sales →</a>
                            </div>
                        @else
                            <div class="text-center py-8">
                                <svg class="w-12 h-12 text-gray-400 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path>
                                </svg>
                                <p class="text-gray-500">No hay ventas registradas aún</p>
                                <a href="#" class="text-blue-600 hover:text-blue-800 text-sm font-medium mt-2 inline-block">Haz tu primera venta →</a>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- System Overview -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <h3 class="text-lg font-semibold text-gray-900 mb-4">Descripción general del sistema</h3>
                        <div class="space-y-4">
                            <!-- Inventory Status -->
                            <div class="flex items-center justify-between p-4 bg-gray-50 rounded-lg">
                                <div class="flex items-center">
                                    <div class="w-3 h-3 {{ $lowStockProducts > 0 ? 'bg-red-500' : 'bg-green-500' }} rounded-full mr-3"></div>
                                    <span class="text-gray-700">Estado del inventario</span>
                                </div>
                                <span class="text-sm {{ $lowStockProducts > 0 ? 'text-red-600' : 'text-green-600' }} font-medium">
                                    {{ $lowStockProducts > 0 ? $lowStockProducts . ' items low' : 'Todos los artículos en stock' }}
                                </span>
                            </div>

                            <!-- Sales Performance -->
                            <div class="flex items-center justify-between p-4 bg-gray-50 rounded-lg">
                                <div class="flex items-center">
                                    <div class="w-3 h-3 bg-blue-500 rounded-full mr-3"></div>
                                    <span class="text-gray-700">Ventas de hoy</span>
                                </div>
                                <span class="text-sm text-blue-600 font-medium">{{ $salesToday }} ventas</span>
                            </div>

                            <!-- Pet Availability -->
                            <div class="flex items-center justify-between p-4 bg-gray-50 rounded-lg">
                                <div class="flex items-center">
                                    <div class="w-3 h-3 bg-purple-500 rounded-full mr-3"></div>
                                    <span class="text-gray-700">Mascotas disponibles</span>
                                </div>
                                <span class="text-sm text-purple-600 font-medium">{{ $totalPets }} mascotas listas</span>
                            </div>

                            <!-- Customer Growth -->
                            <div class="flex items-center justify-between p-4 bg-gray-50 rounded-lg">
                                <div class="flex items-center">
                                    <div class="w-3 h-3 bg-green-500 rounded-full mr-3"></div>
                                    <span class="text-gray-700">Base de clientes</span>
                                </div>
                                <span class="text-sm text-green-600 font-medium">{{ $totalCustomers }} Clientes</span>
                            </div>
                        </div>

                        
                    </div>
                </div>
            </div>

            <!-- Welcome Message for New Users -->
            @if($totalProducts == 0 && $totalPets == 0 && $totalSales == 0)
                <div class="mt-8 bg-blue-50 border border-blue-200 rounded-lg p-6">
                    <div class="flex items-start">
                        <div class="flex-shrink-0">
                            <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <div class="ml-3">
                            <h3 class="text-lg font-medium text-blue-900">¡Bienvenido a su sistema de gestión de tienda de mascotas!</h3>
                            <div class="mt-2 text-sm text-blue-700">
                                <p>Empieza añadiendo tus primeros productos y mascotas al sistema. Esto es lo que puedes hacer:</p>
                                <ul class="mt-2 list-disc list-inside space-y-1">
                                    <li>Agregue productos como alimentos, juguetes y accesorios.</li>
                                    <li>Register pets available for sale</li>
                                    <li>Registrar mascotas disponibles para la venta</li>
                                    <li>Procesar ventas y generar recibos</li>
                                    <li>Monitorear el inventario y generar informes</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>