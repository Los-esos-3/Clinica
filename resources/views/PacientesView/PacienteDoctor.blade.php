<x-app-layout>
    <style>
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

        .eye-button {
            background-color: #007BFF;
            /* Azul */
            border: none;
            border-radius: 10px;
            /* Esquinas redondeadas */
            width: 55px;
            /* Tamaño cuadrado */
            height: 50px;
            /* Tamaño cuadrado */
            display: flex;
            justify-content: center;
            align-items: center;
            cursor: pointer;
            outline: none;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.2);
            transition: background-color 0.3s ease, transform 0.2s ease;
        }

        .img-eyes {
            filter: invert(1);
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
                                                <form class="flex w-16"
                                                    action="{{ route('Pacientes.destroy', $paciente->id) }}"
                                                    method="POST" onsubmit="return false;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button
                                                        class="group relative flex h-[50px] w-[55px] flex-col items-center justify-center overflow-hidden rounded-xl border-2 border-red-800 bg-red-400 hover:bg-red-600"
                                                        onclick="toggleModal('modal-borrar-paciente-{{ $paciente->id }}'); event.preventDefault(); document.getElementById('form-delete-{{ $paciente->id }}').setAttribute('data-id', '{{ $paciente->id }}');">
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

                                                <a href="{{ route('Pacientes.edit', $paciente->id) }}"
                                                    class="editBtn transform hover:scale-110 transition-transform duration-200">
                                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                                        <path
                                                            d="M21.731 2.269a2.625 2.625 0 00-3.712 0l-1.157 1.157 3.712 3.712 1.157-1.157a2.625 2.625 0 000-3.712zM19.513 8.199l-3.712-3.712-12.15 12.15a5.25 5.25 0 00-1.32 2.214l-.8 2.685a.75.75 0 00.933.933l2.685-.8a5.25 5.25 0 002.214-1.32L19.513 8.199z" />
                                                    </svg>
                                                </a>

                                                <button class="eye-button" id="eye-icon"
                                                    onclick="toggleModal('modal-paciente-{{ $paciente->id }}');">
                                                    <img class="img-eyes" height="38px" width="38px"
                                                        src="https://img.icons8.com/ios/50/visible--v1.png">
                                                    <img>
                                                </button>



                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap border-b-2 border-r-2 border-gray-300">


                                            @if ($paciente->consultas->isNotEmpty())
                                                @php
                                                    $ultimaConsulta = $paciente->consultas->last();
                                                @endphp

                                                <div class="mt-4">
                                                     <!-- Paginación para consultas -->
                                                </div>

                                                <div>
                                                    <p><strong>Última Consulta:</strong>
                                                        {{ \Carbon\Carbon::parse($ultimaConsulta->created_at)->format('Y-m-d') }}
                                                    </p>
                                                    <p><strong>Hora de la consulta:</strong>
                                                        {{ \Carbon\Carbon::parse($ultimaConsulta->fecha_hora)->format('H:i') }}
                                                    </p>
                                                    <p><strong>Motivo de consulta:</strong>
                                                        {{ $ultimaConsulta->motivo_consulta }}</p>
                                                </div>

                                                <div class="flex items-center gap-2 justify-center">
                                                    <a href="{{ route('consultas.create', ['paciente_id' => $paciente->id]) }}"
                                                        class="eye-button">
                                                        <img class="img-eyes" height="" width=""
                                                            src="https://img.icons8.com/ios-filled/50/plus-math.png"
                                                            alt="">
                                                    </a>

                                                    <form class="flex w-16"
                                                        action="{{ route('Pacientes.destroy', $paciente->id) }}"
                                                        method="POST" onsubmit="return false;">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button
                                                            class="group relative flex h-[50px] w-[55px] flex-col items-center justify-center overflow-hidden rounded-xl border-2 border-red-800 bg-red-400 hover:bg-red-600"
                                                            onclick="toggleModal('modal-borrar-consulta-{{ $paciente->id }}'); event.preventDefault(); document.getElementById('form-delete-{{ $paciente->id }}').setAttribute('data-id', '{{ $paciente->id }}');">
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
                                                                    x2="26.0357" y1="1.5" x1="12">
                                                                </line>
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

                                                    <a href="{{ route('consultas.edit', $ultimaConsulta->id) }}"
                                                        class="editBtn transform hover:scale-110 transition-transform duration-200">
                                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                                            <path
                                                                d="M21.731 2.269a2.625 2.625 0 00-3.712 0l-1.157 1.157 3.712 3.712 1.157-1.157a2.625 2.625 0 000-3.712zM19.513 8.199l-3.712-3.712-12.15 12.15a5.25 5.25 0 00-1.32 2.214l-.8 2.685a.75.75 0 00.933.933l2.685-.8a5.25 5.25 0 002.214-1.32L19.513 8.199z" />
                                                        </svg>
                                                    </a>

                                                    <button class="eye-button" id="eye-icon"
                                                        onclick="toggleModal('modal-consulta-{{ $paciente->id }}');">
                                                        <img class="img-eyes" height="38px" width="38px"
                                                            src="https://img.icons8.com/ios/50/visible--v1.png">
                                                        <img>
                                                    </button>
                                                </div>
                    </div>
                @else
                    <p class="text-red-500">No hay consultas disponibles.</p>
                    <a href="{{ route('consultas.create', ['paciente_id' => $paciente->id]) }}"
                        class="inline-block mt-4 px-4 py-2 font-bold text-white bg-blue-500 rounded hover:bg-blue-700">
                        Agregar Consulta
                    </a>
                    @endif
                    </td>

                    <td class="px-6 py-4 whitespace-nowrap border-b-2 border-gray-300">


                        @if ($paciente->expediente)
                            <div class="pagination">
                                
                            </div>

                            <div>
                                <p><strong>Numero de expediente:</strong>
                                    {{ $paciente->expediente->numero_expediente }}</p>
                                <p><strong>Fecha de creacion:</strong> {{ $paciente->expediente->fecha_registro }}</p>
                                <p><strong>Estado del expediente:</strong>{{ $paciente->expediente->estado }}</p>
                            </div>

                            <div class="flex items-center gap-2 justify-center">

                                <a href="{{ route('Expedientes.create', ['paciente_id' => $paciente->id]) }}"
                                    class="eye-button">
                                    <img class="img-eyes" height="" width=""
                                        src="https://img.icons8.com/ios-filled/50/plus-math.png" alt="">
                                </a>


                                <form class="flex w-16" onsubmit="return false;">
                                    <button
                                        class="group relative flex h-[50px] w-[55px] flex-col items-center justify-center overflow-hidden rounded-xl border-2 border-red-800 bg-red-400 hover:bg-red-600"
                                        onclick="toggleModal('modal-borrar-expediente-{{ $paciente->id }}'); event.preventDefault(); document.getElementById('form-delete-{{ $paciente->id }}').setAttribute('data-id', '{{ $paciente->id }}');">
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
                                            <line stroke-width="4" stroke="white" y2="5" x2="39"
                                                y1="5"></line>
                                            <line stroke-width="3" stroke="white" y2="1.5" x2="26.0357"
                                                y1="1.5" x1="12">
                                            </line>
                                        </svg>
                                        <svg width="14" fill="none" viewBox="0 0 33 39" class="mt-1">
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

                                @if ($paciente->expediente)
                                    <a href="{{ route('Expedientes.edit', $paciente->expediente->id) }}"
                                        class="editBtn transform hover:scale-110 transition-transform duration-200">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                            <path
                                                d="M21.731 2.269a2.625 2.625 0 00-3.712 0l-1.157 1.157 3.712 3.712 1.157-1.157a2.625 2.625 0 000-3.712zM19.513 8.199l-3.712-3.712-12.15 12.15a5.25 5.25 0 00-1.32 2.214l-.8 2.685a.75.75 0 00.933.933l2.685-.8a5.25 5.25 0 002.214-1.32L19.513 8.199z" />
                                        </svg>
                                    </a>
                                @endif

                                <button class="eye-button" id="eye-icon"
                                    onclick="toggleModal('modal-expediente-{{ $paciente->id }}');">
                                    <img class="img-eyes" height="38px" width="38px"
                                        src="https://img.icons8.com/ios/50/visible--v1.png">
                                    <img>
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

                <!--Modales de ver mas  -->
                <!-- Modal de Paciente -->
                <div id="modal-paciente-{{ $paciente->id }}"
                    class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50 hidden">
                    <div class="w-3/4 max-w-2xl bg-white rounded-lg shadow-lg">
                        <div class="flex p-4">
                            <div class="w-full text-center">
                                <!-- Agrega text-center aquí -->
                                <h2 class="text-xl font-bold mb-4">Datos del Paciente
                                </h2>
                                <p><strong>Nombre:</strong> {{ $paciente->nombre }}</p>
                                <p><strong>Teléfono:</strong> {{ $paciente->telefono }}
                                </p>
                                <p><strong>Fecha de Nacimiento:</strong>
                                    {{ $paciente->fecha_nacimiento }}</p>
                                <p><strong>Edad:</strong> {{ $paciente->edad }}</p>
                                <p><strong>Dirección:</strong>
                                    {{ $paciente->direccion }}</p>
                                <p><strong>Género:</strong> {{ $paciente->genero }}</p>
                                <p><strong>Estado Civil:</strong>
                                    {{ $paciente->estado_civil }}</p>
                                <p><strong>Tipo de sangre:</strong>
                                    {{ $paciente->tipo_sangre }}</p>
                                <p><strong>Ocupación:</strong>
                                    {{ $paciente->ocupacion }}</p>
                            </div>
                        </div>
                        <div class="flex justify-center p-4 bg-gray-100 rounded-b-lg">
                            <button class="px-6 py-2 text-white bg-red-600 rounded hover:bg-red-700"
                                onclick="toggleModal('modal-paciente-{{ $paciente->id }}')">Cerrar</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modal de consultas -->
            <div id="modal-consulta-{{ $paciente->id }}"
                class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50 hidden">
                <div class="w-3/4 max-w-2xl bg-white rounded-lg shadow-lg">
                    <div class="flex p-4">
                        @if ($paciente->consultas->isNotEmpty())
                            <div class="w-full text-center">
                                <h2 class="text-xl font-bold mb-4">Última Consulta</h2>
                                <p><strong>Nombre del Paciente:</strong> {{ $paciente->nombre }}</p>
                                <p><strong>Médico:</strong> {{ $ultimaConsulta->doctor->nombre_completo }}</p>
                                <p><strong>Fecha:</strong>
                                    {{ \Carbon\Carbon::parse($ultimaConsulta->created_at)->format('Y-m-d') }}</p>
                                <p><strong>Hora:</strong>
                                    {{ \Carbon\Carbon::parse($ultimaConsulta->fecha_hora)->format('H:i') }}</p>
                                <p><strong>Motivo de consulta:</strong> {{ $ultimaConsulta->motivo_consulta }}</p>
                                <p><strong>Diagnóstico:</strong> {{ $ultimaConsulta->diagnostico }}</p>
                                <p><strong>Tratamiento:</strong> {{ $ultimaConsulta->tratamiento }}</p>
                                <p><strong>Notas adicionales:</strong> {{ $ultimaConsulta->notas_adicionales }}</p>
                            </div>
                        @else
                            <div>
                                <label>No hay Consultas disponibles</label>
                            </div>
                        @endif
                    </div>
                    <div class="flex justify-center p-4 bg-gray-100 rounded-b-lg">
                        <button class="px-6 py-2 text-white bg-red-600 rounded hover:bg-red-700"
                            onclick="toggleModal('modal-consulta-{{ $paciente->id }}')">Cerrar</button>
                    </div>
                </div>
            </div>
            <!-- Modal de expedientes -->
            <div id="modal-expediente-{{ $paciente->id }}"
                class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50 hidden">
                <div class="w-3/4 max-w-2xl bg-white rounded-lg shadow-lg">
                    <div class="flex p-4">
                        <div class="w-full text-center">
                            <h2 class="text-xl font-bold mb-4">Datos del Expediente</h2>
                            @if ($paciente->expediente)
                                <p><Strong>Numero de expediente:</Strong>
                                    {{ $paciente->expediente->numero_expediente }}</p>
                                <p><strong>Nombre del paciente:</strong> {{ $paciente->expediente->paciente->nombre }}
                                </p>
                                <p><strong>Fecha de registro:</strong> {{ $paciente->expediente->fecha_registro }}</p>
                                <p><Strong>Estado del expediente:</Strong> {{ $paciente->expediente->estado }}</p>
                                <p><strong>Alergias conocidas:</strong> {{ $paciente->expediente->alergias }}</p>
                                <p><Strong>Antecendetes medicos:</Strong>
                                    {{ $paciente->expediente->antecedentes_medicos }}</p>
                                <p><Strong>Historial quirurgico</Strong>
                                    {{ $paciente->expediente->historial_quirurgico }}</p>
                                <p><Strong>Historial familiar relevante:</Strong>
                                    {{ $paciente->expediente->historial_familiar }}</p>
                                <p><Strong>Vacunas aplicadas:</Strong> {{ $paciente->expediente->vacunas }}</p>
                                <p><strong>Medicamentos actuales</strong> {{ $paciente->expediente->medicamentos }}</p>
                                <p><strong>Estudios o Examenes previos:</strong>
                                    {{ $paciente->expediente->estudios_previos }}</p>
                                <p><strong>Notas medicas</strong> {{ $paciente->expediente->notas_medicas }}</p>
                            @else
                                <p>No hay expediente disponible.</p>
                            @endif
                        </div>
                    </div>
                    <div class="flex justify-center p-4 bg-gray-100 rounded-b-lg">
                        <button class="px-6 py-2 text-white bg-red-600 rounded hover:bg-red-700"
                            onclick="toggleModal('modal-expediente-{{ $paciente->id }}')">Cerrar</button>
                    </div>
                </div>
            </div>
        </div>


        <!-- Modal de confirmación de pacientes -->
        <div id="modal-borrar-paciente-{{ $paciente->id }}"
            class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50 hidden">
            <div class="w-1/3 bg-white rounded-lg shadow-lg">
                <div class="p-4">
                    <h2 class="text-xl font-bold mb-4">Confirmar Eliminación</h2>
                    <p>¿Estás seguro de que deseas eliminar a {{ $paciente->nombre }}?</p>
                </div>
                <div class="flex justify-end p-4">
                    <form action="{{ route('Pacientes.destroy', $paciente->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button class="px-4 py-2 text-white bg-red-600 rounded hover:bg-red-700">
                            Eliminar
                        </button>
                    </form>
                    <button class="px-4 py-2 text-gray-700 bg-gray-200 rounded hover:bg-gray-300 ml-2"
                        onclick="toggleModal('modal-borrar-paciente-{{ $paciente->id }}')">Cancelar</button>
                </div>
            </div>
        </div>

        <!-- Modal de confirmación de consultas -->
        <div id="modal-borrar-consulta-{{ $paciente->id }}"
            class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50 hidden">
            <div class="w-1/3 bg-white rounded-lg shadow-lg">
                <div class="p-4">
                    <h2 class="text-xl font-bold mb-4">Confirmar Eliminación</h2>
                    <p>¿Estás seguro de que deseas borrar la consulta de {{ $paciente->nombre }}?</p>
                </div>
                <div class="flex justify-end p-4">
                    @foreach ($paciente->consultas as $consulta)
                        <form action="{{ route('consultas.destroy', $consulta->id) }}" method="POST"
                            class="inline-block">
                            @csrf
                            @method('DELETE')
                            <button class="px-4 py-2 text-white bg-red-600 rounded hover:bg-red-700">
                                Eliminar
                            </button>
                        </form>
                        <button class="px-4 py-2 text-gray-700 bg-gray-200 rounded hover:bg-gray-300 ml-2"
                            onclick="toggleModal('modal-borrar-consulta-{{ $paciente->id }}')">Cancelar</button>
                    @endforeach
                </div>
            </div>
        </div>

        <!-- Modal de confirmación de expedientes-->
        <div id="modal-borrar-expediente-{{ $paciente->id }}"
            class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50 hidden">
            <div class="w-1/3 bg-white rounded-lg shadow-lg">
                <div class="p-4">
                    <h2 class="text-xl font-bold mb-4">Confirmar Eliminación</h2>
                    <p>¿Estás seguro de que deseas borrar el expediente de {{ $paciente->nombre }}?</p>
                </div>
                <div class="flex justify-end p-4">
                    @if ($paciente->expediente)
                        <!-- Verifica si existe el expediente -->
                        <form action="{{ route('Expedientes.destroy', $paciente->expediente->id) }}" method="POST"
                            class="inline-block">
                            @csrf
                            @method('DELETE')
                            <button class="px-4 py-2 text-white bg-red-600 rounded hover:bg-red-700">
                                Eliminar
                            </button>
                        </form>
                        <button class="px-4 py-2 text-gray-700 bg-gray-200 rounded hover:bg-gray-300 ml-2"
                            onclick="toggleModal('modal-borrar-expediente-{{ $paciente->id }}')">Cancelar</button>
                    @else
                        <p class="text-red-500">No hay expediente disponible.</p> <!-- Mensaje si no hay expediente -->
                    @endif
                </div>
            </div>
        </div>
        @endforeach
        </tbody>
        </table>


        <div>
            {{ $pacientes->links() }}
        </div>
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

    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/5.10.1/main.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
</x-app-layout>
