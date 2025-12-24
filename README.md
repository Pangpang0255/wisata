# 🏝️ Aplikasi Wisata Indonesia

Aplikasi RESTful API untuk manajemen data wisata menggunakan Lumen Framework dengan JWT Authentication.

## ✨ Status: FULLY FUNCTIONAL ✅

Semua fitur berfungsi dengan sempurna!

---

## 🚀 Quick Start

### 1. Start Server
```bash
php artisan serve --host=127.0.0.1 --port=8000
```

### 2. Akses Aplikasi
- **Testing Dashboard:** http://127.0.0.1:8000/test.html ⭐ (Recommended)
- **Admin Login:** http://127.0.0.1:8000/login
- **API Base:** http://127.0.0.1:8000/api

### 3. Login Credentials
- Email: `admin@gmail.com`
- Password: `admin`

---

## 📚 Dokumentasi Lengkap

- **[CARA_PAKAI.md](CARA_PAKAI.md)** - Panduan penggunaan cepat
- **[HASIL_ANALISA.md](HASIL_ANALISA.md)** - Dokumentasi API lengkap & troubleshooting
- **[PANDUAN_WEB.md](PANDUAN_WEB.md)** - Panduan web original
- **[SERVE.md](SERVE.md)** - Cara menjalankan server

---

## 🎯 Fitur Utama

### API Features
- ✅ JWT Authentication (Login, Logout, Refresh Token)
- ✅ CRUD Wisata (Create, Read, Update, Delete)
- ✅ Advanced Filtering (nama, lokasi, kategori, harga, rating)
- ✅ Pagination
- ✅ Public & Protected Endpoints

### Web Features
- ✅ Admin Dashboard
- ✅ Login Page dengan desain modern
- ✅ Interactive API Testing Dashboard
- ✅ Responsive Design

---

## 📡 API Endpoints

### Public (No Auth Required)
```
GET /api/wisata           - Get all wisata
GET /api/wisata/{id}      - Get single wisata
```

### Protected (Auth Required)
```
POST   /api/login         - Login
POST   /api/logout        - Logout
POST   /api/refresh       - Refresh token
POST   /api/user-profile  - Get user profile
POST   /api/wisata        - Create wisata
PUT    /api/wisata/{id}   - Update wisata
DELETE /api/wisata/{id}   - Delete wisata
```

---

## 🔧 Tech Stack

- **Framework:** Lumen 10.0.4 (Laravel Components ^10.0)
- **PHP:** ^8.1
- **Authentication:** JWT (tymon/jwt-auth ^2.2)
- **Database:** MySQL
- **Testing:** PHPUnit ^10.0

---

## 📁 Project Structure

```
wisata/
├── app/
│   ├── Http/Controllers/
│   │   ├── AuthController.php      - JWT Authentication
│   │   ├── WisataController.php    - CRUD Operations
│   │   └── WebController.php       - Web Views
│   └── Models/
│       ├── User.php                - User Model (JWT)
│       └── Wisata.php              - Wisata Model
├── routes/
│   └── web.php                     - All Routes
├── resources/views/
│   ├── login.blade.php             - Login Page
│   └── dashboard.blade.php         - Dashboard
├── public/
│   └── test.html                   - API Testing Dashboard
└── database/
    ├── migrations/
    └── seeders/
```

---

## 🎨 Testing Dashboard Features

Akses: `http://127.0.0.1:8000/test.html`

- 🔐 Login with token display
- 📋 Get all wisata
- 🔍 Get single wisata
- ➕ Create new wisata
- ✏️ Update existing wisata
- 🗑️ Delete wisata
- 👤 Get user profile
- 🚪 Logout

Real-time response display dengan syntax highlighting!

---

## 🛠️ Installation

```bash
# 1. Install dependencies
composer install

# 2. Setup environment
cp .env.example .env
php artisan jwt:secret

# 3. Configure database in .env
DB_DATABASE=rekayasa_web
DB_USERNAME=root
DB_PASSWORD=

# 4. Run migrations & seeders
php artisan migrate
php artisan db:seed

# 5. Start server
php artisan serve
```

---

## 🔒 Security

- Password hashing dengan bcrypt
- JWT token dengan expiration (24 hours)
- Protected endpoints require Bearer token
- Input validation pada semua POST/PUT requests

---

## 📱 Response Examples

### Login Success
```json
{
  "access_token": "eyJ0eXAiOiJKV1QiLCJhbGc...",
  "token_type": "bearer",
  "user": {
    "id": 1,
    "name": "admin",
    "email": "admin@gmail.com"
  },
  "expires_in": 86400
}
```

### Get Wisata (Paginated)
```json
{
  "current_page": 1,
  "data": [
    {
      "id": 1,
      "nama_wisata": "Pantai Kuta",
      "lokasi": "Bali",
      "kategori": "Pantai",
      "harga_tiket": 50000,
      "rating": 4.5
    }
  ],
  "per_page": 10,
  "total": 50
}
```

---

## 🐛 Troubleshooting

### Port Already in Use
```bash
netstat -ano | findstr :8000
taskkill /PID {PID} /F
```

### Cannot Login
```bash
php artisan db:seed --class=UsersTableSeeder
```

### JWT Error
```bash
php artisan jwt:secret
```

Lihat [HASIL_ANALISA.md](HASIL_ANALISA.md) untuk troubleshooting lengkap.

---

## 👨‍💻 Development

### Changelog
- **Dec 9, 2025:** Fixed authentication middleware for public wisata endpoints
- **Dec 9, 2025:** Added interactive API testing dashboard
- **Dec 9, 2025:** Comprehensive documentation

### Contributors
- Backend API Development
- JWT Authentication Implementation
- Web Interface Design
- Documentation & Testing

---

## 📄 License

The Lumen framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

---

## 🎉 Ready to Use!

**Aplikasi siap digunakan tanpa error!**

1. Start server: `php artisan serve`
2. Open: `http://127.0.0.1:8000/test.html`
3. Click "Login"
4. Enjoy! 🚀

---

_Last Updated: December 9, 2025_
