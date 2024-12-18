<x-app-layout>
    <style>
        /* ... (estilos existentes) ... */

        /* Estilos para la navegación */
        .nav {
            background-color: rgb(55, 65, 81, 1) !important;
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

        .editBtn {
            width: 55px;
            height: 50px;
            border-radius: 12px;
            border: none;
            background-color: rgb(34, 197, 94);
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
            background-color: rgb(22, 163, 74);
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
    </style>
    <nav class="nav">
        <div class="nav-container">
            <div>
                @include('components.application-logo')
            </div>
            <div class="nav-links">
                <a href="{{ route('dashboard') }}">Calendario</a>
                <a href="{{ route('Pacientes.PacientesView') }}">Pacientes</a>
                <a href="{{ route('ingresos.index') }}">Ingresos</a>
            </div>
            <div class="dropdown">
                <button class="dropbtn">{{ Auth::user()->name }}</button>
                <div class="dropdown-content">
                    <a href="{{ route('profile.show') }}">Perfil</a>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <a href="{{ route('logout') }}"
                            onclick="event.preventDefault(); this.closest('form').submit();">Cerrar Sesión</a>
                    </form>
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
                <input type="text" id="search" placeholder="Buscar paciente" class="border rounded-l px-4 py-2"
                    style="width: 300px;" oninput="filterPatients()">
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
        <div class="mx-auto max-w-80% sm:px-6 lg:px-8">
            <div class="overflow-hidden shadow-md sm:rounded-lg">
                <div class="bg-white border-b border-gray-200 dark:bg-gray-300 dark:border-gray-600">
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50 dark:bg-gray-400">
                                <tr>
                                    <th
                                        class="px-6 py-3 text-xs font-medium tracking-wider text-center text-white uppercase dark:text-gray-800 border-b-2 border-gray-300">
                                        Datos del Paciente</th>
                                    <th
                                        class="px-6 py-3 text-xs font-medium tracking-wider text-center text-white uppercase dark:text-gray-800 border-b-2 border-gray-300">
                                        Consultas</th>
                                    <th
                                        class="px-6 py-3 text-xs font-medium tracking-wider text-center text-white uppercase dark:text-gray-800 border-b-2 border-gray-300">
                                        Expedientes</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200 dark:bg-gray-300 dark:divide-gray-600"
                                id="patientsTable">
                                @foreach ($pacientes as $paciente)
                                    <tr class="patient-row">
                                        <td class="px-6 py-4 whitespace-nowrap border-b-2 border-r-2 border-gray-300">
                                            <p><strong>Nombre:</strong> {{ $paciente->nombre }}</p>
                                            <p><strong>Teléfono:</strong> {{ $paciente->telefono }}</p>
                                            <p><strong>Fecha de Nacimiento:</strong> {{ $paciente->fecha_nacimiento }}
                                            </p>
                                                <div class="flex items-center gap-2 justify-center">
                                                    <form class="flex w-16" action="{{ route('Pacientes.destroy', $paciente->id) }}"
                                                        method="POST" onsubmit="return false;">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button
                                                            class="group relative flex h-[50px] w-[55px] flex-col items-center justify-center overflow-hidden rounded-xl border-2 border-red-800 bg-red-400 hover:bg-red-600"
                                                            onclick="toggleModal('modal-delete-{{ $paciente->id }}'); event.preventDefault(); document.getElementById('form-delete-{{ $paciente->id }}').setAttribute('data-id', '{{ $paciente->id }}');">
                                                            <svg viewBox="0 0 1.625 1.625"
                                                                class="absolute -top-5 fill-white delay-100 group-hover:top-4 group-hover:animate-[spin_1.4s] group-hover:duration-1000"
                                                                height="12" width="12">
                                                                <path
                                                                    d="M.471 1.024v-.52a.1.1 0 0 0-.098.098v.618c0 .054.044.098.098.098h.487a.1.1 0 0 0 .098-.099h-.39c-.107 0-.195 0-.195-.195">
                                                                </path>
                                                                <path
                                                                    d="M1.219.601h-.163A.1.1 0 0 1 .959.504V.341A.033.033 0 0 0 .926.309h-.26a.1.1 0 0 0-.098.098v.618c0 .054.044.098.098.098h.487a.1.1 0 0 0 .098-.099v-.39a.033.033 0 0 0-.032-.033">
                                                                </path>
                                                                <path
                                                                    d="m1.245.465-.15-.15a.02.02 0 0 0-.016-.006.023.023 0 0 0-.023.022v.108c0 .036.029.065.065.065h.107a.023.023 0 0 0 .023-.023.02.02 0 0 0-.007-.016">
                                                                </path>
                                                            </svg>
                                                            <svg width="14" fill="none" viewBox="0 0 39 7"
                                                                class="origin-right duration-500 group-hover:rotate-90">
                                                                <line stroke-width="4" stroke="white" y2="5"
                                                                    x2="39" y1="5"></line>
                                                                <line stroke-width="3" stroke="white" y2="1.5"
                                                                    x2="26.0357" y1="1.5" x1="12"></line>
                                                            </svg>
                                                            <svg width="14" fill="none" viewBox="0 0 33 39"
                                                                class="mt-1">
                                                                <mask fill="white" id="path-1-inside-1_8_19">
                                                                    <path
                                                                        d="M0 0H33V35C33 37.2091 31.2091 39 29 39H4C1.79086 39 0 37.2091 0 35V0Z">
                                                                    </path>
                                                                </mask>
                                                                <path mask="url(#path-1-inside-1_8_19)" fill="white"
                                                                    d="M0 0H33H0ZM37 35C37 39.4183 33.4183 43 29 43H4C-0.418278 43 -4 39.4183 -4 35H4H29H37ZM4 43C-0.418278 43 -4 39.4183 -4 35V0H4V35V43ZM37 0V35C37 39.4183 33.4183 43 29 43V35V0H37Z">
                                                                </path>
                                                                <path d="M12 6L12 29" stroke="white" stroke-width="4"
                                                                    stroke-linecap="round"></path>
                                                                <path d="M21 6V29" stroke="white" stroke-width="4"
                                                                    stroke-linecap="round"></path>
                                                            </svg>
                                                        </button>
                                                    </form>
                                                    
                                                    <a href="#" class="editBtn transform hover:scale-110 transition-transform duration-200" onclick="toggleModal('modal-edit-options-{{ $paciente->id }}'); event.preventDefault();">
                                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                                            <path d="M21.731 2.269a2.625 2.625 0 00-3.712 0l-1.157 1.157 3.712 3.712 1.157-1.157a2.625 2.625 0 000-3.712zM19.513 8.199l-3.712-3.712-12.15 12.15a5.25 5.25 0 00-1.32 2.214l-.8 2.685a.75.75 0 00.933.933l2.685-.8a5.25 5.25 0 002.214-1.32L19.513 8.199z" />
                                                        </svg>
                                                    </a>
                                                    
                                                    <button
                                                        class="px-4 py-2 text-white bg-blue-500 rounded hover:bg-blue-700"
                                                        onclick="toggleModal('modal-id-{{ $paciente->id }}');">
                                                        Ver Más
                                                    </button>
                                                
                                                </div>
                                        
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap border-b-2 border-r-2 border-gray-300">
                                            @if ($paciente->expediente)
                                            <div class="flex justify-center pb-4">
                                                <div class="pagination">
                                                    <a href="#" class="px-3 py-1 border rounded">«</a>
                                                    <a href="#" class="px-3 py-1 border rounded">1</a>
                                                    <a href="#" class="px-3 py-1 border rounded ">2</a>
                                                    <a href="#" class="px-3 py-1 border rounded">3</a>
                                                    <a href="#" class="px-3 py-1 border rounded">4</a>
                                                    <a href="#" class="px-3 py-1 border rounded">»</a>
                                                </div>
                                            </div>

                                            <div>
                                              <p><strong>Ultima Consulta:</strong><!-- Variable Aqui --></p>
                                              <p><strong>Hora del consulta:</strong><!-- Variable Aqui --></p>
                                              <p><strong>Motivo de consulta:</strong><!-- Variable aqui --></p>
                                            </div>

                                            <div class="flex items-center gap-2 justify-center">
                                                <form class="flex w-16" action="{{ route('Pacientes.destroy', $paciente->id) }}"
                                                    method="POST" onsubmit="return false;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button
                                                        class="group relative flex h-[50px] w-[55px] flex-col items-center justify-center overflow-hidden rounded-xl border-2 border-red-800 bg-red-400 hover:bg-red-600"
                                                        onclick="toggleModal('modal-delete-{{ $paciente->id }}'); event.preventDefault(); document.getElementById('form-delete-{{ $paciente->id }}').setAttribute('data-id', '{{ $paciente->id }}');">
                                                        <svg viewBox="0 0 1.625 1.625"
                                                            class="absolute -top-5 fill-white delay-100 group-hover:top-4 group-hover:animate-[spin_1.4s] group-hover:duration-1000"
                                                            height="12" width="12">
                                                            <path
                                                                d="M.471 1.024v-.52a.1.1 0 0 0-.098.098v.618c0 .054.044.098.098.098h.487a.1.1 0 0 0 .098-.099h-.39c-.107 0-.195 0-.195-.195">
                                                            </path>
                                                            <path
                                                                d="M1.219.601h-.163A.1.1 0 0 1 .959.504V.341A.033.033 0 0 0 .926.309h-.26a.1.1 0 0 0-.098.098v.618c0 .054.044.098.098.098h.487a.1.1 0 0 0 .098-.099v-.39a.033.033 0 0 0-.032-.033">
                                                            </path>
                                                            <path
                                                                d="m1.245.465-.15-.15a.02.02 0 0 0-.016-.006.023.023 0 0 0-.023.022v.108c0 .036.029.065.065.065h.107a.023.023 0 0 0 .023-.023.02.02 0 0 0-.007-.016">
                                                            </path>
                                                        </svg>
                                                        <svg width="14" fill="none" viewBox="0 0 39 7"
                                                            class="origin-right duration-500 group-hover:rotate-90">
                                                            <line stroke-width="4" stroke="white" y2="5"
                                                                x2="39" y1="5"></line>
                                                            <line stroke-width="3" stroke="white" y2="1.5"
                                                                x2="26.0357" y1="1.5" x1="12"></line>
                                                        </svg>
                                                        <svg width="14" fill="none" viewBox="0 0 33 39"
                                                            class="mt-1">
                                                            <mask fill="white" id="path-1-inside-1_8_19">
                                                                <path
                                                                    d="M0 0H33V35C33 37.2091 31.2091 39 29 39H4C1.79086 39 0 37.2091 0 35V0Z">
                                                                </path>
                                                            </mask>
                                                            <path mask="url(#path-1-inside-1_8_19)" fill="white"
                                                                d="M0 0H33H0ZM37 35C37 39.4183 33.4183 43 29 43H4C-0.418278 43 -4 39.4183 -4 35H4H29H37ZM4 43C-0.418278 43 -4 39.4183 -4 35V0H4V35V43ZM37 0V35C37 39.4183 33.4183 43 29 43V35V0H37Z">
                                                            </path>
                                                            <path d="M12 6L12 29" stroke="white" stroke-width="4"
                                                                stroke-linecap="round"></path>
                                                            <path d="M21 6V29" stroke="white" stroke-width="4"
                                                                stroke-linecap="round"></path>
                                                        </svg>
                                                    </button>
                                                </form>
                                                
                                                <a href="#" class="editBtn transform hover:scale-110 transition-transform duration-200" onclick="toggleModal('modal-edit-options-{{ $paciente->id }}'); event.preventDefault();">
                                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                                        <path d="M21.731 2.269a2.625 2.625 0 00-3.712 0l-1.157 1.157 3.712 3.712 1.157-1.157a2.625 2.625 0 000-3.712zM19.513 8.199l-3.712-3.712-12.15 12.15a5.25 5.25 0 00-1.32 2.214l-.8 2.685a.75.75 0 00.933.933l2.685-.8a5.25 5.25 0 002.214-1.32L19.513 8.199z" />
                                                    </svg>
                                                </a>
                                                
                                                <button
                                                    class="px-4 py-2 text-white bg-blue-500 rounded hover:bg-blue-700"
                                                    onclick="toggleModal('modal-id-{{ $paciente->id }}');">
                                                    Ver Más
                                                </button>
                                            
                                            </div>
                                            </div>
                                            @else
                                                <p class="text-red-500">No hay expediente disponible.</p>
                                                <a href="{{ route('Expedientes.create', ['paciente_id' => $paciente->id]) }}"
                                                    class="inline-block mt-4 px-4 py-2 font-bold text-white bg-blue-500 rounded hover:bg-blue-700">
                                                    Agregar expediente
                                                </a>
                                            @endif
                                        </td>

                                        <td class="px-6 py-4 whitespace-nowrap border-b-2 border-gray-300">
                                            @if ($paciente->expediente)
                                            <div class="flex justify-center pb-4">
                                                <div class="pagination">
                                                    <a href="#" class="px-3 py-1 border rounded">«</a>
                                                    <a href="#" class="px-3 py-1 border rounded">1</a>
                                                    <a href="#" class="px-3 py-1 border rounded ">2</a>
                                                    <a href="#" class="px-3 py-1 border rounded">3</a>
                                                    <a href="#" class="px-3 py-1 border rounded">4</a>
                                                    <a href="#" class="px-3 py-1 border rounded">»</a>
                                                </div>
                                            </div>

                                            <div>
                                                <p><strong>Doctor:</strong>{{ $paciente->expediente->doctor->nombre_completo }}</p>
                                                <p><strong>Fecha de creacion:</strong><!-- Variable aqui --></p>
                                                <p><strong>Estado del expediente:</strong><!-- Variable aqui --></p>
                                            </div>

                                            <div class="flex items-center gap-2 justify-center">
                                                <form class="flex w-16" action="{{ route('Pacientes.destroy', $paciente->id) }}"
                                                    method="POST" onsubmit="return false;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button
                                                        class="group relative flex h-[50px] w-[55px] flex-col items-center justify-center overflow-hidden rounded-xl border-2 border-red-800 bg-red-400 hover:bg-red-600"
                                                        onclick="toggleModal('modal-delete-{{ $paciente->id }}'); event.preventDefault(); document.getElementById('form-delete-{{ $paciente->id }}').setAttribute('data-id', '{{ $paciente->id }}');">
                                                        <svg viewBox="0 0 1.625 1.625"
                                                            class="absolute -top-5 fill-white delay-100 group-hover:top-4 group-hover:animate-[spin_1.4s] group-hover:duration-1000"
                                                            height="12" width="12">
                                                            <path
                                                                d="M.471 1.024v-.52a.1.1 0 0 0-.098.098v.618c0 .054.044.098.098.098h.487a.1.1 0 0 0 .098-.099h-.39c-.107 0-.195 0-.195-.195">
                                                            </path>
                                                            <path
                                                                d="M1.219.601h-.163A.1.1 0 0 1 .959.504V.341A.033.033 0 0 0 .926.309h-.26a.1.1 0 0 0-.098.098v.618c0 .054.044.098.098.098h.487a.1.1 0 0 0 .098-.099v-.39a.033.033 0 0 0-.032-.033">
                                                            </path>
                                                            <path
                                                                d="m1.245.465-.15-.15a.02.02 0 0 0-.016-.006.023.023 0 0 0-.023.022v.108c0 .036.029.065.065.065h.107a.023.023 0 0 0 .023-.023.02.02 0 0 0-.007-.016">
                                                            </path>
                                                        </svg>
                                                        <svg width="14" fill="none" viewBox="0 0 39 7"
                                                            class="origin-right duration-500 group-hover:rotate-90">
                                                            <line stroke-width="4" stroke="white" y2="5"
                                                                x2="39" y1="5"></line>
                                                            <line stroke-width="3" stroke="white" y2="1.5"
                                                                x2="26.0357" y1="1.5" x1="12"></line>
                                                        </svg>
                                                        <svg width="14" fill="none" viewBox="0 0 33 39"
                                                            class="mt-1">
                                                            <mask fill="white" id="path-1-inside-1_8_19">
                                                                <path
                                                                    d="M0 0H33V35C33 37.2091 31.2091 39 29 39H4C1.79086 39 0 37.2091 0 35V0Z">
                                                                </path>
                                                            </mask>
                                                            <path mask="url(#path-1-inside-1_8_19)" fill="white"
                                                                d="M0 0H33H0ZM37 35C37 39.4183 33.4183 43 29 43H4C-0.418278 43 -4 39.4183 -4 35H4H29H37ZM4 43C-0.418278 43 -4 39.4183 -4 35V0H4V35V43ZM37 0V35C37 39.4183 33.4183 43 29 43V35V0H37Z">
                                                            </path>
                                                            <path d="M12 6L12 29" stroke="white" stroke-width="4"
                                                                stroke-linecap="round"></path>
                                                            <path d="M21 6V29" stroke="white" stroke-width="4"
                                                                stroke-linecap="round"></path>
                                                        </svg>
                                                    </button>
                                                </form>
                                                
                                                <a href="#" class="editBtn transform hover:scale-110 transition-transform duration-200" onclick="toggleModal('modal-edit-options-{{ $paciente->id }}'); event.preventDefault();">
                                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                                        <path d="M21.731 2.269a2.625 2.625 0 00-3.712 0l-1.157 1.157 3.712 3.712 1.157-1.157a2.625 2.625 0 000-3.712zM19.513 8.199l-3.712-3.712-12.15 12.15a5.25 5.25 0 00-1.32 2.214l-.8 2.685a.75.75 0 00.933.933l2.685-.8a5.25 5.25 0 002.214-1.32L19.513 8.199z" />
                                                    </svg>
                                                </a>
                                                
                                                <button
                                                    class="px-4 py-2 text-white bg-blue-500 rounded hover:bg-blue-700"
                                                    onclick="toggleModal('modal-id-{{ $paciente->id }}');">
                                                    Ver Más
                                                </button>
                                            
                                            </div>
                                            </div>
                                            @else
                                                <p class="text-red-500">No hay expediente disponible.</p>
                                                <a href="{{ route('Expedientes.create', ['paciente_id' => $paciente->id]) }}"
                                                    class="inline-block mt-4 px-4 py-2 font-bold text-white bg-blue-500 rounded hover:bg-blue-700">
                                                    Agregar expediente
                                                </a>
                                            @endif
                                        </td>
                                    </tr>

                                    <!-- Modal para cada paciente -->
                                    <div id="modal-id-{{ $paciente->id }}"
                                        class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50 hidden">
                                        <div class="w-3/4 max-w-2xl bg-white rounded-lg shadow-lg">
                                            <div class="flex p-4">
                                                <!-- Sección de datos del paciente -->
                                                <div class="w-1/2 pr-2 border-r">
                                                    <h2 class="text-xl font-bold mb-4">Datos del Paciente</h2>
                                                    <p><strong>Nombre:</strong> {{ $paciente->nombre }}</p>
                                                    <p><strong>Teléfono:</strong> {{ $paciente->telefono }}</p>
                                                    <p><strong>Fecha de Nacimiento:</strong>
                                                        {{ $paciente->fecha_nacimiento }}</p>
                                                    <p><strong>Edad:</strong> {{ $paciente->edad }}</p>
                                                    <p><strong>Dirección:</strong> {{ $paciente->direccion }}</p>
                                                    <p><strong>Género:</strong> {{ $paciente->genero }}</p>
                                                    <p><strong>Estado Civil:</strong> {{ $paciente->estado_civil }}</p>
                                                    <p><strong>Tipo de sangre:</strong> {{ $paciente->tipo_sangre }}
                                                    </p>
                                                    <p><strong>Ocupación:</strong> {{ $paciente->ocupacion }}</p>
                                                </div>

                                                <!-- Sección de expediente -->
                                                <div class="w-1/2 pl-2">
                                                    <h2 class="text-xl font-bold mb-4">Expediente de
                                                        {{ $paciente->nombre }}</h2>
                                                    @if ($paciente->expediente)
                                                        <p><strong>Doctor:</strong>
                                                            {{ $paciente->expediente->doctor->nombre_completo }}</p>
                                                        <p><strong>Diagnóstico:</strong>
                                                            {{ $paciente->expediente->diagnostico }}</p>
                                                        <p><strong>Tratamiento:</strong>
                                                            {{ $paciente->expediente->tratamiento }}</p>
                                                        <p><strong>Antecedentes:</strong>
                                                            {{ $paciente->expediente->antecedentes }}</p>
                                                        <p><strong>Familiar a Cargo:</strong>
                                                            {{ $paciente->expediente->familiar_a_cargo }}</p>
                                                        <p><strong>Número Familiar:</strong>
                                                            {{ $paciente->expediente->numero_familiar }}</p>
                                                        <p><strong>Próxima Cita:</strong>
                                                            {{ $paciente->expediente->proxima_cita }}</p>
                                                        <p><strong>Hora Próxima Cita:</strong>
                                                            {{ $paciente->expediente->hora_proxima_cita }}</p>
                                                        <p><strong>Fecha de Registro:</strong>
                                                            {{ $paciente->expediente->fecha_registro }}</p>
                                                    @else
                                                        <p class="text-red-500">No se encontró un expediente para este
                                                            paciente.</p>
                                                    @endif
                                                </div>
                                            </div>
                                            <!-- Botón para cerrar el modal -->
                                            <div class="flex justify-center p-4 bg-gray-100 rounded-b-lg">
                                                <button
                                                    class="px-6 py-2 text-white bg-red-600 rounded hover:bg-red-700"
                                                    onclick="toggleModal('modal-id-{{ $paciente->id }}')">Cerrar</button>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Modal de confirmación -->
                                    <div id="modal-delete-{{ $paciente->id }}"
                                        class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50 hidden">
                                        <div class="w-1/3 bg-white rounded-lg shadow-lg">
                                            <div class="p-4">
                                                <h2 class="text-xl font-bold mb-4">Confirmar Eliminación</h2>
                                                <p>¿Estás seguro de que deseas eliminar a {{ $paciente->nombre }}?</p>
                                            </div>
                                            <div class="flex justify-end p-4">
                                                <button
                                                    class="px-4 py-2 text-white bg-red-600 rounded hover:bg-red-700"
                                                    onclick="document.getElementById('form-delete-{{ $paciente->id }}').submit();">Eliminar</button>
                                                <button
                                                    class="px-4 py-2 text-gray-700 bg-gray-200 rounded hover:bg-gray-300 ml-2"
                                                    onclick="toggleModal('modal-delete-{{ $paciente->id }}')">Cancelar</button>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Formulario de eliminación -->
                                    <form id="form-delete-{{ $paciente->id }}"
                                        action="{{ route('Pacientes.destroy', $paciente->id) }}" method="POST"
                                        class="hidden">
                                        @csrf
                                        @method('DELETE')
                                    </form>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
    document.addEventListener("DOMContentLoaded", () => {
        // Función para alternar la visibilidad del modal
        function toggleModal(modalId) {
            const modal = document.getElementById(modalId);
            if (modal) {
                modal.classList.toggle('hidden');
            }
        }

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
    });
</script>


    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/5.10.1/main.min.js"></script>
</x-app-layout>
