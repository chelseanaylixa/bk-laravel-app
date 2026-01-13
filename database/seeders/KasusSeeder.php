<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KasusSeeder extends Seeder
{
    public function run(): void
    {
        // Get all siswa
        $siswaList = DB::table('siswa')->pluck('id')->toArray();
        $pelanggaranList = DB::table('pelanggaran')->pluck('id')->toArray();

        if (empty($siswaList) || empty($pelanggaranList)) {
            echo "Error: Siswa atau Pelanggaran table kosong. Jalankan seeder untuk kedua table terlebih dahulu.\n";
            return;
        }

        // Create sample kasus
        $kasus = [
            [
                'siswa_id' => $siswaList[0],
                'pelanggaran_id' => $pelanggaranList[0],
                'tanggal' => now()->subDays(5)->toDateString(),
                'status' => 'selesai',
                'catatan' => 'Siswa sudah diminta untuk tidak terlambat lagi',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'siswa_id' => $siswaList[0],
                'pelanggaran_id' => $pelanggaranList[2],
                'tanggal' => now()->subDays(3)->toDateString(),
                'status' => 'selesai',
                'catatan' => 'Siswa telah mengumpulkan PR yang tertinggal',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'siswa_id' => $siswaList[1] ?? $siswaList[0],
                'pelanggaran_id' => $pelanggaranList[3],
                'tanggal' => now()->subDays(2)->toDateString(),
                'status' => 'diproses',
                'catatan' => 'Sedang diperingatkan',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'siswa_id' => $siswaList[2] ?? $siswaList[0],
                'pelanggaran_id' => $pelanggaranList[6],
                'tanggal' => now()->toDateString(),
                'status' => 'diproses',
                'catatan' => 'Kasus baru, sedang ditangani guru BK',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        foreach ($kasus as $item) {
            DB::table('kasus')->insert($item);
        }
    }
}
