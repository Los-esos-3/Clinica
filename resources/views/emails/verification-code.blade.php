<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Código de Verificación</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
        }
        .container {
            background-color: #f9f9f9;
            padding: 20px;
            border-radius: 5px;
            border: 1px solid #ddd;
        }
        .code {
            background-color: #e9ecef;
            padding: 10px 20px;
            border-radius: 5px;
            font-size: 24px;
            font-weight: bold;
            text-align: center;
            margin: 20px 0;
            letter-spacing: 5px;
        }
        .footer {
            margin-top: 20px;
            font-size: 12px;
            color: #666;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Verificación de Correo Electrónico</h2>
        <p>Hola,</p>
        <p>Gracias por registrarte en nuestra plataforma. Para completar tu registro, por favor utiliza el siguiente código de verificación:</p>
        
        <div class="code">{{ $verificationCode }}</div>
        
        <p>Este código expirará en 30 minutos.</p>
        <p>Si no solicitaste este código, por favor ignora este correo.</p>
        
        <div class="footer">
            <p>Saludos,<br>El equipo de Clinica</p>
        </div>
    </div>
</body>
</html> 