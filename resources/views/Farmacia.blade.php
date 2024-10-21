<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Farmacia</title>
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

        .header-left, .header-right {
            flex: 1;
        }

        .header-center {
            flex: 2;
            display: flex;
            justify-content: center;
        }

        .header-title {
            font-family: 'Arial', sans-serif;
    text-align: left;
    border: none; /* Asegurarse de que no haya bordes */
    margin: 0; /* Eliminar cualquier margen */
    padding: 0; /* Eliminar cualquier padding */
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
            color: #fff;
            margin-top: 5px;
            display: block;
        }

        .search-form {
            display: flex;
            align-items: center;
            width: 100%;
            max-width: 600px;
        }

        .search-input {
            padding: 12px;
            border: none;
            border-radius: 25px 0 0 25px;
            width: 100%;
            font-size: 18px;
        }

        .search-button {
            background-color: #fff;
            border: none;
            padding: 12px 20px;
            border-radius: 0 25px 25px 0;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .search-button:hover {
            background-color: #e0e0e0;
        }

        .header-right {
            display: flex;
            justify-content: flex-end;
            align-items: center;
        }

        .dashboard-link, .auth-icon {
            color: #fff;
            text-decoration: none;
            margin-right: 20px;
        }

        .user-avatar, .auth-icon {
            cursor: pointer;
        }

        .user-dropdown, .auth-links {
            position: absolute;
            top: 100%;
            right: 0;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            padding: 10px;
            z-index: 1000;
        }

        .user-dropdown span, .user-dropdown a, .auth-links a {
            display: block;
            color: #333;
            padding: 8px 12px;
            text-decoration: none;
        }

        .dropdown-divider {
            height: 1px;
            background-color: #e0e0e0;
            margin: 8px 0;
        }

        .user-dropdown a:hover, .auth-links a:hover {
            background-color: #f0f0f0;
        }

        .search-container {
            max-width: 600px;
            margin: 20px auto;
        }

        .search-form {
            display: flex;
            align-items: center;
        }

        .search-wrapper {
            position: relative;
            flex-grow: 1;
        }

        .search-icon {
            position: absolute;
            left: 10px;
            top: 50%;
            transform: translateY(-50%);
            color: #6c757d;
        }

        .search-input {
            width: 100%;
            padding: 10px 10px 10px 35px;
            border: 2px solid #ced4da;
            border-radius: 4px;
            font-size: 16px;
            transition: border-color 0.3s ease;
        }

        .search-input:focus {
            outline: none;
            border-color: #80bdff;
            box-shadow: 0 0 0 0.2rem rgba(0,123,255,.25);
        }

        .search-button {
            margin-left: 10px;
            padding: 10px 20px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .search-button:hover {
            background-color: #0056b3;
        }
        #auth-links {
            position: absolute;
            top: 100%;
            right: 0;
            background: #ffffff;
            border-radius: 10px;
            padding: 10px;
            display: none;
            z-index: 10;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
            width: auto;
        }

        #auth-links a {
            color: #003366;
            text-decoration: none;
            display: block;
            margin: 5px 0;
            padding: 8px 12px;
            border-radius: 19px;
            transition: background-color 0.3s, color 0.3s;
            white-space: nowrap;
        }

        #auth-links a:hover {
            background-color: #88c8de;
            color: #003366;
        }

        #auth-links.show {
            display: block;
        }

        .header-right {
            position: relative;
        }

        @media (max-width: 768px) {
            header {
                flex-direction: column;
                align-items: flex-start;
            }

            header nav ul {
                flex-direction: column;
                gap: 25px;
                margin-top: 20px;
            }

            header .header-logo {
                margin-bottom: 15px;
            }

            #auth-links {
                right: 0;
                left: auto;
                transform: none;
            }
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
        .footer-column ul li:last-child {
    margin-bottom: 8px;     
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
.featured-categories {
        text-align: center;
        padding: 40px 20px;
    }

    .featured-title {
        color: #003366; /* Color similar al del footer */
        font-size: 28px;
        margin-bottom: 30px;
    }

    .category-container {
        display: flex;
        justify-content: center;
        gap: 30px;
    }

    .category-item {
        background-color: #e6f2ff; /* Azul muy claro */
        border-radius: 10px;
        padding: 20px;
        width: 200px;
        transition: transform 0.3s ease;
    }

    .category-item:hover {
        transform: translateY(-5px);
    }

    .category-item img {
        width: 100px;
        height: 100px;
        margin-bottom: 15px;
    }

    .category-item p {
        font-size: 18px;
        color: #003366;
        margin: 0;
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
.featured-products {
    padding: 40px 20px;
    background-color: #f5f5f5;
}

.section-title {
    text-align: center;
    color: #003366;
    font-size: 28px;
    margin-bottom: 30px;
}

.product-container {
    display: flex;
    justify-content: space-around;
    flex-wrap: wrap;
    gap: 20px;
}

.product-item {
    background-color: white;
    border-radius: 10px;
    padding: 20px;
    width: 200px;
    text-align: center;
    box-shadow: 0 4px 6px rgba(0,0,0,0.1);
    transition: transform 0.3s ease;
}

.product-item:hover {
    transform: translateY(-5px);
}

.product-item img {
    width: 150px;
    height: 150px;
    object-fit: cover;
    margin-bottom: 15px;
}

.product-item h3 {
    font-size: 18px;
    color: #003366;
    margin: 0 0 10px 0;
}

.price {
    font-weight: bold;
    color: #4a4a4a;
    margin-bottom: 10px;
}

.buy-button {
    background-color: #003366;
    color: white;
    border: none;
    padding: 8px 15px;
    border-radius: 5px;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

.buy-button:hover {
    background-color: #004080;
}

/* Estilos para blog y secciones informativas */
.blog-info {
    padding: 40px 20px;
    background-color: #ffffff;
}

.blog-container {
    display: flex;
    justify-content: space-around;
    flex-wrap: wrap;
    gap: 30px;
}

.blog-post {
    width: 300px;
    background-color: #f9f9f9;
    border-radius: 10px;
    overflow: hidden;
    box-shadow: 0 4px 6px rgba(0,0,0,0.1);
}

.blog-post img {
    width: 100%;
    height: 200px;
    object-fit: cover;
}

.blog-post h3 {
    font-size: 20px;
    color: #003366;
    margin: 15px;
}

.blog-post p {
    font-size: 14px;
    color: #4a4a4a;
    margin: 0 15px 15px;
}

.read-more {
    display: inline-block;
    margin: 0 15px 15px;
    color: #003366;
    text-decoration: none;
    font-weight: bold;
}

.read-more:hover {
    text-decoration: underline;
}
.titulo{
    text-decoration: none;
}
    </style>
</head>

<body>
    <header>
    <a href="{{ route('welcome') }}"class="titulo">
    <div class="header-title">
        <span class="kaiser">KAISER</span>
        <span class="subtext">Clínica de Salud</span>
    </div>
</a>

<div class="header-center">
    <form class="search-form"  method="GET">
        <input type="text" name="busqueda" placeholder="¿Qué estás buscando?" class="search-input">
        <button type="submit" class="search-button">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <circle cx="11" cy="11" r="8"></circle>
                <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
            </svg>
        </button>
    </form>
</div>
        
        <div class="header-right">
            @if (Route::has('login'))
                @auth
                    <a href="{{ url('/dashboard') }}" class="dashboard-link">Dashboard</a>
                    <div class="user-avatar" id="toggle-user-menu">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" width="22" height="22">
                            <path d="M224 256A128 128 0 1 0 224 0a128 128 0 1 0 0 256zm-45.7 48C79.8 304 0 383.8 0 482.3C0 498.7 13.3 512 29.7 512l388.6 0c16.4 0 29.7-13.3 29.7-29.7C448 383.8 368.2 304 269.7 304l-91.4 0z"/>
                        </svg>
                    </div>
                    <div id="user-dropdown" class="user-dropdown" style="display: none;">
                        <span>{{ Auth::user()->name }}</span>
                        <div class="dropdown-divider"></div>
                        <a href="{{ route('profile.show') }}">{{ __('Profile') }}</a>
                        <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            Salir de la cuenta
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </div>
                @else
                    <a href="#" id="toggle-auth-links" class="auth-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" width="22" height="22">
                            <path d="M224 256A128 128 0 1 0 224 0a128 128 0 1 0 0 256zm-45.7 48C79.8 304 0 383.8 0 482.3C0 498.7 13.3 512 29.7 512l388.6 0c16.4 0 29.7-13.3 29.7-29.7C448 383.8 368.2 304 269.7 304l-91.4 0z"/>
                        </svg>
                    </a>
                    <div id="auth-links" class="auth-links" style="display: none;">
                        <a href="{{ route('login') }}">Log in</a>
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}">Registro</a>
                        @endif
                    </div>
                @endauth
            @endif
        </div>
    </header>

    <section class="featured-categories">
        <h2 class="featured-title">¡Categorías destacadas!</h2>
        <div class="category-container">
            <div class="category-item">
                <img src="images/agua.png" alt="Electrolitos">
                <p>Electrolitos</p>
            </div>
            <div class="category-item">
                <img src="images/vitamina-c.png" alt="Vitaminas">
                <p>Vitaminas y suplementos</p>
            </div>
            <div class="category-item">
                <img src="images/botiquin-de-primeros-auxilios.png" alt="Botiquín">
                <p>Botiquín</p>
            </div>
            <div class="category-item">
                <img src="images/termometro.png" alt="Botiquín">
                <p>Aparatos de medición</p>
            </div>
            <div class="category-item">
                <img src="images/ortopedico.png" alt="Botiquín">
                <p>Ortopedicos</p>
            </div>
            <div class="category-item">
                <img src="images/hospital.png" alt="Botiquín">
                <p>Soluciones hospitalarias</p>
            </div>
            <div class="category-item">
                <img src="images/pruebas.png" alt="Botiquín">
                <p>Pruebas</p>
            </div>
        </div>
    </section>

    <!-- Productos destacados -->
    <section class="featured-products">
        <h2 class="section-title">Productos Destacados</h2>
        <div class="product-container">
            <div class="product-item">
                <img src="images/parecetamol.png" alt="Producto 1">
                <h3>Paracetamol 500mg</h3>
                <p class="price">$61.00</p>
                <button class="buy-button">Comprar</button>
            </div>  
            <div class="product-item">
                <img src="images/vitaminas.jpg" alt="Producto 2">
                <h3>Vitamina C 1000mg</h3>
                <p class="price">$130.00</p>
                <button class="buy-button">Comprar</button>
            </div>
            <div class="product-item">
                <img src="images/ibuprofeno.jpg" alt="Producto 3">
                <h3>Ibuprofeno 400mg</h3>
                <p class="price">$107.00</p>
                <button class="buy-button">Comprar</button>
            </div>
            <div class="product-item">
                <img src="images/omeprazol.jpg" alt="Producto 4">
                <h3>Omeprazol 20mg</h3>
                <p class="price">$65.00</p>
                <button class="buy-button">Comprar</button>
            </div>
        </div>
    </section>

    <!-- Blog y secciones informativas -->
    <section class="blog-info">
        <h2 class="section-title">Blog y Consejos de Salud</h2>
        <div class="blog-container">
            <article class="blog-post">
                <img src="images/hidratacion.jpg" alt="Importancia de la hidratación">
                <h3>Importancia de la hidratación</h3>
                <p>Descubre por qué es crucial mantenerse hidratado y cómo afecta a tu salud...</p>
                <a href="https://www.gob.mx/salud/articulos/la-importancia-de-una-buena-hidratacion" class="read-more">Leer más</a>
            </article>
            <article class="blog-post">
                <img src="images/ejercicio.jpg" alt="Beneficios del ejercicio diario">
                <h3>Beneficios del ejercicio diario</h3>
                <p>Conoce cómo el ejercicio regular puede mejorar tu salud física y mental...</p>
                <a href="https://pulso2ep.com/la-importancia-de-hacer-ejercicio-fisico-a-diario/" class="read-more">Leer más</a>
            </article>
            <article class="blog-post">
                <img src="images/sueño.jpg" alt="Consejos para un sueño reparador">
                <h3>Consejos para un sueño reparador</h3>
                <p>Aprende técnicas para mejorar la calidad de tu sueño y despertar renovado...</p>
                <a href="https://velfont.com/sueno-reparador-guia-buenos-habitos/" class="read-more">Leer más</a>
            </article>
            <article class="blog-post">
                <img src="images/alimentacion.jpg" alt="Alimentación balanceada">
                <h3>Alimentación balanceada</h3>
                <p>Descubre los beneficios de una dieta equilibrada y cómo mejorar tu bienestar general...</p>
                <a href="https://www.gob.mx/salud/articulos/alimentacion-sana-y-balanceada-para-una-buena-salud" class="read-more">Leer más</a>
            </article>
            <article class="blog-post">
                <img src="images/estres.jpg" alt="Cómo reducir el estrés">
                <h3>Cómo reducir el estrés</h3>
                <p>Consejos prácticos para gestionar el estrés y mejorar tu calidad de vida...</p>
                <a href="https://www.mayoclinic.org/es/healthy-lifestyle/stress-management/in-depth/stress-relievers/art-20047257" class="read-more">Leer más</a>
            </article>
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
                            espartano.gamer04@gmail.com
                        </a>
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




