<x-app-layout>
    @if(Auth::user()->hasRole('Admin'))
        <div class="p-4 sm:p-6 md:p-8 min-h-screen bg-gray-100">
            <div class="max-w-full mx-auto">
                <div class="bg-white overflow-hidden shadow-xl rounded-lg">
                    <div class="p-4 sm:p-6">
                        <h2 class="text-2xl font-semibold mb-4">Dashboard</h2>
                        
                        <div x-data="{ activeTab: 'doctor' }">
                            <!-- Pestañas -->
                            <div class="mb-4 border-b border-gray-200">
                                <ul class="flex flex-wrap -mb-px">
                                    <li class="mr-2">
                                        <button 
                                            @click="activeTab = 'doctor'" 
                                            :class="{'border-blue-500 text-blue-600': activeTab === 'doctor', 'border-transparent text-gray-500': activeTab !== 'doctor'}"
                                            class="inline-block p-4 border-b-2 rounded-t-lg hover:text-gray-600 hover:border-gray-300">
                                            Dashboard Doctor
                                        </button>
                                    </li>
                                    <li class="mr-2">
                                        <button 
                                            @click="activeTab = 'secretaria'" 
                                            :class="{'border-blue-500 text-blue-600': activeTab === 'secretaria', 'border-transparent text-gray-500': activeTab !== 'secretaria'}"
                                            class="inline-block p-4 border-b-2 rounded-t-lg hover:text-gray-600 hover:border-gray-300">
                                            Dashboard Secretaria
                                        </button>
                                    </li>
                                </ul>
                            </div>
                            
                            <!-- Contenido de las pestañas -->
                            <div class="mt-4">
                                <div x-show="activeTab === 'doctor'" x-transition>
                                    <x-dashboard-doctor-component></x-dashboard-doctor-component>
                                </div>
                                <div x-show="activeTab === 'secretaria'" x-transition @click="initializeCalendar()">
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
