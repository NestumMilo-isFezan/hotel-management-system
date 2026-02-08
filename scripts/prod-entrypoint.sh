#!/bin/bash
set -e

# Wait for database if needed (optional for production as DB is usually persistent)
# but helpful if starting everything at once
echo "Checking database connection..."
until php -r "try { new PDO('mysql:host=' . getenv('DB_HOST') . ';dbname=' . getenv('DB_DATABASE'), getenv('DB_USERNAME'), getenv('DB_PASSWORD')); exit(0); } catch (Exception \$e) { exit(1); }"; do
  echo "Database not ready, waiting..."
  sleep 2
done

echo "Database connected!"

# Run migrations
echo "Running migrations..."
php migrate.php migrate

# Start Apache
echo "Starting application..."
exec apache2-foreground
