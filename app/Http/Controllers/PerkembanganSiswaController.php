<?php

namespace App\Http\Controllers;

use App\Models\PerkembanganSiswa;
use Illuminate\Http\Request;

class PerkembanganSiswaController extends Controller
{
    /**
     * Menampilkan semua data perkembangan siswa.
     */
    public function index()
    {
        $perkembangan = PerkembanganSiswa::with('siswa')->get();
        return view('perkembangan.index', compact('perkembangan'));
    }

    /**
     * Menampilkan form untuk menambah data perkembangan siswa baru.
     */
    public function create()
    {
        // Anda mungkin perlu mengirimkan data siswa atau guru ke view
        // $siswa = Siswa::all();
        // $guru = Guru::all();
        // return view('perkembangan.create', compact('siswa', 'guru'));
        return view('perkembangan.create');
    }

    /**
     * Menyimpan data perkembangan siswa yang baru.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'siswa_id' => 'required|exists:siswas,id',
            'catatan' => 'required|string',
            'penanggung_jawab' => 'required|string',
        ]);

        PerkembanganSiswa::create($validatedData);

        return redirect()->route('perkembangan.index')->with('success', 'Data perkembangan siswa berhasil ditambahkan.');
    }

    /**
     * Menampilkan form untuk mengedit data perkembangan siswa.
     */
    public function edit(PerkembanganSiswa $perkembangan)
    {
        // Anda mungkin perlu mengirimkan data siswa atau guru ke view
        // $siswa = Siswa::all();
        // $guru = Guru::all();
        // return view('perkembangan.edit', compact('perkembangan', 'siswa', 'guru'));
        return view('perkembangan.edit', compact('perkembangan'));
    }

    /**
     * Memperbarui data perkembangan siswa.
     */
    public function update(Request $request, PerkembanganSiswa $perkembangan)
    {
        $validatedData = $request->validate([
            'siswa_id' => 'required|exists:siswas,id',
            'catatan' => 'required|string',
            'penanggung_jawab' => 'required|string',
        ]);

        $perkembangan->update($validatedData);

        return redirect()->route('perkembangan.index')->with('success', 'Data perkembangan siswa berhasil diperbarui.');
    }

    /**
     * Menghapus data perkembangan siswa.
     */
    public function destroy(PerkembanganSiswa $perkembangan)
    {
        $perkembangan->delete();
        return redirect()->route('perkembangan.index')->with('success', 'Data perkembangan siswa berhasil dihapus.');
    }
}