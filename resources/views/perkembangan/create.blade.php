@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Tambah Perkembangan Siswa</h2>
    <form action="{{ route('perkembangan.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label>Siswa ID</label>
            <input type="number" name="siswa_id" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Tanggal</label>
            <input type="date" name="tanggal" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Aspek</label>
            <input type="text" name="aspek" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Jenis Perkembangan</label>
            <input type="text" name="jenis_perkembangan" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Catatan</label>
            <textarea name="catatan" class="form-control" required></textarea>
        </div>
        <div class="mb-3">
            <label>Penanggung Jawab</label>
            <input type="text" name="penanggung_jawab" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-success">Simpan</button>
    </form>
</div>
@endsection
