<x-app-layout>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Arial', sans-serif;
        }

        /* Estilos para la barra de navegación */
        .nav-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background-color: #f8f9fa;
            padding: 1rem 2rem;
            border-bottom: 1px solid #dee2e6;
            width: 100%;
        }

        .nav-left {
            display: flex;
            align-items: center;
        }

        .nav-right {
            display: flex;
            align-items: center;
            gap: 2rem;
        }

        .dashboard-title {
            font-size: 1.5rem;
            font-weight: 600;
            color: #2c3e50;
            margin: 0;
        }

        .current-date {
            color: #7f8c8d;
            font-size: 1rem;
        }

        .logout-button {
            background: none;
            border: none;
            color: #7f8c8d;
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            transition: all 0.2s;
            padding: 0.5rem 1rem;
            border-radius: 5px;
            font-size: 1rem;
        }

        .logout-button:hover {
            color: #e74c3c;
            background-color: #f2f2f2;
        }

        .logout-button i {
            font-size: 1.2rem;
        }

        /* Estilos del dashboard */
        .dashboard-content {
            padding: 2rem;
            max-width: 1400px;
            margin: 0 auto;
        }

        .stats-container {
            display: flex;
            gap: 2rem;
            flex-wrap: wrap;
            margin-bottom: 3rem;
        }

        .stat-card {
            background: white;
            border-radius: 10px;
            padding: 2rem;
            flex: 1;
            min-width: 300px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s;
        }

        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.15);
        }

        .stat-card h2 {
            font-size: 1.2rem;
            color: #555;
            margin-bottom: 1rem;
        }

        .stat-card .value {
            font-size: 2.5rem;
            font-weight: bold;
            color: #2c3e50;
        }

        .stat-card.today {
            border-top: 4px solid #3498db;
        }

        .stat-card.month {
            border-top: 4px solid #2ecc71;
        }

        .stat-card.year {
            border-top: 4px solid #e74c3c;
        }

        /* Estilos para las secciones de gestión */
        .management-section {
            background: white;
            border-radius: 10px;
            padding: 2rem;
            margin-bottom: 2rem;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .section-title {
            font-size: 1.5rem;
            color: #2c3e50;
            margin-bottom: 1.5rem;
            padding-bottom: 0.5rem;
            border-bottom: 2px solid #ecf0f1;
        }

        .btn {
            padding: 0.5rem 1rem;
            border-radius: 5px;
            font-weight: 500;
            transition: all 0.2s;
            text-decoration: none;
            display: inline-block;
            margin-bottom: 1rem;
        }

        .btn-primary {
            background-color: #3498db;
            color: white;
            border: none;
        }

        .btn-primary:hover {
            background-color: #2980b9;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 1rem;
        }

        th,
        td {
            padding: 1rem;
            text-align: left;
            border-bottom: 1px solid #ecf0f1;
        }

        th {
            background-color: #f8f9fa;
            font-weight: 600;
            color: #2c3e50;
        }

        .badge {
            display: inline-block;
            padding: 0.25rem 0.5rem;
            border-radius: 50px;
            font-size: 0.8rem;
            font-weight: 500;
            margin-right: 0.5rem;
            margin-bottom: 0.5rem;
        }

        .bg-primary {
            background-color: #3498db;
            color: white;
        }

        .bg-info {
            background-color: #17a2b8;
            color: white;
        }

        .alert {
            padding: 1rem;
            border-radius: 5px;
            margin-bottom: 1rem;
        }

        .alert-success {
            background-color: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }

        @media (max-width: 768px) {
            .nav-container {
                flex-direction: column;
                align-items: flex-start;
                gap: 1rem;
                padding: 1rem;
            }

            .nav-right {
                width: 100%;
                justify-content: space-between;
            }

            .stat-card {
                min-width: 100%;
            }
        }

        .pagination {
            justify-content: end;
            margin-right: 30px;
        }
    </style>

    <div class="min-h-screen bg-gray-100">
        <!-- Barra de navegación -->
        <div class="nav-container">
            <div class="nav-left">
                <h2 class="dashboard-title">
                    {{ __('Dashboard Root') }}
                </h2>
            </div>

            <div class="nav-right">
                <div class="current-date" id="current-date"></div>

                <div>
                    <a class="list-none no-underline gap-1 text-gray-500" href="{{ route('welcome') }}"><i class="fa-solid fa-house  mr-2"></i><span>Inicio</span></a>
                </div>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="logout-button">
                        <i class="fas fa-sign-out-alt"></i>
                        <span>Cerrar sesión</span>
                    </button>
                </form>
            </div>
        </div>

        <!-- Contenido principal -->
        <div class="dashboard-content">
            <!-- Estadísticas -->
            <div class="stats-container">
                <div class="stat-card today">
                    <h2>Usuarios Registrados (Hoy)</h2>
                    <div class="value">{{ $userStats['today'] }}</div>
                </div>

                <div class="stat-card month">
                    <h2>Usuarios Registrados (Mes)</h2>
                    <div class="value">{{ $userStats['month'] }}</div>
                </div>

                <div class="stat-card year">
                    <h2>Usuarios Registrados (Año)</h2>
                    <div class="value">{{ $userStats['year'] }}</div>
                </div>
            </div>


            <!-- Gestión de Roles -->
            <div class="management-section">
                <h3 class="section-title">Gestión de Roles</h3>

                @if (session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif

                @can('crear roles')
                    <a href="{{ route('roles.create') }}" class="btn btn-primary">
                        Crear Nuevo Rol
                    </a>
                @endcan

                <table>
                    <thead>
                        <tr>
                            <th>Rol</th>
                            <th>Permisos</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($roles as $role)
                            <tr>
                                <td><strong>{{ $role->name }}</strong></td>
                                <td>
                                    @foreach ($role->permissions as $permission)
                                        <span class="badge bg-primary">{{ $permission->name }}</span>
                                    @endforeach
                                </td>
                                <td>
                                    <a href="{{ route('roles.edit', $role->id) }}"
                                        class="btn btn-sm btn-warning">Editar</a>
                                    <form action="{{ route('roles.destroy', $role) }}" method="POST"
                                        style="display: inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger"
                                            onclick="return confirm('¿Estás seguro?')">Eliminar</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Gestión de Usuarios -->
            <div class="management-section">
                <h3 class="section-title">Gestión de Usuarios y Roles</h3>

                <table>
                    <thead>
                        <tr>
                            <th>Nombre</th>
                            <th>Roles Actuales</th>
                            <th>Asignar Roles</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                            <tr>
                                <td>{{ $user->name }}</td>
                                <td>
                                    @foreach ($user->roles as $role)
                                        <span class="badge bg-info">{{ $role->name }}</span>
                                    @endforeach
                                </td>
                                <td>
                                    <a href="{{ route('roles.assign', $user->id) }}"
                                        class="btn btn-sm btn-primary">Asignar Roles</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <div class="mt-4">
                    {{ $users->links() }}
                </div>
            </div>
        </div>
    </div>

    <!-- Scripts y dependencias -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Fecha actual
            const now = new Date();
            document.getElementById('current-date').textContent = now.toLocaleDateString('es-ES', {
                weekday: 'long',
                year: 'numeric',
                month: 'long',
                day: 'numeric'
            });

            // Simulación de carga de datos (en producción usaría fetch)
            setTimeout(() => {
                // Estos valores vendrían de tu API en una implementación real
                document.getElementById('users-today').textContent = '24';
                document.getElementById('users-month').textContent = '452';
                document.getElementById('users-year').textContent = '5,280';
            }, 500);
        });
    </script>
</x-app-layout>
