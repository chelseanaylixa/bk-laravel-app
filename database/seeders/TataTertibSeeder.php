<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\TataTertib;

class TataTertibSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            ['kategori' => 'Kedisiplinan', 'jenis_pelanggaran' => 'Terlambat datang ke sekolah (>15 menit)', 'sanksi' => 'Dicatat di buku piket, poin pelanggaran, membersihkan lingkungan sekolah.'],
            ['kategori' => 'Kedisiplinan', 'jenis_pelanggaran' => 'Tidak masuk tanpa keterangan (Alpa)', 'sanksi' => 'Pemberitahuan ke orang tua, Surat Peringatan (SP) jika berulang.'],
            ['kategori' => 'Kedisiplinan', 'jenis_pelanggaran' => 'Bolos pada jam pelajaran tertentu', 'sanksi' => 'Panggilan orang tua, skorsing 1-3 hari.'],
            ['kategori' => 'Kerapian', 'jenis_pelanggaran' => 'Seragam tidak sesuai ketentuan', 'sanksi' => 'Peringatan lisan, atribut disita.'],
            ['kategori' => 'Kerapian', 'jenis_pelanggaran' => 'Rambut gondrong (Pria)', 'sanksi' => 'Dipotong paksa di sekolah oleh guru BK.'],
            ['kategori' => 'Etika', 'jenis_pelanggaran' => 'Merokok di lingkungan sekolah', 'sanksi' => 'Skorsing 3-7 hari, panggilan orang tua.'],
            ['kategori' => 'Etika', 'jenis_pelanggaran' => 'Berkelahi / Memicu keributan', 'sanksi' => 'Skorsing, dikembalikan ke orang tua (DO) jika berat.'],
            ['kategori' => 'PELANGGARAN BERAT', 'jenis_pelanggaran' => 'Membawa Sajam, Miras, Narkoba', 'sanksi' => 'Di keluarkan dari sekolah dan diserahkan ke pihak berwajib.'],
        ];

        foreach ($data as $item) {
            TataTertib::create($item);
        }
    }
}