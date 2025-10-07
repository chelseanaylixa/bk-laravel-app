@extends('layouts.app')

@section('content')
<div class="container">
    <h3>Manajemen Arsip Kelulusan</h3>
    <a href="{{ route('admin.arsip.create') }}" class="btn btn-primary mb-3">Tambah Arsip</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Nama</th>
                <th>Jurusan</th>
                <th>Tahun Lulus</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($arsip as $siswa)
                <tr>
                    <td>{{ $siswa->nama }}</td>
                    <td>{{ $siswa->jurusan }}</td>
                    <td>{{ $siswa->tahun_lulus }}</td>
                    <td>{{ $siswa->status }}</td>
                    <td>
                        <a href="{{ route('admin.arsip.edit', $siswa->id) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('admin.arsip.destroy', $siswa->id) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-sm" onclick="return confirm('Hapus data ini?')">Hapus</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
