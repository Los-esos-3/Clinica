<x-app-layout>
    @if(Auth::user()->hasRole('Admin'))
        <div class="p-4 sm:p-6 md:p-8 min-h-screen bg-gray-100">
            <div class="max-w-full mx-auto">
                <div class="bg-white overflow-hidden shadow-xl rounded-lg">
                    <div class="p-4 sm:p-6">
                        <h2 class="text-2xl font-semibold mb-4">AGENDA</h2>
                        <div class="flex justify-items-center justify-center">
                            <ul class="flex">
                                <li>
                                    <a href="{{ route('welcome') }}" class="inline-block p-4 border-b-2 rounded-t-lg no-underline text-zinc-950">
                                        WELCOME
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('dashboard') }}" class="inline-block p-4 border-b-2 rounded-t-lg no-underline text-zinc-950">
                                        INICIO 
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('doctores.index') }}" class="inline-block p-4 border-b-2 rounded-t-lg no-underline text-zinc-950">
                                        DOCTORES
                                    </a>
                                </li>
                                   <li>
                                    <a href="{{ route('secretarias.index') }}" class="inline-block p-4 border-b-2 rounded-t-lg no-underline text-zinc-950">
                                        SECRETARIAS
                                    </a>
                                </li> 
                                <li class="ml-1">
                                    <a href="{{route('Pacientes.PacientesView')}}" class="inline-block p-4 border-b-2 rounded-t-lg no-underline text-zinc-950">
                                        PACIENTES
                                    </a>
                                </li>

                                <li class="ml-1">
                                    <a class="inline-block p-4 border-b-2 rounded-t-lg no-underline text-zinc-950">
                                        VISITAS
                                    </a>
                                </li>

                                <li class="ml-1">
                                    <a href="{{route('ingresos.index')}}" class="inline-block p-4 border-b-2 rounded-t-lg no-underline text-zinc-950">
                                        INGRESOS
                                    </a>
                                </li>
                                <li>
                                    <a href="{{route('roles.index')}}" class="inline-block p-4 border-b-2 rounded-t-lg no-underline text-zinc-950">
                                        ROLES
                                    </a>
                                </li>
                                <li>
                                    <a href="{{route('empresas.index')}}" class="inline-block p-4 border-b-2 rounded-t-lg no-underline text-zinc-950">
                                        EMPRESA
                                    </a>
                                </li>
                            </ul>



                            <!-- <h2 class="text-2xl font-semibold mb-4">Gestión de Pacientes</h2> --> 
                        </div>
                     
                            <!-- Contenido de las pestañas -->
                            <div class="mt-4">
                            
                                <div x-show="activeTab === 'secretaria'" x-transition @click="initializeCalendar()">
                                    <div class="flex justify-between items-center mb-4">
                                        <h2 class="text-2xl font-semibold">Calendario</h2>
                                    </div>
                                    <x-dashboard-secretaria-component></x-dashboard-secretaria-component>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @else
        @role('Doctor')
            <x-dashboard-doctor-component></x-dashboard-doctor-component>
        @endrole

        @role('Secretaria')
            <x-dashboard-secretaria-component></x-dashboard-secretaria-component>
        @endrole
    @endif
</x-app-layout>

@push('scripts')
<script>
    function initializeCalendar() {
        var calendarEl = document.getElementById('secretaria-calendar');
        if (calendarEl && !calendarEl.classList.contains('initialized')) {
            var calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth',
                // Otras opciones del calendario
            });
            calendar.render();
            calendarEl.classList.add('initialized');
        }
    }

    document.addEventListener('DOMContentLoaded', function() {
        if (typeof Alpine !== 'undefined') {
            Alpine.start();
        }
    });
</script>
@endpush

