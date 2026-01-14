# 🧪 Unit Testing Documentation

## 📖 Overview

Aplikasi ini dilengkapi dengan **comprehensive unit testing** untuk memastikan semua fitur API berjalan dengan baik. Testing menggunakan **PHPUnit** dan mencakup:

- ✅ Authentication (Login, Logout, Token)
- ✅ Wisata CRUD Operations
- ✅ Authorization & Access Control
- ✅ Error Handling

## 📁 Struktur Test Files

```
tests/
├── TestCase.php          # Base test class
├── ExampleTest.php       # Example test
├── AuthTest.php          # Authentication tests (15 tests)
└── WisataTest.php        # Wisata CRUD tests (12 tests)

phpunit.xml               # PHPUnit configuration
run-tests.bat            # Windows test runner
run-tests.php            # Cross-platform test runner
public/
├── test-ui.html         # Web-based test interface
└── test-runner.php      # Test runner API
```

## 🚀 Cara Menjalankan Tests

### Opsi 1: Web Interface (Recommended) 🌐

1. **Start PHP Server** (jika belum):
   ```bash
   php -S localhost:8080 -t public
   ```

2. **Buka Browser**:
   ```
   http://localhost:8080/test-ui.html
   ```

3. **Click Button**:
   - `Run All Tests` - Jalankan semua test
   - `Run Auth Tests` - Hanya test authentication
   - `Run Wisata Tests` - Hanya test wisata CRUD
   - `Clear Results` - Bersihkan hasil

**✨ Fitur Web Interface**:
- Real-time test execution
- Beautiful visual display
- Test summary (Total, Passed, Failed)
- Color-coded results
- No terminal needed!

### Opsi 2: Command Line (Windows) 💻

```bash
# Cara 1: Using batch file
run-tests.bat

# Cara 2: Using PHP script
php run-tests.php

# Cara 3: Direct PHPUnit
php vendor/bin/phpunit

# Cara 4: With testdox (beautiful output)
php vendor/bin/phpunit --testdox

# Cara 5: Specific test file
php vendor/bin/phpunit tests/AuthTest.php

# Cara 6: Specific test method
php vendor/bin/phpunit --filter test_login_with_valid_credentials
```

### Opsi 3: Laravel Artisan (if available)

```bash
php artisan test
```

## 📊 Test Coverage

### Authentication Tests (AuthTest.php)

| Test Name | Description | Expected Result |
|-----------|-------------|-----------------|
| `test_login_with_valid_credentials` | Login dengan email dan password benar | ✅ Return JWT token |
| `test_login_with_invalid_credentials` | Login dengan credentials salah | ❌ Return 401 Unauthorized |
| `test_login_without_email` | Login tanpa email | ❌ Return 422 Validation Error |
| `test_login_without_password` | Login tanpa password | ❌ Return 422 Validation Error |
| `test_get_user_profile_with_valid_token` | Get profile dengan token valid | ✅ Return user data |
| `test_get_user_profile_without_token` | Get profile tanpa token | ❌ Return 401 Unauthorized |
| `test_refresh_token` | Refresh JWT token | ✅ Return new token |
| `test_logout` | Logout dengan token valid | ✅ Success message |

### Wisata Tests (WisataTest.php)

| Test Name | Description | Expected Result |
|-----------|-------------|-----------------|
| `test_get_all_wisata` | Get semua wisata (public) | ✅ Return array wisata |
| `test_get_single_wisata` | Get wisata by ID | ✅ Return wisata detail |
| `test_get_nonexistent_wisata` | Get wisata ID tidak ada | ❌ Return 404 Not Found |
| `test_create_wisata_as_admin` | Create wisata sebagai admin | ✅ Return created wisata |
| `test_create_wisata_without_auth` | Create tanpa authentication | ❌ Return 401 Unauthorized |
| `test_create_wisata_with_missing_fields` | Create dengan field tidak lengkap | ❌ Return 400 Bad Request |
| `test_update_wisata` | Update wisata dengan data valid | ✅ Return updated wisata |
| `test_update_nonexistent_wisata` | Update wisata tidak ada | ❌ Return 404 Not Found |
| `test_update_wisata_without_auth` | Update tanpa authentication | ❌ Return 401 Unauthorized |
| `test_delete_wisata` | Delete wisata | ✅ Success message |
| `test_delete_nonexistent_wisata` | Delete wisata tidak ada | ❌ Return 404 Not Found |
| `test_delete_wisata_without_auth` | Delete tanpa authentication | ❌ Return 401 Unauthorized |

## 🎯 Test Results Format

