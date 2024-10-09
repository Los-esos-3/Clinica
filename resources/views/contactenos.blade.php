<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contáctenos - Clínica Similares</title>
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    <style>
        body {
            font-family: 'Figtree', sans-serif;
            background-color: #f9fafb;
            color: #333;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            padding: 20px;
        }

        .contact-container {
            background-color: #fff;
            padding: 30px;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
            border-radius: 12px;
            width: 100%;
            max-width: 800px;
            text-align: center;
            transition: transform 0.2s;
        }

        .contact-container:hover {
            transform: translateY(-5px);
        }

        h1 {
            margin-bottom: 10px;
            font-size: 28px;
            color: #003366;
        }

        h2 {
            margin: 20px 0;
            font-size: 22px;
            color: #007BFF;
        }

        p {
            margin: 10px 0;
            line-height: 1.6;
        }

        a {
            display: inline-block;
            padding: 12px 20px;
            background-color: #003366;
            color: #fff;
            border-radius: 5px;
            text-decoration: none;
            margin: 10px 0;
            transition: background-color 0.3s, transform 0.3s;
        }

        a:hover {
            background-color: #0056b3;
            transform: scale(1.05);
        }

        .map-link {
            background-color: #007BFF;
        }

        .map-container {
            margin: 20px 0;
            width: 100%;
            height: 400px; /* Altura del mapa */
            border-radius: 10px; /* Bordes redondeados para el mapa */
            overflow: hidden;
        }

        iframe {
            width: 100%;
            height: 100%;
            border: none; /* Sin bordes */
        }

        .branches {
            margin-top: 30px;
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 20px; /* Espaciado entre tarjetas */
        }

        .branch {
            background-color: #f4f4f4;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            padding: 20px;
            width: 180px;
            text-align: center;
            transition: transform 0.3s, box-shadow 0.3s;
        }

        .branch:hover {
            transform: scale(1.05);
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
        }

        .branch img {
            width: 50px; /* Tamaño del ícono del edificio */
            height: 50px;
            margin-bottom: 10px;
        }

        .branch p {
            margin: 5px 0;
            font-size: 16px;
            color: #007BFF;
            cursor: pointer;
        }

        .branch p:hover {
            text-decoration: underline;
        }

        .address, .phone {
            font-size: 14px;
            color: #666;
            margin-top: 5px;
        }
    </style>
