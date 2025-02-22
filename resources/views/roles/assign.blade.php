<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Asignar Rol</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .container {
            background: white;
            width: 400px;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        h2 {
            color: #333;
            margin-bottom: 20px;
        }

        label {
            display: block;
            text-align: left;
            font-weight: bold;
            margin-bottom: 5px;
        }

        select {
            width: 100%;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 4px;
            margin-bottom: 20px;
        }

        .btn-container {
            display: flex;
            justify-content: space-between;
        }

        .btn {
            padding: 10px 15px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 14px;
        }

        .btn-cancel {
            background-color: #888;
            color: white;
            text-decoration: none;
            display: inline-block;
        }

        .btn-submit {
            background-color: #007bff;
            color: white;
        }

        .btn:hover {
            opacity: 0.8;
        }
    </style>
</head>
<body>

    <div class="container">
        <h2>Asignar Rol a {{ $user->name }}</h2>
        
        <form action="{{ route('users.assign.role', $user->id) }}" method="POST">
            @csrf
            <label for="role">Seleccionar Rol:</label>
            <select name="role_id" id="role" required>
                <option value="">-- Seleccionar --</option>
                @foreach($roles as $role)
                    <option value="{{ $role->id }}">{{ $role->name }}</option>
                @endforeach
            </select>

            <div class="btn-container">
                <a href="{{ route('roles.index') }}" class="btn btn-cancel">Cancelar</a>
                <button type="submit" class="btn btn-submit">Asignar Rol</button>
            </div>
        </form>
    </div>

</body>
</html>
