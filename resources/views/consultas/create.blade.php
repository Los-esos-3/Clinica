<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Crear Consulta') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-md sm:rounded-lg">
                <div class="p-6">
                    <form method="POST" action="{{ route('consultas.store') }}">
                        @csrf

                        <input type="hidden" name="paciente_id" value="{{ $paciente->id }}">
                        <div class="mb-4">
                            <label for="paciente" class="block text-sm font-medium text-gray-700">Nombre del Paciente</label>
                            <input type="text" id="paciente" class="block w-full p-2 mt-1 border border-gray-400 rounded-md" value="{{ $paciente->nombre }}" readonly>
                        </div>

                        <div class="mb-4">
                            <label for="medico_id" class="block text-sm font-medium text-gray-700">Médico</label>
                            <select name="medico_id" id="medico_id" class="block w-full p-2 mt-1 border border-gray-400 rounded-md" required>
                                <option value="">Seleccione un médico</option>
                                @foreach ($medicos as $medico)
                                    <option value="{{ $medico->id }}">{{ $medico->nombre_completo }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-4">
                            <label for="fecha_hora" class="block text-sm font-medium text-gray-700">Fecha y Hora</label>
                            <input type="datetime-local" name="fecha_hora" id="fecha_hora" 
                                   class="block w-full p-2 mt-1 border border-gray-400 rounded-md" 
                                   value="{{ old('fecha_hora', now()->format('Y-m-d\TH:i')) }}" required>
                        </div>

                        <div class="mb-4">
                            <label for="motivo_consulta" class="block text-sm font-medium text-gray-700">Motivo de la Consulta</label>
                            <textarea name="motivo_consulta" id="motivo_consulta" class="block w-full p-2 mt-1 border border-gray-400 rounded-md" required></textarea>
                        </div>

                        <div class="mb-4">
                            <label for="diagnostico" class="block text-sm font-medium text-gray-700">Diagnóstico</label>
                            <textarea name="diagnostico" id="diagnostico" class="block w-full p-2 mt-1 border border-gray-400 rounded-md"></textarea>
                        </div>

                        <div class="mb-4">
                            <label for="tratamiento" class="block text-sm font-medium text-gray-700">Tratamiento</label>
                            <textarea name="tratamiento" id="tratamiento" class="block w-full p-2 mt-1 border border-gray-400 rounded-md"></textarea>
                        </div>

                        <div class="mb-4">
                            <label for="receta_medica" class="block text-sm font-medium text-gray-700">Receta Médica</label>
                            <textarea name="receta_medica" id="receta_medica" class="block w-full p-2 mt-1 border border-gray-400 rounded-md"></textarea>
                        </div>

                        <div class="mb-4">
                            <label for="indicaciones" class="block text-sm font-medium text-gray-700">Indicaciones</label>
                            <textarea name="indicaciones" id="indicaciones" class="block w-full p-2 mt-1 border border-gray-400 rounded-md"></textarea>
                        </div>

                        <div class="mb-4">
                            <label for="pruebas_solicitadas" class="block text-sm font-medium text-gray-700">Pruebas Solicitadas</label>
                            <textarea name="pruebas_solicitadas" id="pruebas_solicitadas" class="block w-full p-2 mt-1 border border-gray-400 rounded-md"></textarea>
                        </div>

                        <div class="mb-4">
                            <label for="notas_adicionales" class="block text-sm font-medium text-gray-700">Notas Adicionales</label>
                            <textarea name="notas_adicionales" id="notas_adicionales" class="block w-full p-2 mt-1 border border-gray-400 rounded-md"></textarea>
                        </div>

                        <div class="mb-4">
                            <label for="fecha_proxima_cita" class="block text-sm font-medium text-gray-700">Fecha de Próxima Cita</label>
                            <input type="date" name="fecha_proxima_cita" id="fecha_proxima_cita" class="block w-full p-2 mt-1 border border-gray-400 rounded-md">
                        </div>

                        <div class="mb-4">
                            <label for="estado" class="block text-sm font-medium text-gray-700">Estado</label>
                            <select name="estado" id="estado" class="block w-full p-2 mt-1 border border-gray-400 rounded-md" required>
                                <option value="Pendiente">Pendiente</option>
                                <option value="Completada">Completada</option>
                                <option value="Cancelada">Cancelada</option>
                            </select>
                        </div>

                        <div class="flex justify-end">
                            <button type="submit" class="inline-flex items-center px-4 py-2 text-xs font-semibold tracking-widest text-white uppercase transition bg-blue-500 border border-transparent rounded-md hover:bg-blue-600 active:bg-blue-700 focus:outline-none focus:border-blue-700 focus:ring focus:ring-blue-200 disabled:opacity-25">Guardar</button>
                            <a href="{{ route('consultas.index') }}" class="inline-flex items-center px-4 py-2 ml-2 text-xs font-semibold tracking-widest text-gray-700 uppercase transition bg-gray-200 border border-transparent rounded-md hover:bg-gray-300 active:bg-gray-400 focus:outline-none focus:border-gray-400 focus:ring focus:ring-gray-200 disabled:opacity-25">Cancelar</a>
                        
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
