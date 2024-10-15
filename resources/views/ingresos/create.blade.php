<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agregar Ingreso</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">
    <div class="max-w-3xl px-6 py-12 mx-auto">
        <h1 class="mb-6 text-2xl font-bold text-gray-800">Agregar Ingreso</h1>

        @if ($errors->any())
            <div class="p-4 mb-4 text-red-700 bg-red-100 border border-red-400 rounded">
                <strong>¡Algo salió mal!</strong>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('ingresos.store') }}" method="POST" class="p-8 bg-white rounded-lg shadow-md">
            @csrf
            <div class="mb-4">
                <label for="departamento" class="block text-sm font-medium text-gray-700">Departamento:</label>
                <input type="text" name="departamento" id="departamento" required class="block w-full p-2 mt-1 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-blue-200" placeholder="Ingrese el nombre del departamento">
            </div>

            <div class="mb-4">
                <label for="paciente_id" class="block text-sm font-medium text-gray-700">Paciente:</label>
                <input type="numb" class="block w-full p-2 mt-1 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-blue-200">
            </div>

            <div class="mb-4">
                <label for="total" class="block text-sm font-medium text-gray-700">Total:</label>
                <input type="number" name="total" id="total" step="0.01" min="0" required class="block w-full p-2 mt-1 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-blue-200" placeholder="Ingrese el total">
            </div>

            <div class="flex justify-end">
                <button type="submit" class="inline-flex items-center px-4 py-2 text-sm font-semibold tracking-widest text-white uppercase transition bg-blue-500 border border-transparent rounded-md hover:bg-blue-600 focus:outline-none focus:border-blue-700 focus:ring focus:ring-blue-200 disabled:opacity-25">Guardar Ingreso</button>
            </div>
            <div class="mt-6 text-center">
                <a href="{{ route('ingresos.index') }}" class="text-sm text-blue-500 ">Regresar</a>
            </div>
        </form>
    </div>
</body>
</html>