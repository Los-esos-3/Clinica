<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

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
    transition: background 0.4s ease, color 0.4s ease, transform 0.4s ease; /* Transiciones más suaves */
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
    flex-direction: row-reverse; /* Invierte el orden de los elementos */
    align-items: center; /* Alinea los elementos verticalmente al centro */
    justify-content: space-between; /* Espacia los elementos */
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
    gap: 10px; /* Espacio entre las imágenes */
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
        background-color: rgba(0,0,0,0.4);
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

    .button1, .button2 {
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
  margin-top: 0; /* Reduce el margen superior del contenedor */
}

.content-text h1 {
  flex: 2; /* Hace que el texto ocupe más espacio */
  text-align: left;
  font-family: 'Lato', sans-serif; /* Tipografía moderna */
  font-size: 2 rem; /* Tamaño del texto reducido */
  line-height: 1.4; /* Espaciado entre líneas */
  color: #0A1B43; /* Color del texto */
  text-shadow: 2px 2px 5px rgba(0, 0, 0, 0.1); /* Sombra ligera */
  margin-top: 0; /* Reduce o elimina el margen superior */
  padding: 20px; /* Espaciado interno */
}
.content-text h2 {
  flex: 2; /* Hace que el texto ocupe más espacio */
  text-align: left;
  font-family: 'Lato', sans-serif; /* Tipografía moderna */
  font-size: 1.3rem; /* Tamaño del texto reducido */
  line-height: 1.4; /* Espaciado entre líneas */
  color: #3E5485; /* Color del texto */
  text-shadow: 1px 1px 4px rgba(0, 0, 0, 0.1); /* Sombra ligera */
  padding: 10px; /* Espaciado interno reducido */
}

.content-img {
  flex: 1; /* Ajusta el espacio de la imagen */
  display: flex;
  justify-content: flex-end;
}

