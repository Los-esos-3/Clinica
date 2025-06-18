<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Subir Ticket de Pago</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Font Awesome for Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>

<body class="bg-gray-100 text-gray-900">

    <div class="flex justify-center items-center h-screen">
        <div class="w-full max-w-md bg-white shadow-lg rounded-lg overflow-hidden">
            <div class="p-6">
                <h2 class="text-2xl font-bold mb-4">Cargar Una Foto del Ticket de Pago</h2>
                
                @if (session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif

                <!-- Formulario -->
                <form id="uploadForm" action="{{ route('evidencia.store') }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf

                    <!-- Previsualización de la Imagen -->
                    <div class="mb-4">
                        <label for="ticketImage" class="block text-sm font-medium text-gray-700">Seleccionar
                            Ticket</label>
                        <input type="file" accept="image/*" id="ticket" name="ticket"
                            class="mt-1 block w-full py-2 px-3 border border-gray-300 rounded-md focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                    </div>

                    <!-- Contenedor de Previsualización -->
                    <div id="imagePreview" class="mb-4">
                        <img id="preview" class="w-full h-auto object-cover rounded-lg shadow-md hidden"
                            alt="Previsualización del Ticket">
                    </div>

                    <!-- Botón de Subida -->
                    <button type="submit"
                        class="w-full bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mt-4">
                        Subir Ticket
                    </button>
                </form>
            </div>
        </div>
    </div>

    <!-- Script para Previsualizar la Imagen -->
    <script>
        document.getElementById('ticket').addEventListener('change', function(event) {
            const file = event.target.files[0];
            if (file) {

                document.getElementById('ticket').style.display = "block";
                const reader = new FileReader();

                reader.onload = function(e) {
                    document.getElementById('preview').src = e.target.result;
                    document.getElementById('preview').style.display = 'block';
                };

                reader.readAsDataURL(file);
            }
        });
    </script>
</body>

</html>
