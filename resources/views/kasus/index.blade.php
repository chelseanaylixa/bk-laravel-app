@extends('layouts.app')

@section('title', 'Manajemen Data BK')

@section('content')
<style>
    body {
        background-color: #e3f2fd;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    /* Card */
    .card {
        border-radius: 15px;
        box-shadow: 0 6px 12px rgba(0,0,0,0.15);
        margin-bottom: 2rem;
    }

    .card-header {
        background: linear-gradient(90deg, #0d47a1, #1976d2);
        color: #fff;
        font-weight: bold;
        padding: 1rem 1.5rem;
    }

    /* Tabel */
    .table {
        margin-bottom: 0;
    }

    .table thead th {
        background-color: #1565c0;
        color: #fff;
        text-transform: uppercase;
    }

    .table-hover tbody tr:hover {
        background-color: #bbdefb;
        transition: 0.2s;
    }

    .badge-point {
        background: #ff1744;
        padding: 0.4em 0.8em;
        border-radius: 10px;
        font-size: 0.85rem;
    }

    /* Tombol */
    .btn-action {
        border-radius: 12px;
        padding: 0.25rem 0.75rem;
        font-size: 0.85rem;
        transition: 0.3s;
    }
    .btn-action:hover {
        transform: scale(1.05);
    }

    .btn-primary {
        background-color: #1976d2;
        border-color: #1976d2;
    }
    .btn-warning {
        background-color: #ff9800;
        border-color: #ff9800;
        color: #fff;
    }
    .btn-danger {
        background-color: #d32f2f;
        border-color: #d32f2f;
        color: #fff;
    }
    .btn-success {
        background-color: #2e7d32;
        border-color: #2e7d32;
        color: #fff;
    }
</style>

<div class="container-fluid">

    {{-- ================= Data Kasus Siswa ================= --}}
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5>📘 Data Kasus Siswa</h5>
            @if(Auth::user()->role == 'admin' || Auth::user()->role == 'guru_bk')
                <a href="{{ route('kasus.create') }}" class="btn btn-light btn-sm">+ Tambah Kasus</a>
            @endif
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-striped table-hover text-center align-middle">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Kelas</th>
                            <th>Jurusan</th>
                            <th>Pelanggaran</th>
                            <th>Poin</th>
                            <th>Penanggung Jawab</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($kasus as $index => $k)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $k->nama_siswa }}</td>
                            <td>{{ $k->kelas }}</td>
                            <td>{{ $k->jurusan }}</td>
                            <td>{{ $k->pelanggaran }}</td>
                            <td><span class="badge-point">{{ $k->poin }}</span></td>
                            <td>{{ $k->penanggung_jawab }}</td>
                            <td>
                                <a href="{{ route('kasus.edit', $k->id) }}" class="btn btn-warning btn-sm btn-action">✏ Edit</a>
                                <form action="{{ route('kasus.destroy', $k->id) }}" method="POST" class="d-inline">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm btn-action" onclick="return confirm('Yakin ingin hapus?')">🗑 Hapus</button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr><td colspan="8">Belum ada data kasus</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    {{-- ================= Arsip Kelulusan ================= --}}
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5>🎓 Arsip Kelulusan</h5>
            <a href="#" class="btn btn-light btn-sm">+ Tambah Arsip</a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover text-center align-middle">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Siswa</th>
                            <th>Tahun Lulus</th>
                            <th>Jurusan</th>
                            <th>Keterangan</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        {{-- Contoh Dummy Data --}}
                        <tr>
                            <td>1</td>
                            <td>Ahmad Fauzi</td>
                            <td>2024</td>
                            <td>RPL</td>
                            <td>Lulus dengan nilai baik</td>
                            <td>
                                <a href="#" class="btn btn-warning btn-sm btn-action">✏ Edit</a>
                                <a href="#" class="btn btn-danger btn-sm btn-action">🗑 Hapus</a>
                            </td>
                        </tr>
                        <tr><td colspan="6">Data arsip kelulusan belum ada</td></tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    {{-- ================= Perkembangan Siswa ================= --}}
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5>📈 Perkembangan Siswa</h5>
            <a href="#" class="btn btn-light btn-sm">+ Tambah Data</a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover text-center align-middle">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Siswa</th>
                            <th>Kelas</th>
                            <th>Aspek</th>
                            <th>Catatan</th>
                            <th>Penanggung Jawab</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        {{-- Contoh Dummy Data --}}
                        <tr>
                            <td>1</td>
                            <td>Siti Rahma</td>
                            <td>XII RPL</td>
                            <td>Disiplin</td>
                            <td>Sudah menunjukkan perbaikan</td>
                            <td>B. Eka</td>
                            <td>
                                <a href="#" class="btn btn-warning btn-sm btn-action">✏ Edit</a>
                                <a href="#" class="btn btn-danger btn-sm btn-action">🗑 Hapus</a>
                            </td>
                        </tr>
                        <tr><td colspan="7">Data perkembangan belum ada</td></tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>
@endsection
