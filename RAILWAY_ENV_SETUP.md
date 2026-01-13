# Railway Environment Variables Setup

Copy and paste these to Railway → Settings → Variables:

```bash
# Application
APP_NAME=Wisata
APP_ENV=production
APP_DEBUG=false
APP_URL=https://your-app.railway.app
APP_TIMEZONE=UTC

# Database (Get from Railway MySQL after you add it)
DB_CONNECTION=mysql
DB_HOST=containers-us-west-xxx.railway.app
DB_PORT=3306
DB_DATABASE=railway
DB_USERNAME=root
DB_PASSWORD=your_mysql_password_here

# Caching
CACHE_DRIVER=file
QUEUE_CONNECTION=sync

# JWT
JWT_SECRET=your_32_character_secret_key
JWT_ALGO=HS256
```

## Generate Keys:

### APP_KEY:
```bash
php -r "echo 'base64:' . base64_encode(random_bytes(32)) . PHP_EOL;"
```

### JWT_SECRET:
```bash
php -r "echo bin2hex(random_bytes(16)) . PHP_EOL;"
```

## Steps:

1. **Add MySQL Database in Railway:**
   - Click "New" → "Database" → "Add MySQL"
   - Wait for provisioning
   - Copy the database credentials

2. **Set all environment variables above**

3. **Generate and set APP_KEY and JWT_SECRET**

4. **Deploy will auto-trigger**

5. **Test endpoints:**
   - `/test.php` - Should show "OK - PHP is working"
   - `/check.php` - Should show all environment variables
   - `/api/login` - Should work for login
