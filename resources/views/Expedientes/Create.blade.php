<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Crear Expediente') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-md sm:rounded-lg">
                <div class="p-6">
                    <form method="POST" action="{{ route('Expedientes.store') }}">
                        @csrf
                        <div class="mb-4">
                            <label for="numero_expediente" class="block text-sm font-medium text-gray-700">Número de
                                Expediente</label>
                            <input type="text" name="numero_expediente" id="numero_expediente"
                                value="{{ $numero_expediente }}"
                                class="block w-full p-2 mt-1 border border-gray-400 rounded-md" readonly>
                        </div>

                        <input type="hidden" name="paciente_id" value="{{ $paciente->id }}">
                        <div class="mb-4">
                            <label for="paciente" class="block text-sm font-medium text-gray-700">Nombre del
                                Paciente</label>
                            <input type="text" id="paciente"
                                class="block w-full p-2 mt-1 border border-gray-400 rounded-md"
                                value="{{ $paciente->nombre }}" readonly>
                        </div>

                        <div class="mb-4">
                            <label for="fecha_registro" class="block text-sm font-medium text-gray-700">Fecha de Registro</label>
                            <input type="date" name="fecha_registro" id="fecha_registro" value="{{ now()->format('Y-m-d') }}" class="block w-full p-2 mt-1 border border-gray-400 rounded-md" required>
                        </div>


                        <div class="mb-4">
                            <label for="medico_id" class="block text-sm font-medium text-gray-700">Médico
                                Responsable
                            </label>

                            <select name="doctor_id" id="doctor_id"
                                class="block w-full p-2 mt-1 border border-gray-400 rounded-md" required>
                                <option value="">Seleccione un médico</option>
                                @foreach ($doctores as $doctor)
                                    <option value="{{ $doctor->id }}">{{ $doctor->nombre_completo }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-4">
                            <label for="estado" class="block text-sm font-medium text-gray-700">Estado del
                                Expediente</label>
                            <select name="estado" id="estado"
                                class="block w-full p-2 mt-1 border border-gray-400 rounded-md" required>
                                <option value="Activo">Activo</option>
                                <option value="Inactivo">Inactivo</option>
                            </select>
                        </div>

                        <div class="mb-4">
                            <label for="alergias" class="block text-sm font-medium text-gray-700">Alergias
                                Conocidas</label>
                            <textarea name="alergias" id="alergias" class="block w-full p-2 mt-1 border border-gray-400 rounded-md"></textarea>
                        </div>

                        <div class="mb-4">
                            <label for="antecedentes_medicos"
                                class="block text-sm font-medium text-gray-700">Antecedentes Médicos</label>
                            <textarea name="antecedentes_medicos" id="antecedentes_medicos"
                                class="block w-full p-2 mt-1 border border-gray-400 rounded-md"></textarea>
                        </div>

                        <div class="mb-4">
                            <label for="historial_quirurgico" class="block text-sm font-medium text-gray-700">Historial
                                Quirúrgico</label>
                            <textarea name="historial_quirurgico" id="historial_quirurgico"
                                class="block w-full p-2 mt-1 border border-gray-400 rounded-md"></textarea>
                        </div>

                        <div class="mb-4">
                            <label for="historial_familiar" class="block text-sm font-medium text-gray-700">Historial
                                Familiar Relevante</label>
                            <textarea name="historial_familiar" id="historial_familiar"
                                class="block w-full p-2 mt-1 border border-gray-400 rounded-md"></textarea>
                        </div>

                        <div class="mb-4">
                            <label for="vacunas" class="block text-sm font-medium text-gray-700">Vacunas
                                Aplicadas</label>
                            <textarea name="vacunas" id="vacunas" class="block w-full p-2 mt-1 border border-gray-400 rounded-md"></textarea>
                        </div>

                        <div class="mb-4">
                            <label for="medicamentos" class="block text-sm font-medium text-gray-700">Medicamentos
                                Actuales</label>
                            <textarea name="medicamentos" id="medicamentos" class="block w-full p-2 mt-1 border border-gray-400 rounded-md"></textarea>
                        </div>

                        <div class="mb-4">
                            <label for="estudios_previos" class="block text-sm font-medium text-gray-700">Estudios o
                                Exámenes Previos</label>
                            <textarea name="estudios_previos" id="estudios_previos" class="block w-full p-2 mt-1 border border-gray-400 rounded-md"></textarea>
                        </div>

                        <div class="mb-4">
                            <label for="notas_medicas" class="block text-sm font-medium text-gray-700">Notas
                                Médicas</label>
                            <textarea name="notas_medicas" id="notas_medicas" class="block w-full p-2 mt-1 border border-gray-400 rounded-md"></textarea>
                        </div>

                        <button type="submit"
                            class="px-4 py-2 font-bold text-white bg-blue-500 rounded hover:bg-blue-700">
                            Crear Expediente
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @if ($errors->any())
        <div class="mb-4">
            <ul class="text-red-600">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

</x-app-layout>


<script>
    document.addEventListener('DOMContentLoaded', function() {
        const fechaRegistroInput = document.getElementById('fecha_registro');

        // Establecer la fecha actual en el campo de fecha de registro
        const today = new Date().toISOString().split('T')[0]; // Obtener la fecha actual en formato YYYY-MM-DD
        fechaRegistroInput.value = today; // Asignar la fecha actual al campo
    });
</script>
