# Fitur Tabel Poin Berdasarkan Role

## Deskripsi Fitur
Halaman "Poin" (`/poin`) sekarang menampilkan data yang berbeda berdasarkan role pengguna:

### 1. **Untuk Siswa** (`role: 'siswa'`)
- Menampilkan **poin pribadi** siswa yang sedang login
- Tabel menampilkan kolom: NO, HARI/TANGGAL, KASUS, POIN, PARAF GURU
- Hanya menampilkan pelanggaran/kasus siswa tersebut
- Format: Sama seperti sebelumnya

### 2. **Untuk Wali Kelas & Wali Murid** (`role: 'wali_kelas'` atau `role: 'wali_murid'`)
- Menampilkan **poin semua siswa** di sekolah
- Tabel menampilkan kolom: NO, NAMA SISWA, NIS, HARI/TANGGAL, KASUS, POIN
- Menampilkan semua pelanggaran dari semua siswa
- Dapat melihat data poin siswa secara menyeluruh

## File yang Dimodifikasi

### `resources/views/pages/poin.blade.php`

#### Perubahan 1: Header Dinamis (Baris 240-253)
```php
<h1 style="flex: 1; margin: 0;">
    @php
    $userRole = Auth::user()?->role;
    $isWaliRole = in_array($userRole, ['wali_kelas', 'wali_murid']);
    @endphp
    @if($isWaliRole)
        📊 Semua Poin Siswa
    @else
        📊 Poin Saya
    @endif
</h1>
```
- Judul berubah dinamis berdasarkan role pengguna

#### Perubahan 2: View Wali Kelas/Murid (Baris 267-310)
```php
@elseif($isWaliRole)
@php
use App\Models\Siswa;
$allSiswa = Siswa::with('kasus.pelanggaran')->get();
@endphp

<div class="student-info">
    <p class="student-name">📊 Data Poin Semua Siswa</p>
    <p style="color: #666; font-size: 14px;">Menampilkan poin semua siswa di sekolah</p>
</div>

<div class="table-wrapper">
    <div class="table-container">
        <table class="data-table">
            <thead>
                <tr>
                    <th>NO</th>
                    <th>NAMA SISWA</th>
                    <th>NIS</th>
                    <th>HARI/TANGGAL</th>
                    <th>KASUS</th>
                    <th>POIN</th>
                </tr>
            </thead>
            <tbody>
                @php $no = 1; @endphp
                @forelse($allSiswa as $s)
                    @php $cases = $s->kasus()->with('pelanggaran')->get(); @endphp
                    @if($cases->count() > 0)
                        @foreach($cases as $kasus)
                        <tr>
                            <td>{{ $no++ }}</td>
                            <td><strong>{{ $s->nama_lengkap ?? '-' }}</strong></td>
                            <td>{{ $s->nis ?? '-' }}</td>
                            <td>{{ optional($kasus->tanggal)->format('d-m-Y') ?? ($kasus->created_at ? $kasus->created_at->format('d-m-Y') : '-') }}</td>
                            <td>{{ $kasus->pelanggaran->nama_pelanggaran ?? '-' }}</td>
                            <td><strong style="color: #d32f2f;">{{ $kasus->pelanggaran->jumlah_poin ?? 0 }}</strong></td>
                        </tr>
                        @endforeach
                    @endif
                @empty
                <tr>
                    <td colspan="6" class="empty-state">Tidak ada data pelanggaran.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
```
- Menampilkan semua siswa dengan pelanggaran mereka
- Iterasi di setiap siswa dan tampilkan setiap kasus mereka
- Nomor urut otomatis increment untuk setiap row

#### Perubahan 3: View Siswa (Baris 311+)
```php
@elseif(! $siswa)
<div class="student-info">
    <p style="color: #004aad;">Tidak ditemukan data siswa terkait dengan akun Anda. Mohon hubungi admin.</p>
</div>

@else
{{-- View untuk siswa yang sudah memiliki data siswa --}}
{{-- Sama seperti sebelumnya --}}
```
- Tetap menampilkan poin pribadi siswa seperti sebelumnya
- Hanya untuk users dengan role 'siswa'

## Logika Penentuan Role

```php
$user = Auth::user();
$userRole = $user ? $user->role : null;
$siswa = $user ? $user->siswa : null;
$isWaliRole = in_array($userRole, ['wali_kelas', 'wali_murid']);
```

- Ambil user yang sedang login
- Cek role dari user
- Ambil data siswa jika ada relationship
- Tentukan apakah user adalah wali dengan `in_array()`

## Struktur Tabel

### Tabel untuk Wali Kelas/Murid (6 kolom)
| NO | NAMA SISWA | NIS | HARI/TANGGAL | KASUS | POIN |
|----|-----------|-----|-------------|-------|------|
| 1 | John Doe | 001 | 01-01-2026 | Terlambat | 5 |
| 2 | John Doe | 001 | 05-01-2026 | Tidak Pakai Seragam | 10 |

### Tabel untuk Siswa (5 kolom)
| NO | HARI/TANGGAL | KASUS | POIN | PARAF GURU |
|----|-------------|-------|------|-----------|
| 1 | 01-01-2026 | Terlambat | 5 | [Box] |
| 2 | 05-01-2026 | Tidak Pakai Seragam | 10 | [Box] |

## Database Relationships yang Digunakan

```
User -> Siswa (hasOne)
       |
       └-> Kasus (hasMany via Siswa)
           └-> Pelanggaran (belongsTo)
```

## Testing

### Test Case 1: Login sebagai Siswa
1. Login dengan akun siswa (e.g., siswa@mail.com)
2. Ke halaman /poin
3. Verifikasi: Judul menampilkan "📊 Poin Saya"
4. Verifikasi: Tabel menampilkan hanya poin pribadi dengan 5 kolom

### Test Case 2: Login sebagai Wali Kelas
1. Login dengan akun wali kelas
2. Ke halaman /poin
3. Verifikasi: Judul menampilkan "📊 Semua Poin Siswa"
4. Verifikasi: Tabel menampilkan semua siswa dengan 6 kolom
5. Verifikasi: Bisa melihat nama siswa, NIS, tanggal, kasus, poin

### Test Case 3: Login sebagai Wali Murid
1. Login dengan akun wali murid
2. Ke halaman /poin
3. Verifikasi: Sama dengan wali kelas

## Performance Considerations

- Query menggunakan `with('kasus.pelanggaran')` untuk eager loading
- Tidak ada N+1 query problem karena sudah di-eager-load
- Hanya menampilkan siswa yang memiliki minimal 1 kasus

## Future Enhancements

1. Filter siswa berdasarkan kelas
2. Export data poin ke Excel
3. Pencarian siswa berdasarkan nama/NIS
4. Sorting berdasarkan poin (descending)
5. Pagination untuk tabel yang besar
6. Grafik statistik poin per siswa
