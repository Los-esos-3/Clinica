<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gráfica de Ingresos</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f9f9f9;
        }

        .nav {
            background-color: rgb(55, 65, 81, 1) !important;
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

        th,
        td {
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
                    id="options-menu" aria-expanded="true" aria-haspopup="true">
                    <span class="mr-2">{{ Auth::user()->name }}</span>
                    <!-- Icono de flecha -->
                    <svg class="-mr-1 ml-2 h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                        fill="currentColor">
                        <path fill-rule="evenodd"
                            d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                            clip-rule="evenodd" />
                    </svg>
                </button>

                <!-- Menú desplegable -->
                <div id="dropdown-menu"
                    class="hidden origin-top-right absolute right-0 mt-2 w-48 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 divide-y divide-gray-100"
                    role="menu" aria-orientation="vertical" aria-labelledby="options-menu">
                    <div class="py-1" role="none">
                        <a href="{{ route('profile.show') }}"
                            class="group flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 hover:text-gray-900"
                            role="menuitem">
                            <svg class="mr-3 h-5 w-5 text-gray-400 group-hover:text-gray-500"
                                xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z"
                                    clip-rule="evenodd" />
                            </svg>
                            Perfil
                        </a>
                    </div>
                    <div class="py-1" role="none">
                        <form method="POST" autocomplete="on" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit"
                                class="group flex w-full items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 hover:text-gray-900"
                                role="menuitem">
                                <svg class="mr-3 h-5 w-5 text-gray-400 group-hover:text-gray-500"
                                    xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd"
                                        d="M3 3a1 1 0 00-1 1v12a1 1 0 102 0V4a1 1 0 00-1-1zm10.293 9.293a1 1 0 001.414 1.414l3-3a1 1 0 000-1.414l-3-3a1 1 0 10-1.414 1.414L14.586 9H7a1 1 0 100 2h7.586l-1.293 1.293z"
                                        clip-rule="evenodd" />
                                </svg>
                                Cerrar Sesión
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </nav>


    <div class="container">
        <div class="chart-container">
            <h2>Ingresos por Departamento</h2>
            <canvas id="graficaIngresos"></canvas>
        </div>

        <div class="table-container">
            <div class="total-container">
                <h2>Datos de Ingresos</h2>
                <a href="{{ route('ingresos.create') }}" class="btn-agregar">Agregar Ingreso</a>
            </div>
            <table>
                <thead>
                    <tr>
                        <th>Departamento</th>
                        <th>Numero de Pacientes</th>
                        <th>Ingresos</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($ingresos as $ingreso)
                        <tr>
                            <td>{{ $ingreso->departamento }}</td>
                            <td>{{ $pacientesPorDepartamento->where('departamento', $ingreso->departamento)->first()->numero_pacientes ?? 0 }}
                            </td>
                            <td>${{ number_format($ingreso->total, 2) }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3">No hay ingresos registrados.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
            <div class="total-container">
                <strong>Total Ingresos:</strong>
                <span>${{ number_format($ingresos->sum('total'), 2) }}</span>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels"></script>
    <script>
        var ctx = document.getElementById('graficaIngresos').getContext('2d');
        var chart = new Chart(ctx, {
            type: 'pie',
            data: {
                labels: {!! json_encode($departamentos) !!},
                datasets: [{
                    label: 'Ingresos',
                    backgroundColor: [
                        'rgba(75, 192, 192, 0.6)',
                        'rgba(255, 99, 132, 0.6)',
                        'rgba(255, 205, 86, 0.6)',
                        'rgba(54, 162, 235, 0.6)',
                        'rgba(153, 102, 255, 0.6)'
                    ],
                    borderColor: 'rgba(255, 255, 255, 1)',
                    borderWidth: 1,
                    data: {!! json_encode($totales) !!},
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top',
                    },
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                let label = context.label || '';
                                if (label) {
                                    label += ': ';
                                }
                                if (context.parsed !== null) {
                                    label += new Intl.NumberFormat('es-ES', {
                                        style: 'currency',
                                        currency: 'USD'
                                    }).format(context.parsed);
                                }
                                return label;
                            }
                        }
                    },
                    datalabels: {
                        color: 'black',
                        font: {
                            weight: 'bold'
                        },
                        formatter: (value, ctx) => {
                            let sum = 0;
                            let dataArr = ctx.chart.data.datasets[0].data;
                            dataArr.map(data => {
                                sum += parseFloat(data);
                            });
                            let percentage = (value * 100 / sum).toFixed(2) + "%";
                            return percentage;
                        },
                    }
                }
            },
            plugins: [ChartDataLabels]
        });
    </script>
</body>
<script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels"></script>
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

</html>
