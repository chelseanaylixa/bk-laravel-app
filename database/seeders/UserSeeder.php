<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // --- Buat permissions ---
        $permissions = [
            'view pelanggaran',
            'view poin',
            'view kasus',
            'view jurusan',
            'view curhat-guru',
        ];
        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }

        // --- Buat roles dan kasih permissions ---
        $adminRole = Role::firstOrCreate(['name' => 'admin']);
        $siswaRole = Role::firstOrCreate(['name' => 'siswa']);
        $guruBkRole = Role::firstOrCreate(['name' => 'guru_bk']);
        $waliKelasRole = Role::firstOrCreate(['name' => 'wali_kelas']);
        $waliMuridRole = Role::firstOrCreate(['name' => 'wali_murid']);

        // kasih semua permission ke admin
        $adminRole->syncPermissions($permissions);

        // kasih subset permission ke siswa
        $siswaRole->syncPermissions([
            'view pelanggaran',
            'view poin',
            'view kasus',
            'view jurusan',
            'view curhat-guru',
        ]);

        // --- Buat user dan assign role ---
        $admin = User::firstOrCreate(
            ['email' => 'admin@smk.sch.id'],
            [
                'name' => 'Admin Utama',
                'password' => Hash::make('adminsmk123'),
            ]
        );
        $admin->assignRole($adminRole);
        $admin->update(['role' => $adminRole['name']]);

        $guruBk = User::firstOrCreate(
            ['email' => 'gurubk@smk.sch.id'],
            [
                'name' => 'Guru BK',
                'password' => Hash::make('gurubksmk123'),
            ]
        );
        $guruBk->assignRole($guruBkRole);
        $guruBk->update(['role' => $guruBkRole['name']]);

        $waliKelas = User::firstOrCreate(
            ['email' => 'walikelas@smk.sch.id'],
            [
                'name' => 'Wali Kelas',
                'password' => Hash::make('walikelassmk123'),
            ]
        );
        $waliKelas->assignRole($waliKelasRole);
        $waliKelas->update(['role' => $waliKelasRole['name']]);

        $waliMurid = User::firstOrCreate(
            ['email' => 'walimurid@smk.sch.id'],
            [
                'name' => 'Wali Murid',
                'password' => Hash::make('walimuridsmk123'),
            ]
        );
        $waliMurid->assignRole($waliMuridRole);
        $waliMurid->update(['role' => $waliMuridRole['name']]);


        $siswa = User::firstOrCreate(
            ['email' => 'siswa@smk.sch.id'],
            [
                'name' => 'Siswa',
                'password' => Hash::make('password123'),
                'role' => 'siswa',
            ]
        );
        // Update parent_id jika diperlukan
        if (!$siswa->parent_id) {
            $siswa->update(['parent_id' => $waliMurid->id]);
        }
        $siswa->assignRole($siswaRole);

        // --- Tambahkan semua siswa dari data hardcoded ---
        $studentsList = [
            "ACHMAD DEVANI RIZQY PRATAM",
            "AFRIZAL DANI FERDIANSYAH",
            "AHMAD ZAKY FAZA",
            "ANDHI LUKMAN SYAH TIAHION",
            "BRYAN ANDRIY SHEVCENKO",
            "CATHERINE ABIGAIL APRILLIA CA",
            "CHELSEA NAYLIKA AZKA",
            "DAFFA MAULANA WILAYA",
            "DENICO TUESDY DESMANA",
            "DILAN ALAUDIN AMRU",
            "DIMAS SATRYA IRAWAN",
            "FADHIL SURYA BUANA",
            "FAIS FAISHAL HAKIM",
            "FAREL DWI NUGROHO",
            "FARDAN HABIBI",
            "FATCHUR ROCHMAN",
            "GALANG ARIVIANTO",
            "HANIFA MAULITA ZAHRA SAFFU",
            "KENZA EREND PUTRA TAMA",
            "KHOFIFI AKBAR INDRATAMA",
            "LUBNA AQUILA SALSABIL",
            "M. AZRIEL ANHAR",
            "MARCHELIN EKA FRIANTISA",
            "MAULANA RIDHO RAMADHAN",
            "MOCH. DICKY KURNIAWAN",
            "MOCHAMMAD ALIF RIZKY FADH",
            "MOCHAMMAD FAJRI HARIANTO",
            "MOCHAMMAD VALLEN NUR RIZ",
            "MOH. WIJAYA ANDIKA SAPUTRA",
            "MUHAMAD FATHUL HADI",
            "MUHAMMAD FAIRUZ ZAIDAN",
            "MUHAMMAD IDRIS",
            "MUHAMMAD MIKAIL KAROMAT",
            "MUHAMMAD RAFIUDDIN AL-A",
            "NASRULLAH AL AMIN",
            "NOVAN WAHYU HIDAYAT",
            "NUR AVIVAH MAULID DIAH",
            "QODAMA MAULANA YUSUF",
            "RASSYA RAJA ISLAMI NOVEANSY",
            "RAYHAN ALIF PRATAMA",
            "RENDI SATRIA NUGROHO WICA",
            "RESTU CANDRA NOVIANTO",
            "RONI KURNIASANDY",
            "SATRYA PRAMUDYA ANANDITA"
        ];

        foreach ($studentsList as $index => $studentName) {
            $email = strtolower(str_replace(' ', '.', $studentName)) . '@siswa.smk.sch.id';

            $studentUser = User::firstOrCreate(
                ['email' => $email],
                [
                    'name' => $studentName,
                    'password' => Hash::make('password123'),
                    'role' => 'siswa',
                ]
            );

            $studentUser->assignRole($siswaRole);
        }
    }
}
