#!/bin/sh
set -e

echo "Starting deployment setup..."

# Create necessary directories
echo "Creating storage directories..."
mkdir -p storage/framework/cache/data
mkdir -p storage/framework/views  
mkdir -p storage/framework/sessions
mkdir -p storage/logs
mkdir -p bootstrap/cache

# Set permissions
echo "Setting permissions..."
chmod -R 775 storage
chmod -R 775 bootstrap/cache

# Create .env from environment variables if not exists
if [ ! -f .env ]; then
    echo "Creating .env from environment variables..."
    cat > .env << EOF
APP_NAME=\${APP_NAME:-Wisata}
APP_ENV=\${APP_ENV:-production}
APP_KEY=\${APP_KEY:-}
APP_DEBUG=\${APP_DEBUG:-false}
APP_URL=\${APP_URL:-http://localhost}
APP_TIMEZONE=\${APP_TIMEZONE:-UTC}

LOG_CHANNEL=stack

DB_CONNECTION=\${DB_CONNECTION:-mysql}
DB_HOST=\${DB_HOST:-127.0.0.1}
DB_PORT=\${DB_PORT:-3306}
DB_DATABASE=\${DB_DATABASE:-railway}
DB_USERNAME=\${DB_USERNAME:-root}
DB_PASSWORD=\${DB_PASSWORD:-}

CACHE_DRIVER=\${CACHE_DRIVER:-file}
QUEUE_CONNECTION=\${QUEUE_CONNECTION:-sync}

JWT_SECRET=\${JWT_SECRET:-}
JWT_ALGO=\${JWT_ALGO:-HS256}
EOF
    echo ".env file created"
fi

# Test PHP
echo "Testing PHP..."
php -v

# List files for debugging
echo "Listing public directory..."
ls -la public/

echo "Starting PHP server on port \${PORT:-8080}..."
# Use exec to replace shell with PHP process
exec php -S 0.0.0.0:${PORT:-8080} -t public
