#!/bin/bash

# Exit on any error
set -e

# Pull latest changes
git pull origin main

# Install/update dependencies
composer install --no-dev --optimize-autoloader

# Run database migrations (if any)
mysql -u mangsacoding -p < db/schema.sql

# Clear cache
php artisan cache:clear || true

# Restart web server (if needed)
sudo systemctl restart apache2 || true
