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
        $kepsekRole = Role::firstOrCreate(['name' => 'kepala_sekolah']);
        $waliMuridRole = Role::firstOrCreate(['name' => 'wali_murid']);
        $guruMapelRole = Role::firstOrCreate(['name' => 'guru_mapel']);

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
        $admin = User::create([
            'name' => 'Admin Utama',
            'email' => 'admin@smk.sch.id',
            'password' => Hash::make('password123'),
        ]);
        $admin->assignRole($adminRole);
        $admin->update(['role' => $adminRole['name']]);

        $guruBk = User::create([
            'name' => 'Guru BK',
            'email' => 'gurubk@smk.sch.id',
            'password' => Hash::make('password123'),
        ]);
        $guruBk->assignRole($guruBkRole);
        $guruBk->update(['role' => $guruBkRole['name']]);

        $waliKelas = User::create([
            'name' => 'Wali Kelas',
            'email' => 'walikelas@smk.sch.id',
            'password' => Hash::make('password123'),
        ]);
        $waliKelas->assignRole($waliKelasRole);
        $waliKelas->update(['role' => $waliKelasRole['name']]);


        $kepsek = User::create([
            'name' => 'Kepala Sekolah',
            'email' => 'kepsek@smk.sch.id',
            'password' => Hash::make('password123'),
        ]);
        $kepsek->assignRole($kepsekRole);
        $kepsek->update(['role' => $kepsekRole['name']]);


        $waliMurid = User::create([
            'name' => 'Wali Murid',
            'email' => 'walimurid@smk.sch.id',
            'password' => Hash::make('password123'),
        ]);
        $waliMurid->assignRole($waliMuridRole);
        $waliMurid->update(['role' => $waliMuridRole['name']]);


        $guruMapel = User::create([
            'name' => 'Guru Mapel',
            'email' => 'gurumapel@smk.sch.id',
            'password' => Hash::make('password123'),
        ]);
        $guruMapel->assignRole($guruMapelRole);
        $guruMapel->update(['role' => $guruMapelRole['name']]);


        $siswa = User::create([
            'name' => 'Siswa',
            'email' => 'siswa@smk.sch.id',
            'password' => Hash::make('password123'),
            'parent_id' => $waliMurid->id, // relasi ke wali murid
        ]);
        $siswa->assignRole($siswaRole);
        $siswa->update(['role' => $siswaRole['name']]);
    }
}
