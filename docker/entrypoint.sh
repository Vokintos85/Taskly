#!/bin/sh

set -e

echo "Starting Laravel application setup..."

cd /var/www/html

if [ ! -f vendor/autoload.php ]; then
    echo "Installing PHP dependencies..."
    composer install --no-interaction --prefer-dist --optimize-autoloader
else
    echo "Updating PHP dependencies..."
    composer install --no-interaction --prefer-dist --optimize-autoloader
fi

if [ ! -f database/database.sqlite ]; then
    echo "Creating SQLite database..."
    touch database/database.sqlite
fi
chmod 666 database/database.sqlite

if [ ! -f .env ]; then
    echo "Creating .env file..."
    cp .env.example .env

    echo "Setting up SQLite database configuration..."
    echo "DB_CONNECTION=sqlite" >> .env
    echo "DB_DATABASE=/var/www/html/database/database.sqlite" >> .env
fi

if ! grep -qE '^APP_KEY=.+$' .env; then
    echo "Generating application key..."
    php artisan key:generate --force
fi

echo "Setting permissions..."
mkdir -p storage bootstrap/cache
chmod -R 775 storage/ bootstrap/cache/
chown -R www-data:www-data storage/ bootstrap/cache/

echo "Running migrations..."
php artisan migrate --force

echo "Setup completed!"
exec "$@"
