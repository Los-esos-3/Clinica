<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Expedined</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap');

        body {
            font-family: 'Poppins', sans-serif;
            line-height: 1.6;
            color: #333;
            background-color: #f5f7fa;
            margin: 0;
            padding: 0;
        }

        .contact-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 40px 20px;
        }

        h1 {
            color: #2c3e50;
            font-size: 2.5rem;
            text-align: center;
            margin-bottom: 20px;
            font-weight: 600;
        }

        .intro-text {
            text-align: center;
            color: #555;
            font-size: 1.1rem;
            max-width: 800px;
            margin: 0 auto 40px;
            line-height: 1.8;
        }

        h2 {
            color: #2c3e50;
            font-size: 1.8rem;
            margin: 40px 0 20px;
            text-align: center;
            font-weight: 500;
        }

        .map-container {
            margin: 30px auto;
            text-align: center;
        }

        .map-container iframe {
            border-radius: 12px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
            max-width: 100%;
        }

        .button-container {
            display: flex;
            justify-content: center;
            gap: 20px;
            margin: 30px 0;
        }

        .btn {
            padding: 12px 25px;
            border-radius: 8px;
            font-weight: 500;
            text-decoration: none;
            transition: all 0.3s ease;
            display: inline-block;
        }

        .btn-primary {
            background-color: #3498db;
            color: white;
            border: 2px solid #3498db;
        }

        .btn-primary:hover {
            background-color: #2980b9;
            border-color: #2980b9;
            transform: translateY(-2px);
        }

        .btn-outline {
            background-color: transparent;
            color: #3498db;
            border: 2px solid #3498db;
        }

        .btn-outline:hover {
            background-color: #f8f9fa;
            transform: translateY(-2px);
        }

        /* Estilos del formulario */
        .contact-form {
            max-width: 700px;
            margin: 40px auto;
            padding: 40px;
            background: white;
            border-radius: 12px;
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.08);
        }

        .form-title {
            text-align: center;
            color: #2c3e50;
            font-size: 1.8rem;
            margin-bottom: 10px;
            font-weight: 600;
        }

        .form-subtitle {
            text-align: center;
            color: #7f8c8d;
            margin-bottom: 30px;
            font-size: 1rem;
        }

        .alert-success {
            background: #d4edda;
            color: #155724;
            padding: 12px;
            border-radius: 6px;
            margin-bottom: 20px;
            text-align: center;
            font-weight: 600;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-row {
            gap: 20px;
        }

        .form-col {
            flex: 1 1 48%;
            min-width: 250px;
        }

        label {
            display: block;
            font-weight: 500;
            color: #2c3e50;
            margin-bottom: 5px;
        }

        input, textarea {
            width: 95.4%;
            padding: 12px 15px;
            border: 1px solid #ddd;
            border-radius: 8px;
            font-family: 'Poppins', sans-serif;
            font-size: 1rem;
            transition: border 0.3s ease;
        }

        input:focus, textarea:focus {
            border-color: #3498db;
            outline: none;
            box-shadow: 0 0 0 3px rgba(52, 152, 219, 0.2);
        }

        textarea {
            min-height: 120px;
            resize: vertical;
        }

        .submit-btn {
            width: 100%;
            padding: 14px;
            background-color: #3498db;
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 1.1rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            margin-top: 10px;
        }

        .submit-btn:hover {
            background-color: #2980b9;
            transform: translateY(-2px);
        }

        @media (max-width: 768px) {
            .form-col {
                flex: 1 1 100%;
            }

            .contact-form {
                padding: 30px 20px;
            }

            .button-container {
                flex-direction: column;
                align-items: center;
            }

            .btn {
                width: 100%;
                text-align: center;
            }
        }
    </style>
</head>
<body>
    <div class="contact-container">
        <h1>Contáctanos</h1>
        <p class="intro-text">Nuestro sistema está diseñado para ofrecer comodidad y seguridad en la gestión de expedientes médicos. Proporcionamos una plataforma integral que abarca desde la administración de consultas generales hasta la gestión de especialidades médicas avanzadas.</p>

    
       
        <div class="button-container">
            <a href="/" class="btn btn-outline">Volver al inicio</a>
        </div>

        <!-- Formulario de contacto -->
        <div class="contact-form">
            <h2 class="form-title">📬 ¡Estamos para ayudarte!</h2>
            <p class="form-subtitle">¿Tienes dudas, sugerencias o necesitas ayuda? Llena el siguiente formulario y nos pondremos en contacto contigo lo antes posible.</p>

            @if(session('success'))
                <div class="alert-success">
                    {{ session('success') }}
                </div>
            @endif

            <form method="POST" action="{{ route('complaints.submit') }}" autocomplete="on">               
                 @csrf
                <div class="form-row">
                    <div class="form-col">
                        <div class="form-group">
                            <label for="name">Nombre*</label>
                            <input type="text" id="name" name="name" required placeholder="Ingresa tu nombre">
                        </div>
                    </div>

                    <div class="form-col">
                        <div class="form-group">
                            <label for="lastname">Apellido*</label>
                            <input type="text" id="lastname" name="lastname" required placeholder="Ingresa tu apellido">
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label for="email">Correo electrónico*</label>
                    <input type="email" id="email" name="email" required placeholder="ejemplo@correo.com">
                </div>

                <div class="form-group">
                    <label for="phone">Teléfono o Celular*</label>
                    <input type="tel" id="phone" name="phone" required placeholder="+52 123 456 7890">
                </div>

                <div class="form-group">
                    <label for="message">¿En qué te podemos ayudar?*</label>
                    <textarea id="message" name="message" required placeholder="Escribe tu mensaje aquí..."></textarea>
                </div>

                <button type="submit" class="submit-btn">Enviar mensaje</button>
            </form>
        </div>
    </div>
</body>
</html>
