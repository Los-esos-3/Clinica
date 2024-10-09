<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>Lista de Expedientes</title>
</head>
<style>
    body {
    font-family: Arial, sans-serif;
    background-color: #f9f9f9;
    margin: 0;
    padding: 0;
}

.header {
    display: flex;
    justify-content: space-between;
    background-color: #d1d5db; /* bg-gray-300 */
    padding: 16px 32px; /* p-8 */
    margin-bottom: 16px; /* mb-4 */
    border: 1px solid #e5e7eb; /* border */
}

.header h2 {
    font-size: 1.5rem; /* text-xl */
    font-weight: 600; /* font-semibold */
    color: #1f2937; /* text-gray-800 */
}

.btn {
    padding: 8px 16px; /* px-4 py-2 */
    font-weight: bold;
    color: white;
    background-color: #3b82f6; /* bg-blue-500 */
    border-radius: 0.375rem; /* rounded */
    text-decoration: none;
}

.btn:hover {
    background-color: #2563eb; /* hover:bg-blue-700 */
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

.table {
    width: 100%;
    border-collapse: collapse;
}

.table th, .table td {
    padding: 12px 16px; /* px-6 py-4 */
    text-align: left;
    border-bottom: 1px solid #eaeaea;
}

.table th {
    background-color: #f9fafb; /* bg-gray-50 */
    text-transform: uppercase;
    font-weight: 600;
    font-size: 12px; /* text-xs */
}

.link {
    color: #3b82f6; /* text-blue-600 */
    text-decoration: none;
}

.link:hover {
    text-decoration: underline;
}

.inline-form {
    display: inline;
}

.delete {
    color: #dc2626; /* text-red-600 */
}

.delete:hover {
    color: #991b1b; /* hover:text-red-900 */
}

</style>
<body>
    <div class="header">
        <h2>Lista de Expedientes</h2>
        <a href="{{ route('Expedientes.create') }}" class="btn">
            Agregar Expediente
        </a>
    </div>

    <div class="container">
        <div class="card">
            <div class="overflow-x-auto">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Paciente</th>
                            <th>Doctor</th>
                            <th>Especialidad</th>
                            <th>Diagnóstico</th>
                            <th>Tratamiento</th>
                            <th>Antecedentes</th>
                            <th>Familiar A cargo</th>
                            <th>Número Del Familiar</th>
                            <th>Próxima Cita</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($expedientes as $expediente)
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
                                <td>
                                    @if($expediente->id)
                                        <a href="{{ route('Expedientes.edit', $expediente->id) }}" class="link edit">Editar</a>
                                    @else
                                        <span>Error: ID no disponible</span>
                                    @endif
                                    <form action="{{ route('Expedientes.destroy', $expediente->id) }}" method="POST" class="inline-form">
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
    </div>
</body>
</html>
