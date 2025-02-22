<div class="max-w-lg mx-auto bg-white p-6 rounded-lg shadow-md">
    <h2 class="text-lg font-semibold text-gray-800 mb-4">Editar Rol: {{ $role->name }}</h2>

    <form action="{{ route('roles.update', $role) }}" method="POST">
        @csrf
        @method('PUT')

        <!-- Nombre del Rol -->
        <div class="mb-4">
            <label for="name" class="block text-sm font-medium text-gray-700">Nombre del Rol</label>
            <input type="text" id="name" name="name" value="{{ $role->name }}" required
                class="w-full px-3 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
        </div>

        <!-- Permisos -->
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
        <div class="flex justify-end space-x-2">
            <a href="{{ route('roles.index') }}" 
                class="px-4 py-2 bg-gray-300 text-gray-700 rounded-lg hover:bg-gray-400">
                Cancelar
            </a>
            <button type="submit"
                class="px-4 py-2 bg-blue-500 text-white rounded-lg shadow-md hover:bg-blue-600">
                Actualizar
            </button>
        </div>
    </form>
</div>
