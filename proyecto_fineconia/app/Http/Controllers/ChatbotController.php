<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class ChatbotController extends Controller
{
    public function chat(Request $request)
    {
        $request->validate([
            'message' => 'required|string'
        ]);

        try {
            $userMessage = $request->message;

            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . config('services.deepseek.key'),
                'Content-Type'  => 'application/json',
            ])->post(config('services.deepseek.url'), [
                'model' => 'deepseek-chat',
                'messages' => [
                    [
                        'role' => 'system',
                        'content' => 'Eres FineBot, el asistente oficial de la aplicación Finiconia. Respondes preguntas sobre el uso de la plataforma, finanzas personales y navegación dentro del sistema.'
                    ],
                    [
                        'role' => 'user',
                        'content' => $userMessage
                    ]
                ]
            ]);

            // 🔍 DEBUG: guardar respuesta completa en logs
            Log::info('DeepSeek response', [
                'status' => $response->status(),
                'body'   => $response->json()
            ]);

            // ❌ Si DeepSeek responde con error
            if ($response->failed()) {
                return response()->json([
                    'error' => 'DeepSeek error',
                    'status_code' => $response->status(),
                    'response' => $response->json()
                ], 500);
            }

            // ✅ Respuesta correcta
            return response()->json([
                'reply' => $response->json('choices.0.message.content'),
                'raw'   => $response->json() // ← útil mientras pruebas
            ]);

        } catch (\Exception $e) {

            // ❌ Error interno de Laravel
            Log::error('Chatbot exception', [
                'message' => $e->getMessage()
            ]);

            return response()->json([
                'error' => 'Error interno',
                'message' => $e->getMessage()
            ], 500);
        }
    }
}
