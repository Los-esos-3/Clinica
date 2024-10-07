<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Iniciar Sesión</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

    <!-- Styles -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">

    <style>
        /* Hacer el logo circular */
        .rounded-logo {
            border-radius: 50%;
            object-fit: cover;
        }
    </style>
</head>
<body class="bg-gray-100 flex items-center justify-center h-screen">
    <div class="w-full max-w-4xl mx-auto bg-white rounded-lg shadow-lg overflow-hidden">
        <div class="md:flex">
            <!-- Sección informativa -->
            <div class="w-full md:w-1/2 bg-blue-500 p-8 text-white flex flex-col justify-center">
                <h2 class="text-3xl font-bold text-center mb-4">¡Bienvenido de nuevo!</h2>
                <p class="text-center">Accede a tu cuenta para continuar disfrutando de nuestros servicios de salud desde la comodidad de tu hogar.</p>
                <hr class="my-4 border-white">
                <p class="text-center">Consulta nuestro <a href="#" class="underline">Aviso de Privacidad</a> para saber más sobre cómo protegemos tu información.</p>
            </div>

            <!-- Formulario de inicio de sesión -->
            <div class="w-full md:w-1/2 bg-white p-8 flex flex-col justify-center">
                <div class="flex justify-center mb-4">
                    <!-- Logo circular -->
                    <img src="{{ asset('images/KAIZEN (1).png') }}" alt="Kaizen Clínica de Salud Logo" class="h-20 w-20 rounded-logo">
                </div>
                <h2 class="text-2xl font-bold text-center mb-6">Iniciar Sesión</h2>

                <!-- Mostrar errores de validación -->
                <x-validation-errors class="mb-4" />

                @if (session('status'))
                    <div class="mb-4 font-medium text-sm text-green-600">
                        {{ session('status') }}
                    </div>
                @endif

                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <div class="mb-4">
                        <input type="email" id="email" name="email" placeholder="Correo electrónico" class="w-full px-4 py-2 text-gray-700 bg-gray-100 border rounded focus:outline-none focus:border-blue-500" required autofocus autocomplete="username">
                    </div>

                    <div class="mb-4">
                        <input type="password" id="password" name="password" placeholder="Contraseña" class="w-full px-4 py-2 text-gray-700 bg-gray-100 border rounded focus:outline-none focus:border-blue-500" required autocomplete="current-password">
                    </div>

                    <div class="flex items-center justify-between mb-4">
                        <label for="remember_me" class="flex items-center">
                            <input type="checkbox" id="remember_me" name="remember" class="mr-2">
                            <span class="text-sm text-gray-600">Recordarme</span>
                        </label>

                        @if (Route::has('password.request'))
                            <a href="{{ route('password.request') }}" class="text-sm text-blue-500 hover:underline">¿Olvidaste tu contraseña?</a>
                        @endif
                    </div>

                    <!-- Botones de Iniciar Sesión y Registrarse -->
                    <div class="flex items-center justify-between space-x-4">
                        <button type="submit" class="w-full py-3 text-white bg-blue-500 hover:bg-blue-600 rounded font-bold">Iniciar Sesión</button>
                        <a href="{{ route('register') }}" class="w-full py-3 text-center text-white bg-green-500 hover:bg-green-600 rounded font-bold">Registrarse</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>