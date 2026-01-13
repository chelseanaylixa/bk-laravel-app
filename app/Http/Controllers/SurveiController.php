<?php

namespace App\Http\Controllers;

use App\Models\Survei;
use Illuminate\Http\Request;

class SurveiController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'kepuasan' => 'required|in:sangat_puas,puas,kurang_puas,tidak_puas',
            'masukan' => 'nullable|string',
        ]);

        Survei::create($validated);

        return back()->with('success', 'Terima kasih! Survei Anda telah berhasil dikirim.');
    }

    public function getData()
    {
        $survei = Survei::latest()->get();
        return response()->json(['survei' => $survei]);
    }

    public function getStats()
    {
        $statistics = [
            'total' => Survei::count(),
            'sangat_puas' => Survei::where('kepuasan', 'sangat_puas')->count(),
            'puas' => Survei::where('kepuasan', 'puas')->count(),
            'kurang_puas' => Survei::where('kepuasan', 'kurang_puas')->count(),
            'tidak_puas' => Survei::where('kepuasan', 'tidak_puas')->count(),
        ];

        return response()->json($statistics);
    }

    public function destroy($id)
    {
        $survei = Survei::findOrFail($id);
        $survei->delete();

        return response()->json(['message' => 'Survei berhasil dihapus'], 200);
    }
}
