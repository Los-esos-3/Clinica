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
                background-color: #f9fafb;
                border: 1px solid #e5e7eb;
                border-radius: 8px;
                padding: 1rem;
                box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            }
        
            .fc-event {
                background-color: #3b82f6;
                color: white;
                border-radius: 8px;
                padding: 5px;
                font-size: 12px;
                text-align: center;
                transition: all 0.2s ease-in-out;
            }
        
            .fc-event:hover {
                transform: scale(1.05);
                box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            }
        
            .fc-event-title {
                font-weight: bold;
            }
        
            /* Barra de navegación */
            .nav {
                background-color: #374151 !important;
                color: white;
                padding: 1rem;
                display: block;
                box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
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
                color: #3b82f6;
                text-decoration: underline;
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
                
                <div class="relative inline-block text-left">
                    <button type="button" 
                        class="inline-flex items-center justify-center w-full px-4 py-2 text-sm font-medium text-white bg-gray-700 rounded-md hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-gray-100 focus:ring-gray-500" 
                        id="options-menu" 
                        aria-expanded="true" 
                        aria-haspopup="true">
                        <span class="mr-2">{{ Auth::user()->name }}</span>
                        <!-- Icono de flecha -->
                        <svg class="-mr-1 ml-2 h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                        </svg>
                    </button>

                    <!-- Menú desplegable -->
                    <div id="dropdown-menu" 
                        class="hidden origin-top-right absolute right-0 mt-2 w-48 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 divide-y divide-gray-100" 
                        role="menu" 
                        aria-orientation="vertical" 
                        aria-labelledby="options-menu">
                        <div class="py-1" role="none">
                            <a href="{{ route('profile.show') }}" 
                                class="group flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 hover:text-gray-900" 
                                role="menuitem">
                                <svg class="mr-3 h-5 w-5 text-gray-400 group-hover:text-gray-500" 
                                    xmlns="http://www.w3.org/2000/svg" 
                                    viewBox="0 0 20 20" 
                                    fill="currentColor">
                                    <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd" />
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
                                        xmlns="http://www.w3.org/2000/svg" 
                                        viewBox="0 0 20 20" 
                                        fill="currentColor">
                                        <path fill-rule="evenodd" d="M3 3a1 1 0 00-1 1v12a1 1 0 102 0V4a1 1 0 00-1-1zm10.293 9.293a1 1 0 001.414 1.414l3-3a1 1 0 000-1.414l-3-3a1 1 0 10-1.414 1.414L14.586 9H7a1 1 0 100 2h7.586l-1.293 1.293z" clip-rule="evenodd" />
                                    </svg>
                                    Cerrar Sesión
                                </button>
                        </form>
                        </div>
                    </div>
                </div>
            </div>
        </nav>
        
        <!-- Contenedor para el botón y calendario -->
        <div class="p-6">
            <!-- Botón para abrir modal -->
            <button id="openModalBtn" class="mb-4 bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded flex items-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-11a1 1 0 10-2 0v2H7a1 1 0 100 2h2v2a1 1 0 102 0v-2h2a1 1 0 100-2h-2V7z" clip-rule="evenodd" />
                </svg>
                Nueva Cita
            </button>

            <!-- Calendario -->
        <div id="calendar-secretaria"></div>
        </div>

       <!-- Modal para crear cita con mejor diseño -->
<div id="citaModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden overflow-y-auto h-full w-full z-50">
    <div class="relative top-20 mx-auto p-6 border w-[500px] shadow-2xl rounded-xl bg-white">
        <div class="absolute top-0 right-0 pt-4 pr-4">
            <button id="closeModalBtn" class="text-gray-400 hover:text-gray-500 transition-colors duration-200">
                <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>

        <div class="mt-3">
            <div class="flex items-center mb-6">
                <svg class="h-8 w-8 text-blue-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                </svg>
                <h3 class="text-2xl font-semibold text-gray-900">Nueva Cita</h3>
            </div>

                    <form id="citaForm" class="space-y-6">
                        @csrf
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="block text-gray-700 text-sm font-bold mb-2">Fecha</label>
                                <input type="date" id="fecha" name="fecha" 
                                    class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200" 
                                    required>
                            </div>

                            <div>
                                <label class="block text-gray-700 text-sm font-bold mb-2">Hora</label>
                                <select name="hora" 
                                    class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200" 
                                    required>
                                    <option value="">Seleccionar</option>
                                    @for($i = 8; $i <= 17; $i++)
                                        @foreach(['00', '30'] as $minutos)
                                            <option value="{{ sprintf('%02d:%s', $i, $minutos) }}">
                                                {{ sprintf('%02d:%s', $i, $minutos) }}
                                            </option>
                                        @endforeach
                                    @endfor
                                </select>
                            </div>
                        </div>

                        <div>
                            <label class="block text-gray-700 text-sm font-bold mb-2">Doctor</label>
                            <select type="text" name="doctor" 
                                class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200" 
                                placeholder="Nombre del doctor" required>
                        </div>

                        <div>
                            <label class="block text-gray-700 text-sm font-bold mb-2">Doctor</label>
                            <input type="text" name="paciente" 
                                class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200" 
                                placeholder="Nombre del paciente" required>
                        </div>


                        <div>
                            <label class="block text-gray-700 text-sm font-bold mb-2">Motivo de la Cita</label>
                            <textarea name="motivo" rows="3" 
                                class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200" 
                                placeholder="Describe el motivo de la cita" required></textarea>
                        </div>

                        <div class="flex justify-end space-x-4 pt-4">
                            <button type="button" id="cancelBtn" 
                                class="px-6 py-2.5 rounded-lg text-gray-700 bg-gray-100 hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-gray-400 transition-all duration-200">
                                Cancelar
                            </button>
                            <button type="submit" 
                                class="px-6 py-2.5 rounded-lg text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 transition-all duration-200">
                                Programar Cita
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
      
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const calendarEl = document.getElementById('calendar-secretaria');
                const modal = document.getElementById('citaModal');
                const openModalBtn = document.getElementById('openModalBtn');
                const closeModalBtn = document.getElementById('closeModalBtn');
                const cancelBtn = document.getElementById('cancelBtn');
                const citaForm = document.getElementById('citaForm');
                const fechaInput = document.getElementById('fecha');

                // Función para cerrar el modal
                function closeModal() {
                    modal.classList.add('hidden');
                    citaForm.reset();
                }

                // Función para guardar citas en localStorage
                function guardarCitas() {
                    const eventos = calendar.getEvents();
                    const citasGuardadas = eventos.map(evento => ({
                        title: evento.title,
                        start: evento.start,
                        end: evento.end,
                        backgroundColor: evento.backgroundColor,
                        borderColor: evento.borderColor,
                        textColor: evento.textColor,
                        extendedProps: evento.extendedProps
                    }));
                    localStorage.setItem('citas', JSON.stringify(citasGuardadas));
                }

                // Función para cargar citas desde localStorage
                function cargarCitas() {
                    const citasGuardadas = localStorage.getItem('citas');
                    if (citasGuardadas) {
                        const citas = JSON.parse(citasGuardadas);
                        citas.forEach(cita => {
                            calendar.addEvent({
                                title: cita.title,
                                start: cita.start,
                                end: cita.end,
                                backgroundColor: cita.backgroundColor || '#4F46E5',
                                borderColor: cita.borderColor || '#4F46E5',
                                textColor: cita.textColor || '#ffffff',
                                extendedProps: cita.extendedProps
                            });
                        });
                    }
                }

                // Inicializar calendario con las opciones existentes
                const calendar = new FullCalendar.Calendar(calendarEl, {
                    initialView: 'dayGridMonth',
                    locale: 'es',
                    headerToolbar: {
                        left: 'prev,next today',
                        center: 'title',
                        right: 'dayGridMonth,timeGridWeek,timeGridDay'
                    },
                    selectable: true,
                    select: function(info) {
                        const today = new Date();
                        today.setHours(0, 0, 0, 0);
                        const selectedDate = new Date(info.start);
                        
                        if (selectedDate < today) {
                            Swal.fire({
                                icon: 'error',
                                title: 'Fecha no válida',
                                text: 'No se pueden programar citas en fechas pasadas'
                            });
                            return;
                        }

                        fechaInput.value = info.startStr;
                        modal.classList.remove('hidden');
                    },
                    eventDidMount: function(info) {
                        // Guardar citas cada vez que se monta un evento
                        guardarCitas();
                    },
                    eventRemove: function() {
                        // Guardar citas cuando se elimina un evento
                        guardarCitas();
                    },
                    eventClick: function(info) {
                        const event = info.event;
                        Swal.fire({
                            title: 'Detalles de la Cita',
                            html: `
                                <div class="text-left">
                                    <p><strong>Doctor:</strong> ${event.title.split('-')[0]}</p>
                                    <p><strong>Paciente:</strong> ${event.title.split('-')[1]}</p>
                                    <p><strong>Fecha:</strong> ${event.start.toLocaleDateString()}</p>
                                    <p><strong>Hora:</strong> ${event.start.toLocaleTimeString([], {hour: '2-digit', minute:'2-digit'})}</p>
                                    <p><strong>Motivo:</strong> ${event.extendedProps?.motivo || 'No especificado'}</p>
                                </div>
                            `,
                            showDenyButton: true,
                            confirmButtonText: 'Cerrar',
                            denyButtonText: 'Eliminar',
                            denyButtonColor: '#dc3545'
                        }).then((result) => {
                            if (result.isDenied) {
                                event.remove();
                                Swal.fire('Cita eliminada', '', 'success');
                            }
                        });
                    }
                });

                calendar.render();

                // Cargar citas guardadas al iniciar
                cargarCitas();

                // Event Listeners
                openModalBtn.addEventListener('click', () => {
                    const today = new Date().toISOString().split('T')[0];
                    fechaInput.value = today;
                    modal.classList.remove('hidden');
                });

                closeModalBtn.addEventListener('click', closeModal);
                cancelBtn.addEventListener('click', closeModal);

                modal.addEventListener('click', (e) => {
                    if (e.target === modal) closeModal();
                });

                citaForm.addEventListener('submit', function(e) {
                    e.preventDefault(); // Evita el envío normal del formulario
                    const formData = new FormData(citaForm);

                    fetch("{{ route('citas.store') }}", {
                        method: 'POST',
                        body: formData,
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                        }
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            Swal.fire('¡Cita Registrada!', data.success, 'success');
                            // Agregar la cita al calendario
                            calendar.addEvent({
                                title: `${data.cita.doctor_id} - ${data.cita.paciente_id}`, // Ajusta según tus necesidades
                                start: data.cita.fecha + 'T' + data.cita.hora_inicio,
                                end: data.cita.fecha + 'T' + data.cita.hora_fin,
                                extendedProps: {
                                    motivo: data.cita.motivo
                                }
                            });
                            closeModal(); // Cerrar el modal después de agregar la cita
                        } else {
                            Swal.fire('Error', data.error, 'error');
                        }
                    })
                    .catch(error => {
                        Swal.fire('Error', 'Error al guardar la cita', 'error');
                    });
                });

                // Mejorar la visualización de los detalles de la cita
                calendar.setOption('eventClick', function(info) {
                    const event = info.event;
                    Swal.fire({
                        title: 'Detalles de la Cita',
                        html: `
                            <div class="text-left">
                                <p><strong>Doctor:</strong> ${event.title.split('-')[0]}</p>
                                <p><strong>Paciente:</strong> ${event.title.split('-')[1]}</p>
                                <p><strong>Fecha:</strong> ${event.start.toLocaleDateString()}</p>
                                <p><strong>Hora:</strong> ${event.start.toLocaleTimeString([], {hour: '2-digit', minute:'2-digit'})}</p>
                                <p><strong>Motivo:</strong> ${event.extendedProps.motivo}</p>
                            </div>
                        `,
                        confirmButtonText: 'Cerrar',
                        confirmButtonColor: '#3085d6'
                    });
                });
            });
        </script>
        
        <!-- Agregar SweetAlert2 para mejores alertas -->
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

        <!-- Agregar los estilos de animate.css para las animaciones -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">

        <style>
            /* Estilos adicionales para la animación */
            .swal2-popup {
                padding: 2em;
                border-radius: 15px;
            }

            .swal2-title {
                color: #4F46E5;
                font-size: 1.8em;
            }

            .swal2-timer-progress-bar {
                background: #4F46E5;
            }

            .animate__animated.animate__fadeInDown {
                --animate-duration: 0.5s;
            }

            .animate__animated.animate__fadeOutUp {
                --animate-duration: 0.3s;
            }

            /* Efecto de brillo para el botón de nueva cita */
            #openModalBtn {
                position: relative;
                overflow: hidden;
            }

            #openModalBtn::after {
                content: '';
                position: absolute;
                top: -50%;
                left: -50%;
                width: 200%;
                height: 200%;
                background: linear-gradient(
                    to right,
                    rgba(255,255,255,0) 0%,
                    rgba(255,255,255,0.3) 50%,
                    rgba(255,255,255,0) 100%
                );
                transform: rotate(45deg);
                animation: shine 3s infinite;
            }

            @keyframes shine {
                0% {
                    transform: translateX(-100%) rotate(45deg);
                }
                100% {
                    transform: translateX(100%) rotate(45deg);
                }
            }

            /* Animación para el dropdown */
            #dropdown-menu {
                transition: all 0.2s ease-out;
                transform-origin: top right;
            }

            #dropdown-menu:not(.hidden) {
                animation: dropdownAnimation 0.2s ease-out;
            }

            @keyframes dropdownAnimation {
                from {
                    opacity: 0;
                    transform: scale(0.95) translateY(-10px);
                }
                to {
                    opacity: 1;
                    transform: scale(1) translateY(0);
                }
            }

            /* Estilos para los items del dropdown */
            .group {
                transition: all 0.2s ease;
            }

            .group:hover svg {
                transform: scale(1.1);
            }
        </style>

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
    </body>
</x-app-layout>
