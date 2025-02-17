<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <h2 class="text-2xl font-bold mb-4">{{ isset($secretaria) ? 'Editar Secretaria' : 'Registrar Nueva Secretaria' }}</h2>

                    <form action="{{ isset($secretaria) ? route('secretarias.update', $secretaria->id) : route('secretarias.store') }}"
                        method="POST" enctype="multipart/form-data" class="space-y-6">
                        @csrf
                        @if (isset($secretaria))
                            @method('PUT')
                        @endif

                        @if ($errors->any())
                            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                                <strong class="font-bold">¡Hay errores en el formulario!</strong>
                                <ul class="mt-2">
                                    @foreach ($errors->all() as $error)
                                        <li>• {{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <!-- Información Personal -->
                        <div class="bg-gray-50 p-4 rounded-lg">
                            <h3 class="text-lg font-semibold mb-4 text-gray-700">Información Personal</h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700">Nombre Completo <label class="pl-5 text-red-500">*Obligatorio*</label></label>
                                    <input type="text" name="nombre_completo"
                                        value="{{ old('nombre_completo', $secretaria->nombre_completo ?? '') }}"
                                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 @error('nombre_completo') border-red-500 @enderror" required>
                                    @error('nombre_completo')
                                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label class="block text-sm font-medium text-gray-700">Fecha de Nacimiento <label class="pl-5 text-red-500">*Obligatorio*</label></label>
                                    <input type="date" name="fecha_nacimiento"
                                        value="{{ old('fecha_nacimiento', $secretaria->fecha_nacimiento ?? '') }}"
                                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 @error('fecha_nacimiento') border-red-500 @enderror" required>
                                    @error('fecha_nacimiento')
                                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label class="block text-sm font-medium text-gray-700">Género <label class="pl-5 text-red-500">*Obligatorio*</label></label>
                                    <select name="genero"
                                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 @error('genero') border-red-500 @enderror">
                                        <option value="">Seleccionar</option>
                                        <option value="Masculino" {{ old('genero', $secretaria->genero ?? '') == 'Masculino' ? 'selected' : '' }}>Masculino</option>
                                        <option value="Femenino" {{ old('genero', $secretaria->genero ?? '') == 'Femenino' ? 'selected' : '' }}>Femenino</option>
                                        <option value="Otro" {{ old('genero', $secretaria->genero ?? '') == 'Otro' ? 'selected' : '' }}>Otro</option>
                                    </select>
                                    @error('genero')
                                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label class="block text-sm font-medium text-gray-700">Nacionalidad <label class="pl-5 text-red-500">*Obligatorio*</label></label>
                                    <input type="text" name="nacionalidad"
                                        value="{{ old('nacionalidad', $secretaria->nacionalidad ?? '') }}"
                                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" required>
                                </div>

                                <div>
                                    <label class="block text-sm font-medium text-gray-700">Foto de Perfil <label class="pl-5 text-red-500">*Obligatorio*</label></label>
                                    <div id="drop-area" class="border-2 border-dashed @error('foto_perfil') border-red-500 @else border-gray-300 @enderror p-4 rounded-lg text-center">
                                        <p>Arrastra y suelta una imagen aquí o haz clic para seleccionar</p>
                                        <input type="file" name="foto_perfil" id="foto_perfil" accept="image/*" onchange="previewImage(this)" class="hidden">
                                    </div>
                                    @error('foto_perfil')
                                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                    @enderror
                                    <div id="imagePreview" class="mt-2 hidden">
                                        <img id="preview" class="w-32 h-32 object-cover rounded-lg shadow-md">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Información de Contacto -->
                        <div class="bg-gray-50 p-4 rounded-lg">
                            <h3 class="text-lg font-semibold mb-4 text-gray-700">Información de Contacto</h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700">Teléfono <label class="pl-5 text-gray-400">*Opcional*</label></label>
                                    <input type="tel" name="telefono"
                                        value="{{ old('telefono', $secretaria->telefono ?? '') }}"
                                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 @error('telefono') border-red-500 @enderror" 
                                        >
                                    @error('telefono')
                                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label class="block text-sm font-medium text-gray-700">Correo Electrónico <label class="pl-5 text-gray-400">*Opcional*</label></label>
                                    <input type="email" name="email"
                                        value="{{ old('email', $secretaria->email ?? '') }}"
                                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 @error('email') border-red-500 @enderror" >
                                    @error('email')
                                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="md:col-span-2">
                                    <label class="block text-sm font-medium text-gray-700">Domicilio <label class="pl-5 text-gray-400">*Opcional*</label></label>
                                    <textarea name="domicilio" rows="2"
                                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 @error('domicilio') border-red-500 @enderror"
                                        >{{ old('domicilio', $secretaria->domicilio ?? '') }}</textarea>
                                    @error('domicilio')
                                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700">Departamento <label class="pl-5 text-gray-400">*Opcional*</label></label>
                                    <input type="text" name="departamento"
                                        value="{{ old('departamento', $secretaria->departamento ?? '') }}"
                                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 @error('departamento') border-red-500 @enderror"
                                        >
                                    @error('departamento')
                                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700">Idiomas <label class="pl-5 text-gray-400">*Opcional*</label></label>
                                    <input type="text" name="idiomas"
                                        value="{{ old('idiomas', $secretaria->idiomas ?? '') }}"
                                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                                </div>
                            </div>
                        </div>

                     
                        <!-- Contacto de Emergencia -->
                        <div class="bg-gray-50 p-4 rounded-lg">
                            <h3 class="text-lg font-semibold mb-4 text-gray-700">Contacto de Emergencia</h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700">Nombre del Contacto <label class="pl-5 text-gray-400">*Opcional*</label></label>
                                    <input type="text" name="contacto_emergencia_nombre"
                                        value="{{ old('contacto_emergencia_nombre', $secretaria->contacto_emergencia_nombre ?? '') }}"
                                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" >
                                </div>

                                <div>
                                    <label class="block text-sm font-medium text-gray-700">Relación <label class="pl-5 text-gray-400">*Opcional*</label></label>
                                    <input type="text" name="contacto_emergencia_relacion"
                                        value="{{ old('contacto_emergencia_relacion', $secretaria->contacto_emergencia_relacion ?? '') }}"
                                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 @error('contacto_emergencia_relacion') border-red-500 @enderror"
                                        >
                                    @error('contacto_emergencia_relacion')
                                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label class="block text-sm font-medium text-gray-700">Teléfono <label class="pl-5 text-gray-400">*Opcional*</label></label>
                                    <input type="tel" name="contacto_emergencia_telefono"
                                        value="{{ old('contacto_emergencia_telefono', $secretaria->contacto_emergencia_telefono ?? '') }}"
                                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                                </div>

                                <div>
                                    <label class="block text-sm font-medium text-gray-700">Teléfono de Emergencia <label class="pl-5 text-gray-400">*Opcional*</label></label>
                                    <input type="tel" name="contacto_emergencia_telefono"
                                        value="{{ old('contacto_emergencia_telefono', $secretaria->contacto_emergencia_telefono ?? '') }}"
                                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 @error('contacto_emergencia_telefono') border-red-500 @enderror"
                                        >
                                    @error('contacto_emergencia_telefono')
                                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Empresa -->
                        <div class="mb-4">
                            <label for="empresa_id" class="block text-sm font-medium text-gray-700">Empresa</label>
                            <select name="empresa_id" id="empresa_id" required class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-blue-500">
                                <option value="">Selecciona una empresa</option>
                                @foreach ($empresas as $empresa)
                                    <option value="{{ $empresa->id }}">{{ $empresa->nombre }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Botones de Acción -->
                        <div class="flex justify-end space-x-3">
                            <a href="{{ route('secretarias.index') }}"
                                class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-gray-700 bg-gray-200 hover:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500">
                                Cancelar
                            </a>
                            <button type="submit"
                                class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                {{ isset($secretaria) ? 'Actualizar' : 'Guardar' }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

<script>
    function previewImage(input) {
        const preview = document.getElementById('preview');
        const previewDiv = document.getElementById('imagePreview');

        if (input.files && input.files[0]) {
            const reader = new FileReader();

            reader.onload = function(e) {
                preview.src = e.target.result;
                previewDiv.classList.remove('hidden');
            }

            reader.readAsDataURL(input.files[0]);
        }
    }

    // Drag and drop functionality
    const dropArea = document.getElementById('drop-area');

    dropArea.addEventListener('click', () => {
        document.getElementById('foto_perfil').click();
    });

    dropArea.addEventListener('dragover', (event) => {
        event.preventDefault();
        dropArea.classList.add('bg-gray-100');
    });

    dropArea.addEventListener('dragleave', () => {
        dropArea.classList.remove('bg-gray-100');
    });

    dropArea.addEventListener('drop', (event) => {
        event.preventDefault();
        dropArea.classList.remove('bg-gray-100');
        const files = event.dataTransfer.files;
        if (files.length > 0) {
            document.getElementById('foto_perfil').files = files;
            previewImage(document.getElementById('foto_perfil'));
        }
    });
</script>