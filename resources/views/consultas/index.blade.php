<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Lista de Consultas') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-md sm:rounded-lg">
                <div class="p-6">
                    <a href="{{ route('consultas.create') }}" class="inline-flex items-center px-4 py-2 mb-4 text-xs font-semibold tracking-widest text-white uppercase transition bg-blue-500 border border-transparent rounded-md hover:bg-blue-600 active:bg-blue-700 focus:outline-none focus:border-blue-700 focus:ring focus:ring-blue-200 disabled:opacity-25">
                        Crear Nueva Consulta
                    </a>

                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider">Médico</th>
                                <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider">Fecha y Hora</th>
                                <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider">Motivo</th>
                                <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider">Estado</th>
                                <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider">Acciones</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach ($consultas as $consulta)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $consulta->medico->nombre_completo }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $consulta->fecha_hora }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $consulta->motivo_consulta }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $consulta->estado }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <a href="{{ route('consultas.edit', $consulta->id) }}" class="text-blue-600 hover:text-blue-900">Editar</a>
                                        <form action="{{ route('consultas.destroy', $consulta->id) }}" method="POST" class="inline">
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
</x-app-layout>
