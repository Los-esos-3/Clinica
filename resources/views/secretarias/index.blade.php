<x-app-layout>
    <div id="deleteModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden overflow-y-auto h-full w-full">
        <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
            <div class="mt-3 text-center">
                <div class="mx-auto flex items-center justify-center h-12 w-12 rounded-full bg-red-100">
                    <svg class="h-6 w-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                    </svg>
                </div>
                <h3 class="text-lg leading-6 font-medium text-gray-900 mt-4">Confirmar eliminación</h3>
                <div class="mt-2 px-7 py-3">
                    <p class="text-sm text-gray-500">
                        ¿Estás seguro que deseas eliminar a <span id="deleteSecretariaName" class="font-bold"></span>?
                    </p>

                </div>
                <div class="flex justify-center gap-4 mt-4">
                    <button id="cancelDelete"
                        class="px-4 py-2 bg-gray-300 text-gray-700 rounded-md hover:bg-gray-400 focus:outline-none focus:ring-2 focus:ring-gray-300">
                        Cancelar
                    </button>
                    <form id="deleteForm" method="POST" class="inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                            class="px-4 py-2 bg-red-600 text-white rounded-md hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500">
                            Eliminar
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

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

        /* Estilos para las tarjetas de secretarias */
        .secretary-card {
            background: white;
            border-radius: 0.5rem;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            transition: transform 0.2s ease;
            overflow: hidden;
            border: 4px solid rgba(0, 0, 0, 0.1);
        }

        .secretary-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .secretary-header {
            background: #f3f4f6;
            padding: 1rem;
            border-bottom: 1px solid #e5e7eb;
        }

        .secretary-content {
            padding: 1.5rem;
        }

        .info-section {
            background-color: #f8f9fa;
            padding: 1rem;
            border-radius: 0.5rem;
            margin-bottom: 1rem;
        }

        .info-section h4 {
            color: #374151;
            border-bottom: 2px solid #e5e7eb;
            padding-bottom: 0.5rem;
            margin-bottom: 1rem;
        }

        .info-section p {
            margin-bottom: 0.5rem;
            color: #4b5563;
        }

        .info-section span.font-medium {
            color: #1f2937;
        }

        .text-red-500 {
            font-style: italic;
        }

        .info-adicional {
            padding: 1rem;
            background-color: white;
            border-radius: 0.5rem;
            margin-top: 1rem;
        }

        .info-adicional.mostrar {
            border: 1px solid #e5e7eb;
        }

        .ver-mas-btn {
            background-color: #10B981;
            color: white;
            padding: 0.5rem 1rem;
            border-radius: 0.375rem;
            width: 100%;
            text-align: center;
            transition: all 0.3s ease;
            margin: 1rem 0;
        }

        .ver-mas-btn:hover {
            background-color: #059669;
        }

        .info-adicional {
            display: none;
        }

        .info-adicional.mostrar {
            display: block;
            animation: fadeIn 0.3s ease-in-out;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
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

    <div class="min-h-screen flex">
        <aside>
            <x-sidebar :user="Auth::user()" />
        </aside>

         @if (Auth::user()->hasRole('Admin'))
            @if (!Auth::user()->empresa)
                <x-overlay-empresa />
            @endif
        @endif

        <div class="flex-grow bg-gray-100 transition-all duration-300 ml-0 md:ml-64" id="content">

            <div class="flex items-center justify-between bg-gray-300 p-3 mb-6 border">

                <div class="flex items-center gap-16">
                    <button id="toggle-sidebar">
                        <i class="fas fa-bars"></i>
                    </button>

                    <h2 class="text-xl pt-1.5 font-semibold leading-tight text-gray-800">
                        {{ __('Secretarias') }}
                    </h2>
                </div>



                <div class="flex items-center ml-4">
                    <form action="{{ route('secretarias.index') }}" method="GET" class="flex items-center ml-4">
                        <div class="relative flex">
                            <input type="text" placeholder="Buscar" name="search" placeholder=""
                                class="border rounded-l px-4 py-2" style="width: 300px;">
                            <button type="submit"
                                class="bg-blue-500 text-white rounded-r px-3 py-2 hover:bg-blue-700 transition-colors duration-200 flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                    viewBox="0 0 50 50">
                                    <path
                                        d="M 21 3 C 11.601563 3 4 10.601563 4 20 C 4 29.398438 11.601563 37 21 37 C 24.355469 37 27.460938 36.015625 30.09375 34.34375 L 42.375 46.625 L 46.625 42.375 L 34.5 30.28125 C 36.679688 27.421875 38 23.878906 38 20 C 38 10.601563 30.398438 3 21 3 Z M 21 7 C 28.199219 7 34 12.800781 34 20 C 34 27.199219 28.199219 33 21 33 C 13.800781 33 8 27.199219 8 20 C 8 12.800781 13.800781 7 21 7 Z">
                                    </path>
                                </svg>
                            </button>
                        </div>
                    </form>
                </div>
            </div>

                @if ($secretarias->isEmpty())
                <div class="flex justify-center justify-items-center items-center min-h-[500px]">
                    <h4 class="text-red-500 text-center">No hay secretarias creados 
                        <p>(Si desea crear uno, vaya al apartado de Trabajadores y asigne el rol de secretaria)</p>
                    </h4>
                </div>
            @else
            <!-- Grid de tarjetas de secretarias -->
            <div class="py-12">
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        @foreach ($secretarias as $secretaria)
                            <div class="secretary-card">
                                <div class="secretary-header flex items-center space-x-4">
                                    @if ($secretaria->foto_perfil)
                                    <img src="{{ url('storage/' . $secretaria->foto_perfil) }}"
                                         alt="Foto de {{ $secretaria->nombre_completo }}"
                                         class="w-32 h-32 object-cover rounded-full">
                                @else 
                                        <!-- Imagen por defecto si no hay foto -->
                                        <div
                                            class="w-32 h-32 bg-gray-200 rounded-full flex items-center justify-center">
                                            <svg class="w-16 h-16 text-gray-400" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                            </svg>
                                        </div>
                                    @endif
                                    <div>
                                        <h3 class="text-lg font-semibold">{{ $secretaria->nombre_completo }}</h3>
                                    </div>
                                </div>

                                <div class="secretary-content">
                                    <!-- Información Personal -->
                                    <div class="info-section">
                                        <h4 class="font-semibold text-gray-700 mb-2">Información Personal</h4>
                                        <p><span class="font-medium">Fecha Nac:</span> {!! $secretaria->fecha_nacimiento ?: '<span class="text-red-500">No proporcionado</span>' !!}</p>
                                        <p><span class="font-medium">Género:</span> {!! $secretaria->genero ?: '<span class="text-red-500">No proporcionado</span>' !!}</p>
                                        <p><span class="font-medium">Nacionalidad:</span> {!! $secretaria->nacionalidad ?: '<span class="text-red-500">No proporcionado</span>' !!}</p>
                                    </div>

                                    <!-- Contacto -->
                                    <div class="info-section">
                                        <h4 class="font-semibold text-gray-700 mb-2">Contacto</h4>
                                        <p><span class="font-medium">Tel:</span> {!! $secretaria->telefono ?: '<span class="text-red-500">No proporcionado</span>' !!}</p>
                                        <p><span class="font-medium">Email:</span> {!! $secretaria->email ?: '<span class="text-red-500">No proporcionado</span>' !!}</p>
                                        <p><span class="font-medium">Dirección:</span> {!! $secretaria->domicilio ?: '<span class="text-red-500">No proporcionado</span>' !!}</p>
                                    </div>

                                    <!-- Botón Ver Más -->
                                    <button onclick="toggleInfo({{ $secretaria->id }})" class="ver-mas-btn"
                                        id="verMasBtn{{ $secretaria->id }}">
                                        Ver más información
                                    </button>

                                      <div class="flex justify-center space-x-6 mt-4">
                                            <a href="{{ route('secretarias.edit', $secretaria->id) }}"
                                                class="editBtn transform hover:scale-110 transition-transform duration-200">
                                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                                    <path
                                                        d="M21.731 2.269a2.625 2.625 0 00-3.712 0l-1.157 1.157 3.712 3.712 1.157-1.157a2.625 2.625 0 000-3.712zM19.513 8.199l-3.712-3.712-12.15 12.15a5.25 5.25 0 00-1.32 2.214l-.8 2.685a.75.75 0 00.933.933l2.685-.8a5.25 5.25 0 002.214-1.32L19.513 8.199z" />
                                                </svg>
                                            </a>
                                            <button
                                                onclick="showDeleteModal('{{ $secretaria->nombre_completo }}', '{{ route('secretarias.destroy', $secretaria->id) }}')"
                                                class="group relative flex h-[50px] w-[55px] flex-col items-center justify-center overflow-hidden rounded-xl border-2 border-red-800 bg-red-400 hover:bg-red-600">
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
                                        </div>

                                    <!-- Información Adicional (oculta por defecto) -->
                                    <div id="infoAdicional{{ $secretaria->id }}" class="info-adicional">
                                        <!-- Información Laboral -->
                                        <div class="info-section">
                                            <h4 class="font-semibold text-gray-700 mb-2">Información Laboral</h4>
                                            <p><span class="font-medium">Departamento:</span> {!! $secretaria->departamento ?: '<span class="text-red-500">No proporcionado</span>' !!}
                                            </p>
                                            <p><span class="font-medium">Idiomas:</span> {!! $secretaria->idiomas ?: '<span class="text-red-500">No proporcionado</span>' !!}</p>
                                        </div>



                                        <!-- Contacto de Emergencia -->
                                        <div class="info-section">
                                            <h4 class="font-semibold text-gray-700 mb-2">Contacto de Emergencia</h4>
                                            <p><span class="font-medium">Nombre:</span> {!! $secretaria->contacto_emergencia_nombre ?: '<span class="text-red-500">No proporcionado</span>' !!}</p>
                                            <p><span class="font-medium">Relación:</span> {!! $secretaria->contacto_emergencia_relacion ?: '<span class="text-red-500">No proporcionado</span>' !!}</p>
                                            <p><span class="font-medium">Teléfono:</span> {!! $secretaria->contacto_emergencia_telefono ?: '<span class="text-red-500">No proporcionado</span>' !!}</p>
                                        </div>

                                        <!-- Botones de Acción -->
                                      
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
            @endif
        </div>
    </div>

    <script>
        function toggleInfo(id) {
            const info = document.getElementById('infoAdicional' + id);
            const button = document.getElementById('verMasBtn' + id);
            if (info.classList.contains('mostrar')) {
                info.classList.remove('mostrar');
                button.textContent = "Ver más información";
            } else {
                info.classList.add('mostrar');
                button.textContent = "Ocultar información";
            }
        }

        function showDeleteModal(nombre, deleteUrl) {
            const modal = document.getElementById('deleteModal');
            const nameSpan = document.getElementById('deleteSecretariaName');
            const deleteForm = document.getElementById('deleteForm');
            const cancelButton = document.getElementById('cancelDelete');

            nameSpan.textContent = nombre;
            deleteForm.action = deleteUrl;
            modal.classList.remove('hidden');

            // Cerrar modal con el botón cancelar
            cancelButton.onclick = function() {
                modal.classList.add('hidden');
            }

            // Cerrar modal al hacer clic fuera de él
            modal.onclick = function(e) {
                if (e.target === modal) {
                    modal.classList.add('hidden');
                }
            }

            // Cerrar modal con la tecla ESC
            document.onkeydown = function(e) {
                if (e.key === 'Escape') {
                    modal.classList.add('hidden');
                }
            }
        }
    </script>

</x-app-layout>
