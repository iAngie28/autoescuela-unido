<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\QrTransaction;
use Illuminate\Support\Facades\Auth;

class QrTransactionController extends Controller
{
    public function misPagos()
{
    $pagos = QrTransaction::where('user_id', Auth::id())
        ->orderBy('created_at', 'desc')
        ->get();

    return view('pagoQr.histpagos', compact('pagos'));
}
}
