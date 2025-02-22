<x-app-layout>
    <x-slot name="header">
        <div class="flex">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Gestión de Roles y Usuarios') }}
            </h2>
            <ul>
                <li>
                    <a href="{{ route('dashboard') }}"
                        class="inline-block border-b-2 rounded-t-lg no-underline text-zinc-950">
                        INICIO
                    </a>
                </li>
            </ul>

        </div>

    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                @if (session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif

                <!-- Gestión de Roles -->
                <h3 class="text-lg font-semibold mb-4">Gestión de Roles</h3>
                @can('crear roles')
                    <a href="{{ route('roles.create') }}"  class="btn btn-primary mb-3">
                        Crear Nuevo Rol
                    </a>
                @endcan

                <table class="table mb-8">
                    <thead>
                        <tr>
                            <th>Rol</th>
                            <th>Permisos</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($roles as $role)
                            <tr>
                                <td>{{ $role->name }}</td>
                                <td>
                                    @foreach ($role->permissions as $permission)
                                        <span class="badge bg-primary">{{ $permission->name }}</span>
                                    @endforeach
                                </td>
                                <td>
                                    <a href="{{route('roles.edit' , $role->id) }}" class="btn btn-sm btn-warning">Editar</a>
                                    <form action="{{ route('roles.destroy', $role) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger"
                                            onclick="return confirm('¿Estás seguro?')">Eliminar</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <!-- Gestión de Usuarios y Asignación de Roles -->
                <h3 class="text-lg font-semibold mb-4">Gestión de Usuarios y Roles</h3>
                <table class="table">
                    <thead>
                        <tr>
                            <th>Nombre</th>
                            <th>Roles Actuales</th>
                            <th>Asignar Roles</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                            <tr>
                                <td>{{ $user->name }}</td>
                                <td>
                                    @foreach ($user->roles as $role)
                                        <span class="badge bg-info">{{ $role->name }}</span>
                                    @endforeach
                                </td>
                                <td>
                                    <a href="{{ route('roles.assign', $user->id) }}" class="btn btn-sm btn-primary">Asignar Roles</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>


    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</x-app-layout>
