# 🚀 QUICK START GUIDE - Refactor Kasus Management

**Last Updated**: 2025-01-17 | **Status**: ✅ Ready

---

## ⏱️ 5-Minute Setup

### 1️⃣ Run Migration (30 seconds)
```bash
cd c:\xampp\htdocs\bimbingan-konseling
php artisan migrate
```

### 2️⃣ Seed Data (30 seconds)
```bash
php artisan db:seed --class=UserSeeder
```

### 3️⃣ Start Server (10 seconds)
```bash
php artisan serve
```

### 4️⃣ Login & Test (3 minutes)
1. Open http://localhost:8000/login
2. Email: `admin@smk.sch.id`
3. Password: `password123`
4. Click "Kasus" menu
5. Try "Tambah Kasus" button
6. Fill form → Submit → Check database

**Done!** ✅

---

## 📚 What's New?

### New API Endpoints
```
GET    /api/siswa-list              # Get all students with poin
GET    /api/kasus                   # Get all cases
GET    /api/kasus/siswa/{id}        # Get student's cases
POST   /api/kasus                   # Create case
PUT    /api/kasus/{id}              # Update case
DELETE /api/kasus/{id}              # Delete case
```

### New Database Schema
```sql
kasus table now has:
- siswa_id (FK to users)
- guru_id (FK to users)
- pelanggaran
- poin
- catatan
- timestamps
```

### 43 Student Accounts
All emails: `nama.siswa@siswa.smk.sch.id`
Password: `password123`

---

## 🧪 Quick Tests

### Test 1: Add Case via Admin
```bash
# Login as admin
# Klik "Tambah Kasus"
# Select siswa → Fill form → Submit
# Check: Case appears in table + database
```

### Test 2: Verify in Database
```bash
php artisan tinker
>>> Kasus::count()                    # Should increase
>>> Kasus::first()->siswa->name       # Show student name
>>> User::where('role', 'siswa')->count()  # Should be 43
```

### Test 3: Check API
```javascript
// In browser console (F12)
fetch('/api/siswa-list').then(r => r.json()).then(console.log)
```

---

## 🔑 Login Credentials

| Role | Email | Password |
|------|-------|----------|
| Admin | admin@smk.sch.id | password123 |
| Guru BK | gurubk@smk.sch.id | password123 |
| Siswa (43x) | nama.siswa@siswa.smk.sch.id | password123 |

---

## 📖 Full Documentation

| Document | Purpose |
|----------|---------|
| **REFACTOR_DOCUMENTATION.md** | Setup + API overview |
| **REFACTOR_STATUS_REPORT.md** | Technical deep dive |
| **TESTING_CHECKLIST.md** | 10-phase test plan |
| **README_REFACTOR_SUMMARY.md** | Complete summary |

---

## ⚡ Common Commands

### Verify Setup
```bash
# Count students
php artisan tinker
>>> User::where('role', 'siswa')->count()

# Check kasus
>>> Kasus::count()

# Check tables
>>> DB::select('SHOW TABLES')
```

### Reset Everything
```bash
php artisan migrate:fresh --seed
```

### Check Logs
```bash
type storage\logs\laravel.log
```

### API Test
```bash
# Get siswa list
curl http://localhost:8000/api/siswa-list \
  -H "Authorization: Bearer YOUR_TOKEN"

# Create case (POST)
curl -X POST http://localhost:8000/api/kasus \
  -H "Authorization: Bearer YOUR_TOKEN" \
  -H "Content-Type: application/json" \
  -d '{"siswa_id":2,"pelanggaran":"Terlambat","poin":10}'
```

---

## ✅ Success Indicators

When everything works correctly:

1. ✅ `php artisan migrate` runs without errors
2. ✅ `php artisan db:seed --class=UserSeeder` completes
3. ✅ Admin can login
4. ✅ Kasus dashboard loads
5. ✅ Can add case to student
6. ✅ Case appears in database: `Kasus::count()` increases
7. ✅ Student poin updates: `User::find(8)->getTotalPoin()` changes
8. ✅ API returns data: `/api/siswa-list` shows 43 students
9. ✅ Student can login and view their cases
10. ✅ Non-admin cannot create cases

