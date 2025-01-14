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
            background-color: rgb(55, 65, 81,1) !important;
            color: white;
            padding: 1rem;
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
        
    </style>
</head>
<div class="container">
    <div class="p-6">
        <div class="flex justify-center">
            <ul class="flex">
           
                <li>
                    <a href="dashboard.html" class="inline-block p-4 border-b-2 rounded-t-lg no-underline text-zinc-950 active">
                        BIENVENIDA
                    </a>
                </li>
                <li>    
                    <a href="{{ route('doctores.index') }}" class="inline-block p-4 border-b-2 rounded-t-lg no-underline text-zinc-950">
                        DOCTORES
                    </a>
                </li>
                <li>
                    <a href="{{ route('secretarias.index') }}" class="inline-block p-4 border-b-2 rounded-t-lg no-underline text-zinc-950">
                        SECRETARIAS
                    </a>
                </li> 
                <li class="ml-1">
                    <a href="pacientes.html" class="inline-block p-4 border-b-2 rounded-t-lg no-underline text-zinc-950">
                        PACIENTES
                    </a>
                </li>
                <li class="ml-1">
                    <a href="ingresos.html" class="inline-block p-4 border-b-2 rounded-t-lg no-underline text-zinc-950">
                        INGRESOS
                    </a>
                </li>
                <li>
                    <a href="{{route('empresas.index')}}" class="inline-block p-4 border-b-2 rounded-t-lg no-underline text-zinc-950">
                        EMPRESA
                    </a>
                </li>
                
            </ul>
        </div>
    </div>
</div>
<body>
    <nav class="nav">
        <div class="nav-container">
            <div>
                @include('components.application-logo')
            </div>
            <div class="nav-links">
                <a href="{{ route('dashboard') }}">Calendario</a>
                <a href="{{ route('Pacientes') }}">Pacientes</a>
                <a href="{{ route('Expedientes.index') }}">Visitas</a>
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
                            <td>{{ $pacientesPorDepartamento->where('departamento', $ingreso->departamento)->first()->numero_pacientes ?? 0 }}</td>
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
                                    label += new Intl.NumberFormat('es-ES', { style: 'currency', currency: 'USD' }).format(context.parsed);
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
</html>
