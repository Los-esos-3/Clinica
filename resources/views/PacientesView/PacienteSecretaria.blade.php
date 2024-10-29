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
                                            <button 
                                                onclick="window.location.href='{{ route('Pacientes.edit', $paciente->id) }}'"
                                                class="editBtn"
                                            >
                                                <svg height="1em" viewBox="0 0 512 512">
                                                    <path d="M410.3 231l11.3-11.3-33.9-33.9-62.1-62.1L291.7 89.8l-11.3 11.3-22.6 22.6L58.6 322.9c-10.4 10.4-18 23.3-22.2 37.4L1 480.7c-2.5 8.4-.2 17.5 6.1 23.7s15.3 8.5 23.7 6.1l120.3-35.4c14.1-4.2 27-11.8 37.4-22.2L387.7 253.7 410.3 231zM160 399.4l-9.1 22.7c-4 3.1-8.5 5.4-13.3 6.9L59.4 452l23-78.1c1.4-4.9 3.8-9.4 6.9-13.3l22.7-9.1v32c0 8.8 7.2 16 16 16h32zM362.7 18.7L348.3 33.2 325.7 55.8 314.3 67.1l33.9 33.9 62.1 62.1 33.9 33.9 11.3-11.3 22.6-22.6 14.5-14.5c25-25 25-65.5 0-90.5L453.3 18.7c-25-25-65.5-25-90.5 0zm-47.4 168l-144 144c-6.2 6.2-16.4 6.2-22.6 0s-6.2-16.4 0-22.6l144-144c6.2-6.2 16.4-6.2 22.6 0s6.2 16.4 0 22.6z"></path>
                                                </svg>
                                            </button>
                                            <form action="{{ route('Pacientes.destroy', $paciente->id) }}" method="POST" class="inline-block">
                                                @csrf
                                                @method('DELETE')
                                                <button
                                                  class="group relative flex h-10 w-10 flex-col items-center justify-center overflow-hidden rounded-xl border-2 border-red-800 bg-red-400 hover:bg-red-600"
                                                >
                                                  <svg
                                                    viewBox="0 0 1.625 1.625"
                                                    class="absolute -top-5 fill-white delay-100 group-hover:top-4 group-hover:animate-[spin_1.4s] group-hover:duration-1000"
                                                    height="12"
                                                    width="12"
                                                  >
                                                    <path
                                                      d="M.471 1.024v-.52a.1.1 0 0 0-.098.098v.618c0 .054.044.098.098.098h.487a.1.1 0 0 0 .098-.099h-.39c-.107 0-.195 0-.195-.195"
                                                    ></path>
                                                    <path
                                                      d="M1.219.601h-.163A.1.1 0 0 1 .959.504V.341A.033.033 0 0 0 .926.309h-.26a.1.1 0 0 0-.098.098v.618c0 .054.044.098.098.098h.487a.1.1 0 0 0 .098-.099v-.39a.033.033 0 0 0-.032-.033"
                                                    ></path>
                                                    <path
                                                      d="m1.245.465-.15-.15a.02.02 0 0 0-.016-.006.023.023 0 0 0-.023.022v.108c0 .036.029.065.065.065h.107a.023.023 0 0 0 .023-.023.02.02 0 0 0-.007-.016"
                                                    ></path>
                                                  </svg>
                                                  <svg
                                                    width="12"
                                                    fill="none"
                                                    viewBox="0 0 39 7"
                                                    class="origin-right duration-500 group-hover:rotate-90"
                                                  >
                                                    <line stroke-width="4" stroke="white" y2="5" x2="39" y1="5"></line>
                                                    <line
                                                      stroke-width="3"
                                                      stroke="white"
                                                      y2="1.5"
                                                      x2="26.0357"
                                                      y1="1.5"
                                                      x1="12"
                                                    ></line>
                                                  </svg>
                                                  <svg width="12" fill="none" viewBox="0 0 33 39" class="">
                                                    <mask fill="white" id="path-1-inside-1_8_19">
                                                      <path
                                                        d="M0 0H33V35C33 37.2091 31.2091 39 29 39H4C1.79086 39 0 37.2091 0 35V0Z"
                                                      ></path>
                                                    </mask>
                                                    <path
                                                      mask="url(#path-1-inside-1_8_19)"
                                                      fill="white"
                                                      d="M0 0H33H0ZM37 35C37 39.4183 33.4183 43 29 43H4C-0.418278 43 -4 39.4183 -4 35H4H29H37ZM4 43C-0.418278 43 -4 39.4183 -4 35V0H4V35V43ZM37 0V35C37 39.4183 33.4183 43 29 43V35V0H37Z"
                                                    ></path>
                                                    <path stroke-width="4" stroke="white" d="M12 6L12 29"></path>
                                                    <path stroke-width="4" stroke="white" d="M21 6V29"></path>
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
        </div>
    </div>
</div>




<script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/5.10.1/main.min.js"></script>




