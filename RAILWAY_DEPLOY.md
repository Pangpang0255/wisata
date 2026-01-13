# 🚀 Railway Deployment Guide

## File Konfigurasi yang Sudah Dibuat:
- ✅ `Procfile` - Command untuk menjalankan aplikasi
- ✅ `nixpacks.toml` - Build configuration untuk Railway
- ✅ `railway.json` - Railway specific configuration
- ✅ `.env.example` - Template environment variables
- ✅ `.gitignore` - Ignore files yang tidak perlu di-deploy
- ✅ Storage folders dengan .gitkeep

## 📋 Langkah Deploy ke Railway:

### 1. Push ke GitHub/GitLab (jika belum)
```bash
git init
git add .
git commit -m "Setup Railway deployment"
git branch -M main
git remote add origin YOUR_REPO_URL
git push -u origin main
```

### 2. Buat Project di Railway
1. Login ke https://railway.app
2. Klik "New Project"
3. Pilih "Deploy from GitHub repo"
4. Pilih repository Anda
5. Railway akan otomatis detect dan build

### 3. Tambahkan MySQL Database
1. Di Railway dashboard, klik "New" → "Database" → "Add MySQL"
2. Tunggu hingga database selesai provisioning
3. Database variables akan otomatis tersedia

### 4. Set Environment Variables
Buka Settings → Variables, tambahkan:

**Required:**
```
APP_NAME=Wisata
APP_ENV=production
APP_DEBUG=false
APP_KEY=base64:GENERATE_THIS_KEY
APP_URL=${{RAILWAY_PUBLIC_DOMAIN}}

DB_CONNECTION=mysql
DB_HOST=${{MYSQL_HOST}}
DB_PORT=${{MYSQL_PORT}}
DB_DATABASE=${{MYSQL_DATABASE}}
DB_USERNAME=${{MYSQL_USER}}
DB_PASSWORD=${{MYSQL_PASSWORD}}

JWT_SECRET=YOUR_JWT_SECRET_HERE
JWT_ALGO=HS256
```

**Generate APP_KEY:**
Jalankan di terminal lokal:
```bash
php artisan key:generate --show
```
Copy hasilnya ke APP_KEY

**Generate JWT_SECRET:**
```bash
php artisan jwt:secret --show
```
Atau generate random string 32 karakter

### 5. Database Migration
Setelah deploy sukses, buka "Settings" → "Variables" → Add variable:
```
RUN_MIGRATIONS=true
```

Atau jalankan manual via Railway CLI:
```bash
railway run php artisan migrate --force
```

### 6. Enable Public Networking
1. Buka "Settings" → "Networking"
2. Klik "Generate Domain"
3. Copy URL public domain Anda

### 7. Update APP_URL
Update variable APP_URL dengan domain Railway Anda:
```
APP_URL=https://your-app.up.railway.app
```

## 🔧 Troubleshooting

### Build Gagal
- Pastikan file `nixpacks.toml` dan `railway.json` ada di root project
- Check logs di Railway dashboard

### Database Connection Error
- Pastikan MySQL database sudah dibuat di Railway
- Pastikan semua DB_ variables sudah di-set dengan nilai dari Railway MySQL

### 500 Error
- Set APP_DEBUG=true sementara untuk lihat error detail
- Check logs: Railway Dashboard → Deployments → View Logs
- Pastikan storage folders writable

### Permission Issues
- Railway otomatis handle folder permissions
- Jika masih error, check storage/logs di Railway console

## 📝 Catatan Penting:
- Railway menggunakan Nixpacks untuk build (bukan Docker)
- PHP built-in server digunakan untuk production (sudah cukup untuk app kecil-menengah)
- Untuk production yang lebih robust, consider menggunakan nginx/apache
- Database akan persisten, tapi storage files akan reset tiap deploy

## 🔗 Useful Commands:

Install Railway CLI:
```bash
npm i -g @railway/cli
```

Login:
```bash
railway login
```

Link project:
```bash
railway link
```

Run commands:
```bash
railway run php artisan migrate
railway run php artisan db:seed
```

Open in browser:
```bash
railway open
```

## ✅ Deployment Checklist:
- [ ] Push code ke Git repository
- [ ] Buat project di Railway
- [ ] Add MySQL database
- [ ] Set environment variables (APP_KEY, JWT_SECRET, dll)
- [ ] Generate public domain
- [ ] Run migrations
- [ ] Test aplikasi di browser
- [ ] Set APP_DEBUG=false untuk production
