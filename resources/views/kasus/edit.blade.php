@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2 class="mb-4 text-warning">✏ Edit Kasus Siswa</h2>

    <form action="{{ route('kasus.update', $kasus->id) }}" method="POST" class="card p-4 shadow-sm border-0">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label class="form-label">Nama Siswa</label>
            <input type="text" name="nama_siswa" class="form-control" value="{{ $kasus->nama_siswa }}" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Kelas</label>
            <input type="text" name="kelas" class="form-control" value="{{ $kasus->kelas }}" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Jurusan</label>
            <input type="text" name="jurusan" class="form-control" value="{{ $kasus->jurusan }}" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Kasus</label>
            <input type="text" name="kasus" class="form-control" value="{{ $kasus->kasus }}" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Pelanggaran</label>
            <input type="text" name="pelanggaran" class="form-control" value="{{ $kasus->pelanggaran }}" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Poin</label>
            <input type="number" name="poin" class="form-control" value="{{ $kasus->poin }}" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Keterangan</label>
            <textarea name="keterangan" class="form-control">{{ $kasus->keterangan }}</textarea>
        </div>
        <div class="mb-3">
            <label class="form-label">Penanggung Jawab</label>
            <input type="text" name="penanggung_jawab" class="form-control" value="{{ $kasus->penanggung_jawab }}">
        </div>
        <button type="submit" class="btn btn-primary">💾 Update</button>
        <a href="{{ route('kasus.index') }}" class="btn btn-secondary">⬅ Kembali</a>
    </form>
</div>
@endsection
