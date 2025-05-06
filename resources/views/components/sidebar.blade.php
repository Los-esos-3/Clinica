<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>

<div class="sidebar-container">
    <!-- Sidebar -->
    <div id="sidebar" class="sidebar closed">
        <div class="empresa-container">
            <x-application-logo></x-application-logo>
        </div>

        <!-- Menú principal -->
        <ul
            class="sidebar-menu {{ Auth::user()->hasAnyRole(['Admin', 'Root']) ? 'admin-menu' : 'doctor-secretaria-menu' }}">
            <li><a href="{{ route('welcome') }}"><i class="fa-solid fa-house"></i><span>Inicio</span></a></li>
            <li><a href="{{ route('dashboard') }}"><i class="fa-solid fa-calendar-days"></i><span>Calendario</span></a>
            </li>
            <li><a href="{{ route('Pacientes.PacientesView') }}"><i
                        class="fa-solid fa-bed-pulse"></i><span>Pacientes</span></a></li>

            @if (Auth::user()->hasRole('Doctor'))
                <li><a href="{{ route('Doctor.Secretaria') }}"><img class="img-secretary"
                            src="{{ asset('images/secretary.png') }}" /><span>Secretaria</span></a></li>
            @endif

            @if (Auth::user()->hasAnyRole('Admin', 'Root'))
                <li><a href="{{ route('doctores.index') }}"><i
                            class="fa-solid fa-user-doctor"></i><span>Doctores</span></a></li>
                <li><a href="{{ route('secretarias.index') }}"><img class="img-secretary2"
                            src="{{ asset('images/secretary.png') }}" /><span>Secretarias</span></a></li>


                <li><a href="{{ route('Trabajadores.index') }}"><img class="img-secretary"
                    src="{{ asset('images/human.png') }}" /> <span>Trabajadores</span></a></li>


                <li><a href="{{ route('empresas.index') }}"><i class="fas fa-building"></i><span>Empresa</span></a>
                </li>
            @endif

            @if (Auth::user()->hasRole('Root'))
                <li><a href="{{ route('roles.index') }}"><i class="fa-solid fa-users-gear"></i><span>Roles</span></a>
                </li>
            @endif

            <li><a href="{{ route('profile.show') }}"><i class="fas fa-user-circle"></i><span>Perfil</span></a></li>
        </ul>

        <div class="role-container">
            <label for="">Rol Actual: {{ Auth::user()->getRoleNames()->first() }}</label>
        </div>

        <!-- Contenedor para el usuario -->
        <div class="user-container">
            <div class="name-space">
                <!-- Imagen de perfil o icono de sombra -->
                @if ($user->foto_perfil)
                    <img src="{{ asset('images/' . $user->foto_perfil) }}" alt="Foto de Perfil"
                        class="profile-picture">
                @else
                    <i class="fa-solid fa-2xs profile-icon fa-circle-user"></i>
                @endif
                <!-- Nombre del usuario -->
                <p class="username">{{ explode(' ', $user->name)[0] }}</p>
            </div>
            <!-- Botón de salir -->
            <div>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit"><i title="Cerrar Sesión" class="fas fa-sign-out-alt"></i></button>
                </form>
            </div>
        </div>
    </div>
</div>

