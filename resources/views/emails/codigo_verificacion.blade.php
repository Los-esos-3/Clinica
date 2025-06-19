<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verificación - Expedined</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f8fafc;
            color: #1e293b;
            padding: 40px 20px;
            margin: 0;
            line-height: 1.6;
        }

        .container {
            max-width: 600px;
            margin: auto;
            background-color: #ffffff;
            border-radius: 16px;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
            overflow: hidden;
        }

        .header {
            background: linear-gradient(135deg, #1d3557 0%, #2a4365 100%);
            color: white;
            padding: 40px 30px;
            text-align: center;
            position: relative;
        }

        .logo {
            max-width: 180px;
            margin-bottom: 20px;
        }

        .header h1 {
            margin: 0;
            font-size: 28px;
            font-weight: 700;
            letter-spacing: 0.5px;
        }

        .content {
            padding: 40px 30px;
            background-color: #ffffff;
        }

        .greeting {
            font-size: 20px;
            font-weight: 600;
            color: #1d3557;
            margin-bottom: 20px;
        }

        .message {
            font-size: 16px;
            color: #4a5568;
            margin-bottom: 30px;
            line-height: 1.7;
        }

        .code-container {
            background-color: #f7fafc;
            border-radius: 12px;
            padding: 30px;
            margin: 30px 0;
            text-align: center;
            border: 1px solid #e2e8f0;
        }

        .code {
            font-family: 'Courier New', monospace;
            font-size: 36px;
            font-weight: 700;
            color: #1d3557;
            letter-spacing: 8px;
            padding: 15px 0;
            background: linear-gradient(135deg, #e2e8f0 0%, #f7fafc 100%);
            border-radius: 8px;
            user-select: all;
        }

        .note {
            font-size: 14px;
            color: #718096;
            font-style: italic;
            margin-top: 30px;
            padding: 15px;
            background-color: #f8fafc;
            border-radius: 8px;
            border-left: 4px solid #e2e8f0;
        }

        .footer {
            background-color: #f8fafc;
            padding: 25px 30px;
            text-align: center;
            font-size: 14px;
            color: #718096;
            border-top: 1px solid #e2e8f0;
        }

        .social-links {
            margin: 20px 0;
        }

        .social-links a {
            display: inline-block;
            margin: 0 10px;
            color: #ffffff;
            text-decoration: none;
            padding: 8px 16px;
            border-radius: 6px;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .social-links a.facebook {
            background-color: #1877f2;
        }

        .social-links a.whatsapp {
            background-color: #25d366;
        }

        .social-links a.telegram {
            background-color: #0088cc;
        }

        .social-links a:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        @media (max-width: 640px) {
            body {
                padding: 20px 15px;
            }

            .container {
                margin: 0;
            }

            .header {
                padding: 30px 20px;
            }

            .header h1 {
                font-size: 24px;
            }

            .content {
                padding: 30px 20px;
            }

            .code {
                font-size: 28px;
                letter-spacing: 6px;
            }

            .note {
                font-size: 13px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Verificación de Cuenta</h1>
        </div>
        <div class="content">
            <p class="greeting">¡Bienvenido/a a Expedined!</p>

            <p class="message">
                Es un placer darle la bienvenida a nuestra plataforma de servicios médicos digitales. Su registro es el primer paso hacia una experiencia de salud más accesible y eficiente.
            </p>

            <p class="message">
                Para garantizar la seguridad de su cuenta y acceder a todos nuestros servicios, por favor utilice el siguiente código de verificación:
            </p>

            <div class="code-container">
                <span class="code">{{ $codigo }}</span>
            </div>

            <p class="note">
                Este código es válido por 30 minutos. Si no solicitaste este registro, puedes ignorar este mensaje de forma segura.
            </p>
        </div>
        <div class="footer">
            <div class="social-links">
                <a href="#" class="facebook">Facebook</a>
                <a href="#" class="whatsapp">WhatsApp</a>
                <a href="#" class="telegram">Telegram</a>
            </div>
            <p>&copy; {{ date('Y') }} Clínica Digital. Todos los derechos reservados.</p>
            <p style="font-size: 12px; margin-top: 10px;">Este es un correo electrónico automático, por favor no responda a este mensaje.</p>
        </div>
    </div>
</body>
</html>