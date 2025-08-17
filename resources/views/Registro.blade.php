<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro y Login - Tienda de Mascotas</title>
    <!-- Incluye el CDN de Tailwind CSS para un diseño moderno y rápido -->
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
      body {
        font-family: 'Inter', sans-serif;
      }
    </style>
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen p-4">

    <!-- Contenedor principal del formulario -->
    <div class="bg-white p-8 rounded-xl shadow-lg w-full max-w-md">
        
        <!-- Contenedor del formulario de registro (visible por defecto) -->
        <div id="register-form">
            <div class="text-center mb-6">
                <h2 class="text-3xl font-bold text-gray-800">Crea tu cuenta</h2>
                <p class="mt-2 text-gray-500">Únete a nuestra comunidad de amantes de las mascotas.</p>
            </div>
            <form action="#" method="post" class="space-y-4">
                <div>
                    <label for="reg-name" class="block text-sm font-medium text-gray-700 mb-1">Nombre completo</label>
                    <input type="text" id="reg-name" name="name" placeholder="Ej. Juan Pérez"
                           class="mt-1 block w-full px-4 py-2 bg-gray-50 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-green-500 focus:border-green-500 transition duration-150 ease-in-out" required>
                </div>
                <div>
                    <label for="reg-email" class="block text-sm font-medium text-gray-700 mb-1">Correo electrónico</label>
                    <input type="email" id="reg-email" name="email" placeholder="ejemplo@correo.com"
                           class="mt-1 block w-full px-4 py-2 bg-gray-50 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-green-500 focus:border-green-500 transition duration-150 ease-in-out" required>
                </div>
                <div>
                    <label for="reg-password" class="block text-sm font-medium text-gray-700 mb-1">Contraseña</label>
                    <input type="password" id="reg-password" name="password" placeholder="Crea tu contraseña"
                           class="mt-1 block w-full px-4 py-2 bg-gray-50 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-green-500 focus:border-green-500 transition duration-150 ease-in-out" required>
                </div>
                <div>
                    <label for="reg-confirm-password" class="block text-sm font-medium text-gray-700 mb-1">Confirmar contraseña</label>
                    <input type="password" id="reg-confirm-password" name="confirm-password" placeholder="Repite tu contraseña"
                           class="mt-1 block w-full px-4 py-2 bg-gray-50 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-green-500 focus:border-green-500 transition duration-150 ease-in-out" required>
                </div>
                <button type="submit"
                        class="w-full py-2 px-4 border border-transparent rounded-lg shadow-sm text-lg font-semibold text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 transition duration-150 ease-in-out">
                    Registrarse
                </button>
            </form>
            <p class="mt-4 text-center text-sm text-gray-600">
                ¿Ya tienes una cuenta?
                <a href="#" id="show-login" class="font-medium text-green-600 hover:text-green-500">Inicia sesión aquí</a>
            </p>
        </div>

        <!-- Contenedor del formulario de inicio de sesión (oculto por defecto) -->
        <div id="login-form" class="hidden">
            <div class="text-center mb-6">
                <h2 class="text-3xl font-bold text-gray-800">Inicia sesión</h2>
                <p class="mt-2 text-gray-500">Bienvenido de nuevo a nuestra comunidad.</p>
            </div>
            <form action="#" method="post" class="space-y-4">
                <div>
                    <label for="log-email" class="block text-sm font-medium text-gray-700 mb-1">Correo electrónico</label>
                    <input type="email" id="log-email" name="email" placeholder="ejemplo@correo.com"
                           class="mt-1 block w-full px-4 py-2 bg-gray-50 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-green-500 focus:border-green-500 transition duration-150 ease-in-out" required>
                </div>
                <div>
                    <label for="log-password" class="block text-sm font-medium text-gray-700 mb-1">Contraseña</label>
                    <input type="password" id="log-password" name="password" placeholder="Ingresa tu contraseña"
                           class="mt-1 block w-full px-4 py-2 bg-gray-50 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-green-500 focus:border-green-500 transition duration-150 ease-in-out" required>
                </div>
                <button type="submit"
                        class="w-full py-2 px-4 border border-transparent rounded-lg shadow-sm text-lg font-semibold text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 transition duration-150 ease-in-out">
                    Iniciar sesión
                </button>
            </form>
            <p class="mt-4 text-center text-sm text-gray-600">
                ¿Aún no tienes una cuenta?
                <a href="#" id="show-register" class="font-medium text-green-600 hover:text-green-500">Regístrate aquí</a>
            </p>
        </div>
    </div>

    <!-- Script de JavaScript para la funcionalidad de cambio de formulario -->
    <script>
        document.getElementById('show-login').addEventListener('click', function(e) {
            e.preventDefault(); // Previene el comportamiento por defecto del enlace
            document.getElementById('register-form').classList.add('hidden');
            document.getElementById('login-form').classList.remove('hidden');
        });

        document.getElementById('show-register').addEventListener('click', function(e) {
            e.preventDefault(); // Previene el comportamiento por defecto del enlace
            document.getElementById('login-form').classList.add('hidden');
            document.getElementById('register-form').classList.remove('hidden');
        });
    </script>

</body>
</html>


