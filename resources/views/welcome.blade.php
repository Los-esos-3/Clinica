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
}

.header-title .kaiser {
    font-size: 36px;
    font-weight: bold;
    color: #fff;
    text-transform: uppercase;
    letter-spacing: 2px;
    text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
    display: block;
}

.header-title .subtext {
    font-size: 20px;
    font-style: italic;
    color:  #fff;
    margin-top: 5px;
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
    border-radius: 20px;
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


.content {
    background-image: url('images/doctores.jpg');
    background-size: cover
    background-position: center;
    background-repeat: no-repeat;
    height: 100vh;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    color: #fff;
    text-shadow: 2px 2px 8px rgba(0, 0, 0, 0.7);
    padding: 20px;
    box-sizing: border-box;
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
    align-items: center;
    justify-content: space-between;
    flex-wrap: wrap;
}

.hero-text {
    flex: 1;
    max-width: 50%;
}

.hero-text h2 {
    font-size: 36px;
    color: #333;
    margin-bottom: 20px;
}

.hero-text p {
    font-size: 16px;
    color: #555;
    margin-bottom: 20px;
}
.hero-images {
    display: flex;
    justify-content: space-between;
    gap: 15px;
}
.hero-images img {
    border-radius: 10px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
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
  justify-content: center;
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

    </style>
</head>
<body>
    <header>
        <div class="header-title">
            <span class="kaiser">KAISER</span>
            <span class="subtext">Clínica de Salud</span>
        </div>
        <nav>
            <ul>

                <li><a href="#">Farmacia</a></li>
                <li><a href="{{ url('/contactenos') }}">Contáctenos</a></li>
                @if (Route::has('login'))
                <li>
                    @auth
                        <a href="{{ url('/dashboard') }}">Dashboard</a>
                    @else
                        <a href="#" id="toggle-auth-links">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" width="22" height="22" style="vertical-align: middle; margin-right: 8px;">
                                <path d="M224 256A128 128 0 1 0 224 0a128 128 0 1 0 0 256zm-45.7 48C79.8 304 0 383.8 0 482.3C0 498.7 13.3 512 29.7 512l388.6 0c16.4 0 29.7-13.3 29.7-29.7C448 383.8 368.2 304 269.7 304l-91.4 0z"/>
                            </svg>
                        </a>
                        <div id="auth-links" style="display: none;">
                            <a href="{{ route('login') }}">Log in</a>
                            @if (Route::has('register'))
                                <a href="{{ route('register') }}">Registro</a>
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

    <section class="hero">
        <div class="container">
            <div class="hero-content">
                <div class="hero-text">
                    <h2>Innovamos en Cuidados de Salud para Ti</h2>
                    <p>Ofrecemos soluciones personalizadas que se adaptan a tus necesidades. Nuestra misión es proporcionar un servicio de salud de alta calidad, asegurando tu bienestar en todo momento.</p>
                        <ul class="features-list">
                            <li></i class="icon-check"> Tecnología de última generación</li>
                            <li><i class="icon-check"></i> Tratamientos sin dolor</li>
                            <li><i class="icon-check"></i> Especialistas capacitados</li>
                        </ul>
                </div>
                <div class="hero-images">
                    <div class="image-column">
                        <img src="images/enfermeraayudando.jpg" alt="Enfermera Ayudando" />
                        <img src="images/doctorayudando.jpg" alt="Doctor Ayudando" />
                    </div>
                    <div class="image-column middle-image">
                        <img src="images/doctorexplicando.jpg" alt="Doctor Explicando" />
                    </div>
                </div>
            </div>
        </div>
    </section>



    <section class="features">
        <div class="container">
            <div class="feature">
                <div class="feature-content">
                    <h3 class="feature-title">Trabajo Médico Dedicado</h3>
                    <p>Nuestro equipo de profesionales se dedica a brindarte la mejor atención médica posible.</p>
                </div>
                <img src="images/icons8-grupo-50.png" alt="Icono de Trabajo Médico">
            </div>
            <div class="feature">
                <div class="feature-content">
                    <h3 class="feature-title">Servicios de Cuidado</h3>
                    <p>Te ofrecemos una gama de servicios de cuidado para garantizar tu salud y bienestar.</p>
                </div>
                <img src="images/icons8-cuidado-50.png" alt="Icono de Expertos en Salud">
            </div>
            <div class="feature">
                <div class="feature-content">
                    <h3 class="feature-title">Expertos en Salud</h3>
                    <p>Contamos con un equipo de expertos listos para ofrecerte asesoramiento y tratamiento.</p>
                </div>
                <img src="images/icons8-bata-de-laboratorio-médicos-50.png" alt="">
            </div>
            <div class="feature">
                <div class="feature-content">
                    <h3 class="feature-title">Atención Médica de Calidad</h3>
                    <p>Estamos comprometidos con brindarte atención médica de alta calidad y a la vanguardia.</p>
                </div>
                <img src="images/icons8-24-7-signo-abierto-64.png" alt="">
            </div>
        </div>
    </section>



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
                        <a href="https://www.google.com.mx/maps/place/Kaizen+Business+Training/@25.8694126,-97.5038464,19z/data=!4m6!3m5!1s0x866feb74305d47a3:0x5ceb7d0b261d15d7!8m2!3d25.8694124!4d-97.5033911!16s%2Fg%2F11jzkyh2cx?entry=ttu&g_ep=EgoyMDI0MTAwMi4xIKXMDSoASAFQAw%3D%3D" target="_blank">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512" width="22" height="22" style="vertical-align: middle; margin-right: 8px;">
                              <path d="M215.7 499.2C267 435 384 279.4 384 192C384 86 298 0 192 0S0 86 0 192c0 87.4 117 243 168.3 307.2c12.3 15.3 35.1 15.3 47.4 0zM192 128a64 64 0 1 1 0 128 64 64 0 1 1 0-128z"/>
                            </svg>
                            Pedro José Méndez, Industrial, 87350 Heroica Matamoros, Tamps.
                        </a>
                    </li>
                    <li>
                        <a href="https://wa.me/8683671279" target="_blank">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" width="22" height="22" style="vertical-align: middle; margin-right: 8px;">
                                <path d="M164.9 24.6c-7.7-18.6-28-28.5-47.4-23.2l-88 24C12.1 30.2 0 46 0 64C0 311.4 200.6 512 448 512c18 0 33.8-12.1 38.6-29.5l24-88c5.3-19.4-4.6-39.7-23.2-47.4l-96-40c-16.3-6.8-35.2-2.1-46.3 11.6L304.7 368C234.3 334.7 177.3 277.7 144 207.3L193.3 167c13.7-11.2 18.4-30 11.6-46.3l-40-96z"/>
                            </svg>
                            8683-671279
                        </a>
                    </li>
                    <li>
                        <a href="https://mail.google.com/mail/u/0/#inbox?compose=new&to=esaprtano.gamer04@gmail.com" target="_blank">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" width="22" height="22" style="vertical-align: middle; margin-right: 8px;">
                                <path d="M64 112c-8.8 0-16 7.2-16 16l0 22.1L220.5 291.7c20.7 17 50.4 17 71.1 0L464 150.1l0-22.1c0-8.8-7.2-16-16-16L64 112zM48 212.2L48 384c0 8.8 7.2 16 16 16l384 0c8.8 0 16-7.2 16-16l0-171.8L322 328.8c-38.4 31.5-93.7 31.5-132 0L48 212.2zM0 128C0 92.7 28.7 64 64 64l384 0c35.3 0 64 28.7 64 64l0 256c0 35.3-28.7 64-64 64L64 448c-35.3 0-64-28.7-64-64L0 128z"/>
                            </svg>
                            esaprtano.gamer04@gmail.com
                        </a>
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