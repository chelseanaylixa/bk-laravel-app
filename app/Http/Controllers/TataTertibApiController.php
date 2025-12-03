<?php

namespace App\Http\Controllers;

use App\Models\TataTertib;
use App\Models\Pelanggaran;
use Illuminate\Http\Request;

class TataTertibApiController extends Controller
{
    /**
     * GET /api/tata-tertib
     * Get all tata tertib
     */
    public function index()
    {
        try {
            $tataTertib = TataTertib::all();

            if ($tataTertib->isEmpty()) {
                return response()->json([], 200);
            }

            return response()->json($tataTertib);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    /**
     * POST /api/tata-tertib
     * Create new tata tertib
     */
    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'kategori' => 'required|string|max:100',
                'jenis_pelanggaran' => 'required|string|max:255',
                'sanksi' => 'required|string',
            ]);

            $tataTertib = TataTertib::create($validated);

            return response()->json([
                'success' => true,
                'message' => 'Tata tertib berhasil ditambahkan',
                'data' => $tataTertib
            ], 201);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json(['error' => $e->errors()], 422);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    /**
     * PUT /api/tata-tertib/{id}
     * Update tata tertib
     */
    public function update(Request $request, $id)
    {
        try {
            $tataTertib = TataTertib::findOrFail($id);

            $validated = $request->validate([
                'kategori' => 'sometimes|string|max:100',
                'jenis_pelanggaran' => 'sometimes|string|max:255',
                'sanksi' => 'sometimes|string',
            ]);

            $tataTertib->update($validated);

            return response()->json([
                'success' => true,
                'message' => 'Tata tertib berhasil diperbarui',
                'data' => $tataTertib
            ]);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json(['error' => 'Tata tertib tidak ditemukan'], 404);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json(['error' => $e->errors()], 422);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    /**
     * DELETE /api/tata-tertib/{id}
     * Delete tata tertib
     */
    public function destroy($id)
    {
        try {
            $tataTertib = TataTertib::findOrFail($id);
            $tataTertib->delete();

            return response()->json([
                'success' => true,
                'message' => 'Tata tertib berhasil dihapus'
            ]);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json(['error' => 'Tata tertib tidak ditemukan'], 404);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
