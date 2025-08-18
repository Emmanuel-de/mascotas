<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Agregar nuevo cliente') }}
            </h2>
            <a href="{{ route('customers.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
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
                    <form method="POST" action="{{ route('customers.store') }}">
                        @csrf

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Name -->
                            <div>
                                <label for="name" class="block text-sm font-medium text-gray-700">Nombre completo *</label>
                                <input type="text" 
                                       name="name" 
                                       id="name"
                                       value="{{ old('name') }}"
                                       required
                                       placeholder="Ingrese el nombre completo del cliente"
                                       class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 @error('name') border-red-500 @enderror">
                                @error('name')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Email -->
                            <div>
                                <label for="email" class="block text-sm font-medium text-gray-700">Correo electrónico *</label>
                                <input type="email" 
                                       name="email" 
                                       id="email"
                                       value="{{ old('email') }}"
                                       required
                                       placeholder="ejemplo@correo.com"
                                       class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 @error('email') border-red-500 @enderror">
                                @error('email')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Phone -->
                            <div>
                                <label for="phone" class="block text-sm font-medium text-gray-700">Teléfono *</label>
                                <input type="tel" 
                                       name="phone" 
                                       id="phone"
                                       value="{{ old('phone') }}"
                                       required
                                       placeholder="(555) 123-4567"
                                       maxlength="20"
                                       class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 @error('phone') border-red-500 @enderror">
                                @error('phone')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Additional Info -->
                            <div>
                                <label for="date_of_birth" class="block text-sm font-medium text-gray-700">Fecha de nacimiento</label>
                                <input type="date" 
                                       name="date_of_birth" 
                                       id="date_of_birth"
                                       value="{{ old('date_of_birth') }}"
                                       class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                            </div>
                        </div>

                        <!-- Address -->
                        <div class="mt-6">
                            <label for="address" class="block text-sm font-medium text-gray-700">Dirección completa *</label>
                            <textarea name="address" 
                                      id="address"
                                      rows="3"
                                      required
                                      placeholder="Ingrese la dirección completa del cliente..."
                                      class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 @error('address') border-red-500 @enderror">{{ old('address') }}</textarea>
                            @error('address')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                            <p class="mt-2 text-sm text-gray-600">Incluya calle, número, colonia, ciudad y código postal.</p>
                        </div>

                        <!-- Additional Notes -->
                        <div class="mt-6">
                            <label for="notes" class="block text-sm font-medium text-gray-700">Notas adicionales</label>
                            <textarea name="notes" 
                                      id="notes"
                                      rows="3"
                                      placeholder="Información adicional sobre el cliente..."
                                      class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">{{ old('notes') }}</textarea>
                            <p class="mt-2 text-sm text-gray-600">Campo opcional para información adicional.</p>
                        </div>

                        <!-- Marketing Preferences -->
                        <div class="mt-6">
                            <fieldset>
                                <legend class="text-base font-medium text-gray-900">Preferencias de comunicación</legend>
                                <div class="mt-4 space-y-4">
                                    <div class="flex items-start">
                                        <div class="flex items-center h-5">
                                            <input type="checkbox" 
                                                   name="email_notifications" 
                                                   id="email_notifications"
                                                   value="1"
                                                   {{ old('email_notifications') ? 'checked' : '' }}
                                                   class="focus:ring-blue-500 h-4 w-4 text-blue-600 border-gray-300 rounded">
                                        </div>
                                        <div class="ml-3 text-sm">
                                            <label for="email_notifications" class="font-medium text-gray-700">
                                                Notificaciones por correo
                                            </label>
                                            <p class="text-gray-500">Recibir ofertas y promociones por email.</p>
                                        </div>
                                    </div>
                                    
                                    <div class="flex items-start">
                                        <div class="flex items-center h-5">
                                            <input type="checkbox" 
                                                   name="sms_notifications" 
                                                   id="sms_notifications"
                                                   value="1"
                                                   {{ old('sms_notifications') ? 'checked' : '' }}
                                                   class="focus:ring-blue-500 h-4 w-4 text-blue-600 border-gray-300 rounded">
                                        </div>
                                        <div class="ml-3 text-sm">
                                            <label for="sms_notifications" class="font-medium text-gray-700">
                                                Notificaciones por SMS
                                            </label>
                                            <p class="text-gray-500">Recibir recordatorios y promociones por mensaje de texto.</p>
                                        </div>
                                    </div>
                                </div>
                            </fieldset>
                        </div>

                        <!-- Form Actions -->
                        <div class="mt-6 flex items-center justify-end space-x-4">
                            <a href="{{ route('customers.index') }}" 
                               class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded">
                                Cancelar
                            </a>
                            <button type="submit" 
                                    class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                Crear cliente
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Help Section -->
            <div class="mt-6 bg-blue-50 border border-blue-200 rounded-lg p-4">
                <div class="flex">
                    <div class="flex-shrink-0">
                        <svg class="h-5 w-5 text-blue-400" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path>
                        </svg>
                    </div>
                    <div class="ml-3">
                        <h3 class="text-sm font-medium text-blue-800">Consejos para registrar clientes</h3>
                        <div class="mt-2 text-sm text-blue-700">
                            <ul class="list-disc list-inside space-y-1">
                                <li>Asegúrese de que el correo electrónico sea único y válido.</li>
                                <li>Verifique que el número de teléfono esté completo y sea correcto.</li>
                                <li>Una dirección completa facilita las entregas y servicios.</li>
                                <li>Las notas adicionales pueden incluir preferencias del cliente o información relevante.</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>