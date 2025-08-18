<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Agregar nueva mascota') }}
            </h2>
            <a href="{{ route('pets.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
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

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form method="POST" action="{{ route('pets.store') }}" enctype="multipart/form-data">
                        @csrf

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Name -->
                            <div>
                                <label for="name" class="block text-sm font-medium text-gray-700">Nombre *</label>
                                <input type="text" 
                                       name="name" 
                                       id="name"
                                       value="{{ old('name') }}"
                                       required
                                       class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 @error('name') border-red-500 @enderror">
                                @error('name')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Breed -->
                            <div>
                                <label for="breed" class="block text-sm font-medium text-gray-700">Raza *</label>
                                <select name="breed" 
                                        id="breed" 
                                        required
                                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 @error('breed') border-red-500 @enderror">
                                    <option value="">Seleccione una raza</option>
                                    <option value="labrador" {{ old('breed') == 'labrador' ? 'selected' : '' }}>Labrador</option>
                                    <option value="golden_retriever" {{ old('breed') == 'golden_retriever' ? 'selected' : '' }}>Golden Retriever</option>
                                    <option value="poodle" {{ old('breed') == 'poodle' ? 'selected' : '' }}>Poodle</option>
                                    <option value="bulldog" {{ old('breed') == 'bulldog' ? 'selected' : '' }}>Bulldog</option>
                                    <option value="persian" {{ old('breed') == 'persian' ? 'selected' : '' }}>Gato persa</option>
                                    <option value="siamese" {{ old('breed') == 'siamese' ? 'selected' : '' }}>Gato siamés</option>
                                    <option value="other" {{ old('breed') == 'other' ? 'selected' : '' }}>Otra</option>
                                </select>
                                @error('breed')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Age -->
                            <div>
                                <label for="age" class="block text-sm font-medium text-gray-700">Edad (años) *</label>
                                <input type="number" 
                                       name="age" 
                                       id="age"
                                       value="{{ old('age') }}"
                                       min="0"
                                       required
                                       class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 @error('age') border-red-500 @enderror">
                                @error('age')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Price -->
                            <div>
                                <label for="price" class="block text-sm font-medium text-gray-700">Precio ($) *</label>
                                <input type="number" 
                                       name="price" 
                                       id="price"
                                       value="{{ old('price') }}"
                                       min="0"
                                       step="0.01"
                                       required
                                       class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 @error('price') border-red-500 @enderror">
                                @error('price')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Condition -->
                            <div>
                                <label for="condition" class="block text-sm font-medium text-gray-700">Condición *</label>
                                <select name="condition" 
                                        id="condition" 
                                        required
                                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 @error('condition') border-red-500 @enderror">
                                    <option value="">Seleccione una condición</option>
                                    <option value="excellent" {{ old('condition') == 'excellent' ? 'selected' : '' }}>Excelente</option>
                                    <option value="good" {{ old('condition') == 'good' ? 'selected' : '' }}>Buena</option>
                                    <option value="fair" {{ old('condition') == 'fair' ? 'selected' : '' }}>Regular</option>
                                </select>
                                @error('condition')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Image Upload -->
                            <div>
                                <label for="image" class="block text-sm font-medium text-gray-700">Imagen</label>
                                <input type="file" 
                                       name="image" 
                                       id="image"
                                       accept="image/*"
                                       class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
                                @error('image')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <!-- Description -->
                        <div class="mt-6">
                            <label for="description" class="block text-sm font-medium text-gray-700">Descripción</label>
                            <textarea name="description" 
                                      id="description"
                                      rows="4"
                                      placeholder="Descripción detallada de la mascota..."
                                      class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 @error('description') border-red-500 @enderror">{{ old('description') }}</textarea>
                            @error('description')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Available Checkbox -->
                        <div class="mt-6">
                            <div class="flex items-center">
                                <input type="checkbox" 
                                       name="available" 
                                       id="available"
                                       value="1"
                                       {{ old('available', true) ? 'checked' : '' }}
                                       class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                                <label for="available" class="ml-2 block text-sm text-gray-900">
                                    Mascota disponible para venta
                                </label>
                            </div>
                        </div>

                        <!-- Form Actions -->
                        <div class="mt-6 flex items-center justify-end space-x-4">
                            <a href="{{ route('pets.index') }}" 
                               class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded">
                                Cancelar
                            </a>
                            <button type="submit" 
                                    class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                Crear mascota
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>