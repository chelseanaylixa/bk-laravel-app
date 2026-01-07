# Panduan Implementasi Fitur Pending User Approval

## Ringkasan Fitur
Fitur ini memungkinkan user baru untuk login dengan email yang belum terdaftar. User akan otomatis didaftarkan dengan status "pending" dan menunggu admin untuk menetapkan role mereka. Setelah admin menetapkan role, user dapat login dan mengakses dashboard sesuai role mereka.

## File yang Telah Dibuat/Dimodifikasi

### 1. **Database Migration**
- **File**: `database/migrations/2025_01_18_000000_add_status_to_users_table.php`
- **Fungsi**: Menambahkan kolom `status` ke tabel `users` dengan enum values: `active`, `pending`, `rejected`
- **Status**: ✅ Sudah dibuat
- **Langkah Selanjutnya**: Jalankan `php artisan migrate`

### 2. **User Model**
- **File**: `app/Models/User.php`
- **Perubahan**: Menambahkan `'status'` ke array `$fillable`
- **Status**: ✅ Sudah diupdate

### 3. **LoginController**
- **File**: `app/Http/Controllers/Auth/LoginController.php`
- **Perubahan**:
  - Method `login()`: Auto-create user baru dengan status 'pending' jika email tidak ditemukan
  - Method `showWaitingApproval()`: Menampilkan halaman tunggu persetujuan admin
- **Status**: ✅ Sudah dimodifikasi

### 4. **Blade View - Waiting Approval Page**
- **File**: `resources/views/auth/waiting_approval.blade.php`
- **Fitur**:
  - Loading spinner animation
  - Timer countdown (30 menit)
  - Email display
  - Auto-refresh status setiap 10 detik
  - Logout button
  - Info box dengan panduan
- **Status**: ✅ Sudah dibuat

### 5. **API Endpoint**
- **File**: `routes/api.php`
- **Endpoint**: `GET /api/user-status`
- **Fungsi**: Return user's current role dan status untuk auto-refresh di waiting approval page
- **Status**: ✅ Sudah ditambahkan

### 6. **Routes**
- **File**: `routes/auth.php`
- **Perubahan**: Route `waiting-approval` sudah ada untuk show waiting approval page
- **Status**: ✅ Sudah ada

- **File**: `routes/web.php`
- **Perubahan**: Update dashboard route untuk redirect pending users ke waiting-approval page
- **Status**: ✅ Sudah diupdate

## Flow Diagram

```
1. User Login dengan Email Baru
   ↓
2. LoginController::login() cek apakah email sudah terdaftar
   ├─ Tidak ada: Auto-create User dengan role='pending', status='pending'
   │   ├─ Login otomatis
   │   └─ Redirect ke /auth/waiting-approval
   │       ↓
   │       Waiting Approval Page
   │       - Tampilkan spinner loading
   │       - Timer countdown 30 menit
   │       - Auto-refresh status setiap 10 detik via /api/user-status
   │       ↓
   │       Admin melihat user pending di "All User" section
   │       Admin assign role (Admin/Guru BK/Siswa/Wali Murid)
   │       ↓
   │       Frontend /api/user-status deteksi role sudah berubah
   │       Redirect ke /dashboard
   │
   └─ Ada dengan status 'pending': Logout & error message "Akun masih menunggu persetujuan"
   
   └─ Ada dengan status 'active': Login normal

3. Dashboard Route
   - Cek user status
   - Jika status='pending' atau role='pending' → Redirect ke waiting-approval
   - Else → Redirect sesuai role ke kasus.index atau dashboard-siswa
```

## Langkah Setup Akhir

### Step 1: Jalankan Migration
```bash
cd c:\xampp\htdocs\bimbingan-konseling
php artisan migrate
```

**Output yang diharapkan**:
```
  Migrating: 2025_01_18_000000_add_status_to_users_table
  Migrated:  2025_01_18_000000_add_status_to_users_table (xxxms)
```

