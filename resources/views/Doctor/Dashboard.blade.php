<x-app-layout>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Dashboard del Doctor</title>
        <link href='https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/5.10.1/main.min.css' rel='stylesheet' />
        <script src='https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/5.10.1/main.min.js'></script>
        <script src="{{ asset('js/app.js') }}"></script>
        <style>
            body {
                font-family: Arial, sans-serif;
                margin: 0;
                padding: 0;
                background-color: #f9f9f9;
            }
            .nav {
                background-color: rgb(55, 65, 81,1) !important;
                color: white;
                padding: 0.25rem;
                display: block;
                
            }
            .nav-container {
                display: flex;
                justify-content: space-between;
                align-items: center;
                max-width: 1200px;
                margin: 0 auto;
                padding: 1rem;
            }   
            .nav-links {
                display: flex;
                gap: 2rem;
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
            .container {
                display: flex;
                justify-content: space-between;
                width: 100%;
                max-width: 1200px;
                margin: 20px auto;
                padding: 0 20px;
            }
            .chart-container {
                width: 50%;
            }
            .table-container {
                width: 45%;
                border: 1px solid #ccc;
                padding: 10px;
                border-radius: 5px;
                box-shadow: 2px 2px 10px rgba(0, 0, 0, 0.1);
                background-color: #fff;
            }
            table {
                width: 100%;
                border-collapse: collapse;
                margin-bottom: 20px;
            }
            th, td {
                border: 1px solid #ddd;
                padding: 8px;
                text-align: left;
            }
            th {
                background-color: #f2f2f2;
            }
            .total-container {
                display: flex;
                justify-content: space-between;
                align-items: center;
                margin-top: 10px;
            }
            .btn-agregar {
                padding: 10px 15px;
                background-color: #007bff;
                color: white;
                border: none;
                border-radius: 5px;
                cursor: pointer;
                text-decoration: none;
            }
            .btn-agregar:hover {
                background-color: #0056b3;
            }
            #calendar-container {
                width: 100%;
                height: 800px; /* Ajuste esta altura según sus necesidades */
            }
                #calendar {
                    width: 100%;
                    height: 100%;
                }
            .today-soft {
                background-color: #e6f3ff !important; /* Un azul muy suave */
            }
            /* Pega aquí los estilos del calendario */
.fc-event-title, .fc-event-time {
    white-space: normal;
    overflow-wrap: break-word;
    word-wrap: break-word;
    font-size: 12px;
    text-align: left;
}

.fc-event {
    padding: 5px;
}

.fc-event div {
    display: flex;
    flex-direction: column;
}

        </style>
    </head>
    <body>
        <nav class="nav">
            <div class="nav-container">
                <div>
                    <x-application-logo />
                </div>
                <div class="nav-links">
                    <a href="{{ route('dashboard') }}">Calendario</a>
                    <a href="{{ route('Pacientes.PacientesView') }}">Pacientes</a>
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

        <div id="calendar"></div>

        <!-- Incluye los estilos de FullCalendar -->
        <link href="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/main.min.css" rel="stylesheet">
        <!-- Incluye las dependencias de FullCalendar -->
        <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/main.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/locales/es.js"></script>
        <!-- Incluye tu archivo app.js -->
        <script src="{{ asset('js/app.js') }}"></script>
        

    </body>
</x-app-layout>
