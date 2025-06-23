<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <title>Pago QR - Curso</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        /* Puedes añadir estilos personalizados aquí si es necesario */
        .qr-image-display {
            max-width: 300px;
            height: auto;
            border: 2px solid #3b82f6; /* Un borde azul para el QR */
            padding: 10px;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.1);
        }
        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }
        .animate-fade-in {
            animation: fadeIn 0.5s ease-out;
        }
    </style>
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">
    <div class="bg-white rounded-lg shadow-xl p-8 max-w-md w-full text-center">
        <h2 class="text-3xl font-bold text-gray-800 mb-6">Detalles del Pago QR</h2>

        <div id="loadingIndicator" class="flex flex-col items-center justify-center text-blue-500 mb-6">
            <svg class="animate-spin h-10 w-10 text-blue-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
            </svg>
            <p class="mt-3 text-lg">Cargando detalles del pago...</p>
        </div>

        <div id="paymentContent" style="display: none;" class="animate-fade-in">
            <p class="text-gray-700 text-lg mb-2">Curso: <strong class="text-blue-600" id="courseNameDisplay"></strong></p>
            <p class="text-gray-700 text-lg mb-4">Monto: <strong class="text-blue-600" id="coursePriceDisplay"></strong> Bs.</p>

            <div id="qrContainer" class="mb-6 flex justify-center">
                <img id="qrImageDisplay" src="" alt="Código QR de Pago" class="qr-image-display">
            </div>

            <p class="text-xl font-semibold mb-4">Estado del Pago: <span id="paymentStatusDisplay" class="text-yellow-500">PENDIENTE</span></p>

            <div id="paymentInstructions" class="bg-blue-50 p-4 rounded-lg border border-blue-200 text-sm text-blue-800">
                <p>Escanea el código QR con tu aplicación bancaria para completar el pago. Mantén esta ventana abierta.</p>
            </div>

            <div id="errorDisplay" class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mt-4" role="alert" style="display: none;">
                <strong class="font-bold">Error:</strong>
                <span class="block sm:inline" id="errorMessageDisplay"></span>
            </div>

            <div class="mt-6 flex justify-center space-x-4">
                <button id="closeWindowBtn" class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded-md transition-colors">Cerrar Ventana</button>
                <button id="simulateSuccessBtn" class="bg-green-500 hover:bg-green-600 text-white font-bold py-2 px-4 rounded-md transition-colors">Simular Pago Exitoso</button>
                <button id="simulateFailureBtn" class="bg-red-500 hover:bg-red-600 text-white font-bold py-2 px-4 rounded-md transition-colors">Simular Pago Fallido</button>
            </div>
        </div>
    </div>

    <script>

        const transactionId = @json($transactionId);
        document.addEventListener('DOMContentLoaded', function () {

            const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
            const MOCK_API_BASE_URL = '/mock';

            const loadingIndicator = document.getElementById('loadingIndicator');
            const paymentContent = document.getElementById('paymentContent');
            const qrImageDisplay = document.getElementById('qrImageDisplay');
            const paymentStatusDisplay = document.getElementById('paymentStatusDisplay');
            const courseNameDisplay = document.getElementById('courseNameDisplay');
            const coursePriceDisplay = document.getElementById('coursePriceDisplay');
            const errorDisplay = document.getElementById('errorDisplay');
            const errorMessageDisplay = document.getElementById('errorMessageDisplay');
            const closeWindowBtn = document.getElementById('closeWindowBtn');
            const simulateSuccessBtn = document.getElementById('simulateSuccessBtn');
            const simulateFailureBtn = document.getElementById('simulateFailureBtn');

            let checkPaymentInterval = null;

            async function fetchTransactionDetails() {
                try {

                    const response = await fetch(`${MOCK_API_BASE_URL}/qr-payments/${transactionId}`);
                    if (!response.ok) {
                        const errorData = await response.json();
                        throw new Error(errorData.message || 'Error al obtener detalles de la transacción.');
                    }
                    const data = await response.json();

                    qrImageDisplay.src = data.qr_image_url;
                    paymentStatusDisplay.textContent = data.status;
                    courseNameDisplay.textContent = data.description || 'N/A'; // Usar description si es relevante
                    coursePriceDisplay.textContent = data.amount ? Number(data.amount).toFixed(2) : 'N/A';

                    // Actualizar color del estado
                    if (data.status === 'COMPLETED') {
                        paymentStatusDisplay.className = 'text-green-600';
                        clearInterval(checkPaymentInterval);
                        alert('¡Pago completado con éxito!');
                        simulateSuccessBtn.style.display = 'none';
                        simulateFailureBtn.style.display = 'none';
                    } else if (data.status === 'FAILED') {
                        paymentStatusDisplay.className = 'text-red-600';
                        clearInterval(checkPaymentInterval);
                        alert('El pago ha fallado.');
                        simulateSuccessBtn.style.display = 'none';
                        simulateFailureBtn.style.display = 'none';
                    } else {
                        paymentStatusDisplay.className = 'text-yellow-500';
                    }

                    loadingIndicator.style.display = 'none';
                    paymentContent.style.display = 'block';

                } catch (error) {
                    console.error('Error al cargar detalles de la transacción:', error);
                    loadingIndicator.style.display = 'none';
                    errorDisplay.style.display = 'block';
                    errorMessageDisplay.textContent = error.message;
                    clearInterval(checkPaymentInterval); // Detener si hay un error inicial
                }
            }

            // Iniciar la consulta inicial y luego el intervalo
            fetchTransactionDetails();
            checkPaymentInterval = setInterval(fetchTransactionDetails, 3000); // Cada 3 segundos

            // Botones de simulación (solo para desarrollo)
            simulateSuccessBtn.addEventListener('click', async function () {
                try {
                    const response = await fetch(`${MOCK_API_BASE_URL}/qr-payments/${transactionId}/simulate-success`, {
                        method: 'POST',
                        headers: { 'X-CSRF-TOKEN': csrfToken }
                    });
                    if (!response.ok) throw new Error('Falló la simulación de éxito.');
                    fetchTransactionDetails(); // Actualizar el estado inmediatamente
                } catch (error) {
                    console.error('Error al simular éxito:', error);
                    errorMessageDisplay.textContent = 'Error al simular éxito.';
                    errorDisplay.style.display = 'block';
                }
            });

            simulateFailureBtn.addEventListener('click', async function () {
                try {
                    const response = await fetch(`${MOCK_API_BASE_URL}/qr-payments/${transactionId}/simulate-failure`, {
                        method: 'POST',
                        headers: { 'X-CSRF-TOKEN': csrfToken }
                    });
                    if (!response.ok) throw new Error('Falló la simulación de fallo.');
                    fetchTransactionDetails(); // Actualizar el estado inmediatamente
                } catch (error) {
                    console.error('Error al simular fallo:', error);
                    errorMessageDisplay.textContent = 'Error al simular fallo.';
                    errorDisplay.style.display = 'block';
                }
            });

            closeWindowBtn.addEventListener('click', function() {
                window.close(); // Cierra la pestaña/ventana actual
            });
        });
    </script>
</body>
</html>
