# 🚀 Panduan Lengkap Deploy ke Railway

## ✅ File Konfigurasi yang Sudah Siap:
- ✅ `Procfile` - Command untuk menjalankan aplikasi
- ✅ `nixpacks.toml` - Build configuration untuk Railway
- ✅ `railway.json` - Railway specific configuration
- ✅ `start.sh` - Script untuk setup dan start aplikasi
- ✅ `.env.example` - Template environment variables
- ✅ `.gitignore` - Ignore files yang tidak perlu di-deploy

## 📋 Langkah-Langkah Deploy:

### 1️⃣ Push Code ke GitHub (jika belum)

```bash
# Initialize Git (jika belum)
git init

# Add semua file
git add .

# Commit
git commit -m "Setup untuk Railway deployment"

# Set branch ke main
git branch -M main

# Add remote repository (ganti dengan URL repo Anda)
git remote add origin https://github.com/USERNAME/REPO_NAME.git

# Push ke GitHub
git push -u origin main
```

### 2️⃣ Buat Project di Railway

1. Login ke https://railway.app
2. Klik **"New Project"**
3. Pilih **"Deploy from GitHub repo"**
4. Pilih repository Anda
5. Railway akan otomatis detect dan mulai build

### 3️⃣ Tambahkan MySQL Database

1. Di Railway dashboard project Anda, klik tombol **"+ New"**
2. Pilih **"Database"** → **"Add MySQL"**
3. Tunggu hingga database selesai provisioning (biasanya 1-2 menit)
4. Klik database yang baru dibuat untuk melihat credentials

### 4️⃣ Set Environment Variables

1. Kembali ke service aplikasi Anda (bukan database)
2. Klik tab **"Variables"**
3. Klik **"Add Variable"** atau **"Raw Editor"**
4. Copy paste konfigurasi berikut:

```env
APP_NAME=Wisata
APP_ENV=production
APP_DEBUG=false
APP_TIMEZONE=UTC

# Database - akan otomatis tersedia dari Railway MySQL
DB_CONNECTION=mysql
DB_HOST=${{MYSQL_HOST}}
DB_PORT=${{MYSQL_PORT}}
DB_DATABASE=${{MYSQL_DATABASE}}
DB_USERNAME=${{MYSQL_USER}}
DB_PASSWORD=${{MYSQL_PASSWORD}}

# Caching
CACHE_DRIVER=file
QUEUE_CONNECTION=sync
```

5. **Generate APP_KEY**:
   - Buka terminal lokal Anda
   - Jalankan: `php artisan key:generate --show`
   - Copy hasilnya (contoh: `base64:xxxxxxxxxxxxxxxxxxxxx`)
   - Tambahkan variable baru di Railway:
     ```
     APP_KEY=base64:xxxxxxxxxxxxxxxxxxxxx
     ```

6. **Generate JWT_SECRET**:
   - Jalankan: `php artisan jwt:secret --show`
   - Atau generate random 32 karakter
   - Tambahkan variable:
     ```
     JWT_SECRET=your_32_character_secret_here
     JWT_ALGO=HS256
     ```

7. Klik **"Save Changes"** atau Railway akan auto-save

### 5️⃣ Deploy dan Generate Domain

1. Railway akan otomatis deploy ulang setelah environment variables disimpan
2. Tunggu hingga build selesai (monitor di tab **"Deployments"**)
3. Setelah status jadi **"Active"**:
   - Klik tab **"Settings"**
   - Scroll ke bagian **"Networking"**
   - Klik **"Generate Domain"**
   - Copy domain yang di-generate (contoh: `your-app.up.railway.app`)

4. **Update APP_URL**:
   - Kembali ke tab **"Variables"**
   - Edit variable `APP_URL`
   - Ubah menjadi: `https://your-app.up.railway.app`
   - Railway akan auto-redeploy

### 6️⃣ Run Database Migration

Ada 2 cara:

**Cara 1: Otomatis saat deploy**
1. Tambahkan variable baru:
   ```
   RUN_MIGRATIONS=true
   ```
2. Railway akan auto-redeploy dan run migrations

**Cara 2: Manual via Railway CLI**
1. Install Railway CLI: https://docs.railway.app/develop/cli
2. Login: `railway login`
3. Link ke project: `railway link`
4. Run migration: `railway run php artisan migrate --force`

### 7️⃣ Test Aplikasi

Buka URL aplikasi Anda dan test endpoints:

```bash
# Test PHP
https://your-app.up.railway.app/test.php
# Response: "OK - PHP is working"

# Test Environment
https://your-app.up.railway.app/check.php
# Response: JSON dengan environment variables

# Test Login API
POST https://your-app.up.railway.app/api/login
Content-Type: application/json

{
    "email": "admin@admin.com",
    "password": "admin"
}
```

## 🔧 Troubleshooting

### Build Gagal
- **Cek logs**: Klik tab "Deployments" → pilih deployment yang gagal → lihat logs
- **Pastikan file ada**: `Procfile`, `nixpacks.toml`, `railway.json`, `start.sh`
- **Cek composer.json**: Pastikan semua dependencies valid

### Database Connection Error
- **Pastikan MySQL sudah dibuat** di Railway
- **Cek variables**: `DB_HOST`, `DB_PORT`, `DB_DATABASE`, `DB_USERNAME`, `DB_PASSWORD` harus ada
- **Format variable**: Gunakan `${{MYSQL_HOST}}` bukan `${MYSQL_HOST}`

### Application Error / 500
- **Cek APP_KEY**: Pastikan sudah di-generate dan diisi
- **Cek JWT_SECRET**: Pastikan sudah diisi
- **Lihat logs**: Railway dashboard → "Deployments" → "View Logs"

### Migration Gagal
- **Cek koneksi database** terlebih dahulu
- **Run manual**: Gunakan Railway CLI untuk run migration manual
- **Cek migration files**: Pastikan tidak ada syntax error

### Port Issues
- Railway akan otomatis set environment variable `PORT`
- Script `start.sh` sudah dikonfigurasi untuk detect port otomatis
- Tidak perlu set PORT manual

## 📱 Monitoring

### View Logs Real-time
1. Railway Dashboard → Your Service
2. Tab "Deployments"
3. Klik deployment yang aktif
4. Klik "View Logs"

### Check Service Health
- Railway akan otomatis restart jika service crash
- Health check bisa dilakukan via endpoint `/health.php` atau `/test.php`

## 🔄 Update Aplikasi

Setiap kali push ke GitHub branch main:
1. Railway akan otomatis detect perubahan
2. Trigger build baru
3. Deploy versi terbaru
4. Zero downtime deployment

```bash
# Update code
git add .
git commit -m "Update fitur XYZ"
git push origin main

# Railway akan otomatis deploy
```

## 💡 Tips

1. **Gunakan Environment Variables** untuk semua konfigurasi
2. **Jangan commit `.env`** ke Git
3. **Monitor logs** saat pertama kali deploy
4. **Set `APP_DEBUG=false`** di production
5. **Backup database** secara berkala
6. **Gunakan migration** untuk perubahan database schema

## 📞 Support

- Railway Docs: https://docs.railway.app
- Railway Discord: https://discord.gg/railway
- GitHub Issues: Buat issue di repository project Anda

---

**Happy Deploying! 🚀**
