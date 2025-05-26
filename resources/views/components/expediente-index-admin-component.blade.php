<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Expedientes</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<div class="bg-white overflow-hidden shadow-xl rounded-lg">
    <div class="p-4 sm:p-6">
        <div class="flex justify-items-center justify-center">
            <ul class="flex">
                <li>
                    <a href="{{ route('welcome') }}" class="inline-block p-4 border-b-2 rounded-t-lg no-underline text-zinc-950">
                        WELCOME
                    </a>
                </li>
                <li>
                    <a href="{{ route('dashboard') }}" class="inline-block p-4 border-b-2 rounded-t-lg no-underline text-zinc-950">
                        INICIO
                    </a>
                </li>
                <li>
                    <a href="{{ route('doctores.index') }}" class="inline-block p-4 border-b-2 rounded-t-lg no-underline text-zinc-950">
                        DOCTORES
                    </a>
                </li>
                <li class="ml-1">
                    <a href="{{route('Pacientes')}}" class="inline-block p-4 border-b-2 rounded-t-lg no-underline text-zinc-950">
                        PACIENTES
                    </a>
                </li>

                <li class="ml-1">
                    <a href="{{route('Expedientes.admin')}}" class="inline-block p-4 border-b-2 rounded-t-lg no-underline text-zinc-950">
                        VISiTAS
                    </a>
                </li>

                <li class="ml-1">
                    <a href="{{route('ingresos.index')}}" class="inline-block p-4 border-b-2 rounded-t-lg no-underline text-zinc-950">
                        INGRESOS
                    </a>
                </li>
                <li>
                    <a  class="inline-block p-4 border-b-2 rounded-t-lg no-underline text-zinc-950">
                        ROLES
                    </a>
                </li>
                <li>
                    <a href="{{route('empresas.index')}}" class="inline-block p-4 border-b-2 rounded-t-lg no-underline text-zinc-950">
                        EMPRESA
                    </a>
                </li>
            </ul>
        </div>
        </div>
    </div>
