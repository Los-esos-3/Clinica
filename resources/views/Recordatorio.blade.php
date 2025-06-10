<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recordatorio de Cuenta</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f9fafb;
            color: #334155;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 600px;
            margin: 20px auto;
            padding: 20px;
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        .header {
            text-align: center;
            margin-bottom: 20px;
        }
        .header h1 {
            font-size: 24px;
            color: #1e40af;
        }
        .content {
            margin-bottom: 20px;
        }
        .content p {
            font-size: 16px;
            line-height: 1.5;
        }
        .highlight {
            font-weight: bold;
            color: #1e40af;
        }
        .footer {
            text-align: center;
            font-size: 14px;
            color: #6b7280;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>¡Hola, {{ $user->name }}!</h1>
            <p>Este es un recordatorio sobre tu cuenta y plan activo.</p>
        </div>

        <div class="content">
            <p>A continuación, te proporcionamos los detalles de tu cuenta:</p>
            <ul>
                <li><strong>Correo Electrónico:</strong> {{ $user->email }}</li>
                <li><strong>Plan Seleccionado:</strong> {{ $planName }}</li>
                <li><strong>Precio del plan:</strong>${{$price_plan}}</li>
                <li><strong>Fecha de Expiración:</strong> {{ $expirationDate }}</li>
                <li><strong>Tiempo Restantes:</strong>{{ $remainingDays }}</li>
            </ul>
        </div>

        <div class="footer">
            <p>Si tienes alguna pregunta o necesitas ayuda, no dudes en contactarnos.</p>
            <p>Gracias por usar nuestro servicio.</p>
        </div>
    </div>
</body>
</html>