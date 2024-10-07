<div class="py-12">
    <div class="mx-auto max-w-80% sm:px-6 lg:px-8">
        <div class="overflow-hidden shadow-md sm:rounded-lg">
            <div class="bg-white border-b border-gray-200 dark:bg-gray-300 dark:border-gray-600">
                <h1 class="text-2xl font-bold mb-4">Lista de Expedientes</h1>
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Doctor</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Especialidad</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Diagnóstico</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tratamiento</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Fecha de Registro</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Acciones</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200 dark:bg-gray-300 dark:divide-gray-600">
                        @foreach($expedientes as $expediente)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $expediente->doctor }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $expediente->especialidad }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $expediente->diagnostico }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $expediente->tratamiento }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $expediente->created_at }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <a href="{{ route('expedientes.show', $expediente->id) }}" class="text-blue-600 hover:text-blue-900">Ver</a>
                                    <a href="{{ route('expedientes.edit', $expediente->id) }}" class="text-yellow-600 hover:text-yellow-900">Editar</a>
                                    <form action="{{ route('expedientes.destroy', $expediente->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:text-red-900">Eliminar</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
