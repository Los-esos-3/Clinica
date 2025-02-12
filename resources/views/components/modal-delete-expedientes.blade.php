<!-- Modal de Confirmación -->
<div id="modal-delete-expediente-{{ $paciente->expediente ? $paciente->expediente->id : 'null' }}" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 hidden z-50">
    <div class="bg-white p-6 rounded-lg shadow-lg w-full max-w-md">
        <!-- Título del Modal -->
        <h3 class="text-xl font-semibold mb-4">Confirmar Eliminación</h3>

        <!-- Mensaje de Confirmación -->
        <p class="text-gray-600 mb-6">¿Estás seguro de que deseas eliminar este expediente del paciente {{ $paciente->nombre }}? Esta acción no se puede deshacer.</p>

        <!-- Botones de Acción -->
        <div class="flex justify-end gap-4">
            <!-- Botón para Cancelar -->
            <button onclick="toggleModal('modal-delete-expediente-{{ $paciente->expediente ? $paciente->expediente->id : 'null' }}')" class="bg-gray-500 text-white px-4 py-2 rounded-lg hover:bg-gray-600 transition-colors">
                Cancelar
            </button>

            <!-- Botón para Confirmar -->
            @if ($paciente->expediente)
                <form action="{{ route('Expedientes.destroy', $paciente->expediente->id) }}" method="POST" class="inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="bg-[rgb(55,65,81)] text-white px-4 py-2 rounded-lg">Eliminar</button>
                </form>
            @else
                <p class="text-red-500">No hay expediente disponible para eliminar.</p>
            @endif
        </div>
    </div>
</div>

<!-- Script para Manejar el Modal -->
<script>
    // Función para abrir el modal de confirmación
    function openConfirmDeleteModal() {
        document.getElementById('confirm-delete-modal').classList.remove('hidden');
    }

    // Función para cerrar el modal de confirmación
    function closeConfirmDeleteModal() {
        document.getElementById('confirm-delete-modal').classList.add('hidden');
    }

    // Función para confirmar la eliminación
    function confirmDelete() {
        // Aquí puedes agregar la lógica para eliminar el elemento
        alert('Elemento eliminado correctamente.');
        closeConfirmDeleteModal(); // Cierra el modal después de eliminar
    }

    function toggleModal(modalId) {
        const modal = document.getElementById(modalId);
        
        if (modal) {
            if (modal.classList.contains('hidden')) {
                // Abrir modal
                modal.classList.remove('hidden');
                document.body.style.overflow = 'hidden'; // Bloquea el scroll en el body
            } else {
                // Cerrar modal
                modal.classList.add('hidden');
                document.body.style.overflow = 'auto'; // Restaura el scroll en el body
            }
        }
    }
</script>