.hero-content {
    display: flex;
    flex-direction: row-reverse; /* Invierte el orden de los elementos */
    align-items: center; /* Alinea los elementos verticalmente al centro */
    justify-content: space-between; /* Espacia los elementos */
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
    gap: 10px; /* Espacio entre las imágenes */
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
            $empresa = \App\Models\Empresa::first();
            $nombreEmpresa = $empresa ? $empresa->nombre : 'KAISER';
        @endphp

        <div class="header-title">
            <span class="kaiser">{{ $nombreEmpresa }}</span>
        </div>
        <nav>
            <ul>
                <li><a href="{{ url('/contactenos') }}">Contáctenos</a></li>

                @if (Route::has('login'))
                    @auth
                    <li>
                        <a href="{{ url('/dashboard') }}" style="margin-right: 15px;">Dashboard</a> <!-- Ajustar margen aquí -->

                        <div class="user-avatar" onclick="toggleUserMenu()">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" width="22" height="22">
                                <path d="M224 256A128 128 0 1 0 224 0a128 128 0 1 0 0 256zm-45.7 48C79.8 304 0 383.8 0 482.3C0 498.7 13.3 512 29.7 512l388.6 0c16.4 0 29.7-13.3 29.7-29.7C448 383.8 368.2 304 269.7 304l-91.4 0z"/>
                            </svg>
                        </div>

                        <!-- Menú desplegable para cerrar sesión -->
                        <div id="user-dropdown" class="user-dropdown" style="display: none;">
                            <span style="color: black; text-align: center; display: block;">{{ Auth::user()->name }}</span>
                            <div style="height: 1px; background-color: black; margin: 8px 0;"></div> <!-- Línea personalizada -->

                            <x-dropdown-link href="{{ route('profile.show') }}" style="color: black; text-align: center; display: block; padding: 8px 0;">
                                {{ __('Profile') }}

                            </x-dropdown-link>
                            <a href="{{ route('logout') }}"
                                onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();"
                                style="color: black; text-align: center; display: block; margin: 0; padding: 8px 0;"> <!-- Ajustar color y centrado -->
                                Salir de la cuenta
                                </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </div>
                    </li>
                    @else
                    <li>
                        <!-- Ícono de usuario desplegable antes de "Log in" -->
                        <a href="#" id="toggle-auth-links">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" width="22" height="22" style="vertical-align: middle; margin-right: 8px;">
                                <path d="M224 256A128 128 0 1 0 224 0a128 128 0 1 0 0 256zm-45.7 48C79.8 304 0 383.8 0 482.3C0 498.7 13.3 512 29.7 512l388.6 0c16.4 0 29.7-13.3 29.7-29.7C448 383.8 368.2 304 269.7 304l-91.4 0z"/>
                            </svg>
                        </a>

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
          <h1>Bienvenido a nuestro software de expedientes médicos.</h1>
          <h2>Optimiza la gestión de tus expedientes médicos con un software diseñado para simplificar procesos y mejorar la atención desde cualquier lugar.</h2>
        </div>

        <div class="content-img">
          <img src="{{ asset('images/Doctorviendolaptop.jpg') }}" alt="Doctor viendo una computadora" style="width: 550px; height: auto;">
        </div>
      </div>


<section class="hero">
    <div class="container">
        <div class="hero-content">
            <div class="hero-text">
                <h2 style="text-align: center">Innovamos en Nuestros expedientes clinicos</h2>
                <p>Transforma la forma en que gestionas tus expedientes clínicos con nuestra solución digital avanzada. Simplificamos tus procesos, mejoramos la accesibilidad y garantizamos un manejo seguro y eficiente de la información médica, todo desde una plataforma centralizada..</p>
                <ul class="features-list">
                    <li><i class="icon-check"></i> Tecnología de última generación</li>
                    <li><i class="icon-check"></i> Expedientes rapidos</li>
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
                <h2>Pasarás menos tiempo usando el Expediente Clínico Electrónico</h2>
                <p>Kaizen Software es un sistema de gestión de expedientes clínicos que combina todas las funcionalidades esenciales con la potencia de la tecnología moderna. Es intuitivo, accesible desde cualquier dispositivo con conexión a internet y permite la creación, el envío y el intercambio de expedientes de manera eficiente. Con Kaizen Software, dedica más tiempo a tus pacientes y menos tiempo a la administración, facilitando el trabajo en equipo y la comunicación con tus compañeros o pacientes..</p>
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
            <form action="{{ route('login') }}" method="POST" class="form">
                @csrf
                <div class="field">
                    <svg class="input-icon" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                        <path d="M13.106 7.222c0-2.967-2.249-5.032-5.482-5.032-3.35 0-5.646 2.318-5.646 5.702 0 3.493 2.235 5.708 5.762 5.708.862 0 1.689-.123 2.304-.335v-.862c-.43.199-1.354.328-2.29.328-2.926 0-4.813-1.88-4.813-4.798 0-2.844 1.921-4.881 4.594-4.881 2.735 0 4.608 1.688 4.608 4.156 0 1.682-.554 2.769-1.416 2.769-.492 0-.772-.28-.772-.76V5.206H8.923v.834h-.11c-.266-.595-.881-.964-1.6-.964-1.4 0-2.378 1.162-2.378 2.823 0 1.737.957 2.906 2.379 2.906.8 0 1.415-.39 1.709-1.087h.11c.081.67.703 1.148 1.503 1.148 1.572 0 2.57-1.415 2.57-3.643zm-7.177.704c0-1.197.54-1.907 1.456-1.907.93 0 1.524.738 1.524 1.907S8.308 9.84 7.371 9.84c-.895 0-1.442-.725-1.442-1.914z"></path>
                    </svg>
                    <input type="email" id="email" name="email" class="input-field" placeholder="Correo electrónico" required>
                </div>
                <div class="field">
                    <svg class="input-icon" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                        <path d="M8 1a2 2 0 0 1 2 2v4H6V3a2 2 0 0 1 2-2zm3 6V3a3 3 0 0 0-6 0v4a2 2 0 0 0-2 2v5a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V9a2 2 0 0 0-2-2z"></path>
                    </svg>
                    <input type="password" id="password" name="password" class="input-field" placeholder="Contraseña" required>
                </div>
                <div class="btn">
                    <button type="submit" class="button1">Iniciar Sesión</button>
                    <button type="button" onclick="window.location.href='{{ route('register') }}'" class="button2">Registrarse</button>
                </div>
                <button type="button" class="button3">Olvidé mi contraseña</button>
            </form>
        </div>
    </div>

    <footer>
        <div class="footer-container">
            <div class="footer-column">
                <h4>Acerca de nosotros</h4>
                <p>Bienvenido a la sección de gestión de expedientes médicos. Aquí podrás registrar, organizar y acceder de manera eficiente a la información clínica de tus pacientes. Nuestro sistema está diseñado para facilitar tu trabajo y garantizar la seguridad y confidencialidad de los datos, ayudándote a ofrecer una atención de calidad.</p>
            </div>
            <div class="footer-column">
                <h4>Horario de atención</h4>
                @php
                    $empresa = \App\Models\Empresa::first();
                @endphp

                @if($empresa && $empresa->horario)
                    <p>{{ $empresa->horario }}</p>
                @else
                    <p>Horario no disponible</p>
                @endif
            </div>
            <div class="footer-column">
                <h4>Contáctenos</h4>
                @php
                    $empresa = \App\Models\Empresa::first();
                @endphp
                <ul>
                    <li>
                        <a href="https://www.google.com.mx/maps/place/Kaizen+Business+Training/@25.8694126,-97.5038464,19z/data=!4m6!3m5!1s0x866feb74305d47a3:0x5ceb7d0b261d15d7!8m2!3d25.8694124!4d-97.5033911!16s%2Fg%2F11jzkyh2cx?entry=ttu&g_ep=EgoyMDI0MTAwMi4xIKXMDSoASAFQAw%3D%3D" target="_blank">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512" width="22" height="22" style="vertical-align: middle; margin-right: 8px;">
                              <path d="M215.7 499.2C267 435 384 279.4 384 192C384 86 298 0 192 0S0 86 0 192c0 87.4 117 243 168.3 307.2c12.3 15.3 35.1 15.3 47.4 0zM192 128a64 64 0 1 1 0 128 64 64 0 1 1 0-128z"/>
                            </svg>
                            Pedro José Méndez, Industrial, 87350 Heroica Matamoros, Tamps.
                        </a>
                    </li>
                    <li>
                        @if($empresa && $empresa->telefono)
                            <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $empresa->telefono) }}" target="_blank">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" width="22" height="22" style="vertical-align: middle; margin-right: 8px;">
                                    <path d="M164.9 24.6c-7.7-18.6-28-28.5-47.4-23.2l-88 24C12.1 30.2 0 46 0 64C0 311.4 200.6 512 448 512c18 0 33.8-12.1 38.6-29.5l24-88c5.3-19.4-4.6-39.7-23.2-47.4l-96-40c-16.3-6.8-35.2-2.1-46.3 11.6L304.7 368C234.3 334.7 177.3 277.7 144 207.3L193.3 167c13.7-11.2 18.4-30 11.6-46.3l-40-96z"/>
                                </svg>
                                {{ $empresa->telefono }}
                            </a>
                        @else
                            <span>Teléfono no disponible</span>
                        @endif
                    </li>
                    <li>
                        @if($empresa && $empresa->email)
                            <a href="mailto:{{ $empresa->email }}" target="_blank">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" width="22" height="22" style="vertical-align: middle; margin-right: 8px;">
                                    <path d="M64 112c-8.8 0-16 7.2-16 16l0 22.1L220.5 291.7c20.7 17 50.4 17 71.1 0L464 150.1l0-22.1c0-8.8-7.2-16-16-16L64 112zM48 212.2L48 384c0 8.8 7.2 16 16 16l384 0c8.8 0 16-7.2 16-16l0-171.8L322 328.8c-38.4 31.5-93.7 31.5-132 0L48 212.2zM0 128C0 92.7 28.7 64 64 64l384 0c35.3 0 64 28.7 64 64l0 256c0 35.3-28.7 64-64 64L64 448c-35.3 0-64-28.7-64-64L0 128z"/>
                                </svg>
                                {{ $empresa->email }}
                            </a>
                        @else
                            <span>Correo no disponible</span>
                        @endif
                    </li>
                </ul>
                <div class="card">
                    <a href="#" class="socialContainer containerOne">
                        <svg class="socialSvg instagramSvg" viewBox="0 0 16 16">
                          <path
                            d="M8 0C5.829 0 5.556.01 4.703.048 3.85.088 3.269.222 2.76.42a3.917 3.917 0 0 0-1.417.923A3.927 3.927 0 0 0 .42 2.76C.222 3.268.087 3.85.048 4.7.01 5.555 0 5.827 0 8.001c0 2.172.01 2.444.048 3.297.04.852.174 1.433.372 1.942.205.526.478.972.923 1.417.444.445.89.719 1.416.923.51.198 1.09.333 1.942.372C5.555 15.99 5.827 16 8 16s2.444-.01 3.298-.048c.851-.04 1.434-.174 1.943-.372a3.916 3.916 0 0 0 1.416-.923c.445-.445.718-.891.923-1.417.197-.509.332-1.09.372-1.942C15.99 10.445 16 10.173 16 8s-.01-2.445-.048-3.299c-.04-.851-.175-1.433-.372-1.941a3.926 3.926 0 0 0-.923-1.417A3.911 3.911 0 0 0 13.24.42c-.51-.198-1.092-.333-1.943-.372C10.443.01 10.172 0 7.998 0h.003zm-.717 1.442h.718c2.136 0 2.389.007 3.232.046.78.035 1.204.166 1.486.275.373.145.64.319.92.599.28.28.453.546.598.92.11.281.24.705.275 1.485.039.843.047 1.096.047 3.231s-.008 2.389-.047 3.232c-.035.78-.166 1.203-.275 1.485a2.47 2.47 0 0 1-.599.919c-.28.28-.546.453-.92.598-.28.11-.704.24-1.485.276-.843.038-1.096.047-3.232.047s-2.39-.009-3.233-.047c-.78-.036-1.203-.166-1.485-.276a2.478 2.478 0 0 1-.92-.598 2.48 2.48 0 0 1-.6-.92c-.109-.281-.24-.705-.275-1.485-.038-.843-.046-1.096-.046-3.233 0-2.136.008-2.388.046-3.231.036-.78.166-1.204.276-1.486.145-.373.319-.64.599-.92.28-.28.546-.453.92-.598.282-.11.705-.24 1.485-.276.738-.034 1.024-.044 2.515-.045v.002zm4.988 1.328a.96.96 0 1 0 0 1.92.96.96 0 0 0 0-1.92zm-4.27 1.122a4.109 4.109 0 1 0 0 8.217 4.109 4.109 0 0 0 0-8.217zm0 1.441a2.667 2.667 0 1 1 0 5.334 2.667 2.667 0 0 1 0-5.334z"
                          ></path>
                        </svg>
                      </a>

                    <a href="#" class="socialContainer containerTwo">
                        <svg
                          class="socialSvg tiktokSvg largeIcon"
                          viewBox="0 0 48 48"
                          version="1.1"
                          xmlns="http://www.w3.org/2000/svg"
                          xmlns:xlink="http://www.w3.org/1999/xlink"
                        >
                          <title>Tiktok</title>
                          <g
                            id="Icon/Social/tiktok-white"
                            stroke="none"
                            stroke-width="1"
                            fill="none"
                            fill-rule="evenodd"
                          >
                            <path
                              d="M38.0766847,15.8542954 C36.0693906,15.7935177 34.2504839,14.8341149 32.8791434,13.5466056 C32.1316475,12.8317108 31.540171,11.9694126 31.1415066,11.0151329 C30.7426093,10.0603874 30.5453728,9.03391952 30.5619062,8 L24.9731521,8 L24.9731521,28.8295196 C24.9731521,32.3434487 22.8773693,34.4182737 20.2765028,34.4182737 C19.6505623,34.4320127 19.0283477,34.3209362 18.4461858,34.0908659 C17.8640239,33.8612612 17.3337909,33.5175528 16.8862248,33.0797671 C16.4386588,32.6422142 16.0833071,32.1196657 15.8404292,31.5426268 C15.5977841,30.9658208 15.4727358,30.3459348 15.4727358,29.7202272 C15.4727358,29.0940539 15.5977841,28.4746337 15.8404292,27.8978277 C16.0833071,27.3207888 16.4386588,26.7980074 16.8862248,26.3604545 C17.3337909,25.9229017 17.8640239,25.5791933 18.4461858,25.3491229 C19.0283477,25.1192854 19.6505623,25.0084418 20.2765028,25.0219479 C20.7939283,25.0263724 21.3069293,25.1167239 21.794781,25.2902081 L21.794781,19.5985278 C21.2957518,19.4900128 20.7869423,19.436221 20.2765028,19.4380839 C18.2431278,19.4392483 16.2560928,20.0426009 14.5659604,21.1729264 C12.875828,22.303019 11.5587449,23.9090873 10.7814424,25.7878401 C10.003907,27.666593 9.80084889,29.7339663 10.1981162,31.7275214 C10.5953834,33.7217752 11.5748126,35.5530237 13.0129853,36.9904978 C14.4509252,38.4277391 16.2828722,39.4064696 18.277126,39.8028054 C20.2711469,40.1991413 22.3382874,39.9951517 24.2163416,39.2169177 C26.0948616,38.4384508 27.7002312,37.1209021 28.8296253,35.4300711 C29.9592522,33.7397058 30.5619062,31.7522051 30.5619062,29.7188301 L30.5619062,18.8324027 C32.7275484,20.3418321 35.3149087,21.0404263 38.0766847,21.0867664 L38.0766847,15.8542954 Z"
                              id="Fill-1"
                              fill="#FFFFFF"
                            ></path>
                          </g>
                        </svg>
                      </a>

                    <a href="#" class="socialContainer containerThree">
                      <div>
                        <svg
                          class="socialSvg tiktokSvg largeIcon"
                          width="44px"
                          height="44px"
                          viewBox="0 0 45 35"
                          version="1.1"
                          xmlns="http://www.w3.org/2000/svg"
                          xmlns:xlink="http://www.w3.org/1999/xlink"
                        >
                          <title>Facebook</title>
                          <g
                            id="Icon/Social/facebook-black"
                            stroke="none"
                            stroke-width="1"
                            fill="none"
                            fill-rule="evenodd"
                          >
                            <path
                              d="M30.0793333,40 L30.0793333,27.608 L34.239,27.608 L34.8616667,22.7783333 L30.0793333,22.7783333 L30.0793333,19.695 C30.0793333,18.2966667 30.4676667,17.344 32.4726667,17.344 L35.0303333,17.3426667 L35.0303333,13.0233333 C34.5876667,12.9646667 33.0696667,12.833 31.3036667,12.833 C27.6163333,12.833 25.0923333,15.0836667 25.0923333,19.2166667 L25.0923333,22.7783333 L20.922,22.7783333 L20.922,27.608 L25.0923333,27.608 L25.0923333,40 L30.0793333,40 Z M9.766,40 C8.79033333,40 8,39.209 8,38.234 L8,9.766 C8,8.79033333 8.79033333,8 9.766,8 L38.2336667,8 C39.209,8 40,8.79033333 40,9.766 L40,38.234 C40,39.209 39.209,40 38.2336667,40 L9.766,40 Z"
                              id="Shape"
                              fill="#FFFFFF"
                            ></path>
                          </g>
                        </svg>
                      </div>
                    </a>
                    <a href="#" class="socialContainer containerFour">
                      <svg class="socialSvg whatsappSvg" viewBox="0 0 16 16">
                        <path
                          d="M13.601 2.326A7.854 7.854 0 0 0 7.994 0C3.627 0 .068 3.558.064 7.926c0 1.399.366 2.76 1.057 3.965L0 16l4.204-1.102a7.933 7.933 0 0 0 3.79.965h.004c4.368 0 7.926-3.558 7.93-7.93A7.898 7.898 0 0 0 13.6 2.326zM7.994 14.521a6.573 6.573 0 0 1-3.356-.92l-.24-.144-2.494.654.666-2.433-.156-.251a6.56 6.56 0 0 1-1.007-3.505c0-3.626 2.957-6.584 6.591-6.584a6.56 6.56 0 0 1 4.66 1.931 6.557 6.557 0 0 1 1.928 4.66c-.004 3.639-2.961 6.592-6.592 6.592zm3.615-4.934c-.197-.099-1.17-.578-1.353-.646-.182-.065-.315-.099-.445.099-.133.197-.513.646-.627.775-.114.133-.232.148-.43.05-.197-.1-.836-.308-1.592-.985-.59-.525-.985-1.175-1.103-1.372-.114-.198-.011-.304.088-.403.087-.088.197-.232.296-.346.1-.114.133-.198.198-.33.065-.134.034-.248-.015-.347-.05-.099-.445-1.076-.612-1.47-.16-.389-.323-.335-.445-.34-.114-.007-.247-.007-.38-.007a.729.729 0 0 0-.529.247c-.182.198-.691.677-.691 1.654 0 .977.71 1.916.81 2.049.098.133 1.394 2.132 3.383 2.992.47.205.84.326 1.129.418.475.152.904.129 1.246.08.38-.058 1.171-.48 1.338-.943.164-.464.164-.86.114-.943-.049-.084-.182-.133-.38-.232z"
                        ></path>
                      </svg>
                    </a>
                  </div>

            </div>

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
        var span = document.getElementsByClassName("close")[0];
        var body = document.body;

        // Verificar si el usuario está autenticado
        @auth
            // Si el usuario está autenticado, no mostrar el modal
            modal.style.display = "none";
        @else
            // Si el usuario no está autenticado, mostrar el modal
            modal.style.display = "block";
            body.classList.add('modal-open');

            span.onclick = function() {
                modal.style.display = "none";
                body.classList.remove('modal-open');
            }

            // Prevenir que el modal se cierre al hacer clic fuera de él
            window.onclick = function(event) {
                if (event.target == modal) {
                    event.stopPropagation();
                }
            }

            modal.querySelector('.modal-content').onclick = function(event) {
                event.stopPropagation();
            }

            // Manejar el envío del formulario de inicio de sesión
            var loginForm = document.querySelector('#loginModal form');
            loginForm.addEventListener('submit', function(event) {
                // No prevenimos el envío del formulario aquí
                // El formulario se enviará normalmente al servidor
            });
        @endauth
    });
</script>
