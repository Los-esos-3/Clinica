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
        border-radius: 8px !important;
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
    .editBtn {
        width: 40px;  
        height: 40px; 
        border-radius: 12px; /
        border: none;
        background-color: rgb(34, 197, 94); /* Color verde */
        display: flex;
        align-items: center;
        justify-content: center;
        box-shadow: 0px 5px 10px rgba(0, 0, 0, 0.123);
        cursor: pointer;
        position: relative;
        overflow: hidden;
        transition: all 0.3s;
    }
    .editBtn::before {
        content: "";
        width: 200%;
        height: 200%;
        background-color: rgb(22, 163, 74); /* Verde más oscuro para el hover */
        position: absolute;
        z-index: 1;
        transform: scale(0);
        transition: all 0.3s;
        border-radius: 50%;
        filter: blur(10px);
    }
    .editBtn:hover::before {
        transform: scale(1);
    }
    .editBtn:hover {
        box-shadow: 0px 5px 10px rgba(0, 0, 0, 0.336);
    }
    .editBtn svg {
        height: 17px;
        fill: white;
        z-index: 3;
        transition: all 0.2s;
        transform-origin: bottom;
    }
    .editBtn:hover svg {
        transform: rotate(-15deg) translateX(5px);
    }
    .editBtn::after {
        content: "";
        width: 25px;
        height: 1.5px;
        position: absolute;
        bottom: 19px;
        left: -5px;
        background-color: white;
        border-radius: 2px;
        z-index: 2;
        transform: scaleX(0);
        transform-origin: left;
        transition: transform 0.5s ease-out;
    }
    .editBtn:hover::after {
        transform: scaleX(1);
        left: 0px;
        transform-origin: right;
    }
    .bin-button {
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
  width: 45px;
  height: 45px;
  border-radius: 15px;
  background-color: rgb(255, 95, 95);
  cursor: pointer;
  border: 3px solid rgb(255, 201, 201);
  transition-duration: 0.3s;
}
.bin-bottom {
  width: 15px;
}
.bin-top {
  width: 17px;
  transform-origin: right;
  transition-duration: 0.3s;
}
.bin-button:hover .bin-top {
  transform: rotate(45deg);
}
.bin-button:hover {
  background-color: rgb(255, 0, 0);
}
.bin-button:active {
  transform: scale(0.9);
}


</style>
<nav class="nav">
    <div class="nav-container">
          <div>
                @include('components.application-logo')
            </div>
        <div class="nav-links">
            <a href="{{ route('dashboard') }}">Calendario</a>
            <a href="{{ route('Pacientes.PacientesView') }}">Pacientes</a>
            <a href="{{ route('Expedientes.index') }}">Visitas</a>
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
 <!-- Vista Crud de pacientes-->

 

 <div class="flex items-center justify-between bg-gray-300 p-4 mb-2 border">
    <h2 class="text-xl font-semibold leading-tight text-gray-800">
        {{ __('Pacientes') }}
    </h2>
    <div class="flex items-center ml-2">
        <div class="relative flex">
            <input type="text" id="search" placeholder="Buscar paciente" class="border rounded-l px-2 py-1" style="width: 250px;" oninput="filterPatients()">
            <button type="button" class="bg-blue-500 text-white rounded-r px-2 py-1 hover:bg-blue-700 transition-colors duration-200 flex items-center">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 50 50">
                    <path d="M 21 3 C 11.601563 3 4 10.601563 4 20 C 4 29.398438 11.601563 37 21 37 C 24.355469 37 27.460938 36.015625 30.09375 34.34375 L 42.375 46.625 L 46.625 42.375 L 34.5 30.28125 C 36.679688 27.421875 38 23.878906 38 20 C 38 10.601563 30.398438 3 21 3 Z M 21 7 C 28.199219 7 34 12.800781 34 20 C 34 27.199219 28.199219 33 21 33 C 13.800781 33 8 27.199219 8 20 C 8 12.800781 13.800781 7 21 7 Z"></path>
                </svg>
            </button>
        </div>
    </div>
    <a href="{{route('Pacientes.create')}}" class="px-2 py-1 font-bold text-white bg-blue-500 rounded hover:bg-blue-700">
        <button>
        Agregar Paciente
    </button>
</a>
</div>

<div class="overflow-x-auto">
    <table class="min-w-full divide-y divide-gray-200" id="patientsTable">
        <thead class="bg-gray-50 dark:bg-gray-400">
            <tr>
                <th class="px-6 py-3 text-xs font-medium tracking-wider text-center text-gray-500 uppercase dark:text-gray-800 border-b-2 border-gray-300">Datos del Paciente</th>
                <th class="px-6 py-3 text-xs font-medium tracking-wider text-center text-gray-500 uppercase dark:text-gray-800 border-b-2 border-gray-300">Expediente</th>
                <th class="px-6 py-3 text-xs font-medium tracking-wider text-center text-gray-500 uppercase dark:text-gray-800 border-b-2 border-gray-300">Acciones</th>
            </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-200 dark:bg-gray-300 dark:divide-gray-600">
            @foreach ($pacientes as $paciente)
                <tr class="patient-row">
                    <td class="px-6 py-4 whitespace-nowrap border-b-2 border-r-2 border-gray-300">
                        <p><strong>Nombre:</strong> {{ $paciente->nombre }}</p>
                        <p><strong>Teléfono:</strong> {{ $paciente->telefono }}</p>
                        <p><strong>Fecha de Nacimiento:</strong> {{ $paciente->fecha_nacimiento }}</p>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap border-b-2 border-r-2 border-gray-300">
                        @if($paciente->expediente)
                            <p><strong>Doctor:</strong> {{ $paciente->expediente->doctor->nombre_completo }}</p>
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
            @endforeach
        </tbody>
    </table>
</div>

<script>
    function filterPatients() {
        const searchInput = document.getElementById('search').value.toLowerCase();
        const patientRows = document.querySelectorAll('.patient-row');

        patientRows.forEach(row => {
            const patientName = row.querySelector('td').textContent.toLowerCase();
            if (patientName.includes(searchInput)) {
                row.style.display = ''; // Mostrar fila
            } else {
                row.style.display = 'none'; // Ocultar fila
            }
        });
    }
</script>

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



