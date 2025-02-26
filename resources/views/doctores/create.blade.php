<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <h2 class="text-2xl font-bold mb-4">{{ isset($doctor) ? 'Editar Doctor' : 'Registrar Nuevo Doctor' }}
                    </h2>

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ isset($doctor) ? route('doctores.update', $doctor->id) : route('doctores.store') }}"
                        method="POST" enctype="multipart/form-data" class="space-y-6">
                        @csrf
                        @if (isset($doctor))
                            @method('PUT')
                        @endif

                        <!-- Información Personal -->
                        <div class="bg-gray-50 p-4 rounded-lg">
                            <h3 class="text-lg font-semibold mb-4 text-gray-700">Información Personal</h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700">Nombre Completo <label
                                            class="pl-5 text-red-500">*Obligatorio*</label></label>
                                    <input type="text" name="nombre_completo"
                                        value="{{ old('nombre_completo', $doctor->nombre_completo ?? '') }}"
                                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                                        required>
                                </div>

                                <div>
                                    <label class="block text-sm font-medium text-gray-700">Fecha de Nacimiento <label
                                            class="pl-5 text-red-500">*Obligatorio*</label></label>
                                    <input type="date" name="fecha_nacimiento"
                                        value="{{ old('fecha_nacimiento', $doctor->fecha_nacimiento ?? '') }}"
                                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                                </div>

                                <div>
                                    <label class="block text-sm font-medium text-gray-700">Género <label
                                            class="pl-5 text-red-500">*Obligatorio*</label></label>
                                    <select name="genero"
                                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                                        <option value="">Seleccionar</option>
                                        <option value="Masculino"
                                            {{ old('genero', $doctor->genero ?? '') == 'Masculino' ? 'selected' : '' }}>
                                            Masculino</option>
                                        <option value="Femenino"
                                            {{ old('genero', $doctor->genero ?? '') == 'Femenino' ? 'selected' : '' }}>
                                            Femenino</option>
                                        <option value="Otro"
                                            {{ old('genero', $doctor->genero ?? '') == 'Otro' ? 'selected' : '' }}>
                                            Otro</option>
                                    </select>
                                </div>

                                <div>
                                    <label class="block text-sm font-medium text-gray-700">Nacionalidad <label
                                            class="pl-5 text-red-500">*Obligatorio*</label></label>
                                    <input type="text" name="nacionalidad"
                                        value="{{ old('nacionalidad', $doctor->nacionalidad ?? '') }}"
                                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                                </div>

                                <div>
                                    <label class="block text-sm font-medium text-gray-700">Especialidad Médica <label
                                            class="pl-5 text-red-500">*Obligatorio*</label></label>
                                    <input type="text" name="especialidad_medica"
                                        value="{{ old('especialidad_medica', $doctor->especialidad_medica ?? '') }}"
                                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700">Foto de Perfil <label
                                            class="pl-5 text-red-500">*Obligatorio*</label></label>
                                    <div id="drop-area"
                                        class="border-2 border-dashed border-gray-300 p-4 rounded-lg text-center">
                                        <p>Arrastra y suelta una imagen aquí o haz clic para seleccionar</p>
                                        <input type="file" name="foto_perfil" id="foto_perfil" accept="image/*"
                                            onchange="previewImage(this)" class="hidden">
                                    </div>
                                    <div id="imagePreview" class="mt-2 hidden">
                                        <img id="preview" class="w-32 h-32 object-cover rounded-lg shadow-md">
                                    </div>
                                    @error('foto_perfil')
                                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Empresa -->
                                <div>
                                    <label for="empresa_id"
                                        class="block text-sm font-medium text-gray-700">Empresa</label>
                                    <select name="empresa_id" id="empresa_id" required
                                        class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-blue-500">
                                        <option value="">Selecciona una empresa</option>
                                        @foreach ($empresas as $empresa)
                                            <option value="{{ $empresa->id }}">{{ $empresa->nombre }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>

                        <!-- Información de Contacto -->
                        <div class="bg-gray-50 p-4 rounded-lg">
                            <h3 class="text-lg font-semibold mb-4 text-gray-700">Información de Contacto</h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 ">Teléfono <label
                                            class="pl-5 text-gray-400">*Opcional*</label></label>
                                    <input type="tel" name="telefono"
                                        value="{{ old('telefono', $doctor->telefono ?? '') }}"
                                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                                </div>

                                <div>
                                    <label class="block text-sm font-medium text-gray-700">Correo Electrónico <label
                                            class="pl-5 text-gray-400">*Opcional*</label></label>
                                    <input type="email" name="email"
                                        value="{{ old('email', $doctor->email ?? '') }}"
                                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                                </div>

                                <div class="md:col-span-2">
                                    <label class="block text-sm font-medium text-gray-700">Domicilio <label
                                            class="pl-5 text-gray-400">*Opcional*</label></label>
                                    <textarea name="domicilio" rows="2"
                                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">{{ old('domicilio', $doctor->domicilio ?? '') }}</textarea>
                                </div>
                            </div>
                        </div>

                        <!-- Información Académica y Profesional -->
                        <div class="bg-gray-50 p-4 rounded-lg">
                            <h3 class="text-lg font-semibold mb-4 text-gray-700">Información Académica y Profesional
                            </h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700">Universidad <label
                                            class="pl-5 text-gray-400">*Opcional*</label></label>
                                    <input type="text" name="universidad"
                                        value="{{ old('universidad', $doctor->universidad ?? '') }}"
                                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                                </div>

                                <div>
                                    <label class="block text-sm font-medium text-gray-700">Título <label
                                            class="pl-5 text-gray-400">*Opcional*</label></label>
                                    <input type="text" name="titulo"
                                        value="{{ old('titulo', $doctor->titulo ?? '') }}"
                                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                                </div>

                                <div>
                                    <label class="block text-sm font-medium text-gray-700">Año de Graduación <label
                                            class="pl-5 text-gray-400">*Opcional*</label></label>
                                    <input type="number" name="año_graduacion"
                                        value="{{ old('año_graduacion', $doctor->año_graduacion ?? '') }}"
                                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                                </div>

                                <div>
                                    <label class="block text-sm font-medium text-gray-700">Años de Experiencia <label
                                            class="pl-5 text-gray-400">*Opcional*</label></label>
                                    <input type="number" name="años_experiencia"
                                        value="{{ old('años_experiencia', $doctor->años_experiencia ?? '') }}"
                                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                                </div>

                                <div>
                                    <label class="block text-sm font-medium text-gray-700">Idiomas <label
                                            class="pl-5 text-gray-400">*Opcional*</label></label>
                                    <input type="text" name="idiomas"
                                        value="{{ old('idiomas', $doctor->idiomas ?? '') }}"
                                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                                </div>

                                <div class="md:col-span-2">
                                    <label class="block text-sm font-medium text-gray-700">Hospitales Previos <label
                                            class="pl-5 text-gray-400">*Opcional*</label></label>
                                    <textarea name="hospitales_previos" rows="2"
                                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">{{ old('hospitales_previos', $doctor->hospitales_previos ?? '') }}</textarea>
                                </div>

                                <div>
                                    <label class="block text-sm font-medium text-gray-700">Área/Departamento <label
                                            class="pl-5 text-gray-400">*Opcional*</label></label>
                                    <input type="text" name="area_departamento"
                                        value="{{ old('area_departamento', $doctor->area_departamento ?? '') }}"
                                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                                </div>
                            </div>
                        </div>

                        <!-- Contacto de Emergencia -->
                        <div class="bg-gray-50 p-4 rounded-lg">
                            <h3 class="text-lg font-semibold mb-4 text-gray-700">Contacto de Emergencia </h3>
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700">Nombre del Contacto <label
                                            class="pl-5 text-gray-400">*Opcional*</label></label>
                                    <input type="text" name="contacto_emergencia_nombre"
                                        value="{{ old('contacto_emergencia_nombre', $doctor->contacto_emergencia_nombre ?? '') }}"
                                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                                </div>

                                <div>
                                    <label class="block text-sm font-medium text-gray-700">Relación <label
                                            class="pl-5 text-gray-400">*Opcional*</label></label>
                                    <input type="text" name="contacto_emergencia_relacion"
                                        value="{{ old('contacto_emergencia_relacion', $doctor->contacto_emergencia_relacion ?? '') }}"
                                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                                </div>

                                <div>
                                    <label class="block text-sm font-medium text-gray-700">Teléfono <label
                                            class="pl-5 text-gray-400">*Opcional*</label></label>
                                    <input type="tel" name="contacto_emergencia_telefono"
                                        value="{{ old('contacto_emergencia_telefono', $doctor->contacto_emergencia_telefono ?? '') }}"
                                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                                </div>
                            </div>
                        </div>



                        <!-- Botones de Acción -->
                        <div class="flex justify-end space-x-3">
                            <a href="{{ route('doctores.index') }}"
                                class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-gray-700 bg-gray-200 hover:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500">
                                Cancelar
                            </a>
                            <button type="submit"
                                class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                {{ isset($doctor) ? 'Actualizar' : 'Guardar' }}
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
</script>
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
