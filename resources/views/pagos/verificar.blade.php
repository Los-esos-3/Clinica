<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Ticket de Pago OXXO</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Font Awesome for Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- jsPDF -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
    <!-- JsBarcode -->
    <script src="https://cdn.jsdelivr.net/npm/jsbarcode@3.11.5/dist/JsBarcode.all.min.js"></script>
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet">
    <style>
        /* Tus estilos actuales... */
    </style>
</head>

<body class="bg-gray-100 text-gray-900">
    <x-app-layout>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <div class="text-center mb-8">
                            <h1 class="text-4xl font-extrabold text-gray-800 mb-2">Ticket de Pago OXXO</h1>
                            <p class="text-gray-600">Completa tu pago en cualquier tienda OXXO</p>
                        </div>

                        <!-- Formulario de Pago -->
                        <form method="POST" action="{{ route('pagos.store') }}" id="pagoForm">
                            @csrf
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <!-- Campos ocultos con los datos -->
                            <input type="hidden" name="plan"
                                value="{{ Auth::user()->selected_plan ?? 'Plan Básico' }}">
                            <input type="hidden" name="precio" value="{{ Auth::user()->plan_price ?? 199.0 }}">
                            <input type="hidden" name="referencia" id="formReferencia"
                                value="{{ strtoupper(Str::random(10)) }}">
                            <input type="hidden" name="fecha" id="formFecha"
                                value="{{ now()->format('Y-m-d H:i:s') }}">

                            <!-- Ticket de Pago (visual) -->
                            <div
                                class="ticket-container bg-white p-8 rounded-lg shadow-2xl w-full max-w-md mx-auto relative border-2 border-gray-200">
                                <!-- Encabezado del Ticket -->
                                <div class="text-center mb-6 border-b-2 border-gray-200 pb-4">
                                    <img src="{{ url('images/oxxologo.png') }}" alt="OXXO"
                                        class="h-14 mx-auto mb-4">
                                    <h2 class="text-2xl font-bold text-gray-800 mb-2">Referencia de Pago</h2>
                                    <p class="text-gray-600">Válido por 24 horas</p>
                                </div>

                                <!-- Información del Pago -->
                                <div class="bg-gray-50 rounded-lg p-6 mb-6">
                                    <div class="grid grid-cols-2 gap-4 mb-4">
                                        <div class="text-left">
                                            <p class="text-sm text-gray-600">Plan</p>
                                            <p class="font-semibold text-gray-800" id="modalPlan">
                                                {{ Auth::user()->selected_plan ?? 'Plan Básico' }}
                                            </p>
                                        </div>
                                        <div class="text-left">
                                            <p class="text-sm text-gray-600">Precio</p>
                                            <p class="font-semibold text-gray-800">$
                                                <span
                                                    id="modalPrecio">{{ number_format(Auth::user()->plan_price ?? 199.0, 2) }}</span>
                                                MXN
                                            </p>
                                        </div>
                                    </div>
                                    <div class="grid grid-cols-2 gap-4 mb-4">
                                        <div class="text-left">
                                            <p class="text-sm text-gray-600">Fecha de generación</p>
                                            <p class="font-semibold text-gray-800" id="modalFecha">
                                                {{ now()->format('d/m/Y H:i') }}
                                            </p>
                                        </div>
                                        <div class="text-left">
                                            <p class="text-sm text-gray-600">Referencia OXXO</p>
                                            <p class="font-semibold text-gray-800" id="codigoRef">
                                                {{ strtoupper(Str::random(10)) }}
                                            </p>
                                        </div>
                                    </div>

                                    <!-- Código de Barras -->
                                    <div class="mt-6 text-center">
                                        <div class="bg-white p-4 rounded-lg shadow-inner inline-block">
                                            <img id="barcodeImage" src="" alt="Código de barras"
                                                class="mx-auto w-48" />
                                        </div>
                                    </div>
                                </div>

                                <!-- Instrucciones de Pago -->
                                <div class="bg-blue-50 border-l-4 border-blue-500 p-4 mb-6">
                                    <div class="flex">
                                        <div class="flex-shrink-0">
                                            <i class="fas fa-info-circle text-blue-500"></i>
                                        </div>
                                        <div class="ml-3">
                                            <p class="text-sm text-blue-700">
                                                <strong>Instrucciones:</strong><br>
                                                1. Presente este código en cualquier tienda OXXO<br>
                                                2. Indique que desea realizar un pago de servicio<br>
                                                3. Muestre el código de barras al cajero<br>
                                                4. Realice el pago en efectivo<br>
                                                5. Guarde su ticket de pago
                                            </p>
                                        </div>
                                    </div>
                                </div>

                                <!-- Estado del Pago -->
                                <div class="text-center mb-6">
                                    <div class="inline-flex items-center status-badge status-pending">
                                        <i class="fas fa-clock mr-2"></i>
                                        <span>Pendiente de Pago</span>
                                    </div>
                                </div>

                                <!-- Botón de Confirmar -->
                                <div class="text-center">
                                    <button type="submit" id="submitButton"
                                        class="w-full bg-gradient-to-r from-blue-600 to-indigo-600 text-white py-3 rounded-lg hover:from-blue-700 hover:to-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-all duration-300 flex items-center justify-center">
                                        <i class="fas fa-check-circle mr-2"></i>
                                        Confirmar y Generar Ticket
                                    </button>
                                </div>

                                <!-- Información Adicional -->
                                <div class="mt-6 text-center text-sm text-gray-500">
                                    <p>Después de realizar el pago, tu suscripción se activará automáticamente.</p>
                                    <p class="mt-2">Para cualquier duda, contacta a soporte.</p>
                                </div>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>

        <script>
            document.addEventListener('DOMContentLoaded', function() {
                // Referencia y código de barras
                const referencia = document.getElementById('codigoRef').innerText;
                document.getElementById('formReferencia').value = referencia;
            
                try {
                    JsBarcode("#barcodeImage", referencia, {
                        format: "CODE128",
                        width: 2,
                        height: 100,
                        displayValue: true,
                        fontSize: 20,
                        margin: 10
                    });
                } catch (error) {
                    console.error('Error al generar código de barras:', error);
                }
            
                const fecha = new Date();
                document.getElementById('modalFecha').innerText = fecha.toLocaleString('es-ES', {
                    year: 'numeric',
                    month: '2-digit',
                    day: '2-digit',
                    hour: '2-digit',
                    minute: '2-digit'
                });
                document.getElementById('formFecha').value = fecha.toISOString();
            });
            
            // Manejo del envío del formulario
            document.getElementById('pagoForm').addEventListener('submit', function(e) {
                e.preventDefault(); // Prevenir envío inmediato
            
                const button = document.getElementById('submitButton');
                button.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i> Procesando...';
                button.disabled = true;

                // Primero enviamos el formulario
                fetch(this.action, {
                    method: 'POST',
                    body: new FormData(this),
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        // Si el pago se guardó correctamente, generamos el PDF
                        return generarPDF().then(() => {
                            window.location.href = data.redirect;
                        });
                    } else {
                        throw new Error(data.message || 'Error al procesar el pago');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    button.innerHTML = '<i class="fas fa-check-circle mr-2"></i> Confirmar y Generar Ticket';
                    button.disabled = false;
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Hubo un error al procesar el pago. Por favor, recargue nuevamente la pagina si persiste el error.'
                    });
                });
            });
            
            function generarPDF() {
                return new Promise((resolve, reject) => {
                    const ticket = document.querySelector('.ticket-container');
            
                    html2canvas(ticket, {
                        scale: 2,
                        useCORS: true,
                        logging: false,
                        backgroundColor: '#ffffff',
                        onclone: function(clonedDoc) {
                            const clonedBarcode = clonedDoc.getElementById('barcodeImage');
                            if (clonedBarcode) {
                                clonedBarcode.style.display = 'block';
                                clonedBarcode.style.width = '100%';
                                clonedBarcode.style.height = 'auto';
                            }
                        }
                    }).then(canvas => {
                        const imgData = canvas.toDataURL('image/png', 1.0);
                        const pdf = new jspdf.jsPDF({
                            orientation: 'portrait',
                            unit: 'mm',
                            format: 'a4'
                        });
            
                        const imgWidth = 210;
                        const imgHeight = (canvas.height * imgWidth) / canvas.width;
            
                        pdf.addImage(imgData, 'PNG', 0, 0, imgWidth, imgHeight);
            
                        const fecha = new Date().toLocaleString('es-ES');
                        pdf.setFontSize(8);
                        pdf.text(`Generado el: ${fecha}`, 10, imgHeight + 10);
            
                        pdf.save('ticket-oxxo.pdf');
                        resolve();
                    }).catch(error => {
                        reject(error);
                    });
                });
            }
            </script>
            
    </x-app-layout>
</body>

</html>