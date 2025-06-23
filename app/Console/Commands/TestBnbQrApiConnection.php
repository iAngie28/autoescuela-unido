<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use Exception;
use Carbon\Carbon; // Necesario para manejar fechas, asegúrate de tenerlo importado

class TestBnbQrApiConnection extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'bnb:test-qr-connection'; // El comando que ejecutarás en la terminal

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Tests connectivity to BNB QR Simple API by getting a token and generating a sample QR.';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('🚀 Iniciando prueba de conexión a la API QR Simple del BNB...');

        // --- PASO 1: OBTENER EL TOKEN DE AUTENTICACIÓN ---
        $this->info('➡️ Paso 1: Intentando obtener el token de autenticación del BNB...');

        $tokenAuthUrl = env('BNB_SANDBOX_AUTH_URL');
        $accountId = env('BNB_SANDBOX_ACCOUNT_ID');
        $authorizationId = env('BNB_SANDBOX_AUTHORIZATION_ID');

        // Validar que las variables de entorno estén configuradas
        if (empty($tokenAuthUrl) || empty($accountId) || empty($authorizationId)) {
            $this->error('❌ Error: Las credenciales (ACCOUNT_ID, AUTHORIZATION_ID) o la URL de autenticación no están configuradas correctamente en tu archivo .env.');
            $this->error('Por favor, revisa las variables BNB_SANDBOX_AUTH_URL, BNB_SANDBOX_ACCOUNT_ID, BNB_SANDBOX_AUTHORIZATION_ID.');
            return Command::FAILURE; // Indica que el comando falló
        }

        $accessToken = null; // Variable para almacenar el token

        try {
            $this->line('   Realizando POST a: ' . $tokenAuthUrl);
            $this->line('   Con Account ID: ' . $accountId . ' y Authorization ID: ' . $authorizationId);

            $tokenResponse = Http::post($tokenAuthUrl, [
                'accountId' => $accountId,
                'authorizationId' => $authorizationId,
            ]);

            // Verificar si la petición fue exitosa (código de estado 2xx)
            if ($tokenResponse->successful()) {
                $tokenData = $tokenResponse->json();

                // La documentación indica que el token viene en el campo 'message' si 'success' es true.
                if (isset($tokenData['success']) && $tokenData['success'] === true && isset($tokenData['message'])) {
                    $accessToken = $tokenData['message']; // El token real está en 'message'
                    $this->info('✅ ¡Token obtenido con éxito!');
                    $this->line('   Token (primeros 20 caracteres): ' . substr($accessToken, 0, 20) . '...');
                } else {
                    $this->error('❌ Error al obtener el token: La bandera "success" no es true o "message" no está presente en la respuesta esperada.');
                    $this->error('   Respuesta completa: ' . $tokenResponse->body());
                    return Command::FAILURE;
                }
            } else {
                $this->error('❌ Error en la petición para obtener el token.');
                $this->error('   Código de estado HTTP: ' . $tokenResponse->status());
                $this->error('   Cuerpo de la respuesta: ' . $tokenResponse->body());
                $this->error('   URL de autenticación utilizada: ' . $tokenAuthUrl);
                return Command::FAILURE;
            }
        } catch (Exception $e) {
            $this->error('❌ Excepción al intentar obtener el token: ' . $e->getMessage());
            $this->error('   Por favor, verifica la URL: ' . $tokenAuthUrl . ' y tu conexión a internet.');
            return Command::FAILURE;
        }

        // --- PASO 2: GENERAR UN QR SIMPLE (SI SE OBTUVO EL TOKEN) ---
        if ($accessToken) {
            $this->info('➡️ Paso 2: Token obtenido. Intentando generar un QR Simple de prueba...');
            $qrGenerateUrl = env('BNB_SANDBOX_QR_GENERATE_URL');

            if (empty($qrGenerateUrl)) {
                $this->error('❌ Error: La URL para generar QR (BNB_SANDBOX_QR_GENERATE_URL) no está configurada en tu archivo .env.');
                return Command::FAILURE;
            }

            try {
                // Preparamos los datos del QR de prueba
                // Usamos Carbon para manejar las fechas fácilmente.
                // El QR expirará mañana a la misma hora del día de hoy.
                $expirationDate = Carbon::now()->addDay()->format('Y-m-d'); // Formato YYYY-MM-DD

                $qrPayload = [
                    'currency' => 'BOB', // Moneda: Bolivianos. La doc. sugiere que '2003' podría ser un código numérico para BOB en algunos servicios, pero para QR Simple se usa 'BOB'.
                    'gloss' => 'Curso Autoescuela - Prueba ' . Carbon::now()->format('YmdHis'), // Descripción del pago
                    'amount' => 10.00, // Monto del pago (usa un valor bajo para pruebas, ej. 10.00 Bs)
                    'singleUse' => true, // Este QR es de un solo uso
                    'expirationDate' => $expirationDate,
                ];

                $this->line('   Enviando solicitud de generación de QR con los siguientes datos: ' . json_encode($qrPayload, JSON_PRETTY_PRINT));
                $this->line('   A la URL: ' . $qrGenerateUrl);

                $qrResponse = Http::withHeaders([
                    'Content-Type' => 'application/json',
                    'Authorization' => 'Bearer ' . $accessToken, // ¡Aquí se usa el token obtenido!
                ])->post($qrGenerateUrl, $qrPayload);

                if ($qrResponse->successful()) {
                    $qrData = $qrResponse->json();

                    // La documentación del QR Simple indica que la respuesta exitosa tiene 'Success' (con S mayúscula)
                    if (isset($qrData['Success']) && $qrData['Success'] === true) {
                        $this->info('✅ ¡QR Simple generado con éxito!');
                        $this->line('   ID del QR: ' . ($qrData['id'] ?? 'N/A'));
                        // Mostramos los primeros 100 caracteres de la imagen Base64 para no saturar la consola
                        $this->line('   Datos de imagen QR (truncated): ' . substr($qrData['qr'] ?? 'No se recibieron datos de imagen QR', 0, 100) . '...');
                        $this->info('   Respuesta completa de la API de QR: ' . json_encode($qrData, JSON_PRETTY_PRINT));
                        $this->info('🎉 Prueba de conexión completada con éxito. ¡Ya puedes generar QRs en el Sandbox!');
                        return Command::SUCCESS;
                    } else {
                        $this->error('❌ Error al generar el QR: La bandera "Success" no es true o faltan datos esperados en la respuesta.');
                        $this->error('   Respuesta completa: ' . $qrResponse->body());
                        return Command::FAILURE;
                    }
                } else {
                    $this->error('❌ Error en la petición para generar el QR.');
                    $this->error('   Código de estado HTTP: ' . $qrResponse->status());
                    $this->error('   Cuerpo de la respuesta: ' . $qrResponse->body());
                    $this->error('   URL de generación de QR utilizada: ' . $qrGenerateUrl);
                    return Command::FAILURE;
                }
            } catch (Exception $e) {
                $this->error('❌ Excepción al intentar generar el QR: ' . $e->getMessage());
                $this->error('   Por favor, verifica la URL: ' . $qrGenerateUrl . ' y tu conexión a internet.');
                return Command::FAILURE;
            }
        }

        return Command::FAILURE; // Fallo general si el token no se pudo obtener
    }
}
