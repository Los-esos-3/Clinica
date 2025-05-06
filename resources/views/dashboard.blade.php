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

                        {{-- <div class="flex justify-between items-center p-3">

                            <div class="absolute -inset-4 rounded-full bg-white bg-opacity-20 animate-pulse"
                                style="top: 30px; left: 40px; transform: translate(-50%, -50%); z-index: 52;">
                                <!-- Botón de menú --> --}}
                                <button id="toggle-sidebar" class="menu-button p-3">
                                    <i class="fa-solid fa-bars fa-lg"></i>
                                </button>
                            {{-- </div> --}}

                            {{-- <!-- Agrega esto en tu HTML, preferiblemente cerca del botón de hamburguesa -->
                            <div id="tutorial-overlay"
                                class="fixed inset-0 bg-black bg-opacity-75 z-50  flex items-center justify-center">
                                <div class="relative">

                                    <!-- Tooltip centrado -->
                                    <div class="absolute w-64 bg-white p-4 rounded-lg shadow-xl"
                                        style="min-width: 300px; top: -350px; right: 550px ;">
                                        <div class="flex flex-col">
                                            <h3 class="font-bold text-gray-800 mb-2">Bienvenido a nuestro software</h3>
                                            <p class="text-sm text-gray-600 mb-2">Primera para empezar a optimizar tu consultorio, necesitas conocer
                                                tu entorno de trabajo
                                            </p>
                                            <p class="text-sm text-gray-600 font-semibold mb-2">Barra lateral de opciones</p>
                                            <p class="text-sm text-gray-600 mb-4">Has click en el icono para poder abrir la barra y moverte entre las opciones que ofrecemos</p>

                                            <div class="flex justify-between items-center text-sm">
                                                <span>1/1</span>
                                                <button id="close-tutorial"
                                                    class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 transition">
                                                    Entendido
                                                </button>
                                            </div>
                                        </div>

                                        <!-- Flecha que apunta al ícono -->
                                        <div style="top: -16px; left: -0px; rotate: 248deg;" class="absolute right-full top-1/2 transform -translate-y-1/2 mr-2">
                                            <svg width="20" height="30" viewBox="0 0 20 30" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path d="M20 15L0 0V30L20 15Z" fill="white" />
                                            </svg>
                                        </div>
                                    </div>
                                </div>
                            </div>


                        </div> --}}

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
                                            class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-blue-500" rows="3"></textarea>
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
</script>
