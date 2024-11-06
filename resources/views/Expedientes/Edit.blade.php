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
                    <form method="POST" action="{{ route('Expedientes.update', $expediente->id) }}">
                        @csrf
                        @method('PUT')

                        <div class="mb-4">
                            <label for="doctor_id" class="block text-sm font-medium text-gray-700">Doctor</label>
                            <select name="doctor_id" id="doctor_id" class="block w-full p-2 mt-1 border border-gray-400 rounded-md focus:outline-none focus:ring-blue-500 focus:border-blue-500" required>
                                <option value="">Seleccione un doctor</option>
                                @foreach ($doctores as $doctor)
                                    <option value="{{ $doctor->id }}" data-especialidad="{{ $doctor->especialidad }}" {{ $doctor->id == $expediente->doctor_id ? 'selected' : '' }}>
                                        {{ $doctor->nombre }} - {{ $doctor->especialidad }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-4">
                            <label for="especialidad" class="block text-sm font-medium text-gray-700">Especialidad</label>
                            <input type="text" name="especialidad" id="especialidad" value="{{ $expediente->especialidad_medica }}" class="block w-full p-2 mt-1 border border-gray-400 rounded-md focus:outline-none focus:ring-blue-500 focus:border-blue-500" readonly>
                        </div>

                        <div class="mb-4">
                            <label for="diagnostico" class="block text-sm font-medium text-gray-700">Diagnóstico</label>
                            <textarea name="diagnostico" id="diagnostico" class="block w-full p-2 mt-1 border border-gray-400 rounded-md focus:outline-none focus:ring-blue-500 focus:border-blue-500">{{ $expediente->diagnostico }}</textarea>
                        </div>

                        <div class="mb-4">
                            <label for="tratamiento" class="block text-sm font-medium text-gray-700">Tratamiento</label>
                            <textarea name="tratamiento" id="tratamiento" class="block w-full p-2 mt-1 border border-gray-400 rounded-md focus:outline-none focus:ring-blue-500 focus:border-blue-500">{{ $expediente->tratamiento }}</textarea>
                        </div>

                        <div class="mb-4">
                            <label for="antecedentes" class="block text-sm font-medium text-gray-700">Antecedentes</label>
                            <textarea name="antecedentes" id="antecedentes" class="block w-full p-2 mt-1 border border-gray-400 rounded-md focus:outline-none focus:ring-blue-500 focus:border-blue-500">{{ $expediente->antecedentes }}</textarea>
                        </div>

                        <div class="mb-4">
                            <label for="familiar" class="block text-sm font-medium text-gray-700">Familiar A cargo</label>
                            <input type="text" name="familiar" id="familiar" value="{{ $expediente->familiar }}" class="block w-full p-2 mt-1 border border-gray-400 rounded-md focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                        </div>

                        <div class="mb-4">
                            <label for="familiarnumero" class="block text-sm font-medium text-gray-700">Número del Familiar</label>
                            <input type="text" name="familiarnumero" id="familiarnumero" value="{{ $expediente->familiarnumero }}" class="block w-full p-2 mt-1 border border-gray-400 rounded-md focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                        </div>

                        <div class="mb-4">
                            <label for="proximacita" class="block text-sm font-medium text-gray-700">Próxima Cita</label>
                            <input type="date" name="proximacita" id="proximacita" value="{{ $expediente->proximacita }}" class="block w-full p-2 mt-1 border border-gray-400 rounded-md focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                        </div>

                        <div class="mb-4">
                            <label for="hora_proxima_cita" class="block text-sm font-medium text-gray-700">Hora de Próxima Cita</label>
                            <input type="time" name="hora_proxima_cita" id="hora_proxima_cita" 
                                   value="{{ old('hora_proxima_cita', $expediente->hora_proxima_cita) }}" 
                                   class="block w-full p-2 mt-1 border border-gray-400 rounded-md focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                            @if($expediente->hora_proxima_cita)
                                <p class="mt-1 text-sm text-gray-500">Hora actual: {{ $expediente->hora_proxima_cita_formateada }}</p>
                            @endif
                        </div>

                        <div class="flex justify-end">
                            <button type="submit" class="inline-flex items-center px-4 py-2 text-xs font-semibold tracking-widest text-white uppercase transition bg-blue-500 border border-transparent rounded-md hover:bg-blue-600 active:bg-blue-700 focus:outline-none focus:border-blue-700 focus:ring focus:ring-blue-200 disabled:opacity-25">Guardar Cambios</button>
                            <a href="{{ route('Expedientes.index') }}" class="inline-flex items-center px-4 py-2 ml-2 text-xs font-semibold tracking-widest text-gray-700 uppercase transition bg-gray-200 border border-transparent rounded-md hover:bg-gray-300 active:bg-gray-400 focus:outline-none focus:border-gray-400 focus:ring focus:ring-gray-200 disabled:opacity-25">Cancelar</a>
                        </div>
                    </form>
                </div>  
            </div>
        </div>
    </div>
</x-app-layout>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const doctorSelect = document.getElementById('doctor_id');
        const especialidadInput = document.getElementById('especialidad');

        // Rellenar el campo de especialidad al cargar la página
        const selectedOption = doctorSelect.options[doctorSelect.selectedIndex];
        const especialidad = selectedOption.getAttribute('data-especialidad');
        especialidadInput.value = especialidad; // Rellena el campo de especialidad

        doctorSelect.addEventListener('change', function() {
            const selectedOption = doctorSelect.options[doctorSelect.selectedIndex];
            const especialidad = selectedOption.getAttribute('data-especialidad');
            especialidadInput.value = especialidad; // Rellena el campo de especialidad
        });
    });
</script>
