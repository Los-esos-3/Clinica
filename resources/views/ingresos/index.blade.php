<x-app-layout>
    @if(Auth::user()->hasRole('Admin'))
        <div class="p-4 sm:p-6 md:p-8 min-h-screen bg-gray-100">
            <div class="max-w-full mx-auto">
                <div class="bg-white overflow-hidden shadow-xl rounded-lg">
                    <div class="p-4 sm:p-6">
                        <div class="flex justify-items-center justify-center">
                            <ul class="flex">
                                <li>
                                    <a href="{{ route('welcome') }}" class="inline-block p-4 border-b-2 rounded-t-lg no-underline text-zinc-950">
                                        WELCOME
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('dashboard') }}" class="inline-block p-4 border-b-2 rounded-t-lg no-underline text-zinc-950">
                                        DASHBOARD
                                    </a>
                                </li>
                                
                                <li class="ml-1">
                                    <a href="{{route('Pacientes')}}" class="inline-block p-4 border-b-2 rounded-t-lg no-underline text-zinc-950">
                                        PACIENTES
                                    </a>
                                </li>

                                <li class="ml-1">
                                    <a href="{{route('Expedientes.admin')}}" class="inline-block p-4 border-b-2 rounded-t-lg no-underline text-zinc-950">
                                        EXPEDIENTES
                                    </a>
                                </li>

                                <li class="ml-1">
                                    <a href="{{route('ingresos.index')}}" class="inline-block p-4 border-b-2 rounded-t-lg no-underline text-zinc-950">
                                        INGRESOS
                                    </a>
                                </li>
                                <li>
                                    <a  class="inline-block p-4 border-b-2 rounded-t-lg no-underline text-zinc-950">
                                        ROLES
                                    </a>
                                </li>
                            </ul>
                        </div>
                    
                            
                            <!-- Contenido de las pestañas -->
                            <div class="mt-4">
                                <div>
                                    @include('ingresos.ingresosSecretaria')
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @else
        @role('Doctor')
             @include('ingresos.ingresosDoctor')
        @endrole

        @role('Secretaria')
            @include('ingresos.ingresosSecretaria')
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