---

## 🚨 Troubleshooting

### Error: "Nothing to migrate"
**Meaning**: Migration already ran
**Solution**: That's OK! Just run seeder: `php artisan db:seed --class=UserSeeder`

### Error: "SQLSTATE[HY000]: General error: 1364"
**Meaning**: Required field missing in seeder
**Solution**: Check fillable array in models has all fields

### Error: "Class not found KasusApiController"
**Meaning**: Controller import missing
**Solution**: Already fixed! Check `routes/api.php` has proper import

### Students not appearing in dropdown
**Meaning**: API not responding or students not seeded
**Solution**: 
```bash
php artisan tinker
>>> User::where('role', 'siswa')->count()  # Should be 43
>>> DB::table('users')->truncate()  # Clear if needed
>>> exit
>>> php artisan db:seed --class=UserSeeder
```

### Case not saving
**Meaning**: API endpoint issue or validation failed
**Solution**: Check browser console (F12) for error message

---

## 📊 Data Flow

```
┌──────────────────┐
│  Admin Portal    │
└────────┬─────────┘
         │ "Tambah Kasus"
         ↓
┌──────────────────┐
│   Form Submit    │ → POST /api/kasus
├──────────────────┤
│ siswa_id: 2      │
│ pelanggaran: xxx │
│ poin: 10         │
└────────┬─────────┘
         │
         ↓
┌──────────────────────┐
│ KasusApiController   │ ✓ Check auth
├──────────────────────┤ ✓ Validate input
│ store() method       │ ✓ Check siswa role
└────────┬─────────────┘ ✓ Create record
         │
         ↓
┌──────────────────┐
│   Database       │
│  kasus table     │ → Saved with:
└─────────────────┘   - siswa_id: 2
                      - guru_id: 1 (admin)
                      - pelanggaran: xxx
                      - poin: 10
                      - created_at: now
         │
         ↓
┌──────────────────┐
│ Admin Dashboard  │ → fetchKasus() refreshes
│ Updates showing  │   Total poin updated
│ new case         │   UI reflects changes
└──────────────────┘
         │
         ↓
┌──────────────────┐
│  Student Login   │ → GET /api/kasus/siswa/2
│  Views Cases     │   Shows new case
└──────────────────┘
```

---

## 🎯 Files Changed Summary

**7 files modified:**
- Migration: kasus table schema
- Seeder: +43 students
- Model Kasus: +relations, +methods
- Model User: +relations, +methods
- Controller: NEW KasusApiController (6 endpoints)
- Routes: +6 API routes
- View: JavaScript refactor

**Result**: From hardcoded arrays → Database-backed REST API

---

## 💡 Tips

1. **Always logout first** before testing different roles
2. **Check browser console (F12)** for API errors
3. **Use F12 Network tab** to see API calls
4. **Use php artisan tinker** to debug database issues
5. **Save a backup** before running migrate:fresh
6. **Test each role** (admin, guru_bk, siswa)
7. **Try edge cases** (invalid IDs, wrong role, etc.)

---

## 📞 Key Files to Know

```
app/
└── Http/Controllers/
    └── KasusApiController.php      # API logic

app/Models/
├── Kasus.php                        # Relations: siswa(), guru()
└── User.php                         # Relations: kasus(), kasusAsGuru()

routes/
└── api.php                          # 6 API endpoints

database/
├── migrations/
│   └── 2025_09_23_104145_create_kasus_table.php
└── seeders/
    └── UserSeeder.php               # 43 students

resources/views/kasus/
└── index.blade.php                  # Frontend with AJAX
```

---

## 🎉 That's It!

You now have a complete **database-backed case management system** with:
- ✅ Proper database schema with relations
- ✅ 43 student accounts automatically created
- ✅ RESTful API with role-based access
- ✅ Admin can add cases to students
- ✅ Students can view their cases
- ✅ Real-time updates

**Total setup time**: 5 minutes ⚡

---

**Questions?** Check the full docs:
- REFACTOR_DOCUMENTATION.md
- REFACTOR_STATUS_REPORT.md
- TESTING_CHECKLIST.md

**Happy coding!** 🚀

