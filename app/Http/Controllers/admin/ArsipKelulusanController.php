<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ArsipKelulusan;

class ArsipKelulusanController extends Controller
{
    public function index()
    {
        $arsip = ArsipKelulusan::all();
        return view('admin.arsip.index', compact('arsip'));
    }

    public function create()
    {
        return view('admin.arsip.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'jurusan' => 'required|string|max:100',
            'tahun_lulus' => 'required|integer|min:2000|max:' . date('Y'),
            'status' => 'required|string|max:50',
        ]);

        ArsipKelulusan::create($request->all());

        return redirect()->route('admin.arsip.index')->with('success', 'Data kelulusan berhasil ditambahkan');
    }

    public function edit($id)
    {
        $arsip = ArsipKelulusan::findOrFail($id);
        return view('admin.arsip.edit', compact('arsip'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'jurusan' => 'required|string|max:100',
            'tahun_lulus' => 'required|integer|min:2000|max:' . date('Y'),
            'status' => 'required|string|max:50',
        ]);

        $arsip = ArsipKelulusan::findOrFail($id);
        $arsip->update($request->all());

        return redirect()->route('admin.arsip.index')->with('success', 'Data kelulusan berhasil diperbarui');
    }

    public function destroy($id)
    {
        $arsip = ArsipKelulusan::findOrFail($id);
        $arsip->delete();

        return redirect()->route('admin.arsip.index')->with('success', 'Data kelulusan berhasil dihapus');
    }
}
