@extends('layouts.app')

@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Data Pindah Kelas</h3>
        <a href="{{ route('pindah-kelas.create') }}" class="btn btn-primary float-right">+ Tambah Data</a>
    </div>
    <div class="card-body">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>No</th>
                    <th>NIS</th>
                    <th>Nama Siswa</th>
                    <th>Kelas Asal</th>
                    <th>Kelas Tujuan</th>
                    <th>Tanggal Pindah</th>
                    <th>Keterangan</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($pindahKelas as $data)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $data->nis }}</td>
                    <td>{{ $data->nama_siswa }}</td>
                    <td>{{ $data->kelas_asal }}</td>
                    <td>{{ $data->kelas_tujuan }}</td>
                    <td>{{ $data->tanggal_pindah }}</td>
                    <td>{{ $data->keterangan }}</td>
                    <td>
                        <a href="{{ route('pindah-kelas.edit', $data->id) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('pindah-kelas.destroy', $data->id) }}" method="POST" style="display:inline;">
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