### Step 2: Test Flow End-to-End
1. Buka browser ke `http://localhost:8000/login`
2. Login dengan email baru, misalnya: `test@example.com`
3. Input password apapun
4. Seharusnya redirect ke `/auth/waiting-approval`
5. Page harus menampilkan:
   - Loading spinner
   - Email Anda: test@example.com
   - Timer countdown 30 menit
   - Logout button
6. Buka tab baru login sebagai admin ke `/dashboard`
7. Klik "All User" di navbar
8. Cari user "test" dengan status pending
9. Klik edit dan assign role (misalnya: Siswa)
10. Kembali ke tab waiting approval page
11. Dalam 10 detik, page harus auto-redirect ke `/dashboard`

## Troubleshooting

### Issue: Migration error "Column already exists"
**Solusi**: Kolom `status` sudah ada di tabel. Cek di database apakah sudah ada dengan `SELECT * FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_NAME = 'users'`

### Issue: Waiting approval page tidak auto-refresh
**Solusi**: 
1. Cek browser console (F12) untuk error message
2. Pastikan CSRF token valid
3. Cek apakah `/api/user-status` endpoint accessible (coba akses di postman)

### Issue: User tidak bisa logout dari waiting approval page
**Solusi**: Pastikan route logout di `routes/auth.php` atau `routes/web.php` sudah correct

## Update untuk Admin Dashboard - All User Section

Admin harus bisa melihat pending users di "All User" table. Update yang diperlukan di `kasus/index.blade.php`:

### Update JavaScript fetchAllUsers()
Pastikan render function menampilkan status badge untuk pending users:

```javascript
// Di renderAllUsersTable() function
const statusBadge = user.status === 'pending' 
    ? '<span class="badge bg-warning text-dark">Pending</span>'
    : '<span class="badge bg-success">Active</span>';
```

### Update Edit Role Modal
Ensure form submission ke `/api/users/{id}` successful dan update user status jika role berubah:

```javascript
// Setelah berhasil update role
// Auto-refresh tabel untuk show status terbaru
```

## Database Schema

### Users Table - status Column
```sql
ALTER TABLE users ADD COLUMN status ENUM('active', 'pending', 'rejected') DEFAULT 'active' AFTER role;
```

**Column Details**:
- `status`: Enum field dengan values:
  - `active`: User sudah approved dan bisa akses sistem
  - `pending`: User baru, menunggu admin untuk assign role
  - `rejected`: User rejected oleh admin (optional future feature)

## Next Steps (Optional Enhancements)

1. **Email Notification**: Kirim email ke admin ketika ada pending user
   - Implementasi: Add to LoginController::login() after User::create()
   - Method: Mail::send() dengan notification

2. **Auto-Reject After 30 Minutes**: Jika admin tidak approve dalam 30 menit, auto-reject
   - Implementasi: Add Laravel scheduled task di `app/Console/Kernel.php`
   - Command: `php artisan schedule:work`

3. **Admin Dashboard Indicator**: Show badge di admin navbar "3 Pending Users"
   - Count pending users di dashboard view
   - Update navbar badge count

4. **User Status Enum Cast**: Add to User model for type safety
   ```php
   protected $casts = [
       'status' => 'string', // atau custom cast
   ];
   ```

5. **Validation for Role Assignment**: 
   - Ensure admin only assigns valid roles
   - Add validation di UserController::updateUserRole()

## Summary Checklist

- [x] Database migration created
- [x] User model updated with 'status' fillable
- [x] LoginController updated with pending logic
- [x] Waiting approval blade view created
- [x] API endpoint for user status created
- [x] Dashboard route updated to check pending status
- [ ] Run migration command (MANUAL STEP)
- [ ] Update "All User" table rendering to show status (OPTIONAL)
- [ ] Test end-to-end flow (MANUAL TEST)
