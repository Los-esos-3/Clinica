<!-- Overlay y Modal -->
<div id="modal-pagos-usuario-{{ $user->id }}" class="fixed inset-0 z-50 hidden">
    <!-- Overlay -->
    <div id="modalOverlay" class="bg-opacity-50 fixed inset-0 bg-black"></div>

    <!-- Contenido del Modal -->
    <div class="fixed inset-0 flex items-center justify-center p-4">
        <div class="w-full max-w-6xl rounded-lg bg-white shadow-xl" style="height: 90vh;">
            <!-- Encabezado -->
            <div class="flex items-center justify-between border-b p-[14px]">
                <h3 class="text-xl font-semibold">Historial de Pagos</h3>
                <button id="closeModal" class="text-gray-500 hover:text-gray-700">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

            <!-- Contenido -->
            <div class="overflow-y-auto p-4" style="height: calc(100% - 120px);">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">#</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">plan</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Precio</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Referencia</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Fecha de
                                creacion</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Fecha de
                                Vencimiento del plan</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Imagen del
                                ticket</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200 bg-white" id="paymentList">
                        @foreach ($user->pagos as $pago)
                            <tr>
                                <td class="text-center">{{ $loop->iteration }}</td>
                                <td class="text-center">{{ $pago->plan }}</td>
                                <td class="text-center">${{ number_format($pago->precio, 2) }}</td>
                                <td class="text-center">{{ $pago->referencia }}</td>
                                <td class="text-center">{{ $pago->fecha_generacion }}</td>
                                <td class="text-center">
                                    @if ($pago->tipo_pago === 'prueba')
                                        <span>{{ $user->trial_ends_at }}</span>
                                    @else
                                        <span>{{ $user->plan_expires_at }}</span>
                                    @endif
                                </td>
                                <td class="text-center">
                                    @if ($pago->tipo_pago === 'normal')
                                        <a class="text-black no-underline" target="_blank" href="{{url('images/' . $pago->ticket)}}">
                                            <button class="bg-gray-300 h-[40px] w-[70px] rounded">
                                                <i class="fa-solid fa-image"></i>
                                            </button>
                                        </a>
                                        @else
                                        <label class="text-red-500">No hay ticket para esta transaccion</label>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="border-[0.5px] border-gray-300"></div>
            <!-- Pie -->
            <div class="flex justify-between mx-6 mt-2">
                <div>
                    <label class="text-blue-500">Pagos totales = {{ $user->pagos->count() }} </label>
                </div>

                <div>
                    <label class="text-green-500">Dinero en total =
                        ${{ number_format($user->pagos->sum('precio'), 2) }}</label>
                </div>
            </div>
        </div>
    </div>
</div>



<script>
    // Función para abrir/cerrar el modal
    function toggleModal(modalId) {
        const modal = document.getElementById(modalId);
        if (modal) {
            modal.classList.toggle('hidden');
        }
    }

    // Función para cerrar el modal al hacer clic en el botón de cierre
    document.querySelectorAll('#closeModal, #cancelModal').forEach(button => {
        button.addEventListener('click', () => {
            const modal = button.closest('.fixed.inset-0.z-50');
            if (modal) {
                modal.classList.add('hidden');
            }
        });
    });
</script>
