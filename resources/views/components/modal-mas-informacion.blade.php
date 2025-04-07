<div id="modal-informacion-{{ $paciente->id }}"
    class="fixed inset-0 overflow-hidden flex items-center justify-center bg-black bg-opacity-50 p-4 hidden z-50">
    <div class="bg-white w-full max-h-[120vh] p-8 rounded-2xl shadow-xl relative">
        <!-- Botón para cerrar -->
        <button onclick="toggleModal('modal-informacion-{{ $paciente->id }}')"
            class="absolute top-4 right-4 text-gray-500 hover:text-gray-700">&times;</button>

        <!-- Contenedor principal con scroll -->
        <div class="overflow-hidden max-h-[80vh]">
            <!-- Sección superior con imagen y texto -->
            <div class="flex items-center gap-4 border-b pb-4">
                @if ($paciente->foto_perfil)
                    <img src="{{ asset('images/' . $paciente->foto_perfil) }}" alt="Foto de {{ $paciente->nombre }}"
                        class="w-24 h-24 object-cover rounded-full">
                @else
                    <div class="w-24 h-24 bg-gray-200 rounded-full flex items-center justify-center">
                        <svg class="w-16 h-16 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                        </svg>
                    </div>
                @endif

                <h2 class="text-xl font-semibold">{{ $paciente->nombre }}</h2>

                <div class="border-l-2 border-gray-500 h-32"></div>

                <div class="grid grid-cols-4">
                    <p class="text-gray-600"><strong>Telefono:</strong> {{ $paciente->telefono }}
                    </p>
                    <p class="text-gray-600"><strong>Fecha de Nacimiento:</strong>
                        {{ $paciente->fecha_nacimiento }}</p>
                    <p class="text-gray-600"><strong>Edad:</strong> {{ $paciente->edad }}</p>
                    <p class="text-gray-600"><strong>Direccion:</strong>
                        {{ $paciente->direccion }}</p>
                    <p class="text-gray-600"><strong>Genero:</strong> {{ $paciente->genero }}</p>
                    <p class="text-gray-600"><strong>Estados civil:</strong>
                        {{ $paciente->estado_civil }}</p>
                    <p class="text-gray-600"><strong>Tipo de sangre:</strong>
                        {{ $paciente->tipo_sangre }}</p>
                    <p class="text-gray-600"><strong>Ocupacion:</strong>
                        {{ $paciente->ocupacion }}</p>
                </div>
            </div>

            <!-- Sección de Consultas y Expedientes -->
            <div class="grid grid-cols-2 gap-4 mt-4">
                <!-- Consultas -->
                <div class="border p-4 rounded-lg shadow overflow-y-auto max-h-[60vh]">
                    @if ($paciente->consultas->isNotEmpty())
                        <div id="ContainerTitleAndAdd" class="flex justify-between items-center w-full mb-3">
                            <div id="ContainerTitle">
                                <h3 class="text-2xl font-semibold">Consultas</h3>
                            </div>
                            
                            <div id="ContainerAdd">
                                <a href="{{ route('consultas.create', ['paciente_id' => $paciente->id]) }}" class="bg-[rgb(55,65,81)] no-underline text-white px-4 py-2 rounded-lg text-sm">Agregar</a>
                            </div>
                        </div>

                        <div class="space-y-2">
                            @foreach ($paciente->consultas as $consulta)
                                <div class="bg-gray-100 border-black rounded-lg flex items-center p-2">
                                    <div class="w-1/2">
                                        <p class="text-lg"><strong>Médico:</strong> 
                                            {{ optional($consulta->doctor)->nombre_completo ?? 'No asignado' }}
                                        </p>
                                        <p class="text-lg">
                                            <strong>Fecha y hora:</strong> 
                                            {{ (new DateTime($consulta->fecha_hora))->format('Y-m-d  h:i A' ) }} 

                                          
                                        </p>
                                        <p class="text-lg"><strong>Estado de la consulta:</strong> 
                                            {{$consulta->estado}}
                                        </p>
                                    </div>

                                    <div class="w-1/2 flex justify-end gap-1">
                                        <a href="{{ route('consultas.edit', $consulta->id) }}" 
                                            class="bg-[rgb(55,65,81)] no-underline text-white px-4 py-2 rounded-lg text-sm">Editar</a>
                                        
                                            <button onclick="toggleModal('modal-delete-consulta-{{$consulta->id}}')" class="bg-[rgb(55,65,81)] text-white px-4 py-2 rounded-lg text-sm">
                                                Eliminar
                                            </button>
                                    </div>

                                    <x-modal-delete-consultas :consulta="$consulta" :paciente="$paciente" />
                                    <x-modal-delete-expedientes :paciente="$paciente"/>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div id="ContainerTitle" class="mb-4">
                            <h3 class="text-lg font-semibold">Consultas</h3>
                        </div>
                        <div class="block text-center">
                            <p class="text-red-500">No hay consultas disponibles.</p>
                            <a href="{{ route('consultas.create', ['paciente_id' => $paciente->id]) }}"
                                class="inline-block no-underline mt-4 px-4 py-2 font-bold text-white bg-blue-500 rounded hover:bg-blue-700">
                                Agregar Consulta
                            </a>
                        </div>
                    @endif
                </div>

                <!-- Expediente -->
                <div class="border p-4 rounded-lg shadow overflow-y-auto max-h-[60vh]">
                    @if ($paciente->expediente)
                        <div id="ContainerTitleAndAdd" class="flex justify-center items-center w-full mb-4">
                            <div id="ContainerTitle" class="text-center w-full">
                                <h3 class="text-lg font-semibold">Expediente</h3>
                            </div>
                            
                        </div>

                        <div class="border-black rounded-lg  items-center px-4">
                            <div id="ContainerText" class="w-1/2">
                                <p><strong>Numero de expediente:</strong> {{ $paciente->expediente->numero_expediente }}</p>
                                <p><strong>Fecha de creación:</strong> {{ $paciente->expediente->fecha_registro }}</p>
                                <p><strong>Estado del expediente:</strong> {{ $paciente->expediente->estado }}</p>
                                <p><strong>Alergias:</strong>{{$paciente->expediente->alergias}}</p>
                                <p><strong>Antecendentes Medicos:</strong>{{$paciente->expediente->antecedentes_medicos}}</p>
                                <p><strong>Historias Quirurgico:</strong>{{$paciente->expediente->historial_quirurgico}}</p>
                                <p><strong>Historial familiar:</strong>{{$paciente->expediente->historial_familiar}}</p>
                                <p><Strong>Vacunas:</Strong>{{$paciente->expediente->vacunas}}</p>
                                <p><Strong>Medicamentos actuales:</Strong>{{$paciente->expediente->medicamentos}}</p>
                                <p><Strong>Estudios previos:</Strong>{{$paciente->expediente->estudios_previos}}</p>
                                <p><Strong>Notas medicas:</Strong>{{$paciente->expediente->notas_medicas}}</p>
                            </div>

                            <div id="ContainerButtons" class="flex justify-center gap-2">
                                <a href="{{ route('Expedientes.edit', $paciente->expediente->id) }}" class="bg-[rgb(55,65,81)] no-underline text-white px-4 py-2 rounded-lg">Editar</a>         
                                <form action="{{route('Expedientes.destroy', $paciente->expediente->id)}}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="bg-[rgb(55,65,81)] text-white px-4 py-2 rounded-lg">Eliminar</button>
                                </form>
                            </div>
                        </div>
                    @else
                        <div id="ContainerTitle" class="mb-4">
                            <h3 class="text-lg font-semibold">Expediente</h3>
                        </div>
                        <div class="block text-center">
                            <p class="text-red-500">No hay expediente disponible.</p>
                            <a href="{{ route('Expedientes.create', ['paciente_id' => $paciente->id]) }}"
                                class="inline-block no-underline mt-4 px-4 py-2 font-bold text-white bg-blue-500 rounded hover:bg-blue-700">
                                Agregar Expediente
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
