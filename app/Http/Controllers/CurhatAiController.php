<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CurhatAIController extends Controller
{
    public function index()
    {
        return view('curhat-ai.index');
    }

    public function store(Request $request)
    {
        $request->validate([
            'curhatan' => 'required|string|max:1000',
        ]);

        // Simulasi respon AI (sementara manual)
        $jawaban = "Terima kasih sudah curhat. Tetap semangat ya! 😊";

        return back()->with([
            'curhatan' => $request->curhatan,
            'jawaban' => $jawaban,
        ]);
    }
}
