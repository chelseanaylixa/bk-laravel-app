<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class CurhatAiController extends Controller
{
    // 1. Menampilkan halaman chat
    public function index()
    {
        return view('pages.curhat_ai');
    }

    // 2. Memproses pesan ke AI (Groq)
    public function chat(Request $request)
    {
        // Validasi input sedikit agar tidak error jika kosong
        $request->validate([
            'message' => 'required|string',
        ]);

        $userMessage = $request->input('message');
        $apiKey = env('GROQ_API_KEY');

        // Cek apakah API Key ada
        if (!$apiKey) {
            return response()->json(['reply' => 'Error: API Key belum diatur di file .env'], 500);
        }

        // Request ke Groq API
        $response = Http::withOptions(['verify' => false]) // Tetap false agar jalan di localhost
            ->withToken($apiKey)
            ->post('https://api.groq.com/openai/v1/chat/completions', [
                
                // --- PERBAIKAN DI SINI (Ganti model lama ke model baru) ---
                'model' => 'llama-3.3-70b-versatile', 
                // ---------------------------------------------------------

                'messages' => [
                    [
                        'role' => 'system', 
                        // Saya rapikan prompt-nya agar AI lebih menjiwai sebagai konselor sekolah
                        'content' => 'Kamu adalah "Teman Curhat", asisten konseling siswa SMK Antartika 1 Sidoarjo. Karaktermu ramah, pendengar yang baik, empatik, dan solutif. Gunakan bahasa Indonesia yang santai, gaul, tapi tetap sopan. Jangan menghakimi siswa, berikan dukungan semangat.'
                    ], 
                    [
                        'role' => 'user', 
                        'content' => $userMessage
                    ],
                ],
                'temperature' => 0.7, // Kreativitas jawaban (0.7 seimbang)
                'max_tokens' => 1024  // Batas panjang jawaban
            ]);

        if ($response->successful()) {
            $botReply = $response->json()['choices'][0]['message']['content'];
            return response()->json(['reply' => $botReply]);
        } else {
            // Menampilkan error detail jika gagal
            return response()->json([
                'reply' => 'Maaf, terjadi kesalahan pada AI: ' . $response->body() 
            ], 500);
        }
    }
}