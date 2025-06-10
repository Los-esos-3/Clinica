<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
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
        body {
            font-family: 'Inter', sans-serif;
        }
        .shadow-inner {
            box-shadow: inset 0 2px 4px 0 rgba(0, 0, 0, 0.06);
        }
        button:disabled {
            opacity: 0.7;
            cursor: not-allowed;
        }
        #barcodeImage { 
            image-rendering: pixelated;
            image-rendering: -moz-crisp-edges;
            image-rendering: crisp-edges;
        }
        .ticket-container {
            background: linear-gradient(to bottom right, #ffffff, #f9fafb);
            border: 2px solid #e5e7eb;
            transition: transform 0.3s ease-in-out;
        }
        .ticket-container:hover {
            transform: scale(1.02);
        }
        .status-badge {
            padding: 0.5rem 1rem;
            border-radius: 9999px;
            font-weight: 600;
        }
        .status-pending {
            background-color: #fef3c7;
            color: #d97706;
        }
        .status-success {
            background-color: #dcfce7;
            color: #16a34a;
        }
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

                    <!-- Ticket de Pago -->
                    <div class="ticket-container bg-white p-8 rounded-lg shadow-2xl w-full max-w-md mx-auto relative border-2 border-gray-200">
                        <!-- Encabezado del Ticket -->
                        <div class="text-center mb-6 border-b-2 border-gray-200 pb-4">
                            <img src="{{ url('images/oxxologo.png') }}" alt="OXXO" class="h-14 mx-auto mb-4">
                            <h2 class="text-2xl font-bold text-gray-800 mb-2">Referencia de Pago</h2>
                            <p class="text-gray-600">Válido por 24 horas</p>
                        </div>

                        <!-- Información del Pago -->
                        <div class="bg-gray-50 rounded-lg p-6 mb-6">
                            <div class="grid grid-cols-2 gap-4 mb-4">
                                <div class="text-left">
                                    <p class="text-sm text-gray-600">Plan</p>
                                    <p class="font-semibold text-gray-800" id="modalPlan">{{ Auth::user()->selected_plan ?? 'Plan Básico' }}</p>
                                </div>
                                <div class="text-left">
                                    <p class="text-sm text-gray-600">Precio</p>
                                    <p class="font-semibold text-gray-800">$<span id="modalPrecio">{{ number_format(Auth::user()->plan_price ?? 199.00, 2) }}</span> MXN</p>
                                </div>
                            </div>
                            <div class="grid grid-cols-2 gap-4 mb-4">
                                <div class="text-left">
                                    <p class="text-sm text-gray-600">Fecha de generación</p>
                                    <p class="font-semibold text-gray-800" id="modalFecha">{{ now()->format('d/m/Y H:i') }}</p>
                                </div>
                                <div class="text-left">
                                    <p class="text-sm text-gray-600">Referencia OXXO</p>
                                    <p class="font-semibold text-gray-800" id="codigoRef">{{ strtoupper(Str::random(10)) }}</p>
                                </div>
                            </div>

                            <!-- Código de Barras -->
                            <div class="mt-6 text-center">
                                <div class="bg-white p-4 rounded-lg shadow-inner inline-block">
                                    <img id="barcodeImage" src="" alt="Código de barras" class="mx-auto w-48" />
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
                            <button onclick="guardarPago()" class="w-full bg-gradient-to-r from-blue-600 to-indigo-600 text-white py-3 rounded-lg hover:from-blue-700 hover:to-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-all duration-300 flex items-center justify-center">
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
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Verificar si ya existe una referencia en sessionStorage
            let referencia = sessionStorage.getItem('oxxo_referencia');
            if (!referencia) {
                referencia = generateRandomReference();
                sessionStorage.setItem('oxxo_referencia', referencia);
            }
            
            document.getElementById('codigoRef').innerText = referencia;
            
            // Generar el código de barras usando JsBarcode
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
            document.getElementById('modalFecha').dataset.isoDate = fecha.toISOString();
        });

        function generateRandomReference() {
            const chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
            let result = '';
            for (let i = 0; i < 10; i++) {
                result += chars.charAt(Math.floor(Math.random() * chars.length));
            }
            return result;
        }

        function generarPDF() {
            const ticket = document.querySelector('.ticket-container');
            
            // Asegurarse de que el código de barras esté generado
            const barcodeImg = document.getElementById('barcodeImage');
            if (!barcodeImg.complete) {
                Swal.fire({
                    icon: 'warning',
                    title: 'Espera un momento',
                    text: 'Estamos preparando el ticket...',
                    showConfirmButton: false,
                    timer: 2000
                });
            }

            html2canvas(ticket, {
                scale: 2,
                useCORS: true,
                logging: false,
                backgroundColor: '#ffffff',
                onclone: function(clonedDoc) {
                    // Asegurarse de que el código de barras esté visible en el clon
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

                const imgWidth = 210; // A4 width in mm
                const imgHeight = (canvas.height * imgWidth) / canvas.width;
                
                pdf.addImage(imgData, 'PNG', 0, 0, imgWidth, imgHeight);
                
                // Agregar fecha y hora de generación
                const fecha = new Date().toLocaleString('es-ES');
                pdf.setFontSize(8);
                pdf.text(`Generado el: ${fecha}`, 10, imgHeight + 10);
                
                // Guardar el PDF
                pdf.save('ticket-oxxo.pdf');
            }).catch(error => {
                console.error('Error al generar PDF:', error);
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'No se pudo generar el PDF. Por favor, intenta de nuevo.',
                    confirmButtonText: 'Entendido'
                });
            });
        }

        // Prevenir la recarga de la página
        window.onbeforeunload = function(e) {
            if (!sessionStorage.getItem('oxxo_referencia')) {
                return;
            }
            e.preventDefault();
            e.returnValue = '';
        };

        function guardarPago() {
            const referencia = document.getElementById('codigoRef').innerText;
            const plan = document.getElementById('modalPlan').innerText;
            const precio = document.getElementById('modalPrecio').innerText;
            const fecha = document.getElementById('modalFecha').dataset.isoDate;

            if (!referencia || !plan || !precio || !fecha) {
                Swal.fire({
                    icon: 'warning',
                    title: 'Campos incompletos',
                    text: 'Por favor, completa todos los campos.',
                    confirmButtonText: 'Entendido'
                });
                return;
            }

            const confirmButton = document.querySelector('button[onclick="guardarPago()"]');
            const originalText = confirmButton.innerHTML;
            confirmButton.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i> Procesando...';
            confirmButton.disabled = true;

            fetch("{{ route('pagos.store') }}", {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': "{{ csrf_token() }}",
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({ plan, precio, referencia, fecha })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    Swal.fire({
                        title: '¡Éxito!',
                        html: `
                            <div class="text-left">
                                <p class="mb-2"><strong>Referencia:</strong> ${referencia}</p>
                                <p class="mb-2"><strong>Plan:</strong> ${plan}</p>
                                <p class="mb-2"><strong>Monto:</strong> $${precio} MXN</p>
                            </div>
                        `,
                        icon: 'success',
                        confirmButtonText: 'Descargar Ticket',
                        confirmButtonColor: '#1d4ed8',
                        showCancelButton: true,
                        cancelButtonText: 'Ir al Dashboard',
                        cancelButtonColor: '#6b7280'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            generarPDF();
                        }
                        // Redirigir al dashboard
                        window.location.href = data.redirect;
                    });
                } else {
                    throw new Error(data.message || 'Error al procesar el pago');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: error.message || 'Error al procesar el pago',
                    confirmButtonText: 'Reintentar'
                });
            })
            .finally(() => {
                confirmButton.innerHTML = originalText;
                confirmButton.disabled = false;
            });
        }
    </script>
</x-app-layout>

</body>
</html>