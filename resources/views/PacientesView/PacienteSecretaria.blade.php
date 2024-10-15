<style>
    /* ... (estilos existentes) ... */
    
    /* Estilos para la navegación */
    .nav {
        background-color: #333;
        color: white;
        padding: 1rem;
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
        background-color: #333;
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
        <div class="nav-links">
            <a href="{{ route('dashboard') }}">Calendario</a>
            <a href="{{ route('Pacientes') }}">Pacientes</a>
            <a href="{{ route('Expedientes.index') }}">Expedientes</a>
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

 

 <div class="flex items-center justify-between bg-gray-300 p-8 mb-4 border">
    <h2 class="text-xl font-semibold leading-tight text-gray-800">
        {{ __('Pacientes') }}
    </h2>
    <a href="{{route('Pacientes.create')}}" class="px-4 py-2 font-bold text-white bg-blue-500 rounded hover:bg-blue-700">
        <button>
        Agregar Paciente
    </button>
</a>
</div>


 <div class="py-12">
    <div class="mx-auto max-w-80% sm:px-6 lg:px-8">
        <div class="overflow-hidden shadow-md sm:rounded-lg">
            <div class="bg-white border-b border-gray-200 dark:bg-gray-300 dark:border-gray-600">
                <div class="overflow-x-auto"> <!-- Permite el desplazamiento horizontal -->
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50 dark:bg-gray-400">
                            <tr>
                                <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase dark:text-gray-800">Nombre del Paciente</th>
                                <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase dark:text-gray-800">Número de Teléfono</th>
                                <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase dark:text-gray-800">Fecha de Nacimiento</th>
                                <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase dark:text-gray-800">Edad</th>
                                <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase dark:text-gray-800">Dirección</th>
                                <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase dark:text-gray-800">Género</th>
                                <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase dark:text-gray-800">Estado Civil</th>
                                <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase dark:text-gray-800">Fecha de Registro</th>
                                <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase dark:text-gray-800">Tipo de Sangre</th>
                                <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase dark:text-gray-800">Ocupación</th>
                                <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase dark:text-gray-800">Acciones</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200 dark:bg-gray-300 dark:divide-gray-600">
                            @foreach ($pacientes as $paciente)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $paciente->nombre }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $paciente->telefono }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $paciente->fecha_nacimiento }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $paciente->edad }}</td>
                                    <td class="px-6 py-4 break-words whitespace-normal">{{ $paciente->direccion }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $paciente->genero }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $paciente->estado_civil }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $paciente->fecha_registro }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $paciente->tipo_sangre }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $paciente->ocupacion }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <a href="{{ route('Pacientes.edit', $paciente->id) }}" class="px-4 py-2 text-sm font-bold text-white bg-green-500 border border-green-700 rounded hover:bg-green-700">Editar</a>
                                        <form action="{{ route('Pacientes.destroy', $paciente->id) }}" method="POST" class="inline-block">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="px-4 py-2 text-sm font-bold text-white bg-red-500 border border-red-700 rounded hover:bg-red-700">Borrar</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>




<script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/5.10.1/main.min.js"></script>