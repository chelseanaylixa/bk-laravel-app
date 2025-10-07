<?php

namespace App\Http\Controllers;

use App\Models\Kasus;
use Illuminate\Http\Request;

class KasusController extends Controller
{
    /**
     * Menampilkan semua data kasus
     */
    public function index()
    {
        $kasus = Kasus::all();
        return view('kasus.index', compact('kasus'));
    }

    /**
     * Form tambah kasus
     */
    public function create()
    {
        return view('kasus.create');
    }

    /**
     * Simpan kasus baru
     */
    public function store(Request $request)
    {
        // Validasi data yang masuk
        $validatedData = $request->validate([
            'nama_siswa' => 'required|string|max:255',
            'kelas' => 'required|string|max:50',
            'jurusan' => 'required|string|max:100',
            'pelanggaran' => 'required|string|max:255',
            'poin' => 'required|integer',
            'penanggung_jawab' => 'required|string|max:255',
        ]);

        // Gunakan data yang sudah divalidasi untuk membuat record baru
        Kasus::create($validatedData);

        return redirect()->route('kasus.index')->with('success', 'Kasus berhasil ditambahkan.');
    }

    /**
     * Form edit kasus
     */
    public function edit(Kasus $kasus)
    {
        return view('kasus.edit', compact('kasus'));
    }

    /**
     * Update kasus
     */
    public function update(Request $request, Kasus $kasus)
    {
        // Validasi data yang masuk
        $validatedData = $request->validate([
            'nama_siswa' => 'required|string|max:255',
            'kelas' => 'required|string|max:50',
            'jurusan' => 'required|string|max:100',
            'pelanggaran' => 'required|string|max:255',
            'poin' => 'required|integer',
            'penanggung_jawab' => 'required|string|max:255',
        ]);

        // Gunakan data yang sudah divalidasi untuk memperbarui record
        $kasus->update($validatedData);

        return redirect()->route('kasus.index')->with('success', 'Kasus berhasil diperbarui.');
    }

    /**
     * Hapus kasus
     */
    public function destroy(Kasus $kasus)
    {
        $kasus->delete();
        return redirect()->route('kasus.index')->with('success', 'Kasus berhasil dihapus.');
    }
}