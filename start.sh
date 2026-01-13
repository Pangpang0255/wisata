#!/bin/sh

# Create necessary directories
mkdir -p storage/framework/cache
mkdir -p storage/framework/views  
mkdir -p storage/framework/sessions
mkdir -p storage/logs
mkdir -p bootstrap/cache

# Set permissions
chmod -R 777 storage
chmod -R 777 bootstrap/cache

# Copy .env if not exists
if [ ! -f .env ]; then
    if [ -f .env.example ]; then
        cp .env.example .env
        echo ".env created from .env.example"
    fi
fi

# Start PHP server
exec php -S 0.0.0.0:${PORT:-8080} -t public
