<?php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\StudentApiController;
use App\Http\Controllers\Api\MessageApiController;
use App\Http\Controllers\Api\SmsApiController;
use App\Http\Controllers\Api\PaymentApiController;
use App\Http\Controllers\Api\AiApiController;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// RESTful Student API
Route::apiResource('students', StudentApiController::class);

// Email Sending API
Route::post('messages/email', [MessageApiController::class, 'sendEmail']);

// SMS Sending API
Route::post('messages/sms', [SmsApiController::class, 'send']);

// M-Pesa Payment API
Route::post('payments/mpesa', [PaymentApiController::class, 'mpesa']);

// AI Chat API
Route::post('ai/chat', [AiApiController::class, 'chat']);
