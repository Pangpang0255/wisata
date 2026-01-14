# 🧪 Quick Start - Unit Testing

## ✅ Yang Sudah Dibuat:

1. ✅ **Test Cases**:
   - `tests/AuthTest.php` - 8 authentication tests
   - `tests/WisataTest.php` - 12 wisata CRUD tests
   - `tests/ExampleTest.php` - Example test

2. ✅ **Test Runners**:
   - `run-tests.bat` - Windows batch script
   - `run-tests.php` - Cross-platform PHP script
   - `phpunit.xml` - PHPUnit configuration

3. ✅ **Web Interface** (Recommended!):
   - `public/test-ui.html` - Beautiful web interface
   - `public/test-runner.php` - Backend API

4. ✅ **Configuration**:
   - `.env.testing` - Test environment config

5. ✅ **Documentation**:
   - `TESTING_GUIDE.md` - Complete guide

---

## 🚀 Mulai Testing (3 Cara):

### 🌟 Cara 1: Web Interface (PALING MUDAH!)

1. **Start server** (jika belum running):
   ```bash
   php -S localhost:8080 -t public
   ```

2. **Buka browser**:
   ```
   http://localhost:8080/test-ui.html
   ```

3. **Click tombol**:
   - `▶️ Run All Tests` - Jalankan semua
   - `🔐 Run Auth Tests` - Test login/auth
   - `🏖️ Run Wisata Tests` - Test CRUD wisata

**✨ Fitur**: Tampilan cantik, real-time, statistik lengkap!

---

### 💻 Cara 2: Windows Command Line

```bash
# Double click atau run di PowerShell:
.\run-tests.bat

# Atau menggunakan PHP:
php run-tests.php
```

---

### ⚡ Cara 3: PHPUnit Langsung

```bash
# Run all tests
php vendor/bin/phpunit

# Run with beautiful output
php vendor/bin/phpunit --testdox

# Run specific test file
php vendor/bin/phpunit tests/AuthTest.php

# Run specific test
php vendor/bin/phpunit --filter test_login_with_valid_credentials
```

---

## 📊 Apa Yang Ditest?

### 🔐 Authentication Tests (8 tests):
- ✅ Login dengan credentials benar
- ❌ Login dengan credentials salah
- ❌ Login tanpa email
- ❌ Login tanpa password
- ✅ Get user profile dengan token
- ❌ Get profile tanpa token
- ✅ Refresh JWT token
- ✅ Logout

### 🏖️ Wisata CRUD Tests (12 tests):
- ✅ Get all wisata (public)
- ✅ Get single wisata by ID
- ❌ Get wisata yang tidak ada
- ✅ Create wisata (admin only)
- ❌ Create tanpa auth
- ❌ Create dengan data tidak lengkap
- ✅ Update wisata
- ❌ Update wisata tidak ada
- ❌ Update tanpa auth
- ✅ Delete wisata
- ❌ Delete wisata tidak ada
- ❌ Delete tanpa auth

---

## 🎯 Expected Results:

```
✅ ALL TESTS SHOULD PASS!

Total: 20+ tests
Passed: 20+ tests
Failed: 0 tests
Time: ~2-5 seconds
```

---

## 🐛 Troubleshooting:

### Problem: PHPUnit not found
**Solution**:
```bash
composer install
```

### Problem: Database error
**Solution**: Tests menggunakan SQLite in-memory, tidak perlu setup database!

### Problem: Seeder not found
**Solution**:
```bash
composer dump-autoload
```

### Problem: Web interface tidak loading
**Solution**:
1. Start PHP server: `php -S localhost:8080 -t public`
2. Cek URL: `http://localhost:8080/test-ui.html`

---

## 📸 Preview Web Interface:

```
╔═══════════════════════════════════════════════════╗
║       🧪 Unit Testing Dashboard                   ║
║       Wisata API Testing Interface                ║
╚═══════════════════════════════════════════════════╝

[▶️ Run All Tests] [🔐 Auth Tests] [🏖️ Wisata Tests]

📊 Test Results
┌─────────────┬─────────────┬─────────────┐
│ Total: 20   │ Passed: 20  │ Failed: 0   │
└─────────────┴─────────────┴─────────────┘

✅ ALL TESTS PASSED!
```

---

## 📚 Dokumentasi Lengkap:

Baca **[TESTING_GUIDE.md](TESTING_GUIDE.md)** untuk:
- Detailed test coverage
- How to write new tests
- CI/CD integration
- Best practices

---

## 🎉 Ready to Test!

**Start here**: Open `http://localhost:8080/test-ui.html`

**Happy Testing! 🧪✨**
