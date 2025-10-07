@extends('layouts.app')

@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Arsip Kelulusan</h3>
        <a href="{{ route('arsip-kelulusan.create') }}" class="btn btn-primary float-right">+ Tambah Data</a>
    </div>
    <div class="card-body">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>No</th>
                    <th>NIS</th>
                    <th>Nama Siswa</th>
                    <th>Kelas</th>
                    <th>Tahun Lulus</th>
                    <th>Keterangan</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($arsipKelulusan as $arsip)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $arsip->nis }}</td>
                    <td>{{ $arsip->nama_siswa }}</td>
                    <td>{{ $arsip->kelas }}</td>
                    <td>{{ $arsip->tahun_lulus }}</td>
                    <td>{{ $arsip->keterangan }}</td>
                    <td>
                        <a href="{{ route('arsip-kelulusan.edit', $arsip->id) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('arsip-kelulusan.destroy', $arsip->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">Hapus</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection