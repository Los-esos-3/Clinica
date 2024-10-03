<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    <style>
        body {
            font-family: 'Figtree', sans-serif;
            background-color: #f9fafb;
            color: #000;
            margin: 0;
            padding: 0;
        }

        header {
    background: linear-gradient(to right, #a7d3e0, #003366); /* De celeste a azul marino */
    color: #fff;
    padding: 10px 20px;
}

header nav ul {
    list-style-type: none;
    padding: 0;
    display: flex;
    justify-content: center; /* Centrar elementos en el header */
    align-items: center;
    gap: 60px; /* Espaciado entre elementos */
}

header nav ul li {
    border-radius: 25px;
    overflow: hidden;
}

header nav ul li a {
    color: #fff;
    text-decoration: none;
    padding: 10px 15px;
    display: inline-block;
    transition: background-color 0.3s, transform 0.3s;
}

header nav ul li a:hover {
    background-color: #88c8de;
    transform: scale(1.05);
}
#auth-links {
    position: absolute; /* Para que aparezca sobre el nav */
    background: #a7d3e0; /* Color de fondo */
    border-radius: 10px; /* Bordes redondeados */
    padding: 10px; /* Espaciado interno */
    margin-top: 5px; /* Margen superior para que no esté pegado al icono */
    display: none; /* Inicialmente oculto */
    z-index: 10; /* Asegura que el cuadro esté por encima de otros elementos */
}

#auth-links a {
    color: #003366; /* Color de texto */
    text-decoration: none;
    display: block; /* Para que cada enlace ocupe toda la línea */
    margin: 5px 0;
    padding: 10px 15px;
    border-radius: 20px; /* Bordes redondeados */
    transition: background-color 0.3s, color 0.3s; /* Transición suave para el hover */
}

#auth-links a:hover {
    background-color: #88c8de; /* Color de fondo al pasar el mouse */
    color: #003366; /* Color del texto al pasar el mouse */
}


        .content {
            padding: 40px 20px;
            text-align: center;
        }

        footer {
            background-color: #003366; /* Azul marino */
            color: #fff;
            padding: 10px 20px; /* Espacio reducido para compactar */
            display: flex; /* Cambiado a flexbox */
            flex-wrap: wrap; /* Permitir que los elementos se ajusten */
            justify-content: space-between; /* Espacio uniforme entre elementos */
            align-items: center; /* Centrar verticalmente */
        }

        .footer-container {
            display: flex;
            justify-content: space-between;
            max-width: 1200px;
            margin: 0 auto;
            flex-wrap: wrap; /* Permitir que los elementos se ajusten */
            width: 100%; /* Ancho completo */
        }

        .footer-column {
            width: 30%;
            margin: 0; /* Eliminado el margen para compactar */
            text-align: left; /* Alinear texto a la izquierda */
        }

        .footer-column h4 {
            margin-top: 0;
            border-bottom: 2px solid #88c8de; /* Línea inferior */
            padding-bottom: 5px;
        }

        .footer-column ul {
            list-style: none;
            margin: 0;
            padding: 0;
        }

        .footer-column li {
            margin-bottom: 10px;
        }

        .footer-column a {
            color: #fff;
            text-decoration: none;
            transition: color 0.2s ease;
        }

        .footer-column a:hover {
            color: #ccc;
        }

        .footer-copyright {
            background-color: #002244; /* Un tono más oscuro de azul marino */
            padding: 10px;
            text-align: center;
            clear: both;
            width: 100%; /* Ancho completo */
        }

        .footer-opening-hours {
            display: flex;
            justify-content: space-between; /* Espaciado entre los días */
            align-items: center; /* Centrar verticalmente */
            width: 100%;
            margin: 20px 0;
        }

        .footer-opening-hours h4 {
            margin: 0 10px 0 0;
        }

        .footer-opening-hours p {
            margin: 0 10px; /* Espacio entre horarios */
        }
        .footer-column li {
    margin-bottom: 30px; /* Aumenta el espacio entre cada li */
}

    </style>
