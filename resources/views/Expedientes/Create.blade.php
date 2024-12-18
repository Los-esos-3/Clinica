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
                        <input type="hidden" name="paciente_id" value="{{ $paciente->id }}">
                        <div class="mb-4">
                            <label for="paciente" class="block text-sm font-medium text-gray-700">Nombre del Paciente</label>
                            <input type="text" id="paciente" class="block w-full p-2 mt-1 border border-gray-400 rounded-md" value="{{ $paciente->nombre }}" readonly>
                        </div>
                        
                        <div class="mb-4">
                            <label for="doctor_id" class="block text-sm font-medium text-gray-700">Doctor</label>
                            <select name="doctor_id" id="doctor_id" class="block w-full p-2 mt-1 border border-gray-400 rounded-md focus:outline-none focus:ring-blue-500 focus:border-blue-500" required>
                                <option value="">Seleccione un doctor</option>
                                @foreach ($doctores as $doctor)
                                    <option value="{{ $doctor->id }}" {{ old('doctor_id') == $doctor->id ? 'selected' : '' }}>
                                        {{ $doctor->nombre_completo }} 
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        

                        <div class="mb-4">
                            <label for="diagnostico" class="block text-sm font-medium text-gray-700">Diagnóstico</label>
                            <textarea name="diagnostico" id="diagnostico" class="block w-full p-2 mt-1 border border-gray-400 rounded-md focus:outline-none focus:ring-blue-500 focus:border-blue-500"></textarea>
                        </div>

                        <div class="mb-4">
                            <label for="tratamiento" class="block text-sm font-medium text-gray-700">Tratamiento</label>
                            <textarea name="tratamiento" id="tratamiento" class="block w-full p-2 mt-1 border border-gray-400 rounded-md focus:outline-none focus:ring-blue-500 focus:border-blue-500"></textarea>
                        </div>

                        <div class="mb-4">
                            <label for="antecedentes" class="block text-sm font-medium text-gray-700">Antecedentes</label>
                            <textarea name="antecedentes" id="antecedentes" class="block w-full p-2 mt-1 border border-gray-400 rounded-md focus:outline-none focus:ring-blue-500 focus:border-blue-500"></textarea>
                        </div>

                        <div class="mb-4">
                            <label for="familiar_a_cargo" class="block text-sm font-medium text-gray-700">Familiar a cargo</label>
                            <input type="text" name="familiar_a_cargo" id="familiar_a_cargo" class="block w-full p-2 mt-1 border border-gray-400 rounded-md focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                        </div>

                        <div class="mb-4">
                            <label for="numero_familiar" class="block text-sm font-medium text-gray-700">Número del Familiar</label>
                            <input type="text" name="numero_familiar" id="numero_familiar" class="block w-full p-2 mt-1 border border-gray-400 rounded-md focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                        </div>

                        <div class="mb-4">
                            <label for="proxima_cita" class="block text-sm font-medium text-gray-700">Próxima Cita</label>
                            <input type="date" name="proxima_cita" id="proxima_cita" class="block w-full p-2 mt-1 border border-gray-400 rounded-md focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                        </div>

                        <div class="mb-4">
                            <label for="hora_proxima_cita" class="block text-sm font-medium text-gray-700">Hora de Próxima Cita</label>
                            <input type="time" name="hora_proxima_cita" id="hora_proxima_cita" class="block w-full p-2 mt-1 border border-gray-400 rounded-md focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                        </div>

                        <div class="mb-4">
                            <label for="fecha_registro" class="block text-sm font-medium text-gray-700">Fecha de Registro</label>
                            <input type="date" name="fecha_registro" id="fecha_registro" class="block w-full p-2 mt-1 border border-gray-400 rounded-md focus:outline-none focus:ring-blue-500 focus:border-blue-500" required>
                        </div>

                        <div class="flex justify-end">
                            <button type="submit" class="inline-flex items-center px-4 py-2 text-xs font-semibold tracking-widest text-white uppercase transition bg-blue-500 border border-transparent rounded-md hover:bg-blue-600 active:bg-blue-700 focus:outline-none focus:border-blue-700 focus:ring focus:ring-blue-200 disabled:opacity-25">Guardar Cambios</button>
                            <a href="{{ route('Pacientes.PacientesView') }}" class="inline-flex items-center px-4 py-2 ml-2 text-xs font-semibold tracking-widest text-gray-700 uppercase transition bg-gray-200 border border-transparent rounded-md hover:bg-gray-300 active:bg-gray-400 focus:outline-none focus:border-gray-400 focus:ring focus:ring-gray-200 disabled:opacity-25">Cancelar</a>
                        </div>
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