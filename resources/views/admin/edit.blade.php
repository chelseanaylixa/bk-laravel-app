@extends('layouts.app')

@section('content')
<div class="container">
    <h3>Edit Arsip Kelulusan</h3>
    <form action="{{ route('admin.arsip.update', $arsip->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label>Nama</label>
            <input type="text" name="nama" class="form-control" value="{{ $arsip->nama }}" required>
        </div>
        <div class="mb-3">
            <label>Jurusan</label>
            <input type="text" name="jurusan" class="form-control" value="{{ $arsip->jurusan }}" required>
        </div>
        <div class="mb-3">
            <label>Tahun Lulus</label>
            <input type="number" name="tahun_lulus" class="form-control" value="{{ $arsip->tahun_lulus }}" required>
        </div>
        <div class="mb-3">
            <label>Status</label>
            <input type="text" name="status" class="form-control" value="{{ $arsip->status }}" required>
        </div>
        <button type="submit" class="btn btn-success">Update</button>
    </form>
</div>
@endsection
