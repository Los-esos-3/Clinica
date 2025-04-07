<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nueva Queja Recibida</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap');
        
        body {
            font-family: 'Poppins', sans-serif;
            line-height: 1.6;
            color: #4a4a4a;
            background-color: #f7f9fc;
            margin: 0;
            padding: 20px;
        }
        .email-container {
            max-width: 600px;
            margin: 0 auto;
            background: white;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
        }
        .email-header {
            background: linear-gradient(135deg, #ff4d4d 0%, #d93737 100%);
            color: white;
            padding: 30px;
            text-align: center;
            position: relative;
        }
        .email-header h1 {
            margin: 0;
            font-size: 28px;
            font-weight: 600;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .email-header h1 svg {
            margin-right: 12px;
        }
        .email-header::after {
            content: '';
            position: absolute;
            bottom: -10px;
            left: 0;
            right: 0;
            height: 20px;
            background: white;
            border-radius: 20px 20px 0 0;
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
            color: #ff4d4d;
            display: flex;
            align-items: center;
        }
        .info-label svg {
            margin-right: 8px;
        }
        .info-value {
            padding: 8px 0;
            border-bottom: 1px dashed #e0e0e0;
        }
        .complaint-section {
            margin-top: 30px;
        }
        .complaint-title {
            color: #ff4d4d;
            font-size: 18px;
            font-weight: 500;
            margin-bottom: 15px;
            display: flex;
            align-items: center;
        }
        .complaint-title svg {
            margin-right: 10px;
        }
        .complaint-box {
            background: #f9f9f9;
            border-left: 4px solid #ff4d4d;
            padding: 20px;
            border-radius: 0 8px 8px 0;
            font-size: 15px;
            line-height: 1.7;
        }
        .email-footer {
            text-align: center;
            padding: 20px;
            background: #f5f5f5;
            color: #888;
            font-size: 12px;
            border-top: 1px solid #eee;
        }
        .logo {
            color: #ff4d4d;
            font-weight: 600;
            font-size: 14px;
        }
    </style>
</head>
<body>
    <div class="email-container">
        <div class="email-header">
            <h1>
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M12 22C17.5228 22 22 17.5228 22 12C22 6.47715 17.5228 2 12 2C6.47715 2 2 6.47715 2 12C2 17.5228 6.47715 22 12 22Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M12 8V12" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M12 16H12.01" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
                NUEVA QUEJA REGISTRADA
            </h1>
        </div>
        
        <div class="email-body">
            <div class="info-grid">
                <div class="info-label">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M20 21V19C20 17.9391 19.5786 16.9217 18.8284 16.1716C18.0783 15.4214 17.0609 15 16 15H8C6.93913 15 5.92172 15.4214 5.17157 16.1716C4.42143 16.9217 4 17.9391 4 19V21" stroke="#ff4d4d" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M12 11C14.2091 11 16 9.20914 16 7C16 4.79086 14.2091 3 12 3C9.79086 3 8 4.79086 8 7C8 9.20914 9.79086 11 12 11Z" stroke="#ff4d4d" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                    Nombre:
                </div>
                <div class="info-value">{{ $data['name'] }}</div>
                
                <div class="info-label">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M22 16.92V19C22 19.5304 21.7893 20.0391 21.4142 20.4142C21.0391 20.7893 20.5304 21 20 21H4C3.46957 21 2.96086 20.7893 2.58579 20.4142C2.21071 20.0391 2 19.5304 2 19V5C2 4.46957 2.21071 3.96086 2.58579 3.58579C2.96086 3.21071 3.46957 3 4 3H20C20.5304 3 21.0391 3.21071 21.4142 3.58579C21.7893 3.96086 22 4.46957 22 5V8.07" stroke="#ff4d4d" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M18 8C18.7956 8 19.5587 7.68393 20.1213 7.12132C20.6839 6.55871 21 5.79565 21 5C21 4.20435 20.6839 3.44129 20.1213 2.87868C19.5587 2.31607 18.7956 2 18 2C17.2044 2 16.4413 2.31607 15.8787 2.87868C15.3161 3.44129 15 4.20435 15 5C15 5.79565 15.3161 6.55871 15.8787 7.12132C16.4413 7.68393 17.2044 8 18 8Z" stroke="#ff4d4d" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M23 21L16 16" stroke="#ff4d4d" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                    Contacto:
                </div>
                <div class="info-value">{{ $data['contact'] }}</div>
                
                <div class="info-label">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M19 4H5C3.89543 4 3 4.89543 3 6V20C3 21.1046 3.89543 22 5 22H19C20.1046 22 21 21.1046 21 20V6C21 4.89543 20.1046 4 19 4Z" stroke="#ff4d4d" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M16 2V6" stroke="#ff4d4d" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M8 2V6" stroke="#ff4d4d" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M3 10H21" stroke="#ff4d4d" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                    Fecha/Hora:
                </div>
                <div class="info-value">{{ $data['received_at'] }}</div>
                
                <div class="info-label">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M12 22C17.5228 22 22 17.5228 22 12C22 6.47715 17.5228 2 12 2C6.47715 2 2 6.47715 2 12C2 17.5228 6.47715 22 12 22Z" stroke="#ff4d4d" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M2 12H22" stroke="#ff4d4d" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M12 2C14.5013 4.73835 15.9228 8.29203 16 12C15.9228 15.708 14.5013 19.2616 12 22C9.49872 19.2616 8.07725 15.708 8 12C8.07725 8.29203 9.49872 4.73835 12 2V2Z" stroke="#ff4d4d" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                    IP:
                </div>
                <div class="info-value">{{ $data['ip'] }}</div>
            </div>
            
            <div class="complaint-section">
                <div class="complaint-title">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M21 15C21 15.5304 20.7893 16.0391 20.4142 16.4142C20.0391 16.7893 19.5304 17 19 17H7L3 21V5C3 4.46957 3.21071 3.96086 3.58579 3.58579C3.96086 3.21071 4.46957 3 5 3H19C19.5304 3 20.0391 3.21071 20.4142 3.58579C20.7893 3.96086 21 4.46957 21 5V15Z" stroke="#ff4d4d" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                    CONTENIDO DE LA QUEJA
                </div>
                <div class="complaint-box">
                    {!! nl2br(e($data['complaint'])) !!}
                </div>
            </div>
        </div>
        
        <div class="email-footer">
            <p>Este correo fue generado automáticamente por el sistema de quejas.</p>
            <p class="logo">{{ config('app.name') }} &copy; {{ date('Y') }} - Todos los derechos reservados por WD3</p>
        </div>
    </div>
</body>
</html>