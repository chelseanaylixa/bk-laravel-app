# Testing Checklist - Refactor Kasus Management

**Created**: 2025-01-17
**Status**: Ready for execution

---

## Pre-Testing Setup

### ✅ Phase 0: Environment Verification

**Check 1: Database Connection**
```bash
# Verify .env file has correct database credentials
type .env | findstr DB_
# Expected output:
# DB_CONNECTION=mysql
# DB_HOST=localhost (or 127.0.0.1)
# DB_PORT=3306
# DB_DATABASE=bimbingan_konseling
# DB_USERNAME=root
# DB_PASSWORD=
```

**Check 2: Laravel Installation**
```bash
cd c:\xampp\htdocs\bimbingan-konseling
php artisan --version
# Expected: Laravel Framework 11.x.x
```

**Check 3: Database Exists**
```bash
# Open MySQL/MariaDB and verify database exists
# Or run artisan command
php artisan db:show
```

---

## Phase 1: Database Migration

### Step 1.1: Run Migration
```bash
php artisan migrate
```

**Expected Output**:
```
   INFO  Preparing database.
   INFO  Running migrations.
   INFO  Database prepared successfully.
```

**OR if migration already run:**
```
   INFO  Nothing to migrate.
```

**Verify in Database**:
```sql
-- Check kasus table structure
DESCRIBE kasus;

-- Expected columns:
-- id (PK, AUTO_INCREMENT)
-- siswa_id (FK to users)
-- guru_id (FK to users, nullable)
-- pelanggaran (VARCHAR)
-- poin (INT)
-- catatan (TEXT, nullable)
-- created_at (TIMESTAMP)
-- updated_at (TIMESTAMP)

-- Check foreign keys
SELECT CONSTRAINT_NAME, TABLE_NAME, COLUMN_NAME, REFERENCED_TABLE_NAME
FROM INFORMATION_SCHEMA.KEY_COLUMN_USAGE
WHERE TABLE_NAME = 'kasus';
```

---

## Phase 2: Data Seeding

### Step 2.1: Run UserSeeder
```bash
php artisan db:seed --class=UserSeeder
```

**Expected Output**:
```
   INFO  Database seeding completed successfully.
```

### Step 2.2: Verify Seeded Data

**Verify Admin User**:
```bash
php artisan tinker
>>> User::where('email', 'admin@smk.sch.id')->first()
=> User { email: "admin@smk.sch.id", role: "admin", ... }
```

**Verify All Staff**:
```bash
>>> User::whereIn('role', ['admin', 'guru_bk', 'wali_kelas', 'kepala_sekolah', 'wali_murid', 'guru_mapel'])->count()
=> 7
```

**Verify All Students**:
```bash
>>> User::where('role', 'siswa')->count()
=> 43 (should be 43)
```

**Verify Student Emails Format**:
```bash
>>> User::where('role', 'siswa')->first()
=> User { name: "ACHMAD DEVANI RIZQY PRATAM", email: "achmad.devani.rizqy.pratam@siswa.smk.sch.id", ... }
```

**Verify No Cases Initially**:
```bash
>>> Kasus::count()
=> 0 (should be empty initially)
```

---

## Phase 3: Server & Frontend Testing

### Step 3.1: Start Development Server
```bash
php artisan serve
```

**Expected Output**:
```
   INFO  Server running on [http://127.0.0.1:8000].
```

### Step 3.2: Test Login Page
1. Open http://localhost:8000/login in browser
2. **Expected**: Login form visible with email and password fields
3. **Expected**: "Bimbingan Konseling" title visible

### Step 3.3: Login as Admin
1. Email: `admin@smk.sch.id`
2. Password: `password123`
3. Click "Sign In"
4. **Expected**: Redirected to dashboard

### Step 3.4: Admin Dashboard Navigation
1. Look for "Kasus" menu item or link
2. Click to open kasus management page
3. **Expected**: Dashboard with:
   - Header: "Dashboard Admin/Guru BK"
   - Navbar with logout button
   - Two main tables (initially empty or with data)

---

## Phase 4: API Endpoint Testing

### Test Setup
1. Stay logged in as admin
2. Open browser DevTools (F12)
3. Go to Console tab

### Test 4.1: Get Siswa List API
```javascript
// In browser console:
fetch('/api/siswa-list', {
    headers: {
        'Authorization': `Bearer ${localStorage.getItem('api_token') || ''}`,
        'Accept': 'application/json',
    }
})
.then(r => r.json())
.then(data => console.log(data))
```

