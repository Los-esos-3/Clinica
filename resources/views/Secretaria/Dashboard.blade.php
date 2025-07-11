<x-app-layout>

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Dashboard Secretaria</title>
        <script src='https://cdn.jsdelivr.net/npm/fullcalendar@5.10.2/main.min.js'></script>
        <script src='https://cdn.jsdelivr.net/npm/fullcalendar@5.10.2/locales/es.js'></script>
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

            #admin-calendar {
                min-height: 600px;
                /* Aumenta la altura mínima */
                max-width: 100%;
                margin: 0 auto;
            }
        </style>
    </head>

    <body>
        <div class="min-h-screen flex">
            <aside>
                <x-sidebar :user="Auth::user()" />
            </aside>

            <div class="flex-grow bg-gray-100 transition-all duration-300 ml-0 md:ml-64" id="content">



                <div class="flex justify-between items-center p-3">
                    <!-- Botón de menú -->
                    <button id="toggle-sidebar" class="menu-button   p-3">
                        <i class="fa-solid fa-bars fa-lg"></i>
                    </button>





                    <!-- Botón "Nueva Cita" -->
                    <button id="openNewCitaModalBtn"
                        class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20"
                            fill="currentColor">
                            <path fill-rule="evenodd"
                                d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-11a1 1 0 10-2 0v2H7a1 1 0 100 2h2v2a1 1 0 102 0v-2h2a1 1 0 100-2h-2V7z"
                                clip-rule="evenodd" />
                        </svg>
                        Nueva Cita
                    </button>
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
                                <label for="fecha" class="block text-sm font-medium text-gray-700">Fecha</label>
                                <input type="date" id="fecha" name="fecha" required
                                    class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-blue-500">
                            </div>
                            <div class="grid grid-cols-2 gap-4 mb-4">
                                <div>
                                    <label for="hora_inicio" class="block text-sm font-medium text-gray-700">Hora
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
                                <label for="doctor_id" class="block text-sm font-medium text-gray-700">Doctor</label>
                                <input type="text" id="autocomplete-doctor" placeholder="Buscar doctor..." autocomplete="off" class="mb-2 block w-full border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-blue-500" />
                                <input type="hidden" name="doctor_id" id="doctor_id" required />
                                <ul id="doctor-suggestions" class="absolute bg-white border border-gray-300 rounded-md shadow-lg z-50 w-[90%] hidden"></ul>
                            </div>
                            <div class="mb-4">
                                <label for="paciente_id"
                                    class="block text-sm font-medium text-gray-700">Paciente</label>
                                <input type="text" id="autocomplete-paciente" placeholder="Buscar paciente..." autocomplete="off" class="mb-2 block w-full border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-blue-500" />
                                <input type="hidden" name="paciente_id" id="paciente_id" required />
                                <ul id="paciente-suggestions" class="absolute bg-white border border-gray-300 rounded-md shadow-lg z-50 w-[90%] hidden"></ul>
                            </div>
                            <div class="mb-4">
                                <label for="motivo" class="block text-sm font-medium text-gray-700">Motivo</label>
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
                                <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M6 18L18 6M6 6l12 12" />
                                </svg>
                            </button>
                        </div>
                        <h3 class="text-2xl font-semibold text-gray-900 mb-4 text-ñcenter">Detalles de la Cita</h3>
                        <div id="detalleCitaContent" class="text-gray-700">
                            <!-- Aquí se mostrarán los detalles de la cita -->
                        </div>
                        <div class="flex justify-center mt-4" id="deleteFormContainer">
                            <!-- Este contenedor se actualizará dinámicamente con el botón de eliminar para la cita seleccionada -->
                        </div>
                        <!-- ola -->

                    </div>
                </div>

            </div>
        </div>



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

                        // Validación de horario en el frontend
                        const fecha = document.getElementById('fecha').value;
                        const horaInicio = document.getElementById('hora_inicio').value;
                        const horaFin = document.getElementById('hora_fin').value;

                        // Convertir a objetos Date para comparar
                        const inicio = new Date(`${fecha}T${horaInicio}`);
                        const fin = new Date(`${fecha}T${horaFin}`);

                        if (!horaInicio || !horaFin || !fecha) {
                            Swal.fire({
                                icon: 'error',
                                title: 'Campos incompletos',
                            });
                            return;
                        }

                        if (fin <= inicio) {
                            Swal.fire({
                                icon: 'error',
                                title: 'Horario incorrecto',
                            });
                            return;
                        }

                        let formData = new FormData(this);

                        fetch("{{ route('citas.store') }}", {
                            method: "POST",
                            body: formData,
                            headers: {
                                "X-CSRF-TOKEN": document.querySelector('input[name=\"_token\"]').value
                            }
                        })
                        .then(async response => {
                            if (response.ok) {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Cita creada correctamente',
                                    showConfirmButton: false,
                                    timer: 1500
                                });
                                newCitaModal.classList.add('hidden');
                                location.reload();
                            } else if (response.status === 422) {
                                const data = await response.json();
                                let errorMsg = '';
                                for (const key in data.errors) {
                                    errorMsg += data.errors[key].join('<br>');
                                }
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Error de validación',
                                    html: errorMsg,
                                    confirmButtonText: 'Entendido'
                                });
                            } else {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Error',
                                    text: 'Ocurrió un error inesperado.',
                                    confirmButtonText: 'Entendido'
                                });
                            }
                        })
                        .catch(error => {
                            Swal.fire({
                                icon: 'error',
                                title: 'Error',
                                text: 'No se pudo conectar con el servidor.',
                                confirmButtonText: 'Entendido'
                            });
                            console.error("Error:", error);
                        });
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
                    window.myCalendar = calendar;
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

                const sidebar = document.getElementById('sidebar');
                if (sidebar) {
                    sidebar.addEventListener('transitionend', function() {
                        if (window.myCalendar) {
                            window.myCalendar.updateSize();
                        }
                    });
                }

                // --- AUTOCOMPLETADO PARA DOCTORES Y PACIENTES ---
                const doctores = [
                    @foreach ($doctores as $doctor)
                        { id: {{ $doctor->id }}, nombre: "{{ addslashes($doctor->nombre_completo) }}" },
                    @endforeach
                ];
                const pacientes = [
                    @foreach ($pacientes as $paciente)
                        { id: {{ $paciente->id }}, nombre: "{{ addslashes($paciente->nombre) }}" },
                    @endforeach
                ];

                function setupAutocomplete(inputId, suggestionsId, hiddenId, data) {
                    const input = document.getElementById(inputId);
                    const suggestions = document.getElementById(suggestionsId);
                    const hidden = document.getElementById(hiddenId);

                    function renderSuggestions(filtered) {
                        suggestions.innerHTML = '';
                        if (filtered.length === 0) {
                            suggestions.classList.add('hidden');
                            hidden.value = '';
                            return;
                        }
                        filtered.forEach(item => {
                            const li = document.createElement('li');
                            li.textContent = item.nombre;
                            li.className = 'px-4 py-2 cursor-pointer hover:bg-blue-100';
                            li.addEventListener('mousedown', function(e) {
                                e.preventDefault();
                                input.value = item.nombre;
                                hidden.value = item.id;
                                suggestions.classList.add('hidden');
                            });
                            suggestions.appendChild(li);
                        });
                        suggestions.classList.remove('hidden');
                    }

                    input.addEventListener('input', function() {
                        const value = this.value.toLowerCase();
                        if (!value) {
                            renderSuggestions(data); // Mostrar todos si no hay texto
                        } else {
                            const filtered = data.filter(item => item.nombre.toLowerCase().includes(value));
                            renderSuggestions(filtered);
                        }
                    });

                    // Mostrar todos al hacer focus o clic
                    input.addEventListener('focus', function() {
                        renderSuggestions(data);
                    });
                    input.addEventListener('click', function() {
                        renderSuggestions(data);
                    });

                    // Ocultar sugerencias al perder foco
                    input.addEventListener('blur', function() {
                        setTimeout(() => suggestions.classList.add('hidden'), 100);
                    });
                }
                setupAutocomplete('autocomplete-doctor', 'doctor-suggestions', 'doctor_id', doctores);
                setupAutocomplete('autocomplete-paciente', 'paciente-suggestions', 'paciente_id', pacientes);
            });
        </script>

        <script>
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
                                title: "Personal",
                                content: "Administra toda la información del personal de la clínica, incluyendo horarios y asignaciones.",
                                selector: "[data-tutorial='Personal']"
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

        <script>
            window.addEventListener('load', function() {
                setTimeout(function() {
                    if (window.myCalendar) window.myCalendar.updateSize();
                }, 200);
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
                background: linear-gradient(to right,
                        rgba(255, 255, 255, 0) 0%,
                        rgba(255, 255, 255, 0.3) 50%,
                        rgba(255, 255, 255, 0) 100%);
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


    </body>
</x-app-layout>
