<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Expedientes</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f0f2f5;
        }

        /* Estilos para la navegación */
        .nav {
            background-color: #333;
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
            background-color: #333;
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

        /* Estilos para el contenido */
        .content {
            padding: 20px;
            max-width: 1200px;
            margin: 0 auto;
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .btn {
            background-color: #007bff;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 5px;
            text-decoration: none;
        }

        .table-container {
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            text-align: left;
            padding: 12px 15px;
            border-bottom: 1px solid #e0e0e0;
        }

        th {
            background-color: #f8f9fa;
            font-weight: bold;
            color: #333;
        }

        tr:nth-child(even) {
            background-color: #f8f9fa;
        }

        tr:hover {
            background-color: #f1f3f5;
        }

        .actions {
            display: flex;
            gap: 10px;
        }

        .edit,
        .delete {
            padding: 5px 10px;
            border-radius: 3px;
            text-decoration: none;
        }

        .edit {
            background-color: #28a745;
            color: white;
        }

        .delete {
            background-color: #dc3545;
            color: white;
        }

        body {
            font-family: Arial, sans-serif;
            background-color: #f9f9f9;
            margin: 0;
            padding: 0;
        }

        .container {
            padding: 48px;
            max-width: 80%;
            margin: auto;
        }

        .card {
            overflow: hidden;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            background-color: white;
        }

        .title {
            font-size: 24px;
            font-weight: bold;
            margin: 16px;
        }

        .table {
            width: 100%;
            border-collapse: collapse;
        }

        .table th,
        .table td {
            padding: 12px 16px;
            text-align: left;
            border-bottom: 1px solid #eaeaea;
        }

        .table th {
            background-color: #f2f2f2;
            text-transform: uppercase;
            font-weight: 600;
            font-size: 12px;
        }

        .link {
            color: #eaeaea;
            text-decoration: none;
        }

        .link:hover {
            text-decoration: underline;
        }

        .inline-form {
            display: inline;
        }

        .delete {
            color: #dc3545;
            color: white;
        }
        .btn-agregar {
            display: inline-block;
            background-color: #28a745;
            color: white;
            padding: 10px 15px;
            border-radius: 5px;
            text-decoration: none;
            font-weight: bold;
            margin-bottom: 20px;
            transition: background-color 0.3s ease;
        }

        .btn-agregar:hover {
            background-color: #218838;
        }
    </style>    
</head>

<body>
    <nav class="nav">
        <div class="nav-container">
            <div class="nav-links">
                <a href="{{ route('dashboard') }}">Calendario</a>
                <a href="{{ route('Pacientes') }}">Pacientes</a>
                <a href="{{ route('Expedientes.index') }}">Expedientes</a>
                <a href="{{ route('ingresos.index') }}">Ingresos</a>
            </div>
            <div class="dropdown">
                <button class="dropbtn">{{ Auth::user()->name }}</button>
                <div class="dropdown-content">
                    <a href="{{ route('profile.show') }}">Perfil</a>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <a href="{{ route('logout') }}"
                            onclick="event.preventDefault(); this.closest('form').submit();">Cerrar Sesión</a>
                    </form>
                </div>
            </div>
        </div>
    </nav>
    <!DOCTYPE html>
    <html lang="es">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="styles.css">
        <title>Lista de Expedientes</title>
    </head>

    <body>
        <div class="container">
            <div class="card">
                <h1 class="title">Lista de Expedientes</h1>
                <a href="{{ route('Expedientes.create') }}" >Agregar Expediente</a>
                <table class="table">
                    <thead>
                        <tr>
                            <th>Paciente</th>
                            <th>Doctor</th>
                            <th>Especialidad</th>
                            <th>Diagnóstico</th>
                            <th>Tratamiento</th>
                            <th>Antecedentes</th>
                            <th>Farmiliar a Cargo</th>
                            <th>Numero de Familiar</th>
                            <th>Proxima cita</th>
                            <th>Hora de la cita</th>
                            <th>Fecha de Registro</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($expedientes as $expediente)
                            <tr>
                                <td>{{ $expediente->paciente->nombre }}</td>
                                <td>{{ $expediente->doctor }}</td>
                                <td>{{ $expediente->especialidad }}</td>
                                <td>{{ $expediente->diagnostico }}</td>
                                <td>{{ $expediente->tratamiento }}</td>
                                <td>{{ $expediente->antecedentes }}</td>
                                <td>{{ $expediente->familiar_a_cargo }}</td>
                                <td>{{ $expediente->numero_familiar }}</td>
                                <td>{{ $expediente->proxima_cita }}</td>
                                <td>{{ $expediente->hora_cita }}</td>
                                <td>{{$expediente->created_at}}</td>
                                <td class="flex">
                                    <button href="{{ route('Expedientes.edit', $expediente->id) }}"
                                        class="link edit">Editar</button>
                                    <form action="{{ route('Expedientes.destroy', $expediente->id) }}" method="POST"
                                        class="inline-form">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="link delete">Eliminar</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </body>

    </html>

</html>
