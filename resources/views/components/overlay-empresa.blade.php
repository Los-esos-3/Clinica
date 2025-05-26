<div class="no-company-overlay">
    <div class="overlay-content">
        <div class="overlay-icon">
            <i class="fas fa-building"></i>
        </div>
        <h2 class="overlay-title">¡Completa tu configuración!</h2>
        <p class="overlay-message">
            Para desbloquear todas las funcionalidades del sistema, necesitas registrar una empresa. 
            <br>
            Este paso es esencial para gestionar pacientes, doctores, secretarias y acceder a todas las características premium.
        </p>
        <a href="{{ route('empresas.index') }}" class="overlay-button">
            <i class="fas fa-plus-circle"></i> Crear Mi Empresa
        </a>
        <p class="overlay-note">
            ¿Ya tienes una empresa? <a href="{{ url('/contactenos') }}">Contacta al soporte</a> para asociarla a tu cuenta.
        </p>
    </div>
</div>

<style>
    .no-company-overlay {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.85);
        backdrop-filter: blur(5px);
        z-index: 9999;
        display: flex;
        justify-content: center;
        align-items: center;
        animation: fadeIn 0.5s ease-out;
    }

    .overlay-content {
        background: white;
        border-radius: 15px;
        padding: 40px;
        max-width: 600px;
        text-align: center;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
        transform: translateY(0);
        animation: slideUp 0.5s ease-out;
    }

    .overlay-icon {
        font-size: 60px;
        color: #3498db;
        margin-bottom: 20px;
    }

    .overlay-title {
        color: #2c3e50;
        font-size: 28px;
        margin-bottom: 20px;
        font-weight: 700;
    }

    .overlay-message {
        color: #7f8c8d;
        font-size: 18px;
        line-height: 1.6;
        margin-bottom: 30px;
    }

    .overlay-button {
        display: inline-block;
        background-color: #3498db;
        color: white;
        padding: 15px 30px;
        border-radius: 50px;
        font-size: 18px;
        font-weight: 600;
        text-decoration: none;
        transition: all 0.3s ease;
        box-shadow: 0 4px 15px rgba(52, 152, 219, 0.3);
    }

    .overlay-button:hover {
        background-color: #2980b9;
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(52, 152, 219, 0.4);
    }
    a:hover
    {
        color:white;
    }
    .overlay-button i {
        margin-right: 10px;
    }

    .overlay-note {
        margin-top: 25px;
        color: #95a5a6;
        font-size: 14px;
    }

    .overlay-note a {
        color: #3498db;
        text-decoration: none;
        font-weight: 500;
    }

    .overlay-note a:hover {
        text-decoration: underline;
    }

    @keyframes fadeIn {
        from { opacity: 0; }
        to { opacity: 1; }
    }

    @keyframes slideUp {
        from { 
            transform: translateY(20px);
            opacity: 0;
        }
        to { 
            transform: translateY(0);
            opacity: 1;
        }
    }

    /* Responsive */
    @media (max-width: 768px) {
        .overlay-content {
            width: 90%;
            padding: 30px 20px;
        }
        
        .overlay-title {
            font-size: 24px;
        }
        
        .overlay-message {
            font-size: 16px;
        }
        
        .overlay-button {
            padding: 12px 25px;
            font-size: 16px;
        }
    }
</style>