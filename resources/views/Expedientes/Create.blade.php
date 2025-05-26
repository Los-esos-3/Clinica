<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Añadir Expediente') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-md sm:rounded-lg">
                <div class="p-6">
                    <form method="POST" autocomplete="on" action="{{ route('Expedientes.store') }}">
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
                            <label for="fecha_registro" class="block text-sm font-medium text-gray-700">Fecha de Registro</label>
                            <input type="date" name="fecha_registro" id="fecha_registro" value="{{ now()->format('Y-m-d') }}" class="block w-full p-2 mt-1 border border-gray-400 rounded-md" required>
                        </div>

                        <div class="mb-4">
                            <label for="estado" class="block text-sm font-medium text-gray-700">Estado del Expediente</label>
                            <select name="estado" id="estado" required class="block w-full p-2 mt-1 border border-gray-400 rounded-md">
                                <option value="Activo">Activo</option>
                                <option value="Inactivo">Inactivo</option>
                            </select>
                        </div>

                        <div class="mb-4">
                            <label for="alergias" class="block text-sm font-medium text-gray-700">Alergias Conocidas</label>
                            <textarea name="alergias" id="alergias" class="block w-full p-2 mt-1 border border-gray-400 rounded-md"></textarea>
                        </div>

                        <div class="mb-4">
                            <label for="antecedentes_medicos" class="block text-sm font-medium text-gray-700">Antecedentes Médicos</label>
                            <textarea name="antecedentes_medicos" id="antecedentes_medicos" class="block w-full p-2 mt-1 border border-gray-400 rounded-md"></textarea>
                        </div>

                        <div class="mb-4">
                            <label for="historial_quirurgico" class="block text-sm font-medium text-gray-700">Historial Quirúrgico</label>
                            <textarea name="historial_quirurgico" id="historial_quirurgico" class="block w-full p-2 mt-1 border border-gray-400 rounded-md"></textarea>
                        </div>

                        <div class="mb-4">
                            <label for="historial_familiar" class="block text-sm font-medium text-gray-700">Historial Familiar Relevante</label>
                            <textarea name="historial_familiar" id="historial_familiar" class="block w-full p-2 mt-1 border border-gray-400 rounded-md"></textarea>
                        </div>

                        <div class="mb-4">
                            <label for="vacunas" class="block text-sm font-medium text-gray-700">Vacunas Aplicadas</label>
                            <textarea name="vacunas" id="vacunas" class="block w-full p-2 mt-1 border border-gray-400 rounded-md"></textarea>
                        </div>

                        <div class="mb-4">
                            <label for="medicamentos" class="block text-sm font-medium text-gray-700">Medicamentos Actuales</label>
                            <textarea name="medicamentos" id="medicamentos" class="block w-full p-2 mt-1 border border-gray-400 rounded-md"></textarea>
                        </div>

                        <div class="mb-4">
                            <label for="estudios_previos" class="block text-sm font-medium text-gray-700">Estudios o Exámenes Previos</label>
                            <textarea name="estudios_previos" id="estudios_previos" class="block w-full p-2 mt-1 border border-gray-400 rounded-md"></textarea>
                        </div>

                        <div class="mb-4">
                            <label for="notas_medicas" class="block text-sm font-medium text-gray-700">Notas Médicas</label>
                            <textarea name="notas_medicas" id="notas_medicas" class="block w-full p-2 mt-1 border border-gray-400 rounded-md"></textarea>
                        </div>

                        <div class="flex justify-end">
                            <button type="submit" class="inline-flex items-center px-4 py-2 text-xs font-semibold tracking-widest text-white uppercase transition bg-blue-500 border border-transparent rounded-md hover:bg-blue-600 active:bg-blue-700 focus:outline-none focus:border-blue-700 focus:ring focus:ring-blue-200 disabled:opacity-25">Guardar</button>
                            <a href="{{ route('Pacientes.PacientesView') }}" class="inline-flex items-center px-4 py-2 ml-2 text-xs font-semibold tracking-widest text-gray-700 uppercase transition bg-gray-200 border border-transparent rounded-md hover:bg-gray-300 active:bg-gray-400 focus:outline-none focus:border-gray-400 focus:ring focus:ring-gray-200 disabled:opacity-25">Cancelar</a>
                        </div>
                    </form>
                </div>  
            </div>
        </div>
    </div>
</x-app-layout>

<!-- CSS para validaciones -->
<style>
    .input-correct {
        border: 2px solid green !important; /* Borde verde para inputs correctos */
    }

    .input-error {
        border: 2px solid red !important; /* Borde rojo para inputs incorrectos */
    }
</style>

<!-- JavaScript para validaciones en tiempo real -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const inputs = document.querySelectorAll('input, textarea, select');

        // Función para verificar la validez del input
        const validateInput = function() {
            if (this.value.trim() === "") {
                this.classList.remove('input-correct', 'input-error');
            } else if (this.checkValidity()) {
                this.classList.remove('input-error');
                this.classList.add('input-correct');
            } else {
                this.classList.remove('input-correct');
                this.classList.add('input-error');
            }
        };

        inputs.forEach(input => {
            // Agregar el evento input
            input.addEventListener('input', validateInput);

            // Inicializa el estado del input
            validateInput.call(input);
        });
    });
</script>