</head>
<body>
    <header>
        <nav>
            <ul>
                <li>
                </li>
                <li><a href="#">About Us</a></li>
                <li><a href="#">Categorías</a></li>
                <li><a href="#">Contáctenos</a></li>
                @if (Route::has('login'))
                <li>
                    @auth
                        <a href="{{ url('/dashboard') }}">Dashboard</a>
                    @else
                        <a href="#" id="toggle-auth-links"> <!-- Cambiado a un enlace vacío para controlar el clic -->
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" width="22" height="22" style="vertical-align: middle; margin-right: 8px;">
                                <path d="M224 256A128 128 0 1 0 224 0a128 128 0 1 0 0 256zm-45.7 48C79.8 304 0 383.8 0 482.3C0 498.7 13.3 512 29.7 512l388.6 0c16.4 0 29.7-13.3 29.7-29.7C448 383.8 368.2 304 269.7 304l-91.4 0z"/>
                            </svg>
                        </a>
                        <div id="auth-links" style="display: none;"> <!-- Contenedor oculto inicialmente -->
                            <a href="{{ route('login') }}">Log in</a>
                            @if (Route::has('register'))
                                <a href="{{ route('register') }}">Register</a>
                            @endif
                        </div>
                    @endauth
                </li>
                @endif
             </ul>
        </nav>
    </header>

    <div class="content">
        <h1>Bienvenido a nuestro sitio</h1>
        <p>Explora nuestras funcionalidades y descubre lo que tenemos para ofrecerte.</p>
    </div>

    <footer>
        <div class="footer-container">
            <div class="footer-column">
                <h4>Acerca de nosotros</h4>
                <p>En nuestra clínica dental, ofrecemos atención personalizada y profesional, respaldada por años de experiencia. Nuestro equipo de expertos se dedica a cuidar tu salud bucal con tratamientos innovadores en un ambiente seguro y acogedor. Tu sonrisa es nuestra prioridad.</p>
            </div>
            <div class="footer-column">
                <h4>Horario de atención</h4>
                <p>Lunes: 9:00 AM - 5:00 PM</p>
                <p>Martes: 9:00 AM - 5:00 PM</p>
                <p>Miércoles: 9:00 AM - 5:00 PM</p>
                <p>Jueves: 9:00 AM - 5:00 PM</p>
                <p>Viernes: 9:00 AM - 5:00 PM</p>
                <p>Sábados: 10:00 AM - 3:00 PM</p>
                <p>Domingos: Cerrado</p>
            </div>
            <div class="footer-column">
                <h4>Contáctenos</h4>
                <ul>

                    <li>
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512" width="22" height="22" style="vertical-align: middle; margin-right: 8px;"><!--!Font Awesome Free 6.6.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M215.7 499.2C267 435 384 279.4 384 192C384 86 298 0 192 0S0 86 0 192c0 87.4 117 243 168.3 307.2c12.3 15.3 35.1 15.3 47.4 0zM192 128a64 64 0 1 1 0 128 64 64 0 1 1 0-128z"/></svg>
                        Pedro José Méndez, Industrial, 87350 Heroica Matamoros, Tamps.
                    </li>
                    <li>
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" width="22" height="22" style="vertical-align: middle; margin-right: 8px;"><!--!Font Awesome Free 6.6.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M164.9 24.6c-7.7-18.6-28-28.5-47.4-23.2l-88 24C12.1 30.2 0 46 0 64C0 311.4 200.6 512 448 512c18 0 33.8-12.1 38.6-29.5l24-88c5.3-19.4-4.6-39.7-23.2-47.4l-96-40c-16.3-6.8-35.2-2.1-46.3 11.6L304.7 368C234.3 334.7 177.3 277.7 144 207.3L193.3 167c13.7-11.2 18.4-30 11.6-46.3l-40-96z"/></svg>         8683-671279
                    </li>
                    <li>
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" width="22" height="22" style="vertical-align: middle; margin-right: 8px;"><!--!Font Awesome Free 6.6.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M64 112c-8.8 0-16 7.2-16 16l0 22.1L220.5 291.7c20.7 17 50.4 17 71.1 0L464 150.1l0-22.1c0-8.8-7.2-16-16-16L64 112zM48 212.2L48 384c0 8.8 7.2 16 16 16l384 0c8.8 0 16-7.2 16-16l0-171.8L322 328.8c-38.4 31.5-93.7 31.5-132 0L48 212.2zM0 128C0 92.7 28.7 64 64 64l384 0c35.3 0 64 28.7 64 64l0 256c0 35.3-28.7 64-64 64L64 448c-35.3 0-64-28.7-64-64L0 128z"/></svg>
                       esaprtano.gamer04@gmail.com
                    </li>
                </ul>
            </div>

        </div>
        <div class="footer-copyright">
            <p>&copy; 2023 Todos los derechos reservados.</p>
        </div>
    </footer>
</body>
</html>

<script>
    document.getElementById('toggle-auth-links').addEventListener('click', function(event) {
        event.preventDefault(); // Evitar el comportamiento predeterminado del enlace
        const authLinks = document.getElementById('auth-links');
        if (authLinks.style.display === 'none' || authLinks.style.display === '') {
            authLinks.style.display = 'block'; // Mostrar enlaces
        } else {
            authLinks.style.display = 'none'; // Ocultar enlaces
        }
    });
</script>