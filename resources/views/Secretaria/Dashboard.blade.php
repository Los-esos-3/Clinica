<x-app-layout>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Dashboard Secretaria</title>
        <script src='https://cdn.jsdelivr.net/npm/fullcalendar@5.10.2/main.min.js'></script>
        <link href='https://cdn.jsdelivr.net/npm/fullcalendar@5.10.2/main.min.css' rel='stylesheet' />
        <style>
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
                background-color: rgb(175, 175, 175);
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
                box-shadow: 0px 8px 16px 0px rgba(0, 0, 0, 0.2);
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
            .Container-img {
                display: flex;
                align-items: center;
            }
            #calendar1 {
                width: 100%;
                height: 800px;
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
        
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div id="calendar1" style="height: 800px;"></div>
                </div>
            </div>
        </div>
        
        <script>
        document.addEventListener('DOMContentLoaded', function() {
            var calendarEl1 = document.getElementById('calendar1');
            var calendar1 = new FullCalendar.Calendar(calendarEl1, {
                initialView: 'dayGridMonth',
                headerToolbar: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'dayGridMonth,timeGridWeek,timeGridDay'
                },
                height: 'auto',
                aspectRatio: 1.35,
                contentHeight: 'auto',
                events: '/get-citas',
                locale: 'es',
                firstDay: 1,
                dayHeaderFormat: { weekday: 'short' },
                buttonText: {
                    today: 'Hoy',
                    month: 'Mes',
                    week: 'Semana',
                    day: 'Día'
                },
                views: {
                    dayGridMonth: {
                        dayHeaderFormat: { weekday: 'short' }
                    }
                },
                eventContent: function(arg) {
                    var eventElement = document.createElement('div');
                    eventElement.classList.add('fc-event-main-frame');

                    var titleElement = document.createElement('div');
                    titleElement.classList.add('fc-event-title-container');

                    var titleText = document.createElement('div');
                    titleText.classList.add('fc-event-title', 'fc-sticky');

                    var titleParts = arg.event.title.split(' - Dr. ');
                    var pacienteName = titleParts[0];
                    var doctorName = titleParts[1] || '';

                    var pacienteElement = document.createElement('div');
                    pacienteElement.innerHTML = '<strong>Paciente:</strong> ' + pacienteName;
                    pacienteElement.style.fontWeight = 'normal';

                    var doctorElement = document.createElement('div');
                    doctorElement.innerHTML = '<strong>Doctor:</strong> Dr. ' + doctorName;
                    doctorElement.style.fontSize = '0.9em';

                    var horaElement = document.createElement('div');
                    horaElement.innerHTML = '<strong>Hora:</strong> ' + (arg.event.extendedProps.horaFormateada || '');
                    horaElement.style.fontSize = '0.9em';

                    titleText.appendChild(pacienteElement);
                    titleText.appendChild(doctorElement);
                    titleText.appendChild(horaElement);

                    titleElement.appendChild(titleText);
                    eventElement.appendChild(titleElement);

                    return { domNodes: [eventElement] };
                },
                eventDidMount: function(info) {
                    info.el.style.height = 'auto';
                    info.el.style.minHeight = '2em'; 
                }
            });
            calendar1.render();

            var style = document.createElement('style');
            style.textContent = `
                .fc-theme-standard .fc-toolbar,
                .fc-theme-standard .fc-view-harness {
                    background-color: white;
                }
                .fc .fc-button-primary {
                    background-color: #f0f0f0;
                    border-color: #d0d0d0;
                    color: black;
                }
                .fc .fc-button-primary:hover {
                    background-color: #e0e0e0;
                    border-color: #c0c0c0;
                }
                .fc .fc-button-primary:not(:disabled).fc-button-active,
                .fc .fc-button-primary:not(:disabled):active {
                    background-color: #d0d0d0;
                    border-color: #b0b0b0;
                    color: black;
                }
                .fc-daygrid-day-number,
                .fc-col-header-cell-cushion,
                .fc-daygrid-day-top {
                    color: black !important;
                }
                .fc-day-today {
                    background-color: #f8f8f8 !important;
                }
                .fc-event {
                    background-color: #f0f0f0;
                    border-color: #d0d0d0;
                    color: black;
                }
                .fc-event-title,
                .fc-event-time {
                    color: black;
                }
            `;
            document.head.appendChild(style);
        });
        </script>
    </body>
</x-app-layout> 