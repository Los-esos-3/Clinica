<!-- Overlay y Modal -->
<div id="modal-pagos-usuario-{{ $user->id }}" class="fixed inset-0 z-50 hidden">
    <!-- Overlay -->
    <div id="modalOverlay" class="bg-opacity-50 fixed inset-0 bg-black"></div>

    <!-- Contenido del Modal -->
    <div class="fixed inset-0 flex items-center justify-center p-4">
        <div class="w-full max-w-6xl rounded-lg bg-white shadow-xl" style="height: 80vh;">
            <!-- Encabezado -->
            <div class="flex items-center justify-between border-b p-4">
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
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Fecha</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200 bg-white" id="paymentList">
                        @foreach ($user->pagos as $pago)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $pago->plan }}</td>
                                <td>${{ number_format($pago->precio, 2) }}</td>
                                <td>{{ $pago->referencia }}</td>
                                <td>{{ $pago->fecha_generacion }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Pie -->
            <div class="flex justify-end border-t p-4">

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
