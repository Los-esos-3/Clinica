<x-app-layout>

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Dashboard</title>
        <script src='https://cdn.jsdelivr.net/npm/fullcalendar@5.10.2/main.min.js'></script>
        <script src='https://cdn.jsdelivr.net/npm/fullcalendar@5.10.2/locales/es.js'></script>
        <link href='https://cdn.jsdelivr.net/npm/fullcalendar@5.10.2/main.min.css' rel='stylesheet' />
        <style>
            /* Estilos del calendario */
            #calendar-secretaria {
                width: 100%;
                height: 600px;
                /* Altura del calendario */
                background-color: transparent;
                /* Eliminar el fondo blanco */
                border: none;
                /* Eliminar el borde */
                border-radius: 0;
                /* Eliminar el redondeo */
                padding: 0.5rem;
                box-shadow: none;
                /* Eliminar la sombra */
            }

            .fc-event {
                background-color: #e0e0e0;
                /* Color gris claro para los eventos */
                color: black;
                /* Cambiar el color del texto a negro */
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

            .container-arrow {
                position: absolute;
                top: 20px;
                margin-right: 90%;
            }

            /* Estilos responsivos para el tooltip */
            #tutorial-overlay .absolute {
                /* Posición para móviles */
                top: 20%;
                left: 50%;
                transform: translateX(-50%);

                /* Posición para pantallas medianas/grandes */
                @media (min-width: 768px) {
                    top: -10px;
                    left: 0px;
                    transform: none;
                    right: auto;
                }
            }

            /* Ajustes para pantallas muy pequeñas */
            @media (max-width: 400px) {
                #tutorial-overlay .absolute {
                    width: 95%;
                    min-width: auto;
                }
            }

            /* Estilos para el tutorial de la barra lateral */
            #sidebar-tutorial-overlay .absolute {
                top: 50%;
                left: 50%;
                transform: translate(-50%, -50%);
                width: 90%;
                max-width: 500px;
            }

            .sidebar-tutorial-indicator {
                width: 10px;
                height: 10px;
                border-radius: 50%;
                background-color: #d1d5db;
                display: inline-block;
            }

            .sidebar-tutorial-indicator.active {
                background-color: #3b82f6;
            }
        </style>

    </head>

    <body>
        <x-app-layout>
            @if (Auth::user()->hasAnyRole(['Root', 'Admin']))
                <div class="min-h-screen flex">
                    <aside>
                        <x-sidebar :user="Auth::user()" />
                    </aside>

                    <div class="flex-grow bg-gray-100 transition-all duration-300 ml-0 md:ml-64" id="content">

                        <div class="flex justify-between items-center p-3">

                            <div id="normal-btn" class="m-0 hidden">
                                <button id="toggle-sidebar" class="menu-button p-2.5">
                                    <i class="fa-solid fa-bars fa-lg"></i>
                                </button>
                            </div>

                            <!-- Botón de menú (fuera del modal) -->
                            <div id="tutorial-btn"
                            class="absolute -inset-4 rounded-full h-10 w-10 bg-white bg-opacity-20 animate-pulse"
                            style="top: 30px; left: 35px; transform: translate(-50%, -50%); z-index: 52;">
                            <!-- Botón de menú -->
                            <button id="toggle-sidebar" class="menu-button p-2.5">
                                <i class="fa-solid fa-bars fa-lg"></i>
                            </button>
                        </div>
                        
                            <!-- Agrega esto en tu HTML, preferiblemente cerca del botón de hamburguesa -->
                            <div id="tutorial-overlay"
                                class="fixed inset-0 hidden bg-black bg-opacity-75 z-50 flex items-center justify-center">
                                <div class="relative w-full h-full">
                                    <!-- Tooltip con posicionamiento responsivo -->
                                    <div class="absolute bg-white p-4 rounded-lg shadow-xl"
                                        style="min-width: 300px; max-width: 90%; top: 90px !important;">
                                        <div class="flex flex-col">
                                            <h3 class="font-bold text-gray-800 mb-2">Bienvenido a nuestro software</h3>
                                            <p class="text-sm text-gray-600 mb-2">
                                                Primera para empezar a optimizar tu consultorio, necesitas conocer tu
                                                entorno de trabajo
                                            </p>
                                            <p class="text-sm text-gray-600 font-semibold mb-2">Barra lateral de
                                                opciones</p>
                                            <p class="text-sm text-gray-600 mb-4">
                                                Has click en el icono para poder abrir la barra y moverte entre las
                                                opciones que ofrecemos
                                            </p>

                                            <div class="flex justify-end items-center text-sm">
                                                <button id="close-tutorial"
                                                    class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 transition">
                                                    Entendido
                                                </button>
                                            </div>
                                        </div>

                                        <!-- Flecha que apunta al ícono - posición responsiva -->
                                        <div
                                            class="absolute -right-3 top-1/2 transform -translate-y-1/2 rotate-90 md:rotate-0 md:right-full md:top-1/2 md:-mr-2">
                                            <svg width="20" height="30" viewBox="0 0 20 30" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path d="M20 15L0 0V30L20 15Z" fill="white" />
                                            </svg>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Agrega esto después del primer tutorial-overlay -->
                            <div id="sidebar-tutorial-overlay" class="fixed inset-0 hidden bg-black bg-opacity-75 z-50">
                                <div class="relative w-full h-full">
                                    <!-- Tooltip para las opciones de la barra lateral -->
                                    <div id="sidebar-tooltip" class="absolute bg-white p-4 rounded-lg shadow-xl hidden"
                                        style="min-width: 300px; max-width: 90%;">
                                        <div class="flex flex-col">
                                            <h3 id="sidebar-tooltip-title" class="font-bold text-gray-800 mb-2"></h3>
                                            <p id="sidebar-tooltip-content" class="text-sm text-gray-600 mb-4"></p>

                                            <!-- Indicadores de progreso -->
                                            <div class="flex justify-center space-x-2 mb-4">
                                                ${tutorialSteps.map((_, i) => `
                                                <span class="sidebar-tutorial-indicator ${i === 0 ? 'active' : ''}"
                                                    data-step="${i}"></span>
                                                `).join('')}
                                            </div>

                                            <div class="flex justify-between items-center text-sm">
                                                <button id="prev-sidebar-tutorial"
                                                    class="bg-gray-300 text-gray-800 px-4 py-2 rounded hover:bg-gray-400 transition hidden">
                                                    Anterior
                                                </button>
                                                <button id="next-sidebar-tutorial"
                                                    class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 transition">
                                                    Siguiente
                                                </button>
                                                <button id="close-sidebar-tutorial"
                                                    class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 transition hidden">
                                                    Finalizar
                                                </button>
                                            </div>
                                        </div>
                                        <!-- Flecha que apunta al elemento actual -->
                                        <div id="sidebar-tooltip-arrow"
                                            class="absolute w-6 h-6 transform rotate-45 bg-white"></div>
                                    </div>
                                </div>
                            </div>

                        </div>

                        <div class="p-6">
                            <!-- Calendario -->
                            <div id="admin-calendar"></div>
                        </div>

                        <!-- Modal para crear cita -->
                        <div id="newCitaModal"
                            class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden overflow-y-auto h-full w-full z-50">
                            <div class="relative top-20 mx-auto p-6 border w-[500px] shadow-2xl rounded-xl bg-white">
                                <div class="absolute top-0 right-0 pt-4 pr-4">
                                    <button id="closeNewCitaModalBtn"
                                        class="text-gray-400 hover:text-gray-500 transition-colores duration-200">
                                        <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M6 18L18 6M6 6l12 12" />
                                        </svg>
                                    </button>
                                </div>
                                <h3 class="text-2xl font-semibold text-gray-900 mb-4 text-center">Nueva Cita</h3>
                                <form id="newCitaForm" method="POST" action="{{ route('citas.store') }}">
                                    @csrf
                                    <div class="mb-4">
                                        <label for="fecha"
                                            class="block text-sm font-medium text-gray-700">Fecha</label>
                                        <input type="date" id="fecha" name="fecha" required
                                            class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-blue-500">
                                    </div>
                                    <div class="grid grid-cols-2 gap-4 mb-4">
                                        <div>
                                            <label for="hora_inicio"
                                                class="block text-sm font-medium text-gray-700">Hora
                                                Inicio</label>
                                            <input type="time" id="hora_inicio" name="hora_inicio" required
                                                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-blue-500">
                                        </div>
                                        <div>
                                            <label for="hora_fin" class="block text-sm font-medium text-gray-700">Hora
                                                Fin</label>
                                            <input type="time" id="hora_fin" name="hora_fin" required
                                                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-blue-500">
                                        </div>
                                    </div>
                                    <div class="mb-4">
                                        <label for="doctor_id"
                                            class="block text-sm font-medium text-gray-700">Doctor</label>
                                        <select name="doctor_id" id="doctor_id" required
                                            class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-blue-500">
                                            <option value="">Selecciona un doctor</option>
                                            @foreach ($doctores as $doctor)
                                                <option value="{{ $doctor->id }}">{{ $doctor->nombre_completo }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="mb-4">
                                        <label for="paciente_id"
                                            class="block text-sm font-medium text-gray-700">Paciente</label>
                                        <select name="paciente_id" id="paciente_id" required
                                            class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-blue-500">
                                            <option value="">Selecciona un paciente</option>
                                            @foreach ($pacientes as $paciente)
                                                <option value="{{ $paciente->id }}">{{ $paciente->nombre }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="mb-4">
                                        <label for="motivo"
                                            class="block text-sm font-medium text-gray-700">Motivo</label>
                                        <textarea name="motivo" id="motivo" required
                                            class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-blue-500"
                                            rows="3"></textarea>
                                    </div>
                                    <div class="flex justify-center mt-4">
                                        <button type="submit" id="closeModalOnSubmit"
                                            class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded transition duration-300 ease-in-out transform hover:scale-105">Programar
                                            Cita</button>
                                    </div>
                                </form>
                            </div>
                        </div>

                        <!-- Modal para mostrar detalles de la cita -->
                        <div id="detalleCitaModal"
                            class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden overflow-y-auto h-full w-full z-50">
                            <div class="relative top-20 mx-auto p-6 border w-[500px] shadow-2xl rounded-xl bg-white">
                                <div class="absolute top-0 right-0 pt-4 pr-4">
                                    <button id="closeDetalleModalBtn"
                                        class="text-gray-400 hover:text-gray-500 transition-colores duration-200">
                                        <svg class="h-6 w-6" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M6 18L18 6M6 6l12 12" />
                                        </svg>
                                    </button>
                                </div>
                                <h3 class="text-2xl font-semibold text-gray-900 mb-4 text-ñcenter">Detalles de la
                                    Cita
                                </h3>
                                <div id="detalleCitaContent" class="text-gray-700">
                                    <!-- Aquí se mostrarán los detalles de la cita -->
                                </div>
                                <div class="flex justify-center mt-4" id="deleteFormContainer">
                                    <!-- Este contenedor se actualizará dinámicamente con el botón de eliminar para la cita seleccionada -->
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            @else
                @role('Doctor')
                    <x-dashboard-doctor-component></x-dashboard-doctor-component>
                @endrole

                @role('Secretaria')
                    <x-dashboard-secretaria-component></x-dashboard-secretaria-component>
                @endrole
            @endif

        
        </x-app-layout>
    </body>

</x-app-layout>

@push('scripts')
    </script>
@endpush


<script>
    document.addEventListener('DOMContentLoaded', function() {
        // -------------------- ABRIR Y CERRAR MODAL DE NUEVA CITA --------------------
        const openCitaModalBtn = document.getElementById('openNewCitaModalBtn');
        const closeCitaModalBtn = document.getElementById('closeNewCitaModalBtn');
        const newCitaModal = document.getElementById('newCitaModal');
        const closeModalOnSubmitBtn = document.getElementById('closeModalOnSubmit');

        if (openCitaModalBtn && closeCitaModalBtn && newCitaModal) {
            openCitaModalBtn.addEventListener('click', function() {
                newCitaModal.classList.remove('hidden');
            });

            closeCitaModalBtn.addEventListener('click', function() {
                newCitaModal.classList.add('hidden');
            });

            // Cerrar modal haciendo clic fuera de él
            newCitaModal.addEventListener('click', function(event) {
                if (event.target === newCitaModal) {
                    newCitaModal.classList.add('hidden');
                }
            });

            // Cerrar modal al hacer clic en "Programar Cita"
            if (closeModalOnSubmitBtn) {
                closeModalOnSubmitBtn.addEventListener('click', function() {
                    newCitaModal.classList.add('hidden');
                    location.reload();
                });
            }
        }

        // -------------------- GUARDAR NUEVA CITA --------------------
        const newCitaForm = document.getElementById('newCitaForm');

        if (newCitaForm) {
            newCitaForm.addEventListener('submit', function(event) {
                event.preventDefault();

                let formData = new FormData(this);

                fetch("{{ route('citas.store') }}", {
                        method: "POST",
                        body: formData,
                        headers: {
                            "X-CSRF-TOKEN": document.querySelector('input[name="_token"]').value
                        }
                    })
                    .then(response => response.json())
                    .then(data => {
                        Swal.fire({
                            icon: 'success',
                            title: 'Cita creada correctamente',
                            showConfirmButton: false,
                            timer: 1500
                        });

                        newCitaModal.classList.add(
                            'hidden'); // Cierra el modal después de guardar la cita
                        location.reload(); // Recarga la página para actualizar el calendario
                    })
                    .catch(error => console.error("Error:", error));
            });
        }

        // -------------------- INICIALIZAR FULLCALENDAR --------------------
        let calendarEl = document.getElementById('admin-calendar');

        if (calendarEl) {
            let calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth',
                locale: 'es',
                events: @json($citas),
                eventClick: function(info) {
                    // Mostrar los detalles de la cita
                    const detalles = `
<p><strong>Doctor:</strong> ${info.event.extendedProps.doctor}</p>
<p><strong>Paciente:</strong> ${info.event.title}</p>
 <p><strong>Hora Inicio:</strong> ${info.event.start.toLocaleTimeString('es-ES', { hour: 'numeric', minute: '2-digit', hour12: true }).replace('a. m.', 'AM').replace('p. m.', 'PM')}</p>
<p><strong>Hora Fin:</strong> ${info.event.end.toLocaleTimeString('es-ES', { hour: 'numeric', minute: '2-digit', hour12: true }).replace('a. m.', 'AM').replace('p. m.', 'PM')}</p>
<p><strong>Motivo:</strong> ${info.event.extendedProps.motivo}</p>
`;
                    document.getElementById('detalleCitaContent').innerHTML = detalles;

                    // Obtener el ID de la cita seleccionada
                    const citaId = info.event.id;

                    // Crear el formulario de eliminación para la cita seleccionada
                    const deleteFormHtml = `
<form action="{{ route('citas.destroy', '') }}/${citaId}" method="POST">
    @csrf
    @method('DELETE')
    <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded transition duration-300 ease-in-out">
        Eliminar Cita
    </button>
</form>
`;

                    // Colocar el formulario en el contenedor
                    document.getElementById('deleteFormContainer').innerHTML = deleteFormHtml;

                    // Mostrar el modal
                    document.getElementById('detalleCitaModal').classList.remove('hidden');
                }
            });

            calendar.render();
        }

        // Agregar estilos personalizados directamente en el documento
        const style = document.createElement("style");
        style.innerHTML = `
/* Cambiar color de los números de los días */
.fc-daygrid-day-number {
color: black !important; /* Cambia el color a negro */
font-weight: bold;
}

.fc-direction-ltr .fc-daygrid-event.fc-event-end, .fc-direction-rtl .fc-daygrid-event.fc-event-start
{
cursor:pointer;
}

.fc-toolbar-title
{
margin-left:1px !important;
}

/* Cambiar color de los nombres de los días de la semana */
.fc-col-header-cell a {
color: black !important; /* Cambia el color del texto a negro */
text-decoration: none; /* Elimina el subrayado */
font-weight: bold;
}

`;
        document.head.appendChild(style);



        // -------------------- CERRAR MODAL DE DETALLE --------------------
        const closeDetalleModalBtn = document.getElementById('closeDetalleModalBtn');
        const detalleCitaModal = document.getElementById('detalleCitaModal');

        if (closeDetalleModalBtn && detalleCitaModal) {
            closeDetalleModalBtn.addEventListener('click', function() {
                detalleCitaModal.classList.add('hidden');
            });
        }



        // -------------------- MANEJAR DROPDOWN --------------------
        const dropdownButton = document.getElementById('options-menu');
        const dropdownMenu = document.getElementById('dropdown-menu');

        if (dropdownButton && dropdownMenu) {
            let isOpen = false;

            dropdownButton.addEventListener('click', () => {
                isOpen = !isOpen;
                dropdownMenu.classList.toggle('hidden', !isOpen);
                dropdownButton.setAttribute('aria-expanded', isOpen);
            });

            document.addEventListener('click', (event) => {
                if (!dropdownButton.contains(event.target) && !dropdownMenu.contains(event.target)) {
                    dropdownMenu.classList.add('hidden');
                    dropdownButton.setAttribute('aria-expanded', 'false');
                    isOpen = false;
                }
            });
        }
    });
