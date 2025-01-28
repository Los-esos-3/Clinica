<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Editar Expediente') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-md sm:rounded-lg">
                <div class="p-6">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('Expedientes.update', $expediente->id) }}">
                        @csrf
                        @method('PUT')

                        <div class="mb-4">
                            <label for="numero_expediente" class="block text-sm font-medium text-gray-700">Número de Expediente</label>
                            <input type="text" name="numero_expediente" id="numero_expediente"
                                value="{{ old('numero_expediente', $expediente->numero_expediente) }}"
                                class="block w-full p-2 mt-1 border border-gray-400 rounded-md" readonly>
                        </div>

                        <input type="hidden" name="paciente_id" value="{{ $expediente->paciente_id }}">
                        <div class="mb-4">
                            <label for="paciente" class="block text-sm font-medium text-gray-700">Nombre del Paciente</label>
                            <input type="text" id="paciente"
                                class="block w-full p-2 mt-1 border border-gray-400 rounded-md"
                                value="{{ $expediente->paciente->nombre }}" readonly>
                        </div>

                        <div class="mb-4">
                            <label for="fecha_registro" class="block text-sm font-medium text-gray-700">Fecha de Registro</label>
                            <input type="date" name="fecha_registro" id="fecha_registro" value="{{ old('fecha_registro', $expediente->fecha_registro) }}" class="block w-full p-2 mt-1 border border-gray-400 rounded-md" required>
                        </div>

                        <div class="mb-4">
                            <label for="estado" class="block text-sm font-medium text-gray-700">Estado del Expediente</label>
                            <select name="estado" id="estado"
                                class="block w-full p-2 mt-1 border border-gray-400 rounded-md" required>
                                <option value="Activo" {{ $expediente->estado == 'Activo' ? 'selected' : '' }}>Activo</option>
                                <option value="Inactivo" {{ $expediente->estado == 'Inactivo' ? 'selected' : '' }}>Inactivo</option>
                            </select>
                        </div>

                        <div class="mb-4">
                            <label for="alergias" class="block text-sm font-medium text-gray-700">Alergias Conocidas</label>
                            <textarea name="alergias" id="alergias" class="block w-full p-2 mt-1 border border-gray-400 rounded-md">{{ old('alergias', $expediente->alergias) }}</textarea>
                        </div>

                        <div class="mb-4">
                            <label for="antecedentes_medicos" class="block text-sm font-medium text-gray-700">Antecedentes Médicos</label>
                            <textarea name="antecedentes_medicos" id="antecedentes_medicos" class="block w-full p-2 mt-1 border border-gray-400 rounded-md">{{ old('antecedentes_medicos', $expediente->antecedentes_medicos) }}</textarea>
                        </div>

                        <div class="mb-4">
                            <label for="historial_quirurgico" class="block text-sm font-medium text-gray-700">Historial Quirúrgico</label>
                            <textarea name="historial_quirurgico" id="historial_quirurgico" class="block w-full p-2 mt-1 border border-gray-400 rounded-md">{{ old('historial_quirurgico', $expediente->historial_quirurgico) }}</textarea>
                        </div>

                        <div class="mb-4">
                            <label for="historial_familiar" class="block text-sm font-medium text-gray-700">Historial Familiar Relevante</label>
                            <textarea name="historial_familiar" id="historial_familiar" class="block w-full p-2 mt-1 border border-gray-400 rounded-md">{{ old('historial_familiar', $expediente->historial_familiar) }}</textarea>
                        </div>

                        <div class="mb-4">
                            <label for="vacunas" class="block text-sm font-medium text-gray-700">Vacunas Aplicadas</label>
                            <textarea name="vacunas" id="vacunas" class="block w-full p-2 mt-1 border border-gray-400 rounded-md">{{ old('vacunas', $expediente->vacunas) }}</textarea>
                        </div>

                        <div class="mb-4">
                            <label for="medicamentos" class="block text-sm font-medium text-gray-700">Medicamentos Actuales</label>
                            <textarea name="medicamentos" id="medicamentos" class="block w-full p-2 mt-1 border border-gray-400 rounded-md">{{ old('medicamentos', $expediente->medicamentos) }}</textarea>
                        </div>

                        <div class="mb-4">
                            <label for="estudios_previos" class="block text-sm font-medium text-gray-700">Estudios o Exámenes Previos</label>
                            <textarea name="estudios_previos" id="estudios_previos" class="block w-full p-2 mt-1 border border-gray-400 rounded-md">{{ old('estudios_previos', $expediente->estudios_previos) }}</textarea>
                        </div>

                        <div class="mb-4">
                            <label for="notas_medicas" class="block text-sm font-medium text-gray-700">Notas Médicas</label>
                            <textarea name="notas_medicas" id="notas_medicas" class="block w-full p-2 mt-1 border border-gray-400 rounded-md">{{ old('notas_medicas', $expediente->notas_medicas) }}</textarea>
                        </div>

                        <button type="submit" class="px-4 py-2 font-bold text-white bg-blue-500 rounded hover:bg-blue-700">
                            Guardar Cambios
                        </button>

                        <a href="{{ route('Pacientes.PacientesView') }}" class="inline-flex items-center px-4 py-2 ml-2 text-xs font-semibold tracking-widest text-gray-700 uppercase transition bg-gray-200 border border-transparent rounded-md hover:bg-gray-300 active:bg-gray-400 focus:outline-none focus:border-gray-400 focus:ring focus:ring-gray-200 disabled:opacity-25">Cancelar</a>

                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

<script>
   document.getElementById('doctor_id').addEventListener('change', function () {
    const selectedOption = this.options[this.selectedIndex];
    const especialidad = selectedOption.getAttribute('data-especialidad');
    document.getElementById('especialidad').value = especialidad || '';
});

</script>
