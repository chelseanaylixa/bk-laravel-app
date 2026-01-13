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
        // Terima input dari front-end: siswa_id, pelanggaran (string), poin (int), catatan (optional)
        $validated = $request->validate([
            'siswa_id' => 'required|exists:siswa,id',
            'pelanggaran' => 'required|string',
            'poin' => 'required|integer|min:0',
            'catatan' => 'nullable|string',
        ]);

        $pelanggaranName = trim($validated['pelanggaran']);

        // Cari pelanggaran yang sudah ada (case-insensitive)
        $pel = Pelanggaran::whereRaw('LOWER(nama_pelanggaran) = ?', [mb_strtolower($pelanggaranName)])->first();

        if (!$pel) {
            $pel = Pelanggaran::create([
                'nama_pelanggaran' => $pelanggaranName,
                'jumlah_poin' => $validated['poin'],
                // Provide a sensible default kategori to satisfy non-null DB column
                'kategori' => 'lainnya',
            ]);
        } else {
            // Jika poin berbeda, perbarui jumlah_poin agar konsisten
            if (isset($validated['poin']) && $pel->jumlah_poin != $validated['poin']) {
                $pel->jumlah_poin = $validated['poin'];
                $pel->save();
            }
        }

        $kasus = Kasus::create([
            'siswa_id' => $validated['siswa_id'],
            'pelanggaran_id' => $pel->id,
            'tanggal' => now()->format('Y-m-d'),
            'status' => 'diproses',
            'catatan' => $validated['catatan'] ?? null,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Kasus berhasil ditambahkan',
            'kasus' => [
                'id' => $kasus->id,
                'siswa_id' => $kasus->siswa_id,
                'nama_siswa' => $kasus->siswa->nama_lengkap,
                'pelanggaran' => $pel->nama_pelanggaran,
                'poin' => $pel->jumlah_poin ?? $validated['poin'],
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

        // Terima update: pelanggaran (string) optional, poin optional, status, catatan
        $validated = $request->validate([
            'pelanggaran' => 'sometimes|string',
            'poin' => 'sometimes|integer|min:0',
            'tanggal' => 'sometimes|date',
            'status' => 'sometimes|in:diproses,selesai',
            'catatan' => 'nullable|string',
        ]);

        // Jika pelanggaran dikirim, temukan atau buat pelanggaran baru
        if (isset($validated['pelanggaran'])) {
            $pelanggaranName = trim($validated['pelanggaran']);
            $pel = Pelanggaran::whereRaw('LOWER(nama_pelanggaran) = ?', [mb_strtolower($pelanggaranName)])->first();

            if (!$pel) {
                $pel = Pelanggaran::create([
                    'nama_pelanggaran' => $pelanggaranName,
                    'jumlah_poin' => $validated['poin'] ?? 0,
                    // default kategori when creating from update endpoint
                    'kategori' => 'lainnya',
                ]);
            } else {
                if (isset($validated['poin']) && $pel->jumlah_poin != $validated['poin']) {
                    $pel->jumlah_poin = $validated['poin'];
                    $pel->save();
                }
            }

            $kasus->pelanggaran_id = $pel->id;
        }

        if (isset($validated['status'])) $kasus->status = $validated['status'];
        if (isset($validated['catatan'])) $kasus->catatan = $validated['catatan'];
        if (isset($validated['tanggal'])) $kasus->tanggal = $validated['tanggal'];

        $kasus->save();

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
