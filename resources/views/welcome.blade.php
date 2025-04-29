<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Expemed</title>

    <link href="https://fonts.googleapis.com/css2?family=Lato:wght@400;700&display=swap" rel="stylesheet">

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
            background: linear-gradient(to right, #a7d3e0, #003366);
            color: #fff;
            padding: 10px 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            position: relative;
        }

        .header-title {
            font-family: 'Arial', sans-serif;
            font-weight: 400;
            color: #fff;
            text-align: left;
            margin-left: 20px;
            transition: transform 0.3s ease;
        }

        .header-title .kaiser {
            font-size: 28px;
            font-weight: bold;
            color: #fff;
            text-transform: uppercase;
            letter-spacing: 2px;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
            display: block;
        }

        header nav ul {
            list-style-type: none;
            padding: 0;
            margin: 0;
            display: flex;
            align-items: center;
            gap: 40px;
        }

        header nav ul li {
            position: relative;
        }

        header nav ul li a {
            color: #fff;
            text-decoration: none;
            padding: 10px 15px;
            display: inline-block;
            transition: background 0.4s ease, color 0.4s ease, transform 0.4s ease;
            /* Transiciones más suaves */
            border-radius: 20px;
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

        @media (max-width: 768px) {
            header {
                flex-direction: column;
                align-items: flex-start;
            }

            header nav ul {
                flex-direction: column;
                gap: 20px;
                margin-top: 20px;
            }

            header .header-logo {
                margin-bottom: 15px;
            }

            #auth-links {
                right: auto;
                left: 50%;
                transform: translateX(-50%);
            }
        }



        .content h1 {
            font-size: 3rem;
            margin: 0 0 20px;
            font-weight: bold;
            text-transform: uppercase;
        }

        .content p {
            font-size: 1.5rem;
            max-width: 800px;
            text-align: center;
        }

        footer {
            background-color: #003366;
            color: #fff;
            padding: 10px 20px;
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
            align-items: center;
        }

        .footer-container {
            display: flex;
            justify-content: space-between;
            max-width: 1200px;
            margin: 0 auto;
            flex-wrap: wrap;
            width: 100%;
        }

        .footer-column {
            width: 30%;
            margin: 0;
            text-align: left;
        }

        .footer-column h4 {
            margin-top: 0;
            border-bottom: 2px solid #88c8de;
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
            background-color: #002244;
            padding: 10px;
            text-align: center;
            clear: both;
            width: 100%;
        }

        .footer-opening-hours {
            display: flex;
            justify-content: space-between;
            align-items: center;
            width: 100%;
            margin: 20px 0;
        }

        .footer-opening-hours h4 {
            margin: 0 10px 0 0;
        }

        .footer-opening-hours p {
            margin: 0 10px;
        }

        .footer-column li {
            margin-bottom: 30px;
        }


        .hero {
            background-color: #f9f9f9;
            padding: 60px 0;
        }

        .hero .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
        }

        .hero-content {
            display: flex;
            flex-direction: row-reverse;
            /* Invierte el orden de los elementos */
            align-items: center;
            /* Alinea los elementos verticalmente al centro */
            justify-content: space-between;
            /* Espacia los elementos */
        }

        .hero-text {
            flex: 1;
            max-width: 50%;
        }

        .hero-text h2 {
            font-size: 36px;
            color: #0A1B43;
            margin-bottom: 20px;
        }

        .hero-text p {
            font-size: 16px;
            color: #3E5485;
            margin-bottom: 20px;
        }

        .hero-images {
            display: flex;
            flex: 1;
            flex-wrap: wrap;
            gap: 10px;
            /* Espacio entre las imágenes */
        }

        .hero-images img {
            border-radius: 10px;
            box-shadow: 0 4px 8px #3a4f7c(0, 0, 0, 0.1);
            max-width: 100%;
            height: auto;
        }


        .features-list {
            text-align: center;
            list-style: none;
            padding: 0;
        }

        .features-list li {
            font-size: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 10px;
        }

        .features-list li .icon-check {
            font-size: 18px;
            color: #00aaff;
        }


        .image-column {
            display: flex;
            flex-direction: column;
            gap: 20px;
        }

        .middle-image {
            margin-top: 15px;
        }

        .features {
            background-color: #ffffff;
            padding: 40px 0;
        }

        .features .container {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
            align-items: flex-start;
            max-width: 1100px;
            margin: 0 auto;
            gap: 20px;
        }

        .feature {
            display: flex;
            align-items: center;
            background-color: #f0f0f0;
            padding: 15px;
            border-radius: 8px;
            width: 90%;
            max-width: 500px;
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
        }

        .feature img {
            width: 50px;
            height: 50px;
            object-fit: contain;
            transition: filter 0.4s ease;
        }

        .feature:hover img {
            filter: brightness(0) invert(1);
        }
        .feature:hover {
            background: linear-gradient(135deg, #a7d3e0 0%, #003366 100%);
            color: #ffffff;
            transform: scale(1.02);
        }

        .user-avatar {
            display: inline-block;
            cursor: pointer;
        }

        .user-dropdown {
            position: absolute;
            z-index: 1;
            background-color: white;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
            padding: 10px;
            border-radius: 5px;
            top: 50px;
            right: 0;
        }

        .user-dropdown span {
            display: block;
            margin-bottom: 10px;
        }

        .card {
            width: fit-content;
            height: fit-content;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 25px 25px;
            gap: 20px;
            box-shadow: 0px 0px 20px rgba(0, 0, 0, 0.055);
        }

        .socialContainer {
            width: 52px;
            height: 52px;
            border-radius: 5px;
            background-color: rgb(44, 44, 44);
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
            transition-duration: 0.3s;
        }

        /* instagram*/
        .containerOne:hover {
            background-color: #d62976;
            transition-duration: 0.3s;
        }

        /* Tiktok*/
        .containerTwo:hover {
            background-color: #25f4ee;
            transition-duration: 0.3s;
        }

        /* Facebook*/
        .containerThree:hover {
            background-color: #1877f2;
            transition-duration: 0.3s;
        }

        /* Whatsapp*/
        .containerFour:hover {
            background-color: green;
            transition-duration: 0.3s;
        }

        .socialContainer:active {
            transform: scale(0.9);
            transition-duration: 0.3s;
        }

        .socialSvg {
            width: 20px;
        }

        .largeIcon {
            width: 27px;
        }

        .socialSvg path {
            fill: rgb(255, 255, 255);
        }

        .socialContainer:hover .socialSvg {
            animation: slide-in-top 0.3s both;
        }

        @keyframes slide-in-top {
            0% {
                transform: translateY(-50px);
                opacity: 0;
            }

            100% {
                transform: translateY(0);
                opacity: 1;
            }
        }

        .modal {
            display: none;
            position: fixed;
            z-index: 1000;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0, 0, 0, 0.4);
        }

        .modal-content {
            background: linear-gradient(135deg, #a7d3e0, #003366);
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            padding: 2em;
            border-radius: 25px;
            width: 90%;
            max-width: 400px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            transition: .4s ease-in-out;
            color: white;
        }

        .close {
            color: #fff;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }

        .close:hover,
        .close:focus {
            color: #000;
            text-decoration: none;
            cursor: pointer;
        }

        .modal-content h2 {
            text-align: center;
            margin: 0.5em 0 1.5em;
            color: #fff;
            font-size: 1.5em;
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
        }

        .input-icon {
            height: 1.3em;
            width: 1.3em;
            fill: #666;
        }

        .input-field {
            background: none;
            border: none;
            outline: none;
            width: 100%;
            color: #333;
            font-size: 1em;
        }

        .input-field::placeholder {
            color: #999;
        }

        .input-field:-webkit-autofill,
        .input-field:-webkit-autofill:hover,
        .input-field:-webkit-autofill:focus {
            -webkit-box-shadow: 0 0 0px 1000px white inset;
            -webkit-text-fill-color: #333;
        }

        .btn {
            display: flex;
            flex-direction: column;
            gap: 1em;
            margin-top: 2em;
        }

        .button1,
        .button2 {
            padding: 0.7em 1.5em;
            border-radius: 25px;
            border: none;
            outline: none;
            transition: .3s ease-in-out;
            cursor: pointer;
            font-size: 1em;
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
            font-size: 1em;
            text-decoration: underline;
        }

        .button3:hover {
            color: #ccc;
        }

        body.modal-open {
            overflow: hidden;
            position: fixed;
            width: 100%;
            height: 100%;
        }

        .modal {
            overflow-y: auto;
            max-height: 100vh;
        }

        .content {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 25px;
            gap: 20px;
            margin-top: 0;
            /* Reduce el margen superior del contenedor */
        }

        .content-text h1 {
            flex: 2;
            /* Hace que el texto ocupe más espacio */
            text-align: left;
            font-family: 'Lato', sans-serif;
            /* Tipografía moderna */
            font-size: 2 rem;
            /* Tamaño del texto reducido */
            line-height: 1.4;
            /* Espaciado entre líneas */
            color: #0A1B43;
            /* Color del texto */
            text-shadow: 2px 2px 5px rgba(0, 0, 0, 0.1);
            /* Sombra ligera */
            margin-top: 0;
            /* Reduce o elimina el margen superior */
            padding: 20px;
            /* Espaciado interno */
        }

        .content-text h2 {
            flex: 2;
            /* Hace que el texto ocupe más espacio */
            text-align: left;
            font-family: 'Lato', sans-serif;
            /* Tipografía moderna */
            font-size: 1.3rem;
            /* Tamaño del texto reducido */
            line-height: 1.4;
            /* Espaciado entre líneas */
            color: #3E5485;
            /* Color del texto */
            text-shadow: 1px 1px 4px rgba(0, 0, 0, 0.1);
            /* Sombra ligera */
            padding: 10px;
            /* Espaciado interno reducido */
        }

        .content-img {
            flex: 1;
            /* Ajusta el espacio de la imagen */
            display: flex;
            justify-content: flex-end;
        }

        .hero-content {
            display: flex;
            flex-direction: row-reverse;
            /* Invierte el orden de los elementos */
            align-items: center;
            /* Alinea los elementos verticalmente al centro */
            justify-content: space-between;
            /* Espacia los elementos */
        }

        .hero-text {
            flex: 1;
            max-width: 50%;
        }

        .hero-text h2 {
            font-size: 36px;
            color: #0A1B43;
            margin-bottom: 20px;
        }

        .hero-text p {
            font-size: 16px;
            color: #3E5485;
            margin-bottom: 20px;
        }

        .hero-images {
            display: flex;
            flex: 1;
            flex-wrap: wrap;
            gap: 10px;
            /* Espacio entre las imágenes */
        }

        .hero-images img {
            border-radius: 10px;
            box-shadow: 0 4px 8px #3a4f7c(0, 0, 0, 0.1);
            max-width: 100%;
            height: auto;
        }

        .image-column {
            display: flex;
            flex-direction: column;
            gap: 20px;
        }
    </style>
</head>

<body>

    <header>
        @php
            $nombreEmpresa = 'Expedmed'; // Valor por defecto

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
                            @if (Auth::user()->hasAnyRole(['Root','Admin', 'Doctor', 'Secretaria']))
                                <a href="{{ url('/dashboard') }}" style="margin-right: 15px;">Agenda</a>
                            @endif

                            <!-- Ajustar margen aquí -->

                            <div class="user-avatar" onclick="toggleUserMenu()">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" width="22" height="22">
                                    <path
                                        d="M224 256A128 128 0 1 0 224 0a128 128 0 1 0 0 256zm-45.7 48C79.8 304 0 383.8 0 482.3C0 498.7 13.3 512 29.7 512l388.6 0c16.4 0 29.7-13.3 29.7-29.7C448 383.8 368.2 304 269.7 304l-91.4 0z" />
                                </svg>
                            </div>

                            <!-- Menú desplegable para cerrar sesión -->
                            <div id="user-dropdown" class="user-dropdown" style="display: none;">
                                <span
                                    style="color: black; text-align: center; display: block;">{{ Auth::user()->name }}</span>
                                <div style="height: 1px; background-color: black; margin: 8px 0;"></div>
                                <!-- Línea personalizada -->

                                <x-dropdown-link href="{{ route('profile.show') }}"
                                    style="color: black; text-align: center; display: block; padding: 8px 0;">
                                    {{ __('Profile') }}

                                </x-dropdown-link>
                                <a href="{{ route('logout') }}"
                                    onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();"
                                    style="color: black; text-align: center; display: block; margin: 0; padding: 8px 0;">
                                    <!-- Ajustar color y centrado -->
                                    Salir de la cuenta
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            </div>
                        </li>
                    @else
                        <li>
                            <!-- Cambiar el ícono por la palabra "Ingresar" -->
                            <a href="#" id="toggle-auth-links">Ingresa</a>

                            <!-- Enlaces de autenticación que se muestran/ocultan -->
                            <div id="auth-links" style="display: none;">
                                <a href="{{ route('login') }}">Log in</a>

                                @if (Route::has('register'))
                                    <a href="{{ route('register') }}">Registro</a>
                                @endif
                            </div>
                        </li>
                    @endauth
                @endif
            </ul>
        </nav>
    </header>



    <div class="content">
        <div class="content-text">
            <h1>Sistema para la gestión de expedientes médicos.</h1>
            <h2>Optimiza la gestión de tus expedientes médicos con un software diseñado para simplificar procesos y
                mejorar la atención desde cualquier lugar.</h2>
        </div>

        <div class="content-img">
            <img src="{{ asset('images/Doctorviendolaptop.jpg') }}" alt="Doctor viendo una computadora"
                style="width: 550px; height: auto;">
        </div>
    </div>


    <section class="hero">
        <div class="container">
            <div class="hero-content">
                <div class="hero-text">
                    <h2 style="text-align: center">Innovamos en nuestros expedientes clínicos</h2>
                    <p>Transforma la forma en que gestionas tus expedientes clínicos con nuestra solución digital
                        avanzada. Simplificamos tus procesos, mejoramos la accesibilidad y garantizamos un manejo seguro
                        y eficiente de la información médica, todo desde una plataforma centralizada.</p>
                    <ul class="features-list">
                        <li><i class="icon-check"></i> Tecnología de última generación</li>
                        <li><i class="icon-check"></i> Expedientes rápidos</li>
                        <li><i class="icon-check"></i> Especialistas capacitados en nuestro sistema</li>
                    </ul>
                </div>
                <div class="hero-images">
                    <div class="image-column">
                        <img src="images/Doctorarubia.jpg" alt="Doctora de pelo rubio" />
                    </div>
                </div>
            </div>
        </div>
        </div>
    </section>



    <section class="hero">
        <div class="container">
            <div class="hero-content">
                <div class="hero-text">
                    <h2>Pasarás menos tiempo usando el expediente clínico electrónico</h2>
                    <p>Expemed es un sistema de gestión de expedientes clínicos que combina todas las
                        funcionalidades esenciales con la potencia de la tecnología moderna. Es intuitivo, accesible
                        desde cualquier dispositivo con conexión a internet, y permite la creación, el envío y el
                        intercambio de expedientes de manera eficiente. Con Kaizen Software, dedicas más tiempo a tus
                        pacientes y menos a la administración, facilitando el trabajo en equipo y la comunicación
                        con tus compañeros o pacientes.</p>
                    <ul class="features-list">
                    </ul>
                </div>
                <div class="hero-images">
                    <div class="image-column">
                        <img src="images/Chicadenaranja.jpg" alt="naranjachica" />
                    </div>
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
                    <p>Facilita la organización y acceso a los expedientes médicos de tus pacientes en un solo lugar.</p>
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
                <img src="images/icons8-bata-de-laboratorio-médicos-50.png" alt="">
            </div>
            <div class="feature">
                <div class="feature-content">
                    <h3 class="feature-title">Atención Personalizada</h3>
                    <p>Recibe soporte técnico y atención a cualquier inconveniente que surja en el uso del software.</p>
                </div>
                <img src="images/icons8-24-7-signo-abierto-64.png" alt="">
            </div>
        </div>
    </section>

    <div id="loginModal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
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

    <div id="successModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="document.getElementById('successModal').style.display='none'">&times;</span>
            <h2>Registro Exitoso</h2>
            <p>{{ session('success') }}</p>
        </div>
    </div>

    <footer>
        <div class="footer-copyright">
            <p>&copy; 2023 Todos los derechos reservados por WD3.</p>
        </div>
    </footer>
</body>

</html>

<script>
    document.getElementById('toggle-auth-links').addEventListener('click', function(event) {
        event.preventDefault(); // Evitar el comportamiento predeterminado del enlace
        var modal = document.getElementById('loginModal');
        var body = document.body;
        modal.style.display = 'block'; // Mostrar el modal
        body.classList.add('modal-open');
    });
</script>

<script>
    function toggleUserMenu() {
        var dropdown = document.getElementById('user-dropdown');
        dropdown.style.display = dropdown.style.display === 'none' ? 'block' : 'none';
    }

    // Cerrar el menú al hacer clic fuera
    document.addEventListener('click', function(event) {
        var dropdown = document.getElementById('user-dropdown');
        var avatar = document.querySelector('.user-avatar');

        if (!avatar.contains(event.target) && !dropdown.contains(event.target)) {
            dropdown.style.display = 'none';
        }
    });
</script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        var modal = document.getElementById('loginModal');
        var successModal = document.getElementById('successModal');
        var span = document.getElementsByClassName("close")[0];
        var body = document.body;

        // Mostrar el modal de éxito si hay un mensaje de éxito
        @if (session('success'))
            successModal.style.display = "block";
            body.classList.add('modal-open');
        @endif

        span.onclick = function() {
            modal.style.display = "none";
            successModal.style.display = "none";
            body.classList.remove('modal-open');
        }

        // Cerrar el modal al hacer clic fuera
        window.onclick = function(event) {
            if (event.target == modal || event.target == successModal) {
                modal.style.display = "none";
                successModal.style.display = "none";
                body.classList.remove('modal-open');
            }
        }
    });
</script>
