@extends('layouts.app')

@section('content')
<div class="container">
    <h3>Tambah Arsip Kelulusan</h3>
    <form action="{{ route('admin.arsip.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label>Nama</label>
            <input type="text" name="nama" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Jurusan</label>
            <input type="text" name="jurusan" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Tahun Lulus</label>
            <input type="number" name="tahun_lulus" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Status</label>
            <input type="text" name="status" class="form-control" value="Lulus" required>
        </div>
        <button type="submit" class="btn btn-success">Simpan</button>
    </form>
</div>
@endsection
