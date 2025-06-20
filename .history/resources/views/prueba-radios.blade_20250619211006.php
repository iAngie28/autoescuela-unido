<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Prueba Radios</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
   @vite(['resources/css/app.css', 'resources/js/app.js'])
<!-- tu Tailwind -->
    <style>
        * {
            pointer-events: auto !important;
        }

        body {
            padding: 50px;
        }

        .debug {
            position: relative;
            z-index: 1000;
            background: white;
            padding: 20px;
            border: 2px solid red;
        }
    </style>
</head>
<body class="bg-gray-100 text-black">
    <div class="debug">
        <h2 class="mb-4 font-bold">Prueba de Inputs tipo Radio</h2>

        <div class="mb-3">
            <label class="block text-sm font-medium mb-1">Tipo de pago</label>
            <div class="flex items-center gap-6">
                <div class="inline-flex items-center space-x-2">
                    <input type="radio" name="tipo_pago" id="pago_paquete" value="paquete" class="h-4 w-4 text-indigo-600 border-gray-300 focus:ring-indigo-500">
                    <label for="pago_paquete" class="cursor-pointer">Paquete</label>
                </div>
                <div class="inline-flex items-center space-x-2">
                    <input type="radio" name="tipo_pago" id="pago_grupo" value="grupo" class="h-4 w-4 text-indigo-600 border-gray-300 focus:ring-indigo-500">
                    <label for="pago_grupo" class="cursor-pointer">Grupo</label>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
