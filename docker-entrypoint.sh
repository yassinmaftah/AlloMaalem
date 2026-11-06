#!/bin/sh
set -e

# Copy .env if not exists
if [ ! -f .env ]; then
    echo "Creating .env from .env.example..."
    cp .env.example .env
fi

# Ensure storage directories exist and have proper permissions
mkdir -p storage/framework/cache/data storage/framework/sessions storage/framework/views storage/logs bootstrap/cache
chmod -R 777 storage bootstrap/cache

# Configure session driver to file (matches schema)
sed -i "s|^SESSION_DRIVER=.*|SESSION_DRIVER=file|" .env

# Handle APP_KEY
if [ -n "$APP_KEY" ]; then
    sed -i "s|^APP_KEY=.*|APP_KEY=${APP_KEY}|" .env
fi

if ! grep -q "^APP_KEY=base64:" .env; then
    echo "Generating application key..."
    php artisan key:generate --force
fi

# If using SQLite
if [ "$DB_CONNECTION" = "sqlite" ] || grep -q "^DB_CONNECTION=sqlite" .env; then
    mkdir -p database
    touch database/database.sqlite
    chmod 666 database/database.sqlite
fi

# If using MySQL / MariaDB
if [ "$DB_CONNECTION" = "mysql" ]; then
    sed -i "s|^DB_CONNECTION=.*|DB_CONNECTION=mysql|" .env
    sed -i "s|^# DB_HOST=.*|DB_HOST=${DB_HOST:-db}|" .env
    sed -i "s|^# DB_PORT=.*|DB_PORT=${DB_PORT:-3306}|" .env
    sed -i "s|^# DB_DATABASE=.*|DB_DATABASE=${DB_DATABASE:-allomaalem}|" .env
    sed -i "s|^# DB_USERNAME=.*|DB_USERNAME=${DB_USERNAME:-allomaalem}|" .env
    sed -i "s|^# DB_PASSWORD=.*|DB_PASSWORD=${DB_PASSWORD:-secretpassword}|" .env

    echo "Waiting for MySQL database (${DB_HOST:-db}:${DB_PORT:-3306}) to be ready..."
    max_tries=40
    count=0
    until php -r "try { new PDO('mysql:host=' . (getenv('DB_HOST') ?: 'db') . ';port=' . (getenv('DB_PORT') ?: '3306') . ';dbname=' . (getenv('DB_DATABASE') ?: 'allomaalem'), getenv('DB_USERNAME') ?: 'allomaalem', getenv('DB_PASSWORD') ?: 'secretpassword'); exit(0); } catch (Exception \$e) { exit(1); }" 2>/dev/null; do
        count=$((count+1))
        if [ $count -ge $max_tries ]; then
            echo "Database connection timed out."
            break
        fi
        sleep 2
    done
fi

# Clear any cached configuration
php artisan config:clear

# Run migrations
echo "Running migrations..."
php artisan migrate --force

# Seed database if users table is empty
USER_COUNT=$(php artisan tinker --execute="echo App\Models\User::count();" 2>/dev/null | tr -d '\r\n' || echo "0")
if [ "$USER_COUNT" = "0" ] || [ -z "$USER_COUNT" ]; then
    echo "Seeding database with demo data..."
    php artisan db:seed --force
fi

# Create storage link if not exists
php artisan storage:link || true

echo "========================================="
echo " Allo Maalem is running on port 8000! "
echo "========================================="

exec "$@"
