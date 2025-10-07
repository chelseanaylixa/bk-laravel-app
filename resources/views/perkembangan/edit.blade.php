@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Edit Perkembangan Siswa</h2>
    <form action="{{ route('perkembangan.update', $perkembangan->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label>Tanggal</label>
            <input type="date" name="tanggal" class="form-control" value="{{ $perkembangan->tanggal }}" required>
        </div>
        <div class="mb-3">
            <label>Aspek</label>
            <input type="text" name="aspek" class="form-control" value="{{ $perkembangan->aspek }}" required>
        </div>
        <div class="mb-3">
            <label>Jenis Perkembangan</label>
            <input type="text" name="jenis_perkembangan" class="form-control" value="{{ $perkembangan->jenis_perkembangan }}" required>
        </div>
        <div class="mb-3">
            <label>Catatan</label>
            <textarea name="catatan" class="form-control" required>{{ $perkembangan->catatan }}</textarea>
        </div>
        <div class="mb-3">
            <label>Penanggung Jawab</label>
            <input type="text" name="penanggung_jawab" class="form-control" value="{{ $perkembangan->penanggung_jawab }}" required>
        </div>
        <button type="submit" class="btn btn-success">Update</button>
    </form>
</div>
@endsection
