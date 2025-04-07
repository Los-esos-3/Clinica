<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contáctenos - ExpedientesMed</title>
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
        <p>Nuestro sistema está diseñado para ofrecer comodidad y seguridad en la gestión de expedientes médicos. Proporcionamos una plataforma integral que abarca desde la administración de consultas generales hasta la gestión de especialidades médicas avanzadas. Te invitamos a descubrir cómo <strong>ExpedientesMed</strong> puede transformar la eficiencia y calidad de la atención médica que ofreces.</p>
        <h2>Nuestra Sucursal Principal</h2>
        <p>A continuación, encontrarás un mapa que muestra nuestra sucursal principal:</p>
        <div class="map-container">
            <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d3589.92275863813!2d-97.5087741!3d25.8720195!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x866f9492e94bd5ad%3A0x6c1938b171e70720!2sIMSS%20Hospital%20General%20de%20Zona%20No.%2013%2C%20Heroica%20Matamoros!5e0!3m2!1ses-419!2smx!4v1728492393674!5m2!1ses-419!2smx" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div>
        <p>Garantizamos una gestión segura y confidencial de tus expedientes clínicos mediante sistemas digitales avanzados, manteniendo tu información médica organizada, accesible y protegida en todo momento para brindarte la mejor atención personalizada.</p>        <a href="/">Volver al inicio</a>
        <a class="map-link" href="https://maps.app.goo.gl/L5LsJuYjLBoo8RVi6" target="_blank">Ver en Google Maps</a>

        <div class="contact-section" style="margin: 40px 0; font-family: 'Arial', sans-serif;">
            <div class="contact-header" style="text-align: center; margin-bottom: 30px;">
                <h2 style="color: #2c3e50; font-size: 28px; margin-bottom: 10px; position: relative; display: inline-block;">
                    Contáctanos
                    <span style="display: block; width: 60px; height: 3px; background: #3498db; margin: 10px auto 0;"></span>
                </h2>
                <p style="color: #7f8c8d; max-width: 700px; margin: 0 auto;">Nuestro equipo está listo para ayudarte con cualquier duda o inconveniente</p>
            </div>
        
            <div class="team-container" style="display: flex; justify-content: space-around; flex-wrap: wrap; gap: 20px; margin-top: 30px;">
                <!-- Soporte Técnico 1 -->
                <div class="team-card" style="background: white; border-radius: 10px; padding: 25px; width: 300px; box-shadow: 0 5px 15px rgba(0,0,0,0.1); transition: transform 0.3s;">
                    <div class="team-icon" style="background: #3498db; width: 60px; height: 60px; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 15px;">
                        <span style="color: white; font-size: 24px;">👨‍💻</span>
                    </div>
                    <h3 style="text-align: center; color: #2c3e50; margin-bottom: 5px;">Jonathan Caporal Becerra</h3>
                    <p style="text-align: center; color: #3498db; font-weight: bold; margin-bottom: 15px;">Técnico Especializado</p>
                    <div class="contact-info" style="text-align: center;">
                        <p style="margin: 5px 0;"><span style="font-weight: bold;">Teléfono:</span> <a href="tel:8682603919" style="color: #cfd6dd; text-decoration: none;">868 260 3919</a></p>
                        <p style="margin: 5px 0;"><span style="font-weight: bold;">Disponible:</span> 9AM-6PM</p>
                    </div>
                </div>
        
                <!-- Soporte Técnico 2 -->
                <div class="team-card" style="background: white; border-radius: 10px; padding: 25px; width: 300px; box-shadow: 0 5px 15px rgba(0,0,0,0.1); transition: transform 0.3s;">
                    <div class="team-icon" style="background: #e74c3c; width: 60px; height: 60px; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 15px;">
                        <span style="color: white; font-size: 24px;">🔧</span>
                    </div>
                    <h3 style="text-align: center; color: #2c3e50; margin-bottom: 5px;">Oscar Antonio Espinoza Campos</h3>
                    <p style="text-align: center; color: #e74c3c; font-weight: bold; margin-bottom: 15px;">Soporte Técnico</p>
                    <div class="contact-info" style="text-align: center;">
                        <p style="margin: 5px 0;"><span style="font-weight: bold;">Teléfono:</span> <a href="tel:8683671279" style="color: #cfd6dd; text-decoration: none;">868 367 1279</a></p>
                        <p style="margin: 5px 0;"><span style="font-weight: bold;">Disponible:</span> 9AM-6PM</p>
                    </div>
                </div>
        
                <!-- Diseñador Gráfico -->
                <div class="team-card" style="background: white; border-radius: 10px; padding: 25px; width: 300px; box-shadow: 0 5px 15px rgba(0,0,0,0.1); transition: transform 0.3s;">
                    <div class="team-icon" style="background: #2ecc71; width: 60px; height: 60px; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 15px;">
                        <span style="color: white; font-size: 24px;">🎨</span>
                    </div>
                    <h3 style="text-align: center; color: #2c3e50; margin-bottom: 5px;">Santos Ignacio Gomez Pardo</h3>
                    <p style="text-align: center; color: #2ecc71; font-weight: bold; margin-bottom: 15px;">Diseñador Gráfico</p>
                    <div class="contact-info" style="text-align: center;">
                        <p style="margin: 5px 0;"><span style="font-weight: bold;">Teléfono:</span> <a href="tel:8683032189" style="color: #cfd6dd; text-decoration: none;">868 303 2189</a></p>
                        <p style="margin: 5px 0;"><span style="font-weight: bold;">Disponible:</span> 9AM-6PM</p>
                    </div>
                </div>
            </div>
        
            <div class="additional-info" style="background: #f8f9fa; border-radius: 10px; padding: 20px; margin-top: 30px; text-align: center;">
                <h3 style="color: #2c3e50; margin-bottom: 15px;">Información Adicional</h3>
                <p style="margin: 5px 0;"><span style="font-weight: bold;">Horario General:</span> Lunes a Viernes de 9:00 AM a 6:00 PM</p>
            </div>
        </div>
{{--         buzon de quejas --}}

