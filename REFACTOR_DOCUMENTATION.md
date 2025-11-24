# Refactor Kasus Management - Database Integration

## Overview
Refactor untuk mengubah sistem manajemen kasus dari **hardcoded data** menjadi sistem berbasis **database** dengan relasi yang proper antar tabel.

## Kriteria Refactor

### 1. ✅ Data Siswa ke Seeder dengan Role Siswa
- Semua data siswa (43 siswa) dipindahkan ke `database/seeders/UserSeeder.php`
- Email siswa: `nama.siswa@siswa.smk.sch.id` (lowercase, spasi diganti titik)
- Role: `siswa`
- Default password: `password123`

### 2. ✅ Struktur Tabel Users
```sql
Schema::create('users', function (Blueprint $table) {
    $table->id();
    $table->string('name');
    $table->string('email')->unique();
    $table->string('password');
    $table->enum('role', ['admin', 'guru_bk', 'wali_kelas', 'kepala_sekolah', 'siswa', 'wali_murid', 'guru_mapel'])->default('siswa');
    $table->unsignedBigInteger('parent_id')->nullable();
    $table->rememberToken();
    $table->timestamps();
});
```

### 3. ✅ Tabel Kasus dengan Foreign Keys
```sql
Schema::create('kasus', function (Blueprint $table) {
    $table->id();
    $table->unsignedBigInteger('siswa_id');
    $table->unsignedBigInteger('guru_id')->nullable();
    $table->string('pelanggaran');
    $table->integer('poin');
    $table->text('catatan')->nullable();
    $table->timestamps();
    
    $table->foreign('siswa_id')->references('id')->on('users')->onDelete('cascade');
    $table->foreign('guru_id')->references('id')->on('users')->onDelete('set null');
});
```

### 4. ✅ Model Relationships
- **User model**: 
  - `kasus()` - HasMany relationship untuk kasus siswa
  - `kasusAsGuru()` - HasMany relationship untuk kasus yang dicatat guru
  - `getTotalPoin()` - Method untuk mendapatkan total poin siswa

- **Kasus model**:
  - `siswa()` - BelongsTo User (siswa)
  - `guru()` - BelongsTo User (guru pembuat kasus)
  - `getTotalPoinBySiswa()` - Static method
  - `getKasusBySiswa()` - Static method

### 5. ✅ API Endpoints (Protected dengan auth:sanctum)
```
GET    /api/siswa-list           - Get all siswa with poin summary
GET    /api/kasus                - Get all kasus
GET    /api/kasus/siswa/{id}     - Get kasus for specific siswa
POST   /api/kasus                - Create new kasus
PUT    /api/kasus/{id}           - Update kasus
DELETE /api/kasus/{id}           - Delete kasus
```

### 6. ✅ Frontend AJAX Integration
- Semua data sekarang di-fetch dari API menggunakan `fetch()`
- Form submission menggunakan AJAX (tidak page reload)
- Automatic data refresh setelah create/update/delete
- Error handling dengan alert() untuk user feedback

## Setup Instructions

### Step 1: Install Dependencies
```bash
composer install
npm install
npm run build
```

### Step 2: Run Migrations
```bash
php artisan migrate
# atau jika ingin reset:
php artisan migrate:fresh --seed
```

### Step 3: Run Seeders
Seeders akan otomatis berjalan jika menggunakan `migrate:fresh --seed`, atau jalankan manual:
```bash
php artisan db:seed --class=UserSeeder
```

### Step 4: Start Development Server
```bash
php artisan serve
```

### Step 5: Verify Data
Login dengan credentials:
- **Admin**: email: `admin@smk.sch.id`, password: `password123`
- **Guru BK**: email: `gurubk@smk.sch.id`, password: `password123`
- **Siswa**: Pilih salah satu dari 43 siswa (gunakan email yang sudah di-generate)

## File Changes Summary

### Files Created
- `app/Http/Controllers/KasusApiController.php` - API controller untuk kasus

### Files Modified
- `database/migrations/2025_09_23_104145_create_kasus_table.php` - Updated schema
- `database/seeders/UserSeeder.php` - Added 43 siswa
- `app/Models/Kasus.php` - Added relationships & methods
- `app/Models/User.php` - Added relationships & methods
- `routes/api.php` - Added API routes
- `resources/views/kasus/index.blade.php` - Refactored JavaScript untuk AJAX

## How It Works

### Admin/Guru BK Workflow
1. Admin/Guru BK login ke dashboard
2. Lihat tabel "Daftar Siswa & Total Poin"
3. Klik button "Tambah Kasus" untuk siswa tertentu
4. Fill form: Pelanggaran, Poin
5. Submit form → AJAX POST ke `/api/kasus`
6. Data tersimpan di database dengan foreign key ke siswa
7. Tabel otomatis refresh menampilkan data terbaru

### Siswa Workflow
1. Siswa login dengan akun yang sudah di-seed
2. Akses dashboard atau page khusus siswa
3. Bisa melihat semua kasus yang terdapat di record mereka
4. Data teramati real-time dari database

## Testing API Endpoints

### Get Semua Siswa
```bash
curl -X GET http://localhost:8000/api/siswa-list \
  -H "Authorization: Bearer <token>" \
  -H "Accept: application/json"
```

### Tambah Kasus
```bash
curl -X POST http://localhost:8000/api/kasus \
  -H "Authorization: Bearer <token>" \
  -H "Content-Type: application/json" \
  -d '{
    "siswa_id": 2,
    "pelanggaran": "Datang terlambat",
    "poin": 10,
    "catatan": "Terlambat 30 menit"
  }'
```

### Get Kasus Specific Siswa
```bash
curl -X GET http://localhost:8000/api/kasus/siswa/2 \
  -H "Authorization: Bearer <token>" \
  -H "Accept: application/json"
```

## Security Notes

1. **Authentication**: Semua API endpoints dilindungi dengan `auth:sanctum`
2. **Authorization**: Hanya admin dan guru_bk yang bisa create/update/delete kasus
3. **Validation**: Input divalidasi sebelum disimpan ke database
4. **CSRF Protection**: Token CSRF diinclude dalam setiap form submission

## Notes

- Password default untuk semua user: `password123` (sebaiknya ubah di production)
- Siswa emails di-generate otomatis dari nama
- Poin bersifat additive (jika ada 2 kasus, total poin = kasus1 + kasus2)
- Kasus dapat dihapus sepenuhnya (cascade delete ke tabel kasus)

## Troubleshooting

### Error: "API token not found"
- Pastikan user sudah login
- Token disimpan di localStorage otomatis saat login
- Cek browser console untuk error lebih detail

### Error: "Unauthorized" saat submit kasus
- Pastikan user adalah admin atau guru_bk
- Check role di database

### Kasus tidak muncul di table
- Refresh halaman atau cek browser console
- Pastikan API endpoints accessible
- Check database apakah data ada

## Future Improvements

1. Implement proper authentication token management (refresh token, expiry)
2. Add pagination untuk kasus dengan banyak data
3. Add filter/search functionality
4. Add export kasus ke PDF/Excel
5. Add notification saat kasus ditambahkan
6. Add approval workflow untuk kasus