</script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const sidebar = document.getElementById('sidebar');
        const content = document.getElementById('content');

        // Función para actualizar los estilos del contenido
        function updateContentStyles() {
            if (!sidebar.classList.contains('closed')) {
                // Si el sidebar está abierto, aplicar los estilos
                content.classList.add('md:ml-64');
            } else {
                // Si el sidebar está cerrado, quitar los estilos
                content.classList.remove('md:ml-64');
            }
        }

        // Escuchar cambios en el estado del sidebar
        const observer = new MutationObserver(function(mutationsList) {
            for (let mutation of mutationsList) {
                if (mutation.attributeName === 'class') {
                    updateContentStyles();
                }
            }
        });

        // Observar cambios en las clases del sidebar
        if (sidebar) {
            observer.observe(sidebar, {
                attributes: true
            });
        }

        // Inicializar los estilos al cargar la página
        updateContentStyles();
    });

    document.addEventListener('DOMContentLoaded', function() {
        // Mostrar el tutorial solo si es la primera vez
        if (!localStorage.getItem('tutorialCompleted')) {
            document.getElementById('tutorial-overlay').classList.remove('hidden');
            document.body.classList.add('overflow-hidden');
            // Mostrar SOLO el botón con resaltador durante el tutorial
            document.getElementById('tutorial-btn').classList.remove('hidden');
            document.getElementById('normal-btn').classList.add('hidden');

            document.getElementById('toggle-sidebar').addEventListener('click', function() {

            });


            document.addEventListener('DOMContentLoaded', function() {
                // Configuración del tutorial de la barra lateral
                const tutorialSteps = [{
                        title: "Inicio",
                        content: "Esta es la página principal del dashboard donde puedes ver un resumen de actividades.",
                        selector: "[data-tutorial='inicio']"
                    },
                    {
                        title: "Calendario",
                        content: "Aquí puedes gestionar todas las citas y eventos de la clínica. Podrás crear, editar y cancelar citas médicas.",
                        selector: "[data-tutorial='calendario']"
                    },
                    {
                        title: "Pacientes",
                        content: "Administra los registros de pacientes, historiales médicos y toda la información relevante de cada paciente.",
                        selector: "[data-tutorial='pacientes']"
                    },
                    {
                        title: "Doctores",
                        content: "Gestiona la información de los doctores, sus especialidades, horarios y disponibilidad.",
                        selector: "[data-tutorial='doctores']"
                    },
                    {
                        title: "Secretarías",
                        content: "Configura las opciones relacionadas con el personal administrativo y sus permisos.",
                        selector: "[data-tutorial='secretarias']"
                    },
                    {
                        title: "Trabajadores",
                        content: "Administra toda la información del personal de la clínica, incluyendo horarios y asignaciones.",
                        selector: "[data-tutorial='trabajadores']"
                    },
                    {
                        title: "Empresa",
                        content: "Configura los datos generales de la clínica o empresa, como información de contacto y configuración.",
                        selector: "[data-tutorial='empresa']"
                    },
                    {
                        title: "Perfil",
                        content: "Actualiza tu información personal, cambia tu contraseña y configura tus preferencias de cuenta.",
                        selector: "[data-tutorial='perfil']"
                    },
                    {
                        title: "Rol Actual",
                        content: "Aquí puedes ver y cambiar tu rol de acceso si tienes los permisos necesarios. Cada rol tiene diferentes privilegios.",
                        selector: "[data-tutorial='rol']"
                    }
                ];

                let currentStep = 0;
                const sidebarTutorialOverlay = document.getElementById('sidebar-tutorial-overlay');
                const sidebarTooltip = document.getElementById('sidebar-tooltip');
                const sidebarTooltipTitle = document.getElementById('sidebar-tooltip-title');
                const sidebarTooltipContent = document.getElementById('sidebar-tooltip-content');
                const prevButton = document.getElementById('prev-sidebar-tutorial');
                const nextButton = document.getElementById('next-sidebar-tutorial');
                const closeButton = document.getElementById('close-sidebar-tutorial');
                const sidebarTooltipArrow = document.getElementById('sidebar-tooltip-arrow');

                // Función para mostrar el paso actual del tutorial
                function showTutorialStep(stepIndex) {
                    const step = tutorialSteps[stepIndex];
                    const targetElement = document.querySelector(step.selector);

                    if (!targetElement) {
                        console.error("Elemento no encontrado:", step.selector);
                        return;
                    }

                    // Remover highlight de todos los elementos
                    document.querySelectorAll('[data-tutorial]').forEach(el => {
                        el.classList.remove('tutorial-highlight');
                        el.style.zIndex = '';
                    });

                    // Aplicar highlight al elemento actual
                    targetElement.classList.add('tutorial-highlight');
                    targetElement.style.zIndex = '100';

                    // Mostrar el overlay y el tooltip
                    sidebarTutorialOverlay.classList.remove('hidden');
                    sidebarTooltip.classList.remove('hidden');

                    // Actualizar contenido
                    sidebarTooltipTitle.textContent = step.title;
                    sidebarTooltipContent.textContent = step.content;

                    // Posicionar el tooltip cerca del elemento objetivo
                    positionTooltip(targetElement);

                    // Actualizar botones
                    prevButton.classList.toggle('hidden', stepIndex === 0);
                    nextButton.classList.toggle('hidden', stepIndex === tutorialSteps.length - 1);
                    closeButton.classList.toggle('hidden', stepIndex !== tutorialSteps.length - 1);

                    // Actualizar indicadores de progreso
                    updateProgressIndicators(stepIndex);
                }

                // Función para actualizar los indicadores de progreso
                function updateProgressIndicators(currentIndex) {
                    document.querySelectorAll('.sidebar-tutorial-indicator').forEach((indicator,
                        index) => {
                        if (index <= currentIndex) {
                            indicator.classList.add('active');
                        } else {
                            indicator.classList.remove('active');
                        }
                    });
                }

                // Función para posicionar el tooltip
                function positionTooltip(targetElement) {
                    const rect = targetElement.getBoundingClientRect();
                    const tooltipWidth = sidebarTooltip.offsetWidth;
                    const tooltipHeight = sidebarTooltip.offsetHeight;
                    const arrowSize = 12;
                    const padding = 20;

                    // Posicionar a la derecha del elemento por defecto
                    let left = rect.right + padding;
                    let top = rect.top + (rect.height / 2) - (tooltipHeight / 2);
                    let arrowPosition = 'right';

                    // Ajustar si se sale de la pantalla a la derecha
                    if (left + tooltipWidth > window.innerWidth) {
                        left = rect.left - tooltipWidth - padding;
                        arrowPosition = 'left';
                    }

                    // Ajustar si se sale por arriba o abajo
                    if (top < padding) {
                        top = padding;
                    } else if (top + tooltipHeight > window.innerHeight - padding) {
                        top = window.innerHeight - tooltipHeight - padding;
                    }

                    sidebarTooltip.style.left = `${left}px`;
                    sidebarTooltip.style.top = `${top}px`;

                    // Posicionar la flecha
                    sidebarTooltipArrow.style.display = 'block';

                    if (arrowPosition === 'right') {
                        sidebarTooltipArrow.style.left = 'auto';
                        sidebarTooltipArrow.style.right = `-${arrowSize/2}px`;
                        sidebarTooltipArrow.style.top = `${tooltipHeight/2 - arrowSize/2}px`;
                        sidebarTooltipArrow.style.transform = 'rotate(45deg)';
                    } else {
                        sidebarTooltipArrow.style.left = `-${arrowSize/2}px`;
                        sidebarTooltipArrow.style.right = 'auto';
                        sidebarTooltipArrow.style.top = `${tooltipHeight/2 - arrowSize/2}px`;
                        sidebarTooltipArrow.style.transform = 'rotate(45deg)';
                    }
                }

                // Evento para abrir el tutorial de la barra lateral
                document.getElementById('toggle-sidebar').addEventListener('click', function() {
                    if (!localStorage.getItem('sidebarTutorialCompleted') && !
                        sidebarTutorialOverlay.classList.contains('hidden')) {
                        return;
                    }

                    if (!localStorage.getItem('sidebarTutorialCompleted')) {
                        // Mostrar el sidebar si está oculto
                        const sidebar = document.getElementById('sidebar');
                        if (sidebar.classList.contains('closed')) {
                            sidebar.classList.remove('closed');
                        }

                        // Iniciar el tutorial después de un pequeño retraso para que el sidebar se abra
                        setTimeout(() => {
                            currentStep = 0;
                            showTutorialStep(currentStep);
                            document.body.classList.add('overflow-hidden');
                        }, 300);
                    }
                });

                // Navegación del tutorial
                nextButton.addEventListener('click', function() {
                    if (currentStep < tutorialSteps.length - 1) {
                        currentStep++;
                        showTutorialStep(currentStep);
                    }
                });

                prevButton.addEventListener('click', function() {
                    if (currentStep > 0) {
                        currentStep--;
                        showTutorialStep(currentStep);
                    }
                });

                closeButton.addEventListener('click', function() {
                    closeSidebarTutorial();
                });

                // Cerrar tutorial haciendo clic fuera del tooltip
                sidebarTutorialOverlay.addEventListener('click', function(e) {
                    if (e.target === sidebarTutorialOverlay) {
                        closeSidebarTutorial();
                    }
                });

                // Función para cerrar el tutorial
                function closeSidebarTutorial() {
                    sidebarTutorialOverlay.classList.add('hidden');
                    document.body.classList.remove('overflow-hidden');
                    localStorage.setItem('sidebarTutorialCompleted', 'true');

                    // Remover highlight de todos los elementos
                    document.querySelectorAll('[data-tutorial]').forEach(el => {
                        el.classList.remove('tutorial-highlight');
                        el.style.zIndex = '';
                    });
                }

                // Inicializar indicadores de progreso
                function initProgressIndicators() {
                    const indicatorsContainer = document.createElement('div');
                    indicatorsContainer.className = 'flex justify-center space-x-2 mb-4';

                    tutorialSteps.forEach((_, index) => {
                        const indicator = document.createElement('span');
                        indicator.className =
                            `sidebar-tutorial-indicator ${index === 0 ? 'active' : ''}`;
                        indicator.dataset.step = index;
                        indicatorsContainer.appendChild(indicator);
                    });

                    sidebarTooltip.insertBefore(indicatorsContainer, sidebarTooltip.querySelector(
                        '.flex.justify-between'));
                }

                // Llamar a la inicialización cuando el DOM esté listo
                initProgressIndicators();
            });

        } else {
            // Si ya completó el tutorial, mostrar SOLO el botón normal
            document.getElementById('tutorial-btn').classList.add('hidden');
            document.getElementById('normal-btn').classList.remove('hidden');
        }

        // Cerrar el tutorial
        document.getElementById('close-tutorial').addEventListener('click', function() {
            document.getElementById('tutorial-overlay').classList.add('hidden');
            document.body.classList.remove('overflow-hidden');
            // Cambiar al botón normal después de cerrar el tutorial
            document.getElementById('tutorial-btn').classList.add('hidden');
            document.getElementById('normal-btn').classList.remove('hidden');
            localStorage.setItem('tutorialCompleted', 'true');
        });

        // Posicionamiento dinámico en diferentes pantallas
        function positionTooltip() {
            const tooltip = document.querySelector('#tutorial-overlay .absolute');
            const menuButton = document.querySelector('.menu-button');

            if (window.innerWidth >= 768) {
                // Para pantallas grandes, posición fija como en la imagen
                tooltip.style.top = '50px';
                tooltip.style.left = '70px';
                tooltip.style.transform = 'none';
            } else {
                // Para móviles, centrado en la pantalla
                tooltip.style.top = '20%';
                tooltip.style.left = '50%';
                tooltip.style.transform = 'translateX(-50%)';
            }
        }



        // Ejecutar al cargar y al redimensionar
        positionTooltip();
        window.addEventListener('resize', positionTooltip);
    });
</script>