<div style="max-width: 600px; margin: 30px auto; padding: 25px; border-radius: 10px; background: #ffffff; box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1); font-family: 'Arial', sans-serif;">
    <h2 style="text-align: center; color: #dc3545; font-size: 24px; font-weight: bold; margin-bottom: 20px;">
        📩 Buzón de Quejas
    </h2>

    @if(session('success'))
        <div style="background: #d4edda; color: #155724; padding: 12px; border-radius: 5px; margin-bottom: 20px; text-align: center; font-weight: bold;">
            {{ session('success') }}
        </div>
    @endif

    <form method="POST" action="{{ route('complaints.submit') }}">
        @csrf
        
        <div style="margin-bottom: 15px;">
            <label style="display: block; font-weight: bold; color: #555; margin-bottom: 5px;">Nombre (opcional)</label>
            <input type="text" name="name" placeholder="Escribe tu nombre..." style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 6px; font-size: 14px;">
        </div>

        <div style="margin-bottom: 15px;">
            <label style="display: block; font-weight: bold; color: #555; margin-bottom: 5px;">Correo o Teléfono (opcional)</label>
            <input type="text" name="contact" placeholder="ejemplo@gmail.com o +52 123 456 7890" style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 6px; font-size: 14px;">
        </div>

        <div style="margin-bottom: 15px;">
            <label style="display: block; font-weight: bold; color: #555; margin-bottom: 5px;">Queja o sugerencia *</label>
            <textarea name="complaint" rows="5" placeholder="Escribe tu queja o sugerencia aquí..." style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 6px; font-size: 14px; resize: vertical;" required></textarea>
        </div>

        <button type="submit" style="background: #dc3545; color: white; border: none; padding: 12px; border-radius: 6px; cursor: pointer; width: 100%; font-size: 16px; font-weight: bold; transition: 0.3s;">
            🚀 Enviar Queja
        </button>
    </form>
</div>

</body>
</html>