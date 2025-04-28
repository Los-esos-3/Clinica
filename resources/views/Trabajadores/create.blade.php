<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        /* Estilos generales */
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background-color: #f3f4f6;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }

        .container {
            max-width: 500px;
            width: 100%;
            padding: 2rem;
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        h2 {
            text-align: center;
            color: #1e293b;
            margin-bottom: 1rem;
        }

        p {
            text-align: center;
            color: #64748b;
            margin-bottom: 2rem;
        }

        .form-group {
            margin-bottom: 1.5rem;
        }

        label {
            display: block;
            font-size: 0.875rem;
            color: #334155;
            margin-bottom: 0.5rem;
        }

        input[type="text"],
        input[type="email"],
        input[type="password"],
        select {
            width: 100%;
            padding: 0.75rem;
            border: 1px solid #d1d5db;
            border-radius: 4px;
            font-size: 1rem;
            transition: border-color 0.3s ease;
        }

        input[type="text"]:focus,
        input[type="email"]:focus,
        input[type="password"]:focus,
        select:focus {
            outline: none;
            border-color: #3b82f6;
        }

        button {
            width: 100%;
            padding: 0.75rem;
            background-color: #3b82f6;
            color: #ffffff;
            font-size: 1rem;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        button:hover {
            background-color: #2563eb;
        }

        .error {
            color: #ef4444;
            font-size: 0.875rem;
            margin-top: 0.5rem;
        }
    </style>
</head>

<body>


    <div class="container">
        <h2>Alta de Trabajador</h2>
        <p>Completa el formulario para registrar un nuevo trabajador.</p>

        <form id="workerForm">
            <!-- Nombre -->
            <div class="form-group">
                <label for="name">Nombre completo</label>
                <input type="text" id="name" name="name" placeholder="Ejemplo: Juan Pérez" required>
            </div>

            <!-- Correo Electrónico -->
            <div class="form-group">
                <label for="email">Correo electrónico</label>
                <input type="email" id="email" name="email" placeholder="Ejemplo: juan.perez@example.com"
                    required>
            </div>

            <!-- Contraseña -->
            <div class="form-group">
                <label for="password">Contraseña</label>
                <input type="password" id="password" name="password" placeholder="********" required>
            </div>

            <!-- Confirmar Contraseña -->
            <div class="form-group">
                <label for="password_confirmation">Confirmar contraseña</label>
                <input type="password" id="password_confirmation" name="password_confirmation" placeholder="********"
                    required>
            </div>

            <!-- Rol -->
            <div class="form-group">
                <label for="role">Rol</label>
                <select id="role" name="role" required>
                    <option value="">Seleccione un rol</option>
                    <option value="Doctor">Doctor</option>
                    <option value="Secretaria">Secretaria</option>
                </select>
            </div>

            <!-- Botón de Envío -->
            <button type="submit">Registrar Trabajador</button>
        </form>
    </div>
    </div>
    </div>

    <script>
        // Validación básica del formulario
        document.getElementById('workerForm').addEventListener('submit', function(event) {
            const password = document.getElementById('password').value;
            const confirmPassword = document.getElementById('password_confirmation').value;

            if (password !== confirmPassword) {
                event.preventDefault();
                alert('Las contraseñas no coinciden.');
            }
        });
    </script>
</body>

</html>
