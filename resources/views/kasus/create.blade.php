@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2 class="mb-4 text-primary">➕ Tambah Kasus Siswa</h2>

    <form action="{{ route('kasus.store') }}" method="POST" class="card p-4 shadow-sm border-0">
        @csrf
        <div class="mb-3">
            <label class="form-label">Nama Siswa</label>
            <input type="text" name="nama_siswa" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Kelas</label>
            <input type="text" name="kelas" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Jurusan</label>
            <input type="text" name="jurusan" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Kasus</label>
            <input type="text" name="kasus" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Pelanggaran</label>
            <input type="text" name="pelanggaran" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Poin</label>
            <input type="number" name="poin" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Keterangan</label>
            <textarea name="keterangan" class="form-control"></textarea>
        </div>
        <div class="mb-3">
            <label class="form-label">Penanggung Jawab</label>
            <input type="text" name="penanggung_jawab" class="form-control">
        </div>
        <button type="submit" class="btn btn-success">✅ Simpan</button>
        <a href="{{ route('kasus.index') }}" class="btn btn-secondary">⬅ Kembali</a>
    </form>
</div>
@endsection
