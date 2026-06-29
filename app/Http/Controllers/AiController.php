<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class AiController extends Controller
{
    public function index()
    {
        return view('ai.index');
    }

    public function chat(Request $request)
    {
        $request->validate([
            'message' => 'required|string',
            'history' => 'nullable|array' // Array of previous messages for context
        ]);

        $apiKey = env('GEMINI_API_KEY');

        if (empty($apiKey)) {
            return response()->json([
                'error' => 'API Key Gemini belum dikonfigurasi di file .env. Harap tambahkan GEMINI_API_KEY.'
            ], 500);
        }

        $modelsToTry = [
            'gemini-2.0-flash-lite-001',
            'gemini-flash-lite-latest',
            'gemini-2.0-flash-001',
            'gemini-flash-latest',
            'gemini-1.5-flash-latest',
            'gemini-1.5-pro-latest',
            'gemini-pro',
        ];

        $lastError = null;

        foreach ($modelsToTry as $model) {
            try {
                $endpoint = "https://generativelanguage.googleapis.com/v1beta/models/{$model}:generateContent?key={$apiKey}";

                // System Instruction (Persona Koala Tutor)
                $systemInstruction = "Kamu adalah Koala, maskot dari aplikasi belajar TOEFL 'Englishify'. Kamu adalah seorang tutor bahasa Inggris yang ramah, asyik, dan sangat suportif. Tugas utamamu adalah membantu pengguna belajar bahasa Inggris, khususnya untuk persiapan TOEFL (Listening, Structure & Written Expression, Reading). Gunakan bahasa Indonesia yang santai tapi sopan, atau bahasa Inggris jika diminta. Berikan contoh yang jelas, penjelasan yang mudah dipahami, dan selalu semangati pengguna dalam belajarnya. Selalu posisikan dirimu sebagai Koala yang cerdas dan memakai kacamata (nerd koala). Jangan memberikan jawaban yang terlalu panjang jika tidak diperlukan, usahakan ringkas namun solutif.";

                // Prepare the history
                $contents = [];
                
                // Inject system instruction as conversation context for compatibility
                $contents[] = [
                    'role' => 'user',
                    'parts' => [['text' => "SYSTEM INSTRUCTION (Do not reply to this directly, just adopt this persona for the rest of the conversation): " . $systemInstruction]]
                ];
                $contents[] = [
                    'role' => 'model',
                    'parts' => [['text' => "Baik, saya mengerti. Saya akan bertindak sebagai Koala, tutor bahasa Inggris Englishify yang ramah, asyik, dan suportif sesuai instruksi Anda. Mari kita mulai belajarnya!"]]
                ];

                if ($request->has('history') && is_array($request->history)) {
                    foreach ($request->history as $msg) {
                        if (isset($msg['role']) && isset($msg['text'])) {
                            $role = $msg['role'] === 'model' ? 'model' : 'user';
                            $contents[] = [
                                'role' => $role,
                                'parts' => [['text' => $msg['text']]]
                            ];
                        }
                    }
                }

                // Add the current user message
                $contents[] = [
                    'role' => 'user',
                    'parts' => [['text' => $request->message]]
                ];

                $payload = [
                    'contents' => $contents,
                    'generationConfig' => [
                        'temperature' => 0.7,
                        'maxOutputTokens' => 800,
                    ]
                ];

                $response = Http::timeout(15)->post($endpoint, $payload);

                if ($response->successful()) {
                    $data = $response->json();
                    if (isset($data['candidates'][0]['content']['parts'][0]['text'])) {
                        $reply = $data['candidates'][0]['content']['parts'][0]['text'];
                        return response()->json([
                            'reply' => $reply,
                            'model_used' => $model
                        ]);
                    }
                }
                
                $errorData = $response->json();
                $lastError = $errorData['error']['message'] ?? 'Unknown API error from ' . $model;
                Log::warning("Model {$model} failed: " . $lastError);

            } catch (\Exception $e) {
                $lastError = $e->getMessage();
                Log::error("Gemini Model {$model} Exception: " . $e->getMessage());
                continue;
            }
        }

        return response()->json([
            'error' => 'Semua model gagal dihubungi. ' . ($lastError ?? 'Terjadi kesalahan sistem saat menghubungi Koala.')
        ], 500);
    }
}