</head>
<body>
    <div class="contact-container">
        <h1>Contáctenos</h1>
        <p>En <strong>Clínica Similares</strong>, nuestra prioridad es cuidar de la salud y el bienestar de ti y de toda tu familia. Con años de experiencia brindando atención médica de calidad, nos hemos convertido en un referente en el cuidado integral de nuestros pacientes.</p>
        <h2>Nuestra Sucursal Principal</h2>
        <p>A continuación, encontrarás un mapa que muestra nuestra sucursal principal:</p>
        <div class="map-container">
            <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d3589.92275863813!2d-97.5087741!3d25.8720195!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x866f9492e94bd5ad%3A0x6c1938b171e70720!2sIMSS%20Hospital%20General%20de%20Zona%20No.%2013%2C%20Heroica%20Matamoros!5e0!3m2!1ses-419!2smx!4v1728492393674!5m2!1ses-419!2smx" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>                allowfullscreen></iframe>
        </div>
        <p>Nuestras instalaciones están diseñadas pensando en la comodidad y seguridad de nuestros pacientes, y ofrecemos una amplia gama de servicios médicos, desde consultas generales hasta especialidades médicas avanzadas. Te invitamos a visitarnos para recibir la mejor atención.</p>
        <a href="/">Volver al inicio</a>
        <a class="map-link" href="https://maps.app.goo.gl/L5LsJuYjLBoo8RVi6" target="_blank">Ver en Google Maps</a>

        <h2>Nuestras Sucursales</h2>
        <div class="branches">
            <div class="branch">
                <img src="https://img.icons8.com/ios-filled/50/000000/building.png" alt="Sucursal 1">
                <p>Clínica Similares Sendero</p>
                <p class="address" onclick="window.open('https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3589.978989533191!2d-97.55185719032475!3d25.87016890402231!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x866f936a4d053ced%3A0xa2ad360f94314d14!2sFarmacia%20de%20Similares!5e0!3m2!1ses-419!2smx!4v1728492815920!5m2!1ses-419!2smx', '_blank')" style="cursor: pointer; color: #007BFF; text-decoration: underline;">
                    C. Sendero Nacional 21, República Nte., 87315 Heroica Matamoros, Tamps.
                </p>
                <p class="phone">Abierto 24 horas</p>
            </div>

            <div class="branch" onclick="window.location.href='https://www.farmaciasdesimilares.com'">
                <img src="https://img.icons8.com/ios-filled/50/000000/building.png" alt="Sucursal 2">
                <p>Clínica Similares Brisas</p>
                <p class="address" onclick="window.open('https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3590.2824588343065!2d-97.56131151114506!3d25.860179400000007!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x866f933b2e41eb37%3A0xf53a5f08209263ad!2sFarmacias%20Similares!5e0!3m2!1ses-419!2smx!4v1728493827186!5m2!1ses-419!2smx', '_blank')" style="cursor: pointer; color: #007BFF; text-decoration: underline;">
                    Rinconada de las Brisas, 87313 Heroica Matamoros, Tamps.</p>
                <p class="phone">Tel: 8009116666</p>
            </div>
            <div class="branch" onclick="window.location.href='https://www.farmaciasdesimilares.com'">
                <img src="https://img.icons8.com/ios-filled/50/000000/building.png" alt="Sucursal 3">
                <p>Clínica Similares Arados</p>
                <p class="address" onclick="window.open('https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3590.056803243044!2d-97.56750501114506!3d25.867607800000005!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x866f932032d93b05%3A0x121cfcd60d4fc4e8!2sFarmacias%20Similares!5e0!3m2!1ses-419!2smx!4v1728493597218!5m2!1ses-419!2smx', '_blank')" style="cursor: pointer; color: #007BFF; text-decoration: underline;">                    C. Sendero Nacional 5, Los Arados, 87313 Heroica Matamoros, Tamps.</p>
                <p class="phone">Tel: 8009116666</p>
            </div>
            <div class="branch" onclick="window.location.href='https://www.farmaciasdesimilares.com'">
                <img src="https://img.icons8.com/ios-filled/50/000000/building.png" alt="Sucursal 4">
                <p>Clínica Similares Casa Blanca</p>
                <p class="address" onclick="window.open('https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3590.34045172131!2d-97.54405611114503!3d25.85827!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x866f934592c120dd%3A0x5a7c5e8cef144329!2sFarmacia%20Similares!5e0!3m2!1ses-419!2smx!4v1728493923468!5m2!1ses-419!2smx', '_blank')" style="cursor: pointer; color: #007BFF; text-decoration: underline;">
                    CLL. Casa Blanca, 2-A, Valle DE Casa Blanca II, Matamoros, 87345 Heroica Matamoros, Tamps.</p>
                <p class="phone">Tel: 8009116666</p>
            </div>
            <div class="branch">
                <img src="https://img.icons8.com/ios-filled/50/000000/building.png" alt="Sucursal 5">
                <p>Clínica Similares Girasoles</p>
                <p class="address" onclick="window.open('https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3589.8988351639227!2d-97.555990711145!3d25.872806800000006!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x866f930061478ac1%3A0xe1ea2247997c34cb!2sFarmacia%20Similares!5e0!3m2!1ses-419!2smx!4v1728493283752!5m2!1ses-419!2smx', '_blank')"  style="cursor: pointer; color: #007BFF; text-decoration: underline;">
                    C. Av. Constituyentes 114, Los Girasoles, 87314 Heroica Matamoros, Tamps.</p>
                <p class="phone">Tel: 8009116666</p>
            </div>
        </div>
    </div>
</body>
</html>