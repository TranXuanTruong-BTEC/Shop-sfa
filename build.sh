#!/bin/bash

# Exit on error
set -e

# Install PHP dependencies
composer install --no-dev --optimize-autoloader

# Clear and cache routes, config, views
php artisan config:clear
php artisan cache:clear
php artisan view:clear
php artisan route:clear

# Generate app key if not set
if [ -z "$APP_KEY" ]; then
    php artisan key:generate
fi

# Cache config and routes
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Run migrations and seeders
php artisan migrate --force
php artisan db:seed --force