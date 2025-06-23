<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Carbon\Carbon;
use App\Models\QrTransaction;
use Illuminate\Support\Facades\Auth;

class MockQrPaymentController extends Controller
{
    public function createQrPayment(Request $request)
    {
        $request->validate([
            'amount' => 'required|numeric|min:0.01',
            'description' => 'nullable|string|max:255',
            'client_name' => 'nullable|string|max:255',
        ]);

        $transactionId = (string) Str::uuid();
        $qrData = json_encode([
            'id' => $transactionId,
            'amount' => $request->amount,
            'description' => $request->description,
            'client_name' => $request->client_name,
            'timestamp' => Carbon::now()->timestamp,
        ]);
        $qrImageUrl = 'https://api.qrserver.com/v1/create-qr-code/?size=250x250&data=' . urlencode($qrData);

        $transaction = QrTransaction::create([
            'id' => $transactionId,
            'user_id' => Auth::id(), // <--- ¡Agrega esto!
            'amount' => $request->amount,
            'description' => $request->description,
            'client_name' => $request->client_name,
            'qr_image_url' => $qrImageUrl,
            'status' => 'PENDING',
        ]);

        return response()->json($transaction, 201);
    }

    public function getQrPaymentStatus($id)
    {
        $transaction = QrTransaction::find($id);

        if (!$transaction) {
            return response()->json(['message' => 'Transaction not found'], 404);
        }

        return response()->json($transaction);
    }

    public function simulateSuccess($id)
    {
        $transaction = QrTransaction::find($id);
        if ($transaction) {
            $transaction->status = 'COMPLETED';
            $transaction->save();
            return response()->json($transaction);
        }
        return response()->json(['message' => 'Transaction not found'], 404);
    }

    public function simulateFailure($id)
    {
        $transaction = QrTransaction::find($id);
        if ($transaction) {
            $transaction->status = 'FAILED';
            $transaction->save();
            return response()->json($transaction);
        }
        return response()->json(['message' => 'Transaction not found'], 404);
    }
}
