# Setup reCAPTCHA v3

Dokumen ini menjelaskan cara mengintegrasikan Google reCAPTCHA v3 ke dalam aplikasi Sistem Sekolah untuk meningkatkan keamanan login.

## 📋 Langkah-Langkah Setup

### 1. Daftar ke Google reCAPTCHA Admin Console

1. Kunjungi: https://www.google.com/recaptcha/admin
2. Login dengan akun Google Anda
3. Klik **"Create"** atau **"+"** untuk membuat project baru

### 2. Konfigurasi reCAPTCHA v3

Isi form dengan konfigurasi berikut:

- **Label**: `Sistem Sekolah` (atau nama yang Anda inginkan)
- **reCAPTCHA type**: Pilih **reCAPTCHA v3**
- **Domains**: Tambahkan domain Anda:
  - `localhost` (untuk development)
  - `127.0.0.1` (untuk testing lokal)
  - Domain production Anda (jika ada)

Contoh jika menggunakan XAMPP lokal:
```
localhost
127.0.0.1
```

### 3. Dapatkan Site Key dan Secret Key

Setelah membuat project, Anda akan mendapatkan dua keys:
- **Site Key** (Public Key) - digunakan di frontend
- **Secret Key** (Private Key) - digunakan di backend

### 4. Konfigurasi File `.env`

Buka file `.env` di root project dan ubah:

```bash
# reCAPTCHA v3 Keys
RECAPTCHA_SITE_KEY=YOUR_RECAPTCHA_SITE_KEY_HERE
RECAPTCHA_SECRET_KEY=YOUR_RECAPTCHA_SECRET_KEY_HERE
```

Ganti dengan keys yang Anda dapatkan:

```bash
# Contoh (ganti dengan keys Anda):
RECAPTCHA_SITE_KEY=6LeIxAcTAAAAAJcZVRqyHh71UMIEGNQ_MXjiZKhI
RECAPTCHA_SECRET_KEY=6LeIxAcTAAAAAGG-vFI1HoRo9rmuQRBQv-sQ2KqJ
```

### 5. Testing

1. Jalankan server Laravel:
```bash
php artisan serve
```

2. Buka halaman login:
```
http://localhost:8000/login
```

3. Perhatikan badge reCAPTCHA di sudut kanan bawah halaman login

### 6. Monitoring

Di Google reCAPTCHA Admin Console, Anda dapat:
- Melihat analytics login
- Memantau traffic dan score suspicious
- Mengatur threshold score untuk bot detection
- Melihat domain mana yang menggunakan reCAPTCHA

## 🔒 Fitur Keamanan yang Ditambahkan

### 1. **Konfirmasi Password**
- User harus memasukkan password dua kali
- Sistem akan memvalidasi jika kedua password sama
- Visual feedback dengan ikon eye toggle untuk masing-masing field

### 2. **reCAPTCHA v3**
- Melakukan verifikasi otomatis tanpa interaksi user
- Memberikan score 0-1 untuk mengidentifikasi bot:
  - 1.0 = human interaction
  - 0.0 = likely bot
- Score threshold: 0.5 (configurable)

### 3. **Terms & Conditions Checkbox**
- User harus menyetujui kebijakan privasi
- Tombol login disabled sampai checkbox dicentang

### 4. **Rate Limiting**
- Maksimal 5 percobaan login dalam periode tertentu
- IP address yang mencoba brute force akan diblokir sementara

## 📝 Error Messages

Aplikasi akan menampilkan pesan error berikut jika ada masalah:

```
- "Konfirmasi kata sandi tidak cocok dengan kata sandi."
- "Anda harus menyetujui kebijakan privasi dan syarat & ketentuan."
- "Verifikasi keamanan gagal, silakan coba lagi."
- "Terjadi kesalahan saat verifikasi keamanan."
```

## 🔧 Konfigurasi Lanjutan

### Mengubah Score Threshold

Buka file `app/Http/Requests/Auth/LoginRequest.php` dan ubah nilai score:

```php
if (!$body['success'] || $body['score'] < 0.5) {
    // 0.5 = threshold minimum untuk dianggap human
    // Ubah ke 0.3 untuk lebih strict, 0.7 untuk lebih lenient
}
```

### Menggunakan Guzzle HTTP Client

Pastikan Guzzle sudah ter-install (biasanya sudah default di Laravel):

```bash
composer require guzzlehttp/guzzle
```

## ⚠️ Notes

1. **Testing di Localhost**:
   - reCAPTCHA akan tetap berfungsi di localhost
   - Jangan gunakan keys production untuk testing

2. **Security Best Practices**:
   - Jangan commit `.env` ke repository
   - Gunakan environment variables untuk keys
   - Rotate keys secara berkala

3. **Performance**:
   - reCAPTCHA v3 tidak menambah beban signifikan
   - Response time verifikasi biasanya < 500ms

## 🆘 Troubleshooting

### reCAPTCHA tidak muncul
- Pastikan domain sudah ditambahkan di Admin Console
- Clear browser cache
- Cek console browser untuk error (F12)

### "Verifikasi keamanan gagal"
- Pastikan `RECAPTCHA_SECRET_KEY` benar di `.env`
- Check server logs: `storage/logs/laravel.log`
- Pastikan Guzzle dan cURL enabled di PHP

### Score selalu rendah
- Periksa traffic source (VPN/Proxy)
- Tambahkan whitelist domain di Admin Console
- Sesuaikan threshold score

## 📚 Referensi

- [Google reCAPTCHA v3 Documentation](https://developers.google.com/recaptcha/docs/v3)
- [Laravel Validation Documentation](https://laravel.com/docs/validation)
- [Guzzle HTTP Documentation](https://docs.guzzlephp.org/)

---

**Last Updated**: 13 Januari 2026
**Version**: 1.0
