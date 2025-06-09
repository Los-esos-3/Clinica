<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Editar Trabajador') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-md sm:rounded-lg">
                <div class="p-6">
                    <form id="workerForm" method="POST" action="{{ route('Trabajadores.update', $trabajador->id) }}"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="flex">
                            <!-- Columna izquierda: Foto de perfil -->
                            <div class="w-1/4">
                                <label for="foto_perfil" class="block text-sm font-medium text-gray-700">Foto de
                                    Perfil</label>
                                <div id="drop-area"
                                    class="border-2 border-dashed border-gray-300 p-4 rounded-lg text-center h-auto cursor-pointer">
                                    <!-- Mostrar imagen actual si existe -->
                                    @if ($trabajador->foto_perfil)
                                        <div id="imagePreview" class="mt-2">
                                            <img id="preview" src="{{ url('storage/' . $trabajador->foto_perfil) }}"
                                                class="w-32 h-32 object-cover rounded-lg shadow-md">
                                        </div>
                                        <p id="drop-text" class="hidden">Arrastra y suelta una imagen aquí o haz clic
                                            para seleccionar</p>
                                    @else
                                        <p id="drop-text">Arrastra y suelta una imagen aquí o haz clic para seleccionar
                                        </p>
                                        <div id="imagePreview" class="mt-2 hidden">
                                            <img id="preview" class="w-32 h-32 object-cover rounded-lg shadow-md">
                                        </div>
                                    @endif

                                    <input type="file" name="foto_perfil" id="foto_perfil" accept="image/*"
                                        onchange="previewImage(this)" class="hidden">
                                </div>
                                @error('foto_perfil')
                                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Columna derecha: Campos de texto -->
                            <div class="w-3/4 pl-4">
                                <div class="mb-4">
                                    <label for="name" class="block text-sm font-medium text-gray-700">Nombre
                                        completo</label>
                                    <input type="text" name="name" id="name"
                                        placeholder="Ejemplo: Juan Pérez"
                                        value="{{ old('nombre', $trabajador->nombre) }}"
                                        class="block w-full p-2 mt-1 border border-gray-400 rounded-md" required />
                                </div>

                                <div class="mb-4">
                                    <label for="email" class="block text-sm font-medium text-gray-700">Correo
                                        electrónico</label>
                                    <input type="email" name="email" id="email"
                                        placeholder="Ejemplo: juan.perez@example.com"
                                        value="{{ old('correo', $trabajador->correo) }}"
                                        class="block w-full p-2 mt-1 border border-gray-400 rounded-md" required />
                                </div>

                                <div class="mb-4">
                                    <label for="tel" class="block text-sm font-medium text-gray-700">Número de
                                        teléfono</label>
                                    <input type="tel" name="tel" id="tel"
                                        placeholder="Ejemplo: 8682571245" value="{{ old('tel', $trabajador->tel) }}"
                                        class="block w-full p-2 mt-1 border border-gray-400 rounded-md" required />
                                </div>
                            </div>
                        </div>

                        <div class="mb-4">
                            <label for="password" class="block text-sm font-medium text-gray-700">Contraseña
                                (opcional)</label>
                            <input type="password" name="password" id="password" placeholder="********"
                                class="block w-full p-2 mt-1 border border-gray-400 rounded-md" />
                        </div>

                        <div class="mb-4">
                            <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Confirmar
                                contraseña (opcional)</label>
                            <input type="password" name="password_confirmation" id="password_confirmation"
                                placeholder="********"
                                class="block w-full p-2 mt-1 border border-gray-400 rounded-md" />
                        </div>

                        <div class="mb-4">
                            <label for="rol" class="block text-sm font-medium text-gray-700">Rol</label>
                            <select name="rol" id="rol"
                                class="block w-full p-2 mt-1 border border-gray-400 rounded-md">
                                <option value="">Seleccione un rol</option>
                                @foreach ($roles as $role)
                                    <option value="{{ $role->name }}"
                                        {{ $trabajador->rol == $role->name ? 'selected' : '' }}>
                                        {{ $role->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="flex justify-end">
                            <button type="submit"
                                class="inline-flex items-center px-4 py-2 text-xs font-semibold tracking-widest text-white uppercase transition bg-blue-500 border border-transparent rounded-md hover:bg-blue-600 active:bg-blue-700 focus:outline-none focus:border-blue-700 focus:ring focus:ring-blue-200 disabled:opacity-25">
                                Guardar
                            </button>
                            <a href="{{ route('Trabajadores.index') }}"
                                class="inline-flex items-center px-4 py-2 ml-2 text-xs font-semibold tracking-widest text-gray-700 uppercase transition bg-gray-200 border border-transparent rounded-md hover:bg-gray-300 active:bg-gray-400 focus:outline-none focus:border-gray-400 focus:ring focus:ring-gray-200 disabled:opacity-25">
                                Cancelar
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

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

    // Elementos del DOM
    const dropArea = document.getElementById('drop-area');
    const fileInput = document.getElementById('foto_perfil');
    const dropText = document.getElementById('drop-text');
    const imagePreview = document.getElementById('imagePreview');
    const preview = document.getElementById('preview');

    // 1. Configurar eventos de clic (funcione siempre)
    dropArea.addEventListener('click', function(e) {
        // Evitar que el clic en la imagen active el input
        if (e.target.tagName !== 'IMG') {
            fileInput.click();
        }
    });

    // 2. Mostrar imagen actual al cargar
    document.addEventListener('DOMContentLoaded', function() {
        if (preview.src && preview.src !== window.location.href) {
        }
    });

    // 3. Función para previsualizar imagen
    function previewImage(input) {
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = function(e) {
                preview.src = e.target.result;
            };
            reader.readAsDataURL(input.files[0]);
        }
    }

    // 4. Drag & Drop (mejorado)
    ['dragenter', 'dragover'].forEach(eventName => {
        dropArea.addEventListener(eventName, highlight, false);
    });

    ['dragleave', 'drop'].forEach(eventName => {
        dropArea.addEventListener(eventName, unhighlight, false);
    });

    function highlight(e) {
        e.preventDefault();
        e.stopPropagation();
        dropArea.classList.add('bg-blue-50', 'border-blue-300');
    }

    function unhighlight(e) {
        e.preventDefault();
        e.stopPropagation();
        dropArea.classList.remove('bg-blue-50', 'border-blue-300');
    }

    dropArea.addEventListener('drop', function(e) {
        const files = e.dataTransfer.files;
        if (files.length && files[0].type.match('image.*')) {
            fileInput.files = files;
            previewImage(fileInput);
        }
    });


</script>
