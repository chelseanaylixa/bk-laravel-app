# 📦 Dependencies Check & Installation

**Version**: 1.0  
**Last Updated**: 13 Januari 2026

---

## ✅ Required Packages

### 1. GuzzleHttp (untuk reCAPTCHA API calls)

**Status Check**:
```bash
composer show guzzlehttp/guzzle
```

**Expected Output**:
```
guzzlehttp/guzzle           7.x atau 8.x  - HTTP client library
```

**If Not Installed**:
```bash
composer require guzzlehttp/guzzle:^7.0
```

**Verify Installation**:
```bash
# Check di composer.lock file
grep -i guzzle composer.lock

# Atau jalankan PHP
php -r "echo class_exists('\\GuzzleHttp\\Client') ? 'OK' : 'FAIL';"
# Output: OK
```

---

## 📋 Full Dependency List

### Laravel Framework (Already Installed)
```
laravel/framework: ^11.0
```

### UI & Frontend
```
bootstrap: ^5.3.0          ✅ Already in resources
font-awesome: ^6.4.0       ✅ Already in resources
```

### PHP/Laravel Core
```
illuminate/support: ^11.0  ✅ Built-in
illuminate/validation: ^11.0 ✅ Built-in
guzzlehttp/guzzle: ^7.0   ⚠️ CHECK INSTALLED
```

---

## 🔍 Quick Dependency Check

Jalankan command ini untuk verify semua:

```bash
# 1. Check Composer Packages
composer check-platform-reqs

# 2. Check PHP Version
php --version
# Perlu: PHP 8.1 atau lebih tinggi

# 3. Check Extension
php -m | grep curl
# Perlu: curl extension untuk GuzzleHttp

# 4. Check GuzzleHttp
php -r "require 'vendor/autoload.php'; echo class_exists('\\GuzzleHttp\\Client') ? 'GuzzleHttp OK' : 'GuzzleHttp MISSING';"
# Output: GuzzleHttp OK atau GuzzleHttp MISSING
```

---

## 🔧 Installation Instructions

### If GuzzleHttp is Missing

```bash
# 1. Install package
composer require guzzlehttp/guzzle:^7.0

# 2. Verify installation
composer show guzzlehttp/guzzle

# 3. Test
php artisan tinker
# Di prompt, ketik:
>>> $client = new \GuzzleHttp\Client();
>>> echo "OK";
# Output: OK
```

### If PHP Extensions Missing

```bash
# Linux/Ubuntu
sudo apt-get install php8.x-curl

# MacOS
brew install php@8.1-curl

# Windows (XAMPP)
# Edit php.ini:
# - Find: ;extension=curl
# - Change to: extension=curl
# - Restart Apache
```

---

## ✨ Complete Installation Checklist

### Prerequisites
- [ ] PHP 8.1+ installed
- [ ] Composer installed
- [ ] Laravel project setup
- [ ] Database configured

### Required Packages
- [ ] `guzzlehttp/guzzle` installed
- [ ] `curl` extension enabled
- [ ] All Laravel packages installed

### Project Files
- [ ] `resources/views/auth/login.blade.php` updated
- [ ] `app/Http/Requests/Auth/LoginRequest.php` updated
- [ ] `.env` file created with DB config

### Environment Variables
- [ ] `RECAPTCHA_SITE_KEY` set (can be dummy for testing)
- [ ] `RECAPTCHA_SECRET_KEY` set (can be dummy for testing)
- [ ] `APP_URL` set correctly

### Ready to Use
- [ ] All docs read
- [ ] reCAPTCHA setup completed
- [ ] Login page tested locally

---

## 📊 Dependency Version Check

### Current Installation (XAMPP)
```
PHP: 8.1+ ✅
Laravel: 11.0+ ✅
Composer: 2.x+ ✅
cURL: enabled ✅
GuzzleHttp: 7.x ⚠️ VERIFY
```

### Compatibility Matrix
| Package | Min Version | Recommended | Max Version |
|---------|------------|------------|------------|
| PHP | 8.1 | 8.3 | 8.4 |
| Laravel | 11.0 | 11.0+ | Latest |
| GuzzleHttp | 7.0 | 7.5+ | 8.x |
| Bootstrap | 5.3 | 5.3.2 | Latest 5.x |

---

## 🐛 Troubleshooting

### Error: Class 'GuzzleHttp\Client' not found

**Solution 1**: Install GuzzleHttp
```bash
composer require guzzlehttp/guzzle:^7.0
composer install
```

**Solution 2**: Clear cache
```bash
composer dump-autoload
php artisan cache:clear
```

**Solution 3**: Verify installation
```bash
ls vendor/guzzlehttp/
# Harus ada: guzzle/, psr7/, promises/
```

### Error: cURL extension not loaded

**XAMPP Windows**:
1. Open `php.ini` (di folder XAMPP)
2. Find: `;extension=curl`
3. Remove semicolon: `extension=curl`
4. Restart Apache

**Verify**:
```bash
php -m | grep curl
# Output: curl
```

### Error: Composer autoload not found

**Solution**:
```bash
composer install
composer dump-autoload
```

### Error: Package conflict

**Solution**:
```bash
# Remove old version
composer remove guzzlehttp/guzzle

# Install fresh
composer require guzzlehttp/guzzle:^7.0

# Update
composer update
```

---

## 📝 Installation Log

Catat hasil instalasi Anda:

```
Date: _______________
PHP Version: _______________
Composer Version: _______________
Laravel Version: _______________
GuzzleHttp Version: _______________
cURL Enabled: [ ] Yes [ ] No
All tests passed: [ ] Yes [ ] No
Notes: _______________________________________________
```

---

## ✅ Final Verification

Sebelum mulai development, jalankan:

```bash
# 1. Check environment
php artisan env

# 2. Check config
php artisan config:show app.url

# 3. Test database connection
php artisan migrate:status

# 4. Clear all caches
php artisan cache:clear
php artisan view:clear
php artisan config:clear

# 5. Test GuzzleHttp
php artisan tinker
>>> new \GuzzleHttp\Client()
# Harus return object, bukan error

# 6. Serve application
php artisan serve
```

**Expected Result**: Semua berjalan tanpa error ✅

---

## 📞 Support

### If Installation Fails

1. Check PHP version: `php --version`
2. Check extensions: `php -m | grep curl`
3. Check Composer: `composer --version`
4. Check packages: `composer show`
5. Check logs: `storage/logs/laravel.log`

### Common Issues & Solutions

| Issue | Solution |
|-------|----------|
| GuzzleHttp not found | `composer require guzzlehttp/guzzle` |
| cURL error | Enable curl di php.ini |
| Autoload error | `composer dump-autoload` |
| Port already in use | `php artisan serve --port=8001` |
| Database error | Check `.env` DB credentials |

---

## 🎯 Next Steps

1. ✅ Verify all dependencies installed
2. ✅ Check all PHP extensions enabled
3. ✅ Run Laravel migrations (if needed)
4. ✅ Setup reCAPTCHA keys (see RECAPTCHA_SETUP.md)
5. ✅ Test login page locally
6. ✅ Run testing checklist (see TESTING_SECURITY_CHECKLIST.md)

---

**Generated**: 13 Januari 2026  
**Version**: 1.0  
**Status**: Ready for Deployment
