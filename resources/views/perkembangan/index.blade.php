@extends('layouts.app')

@section('content')

<div class="container mx-auto p-4 md:p-8">
<div class="bg-white p-8 rounded-2xl shadow-lg w-full max-w-6xl mx-auto">
<h2 class="text-2xl md:text-3xl font-bold text-blue-800 mb-2 text-center">Data Perkembangan Siswa</h2>
<h3 class="text-lg md:text-xl font-semibold text-blue-700 mb-6 text-center">SMK ANTARTIKA 1 SIDOARJO</h3>

    {{-- Hanya Admin & Guru BK yang bisa menambah --}}
    @if(auth()->check() && (auth()->user()->hasRole('admin') || auth()->user()->hasRole('guru_bk')))
        <a href="{{ route('perkembangan.create') }}" class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-500 focus:outline-none focus:border-blue-700 focus:ring focus:ring-blue-200 active:bg-blue-600 disabled:opacity-25 transition mb-4">
            + Tambah Perkembangan
        </a>
    @endif
    
    <div class="overflow-x-auto rounded-lg shadow-md">
        <table class="w-full table-auto border-collapse">
            <thead>
                <tr class="bg-blue-600 text-white uppercase text-sm leading-normal">
                    <th class="py-3 px-6 text-left">No</th>
                    <th class="py-3 px-6 text-left">Nama Siswa</th>
                    <th class="py-3 px-6 text-left">Tanggal</th>
                    <th class="py-3 px-6 text-left">Aspek</th>
                    <th class="py-3 px-6 text-left">Jenis Perkembangan</th>
                    <th class="py-3 px-6 text-left">Catatan</th>
                    <th class="py-3 px-6 text-left">Penanggung Jawab</th>
                    {{-- Hanya Admin & Guru BK yang bisa melihat kolom Aksi --}}
                    @if(auth()->check() && (auth()->user()->hasRole('admin') || auth()->user()->hasRole('guru_bk')))
                        <th class="py-3 px-6 text-center">Aksi</th>
                    @endif
                </tr>
            </thead>
            <tbody class="text-gray-700 text-sm font-light">
                @forelse($perkembangan as $p)
                    <tr class="border-b border-gray-200 hover:bg-blue-50">
                        <td class="py-3 px-6 text-left">{{ $loop->iteration }}</td>
                        <td class="py-3 px-6 text-left">{{ $p->siswa->nama ?? 'Tidak ada data' }}</td>
                        <td class="py-3 px-6 text-left">{{ $p->tanggal }}</td>
                        <td class="py-3 px-6 text-left">{{ $p->aspek }}</td>
                        <td class="py-3 px-6 text-left">{{ $p->jenis_perkembangan }}</td>
                        <td class="py-3 px-6 text-left">{{ $p->catatan }}</td>
                        <td class="py-3 px-6 text-left">{{ $p->penanggung_jawab }}</td>
                        
                        @if(auth()->check() && (auth()->user()->hasRole('admin') || auth()->user()->hasRole('guru_bk')))
                            <td class="py-3 px-6 text-center">
                                <a href="{{ route('perkembangan.edit', $p->id) }}" class="bg-yellow-500 text-white px-3 py-1 rounded-md hover:bg-yellow-600 transition-colors mr-2">Edit</a>
                                <form action="{{ route('perkembangan.destroy', $p->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus data ini?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="bg-red-500 text-white px-3 py-1 rounded-md hover:bg-red-600 transition-colors">Hapus</button>
                                </form>
                            </td>
                        @endif
                    </tr>
                @empty
                    <tr class="border-b border-gray-200 hover:bg-blue-50">
                        <td colspan="8" class="py-3 px-6 text-center">Belum ada data perkembangan siswa.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <a href="{{ route('dashboard') }}" class="inline-flex items-center px-4 py-2 bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-gray-800 uppercase tracking-widest hover:bg-gray-300 focus:outline-none focus:border-gray-400 focus:ring focus:ring-gray-200 active:bg-gray-200 disabled:opacity-25 transition mt-4">
        ⬅ Kembali ke Dashboard
    </a>
</div>

</div>
@endsection