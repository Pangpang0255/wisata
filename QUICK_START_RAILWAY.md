# 🚀 Quick Start - Deploy ke Railway

## Step 1: Push ke GitHub
```bash
git add .
git commit -m "Setup Railway deployment"
git push origin main
```

## Step 2: Deploy di Railway
1. Login ke https://railway.app
2. **New Project** → **Deploy from GitHub repo**
3. Pilih repository Anda

## Step 3: Tambah MySQL Database
1. Klik **"+ New"** → **Database** → **Add MySQL**
2. Tunggu provisioning selesai

## Step 4: Set Environment Variables
Di tab **Variables**, tambahkan:

```env
APP_ENV=production
APP_DEBUG=false

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

## Step 5: Generate Keys

**Generate APP_KEY** (di terminal lokal):
```bash
php artisan key:generate --show
```
Tambahkan ke Railway Variables:
```env
APP_KEY=base64:xxxxxxxxxxxxxx
```

**Generate JWT_SECRET**:
```bash
php artisan jwt:secret --show
```
Tambahkan ke Railway Variables:
```env
JWT_SECRET=xxxxxxxxxxxxxxxx
```

## Step 6: Generate Domain
1. Tab **Settings** → **Networking**
2. Klik **Generate Domain**
3. Copy URL (contoh: `your-app.up.railway.app`)

Update variable:
```env
APP_URL=https://your-app.up.railway.app
```

## Step 7: Run Migration
Tambahkan variable:
```env
RUN_MIGRATIONS=true
```
Railway akan auto-redeploy dan run migrations.

## ✅ Test
- `https://your-app.up.railway.app/test.php` - Should return "OK"
- `https://your-app.up.railway.app/health.php` - Health check
- `https://your-app.up.railway.app/api/login` - API endpoint

---

**📖 Panduan lengkap**: Lihat [DEPLOY_RAILWAY_LENGKAP.md](DEPLOY_RAILWAY_LENGKAP.md)

**🔧 Troubleshooting**: 
- Cek logs di Railway Dashboard → Deployments → View Logs
- Pastikan semua environment variables sudah diisi
- Pastikan MySQL database sudah dibuat
