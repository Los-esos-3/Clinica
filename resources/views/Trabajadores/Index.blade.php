<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        .container {
            max-width: 500px;
            width: 100%;
            padding: 2rem;
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        h2 {
            text-align: center;
            color: #1e293b;
            margin-bottom: 1rem;
        }

        p {

            margin-bottom: 1rem !important;
        }

        .form-group {
            margin-bottom: 1.5rem;
        }

        label {
            display: block;
            font-size: 0.875rem;
            color: #334155;
            margin-bottom: 0.5rem;
        }

        input[type="text"],
        input[type="email"],
        input[type="password"],
        select {
            width: 100%;
            border: 1px solid #d1d5db;
            border-radius: 4px;
            font-size: 1rem;
            transition: border-color 0.3s ease;
        }

        input[type="text"]:focus,
        input[type="email"]:focus,
        input[type="password"]:focus,
        select:focus {
            outline: none;
            border-color: #3b82f6;
        }

        button {
            width: 100%;
            padding: 0.75rem;
            background-color: #3b82f6;
            color: #ffffff;
            font-size: 1rem;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .error {
            color: #ef4444;
            font-size: 0.875rem;
            margin-top: 0.5rem;
        }

        .Subtitulo {
            font-weight: 600;
            margin-bottom: 0.5rem;
            font-size: calc(1.150rem + .3vw);
            color: rgb(55 65 81);
        }

        strong {
            font-weight: 500 !important;
        }

        .SeccionBtn {
            display: flex;
            justify-content: center;
            gap: 4.5rem;
            padding: 1rem;
            border-top-width: 1px;
        }

        .gridtarjetas {
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 2.5rem;
        }
    </style>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>
    <div class="min-h-screen flex">
        <aside>
            <x-sidebar :user="Auth::user()" />
        </aside>

        <div class="flex-grow bg-gray-100 transition-all duration-300 ml-0 md:ml-64" id="content">
            <div class="flex items-center justify-between bg-gray-300 p-4 mb-6 border">
                <div class="flex items-center gap-16">
                    <button id="toggle-sidebar">
                        <i class="fas fa-bars"></i>
                    </button>
                    <h2 class="text-xl font-semibold text-gray-800">
                        {{ __('Trabajadores') }}
                    </h2>
                </div>

                <div class="flex items-center ml-4">
                    <form method="GET" action="" class="flex items-center ml-4">
                        <div class="relative flex">
                            <input type="text" name="search" placeholder="Buscar" value="{{ request('search') }}"
                                class="border rounded-l px-4 py-2" style="width: 300px;">
                            </input>
                            <button type="submit"
                                class="bg-blue-500 text-white w-12 rounded-r px-3 py-2 hover:bg-blue-700 transition-colors duration-200 flex items-center">
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

                <a href="{{ route('Trabajadores.create') }}"
                    class="px-4 py-2 font-bold text-white bg-blue-500 rounded hover:bg-blue-700">
                    <button>
                        Agregar Trabajador
                    </button>
                </a>
            </div>

            <div class="p-6">
                @if ($trabajadores->isEmpty())
                    <div class="flex justify-center justify-items-center items-center min-h-[500px]">
                        <h4 class="text-red-500">No hay trabajadores creados</h4>
                    </div>
                @else
                    <div class="py-12">
                        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                            <div class="gridtarjetas">
                            @foreach ($trabajadores as $trabajador)
                                <div class="doctor-card bg-white shadow-md rounded-lg overflow-hidden">
                                    <div class="doctor-header flex items-center p-6 border-b">
                                        @if ($trabajador->foto_perfil)
                                            <img src="{{ asset('storage/' . $trabajador->foto_perfil) }}"
                                                alt="Foto de {{ $trabajador->nombre }}"
                                                class="w-24 h-24 object-cover rounded-full">
                                        @else
                                            <div
                                                class="w-24 h-24 bg-gray-200 rounded-full flex items-center justify-center">
                                                <svg class="w-16 h-16 text-gray-400" fill="none"
                                                    stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                                </svg>
                                            </div>
                                        @endif
                                        <div class="ml-4">
                                            <h3 class="text-lg mb-2 font-semibold">{{ $trabajador->nombre }}</h3>
                                            <p class="text-gray-600">{{ $trabajador->correo }}</p>
                                        </div>
                                    </div>

                                    <div class="doctor-content p-6">
                                        <h4 class="Subtitulo">Información Personal</h4>
                                        <p><strong>Teléfono:</strong> {{ $trabajador->tel ?? 'No proporcionado' }}</p>
                                        <p><strong>Rol:</strong> {{ $trabajador->rol }}</p>
                                        <p><strong>Empresa:</strong>
                                            {{ $trabajador->empresa?->nombre ?? 'Sin empresa' }}</p>
                                    </div>

                                    <div class="SeccionBtn">
                                        <a href="{{ route('Trabajadores.edit', $trabajador->id) }}"
                                            class="bg-[rgb(55,65,81)] text-white px-3 py-2 rounded-lg no-underline hover:no-underline">
                                            Editar
                                        </a>
                                        <form action="{{ route('Trabajadores.destroy', $trabajador->id) }}"
                                            method="POST"
                                            onsubmit="return confirm('¿Estás seguro de eliminar este trabajador?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="bg-[rgb(55,65,81)] text-white px-3 py-2 rounded-lg">
                                                Eliminar
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
            </div>
            @endif
            <div>
                {{-- Paginación --}}
                {{ $trabajadores->links() }}
            </div>
        </div>
    </div>
    </div>
</body>

</html>
