<?php
namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;

class MessageApiController extends Controller
{
    public function sendEmail(Request $request)
    {
        $validated = $request->validate([
            'to' => 'required|email',
            'subject' => 'required|string',
            'body' => 'required|string',
        ]);
        try {
            Mail::raw($validated['body'], function ($message) use ($validated) {
                $message->to($validated['to'])
                        ->subject($validated['subject']);
            });
            return response()->json(['status' => 'success', 'message' => 'Email sent.']);
        } catch (\Exception $e) {
            Log::error('Email send failed: ' . $e->getMessage());
            return response()->json(['status' => 'error', 'message' => 'Failed to send email.'], 500);
        }
    }
}
