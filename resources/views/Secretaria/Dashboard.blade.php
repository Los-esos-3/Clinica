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
            .fc-header-toolbar {
                margin-bottom: 1.5em;
                padding: 1em 0;
            }
            .fc-day-header {
                background-color: #f8f9fa;
                padding: 10px 0;
            }
            .fc-day-number {
                font-size: 1.2em;
            }
            .fc-event {
                border: 1px solid #3788d8;
                background-color: #3788d8;
            }
            .fc-col-header-cell {
                background-color: #f8f9fa;
                padding: 10px 0;
            }
            .fc-col-header-cell-cushion {
                padding: 8px;
                font-weight: bold;
                color: #333;
                font-size: 0.9em;
                padding: 8px 4px;
            }
            .fc-day-sat, .fc-day-sun {
                background-color: #f0f0f0;
            }
            .fc-button-primary {
                background-color: #007bff;
                border-color: #007bff;
            }
            .fc-button-primary:hover {
                background-color: #0056b3;
                border-color: #0056b3;
            }
            .fc-day-header {
                height: 30px;
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
                    <a href="{{ route('Pacientes') }}">Pacientes</a>
                    <a href="{{ route('Pacientes') }}">Expedientes</a>
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
            events: [
                { title: 'Evento de ejemplo', start: '2024-03-15' }
            ],
            locale: 'es',
            firstDay: 1, // Empieza la semana en lunes
            dayHeaderFormat: { weekday: 'short' }, // Usa abreviaturas: lun, mar, mié, etc.
            views: {
                dayGridMonth: {
                    dayHeaderFormat: { weekday: 'short' } // Nombre corto para la vista mensual
                }
            }
        });
        calendar1.render();
    });
</script>
    </body>
    </x-app-layout>
