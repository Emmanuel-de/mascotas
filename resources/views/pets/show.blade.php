<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <!-- Título de la página con el nombre de la mascota -->
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Detalles de la mascota: ') . $pet->name }}
            </h2>
            <!-- Botón para regresar a la lista de mascotas -->
            <a href="{{ route('pets.index') }}" class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded">
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

            <!-- Pet Details Card -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="flex flex-col md:flex-row items-start md:items-center">
                        <!-- Pet Image -->
                        <div class="flex-shrink-0 mb-4 md:mb-0 md:mr-6">
                            @if($pet->image)
                                <img src="{{ asset('storage/' . $pet->image) }}" alt="{{ $pet->name }}" class="w-64 h-64 object-cover rounded-md shadow-md">
                            @else
                                <img src="{{ asset('images/pet-placeholder.jpg') }}" alt="Placeholder de mascota" class="w-64 h-64 object-cover rounded-md shadow-md">
                            @endif
                        </div>
                        
                        <!-- Pet Information -->
                        <div class="flex-grow">
                            <h3 class="text-2xl font-bold text-gray-900 mb-2">{{ $pet->name }}</h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <p class="text-sm font-medium text-gray-500">Raza</p>
                                    <p class="mt-1 text-sm text-gray-900">{{ $pet->breed }}</p>
                                </div>
                                <div>
                                    <p class="text-sm font-medium text-gray-500">Edad</p>
                                    <p class="mt-1 text-sm text-gray-900">{{ $pet->age }} años</p>
                                </div>
                                <div>
                                    <p class="text-sm font-medium text-gray-500">Precio</p>
                                    <p class="mt-1 text-sm text-gray-900">${{ number_format($pet->price, 2) }}</p>
                                </div>
                                <div>
                                    <p class="text-sm font-medium text-gray-500">Condición</p>
                                    <p class="mt-1 text-sm text-gray-900 capitalize">{{ $pet->condition }}</p>
                                </div>
                                <div>
                                    <p class="text-sm font-medium text-gray-500">Disponibilidad</p>
                                    <p class="mt-1 text-sm text-gray-900">{{ $pet->available ? 'Disponible' : 'No Disponible' }}</p>
                                </div>
                            </div>
                            
                            <div class="mt-4">
                                <p class="text-sm font-medium text-gray-500">Descripción</p>
                                <p class="mt-1 text-sm text-gray-900">{{ $pet->description }}</p>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Action Buttons -->
                    <div class="mt-6 flex space-x-2">
                        <a href="{{ route('pets.edit', $pet) }}" class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700">
                            Editar
                        </a>
                        <form action="{{ route('pets.destroy', $pet) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" 
                                    class="inline-flex items-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-700"
                                    onclick="return confirm('¿Está seguro de que desea eliminar esta mascota?')">
                                Eliminar
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
