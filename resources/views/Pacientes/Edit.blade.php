<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Editar Paciente') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-md sm:rounded-lg">
                <div class="p-6">
                    <form method="POST" action="{{ route('Pacientes.update', $paciente->id) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="flex">
                            <div class="w-1/4">
                                <label for="foto_perfil" class="block text-sm font-medium text-gray-700">Foto de Perfil</label>
                                <div id="drop-area" class="border-2 border-dashed border-gray-300 p-4 rounded-lg text-center h-auto cursor-pointer">
                                    <!-- Contenedor para la imagen existente -->
                                    <div id="existing-image-container">
                                        @if ($paciente->foto_perfil)
                                        <img src="{{ asset('images/' . $paciente->foto_perfil) }}"
                                            alt="Foto de {{ $paciente->nombre }}"
                                            class="w-24 h-24 object-cover rounded-full">
                                    @else
                                        <div
                                            class="w-24 h-24 bg-gray-200 rounded-full flex items-center justify-center">
                                            <svg class="w-16 h-16 text-gray-400" fill="none"
                                                stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    stroke-width="2"
                                                    d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                            </svg>
                                        </div>
                                    @endif
                                    </div>
                                    
                                    <!-- Contenedor para la vista previa de la nueva imagen -->
                                    <div id="image-preview-container" class="hidden mt-2">
                                        <img id="image-preview" class="w-32 h-32 object-cover rounded-lg mx-auto">
                                    </div>
                                    
                                    <p id="drop-text" class="mt-2 text-sm text-gray-500">Arrastra y suelta una imagen aquí o haz clic para seleccionar</p>
                                    
                                    <input type="file" name="foto_perfil" id="foto_perfil" accept="image/*" class="hidden">
                                </div>
                                
                                @error('foto_perfil')
                                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="w-3/4 pl-4">
                                <div class="mb-4">
                                    <label for="nombre" class="block text-sm font-medium text-gray-700">Nombre</label>
                                    <input type="text" name="nombre" id="nombre" required value="{{ old('nombre', $paciente->nombre) }}"
                                        class="block w-full p-2 mt-1 border border-gray-400 rounded-md" />
                                </div>

                                <div class="mb-4">
                                    <label for="telefono"
                                        class="block text-sm font-medium text-gray-700">Teléfono</label>
                                    <input type="text" name="telefono" id="telefono" value="{{ old('telefono', $paciente->telefono) }}"
                                        class="block w-full p-2 mt-1 border border-gray-400 rounded-md" />
                                </div>

                                <div class="mb-4">
                                    <label for="fecha_nacimiento" class="block text-sm font-medium text-gray-700">Fecha
                                        de Nacimiento</label>
                                    <input type="date" name="fecha_nacimiento" id="fecha_nacimiento" value="{{ old('fecha_nacimiento', $paciente->fecha_nacimiento) }}"
                                        class="block w-full p-2 mt-1 border border-gray-400 rounded-md" />
                                </div>
                            </div>
                        </div>

                        <div class="mb-4">
                            <label for="edad" class="block text-sm font-medium text-gray-700">Edad</label>
                            <input type="number" name="edad" id="edad" value="{{ old('edad', $paciente->edad) }}"
                                class="block w-full p-2 mt-1 border border-gray-400 rounded-md" readonly>
                        </div>

                        <div class="mb-4">
                            <label for="direccion" class="block text-sm font-medium text-gray-700">Dirección</label>
                            <input type="text" name="direccion" id="direccion" value="{{ old('direccion', $paciente->direccion) }}"
                                class="block w-full p-2 mt-1 border border-gray-400 rounded-md">
                        </div>

                        <div class="mb-4">
                            <label for="genero" class="block text-sm font-medium text-gray-700">Género</label>
                            <select name="genero" id="genero"
                                class="block w-full p-2 mt-1 border border-gray-400 rounded-md">
                                <option value="">Seleccione</option>
                                <option value="masculino" {{ old('genero', $paciente->genero) == 'masculino' ? 'selected' : '' }}>Masculino</option>
                                <option value="femenino" {{ old('genero', $paciente->genero) == 'femenino' ? 'selected' : '' }}>Femenino</option>
                                <option value="otro" {{ old('genero', $paciente->genero) == 'otro' ? 'selected' : '' }}>Otro</option>
                            </select>
                        </div>

                        <div class="mb-4">
                            <label for="estado_civil" class="block text-sm font-medium text-gray-700">Estado
                                Civil</label>
                            <select name="estado_civil" id="estado_civil"
                                class="block w-full p-2 mt-1 border border-gray-400 rounded-md">
                                <option value="">Seleccione</option>
                                <option value="soltero" {{ old('estado_civil', $paciente->estado_civil) == 'soltero' ? 'selected' : '' }}>Soltero</option>
                                <option value="casado" {{ old('estado_civil', $paciente->estado_civil) == 'casado' ? 'selected' : '' }}>Casado</option>
                                <option value="divorciado" {{ old('estado_civil', $paciente->estado_civil) == 'divorciado' ? 'selected' : '' }}>Divorciado</option>
                                <option value="viudo" {{ old('estado_civil', $paciente->estado_civil) == 'viudo' ? 'selected' : '' }}>Viudo</option>
                            </select>
                        </div>

                        <div class="mb-4">
                            <label for="tipo_sangre" class="block text-sm font-medium text-gray-700">Tipo de
                                Sangre</label>
                            <select name="tipo_sangre" id="tipo_sangre"
                                class="block w-full p-2 mt-1 border border-gray-400 rounded-md">
                                <option value="">Seleccione</option>
                                <option value="A+" {{ old('tipo_sangre', $paciente->tipo_sangre) == 'A+' ? 'selected' : '' }}>A+</option>
                                <option value="A-" {{ old('tipo_sangre', $paciente->tipo_sangre) == 'A-' ? 'selected' : '' }}>A-</option>
                                <option value="B+" {{ old('tipo_sangre', $paciente->tipo_sangre) == 'B+' ? 'selected' : '' }}>B+</option>
                                <option value="B-" {{ old('tipo_sangre', $paciente->tipo_sangre) == 'B-' ? 'selected' : '' }}>B-</option>
                                <option value="AB+" {{ old('tipo_sangre', $paciente->tipo_sangre) == 'AB+' ? 'selected' : '' }}>AB+</option>
                                <option value="AB-" {{ old('tipo_sangre', $paciente->tipo_sangre) == 'AB-' ? 'selected' : '' }}>AB-</option>
                                <option value="O+" {{ old('tipo_sangre', $paciente->tipo_sangre) == 'O+' ? 'selected' : '' }}>O+</option>
                                <option value="O-" {{ old('tipo_sangre', $paciente->tipo_sangre) == 'O-' ? 'selected' : '' }}>O-</option>
                            </select>
                        </div>

                        <div class="mb-4">
                            <label for="ocupacion" class="block text-sm font-medium text-gray-700">Ocupación</label>
                            <input type="text" name="ocupacion" id="ocupacion" value="{{ old('ocupacion', $paciente->ocupacion) }}"
                                class="block w-full p-2 mt-1 border border-gray-400 rounded-md">
                        </div>

                        <div class="flex justify-end">
                            <button type="submit"
                                class="inline-flex items-center px-4 py-2 text-xs font-semibold tracking-widest text-white uppercase transition bg-blue-500 border border-transparent rounded-md hover:bg-blue-600 active:bg-blue-700 focus:outline-none focus:border-blue-700 focus:ring focus:ring-blue-200 disabled:opacity-25">Actualizar</button>
                            <a href="{{ route('Pacientes.PacientesView') }}"
                                class="inline-flex items-center px-4 py-2 ml-2 text-xs font-semibold tracking-widest text-gray-700 uppercase transition bg-gray-200 border border-transparent rounded-md hover:bg-gray-300 active:bg-gray-400 focus:outline-none focus:border-gray-400 focus:ring focus:ring-gray-200 disabled:opacity-25">Cancelar</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const dropArea = document.getElementById('drop-area');
        const fileInput = document.getElementById('foto_perfil');
        const existingImageContainer = document.getElementById('existing-image-container');
        const imagePreviewContainer = document.getElementById('image-preview-container');
        const imagePreview = document.getElementById('image-preview');
        const dropText = document.getElementById('drop-text');
        const fechaNacimientoInput = document.getElementById('fecha_nacimiento');
        const edadInput = document.getElementById('edad');

        // Click en el área para seleccionar archivo
        dropArea.addEventListener('click', () => {
            fileInput.click();
        });

        // Manejar arrastrar y soltar
        dropArea.addEventListener('dragover', (e) => {
            e.preventDefault();
            dropArea.classList.add('border-blue-500', 'bg-blue-50');
        });

        dropArea.addEventListener('dragleave', () => {
            dropArea.classList.remove('border-blue-500', 'bg-blue-50');
        });

        dropArea.addEventListener('drop', (e) => {
            e.preventDefault();
            dropArea.classList.remove('border-blue-500', 'bg-blue-50');
            
            if (e.dataTransfer.files.length) {
                fileInput.files = e.dataTransfer.files;
                handleFileSelect(e.dataTransfer.files[0]);
            }
        });

        // Cambio en el input de archivo
        fileInput.addEventListener('change', (e) => {
            if (e.target.files.length) {
                handleFileSelect(e.target.files[0]);
            }
        });

        // Función para manejar la selección de archivo
        function handleFileSelect(file) {
            // Verificar que sea una imagen
            if (!file.type.match('image.*')) {
                alert('Por favor selecciona una imagen');
                return;
            }

            const reader = new FileReader();

            reader.onload = function(e) {
                // Ocultar imagen existente y mostrar vista previa
                existingImageContainer.classList.add('hidden');
                imagePreview.src = e.target.result;
                imagePreviewContainer.classList.remove('hidden');
                dropText.classList.add('hidden');
            }

            reader.readAsDataURL(file);
        }

        // Calcular edad automáticamente
        fechaNacimientoInput.addEventListener('change', function() {
            const fechaNacimiento = new Date(this.value);
            const today = new Date();
            let edad = today.getFullYear() - fechaNacimiento.getFullYear();
            const mesDiff = today.getMonth() - fechaNacimiento.getMonth();
            if (mesDiff < 0 || (mesDiff === 0 && today.getDate() < fechaNacimiento.getDate())) {
                edad--;
            }
            edadInput.value = edad;
        });
    });
</script>

<style>
    #drop-area {
        transition: all 0.3s ease;
        min-height: 200px;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
    }
    
    .hidden {
        display: none;
    }
    
    #existing-image-container img, #image-preview {
        width: 128px;
        height: 128px;
        object-fit: cover;
        border-radius: 0.5rem;
    }
    
    #drop-text {
        transition: all 0.3s ease;
    }
    
    .border-blue-500 {
        border-color: #3b82f6;
    }
    
    .bg-blue-50 {
        background-color: #eff6ff;
    }
</style>