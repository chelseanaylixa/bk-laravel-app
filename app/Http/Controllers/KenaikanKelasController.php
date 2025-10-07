<?php

namespace App\Http\Controllers;

use App\Models\KenaikanKelas;
use Illuminate\Http\Request;

class KenaikanKelasController extends Controller
{
    /**
     * Menampilkan daftar semua data kenaikan kelas.
     */
    public function index()
    {
        $kenaikanKelas = KenaikanKelas::all();
        return view('kenaikan-kelas.index', compact('kenaikanKelas'));
    }

    /**
     * Menampilkan formulir untuk menambah data kenaikan kelas baru.
     */
    public function create()
    {
        return view('kenaikan-kelas.create');
    }

    /**
     * Menyimpan data kenaikan kelas yang baru ke database.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nis' => 'required|string|max:255',
            'nama_siswa' => 'required|string|max:255',
            'kelas_lama' => 'required|string|max:50',
            'kelas_baru' => 'required|string|max:50',
            'tahun_ajaran' => 'required|string|max:100',
        ]);

        KenaikanKelas::create($validatedData);

        return redirect()->route('kenaikan-kelas.index')->with('success', 'Data kenaikan kelas berhasil ditambahkan.');
    }

    /**
     * Menampilkan detail data kenaikan kelas tertentu.
     */
    public function show(KenaikanKelas $kenaikanKelas)
    {
        return view('kenaikan-kelas.show', compact('kenaikanKelas'));
    }

    /**
     * Menampilkan formulir untuk mengedit data kenaikan kelas.
     */
    public function edit(KenaikanKelas $kenaikanKelas)
    {
        return view('kenaikan-kelas.edit', compact('kenaikanKelas'));
    }

    /**
     * Memperbarui data kenaikan kelas di database.
     */
    public function update(Request $request, KenaikanKelas $kenaikanKelas)
    {
        $validatedData = $request->validate([
            'nis' => 'required|string|max:255',
            'nama_siswa' => 'required|string|max:255',
            'kelas_lama' => 'required|string|max:50',
            'kelas_baru' => 'required|string|max:50',
            'tahun_ajaran' => 'required|string|max:100',
        ]);

        $kenaikanKelas->update($validatedData);

        return redirect()->route('kenaikan-kelas.index')->with('success', 'Data kenaikan kelas berhasil diperbarui.');
    }

    /**
     * Menghapus data kenaikan kelas dari database.
     */
    public function destroy(KenaikanKelas $kenaikanKelas)
    {
        $kenaikanKelas->delete();
        return redirect()->route('kenaikan-kelas.index')->with('success', 'Data kenaikan kelas berhasil dihapus.');
    }
}