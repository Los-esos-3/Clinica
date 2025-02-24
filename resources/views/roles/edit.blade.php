<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Rol</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 flex items-center justify-center min-h-screen">

    <div class="bg-white p-6 rounded-lg shadow-lg w-full max-w-3xl">
        <h2 class="text-2xl font-bold mb-4">Editar Rol: <span class="text-gray-700">Secretaria</span></h2>

        <form action="{{ route('roles.update', $role) }}" method="POST">
            @csrf
            @method('PUT')

            <!-- Campo de nombre -->
            <div class="mb-4">
                <label for="name" class="block text-lg font-semibold">Nombre del Rol</label>
                <input type="text" id="name" name="name" value="Secretaria"
                    class="w-full p-2 border border-gray-300 rounded-lg">
            </div>


            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">Permisos</label>
                <div class="grid grid-cols-2 gap-2">
                    @foreach ($permissions as $permission)
                        <label class="flex items-center space-x-2">
                            <input type="checkbox" name="permissions[]" value="{{ $permission->name }}"
                                id="permission{{ $permission->id }}_{{ $role->id }}"
                                {{ $role->hasPermissionTo($permission->name) ? 'checked' : '' }}
                                class="text-blue-600 rounded focus:ring-2 focus:ring-blue-500">
                            <span class="text-gray-700">{{ $permission->name }}</span>
                        </label>
                    @endforeach
                </div>
            </div>

            <!-- Botones -->
            <div class="flex justify-between mt-6">
                <a href="{{ route('roles.index') }}"
                    class="px-4 py-2 bg-gray-300 text-gray-700 rounded-lg hover:bg-gray-400">
                    Cancelar
                </a>
                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-lg">Actualizar</button>
            </div>

        </form>
    </div>

</body>

</html>
