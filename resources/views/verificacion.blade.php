<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Verificación de Cuenta</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 flex items-center justify-center h-screen">
    <div class="bg-white shadow-lg rounded-xl p-8 w-full max-w-md">
        <h2 class="text-2xl font-bold text-center text-gray-800 mb-4">Verifica tu Cuenta</h2>
        @if ($errors->any())
            <div class="text-red-500 text-sm mb-4">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li class="text-center">{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <p class="text-center text-gray-600 mb-6">
            Hemos enviado un código a tu correo electrónico. Ingresa el código a continuación para verificar tu cuenta.
        </p>

        <form action="{{ route('verificar.codigo') }}" method="POST" class="space-y-4">
            @csrf
            <div>
                <label for="codigo" class="block text-sm font-medium text-gray-700">Código de verificación</label>
                <input type="text" name="codigo" id="codigo" maxlength="6" required
                    class="mt-1 w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>

            <button type="submit"
                class="w-full bg-blue-600 text-white py-2 rounded-lg hover:bg-blue-700 transition duration-300">
                Verificar Código
            </button>
        </form>

        <div class="text-center mt-6 text-sm text-gray-600">
            ¿No recibiste el código?
            <form method="POST" action="{{ route('enviar.codigo') }}">
                @csrf
                <button type="submit" class="text-blue-600 hover:underline">Reenviar</button>
            </form>

        </div>
    </div>

</body>

</html>
