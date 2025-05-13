<x-app-layout>
    <style>
        /* Estilos responsivos para el tooltip */
        #tutorial-overlay .absolute {
            /* Posición para móviles */
            top: 20%;
            left: 50%;
            transform: translateX(-50%);

            /* Posición para pantallas medianas/grandes */
            @media (min-width: 768px) {
                top: -10px;
                left: 0px;
                transform: none;
                right: auto;
            }
        }

        /* Ajustes para pantallas muy pequeñas */
        @media (max-width: 400px) {
            #tutorial-overlay .absolute {
                width: 95%;
                min-width: auto;
            }
        }
    </style>

    </head>
    <div class="flex-grow bg-gray-100 transition-all duration-300 ml-0 md:ml-64" id="content">

        <div class="flex justify-between items-center p-3">

            <div id="normal-btn" class="m-0 hidden">
                <button id="toggle-sidebar" class="menu-button p-2.5">
                    <i class="fa-solid fa-bars fa-lg"></i>
                </button>
            </div>


            <div id="tutorial-btn" class="absolute -inset-4 rounded-full h-10 w-10 bg-white bg-opacity-20 animate-pulse"
                style="top: 30px; left: 35px; transform: translate(-50%, -50%); z-index: 52;">
                <!-- Botón de menú -->
                <button id="toggle-sidebar" class="menu-button p-2.5">
                    <i class="fa-solid fa-bars fa-lg"></i>
                </button>
            </div>

            <!-- Agrega esto en tu HTML, preferiblemente cerca del botón de hamburguesa -->
            <div id="tutorial-overlay"
                class="fixed inset-0 hidden bg-black bg-opacity-75 z-50 flex items-center justify-center">
                <div class="relative w-full h-full">
                    <!-- Tooltip con posicionamiento responsivo -->
                    <div class="absolute bg-white p-4 rounded-lg shadow-xl"
                        style="min-width: 300px; max-width: 90%; top: 90px !important;">
                        <div class="flex flex-col">
                            <h3 class="font-bold text-gray-800 mb-2">Bienvenido a nuestro software</h3>
                            <p class="text-sm text-gray-600 mb-2">
                                Primera para empezar a optimizar tu consultorio, necesitas conocer tu
                                entorno de trabajo
                            </p>
                            <p class="text-sm text-gray-600 font-semibold mb-2">Barra lateral de
                                opciones</p>
                            <p class="text-sm text-gray-600 mb-4">
                                Has click en el icono para poder abrir la barra y moverte entre las
                                opciones que ofrecemos
                            </p>

                            <div class="flex justify-end items-center text-sm">
                                <button id="close-tutorial"
                                    class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 transition">
                                    Entendido
                                </button>
                            </div>
                        </div>

                        <!-- Flecha que apunta al ícono - posición responsiva -->
                        <div
                            class="absolute -right-3 top-1/2 transform -translate-y-1/2 rotate-90 md:rotate-0 md:right-full md:top-1/2 md:-mr-2">
                            <svg width="20" height="30" viewBox="0 0 20 30" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path d="M20 15L0 0V30L20 15Z" fill="white" />
                            </svg>
                        </div>
                    </div>
                </div>
            </div>

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

                document.addEventListener('DOMContentLoaded', function() {
                    // Mostrar el tutorial solo si es la primera vez
                    if (!localStorage.getItem('tutorialCompleted')) {
                        document.getElementById('tutorial-overlay').classList.remove('hidden');
                        document.body.classList.add('overflow-hidden');
                        // Mostrar SOLO el botón con resaltador durante el tutorial
                        document.getElementById('tutorial-btn').classList.remove('hidden');
                        document.getElementById('normal-btn').classList.add('hidden');
                    } else {
                        // Si ya completó el tutorial, mostrar SOLO el botón normal
                        document.getElementById('tutorial-btn').classList.add('hidden');
                        document.getElementById('normal-btn').classList.remove('hidden');
                    }

                    // Cerrar el tutorial
                    document.getElementById('close-tutorial').addEventListener('click', function() {
                        document.getElementById('tutorial-overlay').classList.add('hidden');
                        document.body.classList.remove('overflow-hidden');
                        // Cambiar al botón normal después de cerrar el tutorial
                        document.getElementById('tutorial-btn').classList.add('hidden');
                        document.getElementById('normal-btn').classList.remove('hidden');
                        localStorage.setItem('tutorialCompleted', 'true');
                    });

                    // Posicionamiento dinámico en diferentes pantallas
                    function positionTooltip() {
                        const tooltip = document.querySelector('#tutorial-overlay .absolute');
                        const menuButton = document.querySelector('.menu-button');

                        if (window.innerWidth >= 768) {
                            // Para pantallas grandes, posición fija como en la imagen
                            tooltip.style.top = '50px';
                            tooltip.style.left = '70px';
                            tooltip.style.transform = 'none';
                        } else {
                            // Para móviles, centrado en la pantalla
                            tooltip.style.top = '20%';
                            tooltip.style.left = '50%';
                            tooltip.style.transform = 'translateX(-50%)';
                        }
                    }

                    // Ejecutar al cargar y al redimensionar
                    positionTooltip();
                    window.addEventListener('resize', positionTooltip);
                });
            </script>
