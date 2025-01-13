<x-app-layout>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Dashboard Secretaria</title>
        <script src='https://cdn.jsdelivr.net/npm/fullcalendar@5.10.2/main.min.js'></script>
        <link href='https://cdn.jsdelivr.net/npm/fullcalendar@5.10.2/main.min.css' rel='stylesheet' />
        <style>
            /* Estilos del calendario */
            #calendar-secretaria {
                width: 100%;
                height: 700px;
                background-color: #f9fafb; /* Fondo claro */
                border: 1px solid #e5e7eb; /* Borde sutil */
                border-radius: 8px; /* Esquinas redondeadas */
                padding: 1rem;
                box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); /* Sombra ligera */
            }
        
            .fc-event {
                background-color: #3b82f6; /* Azul vibrante */
                color: white;
                border-radius: 8px; /* Esquinas redondeadas */
                padding: 5px;
                font-size: 12px;
                text-align: center;
                transition: all 0.2s ease-in-out;
            }
        
            .fc-event:hover {
                transform: scale(1.05); /* Efecto de zoom */
                box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2); /* Más sombra */
            }
        
            .fc-event-title {
                font-weight: bold; /* Negrita para el título del evento */
            }
        
            /* Barra de navegación */
            .nav {
                background-color: #374151 !important; /* Gris oscuro */
                color: white;
                padding: 1rem;
                display: block;
                box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1); /* Sombra sutil */
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
                transition: color 0.2s ease-in-out;
            }
        
            .nav-links a:hover {
                color: #3b82f6; /* Azul vibrante */
                text-decoration: underline;
            }
        
            /* Modal */
            #eventModal {
                position: fixed;
                inset: 0;
                background-color: rgba(0, 0, 0, 0.5); /* Fondo oscuro con transparencia */
                display: flex;
                justify-content: center;
                align-items: center;
                z-index: 50;
            }
        
            #eventModal .modal-content {
                background-color: #ffffff; /* Fondo blanco */
                border-radius: 12px; /* Esquinas redondeadas */
                padding: 2rem;
                width: 100%;
                max-width: 500px;
                box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2); /* Sombra más fuerte */
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
        
            #eventModal h2 {
                font-size: 1.5rem;
                font-weight: bold;
                margin-bottom: 1rem;
                color: #111827; /* Gris oscuro */
            }
        
            #eventModal label {
                display: block;
                font-size: 0.875rem;
                font-weight: 500;
                color: #374151; /* Gris */
                margin-bottom: 0.5rem;
            }
        
            #eventModal input, 
            #eventModal select {
                width: 100%;
                padding: 0.75rem;
                border: 1px solid #d1d5db; /* Gris claro */
                border-radius: 8px;
                background-color: #f9fafb; /* Fondo claro */
                font-size: 0.875rem;
                color: #374151;
                transition: border-color 0.2s ease-in-out;
            }
        
            #eventModal input:focus,
            #eventModal select:focus {
                border-color: #3b82f6; /* Azul vibrante */
                outline: none;
            }
        
            #eventModal button {
                display: inline-flex;
                justify-content: center;
                align-items: center;
                padding: 0.75rem 1.5rem;
                border-radius: 8px;
                font-size: 0.875rem;
                font-weight: bold;
                text-transform: uppercase;
                transition: background-color 0.2s ease-in-out;
            }
        
            #eventModal button[type="submit"] {
                background-color: #3b82f6; /* Azul vibrante */
                color: white;
                border: none;
            }
        
            #eventModal button[type="submit"]:hover {
                background-color: #2563eb; /* Azul más oscuro */
            }
        
            #eventModal button#closeModal {
                background-color: #d1d5db; /* Gris claro */
                color: #374151; /* Gris oscuro */
            }
        
            #eventModal button#closeModal:hover {
                background-color: #9ca3af; /* Gris más oscuro */
            }
        </style>
        
    </head>
    <body>
        <nav class="nav">
            <div class="nav-container">
                <div class="Container-img">
                    <x-application-logo></x-application-logo>
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
                            <a href="{{ route('logout') }}" onclick="event.preventDefault(); this.closest('form').submit();">Cerrar Sesión</a>
                        </form>
                    </div>
                </div>
            </div>
        </nav>
        
        <div id="calendar-secretaria"></div>

        <!-- Formulario emergente para agregar eventos -->
     {{--    <div id="eventModal" class="hidden fixed inset-0 bg-gray-500 bg-opacity-75 flex items-center justify-center">
            <div class="bg-white p-6 rounded shadow-lg w-1/3">
                <h2 class="text-lg font-semibold mb-4">Registrar Cita</h2>
                <form id="eventForm">
                    <div class="mb-4">
                        <label for="doctor" class="block text-sm font-medium text-gray-700">Doctor</label>
                        <input type="text" id="doctor" name="doctor" class="block w-full p-2 mt-1 border border-gray-400 rounded-md" required placeholder="Escribe el nombre del doctor">
                    </div>
                    <div class="mb-4">
                        <label for="paciente" class="block text-sm font-medium text-gray-700">Paciente</label>
                        <input type="text" id="paciente" name="paciente" class="block w-full p-2 mt-1 border border-gray-400 rounded-md" required placeholder="Escribe el nombre del paciente">
                        <a href="/view/Pacientes/Create.blade" class="text-sm text-blue-500 underline">¿No tienes pacientes? Crear uno nuevo</a>
                    </div>
                    <div class="mb-4">
                        <label for="hora" class="block text-sm font-medium text-gray-700">Hora</label>
                        <input type="time" id="hora" name="hora" class="block w-full p-2 mt-1 border border-gray-400 rounded-md" required>
                    </div>
                    <div class="flex justify-end">
                        <button type="submit" class="inline-flex items-center px-4 py-2 text-xs font-semibold tracking-widest text-white uppercase transition bg-blue-500 border border-transparent rounded-md hover:bg-blue-600">Registrar Cita</button>
                        <button type="button" id="closeModal" class="inline-flex items-center px-4 py-2 ml-2 text-xs font-semibold tracking-widest text-gray-700 uppercase transition bg-gray-200 border border-transparent rounded-md hover:bg-gray-300">Cancelar</button>
                    </div>
                </form>
            </div>
        </div> --}}
        
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                const calendarEl = document.getElementById('calendar-secretaria');
                const modalEl = document.getElementById('eventModal');
                const formEl = document.getElementById('eventForm');
                const closeModalBtn = document.getElementById('closeModal');

                const calendar = new FullCalendar.Calendar(calendarEl, {
                    initialView: 'dayGridMonth',
                    dateClick: function (info) {
                        modalEl.classList.remove('hidden'); // Muestra el modal
                        formEl.setAttribute('data-date', info.dateStr); // Guarda la fecha seleccionada
                    },
                    events: [] // Cargar eventos existentes desde el servidor si es necesario
                });

                calendar.render();

                // Cerrar el modal al hacer clic en el botón de cancelar
                closeModalBtn.addEventListener('click', function() {
                    modalEl.classList.add('hidden'); // Cierra el modal
                    formEl.reset(); // Reinicia el formulario
                });

                // Cerrar el modal al hacer clic fuera del modal
                window.addEventListener('click', function (event) {
                    if (event.target === modalEl) {
                        modalEl.classList.add('hidden'); // Cierra el modal
                        formEl.reset(); // Reinicia el formulario
                    }
                });
            });
        </script>
        
        
    </body>
</x-app-layout>
