<?php

namespace App\Http\Controllers;

use App\Models\Kasus;
use App\Models\Siswa;
use App\Models\Pelanggaran;
use Illuminate\Http\Request;

class KasusApiController extends Controller
{
    /**
     * GET /api/siswa-list
     * Returns all siswa with their total poin
     */
    public function getSiswaWithPoin()
    {
        $siswaList = Siswa::with('kasus.pelanggaran')
            ->get()
            ->map(function ($siswa) {
                return [
                    'id' => $siswa->id,
                    'user_id' => $siswa->user_id,
                    'nama_lengkap' => $siswa->nama_lengkap,
                    'nis' => $siswa->nis,
                    'email' => $siswa->user->email ?? 'N/A',
                    'totalPoin' => $siswa->getTotalPoin(),
                    'kasusCount' => $siswa->kasus()->count(),
                ];
            })
            ->sortBy('nama_lengkap')
            ->values();

        return response()->json($siswaList);
    }

    /**
     * GET /api/kasus
     * Get all kasus dengan relasi
     */
    public function getAllKasus()
    {
        $kasus = Kasus::with(['siswa', 'pelanggaran'])
            ->orderBy('created_at', 'desc')
            ->get()
            ->map(function ($k) {
                return [
                    'id' => $k->id,
                    'siswa_id' => $k->siswa_id,
                    'nama_siswa' => $k->siswa->nama_lengkap ?? 'N/A',
                    'pelanggaran' => $k->pelanggaran->nama_pelanggaran ?? 'N/A',
                    'poin' => $k->pelanggaran->jumlah_poin ?? 0,
                    'status' => $k->status,
                    'tanggal' => $k->tanggal,
                    'catatan' => $k->catatan,
                ];
            });

        return response()->json($kasus);
    }

    /**
     * GET /api/kasus/siswa/{siswaId}
     * Get kasus for a specific siswa
     */
    public function getKasusBySiswa($siswaId)
    {
        $siswa = Siswa::find($siswaId);

        if (!$siswa) {
            return response()->json(['error' => 'Siswa tidak ditemukan'], 404);
        }

        $kasus = Kasus::where('siswa_id', $siswaId)
            ->with('pelanggaran')
            ->orderBy('created_at', 'desc')
            ->get()
            ->map(function ($k) {
                return [
                    'id' => $k->id,
                    'pelanggaran' => $k->pelanggaran->nama_pelanggaran ?? 'N/A',
                    'poin' => $k->pelanggaran->jumlah_poin ?? 0,
                    'status' => $k->status,
                    'tanggal' => $k->tanggal,
                    'catatan' => $k->catatan,
                ];
            });

        return response()->json([
            'siswa' => $siswa->nama_lengkap,
            'nis' => $siswa->nis,
            'totalPoin' => $siswa->getTotalPoin(),
            'kasusCount' => count($kasus),
            'kasus' => $kasus,
        ]);
    }

    /**
     * POST /api/kasus
     * Create new kasus
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'siswa_id' => 'required|exists:siswa,id',
            'pelanggaran_id' => 'required|exists:pelanggaran,id',
            'tanggal' => 'required|date',
            'status' => 'required|in:diproses,selesai',
            'catatan' => 'nullable|string',
        ]);

        $kasus = Kasus::create($validated);

        return response()->json([
            'success' => true,
            'message' => 'Kasus berhasil ditambahkan',
            'kasus' => [
                'id' => $kasus->id,
                'siswa_id' => $kasus->siswa_id,
                'nama_siswa' => $kasus->siswa->nama_lengkap,
                'pelanggaran' => $kasus->pelanggaran->nama_pelanggaran,
                'poin' => $kasus->pelanggaran->jumlah_poin,
                'status' => $kasus->status,
                'tanggal' => $kasus->tanggal,
            ],
        ], 201);
    }

    /**
     * PUT /api/kasus/{kasusId}
     * Update kasus
     */
    public function update(Request $request, $kasusId)
    {
        $kasus = Kasus::find($kasusId);

        if (!$kasus) {
            return response()->json(['error' => 'Kasus tidak ditemukan'], 404);
        }

        $validated = $request->validate([
            'pelanggaran_id' => 'sometimes|exists:pelanggaran,id',
            'tanggal' => 'sometimes|date',
            'status' => 'sometimes|in:diproses,selesai',
            'catatan' => 'nullable|string',
        ]);

        $kasus->update($validated);

        return response()->json([
            'success' => true,
            'message' => 'Kasus berhasil diupdate',
        ]);
    }

    /**
     * DELETE /api/kasus/{kasusId}
     * Delete kasus
     */
    public function destroy($kasusId)
    {
        $kasus = Kasus::find($kasusId);

        if (!$kasus) {
            return response()->json(['error' => 'Kasus tidak ditemukan'], 404);
        }

        $kasus->delete();

        return response()->json([
            'success' => true,
            'message' => 'Kasus berhasil dihapus',
        ]);
    }
}
