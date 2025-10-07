@extends('layouts.app')

@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Data Kenaikan Kelas</h3>
        <a href="{{ route('kenaikan-kelas.create') }}" class="btn btn-primary float-right">+ Tambah Data</a>
    </div>
    <div class="card-body">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>No</th>
                    <th>NIS</th>
                    <th>Nama Siswa</th>
                    <th>Kelas Lama</th>
                    <th>Kelas Baru</th>
                    <th>Tahun Ajaran</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($kenaikanKelas as $data)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $data->nis }}</td>
                    <td>{{ $data->nama_siswa }}</td>
                    <td>{{ $data->kelas_lama }}</td>
                    <td>{{ $data->kelas_baru }}</td>
                    <td>{{ $data->tahun_ajaran }}</td>
                    <td>
                        <a href="{{ route('kenaikan-kelas.edit', $data->id) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('kenaikan-kelas.destroy', $data->id) }}" method="POST" style="display:inline;">
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