<style>
    /* Estilos generales del menú */
    .sidebar-menu {
        list-style: none;
        padding: 0;
        margin: 0;
        display: flex;
        flex-direction: column;
        justify-content: center;
        /* Centra verticalmente los elementos */
    }

    .sidebar-menu li {
        margin: 0;
    }

    /* Altura para Admin/Root */
    .admin-menu {
        height: 70% !important;
        /* Altura deseada para Admin/Root */
    }

    /* Altura para Doctor/Secretaria */
    .doctor-secretaria-menu {
        height: 35% !important;
        /* Altura deseada para Doctor/Secretaria */
    }

    /* Estilos adicionales */
    .empresa-container {
        display: flex;
        justify-content: center;
    }

    .img-secretary {
        filter: invert();
        padding-right: 10px;
        height: 25px !important;
    }

    .img-secretary2 {
        filter: invert();
        padding-right: 10px;
        height: 25px !important;
    }

    .name-space {
        display: flex;
    }

    .sidebar-content {
        display: flex;
        flex-direction: column;
        height: 100%;
        /* Asegura que ocupe toda la altura del sidebar */
    }

    .username {
        margin: 0px !important;
        font-size: 16px;
        color: #ecf0f1;
        text-align: center;
    }

    .logout-button {
        background-color: #ecf0f1;
        color: #2c3e50;
        border: none;
        padding: 10px 20px;
        border-radius: 5px;
        cursor: pointer;
        transition: background-color 0.3s ease-in-out;
        display: flex;
        align-items: center;
        gap: 5px;
    }

    .logout-button i {
        font-size: 18px;
    }

    .logout-button:hover {
        background-color: #dcdcdc;
    }

    .img-secretary {
        filter: invert();
        padding-right: 10px;
        height: 25px !important;
    }

    .img-secretary2 {
        filter: invert();
        padding-right: 10px;
        height: 25px !important;
    }

    .name-space {
        display: flex;
    }

    .sidebar-content {
        display: flex;
        flex-direction: column;
        height: 100%;
        /* Asegura que ocupe toda la altura del sidebar */
    }

    .sidebar-menu {
        list-style: none;
        padding: 0;
        margin: 0;
        display: flex;
        flex-direction: column;
        justify-content: center;
        /* Centra verticalmente los elementos */
        height: 60% !important;
        /* Asegura que ocupe toda la altura del sidebar */
    }

    /* Botón para abrir/cerrar el sidebar */
    .toggle-button {
        height: 35px;
        width: 35px;
        position: fixed;
        top: 0px;
        z-index: 9999;
        background-color: #007bff;
        color: white;
        border: none;
        padding: 4px;
        font-size: 20px;
        cursor: pointer;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        transition: transform 0.3s ease-in-out;
    }

    .toggle-button:hover {
        transform: scale(1.1);
    }

    /* Sidebar */
    .sidebar {
        position: fixed;
        top: 0;
        left: 0;
        width: 260px;
        height: 100%;
        background-color: #2c3e50;
        color: white;
        transition: transform 0.3s ease-in-out;
        overflow-y: auto;
        z-index: 49;
        box-shadow: 2px 0 5px rgba(0, 0, 0, 0.2);
    }

    /* Estado cerrado */
    .sidebar.closed {
        transform: translateX(-100%);
    }

    /* Encabezado del sidebar */
    .sidebar-header {
        padding: 20px;
        text-align: center;
        background-color: #1a253c;
        border-bottom: 1px solid #162032;
    }

    .sidebar-header h3 {
        margin: 0;
        font-size: 18px;
        color: #ecf0f1;
    }

    .sidebar-menu a {
        display: flex;
        align-items: center;
        padding: 15px 20px;
        text-decoration: none;
        color: #ecf0f1 !important;
        font-size: 14px;
        transition: background-color 0.3s ease-in-out;
    }

    .sidebar-menu a:hover {
        background-color: #1a253c;
    }

    .sidebar-menu i {
        margin-right: 15px;
        font-size: 18px;
    }

    /* Contenido principal */
    .content {
        margin-left: 270px;
        padding: 20px;
        transition: margin-left 0.3s ease-in-out;
    }

    /* Ajustar el contenido cuando el sidebar está cerrado */
    .sidebar.closed+.content {
        margin-left: 60px;
    }

    /* Contenedor para el usuario */
    .user-container {
        position: absolute;
        bottom: 0;
        width: 100%;
        background-color: #23314b;
        gap: 50%;
        display: flex;
        align-items: center;
        padding: 20px;
    }

    .role-container {
        position: absolute;
        bottom: 48px;
        margin-left: 26px;
        padding: 20px;
    }

    .profile-picture {
        width: 60px;
        height: 60px;
        border-radius: 50%;
        object-fit: cover;
        margin-bottom: 10px;
    }

    .profile-icon {
        padding-top: 12px;
        padding-right: 10px;
        font-size: 20px;
        color: #ecf0f1;
    }

    .username {
        margin: 0px !important;
        font-size: 16px;
        color: #ecf0f1;
        text-align: center;
    }

    .logout-button {
        background-color: #ecf0f1;
        color: #2c3e50;
        border: none;
        padding: 10px 20px;
        border-radius: 5px;
        cursor: pointer;
        transition: background-color 0.3s ease-in-out;
        display: flex;
        align-items: center;
        gap: 5px;
    }

    .logout-button i {
        font-size: 18px;
    }

    .logout-button:hover {
        background-color: #dcdcdc;
    }
</style>


<script>
    document.addEventListener('DOMContentLoaded', function() {
        const toggleButton = document.getElementById('toggle-sidebar'); // Primer botón
        const toggleButtonSecondary = document.querySelector('.toggle-button-secondary'); // Segundo botón
        const sidebar = document.getElementById('sidebar');

        // Asegurarse de que el sidebar esté cerrado al cargar la página
        sidebar.classList.add('closed');

        // Alternar el estado del sidebar
        toggleButton.addEventListener('click', function() {
            sidebar.classList.toggle('closed');
            updateButtonVisibility();
        });

        toggleButtonSecondary.addEventListener('click', function() {
            sidebar.classList.toggle('closed');
            updateButtonVisibility();
        });
    });
</script>

<script>
    const sidebar = document.getElementById('sidebar');
    const sidebarToggle = document.getElementById('sidebar-toggle');
    const content = document.getElementById('content');

    if (sidebarToggle && sidebar && content) {
        sidebarToggle.addEventListener('click', () => {
            sidebar.classList.toggle('-translate-x-full');
            content.classList.toggle('ml-0');
            content.classList.toggle('md:ml-64');
        });
    }

    function toggleModal(modalId) {
        const modal = document.getElementById(modalId);
        const appContainer = document.getElementById(
            'app'); // Asegúrate de que tu layout tenga un ID "app" en el div principal

        if (modal) {
            modal.classList.toggle('hidden');
            document.documentElement.classList.toggle('overflow-hidden');
            document.body.classList.toggle('overflow-hidden');
        }
    }

    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            const modals = document.querySelectorAll('[id^="modal-"]');
            modals.forEach(modal => {
                if (!modal.classList.contains('hidden')) {
                    toggleModal(modal.id);
                }
            });
        }
    });

    document.addEventListener('click', function(e) {
        if (e.target.matches('[id^="modal-"]')) {
            toggleModal(e.target.id);
        }
    });
</script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const sidebar = document.getElementById('sidebar');
        const content = document.getElementById('content');

        // Función para actualizar los estilos del contenido
        function updateContentStyles() {
            if (!sidebar.classList.contains('closed')) {
                // Si el sidebar está abierto, aplicar los estilos
                content.classList.add('md:ml-64');
            } else {
                // Si el sidebar está cerrado, quitar los estilos
                content.classList.remove('md:ml-64');
            }
        }

        // Escuchar cambios en el estado del sidebar
        const observer = new MutationObserver(function(mutationsList) {
            for (let mutation of mutationsList) {
                if (mutation.attributeName === 'class') {
                    updateContentStyles();
                }
            }
        });

        // Observar cambios en las clases del sidebar
        if (sidebar) {
            observer.observe(sidebar, {
                attributes: true
            });
        }

        // Inicializar los estilos al cargar la página
        updateContentStyles();
    });
</script>
