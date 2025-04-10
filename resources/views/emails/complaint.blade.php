<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nuevo Mensaje de Contacto</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap');

        body {
            font-family: 'Poppins', sans-serif;
            line-height: 1.6;
            color: #333;
            background-color: #f9f9f9;
            margin: 0;
            padding: 0;
        }
        .email-container {
            max-width: 600px;
            margin: 20px auto;
            background: white;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.06);
        }
        .email-header {
            background: linear-gradient(135deg, #4a90e2 0%, #007aff 100%);
            color: white;
            padding: 40px 30px;
            text-align: center;
            position: relative;
        }
        .email-header h1 {
            margin: 0;
            font-size: 28px;
            font-weight: 600;
            letter-spacing: -0.5px;
        }
        .email-header p {
            margin-top: 10px;
            font-size: 16px;
            font-weight: 400;
            opacity: 0.9;
        }
        .email-body {
            padding: 30px;
        }
        .info-grid {
            display: grid;
            grid-template-columns: 120px 1fr;
            gap: 15px;
            margin-bottom: 25px;
        }
        .info-label {
            font-weight: 500;
            color: #007aff;
            text-transform: uppercase;
            font-size: 14px;
            letter-spacing: 0.5px;
        }
        .info-value {
            font-size: 15px;
            color: #4a4a4a;
            padding: 8px 0;
            border-bottom: 1px solid #f0f0f0;
        }
        .message-section {
            margin-top: 30px;
        }
        .message-title {
            color: #007aff;
            font-size: 18px;
            font-weight: 500;
            margin-bottom: 15px;
            text-transform: uppercase;
            letter-spacing: 1px;
        }
        .message-box {
            background: #f9f9ff;
            border: 1px solid #e0e0ff;
            border-radius: 8px;
            padding: 20px;
            font-size: 15px;
            line-height: 1.7;
            color: #333;
        }
        .email-footer {
            text-align: center;
            padding: 20px;
            background: #f5f5f5;
            color: #888;
            font-size: 13px;
            border-top: 1px solid #eee;
        }
        .logo {
            color: #007aff;
            font-weight: 600;
            font-size: 15px;
            text-transform: uppercase;
            letter-spacing: 1px;
        }
        .footer-links {
            margin-top: 10px;
        }
        .footer-links a {
            color: #007aff;
            text-decoration: none;
            margin: 0 10px;
            font-size: 13px;
        }
        .footer-links a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="email-container">
        <!-- Encabezado -->
        <div class="email-header">
            <h1>Nuevo Mensaje de Contacto</h1>
            <p>Un cliente ha enviado un mensaje desde el formulario de contacto.</p>
        </div>

        <!-- Cuerpo del Correo -->
        <div class="email-body">
            <div class="info-grid">
                <div class="info-label">Nombre:</div>
                <div class="info-value">{{ $data['name'] }}</div>

                <div class="info-label">Correo:</div>
                <div class="info-value">{{ $data['contact'] }}</div>

                <div class="info-label">Enviado:</div>
                <div class="info-value">{{ $data['received_at'] }}</div>
            </div>

            <div class="message-section">
                <div class="message-title">Mensaje:</div>
                <div class="message-box">
                    {{ $data['message'] }}
                </div>
            </div>
        </div>

        <!-- Pie de Página -->
        <div class="email-footer">
            Este mensaje fue enviado automáticamente desde el formulario de contacto.<br>
            <span class="logo">Expedmed</span><br>
            <div class="footer-links">
                <a href="#">Política de Privacidad</a>
                <a href="#">Términos y Condiciones</a>
                <a href="#">Contacto</a>
            </div>
        </div>
    </div>
</body>
</html>
