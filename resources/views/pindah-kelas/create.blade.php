@extends('layouts.app')

@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Tambah Data Pindah Kelas</h3>
        <style>
body {
    background-color: #f0f2f5;
    font-family: Arial, sans-serif;
}
.card {
    background-color: #fff;
    border-radius: 8px;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    margin-top: 20px;
}
.card-header {
    background-color: #3498db;
    color: #fff;
    padding: 15px;
    border-top-left-radius: 8px;
    border-top-right-radius: 8px;
    display: flex;
    justify-content: space-between;
    align-items: center;
}
.card-title {
    margin: 0;
    font-size: 1.25rem;
}
.table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 20px;
}
.table th, .table td {
    padding: 12px 15px;
    text-align: left;
    border-bottom: 1px solid #ddd;
}
.table thead th {
    background-color: #3498db;
    color: #fff;
}
.table tbody tr:nth-child(even) {
    background-color: #f2f7fb;
}
.table tbody tr:hover {
    background-color: #e2f0ff;
}
.btn {
    padding: 8px 12px;
    border-radius: 5px;
    text-decoration: none;
    color: #fff;
    border: none;
    cursor: pointer;
}
.btn-primary {
    background-color: #2980b9;
}
.btn-warning {
    background-color: #f39c12;
}
.btn-danger {
    background-color: #e74c3c;
}
.btn-sm {
    padding: 5px 10px;
    font-size: 0.8rem;
}
.float-right {
    float: right;
}
.form-group {
    margin-bottom: 15px;
}
.form-control {
    width: 100%;
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 5px;
    box-sizing: border-box;
}
</style>
    </div>
    
    <div class="card-body">
        <form action="{{ route('pindah-kelas.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="nis">NIS</label>
                <input type="text" name="nis" id="nis" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="nama_siswa">Nama Siswa</label>
                <input type="text" name="nama_siswa" id="nama_siswa" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="kelas_asal">Kelas Asal</label>
                <input type="text" name="kelas_asal" id="kelas_asal" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="kelas_tujuan">Kelas Tujuan</label>
                <input type="text" name="kelas_tujuan" id="kelas_tujuan" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="tanggal_pindah">Tanggal Pindah</label>
                <input type="date" name="tanggal_pindah" id="tanggal_pindah" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="keterangan">Keterangan</label>
                <textarea name="keterangan" id="keterangan" class="form-control"></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Simpan</button>
            <a href="{{ route('pindah-kelas.index') }}" class="btn btn-secondary">Batal</a>
        </form>
    </div>
</div>
@endsection