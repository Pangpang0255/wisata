# 🏝️ Aplikasi Wisata Indonesia - Panduan Penggunaan

## 📋 Deskripsi
Aplikasi web untuk mengelola data wisata Indonesia dengan fitur CRUD (Create, Read, Update, Delete) lengkap, autentikasi JWT, dan tampilan web yang modern.

## 🚀 Cara Menjalankan

### 1. Pastikan Server Berjalan
```bash
php -S localhost:8000 -t public
```

### 2. Akses Aplikasi
Buka browser dan kunjungi:
```
http://localhost:8000
```

## 🔐 Login

### Credentials Default
Gunakan kredensial yang sudah Anda buat di database untuk login:
- **Email**: (email user yang terdaftar di database)
- **Password**: (password yang sudah di-hash di database)

Jika belum ada user, Anda perlu membuat user baru melalui API atau seeder.

## 📱 Fitur Aplikasi

### 1. **Halaman Login** (`/`)
- Form login dengan validasi
- Autentikasi menggunakan JWT token
- Auto-redirect jika sudah login

### 2. **Dashboard** (`/dashboard`)
- Statistik data wisata:
  - Total destinasi wisata
  - Total kota
  - Rata-rata tarif
- Tabel data wisata dengan fitur:
  - **Search**: Cari berdasarkan kota atau landmark
  - **Add**: Tambah data wisata baru
  - **Edit**: Update data wisata
  - **Delete**: Hapus data wisata
- Responsive design

## 🛠️ Teknologi yang Digunakan

### Backend
- **Lumen** (Laravel micro-framework)
- **JWT Authentication** (tymon/jwt-auth)
- **MySQL Database**

### Frontend
- **HTML5**
- **CSS3** (dengan Gradient & Modern Design)
- **JavaScript Vanilla** (Fetch API)
- **Blade Template Engine**

## 📊 API Endpoints

### Authentication
- `POST /api/login` - Login dan dapatkan token
- `POST /api/logout` - Logout
- `POST /api/refresh` - Refresh token
- `POST /api/user-profile` - Get user profile

### Wisata CRUD
- `GET /api/wisata` - Get semua data wisata
- `GET /api/wisata/{id}` - Get data wisata by ID
- `POST /api/wisata` - Create data wisata baru
- `PUT /api/wisata/{id}` - Update data wisata
- `DELETE /api/wisata/{id}` - Delete data wisata

**Note**: Semua endpoint wisata memerlukan Bearer Token di header

## 🎨 Struktur File Views

```
resources/views/
├── layout.blade.php      # Template utama
├── login.blade.php       # Halaman login
└── dashboard.blade.php   # Halaman dashboard
```

## 💡 Tips Penggunaan

1. **Token Expired**: Jika mendapat error 401, logout dan login kembali
2. **Search**: Ketik di search box untuk filter data real-time
3. **Modal Form**: Klik di luar modal untuk menutup
4. **Validasi**: Semua field wajib diisi sebelum submit

## 🐛 Troubleshooting

### Error: "Class 'Illuminate\Support\Facades\View' not found"
Pastikan sudah menjalankan:
```bash
composer install
```

### Error: "SQLSTATE[HY000] [1045] Access denied"
Periksa konfigurasi database di file `.env`

### Error: "The page isn't redirecting properly"
Clear localStorage browser:
```javascript
// Jalankan di Console Browser
localStorage.clear()
```

### View tidak muncul
Pastikan:
1. File `config/view.php` sudah dibuat
2. Bootstrap/app.php sudah di-configure dengan `$app->configure('view')`
3. Folder `storage/framework/views` memiliki permission write

## 📝 Catatan Penting

- Aplikasi ini menggunakan localStorage untuk menyimpan token
- Token disimpan di browser, logout untuk menghapus
- Semua request API menggunakan JSON format
- CORS sudah di-handle oleh package fruitcake/laravel-cors

## 🎯 Fitur Mendatang (Opsional)

- [ ] Upload gambar wisata
- [ ] Rating dan review
- [ ] Export data ke Excel/PDF
- [ ] Filter berdasarkan range tarif
- [ ] Pagination untuk data besar
- [ ] Dark mode toggle

## 📞 Support

Jika ada pertanyaan atau issue, silakan hubungi developer atau buat issue di repository.

---
**Happy Coding! 🚀**
