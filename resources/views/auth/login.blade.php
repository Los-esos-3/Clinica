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
<body class="flex items-center justify-center h-screen bg-gray-100">
    <div class="w-full max-w-4xl mx-auto overflow-hidden bg-white rounded-lg shadow-lg">
        <div class="flex items-center justify-between mb-4">
            <!-- X para cerrar -->
            <a href="{{ route('welcome') }}" class="text-lg text-gray-600 hover:text-gray-900">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" width="24" height="24" class="inline-block">
                    <path d="M177.5 414c-8.8 3.8-19 2-26-4.6l-144-136C2.7 268.9 0 262.6 0 256s2.7-12.9 7.5-17.4l144-136c7-6.6 17.2-8.4 26-4.6s14.5 12.5 14.5 22l0 72 288 0c17.7 0 32 14.3 32 32l0 64c0 17.7-14.3 32-32 32l-288 0 0 72c0 9.6-5.7 18.2-14.5 22z"/>
                </svg>
            </a>

        </div>
        <div class="md:flex">
            <!-- Sección informativa -->
            <div class="flex flex-col justify-center w-full p-8 text-white bg-blue-500 md:w-1/2">
                <h2 class="mb-4 text-3xl font-bold text-center">¡Bienvenido de nuevo!</h2>
                <p class="text-center">Accede a tu cuenta para continuar disfrutando de nuestros servicios de salud desde la comodidad de tu hogar.</p>
                <hr class="my-4 border-white">
                <p class="text-center">Consulta nuestro <a href="#" class="underline">Aviso de Privacidad</a> para saber más sobre cómo protegemos tu información.</p>
            </div>

            <!-- Formulario de inicio de sesión -->
            <div class="flex flex-col justify-center w-full p-8 bg-white md:w-1/2">
                <div class="flex justify-center mb-4">
                    <!-- Logo circular -->
                    <img src="{{ asset('images/KAIZEN.png  ') }}" alt="Kaizen Clínica de Salud Logo" class="w-20 h-20 rounded-logo">
                </div>
                <h2 class="mb-6 text-2xl font-bold text-center">Iniciar Sesión</h2>

                <!-- Mostrar errores de validación -->
                <x-validation-errors class="mb-4" />

                @if (session('status'))
                    <div class="mb-4 text-sm font-medium text-green-600">
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
                        <a href="{{ route('register') }}" class="w-full py-3 font-bold text-center text-white bg-green-500 rounded hover:bg-green-600">Registrarse</a>
                        <button type="submit" class="w-full py-3 font-bold text-white bg-blue-500 rounded hover:bg-blue-600">Iniciar Sesión</button>

                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>