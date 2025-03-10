<x-app-layout>
    <style> 
       .nav {
            background-color: rgb(55, 65, 81, 1) !important;
            color: white;
            padding: 1rem;
            display:block !important;
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
            box-shadow: 0px 8px 16px 0px rgba(0, 0, 0, 0.2);
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
            <div class="Container-img">
                <x-application-logo></x-application-logo>
            </div>
            <div class="nav-links">
                <a href="{{ route('dashboard') }}">Calendario</a>
                <a href="{{ route('Pacientes.PacientesView') }}">Pacientes</a>
                @if (Auth::user()->hasRole('Doctor'))
                    <a href="">Secretarias</a>
                @endif
            </div>

            <div class="relative inline-block text-left">
                <button type="button"
                    class="inline-flex items-center justify-center w-full px-4 py-2 text-sm font-medium text-white bg-gray-700 rounded-md hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-gray-100 focus:ring-gray-500"
                    id="options-menu" aria-expanded="true" aria-haspopup="true">
                    <span class="mr-2">{{ Auth::user()->name }}</span>
                    <!-- Icono de flecha -->
                    <svg class="-mr-1 ml-2 h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                        fill="currentColor">
                        <path fill-rule="evenodd"
                            d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                            clip-rule="evenodd" />
                    </svg>
                </button>

                <!-- Menú desplegable -->
                <div id="dropdown-menu"
                    class="hidden origin-top-right absolute right-0 mt-2 w-48 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 divide-y divide-gray-100"
                    role="menu" aria-orientation="vertical" aria-labelledby="options-menu">
                    <div class="py-1" role="none">
                        <a href="{{ route('profile.show') }}"
                            class="group flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 hover:text-gray-900"
                            role="menuitem">
                            <svg class="mr-3 h-5 w-5 text-gray-400 group-hover:text-gray-500"
                                xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z"
                                    clip-rule="evenodd" />
                            </svg>
                            Perfil
                        </a>
                    </div>
                    <div class="py-1" role="none">
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit"
                                class="group flex w-full items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 hover:text-gray-900"
                                role="menuitem">
                                <svg class="mr-3 h-5 w-5 text-gray-400 group-hover:text-gray-500"
                                    xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd"
                                        d="M3 3a1 1 0 00-1 1v12a1 1 0 102 0V4a1 1 0 00-1-1zm10.293 9.293a1 1 0 001.414 1.414l3-3a1 1 0 000-1.414l-3-3a1 1 0 10-1.414 1.414L14.586 9H7a1 1 0 100 2h7.586l-1.293 1.293z"
                                        clip-rule="evenodd" />
                                </svg>
                                Cerrar Sesión
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </nav>


    <div class="flex items-center justify-between bg-gray-300 p-3 mb-6 border">
        <h2 class="text-xl pt-1.5 font-semibold leading-tight text-gray-800">
            {{ __('Pacientes') }}
        </h2>

        <div class="flex items-center ml-4">
            <div class="relative flex">
                <input type="text" id="search" placeholder="Buscar paciente"
                    class="border rounded-l px-4 py-2" style="width: 300px;" oninput="filterPatients()">
                <button type="button"
                    class="bg-blue-500 text-white rounded-r px-3 py-2 hover:bg-blue-700 transition-colors duration-200 flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 50 50">
                        <path
                            d="M 21 3 C 11.601563 3 4 10.601563 4 20 C 4 29.398438 11.601563 37 21 37 C 24.355469 37 27.460938 36.015625 30.09375 34.34375 L 42.375 46.625 L 46.625 42.375 L 34.5 30.28125 C 36.679688 27.421875 38 23.878906 38 20 C 38 10.601563 30.398438 3 21 3 Z M 21 7 C 28.199219 7 34 12.800781 34 20 C 34 27.199219 28.199219 33 21 33 C 13.800781 33 8 27.199219 8 20 C 8 12.800781 13.800781 7 21 7 Z">
                        </path>
                    </svg>
                </button>
            </div>
        </div>

        <a href="{{ route('Pacientes.create') }}"
            class="px-4 py-2 font-bold text-white bg-blue-500 rounded hover:bg-blue-700">
            <button>
                Agregar Paciente
            </button>
        </a>
    </div>
    <!-- Vista Crud de pacientes -->

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach ($pacientes as $paciente)
                    <div class="doctor-card bg-white shadow-md rounded-lg overflow-hidden">
                        <div class="doctor-header flex items-center p-4 border-b">
                            @if ($paciente->foto_perfil)
                                <img src="{{ asset('images/' . $paciente->foto_perfil) }}"
                                    alt="Foto de {{ $paciente->nombre }}"
                                    class="w-24 h-24 object-cover rounded-full">
                            @else
                                <div class="w-24 h-24 bg-gray-200 rounded-full flex items-center justify-center">
                                    <svg class="w-16 h-16 text-gray-400" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                    </svg>
                                </div>
                            @endif
                            <div class="ml-4">
                                <h3 class="text-lg font-semibold">{{ $paciente->nombre }}</h3>
                                <p class="text-gray-600">{{ $paciente->telefono }}</p>
                            </div>
                        </div>

                        <div class="doctor-content p-4">
                            <h4 class="font-semibold text-gray-700 mb-2">Información Personal</h4>
                            <p><strong>Dirección:</strong> {!! $paciente->direccion ?: '<span class="text-red-500">No proporcionado</span>' !!}</p>
                            <p><strong>Fecha de Nacimiento:</strong> {{ $paciente->fecha_nacimiento }}</p>
                            <p><strong>Ocupacion:</strong> {{ $paciente->ocupacion }}</p>
                        </div>

                        <div class="flex justify-between p-4 border-t">
                            <button class="bg-[rgb(55,65,81)]  text-white px-4 py-2 rounded-lg"
                                onclick="toggleModal('modal-informacion-{{ $paciente->id }}')">Ver
                                Detalles</button>
                            <a href="{{ route('Pacientes.edit', $paciente->id) }}"
                                class="bg-[rgb(55,65,81)]  text-white px-3 py-2 rounded-lg no-underline hover:no-underline">Editar</a>
                            <button onclick="toggleModal('modal-delete-pacientes-{{$paciente->id}}')"
                                class="bg-[rgb(55,65,81)] text-white px-3 py-2 rounded-lg">Eliminar</button>
                        </div>
                    </div>
                    <x-modal-mas-informacion :paciente="$paciente" />
                    <x-modal-delete-pacients :paciente="$paciente" />
                @endforeach
            </div>
        </div>
    </div>

    <div>
        {{ $pacientes->links() }}
    </div>

    <script>
        // Función para filtrar pacientes
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

        // Registrar las funciones en el objeto global para que sean accesibles
        window.toggleModal = toggleModal;
        window.filterPatients = filterPatients;
    </script>

    <script>
        // Script para manejar el dropdown
        const dropdownButton = document.getElementById('options-menu');
        const dropdownMenu = document.getElementById('dropdown-menu');
        let isOpen = false;

        dropdownButton.addEventListener('click', () => {
            isOpen = !isOpen;
            if (isOpen) {
                dropdownMenu.classList.remove('hidden');
                dropdownButton.setAttribute('aria-expanded', 'true');
            } else {
                dropdownMenu.classList.add('hidden');
                dropdownButton.setAttribute('aria-expanded', 'false');
            }
        });

        // Cerrar el dropdown cuando se hace clic fuera de él
        document.addEventListener('click', (event) => {
            if (!dropdownButton.contains(event.target) && !dropdownMenu.contains(event.target)) {
                dropdownMenu.classList.add('hidden');
                dropdownButton.setAttribute('aria-expanded', 'false');
                isOpen = false;
            }
        });
    </script>

    
<script>
    function toggleModal(modalId) {
        const modal = document.getElementById(modalId);
        const pageContent = document.querySelector('#app'); // Asegúrate de que tu contenedor principal tenga id="app"

        if (modal) {
            if (modal.classList.contains('hidden')) {   
                // Abrir modal
                modal.classList.remove('hidden');
                document.documentElement.style.overflow = 'hidden'; // Bloquea el scroll en html
                document.body.style.overflow = 'hidden'; // Bloquea el scroll en body
                
            } else {
                // Cerrar modal
                modal.classList.add('hidden');
                document.documentElement.style.overflow = 'auto'; // Restaura el scroll en html
                document.body.style.overflow = 'auto'; // Restaura el scroll en body
                if (pageContent) {
                    pageContent.style.filter = 'none'; // Elimina el desenfoque
                    pageContent.style.pointerEvents = 'auto'; // Restaura eventos en el contenido
                }
            }
        }
    }

    // Agregar event listeners para cerrar con ESC y click fuera del modal
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            const modals = document.querySelectorAll('[id^="modal-"]');
            modals.forEach(modal => {
                if (!modal.classList.contains('hidden')) {
                    toggleModal(modal.id);
                }
            });
        }
    });

    // Cerrar al hacer click fuera del modal
    document.addEventListener('click', function(e) {
        if (e.target.matches('[id^="modal-"]')) {
            toggleModal(e.target.id);
        }b
    });
</script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/5.10.1/main.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
</x-app-layout>
