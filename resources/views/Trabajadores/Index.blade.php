<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        /* Estilos generales */
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }
        
        body {
            font-family: Arial, sans-serif;
            background-color: #f3f4f6;
            color: #333;
        }
        
        /* Layout principal */
        .app-container {
            display: flex;
            min-height: 100vh;
        }
        
        /* Sidebar */
        .sidebar {
            width: 250px;
            background-color: #1e293b;
            color: white;
            padding: 1rem;
            position: fixed;
            height: 100%;
            transition: all 0.3s;
        }
        
        /* Contenido principal */
        .main-content {
            margin-left: 250px;
            flex-grow: 1;
            padding: 1rem;
            transition: margin-left 0.3s;
        }
        
        /* Barra superior */
        .top-bar {
            background-color: #e5e7eb;
            padding: 1rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1rem;
        }
        
        .search-form {
            display: flex;
        }
        
        .search-input {
            padding: 0.5rem;
            border: 1px solid #ccc;
            border-radius: 4px 0 0 4px;
            width: 300px;
        }
        
        .search-button {
            background-color: #3b82f6;
            color: white;
            border: none;
            padding: 0.5rem 1rem;
            border-radius: 0 4px 4px 0;
            cursor: pointer;
        }
        
        .add-button {
            background-color: #3b82f6;
            color: white;
            padding: 0.5rem 1rem;
            border: none;
            border-radius: 4px;
            text-decoration: none;
            cursor: pointer;
        }
        
        /* Tarjetas de trabajadores */
        .workers-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 1.5rem;
            margin-top: 1rem;
        }
        
        .worker-card {
            background-color: white;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        
        .worker-header {
            display: flex;
            align-items: center;
            padding: 1rem;
            border-bottom: 1px solid #eee;
        }
        
        .worker-avatar {
            width: 60px;
            height: 60px;
            border-radius: 50%;
            background-color: #e5e7eb;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 1rem;
        }
        
        .worker-info {
            flex-grow: 1;
        }
        
        .worker-name {
            font-weight: bold;
            margin-bottom: 0.25rem;
        }
        
        .worker-phone {
            color: #666;
            font-size: 0.9rem;
        }
        
        .worker-content {
            padding: 1rem;
        }
        
        .worker-details {
            margin-bottom: 0.5rem;
        }
        
        .worker-actions {
            display: flex;
            justify-content: space-between;
            padding: 1rem;
            border-top: 1px solid #eee;
        }
        
        .action-button {
            padding: 0.5rem 1rem;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            color: white;
            background-color: #374151;
        }
        
        /* Mensaje cuando no hay trabajadores */
        .empty-message {
            text-align: center;
            padding: 2rem;
            color: #ef4444;
        }
        
        /* Responsive */
        @media (max-width: 768px) {
            .sidebar {
                width: 0;
                overflow: hidden;
            }
            
            .main-content {
                margin-left: 0;
            }
            
            .top-bar {
                flex-direction: column;
                gap: 1rem;
            }
            
            .search-form {
                width: 100%;
            }
            
            .search-input {
                width: 100%;
            }
        }
    </style>
</head>
<body>
    <div class="app-container">
        <!-- Sidebar -->
        <aside class="sidebar" id="sidebar">
            <!-- Contenido del sidebar -->
            <h2>Menú</h2>
            <!-- Aquí irían los elementos del menú -->
        </aside>

        <!-- Contenido principal -->
        <main class="main-content" id="main-content">
            <!-- Barra superior -->
            <div class="top-bar">
                <div class="left-section">
                    <button id="toggle-sidebar">☰</button>
                    <h2>Trabajadores</h2>
                </div>
                
                <form class="search-form">
                    <input type="text" class="search-input" placeholder="Buscar trabajador...">
                    <button type="submit" class="search-button">Buscar</button>
                </form>
                
                <a href="#" class="add-button">Agregar Trabajador</a>
            </div>
            
            <!-- Lista de trabajadores -->
            <div class="workers-container">
                <!-- Mensaje cuando no hay trabajadores -->
                <div class="empty-message">
                    No hay trabajadores registrados
                </div>
                
                <!-- Ejemplo de tarjeta de trabajador (se repetiría para cada trabajador) -->
                <div class="workers-grid">
                    <div class="worker-card">
                        <div class="worker-header">
                            <div class="worker-avatar">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                                    <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                                    <circle cx="12" cy="7" r="4"></circle>
                                </svg>
                            </div>
                            <div class="worker-info">
                                <div class="worker-name">Juan Pérez</div>
                                <div class="worker-phone">+1 234 567 890</div>
                            </div>
                        </div>
                        
                        <div class="worker-content">
                            <div class="worker-details">
                                <strong>Dirección:</strong> Calle Falsa 123
                            </div>
                            <div class="worker-details">
                                <strong>Fecha Nacimiento:</strong> 15/05/1985
                            </div>
                            <div class="worker-details">
                                <strong>Ocupación:</strong> Enfermero
                            </div>
                        </div>
                        
                        <div class="worker-actions">
                            <button class="action-button">Ver Detalles</button>
                            <button class="action-button">Editar</button>
                            <button class="action-button">Eliminar</button>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>

    <script>
        // Toggle sidebar en móviles
        document.getElementById('toggle-sidebar').addEventListener('click', function() {
            const sidebar = document.getElementById('sidebar');
            const mainContent = document.getElementById('main-content');
            
            if (sidebar.style.width === '0px' || !sidebar.style.width) {
                sidebar.style.width = '250px';
                mainContent.style.marginLeft = '250px';
            } else {
                sidebar.style.width = '0';
                mainContent.style.marginLeft = '0';
            }
        });
        
        // Búsqueda simulada
        document.querySelector('.search-form').addEventListener('submit', function(e) {
            e.preventDefault();
            const searchTerm = document.querySelector('.search-input').value.toLowerCase();
            alert('Buscando: ' + searchTerm);
            // Aquí iría la lógica real de búsqueda
        });
    </script>
</body>
</html>