**Expected Response**:
```json
[
  {
    "id": 8,
    "nama": "ACHMAD DEVANI RIZQY PRATAM",
    "email": "achmad.devani.rizqy.pratam@siswa.smk.sch.id",
    "totalPoin": 0,
    "kasusCount": 0
  },
  {
    "id": 9,
    "nama": "AFRIZAL DANI FERDIANSYAH",
    "email": "afrizal.dani.ferdiansyah@siswa.smk.sch.id",
    "totalPoin": 0,
    "kasusCount": 0
  },
  // ... 41 more students
]
```

**Verification Checklist**:
- ✅ Returns array of 43 items
- ✅ Each item has: id, nama, email, totalPoin, kasusCount
- ✅ totalPoin = 0 (no cases yet)
- ✅ Sorted alphabetically by nama

### Test 4.2: Get All Kasus API
```javascript
fetch('/api/kasus', {
    headers: {
        'Authorization': `Bearer ${localStorage.getItem('api_token') || ''}`,
        'Accept': 'application/json',
    }
})
.then(r => r.json())
.then(data => console.log(data))
```

**Expected Response** (initially):
```json
[]  // Empty array, no cases yet
```

**Verification Checklist**:
- ✅ Returns empty array (no cases created yet)
- ✅ No error response

---

## Phase 5: Create Test Case

### Test 5.1: Add New Case via Dashboard
1. In admin dashboard, find "Daftar Siswa & Total Poin" table
2. Locate student: "ACHMAD DEVANI RIZQY PRATAM"
3. Click button "Tambah Kasus" for this student
4. **Expected**: Modal dialog opens with form

### Test 5.2: Fill Case Form
1. Select siswa: "ACHMAD DEVANI RIZQY PRATAM"
2. Pelanggaran: "Datang terlambat"
3. Poin: "10"
4. Click "Simpan Data"
5. **Expected**: Modal closes, case appears in table

### Test 5.3: Verify Case in Database
```bash
php artisan tinker
>>> Kasus::first()
=> Kasus {
     id: 1,
     siswa_id: 8,
     guru_id: 1, (admin id)
     pelanggaran: "Datang terlambat",
     poin: 10,
     catatan: null,
     created_at: "2025-01-17 ...",
     updated_at: "2025-01-17 ...",
   }
```