### Terminal Output
```
PHPUnit 10.x by Sebastian Bergmann and contributors.

Auth (Tests\AuthTest)
 ✔ Login with valid credentials
 ✔ Login with invalid credentials
 ✔ Login without email
 ✔ Login without password
 ✔ Get user profile with valid token
 ✔ Get user profile without token
 ✔ Refresh token
 ✔ Logout

Wisata (Tests\WisataTest)
 ✔ Get all wisata
 ✔ Get single wisata
 ✔ Get nonexistent wisata
 ✔ Create wisata as admin
 ✔ Create wisata without auth
 ✔ Create wisata with missing fields
 ✔ Update wisata
 ✔ Update nonexistent wisata
 ✔ Update wisata without auth
 ✔ Delete wisata
 ✔ Delete nonexistent wisata
 ✔ Delete wisata without auth

Time: 00:02.345, Memory: 20.00 MB

OK (20 tests, 45 assertions)
```

### Web Interface Output
- **Summary Cards**: Total Tests, Passed, Failed
- **Colored Output**: Green for passed, Red for failed
- **Detailed Logs**: Complete test execution logs
- **Timestamp**: When tests were run

## 🔧 Troubleshooting

### Error: "Class 'PHPUnit\Framework\TestCase' not found"
**Solution**: Install dependencies
```bash
composer install
```

### Error: "Database connection failed"
**Solution**: Check database configuration in `.env.testing` or use in-memory SQLite:
```env
DB_CONNECTION=sqlite
DB_DATABASE=:memory:
```

### Error: "Seeder class not found"
**Solution**: Make sure seeders exist and autoload is updated
```bash
composer dump-autoload
```

### Tests Running Slow
**Solution**: Use in-memory database for faster tests
```xml
<!-- In phpunit.xml -->
<env name="DB_CONNECTION" value="sqlite"/>
<env name="DB_DATABASE" value=":memory:"/>
```

### Web Interface Not Loading
**Solution**: 
1. Make sure PHP server is running
2. Check if `test-runner.php` is accessible
3. Check browser console for errors

## 📝 Membuat Test Baru

### 1. Create New Test File

```php
<?php

namespace Tests;

use Laravel\Lumen\Testing\DatabaseMigrations;

class NewFeatureTest extends TestCase
{
    use DatabaseMigrations;

    protected function setUp(): void
    {
        parent::setUp();
        // Setup code here
    }

    public function test_new_feature_works()
    {
        $response = $this->get('/api/endpoint');
        
        $response->assertResponseStatus(200);
        $response->seeJson(['key' => 'value']);
    }
}
```

### 2. Run Specific Test

```bash
php vendor/bin/phpunit tests/NewFeatureTest.php
```

## 🎨 Customization

### Modify Web Interface Colors

Edit `public/test-ui.html`, section `<style>`:
```css
.btn-primary {
    background: linear-gradient(135deg, #YOUR_COLOR 0%, #YOUR_COLOR2 100%);
}
```

### Add More Test Suites

Create new test files in `tests/` directory following naming convention: `*Test.php`

### Modify Test Output Format

Edit `run-tests.php` or `run-tests.bat` to customize output format.

## 📚 Best Practices

1. ✅ **Run tests before committing** code
2. ✅ **Write tests for new features** immediately
3. ✅ **Keep tests independent** (no dependencies between tests)
4. ✅ **Use descriptive test names** (test_what_should_happen_when_condition)
5. ✅ **Mock external services** if needed
6. ✅ **Use DatabaseMigrations** for clean test database
7. ✅ **Test both success and failure** scenarios
8. ✅ **Keep tests fast** (use in-memory database)

## 🚀 CI/CD Integration

### GitHub Actions Example

```yaml
name: Run Tests

on: [push, pull_request]

jobs:
  test:
    runs-on: ubuntu-latest
    steps:
      - uses: actions/checkout@v2
      - name: Setup PHP
        uses: shivammathur/setup-php@v2
        with:
          php-version: '8.2'
      - name: Install Dependencies
        run: composer install
      - name: Run Tests
        run: php vendor/bin/phpunit
```

## 📊 Test Metrics

- **Total Test Cases**: 27+
- **Total Assertions**: 45+
- **Code Coverage**: Run with `--coverage-html` to check
- **Average Execution Time**: ~2-5 seconds

## 🎯 Next Steps

1. ✅ Write more test cases for edge cases
2. ✅ Add integration tests
3. ✅ Implement code coverage reporting
4. ✅ Add performance tests
5. ✅ Setup automated testing in CI/CD

---

**Happy Testing! 🧪✨**
