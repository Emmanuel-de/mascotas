<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Detalles del producto') }}
            </h2>
            <div class="flex space-x-2">
                <a href="{{ route('products.index') }}" 
                   class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                    Volver
                </a>
                @if(auth()->user()->role !== 'customer')
                    <a href="{{ route('products.edit', $product) }}" 
                       class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                        Editar producto
                    </a>
                @endif
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

            <!-- Product Details Card -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        <!-- Product Image -->
                        <div class="space-y-4">
                            <div class="aspect-square bg-gray-100 rounded-lg overflow-hidden">
                                @if($product->image)
                                    <img src="{{ asset('storage/products/' . $product->image) }}" 
                                         alt="{{ $product->name }}"
                                         class="w-full h-full object-cover">
                                @else
                                    <div class="w-full h-full flex items-center justify-center bg-gray-200">
                                        <svg class="w-24 h-24 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                                        </svg>
                                    </div>
                                @endif
                            </div>
                        </div>

                        <!-- Product Information -->
                        <div class="space-y-6">
                            <div>
                                <h1 class="text-3xl font-bold text-gray-900">{{ $product->name }}</h1>
                                <div class="mt-2 flex items-center">
                                    <span class="inline-flex px-3 py-1 text-sm font-semibold rounded-full bg-blue-100 text-blue-800">
                                        {{ $product->category->name }}
                                    </span>
                                </div>
                            </div>

                            <!-- Price -->
                            <div class="border-t pt-6">
                                <div class="flex items-center justify-between">
                                    <span class="text-lg font-medium text-gray-900">Precio:</span>
                                    <span class="text-3xl font-bold text-green-600">${{ number_format($product->price, 2) }}</span>
                                </div>
                            </div>

                            <!-- Stock Status -->
                            <div class="border-t pt-6">
                                <div class="flex items-center justify-between">
                                    <span class="text-lg font-medium text-gray-900">Existencias:</span>
                                    <div class="text-right">
                                        <div class="text-2xl font-bold {{ $product->stock <= 10 ? 'text-red-600' : 'text-gray-900' }}">
                                            {{ $product->stock }} unidades
                                        </div>
                                        <div class="mt-1">
                                            @if($product->stock == 0)
                                                <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-red-100 text-red-800">
                                                    Agotado
                                                </span>
                                            @elseif($product->stock <= 10)
                                                <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                                    Stock bajo
                                                </span>
                                            @else
                                                <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800">
                                                    En stock
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Description -->
                            @if($product->description)
                                <div class="border-t pt-6">
                                    <h3 class="text-lg font-medium text-gray-900 mb-3">Descripción</h3>
                                    <p class="text-gray-600 leading-relaxed">{{ $product->description }}</p>
                                </div>
                            @endif

                            <!-- Product Metadata -->
                            <div class="border-t pt-6 space-y-3">
                                <div class="flex justify-between text-sm">
                                    <span class="text-gray-500">Fecha de creación:</span>
                                    <span class="text-gray-900">{{ $product->created_at->format('d/m/Y H:i') }}</span>
                                </div>
                                <div class="flex justify-between text-sm">
                                    <span class="text-gray-500">Última actualización:</span>
                                    <span class="text-gray-900">{{ $product->updated_at->format('d/m/Y H:i') }}</span>
                                </div>
                            </div>

                            <!-- Action Buttons -->
                            @if(auth()->user()->role !== 'customer')
                                <div class="border-t pt-6">
                                    <div class="flex space-x-3">
                                        <a href="{{ route('products.edit', $product) }}" 
                                           class="flex-1 bg-blue-500 hover:bg-blue-700 text-white font-bold py-3 px-4 rounded text-center">
                                            Editar producto
                                        </a>
                                        <form action="{{ route('products.destroy', $product) }}" 
                                              method="POST" 
                                              class="flex-1"
                                              onsubmit="return confirm('¿Estás seguro de que quieres eliminar este producto?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" 
                                                    class="w-full bg-red-500 hover:bg-red-700 text-white font-bold py-3 px-4 rounded">
                                                Eliminar producto
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <!-- Additional Information Cards -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-6">
                <!-- Stock Alert Card -->
                @if($product->stock <= 10)
                    <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-6">
                        <div class="flex items-center">
                            <svg class="w-6 h-6 text-yellow-600 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.732 16.5c-.77.833.192 2.5 1.732 2.5z"></path>
                            </svg>
                            <div>
                                <h3 class="font-semibold text-yellow-800">{{ $product->stock == 0 ? 'Producto agotado' : 'Stock bajo' }}</h3>
                                <p class="text-sm text-yellow-700">
                                    {{ $product->stock == 0 ? 'Este producto no tiene existencias disponibles.' : 'Considere reabastecer este producto pronto.' }}
                                </p>
                            </div>
                        </div>
                    </div>
                @endif

                <!-- Value Card -->
                <div class="bg-blue-50 border border-blue-200 rounded-lg p-6">
                    <div class="flex items-center">
                        <svg class="w-6 h-6 text-blue-600 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"></path>
                        </svg>
                        <div>
                            <h3 class="font-semibold text-blue-800">Valor del inventario</h3>
                            <p class="text-sm text-blue-700">
                                ${{ number_format($product->price * $product->stock, 2) }}
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Category Info Card -->
                <div class="bg-green-50 border border-green-200 rounded-lg p-6">
                    <div class="flex items-center">
                        <svg class="w-6 h-6 text-green-600 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.99 1.99 0 013 12V7a4 4 0 014-4z"></path>
                        </svg>
                        <div>
                            <h3 class="font-semibold text-green-800">Categoría</h3>
                            <p class="text-sm text-green-700">{{ $product->category->name }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>