</div>
<body class="bg-gray-100 font-sans">
    <nav class="bg-gray-700 text-white p-4">
        <div class="container mx-auto flex justify-between items-center"> 
            <div class="Container-img">
                <x-application-logo></x-application-logo>
            </div>
            <div class="flex space-x-4">
                <a href="{{ route('dashboard') }}" class="hover:underline">Calendario</a>
                <a href="{{ route('Pacientes') }}" class="hover:underline">Pacientes</a>
                <a href="{{ route('Expedientes.index') }}" class="hover:underline">Visitas</a>
                <a href="{{ route('ingresos.index') }}" class="hover:underline">Ingresos</a>
            </div>
            <div class="relative">
                <button class="bg-gray-600 rounded px-4 py-2">{{ Auth::user()->name }}</button>
                <div class="absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg hidden">
                    <a href="{{ route('profile.show') }}" class="block px-4 py-2 text-gray-800 hover:bg-gray-200">Perfil</a>
                    <form method="POST" action="{{ route('logout') }}" autocomplete="on" class="block">
                        @csrf
                        <button type="submit" class="w-full text-left px-4 py-2 text-gray-800 hover:bg-gray-200">Cerrar Sesión</button>
                    </form>
                </div>
            </div>
        </div>
    </nav>

    <div class="container mx-auto p-4">
        <div class="flex justify-between items-center mb-4">
            <h1 class="text-2xl font-bold">Lista de Expedientes</h1>
            <a href="{{ route('Expedientes.create') }}" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600">Agregar Expediente</a>
        </div>
        <div class="bg-white shadow-md rounded overflow-auto">
            <table class="min-w-full">
                <thead class="bg-gray-200">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Paciente</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Doctor</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Diagnóstico</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Tratamiento</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Antecedentes</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Familiar a Cargo</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Número de Familiar</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Próxima cita</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Hora de la cita</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Fecha de Registro</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Acciones</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach ($expedientes as $expediente)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $expediente->paciente->nombre }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $expediente->doctor }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $expediente->diagnostico }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $expediente->tratamiento }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $expediente->antecedentes }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $expediente->familiar_a_cargo }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $expediente->numero_familiar }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $expediente->proxima_cita }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $expediente->hora_cita }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $expediente->fecha_registro }}</td>

                            <td class="px-6 py-4 whitespace-nowrap flex space-x-2">
                                <div class="flex gap-2">
                                    <button 
                                        onclick="window.location.href='{{ route('Expedientes.edit', $expediente->id) }}'"
                                        class="editBtn"
                                    >
                                        <svg height="1em" viewBox="0 0 512 512">
                                            <path d="M410.3 231l11.3-11.3-33.9-33.9-62.1-62.1L291.7 89.8l-11.3 11.3-22.6 22.6L58.6 322.9c-10.4 10.4-18 23.3-22.2 37.4L1 480.7c-2.5 8.4-.2 17.5 6.1 23.7s15.3 8.5 23.7 6.1l120.3-35.4c14.1-4.2 27-11.8 37.4-22.2L387.7 253.7 410.3 231zM160 399.4l-9.1 22.7c-4 3.1-8.5 5.4-13.3 6.9L59.4 452l23-78.1c1.4-4.9 3.8-9.4 6.9-13.3l22.7-9.1v32c0 8.8 7.2 16 16 16h32zM362.7 18.7L348.3 33.2 325.7 55.8 314.3 67.1l33.9 33.9 62.1 62.1 33.9 33.9 11.3-11.3 22.6-22.6 14.5-14.5c25-25 25-65.5 0-90.5L453.3 18.7c-25-25-65.5-25-90.5 0zm-47.4 168l-144 144c-6.2 6.2-16.4 6.2-22.6 0s-6.2-16.4 0-22.6l144-144c6.2-6.2 16.4-6.2 22.6 0s6.2 16.4 0 22.6z"></path>
                                        </svg>
                                    </button>
                                    <form action="{{ route('Expedientes.destroy', $expediente->id) }}" method="POST" class="inline-block">
                                        @csrf
                                        @method('DELETE')
                                        <button class="bin-button">
                                            <svg
                                              class="bin-top"
                                              viewBox="0 0 39 7"
                                              fill="none"
                                              xmlns="http://www.w3.org/2000/svg"
                                            >
                                              <line y1="5" x2="39" y2="5" stroke="white" stroke-width="4"></line>
                                              <line
                                                x1="12"
                                                y1="1.5"
                                                x2="26.0357"
                                                y2="1.5"
                                                stroke="white"
                                                stroke-width="3"
                                              ></line>
                                            </svg>
                                            <svg
                                              class="bin-bottom"
                                              viewBox="0 0 33 39"
                                              fill="none"
                                              xmlns="http://www.w3.org/2000/svg"
                                            >
                                              <mask id="path-1-inside-1_8_19" fill="white">
                                                <path
                                                  d="M0 0H33V35C33 37.2091 31.2091 39 29 39H4C1.79086 39 0 37.2091 0 35V0Z"
                                                ></path>
                                              </mask>
                                              <path
                                                d="M0 0H33H0ZM37 35C37 39.4183 33.4183 43 29 43H4C-0.418278 43 -4 39.4183 -4 35H4H29H37ZM4 43C-0.418278 43 -4 39.4183 -4 35V0H4V35V43ZM37 0V35C37 39.4183 33.4183 43 29 43V35V0H37Z"
                                                fill="white"
                                                mask="url(#path-1-inside-1_8_19)"
                                              ></path>
                                              <path d="M12 6L12 29" stroke="white" stroke-width="4"></path>
                                              <path d="M21 6V29" stroke="white" stroke-width="4"></path>
                                            </svg>
                                          </button>
                                          
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</body>

</html>

<style>
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