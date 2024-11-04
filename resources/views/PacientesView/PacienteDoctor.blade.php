<x-app-layout>
    <style>
        /* ... (estilos existentes) ... */
        
        /* Estilos para la navegación */
        .nav {
            background-color: rgb(55, 65, 81,1) !important;
            color: white;
            padding: 1rem;
            display: block;
        }
        .nav-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            max-width: 1200px;
            margin: 0 auto;
        }
        .nav-links {
            display: flex;
            gap: 1rem;
        }
        .nav-links a {
            color: white;
            text-decoration: none;
            font-size: 1.1rem;
        }
        .nav-links a:hover {
            text-decoration: underline;
        }
        .dropdown {
            position: relative;
            display: inline-block;
        }
        .dropbtn {
            background-color: rgb(173, 173, 173);
            color: white;
            padding: 10px;
            font-size: 16px;
            border: none;
            cursor: pointer;
        }
        .dropdown-content {
            display: none;
            position: absolute;
            background-color: #f9f9f9;
            min-width: 160px;
            box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
            z-index: 1;
        }
        .dropdown-content a {
            color: black;
            padding: 12px 16px;
            text-decoration: none;
            display: block;
        }
        .dropdown-content a:hover {
            background-color: #f1f1f1;
        }
        .dropdown:hover .dropdown-content {
            display: block;
        }
    </style>
    <nav class="nav">
        <div class="nav-container">
            <div>
                @include('components.application-logo')
            </div>
            <div class="nav-links">
                <a href="{{ route('dashboard') }}">Calendario</a>
                <a href="{{ route('Pacientes') }}">Visitas</a>
                <a href="{{ route('ingresos.index') }}">Ingresos</a>
            </div>
            <div class="dropdown">
                <button class="dropbtn">{{ Auth::user()->name }}</button>
                <div class="dropdown-content">
                    <a href="{{ route('profile.show') }}">Perfil</a>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <a href="{{ route('logout') }}" onclick="event.preventDefault(); this.closest('form').submit();">Cerrar Sesión</a>
                    </form>
                </div>
            </div>
        </div>
    </nav>
    <div class="flex items-center justify-between bg-gray-300 p-8 mb-4 border">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Pacientes') }}
        </h2>
        
        <form {{-- action="{{ route('Expedientes.index') }}" method="GET" --}}  class="flex items-center mb-4">
            <input type="text" name="search" placeholder="Buscar Paciente..." class="border rounded-l px-4 py-2" style="width: 300px;">
            <button type="submit" class="bg-blue-500 text-white rounded-r px-4 py-2">Buscar</button>
        </form>

        <a href="{{route('Pacientes.create')}}" class="px-4 py-2 font-bold text-white bg-blue-500 rounded hover:bg-blue-700">
            <button>
            Agregar Paciente
        </button>
    </a>
    </div>
    <!-- Vista Crud de pacientes -->
    <div class="py-12">
        <div class="mx-auto max-w-80% sm:px-6 lg:px-8">
            <div class="overflow-hidden shadow-md sm:rounded-lg">
                <div class="bg-white border-b border-gray-200 dark:bg-gray-300 dark:border-gray-600">
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50 dark:bg-gray-400">
                                <tr>
                                    <th class="px-6 py-3 text-xs font-medium tracking-wider text-center text-gray-500 uppercase dark:text-gray-800 border-b-2 border-gray-300">Datos del Paciente</th>
                                    <th class="px-6 py-3 text-xs font-medium tracking-wider text-center text-gray-500 uppercase dark:text-gray-800 border-b-2 border-gray-300">Expediente</th>
                                    <th class="px-6 py-3 text-xs font-medium tracking-wider text-center text-gray-500 uppercase dark:text-gray-800 border-b-2 border-gray-300">Acciones</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200 dark:bg-gray-300 dark:divide-gray-600">
                                @foreach ($pacientes as $paciente)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap border-b-2 border-r-2 border-gray-300">
                                            <p><strong>Nombre:</strong> {{ $paciente->nombre }}</p>
                                            <p><strong>Teléfono:</strong> {{ $paciente->telefono }}</p>
                                            <p><strong>Fecha de Nacimiento:</strong> {{ $paciente->fecha_nacimiento }}</p>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap border-b-2 border-r-2 border-gray-300">
                                            @if($paciente->expediente)
                                                <p><strong>Doctor:</strong> {{ $paciente->expediente->doctor }}</p>
                                                <p><strong>Diagnóstico:</strong> {{ $paciente->expediente->diagnostico }}</p>
                                            @else
                                                <p class="text-red-500">No hay expediente disponible.</p>
                                                <a href="{{ route('Expedientes.create', ['paciente_id' => $paciente->id]) }}" class="inline-block mt-4 px-4 py-2 font-bold text-white bg-blue-500 rounded hover:bg-blue-700">
                                                    Agregar uno
                                                </a>
                                            @endif
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap border-b-2 border-gray-300">
                                            <div class="flex gap-2">
                                                <div class="flex gap-2">
                                                    <x-action-buttons 
                                                    :editRoute="route('Pacientes.edit', $paciente->id)" 
                                                    :deleteRoute="route('Pacientes.destroy', $paciente->id)" 
                                                />
                                                </div>
                                                <button class="px-4 py-2 text-sm font-bold text-white bg-blue-500 rounded hover:bg-blue-700" onclick="toggleModal('modal-id-{{ $paciente->id }}')">Ver Más</button>
                                            </div>
                                        </td>
                                    </tr>

                                    <!-- Modal para cada paciente -->
                                    <div id="modal-id-{{ $paciente->id }}" class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50 hidden">
                                        <div class="w-3/4 max-w-2xl bg-white rounded-lg shadow-lg">
                                            <div class="flex p-4">
                                                <!-- Sección de datos del paciente -->
                                                <div class="w-1/2 pr-2 border-r">
                                                    <h2 class="text-xl font-bold mb-4">Datos del Paciente</h2>
                                                    <p><strong>Nombre:</strong> {{ $paciente->nombre }}</p>
                                                    <p><strong>Teléfono:</strong> {{ $paciente->telefono }}</p>
                                                    <p><strong>Fecha de Nacimiento:</strong> {{ $paciente->fecha_nacimiento }}</p>
                                                    <p><strong>Edad:</strong> {{ $paciente->edad }}</p>
                                                    <p><strong>Dirección:</strong> {{ $paciente->direccion }}</p>
                                                    <p><strong>Género:</strong> {{ $paciente->genero }}</p>
                                                    <p><strong>Estado Civil:</strong> {{ $paciente->estado_civil }}</p>
                                                    <p><strong>Tipo de sangre:</strong> {{ $paciente->tipo_sangre }}</p>
                                                    <p><strong>ocupacion:</strong> {{ $paciente->ocupacion }}</p>

                                                </div>

                                                <!-- Sección de expediente -->
                                                <div class="w-1/2 pl-2">
                                                    <h2 class="text-xl font-bold mb-4">Expediente de {{ $paciente->nombre }}</h2>
                                                    @if($paciente->expediente)
                                                        <p><strong>Doctor:</strong> {{ $paciente->expediente->doctor }}</p>
                                                        <p><strong>Especialidad:</strong> {{ $paciente->expediente->especialidad }}</p>
                                                        <p><strong>Diagnóstico:</strong> {{ $paciente->expediente->diagnostico }}</p>
                                                        <p><strong>Tratamiento:</strong> {{ $paciente->expediente->tratamiento }}</p>
                                                        <p><strong>Antecedentes:</strong> {{ $paciente->expediente->antecedentes }}</p>
                                                        <p><strong>Familiar a cargo:</strong> {{ $paciente->expediente->familiar_a_cargo }}</p>
                                                        <p><strong>Número de familiar:</strong> {{ $paciente->expediente->numero_familiar }}</p>
                                                        <p><strong>Próxima cita:</strong> {{ $paciente->expediente->proxima_cita }}</p>
                                                        <p><strong>Hora de la próxima cita:</strong> {{ $paciente->expediente->hora_proxima_cita }}</p>
                                                        <p><strong>Fecha de registro:</strong> {{ $paciente->expediente->fecha_registro }}</p>
                                                        <p><strong>Familiar a Cargo:</strong> {{ $paciente->expediente->familiar_a_cargo }}</p>
                                                        <p><strong>Número Familiar:</strong> {{ $paciente->expediente->numero_familiar }}</p>
                                                        <p><strong>Próxima Cita:</strong> {{ $paciente->expediente->proxima_cita }}</p>
                                                        <p><strong>Hora Próxima Cita:</strong> {{ $paciente->expediente->hora_proxima_cita }}</p>
                                                        <p><strong>Fecha de Registro:</strong> {{ $paciente->expediente->fecha_registro }}</p>
                                                    @else
                                                        <p class="text-red-500">No se encontró un expediente para este paciente.</p>
                                                      
                                                    @endif
                                                </div>
                                            </div>
                                            <!-- Botón para cerrar el modal -->
                                            <div class="flex justify-center p-4 bg-gray-100 rounded-b-lg">
                                                <button class="px-6 py-2 text-white bg-red-600 rounded hover:bg-red-700" onclick="toggleModal('modal-id-{{ $paciente->id }}')">Cerrar</button>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function toggleModal(modalId) {
            const modal = document.getElementById(modalId);
            if (modal) {
                modal.classList.toggle('hidden');
            }
        }
    </script>

    <script>
        // Javascript para manejar la primera apertura de los modales
        document.addEventListener('DOMContentLoaded', function() {
            const modals = document.querySelectorAll('[id^="modal-id-"]');
            modals.forEach(modal => {
                modal.addEventListener('show.bs.modal', function() {
                    if (this.getAttribute('data-first-open') === 'true') {
                        // Solo ejecuta esto la primera vez
                        // Aquí podrías realizar la lógica para guardar la hora, si es necesario

                        this.setAttribute('data-first-open', 'false'); // Cambiar a false
                    }
                });
            });
        });
    </script>



    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/5.10.1/main.min.js"></script>
</x-app-layout>