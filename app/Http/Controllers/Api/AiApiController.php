<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class AiApiController extends Controller
{
    public function chat(Request $request)
    {
        $validated = $request->validate([
            'prompt' => 'required|string',
        ]);
        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . config('services.openrouter.api_key'),
                'Content-Type' => 'application/json',
            ])->post('https://openrouter.ai/api/v1/chat', [
                'model' => 'openai/gpt-3.5-turbo',
                'messages' => [
                    ['role' => 'user', 'content' => $validated['prompt']]
                ],
            ]);
            if ($response->successful()) {
                return response()->json([
                    'status' => 'success',
                    'data' => $response->json(),
                ]);
            }
            return response()->json([
                'status' => 'error',
                'message' => 'AI API error',
                'data' => $response->json(),
            ], $response->status());
        } catch (\Exception $e) {
            Log::error('AI API failed: ' . $e->getMessage());
            return response()->json([
                'status' => 'error',
                'message' => 'AI API request failed.',
            ], 500);
        }
    }
}
