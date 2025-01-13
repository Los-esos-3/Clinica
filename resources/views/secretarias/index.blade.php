<x-app-layout>
    <style>
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

        /* Estilos para las tarjetas de secretarias */
        .secretary-card {
            background: white;
            border-radius: 0.5rem;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            transition: transform 0.2s ease;
            overflow: hidden;
            border: 4px solid rgba(0, 0, 0, 0.1);
        }

        .secretary-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
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
            margin-bottom: 1rem;
            padding-bottom: 1rem;
            border-bottom: 1px solid #e5e7eb;
        }

        .info-section:last-child {
            border-bottom: none;
            margin-bottom: 0;
            padding-bottom: 0;
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
            from { opacity: 0; transform: translateY(-10px); }
            to { opacity: 1; transform: translateY(0); }
        }
    </style>

    <!-- Header -->
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div class="flex items-center">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    {{ __('Registro de Secretarias') }}
                </h2>
                <ul class="flex">
                    <li>
                        <a href="{{ route('dashboard') }}" 
                           class="inline-block px-4 ml-8 border-b-2 rounded-t-lg no-underline text-zinc-950 hover:text-indigo-600 transition-colors duration-200">
                            INICIO 
                        </a>
                    </li>
                </ul>
            </div>
            <form action="{{ route('secretarias.index') }}" method="GET" class="flex items-center ml-4">
                <div class="relative flex">
                    <input type="text" name="search" placeholder="" class="border rounded-l px-4 py-2" style="width: 300px;">
                    <button type="submit" class="bg-blue-500 text-white rounded-r px-3 py-2 hover:bg-blue-700 transition-colors duration-200 flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 50 50">
                            <path d="M 21 3 C 11.601563 3 4 10.601563 4 20 C 4 29.398438 11.601563 37 21 37 C 24.355469 37 27.460938 36.015625 30.09375 34.34375 L 42.375 46.625 L 46.625 42.375 L 34.5 30.28125 C 36.679688 27.421875 38 23.878906 38 20 C 38 10.601563 30.398438 3 21 3 Z M 21 7 C 28.199219 7 34 12.800781 34 20 C 34 27.199219 28.199219 33 21 33 C 13.800781 33 8 27.199219 8 20 C 8 12.800781 13.800781 7 21 7 Z"></path>
                        </svg>
                    </button>
                </div>
            </form>
            <a href="{{ route('secretarias.index') }}" 
            class="px-4 py-2 font-bold text-white bg-gray-500 rounded hover:bg-gray-700 transition-colors duration-200 no-underline ml-4">
             Dejar de buscar 
         </a>
            <a href="{{ route('secretarias.create') }}" 
               class="px-4 py-2 font-bold text-white bg-blue-500 rounded hover:bg-blue-700 transition-colors duration-200 no-underline">
                Agregar Secretaria
            </a>
        </div>
    </x-slot>

    <!-- Grid de tarjetas de secretarias -->
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach ($secretarias as $secretaria)
                    <div class="secretary-card">
                        <div class="secretary-header flex items-center space-x-4">
                            @if($secretaria->foto_perfil)
                                <img src="{{ asset('images/' . $secretaria->foto_perfil) }}" 
                                     alt="Foto de {{ $secretaria->nombre_completo }}" 
                                     class="w-32 h-32 object-cover rounded-full">
                            @else
                                <!-- Imagen por defecto si no hay foto -->
                                <div class="w-32 h-32 bg-gray-200 rounded-full flex items-center justify-center">
                                    <svg class="w-16 h-16 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                    </svg>
                                </div>
                            @endif
                            <div>
                                <h3 class="text-lg font-semibold">{{ $secretaria->nombre_completo }}</h3>
                                <p class="text-blue-600">{!! $secretaria->cargo ? : '<span class="text-red-500">No proporcionado</span>' !!}</p>
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
                            </div>

                            <!-- Botón Ver Más -->
                            <button onclick="toggleInfo({{ $secretaria->id }})" 
                                    class="ver-mas-btn" 
                                    id="verMasBtn{{ $secretaria->id }}">
                                Ver más información
                            </button>

                            <!-- Información Adicional (oculta por defecto) -->
                            <div id="infoAdicional{{ $secretaria->id }}" class="info-adicional">
                                <!-- Sección de información adicional si es necesario -->
                                <p>Más detalles de la secretaria...</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
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
    </script>

</x-app-layout>
