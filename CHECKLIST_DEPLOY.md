# 🎯 CHECKLIST DEPLOY KE RAILWAY

Ikuti checklist ini langkah demi langkah untuk deploy aplikasi ke Railway.

## ✅ Persiapan Lokal (SELESAI)

- [x] **Procfile** - Created ✅
- [x] **nixpacks.toml** - Created ✅
- [x] **railway.json** - Created ✅
- [x] **start.sh** - Updated ✅
- [x] **.env.example** - Ready ✅
- [x] **Storage folders** - .gitkeep files added ✅
- [x] **Documentation** - QUICK_START_RAILWAY.md, DEPLOY_RAILWAY_LENGKAP.md ✅

**Status**: ✅ APLIKASI SIAP DEPLOY!

---

## 📝 Yang Harus Anda Lakukan:

### □ 1. Push ke GitHub

```bash
# Di terminal lokal, jalankan:
git add .
git commit -m "Setup untuk Railway deployment"
git push origin main
```

**✅ Selesai?** Lanjut ke langkah 2

---

### □ 2. Buat Project di Railway

1. Buka browser, login ke: **https://railway.app**
2. Klik tombol **"New Project"**
3. Pilih **"Deploy from GitHub repo"**
4. Pilih repository: **wisata**
5. Railway akan mulai build otomatis

**✅ Build berhasil?** Lanjut ke langkah 3

---

### □ 3. Tambah MySQL Database

1. Di Railway dashboard, klik tombol **"+ New"**
2. Pilih **"Database"**
3. Klik **"Add MySQL"**
4. Tunggu 1-2 menit hingga status **"Active"**

**✅ MySQL Active?** Lanjut ke langkah 4

---

### □ 4. Generate APP_KEY

**Di terminal lokal Anda**, jalankan:

```bash
php artisan key:generate --show
```

**Contoh hasil**: `base64:vG6wH3q1F8mN9kL2pR5tY7uW0xE3sD6fJ4hK8lM1nP0=`

**Copy hasilnya!** Anda akan memerlukannya di langkah berikutnya.

**✅ APP_KEY di-copy?** Lanjut ke langkah 5

---

### □ 5. Generate JWT_SECRET

**Di terminal lokal Anda**, jalankan:

```bash
php artisan jwt:secret --show
```

**Contoh hasil**: `a1b2c3d4e5f6g7h8i9j0k1l2m3n4o5p6`

**Copy hasilnya!** Anda akan memerlukannya di langkah berikutnya.

**✅ JWT_SECRET di-copy?** Lanjut ke langkah 6

---

### □ 6. Set Environment Variables di Railway

1. Di Railway dashboard, **klik service aplikasi Anda** (bukan database)
2. Klik tab **"Variables"**
3. Klik **"Raw Editor"** (di pojok kanan atas)
4. **HAPUS semua** yang ada
5. **Copy-paste** konfigurasi berikut:

```env
APP_NAME=Wisata
APP_ENV=production
APP_DEBUG=false
APP_TIMEZONE=UTC

DB_CONNECTION=mysql
DB_HOST=${{MYSQL_HOST}}
DB_PORT=${{MYSQL_PORT}}
DB_DATABASE=${{MYSQL_DATABASE}}
DB_USERNAME=${{MYSQL_USER}}
DB_PASSWORD=${{MYSQL_PASSWORD}}

CACHE_DRIVER=file
QUEUE_CONNECTION=sync
JWT_ALGO=HS256
```

6. **Tambahkan** dua variable ini (ganti dengan hasil generate Anda):

```env
APP_KEY=base64:vG6wH3q1F8mN9kL2pR5tY7uW0xE3sD6fJ4hK8lM1nP0=
JWT_SECRET=a1b2c3d4e5f6g7h8i9j0k1l2m3n4o5p6
```

7. Railway akan **auto-save** dan **redeploy**
8. Tunggu hingga deploy selesai (status: **"Active"**)

**✅ Deploy berhasil?** Lanjut ke langkah 7

---

### □ 7. Generate Public Domain

1. Di Railway dashboard, klik service aplikasi Anda
2. Klik tab **"Settings"**
3. Scroll ke bagian **"Networking"**
4. Klik tombol **"Generate Domain"**
5. **Copy URL** yang muncul (contoh: `wisata-production.up.railway.app`)

**✅ Domain di-copy?** Lanjut ke langkah 8

---

### □ 8. Update APP_URL

1. Kembali ke tab **"Variables"**
2. Tambahkan variable baru:

```env
APP_URL=https://wisata-production.up.railway.app
```

**(Ganti dengan domain Railway Anda!)**

3. Railway akan **auto-redeploy**
4. Tunggu hingga selesai (status: **"Active"**)

**✅ Redeploy berhasil?** Lanjut ke langkah 9

---

### □ 9. Run Database Migrations

1. Di tab **"Variables"**, tambahkan:

```env
RUN_MIGRATIONS=true
```

2. Railway akan **auto-redeploy** dan menjalankan migrations
3. Tunggu hingga selesai (status: **"Active"**)
4. **Cek logs**: Tab "Deployments" → Klik deployment terakhir → "View Logs"
5. Pastikan ada log: `Running migrations...`

**✅ Migrations berhasil?** Lanjut ke langkah 10

---

### □ 10. Test Aplikasi

Buka browser dan test URL berikut (ganti dengan domain Anda):

**Test 1: PHP Working**
```
https://wisata-production.up.railway.app/test.php
```
✅ **Harus muncul**: `OK - PHP is working`

**Test 2: Health Check**
```
https://wisata-production.up.railway.app/health.php
```
✅ **Harus ada**: `"status": "healthy"`

**Test 3: API Login (gunakan Postman/Insomnia)**
```
POST https://wisata-production.up.railway.app/api/login
Content-Type: application/json

{
  "email": "admin@admin.com",
  "password": "admin"
}
```
✅ **Harus dapat**: JWT token

---

## 🎉 SELESAI!

Jika semua test di atas berhasil, aplikasi Anda sudah **LIVE** di Railway! 🚀

---

## ❌ Jika Ada Error:

### Error: Build Failed
1. Cek tab **"Deployments"** → **"View Logs"**
2. Screenshot error dan hubungi support

### Error: Database Connection
1. Pastikan MySQL database sudah **Active**
2. Pastikan variables `DB_HOST`, `DB_PORT`, dll menggunakan format `${{MYSQL_HOST}}`
3. Cek di tab **"Variables"** bahwa MySQL variables tersedia

### Error: 500 Internal Server Error
1. Cek logs: Tab "Deployments" → "View Logs"
2. Pastikan `APP_KEY` dan `JWT_SECRET` sudah diisi
3. Pastikan format `APP_KEY` dimulai dengan `base64:`

### Error: Migrations Gagal
1. Hapus variable `RUN_MIGRATIONS`
2. Install Railway CLI: https://docs.railway.app/develop/cli
3. Run manual:
   ```bash
   railway login
   railway link
   railway run php artisan migrate --force
   ```

---

## 📚 Dokumentasi Lengkap:

- **Quick Start**: [QUICK_START_RAILWAY.md](QUICK_START_RAILWAY.md)
- **Panduan Lengkap**: [DEPLOY_RAILWAY_LENGKAP.md](DEPLOY_RAILWAY_LENGKAP.md)
- **Status Ready**: [RAILWAY_READY.md](RAILWAY_READY.md)

---

**Good luck! 🚀**
