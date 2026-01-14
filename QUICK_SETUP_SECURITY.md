# 🚀 Quick Setup Guide - Konfirmasi Password & reCAPTCHA

**Tanggal Update**: 13 Januari 2026

## ✨ Fitur Baru Ditambahkan

Login form sekarang dilengkapi dengan:
- ✅ **Password Confirmation** - Konfirmasi password sebelum login
- 🤖 **Google reCAPTCHA v3** - Proteksi otomatis dari bot
- ✋ **Terms & Conditions** - User harus menyetujui kebijakan

## ⚡ Setup Cepat (5 Menit)

### Step 1: Daftar reCAPTCHA (2 menit)

1. Buka: https://www.google.com/recaptcha/admin
2. Login dengan Google Account
3. Klik "Create" atau "+" untuk project baru
4. Isi form:
   - **Label**: "Sistem Sekolah"
   - **reCAPTCHA type**: Pilih v3
   - **Domains**: Ketik `localhost` (untuk testing)
   
5. Klik Create - Anda akan mendapat 2 keys:
   ```
   Site Key (Public)
   Secret Key (Private)
   ```

### Step 2: Update `.env` File (1 menit)

Buka file `.env` di root folder project:

```bash
# Tambahkan di akhir file:
RECAPTCHA_SITE_KEY=PASTE_SITE_KEY_HERE
RECAPTCHA_SECRET_KEY=PASTE_SECRET_KEY_HERE
```

**Contoh:**
```bash
RECAPTCHA_SITE_KEY=6LeIxAcTAAAAAJcZVRqyHh71UMIEGNQ_MXjiZKhI
RECAPTCHA_SECRET_KEY=6LeIxAcTAAAAAGG-vFI1HoRo9rmuQRBQv-sQ2KqJ
```

### Step 3: Test Login (2 menit)

```bash
# Terminal 1: Jalankan server
php artisan serve

# Browser: Buka
http://localhost:8000/login
```

**Cek elemen baru:**
- ✅ 2 password fields (password + confirmation)
- ✅ reCAPTCHA badge di kanan bawah
- ✅ Checkbox "Saya setuju dengan..."
- ✅ Button Login disabled sampai checkbox dicentang

## 📋 Form Fields

### Password Field
```
[Password]        [Eye Icon] ← untuk lihat/sembunyikan
[Confirm Password] [Eye Icon] ← untuk lihat/sembunyikan
Note: Password harus sama untuk bisa submit
```

### reCAPTCHA v3
```
- Invisible (tidak perlu user interact)
- Score: 0-1 (1 = human, 0 = bot)
- Threshold: 0.5
```

### Checkbox
```
☐ Saya menyetujui Kebijakan Privasi dan Syarat & Ketentuan
[Link ke docs tersedia]
```

## 🧪 Test Scenarios

| Scenario | Expected Result |
|----------|-----------------|
| Email kosong | Error: "Email wajib diisi" |
| Password kosong | Error: "Password wajib diisi" |
| Password ≠ Confirmation | Field merah, tidak bisa submit |
| Checkbox tidak dicentang | Button Login disabled |
| reCAPTCHA failed | Error: "Verifikasi keamanan gagal" |
| Semua valid | Login berhasil ✓ |

## 🔒 Security Features

1. **Rate Limiting**
   - Max 5 attempts per IP
   - Auto-lockout setelah exceed

2. **Bot Protection**
   - reCAPTCHA v3 dengan AI
   - Score-based detection
   - Configurable threshold

3. **Data Validation**
   - Server-side validation
   - Client-side feedback
   - Custom error messages (Bahasa Indonesia)

## ⚠️ Important Notes

### Untuk Testing Lokal
- Domain harus `localhost` atau `127.0.0.1`
- Keys testing bisa di-reuse
- reCAPTCHA tetap berfungsi normal

### Untuk Production
- Daftar keys production baru
- Update domain dengan URL asli
- Jangan commit `.env` ke git
- Use environment variables di server

### Keys Secret
- ⛔ Jangan share SECRET_KEY
- ⛔ Jangan push `.env` ke repository
- ✅ Gunakan `.env.example` untuk reference

## 📊 Monitoring

Di Google reCAPTCHA Admin Console bisa lihat:
- Analytics (login attempts, score distribution)
- Bot detection stats
- Domain traffic
- Threshold adjustments

## 🛠️ Common Issues & Solutions

### reCAPTCHA tidak muncul
**Solusi:**
```bash
# 1. Cek .env sudah ada RECAPTCHA_SITE_KEY
# 2. Refresh page dan clear cache
# 3. Check browser console (F12) untuk error
```

### "Verifikasi keamanan gagal"
**Solusi:**
```bash
# 1. Cek RECAPTCHA_SECRET_KEY di .env benar
# 2. Check internet connection
# 3. Lihat laravel.log: storage/logs/
tail -f storage/logs/laravel.log
```

### Password confirmation tidak match
**Solusi:**
```bash
# Ketik ulang dengan hati-hati
# Atau gunakan eye icon untuk lihat password
# Case-sensitive! (aA ≠ aa)
```

### Login button tetap disabled
**Solusi:**
```bash
# 1. Centang checkbox "Saya setuju"
# 2. Refresh page jika masih stuck
```

## 📚 File Dokumentasi

Untuk info lebih detail:
- [RECAPTCHA_SETUP.md](./RECAPTCHA_SETUP.md) - Setup lengkap reCAPTCHA
- [SECURITY_ENHANCEMENT.md](./SECURITY_ENHANCEMENT.md) - Detail keamanan
- [README.md](./README.md) - Project documentation

## 💡 Tips & Best Practices

1. **Password Strength**
   - Gunakan kombinasi: uppercase, lowercase, numbers, symbols
   - Min 8 karakter recommended

2. **reCAPTCHA Score**
   - Jangan terlalu ketat (< 0.3)
   - Jangan terlalu longgar (> 0.8)
   - 0.5 adalah sweet spot untuk balance

3. **Testing di Mobile**
   - Test di actual device juga
   - Pastikan touch events work
   - reCAPTCHA support semua device

## 🎯 Next Steps

1. ✅ Setup reCAPTCHA keys
2. ✅ Test login lokal
3. ✅ Verifikasi semua fields work
4. ✅ Setup production keys (jika ready)
5. ✅ Monitor di Admin Console

## ❓ FAQ

**Q: User perlu login berapa kali?**
A: Sekali. Password confirmation hanya untuk verifikasi, bukan separate login.

**Q: Berapa lama reCAPTCHA verify?**
A: < 500ms biasanya. User tidak akan notice.

**Q: Apa yg terjadi jika score rendah?**
A: Dianggap bot → login gagal. User bisa retry.

**Q: Bisa customize threshold score?**
A: Ya, edit di: `app/Http/Requests/Auth/LoginRequest.php` line ~120

**Q: Perlu internet untuk reCAPTCHA?**
A: Ya, verify diperlukan koneksi ke Google server.

---

**Questions?** Lihat file dokumentasi lengkap atau check browser console untuk debug info.

**Last Updated**: 13 Januari 2026
