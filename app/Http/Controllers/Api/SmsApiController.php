<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\TwilioSmsService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class SmsApiController extends Controller
{
    public function send(Request $request, TwilioSmsService $smsService)
    {
        $validated = $request->validate([
            'to' => 'required|string',
            'message' => 'required|string',
        ]);
        try {
            $smsService->send($validated['to'], $validated['message']);
            return response()->json(['status' => 'success', 'message' => 'SMS sent.']);
        } catch (\Exception $e) {
            Log::error('SMS send failed: ' . $e->getMessage());
            return response()->json(['status' => 'error', 'message' => 'Failed to send SMS.'], 500);
        }
    }
}
