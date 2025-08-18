<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <!-- Título de la página con el nombre de la mascota -->
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Editar mascota: ') . $pet->name }}
            </h2>
            <!-- Botón para regresar a la lista de mascotas -->
            <a href="{{ route('pets.index') }}" class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded">
                Regresar
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <!-- Formulario para editar una mascota, usa el método POST y el método HTTP PUT -->
                    <form action="{{ route('pets.update', $pet) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <!-- Nombre de la Mascota -->
                        <div class="mb-4">
                            <label for="name" class="block text-sm font-medium text-gray-700">Nombre</label>
                            <input type="text" name="name" id="name" value="{{ old('name', $pet->name) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                            @error('name')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Raza -->
                        <div class="mb-4">
                            <label for="breed" class="block text-sm font-medium text-gray-700">Raza</label>
                            <input type="text" name="breed" id="breed" value="{{ old('breed', $pet->breed) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                            @error('breed')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Edad -->
                        <div class="mb-4">
                            <label for="age" class="block text-sm font-medium text-gray-700">Edad</label>
                            <input type="number" name="age" id="age" value="{{ old('age', $pet->age) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                            @error('age')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Precio -->
                        <div class="mb-4">
                            <label for="price" class="block text-sm font-medium text-gray-700">Precio</label>
                            <input type="number" name="price" id="price" value="{{ old('price', $pet->price) }}" step="0.01" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                            @error('price')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <!-- Condición -->
                        <div class="mb-4">
                            <label for="condition" class="block text-sm font-medium text-gray-700">Condición</label>
                            <select name="condition" id="condition" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                <option value="excellent" @if($pet->condition == 'excellent') selected @endif>Excelente</option>
                                <option value="good" @if($pet->condition == 'good') selected @endif>Buena</option>
                                <option value="fair" @if($pet->condition == 'fair') selected @endif>Regular</option>
                            </select>
                            @error('condition')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Disponibilidad -->
                        <div class="mb-4">
                            <label for="available" class="inline-flex items-center">
                                <input type="checkbox" name="available" id="available" value="1" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" @if($pet->available) checked @endif>
                                <span class="ml-2 text-sm text-gray-600">Disponible para adopción/venta</span>
                            </label>
                        </div>

                        <!-- Descripción -->
                        <div class="mb-4">
                            <label for="description" class="block text-sm font-medium text-gray-700">Descripción</label>
                            <textarea name="description" id="description" rows="3" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">{{ old('description', $pet->description) }}</textarea>
                            @error('description')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Imagen -->
                        <div class="mb-4">
                            <label for="image" class="block text-sm font-medium text-gray-700">Imagen</label>
                            @if($pet->image)
                                <img src="{{ asset('storage/' . $pet->image) }}" alt="Imagen actual de la mascota" class="mt-2 w-32 h-32 object-cover rounded-md">
                            @endif
                            <input type="file" name="image" id="image" class="mt-2 block w-full">
                            @error('image')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Botón de Envío -->
                        <div class="flex justify-end">
                            <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded-md shadow-sm">
                                Actualizar Mascota
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
