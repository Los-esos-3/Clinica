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
            }

            .fc-event {
                background-color: #B0B0B0;
                color: white;
                border-radius: 5px;
                padding: 5px;
                font-size: 12px;
            }

            .fc-event-title {
                font-size: 12px;
                font-weight: bold;
            }

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

        <script>
            document.addEventListener('DOMContentLoaded', function () {
                const calendarEl = document.getElementById('calendar-secretaria');

                const calendar = new FullCalendar.Calendar(calendarEl, {
                    initialView: 'dayGridMonth',
                    locale: 'es',
                    headerToolbar: {
                        left: 'prev,next today',
                        center: 'title',
                        right: 'dayGridMonth,timeGridWeek,timeGridDay'
                    },
                    events: '/expedientes/citas', // Endpoint para obtener las citas
                    eventContent: function (info) {
                        const paciente = truncateText(info.event.extendedProps.paciente, 20); // Trunca nombres largos
                        const doctor = truncateText(info.event.extendedProps.doctor, 20);   // Trunca nombres largos

                        const container = document.createElement('div');
                        container.innerHTML = `
                            <div style="line-height: 1.2; font-size: 12px;">
                                <strong>Paciente:</strong> ${paciente}<br>
                                <strong>Doctor:</strong> ${doctor}<br>
                                <strong>Hora:</strong> ${info.event.start.toLocaleTimeString([], { hour: '2-digit', minute: '2-digit', hour12: true })}
                            </div>
                        `;
                        return { domNodes: [container] };
                    },
                    eventClick: function(info) {
                        alert('Cita con ' + info.event.extendedProps.paciente + ' a las ' + info.event.start.toLocaleTimeString([], { hour: '2-digit', minute: '2-digit', hour12: true }));
                    }
                });

                calendar.render();
            });
            function truncateText(text, maxLength) {
                if (text.length > maxLength) {
                    return text.substring(0, maxLength) + '...';
                }
                return text;
            }
        </script>
    </body>
</x-app-layout>
