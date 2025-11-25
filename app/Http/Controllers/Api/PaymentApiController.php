<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class PaymentApiController extends Controller
{
    public function mpesa(Request $request)
    {
        $validated = $request->validate([
            'phone' => 'required|string',
            'amount' => 'required|numeric|min:1',
        ]);
        // Simulate M-Pesa payment (replace with real integration)
        try {
            // Normally, call Safaricom API here
            Log::info('M-Pesa payment simulated', $validated);
            return response()->json([
                'status' => 'success',
                'message' => 'Payment processed (simulated).',
            ]);
        } catch (\Exception $e) {
            Log::error('M-Pesa payment failed: ' . $e->getMessage());
            return response()->json([
                'status' => 'error',
                'message' => 'Payment failed.',
            ], 500);
        }
    }
}
