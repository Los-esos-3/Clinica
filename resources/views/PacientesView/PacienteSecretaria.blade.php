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
            <a href="{{ route('Pacientes') }}">Pacientes</a>
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
                                        <div class="flex gap-2">
                                            <x-action-buttons 
                                            :editRoute="route('Pacientes.edit', $paciente->id)" 
                                            :deleteRoute="route('Pacientes.destroy', $paciente->id)" 
                                        />
                                        </div>
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




