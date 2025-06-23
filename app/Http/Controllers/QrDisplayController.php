<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class QrDisplayController extends Controller
{
    public function show($id)
    {
        // En esta vista, el JavaScript hace la llamada a la API para obtener el QR y el estado
        return view('pagoQr.qr_display_page', ['transactionId' => $id]);
    }
}
