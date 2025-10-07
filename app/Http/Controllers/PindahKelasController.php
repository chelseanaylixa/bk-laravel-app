<?php

namespace App\Http\Controllers;

use App\Models\PindahKelas;
use Illuminate\Http\Request;

class PindahKelasController extends Controller
{
    public function index()
    {
        $pindahKelas = PindahKelas::all();
        return view('pindah-kelas.index', compact('pindahKelas'));
    }

    public function create()
    {
        return view('pindah-kelas.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nis' => 'required|string|max:255',
            'nama_siswa' => 'required|string|max:255',
            'kelas_asal' => 'required|string|max:50',
            'kelas_tujuan' => 'required|string|max:50',
            'tanggal_pindah' => 'required|date',
            'keterangan' => 'nullable|string',
        ]);

        PindahKelas::create($validatedData);

        return redirect()->route('pindah-kelas.index')->with('success', 'Data pindah kelas berhasil ditambahkan.');
    }

    public function show(PindahKelas $pindahKelas)
    {
        return view('pindah-kelas.show', compact('pindahKelas'));
    }

    public function edit(PindahKelas $pindahKelas)
    {
        return view('pindah-kelas.edit', compact('pindahKelas'));
    }

    public function update(Request $request, PindahKelas $pindahKelas)
    {
        $validatedData = $request->validate([
            'nis' => 'required|string|max:255',
            'nama_siswa' => 'required|string|max:255',
            'kelas_asal' => 'required|string|max:50',
            'kelas_tujuan' => 'required|string|max:50',
            'tanggal_pindah' => 'required|date',
            'keterangan' => 'nullable|string',
        ]);

        $pindahKelas->update($validatedData);

        return redirect()->route('pindah-kelas.index')->with('success', 'Data pindah kelas berhasil diperbarui.');
    }

    public function destroy(PindahKelas $pindahKelas)
    {
        $pindahKelas->delete();
        return redirect()->route('pindah-kelas.index')->with('success', 'Data pindah kelas berhasil dihapus.');
    }
}