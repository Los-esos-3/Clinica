<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Añadir Paciente') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-md sm:rounded-lg">
                <div class="p-6">
                    <form method="POST" action="{{ route('Pacientes.store') }}">
                        @csrf

                        <div class="mb-4">
                            <label for="nombre" class="block text-sm font-medium text-gray-700">Nombre</label>
                            <input type="text" name="nombre" id="nombre" class="block w-full p-2 mt-1 border border-gray-400 rounded-md focus:outline-none focus:ring-blue-500 focus:border-blue-500" required>
                        </div>

                        <div class="mb-4">
                            <label for="telefono" class="block text-sm font-medium text-gray-700">Teléfono</label>
                            <input type="text" name="telefono" id="telefono" class="block w-full p-2 mt-1 border border-gray-400 rounded-md focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                        </div>

                        <div class="mb-4">
                            <label for="fecha_nacimiento" class="block text-sm font-medium text-gray-700">Fecha de Nacimiento</label>
                            <input type="date" name="fecha_nacimiento" id="fecha_nacimiento" class="block w-full p-2 mt-1 border border-gray-400 rounded-md focus:outline-none focus:ring-blue-500 focus:border-blue-500" required>
                        </div>

                        <div class="mb-4">
                            <label for="edad" class="block text-sm font-medium text-gray-700">Edad</label>
                            <input type="number" name="edad" id="edad" class="block w-full p-2 mt-1 border border-gray-400 rounded-md focus:outline-none focus:ring-blue-500 focus:border-blue-500" readonly>
                        </div>

                        <div class="mb-4">
                            <label for="direccion" class="block text-sm font-medium text-gray-700">Dirección</label>
                            <input type="text" name="direccion" id="direccion" class="block w-full p-2 mt-1 border border-gray-400 rounded-md focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                        </div>

                        <div class="mb-4">
                            <label for="genero" class="block text-sm font-medium text-gray-700">Género</label>
                            <select name="genero" id="genero" class="block w-full p-2 mt-1 border border-gray-400 rounded-md focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                                <option value="">Seleccione</option>
                                <option value="masculino">Masculino</option>
                                <option value="femenino">Femenino</option>
                                <option value="otro">Otro</option>
                            </select>
                        </div>

                        <div class="mb-4">
                            <label for="estado_civil" class="block text-sm font-medium text-gray-700">Estado Civil</label>
                            <select name="estado_civil" id="estado_civil" class="block w-full p-2 mt-1 border border-gray-400 rounded-md focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                                <option value="">Seleccione</option>
                                <option value="soltero">Soltero</option>
                                <option value="casado">Casado</option>
                                <option value="divorciado">Divorciado</option>
                                <option value="viudo">Viudo</option>
                            </select>
                        </div>

                        <div class="mb-4">
                            <label for="tipo_sangre" class="block text-sm font-medium text-gray-700">Tipo de Sangre</label>
                            <select type="text" name="tipo_sangre" id="tipo_sangre" class="block w-full p-2 mt-1 border border-gray-400 rounded-md focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                                <option value="">Seleccione</option>
                                <option value="A+">A+</option>
                                <option value="A-">A-</option>
                                <option value="B+">B+</option>
                                <option value="B-">B-</option>
                                <option value="AB+">AB+</option>
                                <option value="AB-">AB-</option>
                                <option value="O+">O+</option>
                                <option value="O-">O-</option>
                            </select>
                        </div>

                        <div class="mb-4">
                            <label for="ocupacion" class="block text-sm font-medium text-gray-700">Ocupación</label>
                            <input type="text" name="ocupacion" id="ocupacion" class="block w-full p-2 mt-1 border border-gray-400 rounded-md focus:outline-none focus:ring-blue-500 focus:border-blue-500">
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

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const fechaNacimientoInput = document.getElementById('fecha_nacimiento');
        const edadInput = document.getElementById('edad');

        fechaNacimientoInput.addEventListener('change', function() {
            const fechaNacimiento = new Date(this.value);
            const today = new Date();
            let edad = today.getFullYear() - fechaNacimiento.getFullYear();
            const mesDiff = today.getMonth() - fechaNacimiento.getMonth();
            if (mesDiff < 0 || (mesDiff === 0 && today.getDate() < fechaNacimiento.getDate())) {
                edad--;
            }
            edadInput.value = edad;
        });
    });
</script>