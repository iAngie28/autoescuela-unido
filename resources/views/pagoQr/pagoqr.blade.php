@extends('layouts.app')

@section('content')

<body class="bg-light-blue dark:bg-dark-blue">
  <div class="container mx-auto p-6">
    <h2 class="text-3xl font-bold text-center text-gray-800 dark:text-dark mb-10 p-6">
      CURSOS DISPONIBLES
    </h2>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-8 transition-colors duration-500 ease-in-out">
      <!-- Paquete Inicial -->
      <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-6 hover:shadow-xl transition-shadow">
        <h3 class="text-xl font-semibold text-gray-800 dark:text-white mb-2">Paquete Inicial</h3>
        <p class="text-gray-600 dark:text-gray-300 mb-4">Aprende a conducir desde cero con un enfoque personalizado.</p>
        <div class="text-4xl font-bold text-blue-600 dark:text-blue-400 mb-6">Bs. 1000</div>
        <ul>
          <li class="text-gray-600 dark:text-gray-300 mb-2">16 Horas Prácticas</li>
        </ul>
        <button class="mt-6 w-full bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded-md transition-colors"
          data-course-name="Paquete Inicial"
          data-course-price="1000"
          data-course-description="Aprende a conducir desde cero."
          onclick="buyCourse(this)">
          Comprar Paquete
        </button>
      </div>

      <!-- Paquete Intermedio (Más Popular) -->
      <div class="peer peer-hover:bg-blue-700 dark:peer-hover:bg-gray-600 group bg-blue-500 dark:bg-gray-700 rounded-lg shadow-2xl p-6 relative hover:shadow-xl transition-shadow">
        <span class="absolute top-0 right-0 bg-yellow-400 text-white px-3 py-1 rounded-tl-lg rounded-br-lg text-sm font-semibold">
          Más Popular
        </span>
        <h3 class="text-xl font-semibold text-white mb-2">Paquete Intermedio</h3>
        <p class="text-gray-200 mb-4">Ideal para quienes ya tienen cierta experiencia.</p>
        <div class="text-4xl font-bold text-white mb-6">Bs. 700</div>
        <ul>
          <li class="text-gray-200 mb-2">10 Horas Prácticas</li>
        </ul>
        <button class="mt-6 w-full bg-white hover:bg-gray-100 text-blue-600 font-bold py-2 px-4 rounded-md transition-colors group-hover:bg-blue-500 group-hover:text-white dark:group-hover:bg-blue-400 dark:group-hover:text-white"
          data-course-name="Paquete Intermedio"
          data-course-price="700"
          data-course-description="Perfeccionar maniobras y confianza."
          onclick="buyCourse(this)">
          Comprar Paquete
        </button>
      </div>

      <!-- Paquete Avanzado -->
      <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-6 hover:shadow-xl transition-shadow">
        <h3 class="text-xl font-semibold text-gray-800 dark:text-white mb-2">Paquete Avanzado</h3>
        <p class="text-gray-600 dark:text-gray-300 mb-4">Técnicas de manejo profesional y conducción defensiva.</p>
        <div class="text-4xl font-bold text-blue-600 dark:text-blue-400 mb-6">Bs. 400</div>
        <ul>
          <li class="text-gray-600 dark:text-gray-300 mb-2">6 Horas Prácticas</li>
        </ul>
        <button class="mt-6 w-full bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded-md transition-colors"
          data-course-name="Paquete Avanzado"
          data-course-price="400"
          data-course-description="Técnicas de manejo profesional."
          onclick="buyCourse(this)">
          Comprar Paquete
        </button>
      </div>
    </div>
  </div>

  {{-- Script de JavaScript para manejar la compra --}}
  <script>
  async function buyCourse(button) {
    const courseName = button.getAttribute('data-course-name');
    const coursePrice = parseFloat(button.getAttribute('data-course-price'));
    const courseDescription = button.getAttribute('data-course-description');

    // Mostrar confirmación antes de continuar
    const confirmar = window.confirm(
      `¿Deseas continuar con el pago del paquete "${courseName}" por Bs. ${coursePrice.toFixed(2)}?`
    );
    if (!confirmar) {
      // Si el usuario cancela, no hace nada
      return;
    }

    // Deshabilitar el botón para evitar clics múltiples
    button.disabled = true;
    button.textContent = 'Procesando...';

    try {
      const response = await fetch('/mock/qr-payments', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
          'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: JSON.stringify({
          amount: coursePrice,
          description: courseName + ': ' + courseDescription,
          client_name: 'Compra de Curso: ' + courseName
        })
      });

      if (!response.ok) {
        const errorData = await response.json();
        throw new Error(errorData.message || 'Error al iniciar el cobro QR.');
      }

      const data = await response.json();
      const transactionId = data.id;

      // Abrir la nueva pestaña
      const qrDisplayUrl = `/qr-payment-display/${transactionId}`;
      window.open(qrDisplayUrl, '_blank', 'width=600,height=700,resizable=yes,scrollbars=yes');

    } catch (error) {
      console.error('Error al procesar la compra:', error);
      alert('Hubo un error al procesar tu compra: ' + error.message);
    } finally {
      // Re-habilitar el botón
      button.disabled = false;
      button.textContent = 'Comprar Paquete';
    }
  }
</script>
</body>

@endsection
