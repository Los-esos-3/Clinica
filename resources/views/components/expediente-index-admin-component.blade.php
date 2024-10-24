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
                        DASHBOARD
                    </a>
                </li>
                
                <li class="ml-1">
                    <a href="{{route('Pacientes')}}" class="inline-block p-4 border-b-2 rounded-t-lg no-underline text-zinc-950">
                        PACIENTES
                    </a>
                </li>

                <li class="ml-1">
                    <a href="{{route('Expedientes.admin')}}" class="inline-block p-4 border-b-2 rounded-t-lg no-underline text-zinc-950">
                        EXPEDIENTES
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
                <a href="{{ route('Expedientes.index') }}" class="hover:underline">Expedientes</a>
                <a href="{{ route('ingresos.index') }}" class="hover:underline">Ingresos</a>
            </div>
            <div class="relative">
                <button class="bg-gray-600 rounded px-4 py-2">{{ Auth::user()->name }}</button>
                <div class="absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg hidden">
                    <a href="{{ route('profile.show') }}" class="block px-4 py-2 text-gray-800 hover:bg-gray-200">Perfil</a>
                    <form method="POST" action="{{ route('logout') }}" class="block">
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
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Especialidad</th>
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
                            <td class="px-6 py-4 whitespace-nowrap">{{ $expediente->especialidad }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $expediente->diagnostico }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $expediente->tratamiento }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $expediente->antecedentes }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $expediente->familiar_a_cargo }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $expediente->numero_familiar }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $expediente->proxima_cita }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $expediente->hora_cita }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $expediente->created_at }}</td>
                            <td class="px-6 py-4 whitespace-nowrap flex space-x-2">
                                <a href="{{ route('Expedientes.edit', $expediente->id) }}" class="bg-green-500 text-white px-3 py-1 rounded hover:bg-green-600">Editar</a>
                                <form action="{{ route('Expedientes.destroy', $expediente->id) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="bg-red-500 text-white px-3 py-1 rounded hover:bg-red-600">Eliminar</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</body>

</html>