**Verification Checklist**:
- ✅ siswa_id = 8 (ACHMAD's user id)
- ✅ guru_id = 1 (logged in admin)
- ✅ pelanggaran = "Datang terlambat"
- ✅ poin = 10
- ✅ timestamps present

### Test 5.4: Verify Student's Total Poin Updated
```javascript
// In browser console
fetch('/api/siswa-list', {
    headers: {
        'Authorization': `Bearer ${localStorage.getItem('api_token') || ''}`,
        'Accept': 'application/json',
    }
})
.then(r => r.json())
.then(data => {
    const achmad = data.find(s => s.nama === "ACHMAD DEVANI RIZQY PRATAM");
    console.log(achmad);
})
```

**Expected**:
```json
{
  "id": 8,
  "nama": "ACHMAD DEVANI RIZQY PRATAM",
  "email": "achmad.devani.rizqy.pratam@siswa.smk.sch.id",
  "totalPoin": 10,  // <-- Updated from 0
  "kasusCount": 1    // <-- Updated from 0
}
```

**Verification Checklist**:
- ✅ totalPoin changed to 10
- ✅ kasusCount changed to 1

---

## Phase 6: Additional Case Operations

### Test 6.1: Add Another Case to Same Student
1. Add second case to ACHMAD:
   - Pelanggaran: "Tidak mengerjakan PR"
   - Poin: 5
2. Verify totalPoin = 15 (10 + 5)
3. Verify kasusCount = 2

**Expected in Database**:
```bash
>>> Kasus::where('siswa_id', 8)->get()
[
  { id: 1, pelanggaran: "Datang terlambat", poin: 10 },
  { id: 2, pelanggaran: "Tidak mengerjakan PR", poin: 5 }
]
>>> Kasus::where('siswa_id', 8)->sum('poin')
15
```

### Test 6.2: Add Case to Different Student
1. Add case to "AFRIZAL DANI FERDIANSYAH":
   - Pelanggaran: "Merokok"
   - Poin: 25
2. Verify in /api/kasus returns both students' cases

**Expected**:
```bash
>>> Kasus::count()
3
>>> Kasus::with('siswa')->get()
[
  { siswa.nama: "ACHMAD...", pelanggaran: "Datang terlambat", poin: 10 },
  { siswa.nama: "ACHMAD...", pelanggaran: "Tidak mengerjakan PR", poin: 5 },
  { siswa.nama: "AFRIZAL...", pelanggaran: "Merokok", poin: 25 }
]
```

### Test 6.3: Update Existing Case
1. Find a case in dashboard table
2. Click edit/update button (if available)
3. Change poin from 10 to 15
4. Verify database updated
5. Verify totalPoin recalculated

**Expected**:
```bash
>>> Kasus::find(1)->poin
15  // Updated from 10
>>> User::find(8)->getTotalPoin()
20  // Recalculated: 15 + 5
```

### Test 6.4: Delete Case
1. Find case to delete
2. Click delete button
3. Confirm deletion
4. **Expected**: Case removed from table, totalPoin updated

**Expected**:
```bash
>>> Kasus::find(1)  // After deletion
null  // Not found
>>> Kasus::count()
2  // Reduced from 3
```

---

## Phase 7: Student View Testing

### Test 7.1: Student Login
1. Logout from admin
2. Login as student: `achmad.devani.rizqy.pratam@siswa.smk.sch.id` / `password123`
3. **Expected**: Student dashboard visible

### Test 7.2: View Own Cases (API Ready)
1. Open browser console
2. Run API call to get own cases:
```javascript
const userId = 8; // ACHMAD's ID
fetch(`/api/kasus/siswa/${userId}`, {
    headers: {
        'Authorization': `Bearer ${localStorage.getItem('api_token') || ''}`,
        'Accept': 'application/json',
    }
})
.then(r => r.json())
.then(data => console.log(data))
```

**Expected Response**:
```json
{
  "siswa": "ACHMAD DEVANI RIZQY PRATAM",
  "totalPoin": 20,
  "kasus": [
    {
      "id": 2,
      "pelanggaran": "Tidak mengerjakan PR",
      "poin": 5,
      "penanggungJawab": "Admin Utama",
      "tanggal": "2025-01-17",
      "catatan": null
    },
    {
      "id": 1,
      "pelanggaran": "Datang terlambat",
      "poin": 15,
      "penanggungJawab": "Admin Utama",
      "tanggal": "2025-01-17",
      "catatan": null
    }
  ]
}
```

**Verification Checklist**:
- ✅ API returns student's data
- ✅ totalPoin is correct (sum of all cases)
- ✅ Cases ordered by latest first
- ✅ Includes: pelanggaran, poin, penanggungJawab name, tanggal, catatan
- ✅ No error response

### Test 7.3: Student Cannot Add Cases
1. Try to call POST /api/kasus as student
```javascript
fetch('/api/kasus', {
    method: 'POST',
    headers: {
        'Authorization': `Bearer ${localStorage.getItem('api_token') || ''}`,
        'Content-Type': 'application/json',
    },
    body: JSON.stringify({
        siswa_id: 8,
        pelanggaran: "Test",
        poin: 10
    })
})
.then(r => r.json())
.then(data => console.log(data))
```

**Expected Response**:
```json
{
  "error": "Anda tidak memiliki akses untuk membuat kasus"
}
```

**Verification Checklist**:
- ✅ Returns 403 Forbidden
- ✅ Error message is clear
- ✅ Case not created in database

---

## Phase 8: Authorization Testing

### Test 8.1: Invalid Token
1. Logout
2. Try API call without token:
```javascript
fetch('/api/siswa-list', {
    headers: { 'Accept': 'application/json' }
})
.then(r => r.json())
.then(data => console.log(data))
```

**Expected**:
- 401 Unauthorized error
- OR redirected to login

### Test 8.2: Guru BK Permissions
1. Login as guru_bk@smk.sch.id
2. Should be able to:
   - ✅ Add cases
   - ✅ Update cases
   - ✅ Delete cases
3. Verify same functionality as admin

### Test 8.3: Role-Based Access
Test Matrix:
| Action | Admin | Guru BK | Siswa | Expected |
|--------|-------|---------|-------|----------|
| View Siswa List | ✅ | ✅ | ✅ | All can view |
| View All Kasus | ✅ | ✅ | ✅ | All can view |
| View Own Kasus | ✅ | ✅ | ✅ | All can view |
| Create Kasus | ✅ | ✅ | ❌ | Only admin/guru_bk |
| Update Kasus | ✅ | ✅ | ❌ | Only admin/guru_bk |
| Delete Kasus | ✅ | ✅ | ❌ | Only admin/guru_bk |

---

## Phase 9: Edge Cases & Error Handling

### Test 9.1: Invalid Siswa ID
```javascript
fetch('/api/kasus', {
    method: 'POST',
    headers: { /* ... */ },
    body: JSON.stringify({
        siswa_id: 9999,  // Non-existent
        pelanggaran: "Test",
        poin: 10
    })
})
```

**Expected**: 
- Validation error
- "exists:users" constraint fails
- Clear error message

### Test 9.2: Non-Siswa User
```javascript
// Try to add case for admin (not a siswa)
fetch('/api/kasus', {
    method: 'POST',
    body: JSON.stringify({
        siswa_id: 1,  // Admin's ID
        pelanggaran: "Test",
        poin: 10
    })
})
```

**Expected**:
```json
{ "error": "User bukan siswa" }
```

### Test 9.3: Invalid Poin (0 or negative)
```javascript
fetch('/api/kasus', {
    method: 'POST',
    body: JSON.stringify({
        siswa_id: 8,
        pelanggaran: "Test",
        poin: 0  // Invalid
    })
})
```

**Expected**: Validation error "poin must be >= 1"

### Test 9.4: Missing Required Fields
```javascript
fetch('/api/kasus', {
    method: 'POST',
    body: JSON.stringify({
        siswa_id: 8
        // Missing: pelanggaran, poin
    })
})
```

**Expected**: Validation errors for required fields

---

## Phase 10: Performance & Data Integrity

### Test 10.1: Cascade Delete
1. Get a siswa user ID
2. Delete that user from database
3. Check if associated cases are deleted
```bash
php artisan tinker
>>> $user = User::find(8);
>>> $user->delete();
>>> Kasus::where('siswa_id', 8)->count()
0  // Should be 0 (cascade deleted)
```

**Expected**: Cases deleted when siswa deleted (cascade)

### Test 10.2: Null Guru ID
1. Create case with admin
2. Update case, changing guru
3. Delete guru user
4. Check case still exists with guru_id = null
```bash
>>> Kasus::find(1)
Kasus { guru_id: null, ... }  // Not deleted, set to null
```

**Expected**: Case not deleted, just guru_id becomes null

### Test 10.3: Large Dataset
1. Create 100+ cases for various students
2. Test performance:
   - /api/siswa-list (should be fast)
   - /api/kasus (check if paginated needed)
   - /api/kasus/siswa/{id} (specific student)

**Expected**:
- Response time < 1 second
- All data returned correctly
- No timeout errors

---

## Summary Checklist

### Core Functionality
- [ ] Database migration runs successfully
- [ ] UserSeeder creates 43 students + 7 staff
- [ ] Admin can login
- [ ] Student can login
- [ ] Admin can add cases to students
- [ ] Cases appear in database with correct foreign keys
- [ ] Student poin total updates correctly

### API Functionality
- [ ] GET /api/siswa-list returns all students
- [ ] GET /api/kasus returns all cases
- [ ] GET /api/kasus/siswa/{id} returns specific student cases
- [ ] POST /api/kasus creates new case
- [ ] PUT /api/kasus/{id} updates case
- [ ] DELETE /api/kasus/{id} removes case

### Authorization
- [ ] Only admin/guru_bk can create cases
- [ ] Only admin/guru_bk can update cases
- [ ] Only admin/guru_bk can delete cases
- [ ] All roles can view cases
- [ ] Invalid/no token returns 401

### Frontend
- [ ] Siswa dropdown populates from API
- [ ] Dashboard table refreshes after add/update/delete
- [ ] No hardcoded data visible
- [ ] Modals work correctly
- [ ] Form validation works

### Data Integrity
- [ ] Cascade deletes work (siswa delete → cases deleted)
- [ ] Set null works (guru delete → guru_id null)
- [ ] Foreign key constraints enforced
- [ ] Timestamps updated correctly

---

## Pass/Fail Criteria

### PASS Requirements
- ✅ All migration operations successful
- ✅ All 43 students seeded with correct format
- ✅ All CRUD operations work via API
- ✅ Role-based access control enforced
- ✅ Database constraints enforced
- ✅ Frontend loads and fetches data from API

### FAIL Criteria
- ❌ Migration errors
- ❌ Seeder doesn't create 43 students
- ❌ API returns wrong data format
- ❌ Non-admin can create cases
- ❌ Cases not persisted to database
- ❌ Frontend shows hardcoded data

---

## Notes

- All passwords default to `password123`
- API requires valid Sanctum token
- CSRF token needed for POST/PUT/DELETE
- localStorage should store API token after login
- Cases can only be added to users with role='siswa'

