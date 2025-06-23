<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Expedined</title>

    <link href="https://fonts.googleapis.com/css2?family=Lato:wght@400;700&display=swap" rel="stylesheet">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <style>
        body {
            font-family: 'Figtree', sans-serif;
            background-color: #f2f4f7;
            color: #000;
            margin: 0;
            padding: 0;
        }

        header {
            background: linear-gradient(to right, #a7d3e0, #003366);
            color: #fff;
            padding: 10px 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            position: relative;
            flex-wrap: wrap;
        }

        .header-title {
            font-family: 'Arial', sans-serif;
            font-weight: 400;
            color: #fff;
            text-align: left;
            margin-left: 0;
            transition: transform 0.3s ease;
        }

        .header-title .kaiser {
            font-size: 24px;
            font-weight: bold;
            color: #fff;
            text-transform: uppercase;
            letter-spacing: 2px;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
            display: block;
        }

        header nav {
            width: auto;
        }

        header nav ul {
            list-style-type: none;
            padding: 0;
            margin: 0;
            display: flex;
            align-items: center;
            gap: 20px;
        }

        header nav ul li {
            position: relative;
        }

        header nav ul li a {
            color: #fff;
            text-decoration: none;
            padding: 8px 12px;
            display: inline-block;
            transition: background 0.4s ease, color 0.4s ease, transform 0.4s ease;
            border-radius: 20px;
            font-size: 14px;
        }

        header nav ul li a:hover {
            background-color: #88c8de;
            transform: scale(1.05);
        }

        header nav ul li svg {
            cursor: pointer;
            margin-right: 15px;
            transition: transform 0.3s ease;
        }

        header nav ul li svg:hover {
            transform: scale(1.2);
        }

        #auth-links {
            position: absolute;
            top: 45px;
            right: 0;
            background: #ffffff;
            border-radius: 10px;
            padding: 15px;
            display: none;
            z-index: 10;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
        }

        #auth-links a {
            color: #003366;
            text-decoration: none;
            display: block;
            margin: 5px 0;
            padding: 10px 15px;
            border-radius: 19px;
            transition: background-color 0.3s, color 0.3s;
        }

        #auth-links a:hover {
            background-color: #88c8de;
            color: #003366;
        }

        #auth-links.show {
            display: block;
        }

        .content {
            background-image: url("images/FondoWelcome.webp");
            background-position: center;
            background-size: cover;
            background-repeat: no-repeat;
            max-width: 100%;
            display: flex;
            align-items: center;
            padding: 20px;
            margin-top: 0;
            flex-direction: row;
            z-index: 1;
            height: 670px;
            margin-bottom: 80px;
        }

        .background-blur
        {
            filter: blur(10px)
        }
        

        .content-text {
            flex: 1;
        }

        .content-text h1 {
            text-align: left;
            font-family: 'Lato', sans-serif;
            font-size: 56px;
            z-index: 2;
            line-height: 1.4;
            color: white;
            text-shadow: 2px 2px 5px rgba(0, 0, 0, 0.1);
            margin-top: 0;
            padding: 10px 0;
        }   

        .content-text h2 {
            text-align: left;
            font-family: 'Lato', sans-serif;
            font-size: 1.5rem;
            line-height: 1.4;
            color: white;
            text-shadow: 1px 1px 4px rgba(0, 0, 0, 0.1);
            padding: 5px 0;
        }

        .hero {
            background-color: #f2f4f7;
            padding: 30px 0;
        }

        .container {
            padding: 0 50px;
            margin: 0 auto;
        }

        .hero-content {
            display: flex;
            flex-direction: row-reverse;
            align-items: center;
            justify-content: space-between;
            gap: 5%;
        }

        .hero-content-last {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 5%;
        }

        .hero-text {
            flex: 1;
        }

        .hero-text h2 {
            font-size: 1.6rem;
            color: #0A1B43;
            margin-bottom: 15px;
        }

        .hero-text p {
            font-size: 1rem;
            color: #3E5485;
            margin-bottom: 15px;
        }

        .hero-images {
            display: flex;
            flex-wrap: wrap;
            gap: 5%;
        }

        .hero-images-last {
            display: flex;
            flex-wrap: wrap;
        }

        .hero-images img,
        .hero-images-last img {
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(58, 79, 124, 0.1);
            max-width: 100%;
            height: auto;
        }

        .features-list {
            text-align: left;
            list-style: none;
            padding: 0;
        }

        .features-list li {
            font-size: 14px;
            display: flex;
            align-items: center;
            margin-bottom: 8px;
        }

        .features-list li .icon-check {
            font-size: 16px;
            color: #00aaff;
            margin-right: 5px;
        }

        .image-column {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        .features {
            background-color: #f2f4f7;
            padding: 30px 0;
        }

        .features .container {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            align-items: flex-start;
            gap: 15px;
        }

        .feature {
            display: flex;
            align-items: center;
            background-color: #ffffff;
            padding: 15px;
            border-radius: 8px;
            width: 40%;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            transition: background 0.4s ease, color 0.4s ease, transform 0.4s ease;
        }

        .feature-content {
            flex: 1;
            padding-right: 15px;
        }

        .feature-title {
            color: #333;
            font-weight: bold;
            margin-bottom: 5px;
            font-size: 1rem;
        }

        .feature p {
            font-size: 0.9rem;
        }

        .feature img {
            width: 40px;
            height: 40px;
            object-fit: contain;
            transition: filter 0.4s ease;
        }

        .content-img {
            width: 100%;
            max-width: 400px;
            margin-left: 0;
        }

        .modal-content {
            background: linear-gradient(135deg, #a7d3e0, #003366);
            padding: 1.8em;
            border-radius: 20px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            transition: .4s ease-in-out;
            color: white;
        }

        .modal-content h2 {
            text-align: center;
            margin: 0.5em 0 1.2em;
            color: #fff;
            font-size: 1.3em;
        }

        .field {
            display: flex;
            align-items: center;
            gap: 0.5em;
            border-radius: 25px;
            padding: 0.6em;
            border: 1px solid #ccc;
            background-color: #fff;
            margin-bottom: 1em;
            position: relative;
        }

        .input-icon {
            height: 1.2em;
            width: 1.2em;
            fill: #666;
        }

        .input-field {
            background: none;
            border: none;
            outline: none;
            width: 100%;
            color: #333;
            font-size: 0.9em;
        }

        .input-field::placeholder {
            color: #999;
        }

        .btn {
            display: flex;
            flex-direction: column;
            gap: 1em;
            margin-top: 1.5em;
        }

        .button1,
        .button2 {
            padding: 0.7em 1.5em;
            border-radius: 25px;
            border: none;
            outline: none;
            transition: .3s ease-in-out;
            cursor: pointer;
            font-size: 0.9em;
            width: 100%;
        }

        .button1 {
            background-color: #003366;
            color: white;
        }

        .button1:hover {
            background-color: #004080;
        }

        .button2 {
            background-color: #4CAF50;
            color: white;
        }

        .button2:hover {
            background-color: #45a049;
        }

        .button3 {
            width: 100%;
            margin-top: 1em;
            padding: 0.7em;
            border-radius: 25px;
            border: none;
            outline: none;
            transition: .3s ease-in-out;
            background-color: transparent;
            color: white;
            cursor: pointer;
            font-size: 0.9em;
            text-decoration: underline;
        }

        .modal-overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.75);
            justify-content: center;
            align-items: center;
            z-index: 9999;
        }

        .modal-content-success {
            background: linear-gradient(135deg, #a7d3e0, #003366);
            padding: 2rem;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            max-width: 90%;
            width: 320px;
            text-align: center;
        }

        .hidden {
            display: none !important;
        }

        .close {
            color: #fff;
            float: right;
            font-size: 24px;
            font-weight: bold;
            cursor: pointer;
        }

        .close:hover,
        .close:focus {
            color: #ccc;
            text-decoration: none;
        }

        footer {
            background-color: #003366;
            color: #fff;
            padding: 10px 20px;
        }

        .footer-copyright {
            background-color: #002244;
            padding: 10px;
            text-align: center;
            font-size: 0.9rem;
        }

        .password-toggle {
            position: absolute;
            right: 10px;
            cursor: pointer;
            color: #666;
            padding: 5px;
        }

        .password-toggle:hover {
            color: #333;
        }

        /* Media queries para distintos tamaños de pantalla */
        @media (max-width: 768px) {
            header {
                flex-direction: column;
                padding: 10px;
            }

            .header-title {
                margin-bottom: 10px;
                margin-left: 0;
                text-align: center;
                width: 100%;
            }

            header nav {
                width: 100%;
            }

            header nav ul {
                justify-content: center;
                gap: 10px;
            }

            .content {
                flex-direction: column;
                padding: 15px;
            }

            .content-text h1 {
                font-size: 1.5rem;
                padding: 5px 0;
            }

            .content-text h2 {
                font-size: 1rem;
            }

            .content-img {
                margin-left: 0;
                margin-top: 20px;
            }

            .hero-content,
            .hero-content-last {
                flex-direction: column;
            }

            .hero-text {
                flex: none;
                max-width: 100%;
                text-align: center;
            }

            .hero-text h2 {
                font-size: 1.4rem;
                text-align: center;
            }

            .features-list li {
                justify-content: center;
            }

            .hero-images,
            .hero-images-last {
                justify-content: center;
                margin-top: 15px;
            }

            .feature {
                width: 100%;
            }
        }

        @media (max-width: 480px) {
            .header-title .kaiser {
                font-size: 20px;
            }

            header nav ul li a {
                padding: 6px 10px;
                font-size: 13px;
            }

            .content-text h1 {
                font-size: 1.3rem;
            }

            .content-text h2 {
                font-size: 0.9rem;
            }

            .modal-content {
                padding: 1.5em;
            }

            .button1,
            .button2,
            .button3 {
                font-size: 0.85em;
            }

            .feature {
                padding: 10px;
            }

            .feature-title {
                font-size: 0.9rem;
            }

            .feature p {
                font-size: 0.8rem;
            }

            .feature img {
                width: 35px;
                height: 35px;
            }
        }

        .bg-blur-text {
            background: rgba(0, 0, 0, 0.5); /* Fondo azul oscuro más sutil */
            margin-right: 15px;
            padding: 16px 24px;
            border-radius: 16px;
            display: inline-block;
            box-shadow: 0 4px 16px rgba(0,0,0,0.15);
            backdrop-filter: blur(2px); /* Si quieres un efecto de desenfoque */
        }
    </style>
</head>

<body>

    <header>
        @php
            $nombreEmpresa = 'Expedined'; // Valor por defecto

            // Verifica si el usuario está autenticado y tiene una empresa asociada
            if (Auth::check() && Auth::user()->empresa_id) {
                $empresa = \App\Models\Empresa::find(Auth::user()->empresa_id);
                $nombreEmpresa = $empresa ? $empresa->nombre : $nombreEmpresa; // Asigna el nombre de la empresa si existe
            }
        @endphp

        <div class="header-title">
            <span class="kaiser">{{ $nombreEmpresa }}</span>
        </div>
        <nav>
            <ul>
                <li><a href="{{ url('/contactenos') }}">Contáctanos</a></li>

                @if (Route::has('login'))
                    @auth
                        <li>
                            @if (Auth::user()->hasAnyRole(['Admin', 'Doctor', 'Secretaria']))
                                <a href="{{ url('/dashboard') }}">Agenda</a>
                            @elseif (Auth::user()->hasRole('Root'))
                                <a href="{{ url('/dashboardRoot') }}">Dashboard</a>
                            @endif
                        </li>
                    @endauth
                @endif
            </ul>
        </nav>
    </header>

    <div class="content">
        <div class="background-blur"></div>
        <div class="content-text">
            <div class="bg-blur-text">
                <h1 class="text-white">Sistema para la gestión de expedientes médicos.</h1>
                <h2 class="text-white">Optimiza la gestión de tus expedientes médicos con un software diseñado para simplificar procesos y mejorar la atención desde cualquier lugar.</h2>
            </div>
        </div>

        @if (Auth::check())
        @else
            <div class="content-img">
                <div class="modal-content">
                    <h2>Iniciar Sesión</h2>
                    @if ($errors->any())
                        <div class="error-message"
                            style="color: red; background-color: #f8d7da; border: 1px solid #f5c6cb; border-radius: 5px; padding: 10px; margin-bottom: 10px;">
                            {{ $errors->first() }}
                        </div>
                    @endif
                    <form action="{{ route('login') }}" method="POST" class="form">
                        @csrf
                        <div class="field">
                            <svg class="input-icon" xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                fill="currentColor" viewBox="0 0 16 16">
                                <path
                                    d="M13.106 7.222c0-2.967-2.249-5.032-5.482-5.032-3.35 0-5.646 2.318-5.646 5.702 0 3.493 2.235 5.708 5.762 5.708.862 0 1.689-.123 2.304-.335v-.862c-.43.199-1.354.328-2.29.328-2.926 0-4.813-1.88-4.813-4.798 0-2.844 1.921-4.881 4.594-4.881 2.735 0 4.608 1.688 4.608 4.156 0 1.682-.554 2.769-1.416 2.769-.492 0-.772-.28-.772-.76V5.206H8.923v.834h-.11c-.266-.595-.881-.964-1.6-.964-1.4 0-2.378 1.162-2.378 2.823 0 1.737.957 2.906 2.379 2.906.8 0 1.415-.39 1.709-1.087h.11c.081.67.703 1.148 1.503 1.148 1.572 0 2.57-1.415 2.57-3.643zm-7.177.704c0-1.197.54-1.907 1.456-1.907.93 0 1.524.738 1.524 1.907S8.308 9.84 7.371 9.84c-.895 0-1.442-.725-1.442-1.914z">
                                </path>
                            </svg>
                            <input type="email" id="email" name="email" class="input-field"
                                placeholder="Correo electrónico" required>
                        </div>
                        <div class="field">
                            <svg class="input-icon" xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                fill="currentColor" viewBox="0 0 16 16">
                                <path
                                    d="M8 1a2 2 0 0 1 2 2v4H6V3a2 2 0 0 1 2-2zm3 6V3a3 3 0 0 0-6 0v4a2 2 0 0 0-2 2v5a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V9a2 2 0 0 0-2-2z">
                                </path>
                            </svg>
                            <input type="password" id="password" name="password" class="input-field"
                                placeholder="Contraseña" required>
                            <span onclick="togglePassword('password', this)" class="password-toggle">
                                <i class="fa-solid fa-eye"></i>
                            </span>
                        </div>
                        <div class="btn">
                            <button type="submit" class="button1">Iniciar Sesión</button>
                            <button type="button" onclick="window.location.href='{{ route('register') }}'"
                                class="button2">Registrarse</button>
                        </div>
                        <button type="button" class="button3">Olvidé mi contraseña</button>
                    </form>
                </div>
            </div>
        @endif
    </div>

    <section class="hero">
        <div class="container">
            <div class="hero-content">
                <div class="hero-text">
                    <h2>Innovamos en nuestros expedientes clínicos</h2>
                    <p>Transforma la forma en que gestionas tus expedientes clínicos con nuestra solución digital
                        avanzada. Simplificamos tus procesos, mejoramos la accesibilidad y garantizamos un manejo seguro
                        y eficiente de la información médica, todo desde una plataforma centralizada.</p>
                    <ul class="features-list">
                        <li><i class="icon-check">✓</i> Tecnología de última generación</li>
                        <li><i class="icon-check">✓</i> Expedientes rápidos</li>
                        <li><i class="icon-check">✓</i> Especialistas capacitados en nuestro sistema</li>
                    </ul>
                </div>
                <div class="hero-images">
                    <div class="image-column">
                        <img src="images/Doctorarubia.jpg" width="350px" height="350px" alt="Doctora de pelo rubio" />
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="hero">
        <div class="container">
            <div class="hero-content-last">
                <div class="hero-text">
                    <h2>Pasarás menos tiempo usando el expediente clínico electrónico</h2>
                    <p>Expedined es un sistema de gestión de expedientes clínicos que combina todas las
                        funcionalidades esenciales con la potencia de la tecnología moderna. Es intuitivo, accesible
                        desde cualquier dispositivo con conexión a internet, y permite la creación, el envío y el
                        intercambio de expedientes de manera eficiente. Con Expedined Software, dedicas más tiempo a tus
                        pacientes y menos a la administración, facilitando el trabajo en equipo y la comunicación
                        con tus compañeros o pacientes.</p>
                </div>
                <div class="hero-images-last">
                    <div class="image-column">
                        <img src="images/Chicadenaranja.jpg" width="350px" height="350px" alt="naranjachica" />
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="features">
        <div class="container">
            <div class="feature">
                <div class="feature-content">
                    <h3 class="feature-title">Gestión Eficiente de Expedientes</h3>
                    <p>Facilita la organización y acceso a los expedientes médicos de tus pacientes en un solo lugar.
                    </p>
                </div>
                <img src="images/icons8-grupo-50.png" alt="Icono de Gestión de Expedientes">
            </div>
            <div class="feature">
                <div class="feature-content">
                    <h3 class="feature-title">Seguridad de Datos Médicos</h3>
                    <p>Protege la información sensible de tus pacientes con nuestras avanzadas medidas de seguridad.</p>
                </div>
                <img src="images/icons8-cuidado-50.png" alt="Icono de Seguridad de Datos">
            </div>
            <div class="feature">
                <div class="feature-content">
                    <h3 class="feature-title">Asesoría Médica Especializada</h3>
                    <p>Accede a un equipo de expertos que te brindan apoyo y asesoría en el uso del sistema.</p>
                </div>
                <img src="images/icons8-bata-de-laboratorio-médicos-50.png" alt="Icono de Asesoría Médica">
            </div>
            <div class="feature">
                <div class="feature-content">
                    <h3 class="feature-title">Atención Personalizada</h3>
                    <p>Recibe soporte técnico y atención a cualquier inconveniente que surja en el uso del software.</p>
                </div>
                <img src="images/icons8-24-7-signo-abierto-64.png" alt="Icono de Atención Personalizada">
            </div>
        </div>
    </section>

    <div id="successModal" class="modal-overlay hidden">
        <div class="modal-content-success">
            <span class="close"
                onclick="document.getElementById('successModal').classList.add('hidden')">&times;</span>
            <h2>Registro Exitoso</h2>
            <p>{{ session('success') }}</p>
        </div>
    </div>

    <footer>
        <div class="footer-copyright">
            @php
                $year = date('Y');
            @endphp
            <p>&copy; {{ $year }} Todos los derechos reservados por WD3.</p>
        </div>
    </footer>

    <script>
        function toggleUserMenu() {
            var dropdown = document.getElementById('user-dropdown');
            dropdown.style.display = dropdown.style.display === 'none' ? 'block' : 'none';
        }

        // Cerrar el menú al hacer clic fuera
        document.addEventListener('click', function(event) {
            var dropdown = document.getElementById('user-dropdown');
            var avatar = document.querySelector('.user-avatar');

            if (dropdown && avatar && !avatar.contains(event.target) && !dropdown.contains(event.target)) {
                dropdown.style.display = 'none';
            }
        });

        document.addEventListener('DOMContentLoaded', function() {
            // Verifica si hay un mensaje de éxito en la sesión
            @if (session('success'))
                document.getElementById('successModal').classList.remove('hidden');
            @endif

            var successModal = document.getElementById('successModal');
            var span = document.getElementsByClassName("close")[0];

            if (span && successModal) {
                span.onclick = function() {
                    successModal.classList.add('hidden');
                }

                // Cerrar el modal al hacer clic fuera
                window.onclick = function(event) {
                    if (event.target == successModal) {
                        successModal.classList.add('hidden');
                    }
                }
            }
        });

        function togglePassword(id, iconElement) {
            const input = document.getElementById(id);
            const icon = iconElement.querySelector('i');

            if (input.type === "password") {
                input.type = "text";
                icon.classList.remove('fa-eye');
                icon.classList.add('fa-eye-slash');
            } else {
                input.type = "password";
                icon.classList.remove('fa-eye-slash');
                icon.classList.add('fa-eye');
            }
        }

        document.addEventListener('DOMContentLoaded', function() {
            function togglePassword(id, iconElement) {
                const input = document.getElementById(id);
                const icon = iconElement.querySelector('i');

                if (input.type === "password") {
                    input.type = "text";
                    icon.classList.remove('fa-eye');
                    icon.classList.add('fa-eye-slash');
                } else {
                    input.type = "password";
                    icon.classList.remove('fa-eye-slash');
                    icon.classList.add('fa-eye');
                }
            }

            // Hacer la función togglePassword disponible globalmente
            window.togglePassword = togglePassword;
        });
    </script>
</body>

</html>
