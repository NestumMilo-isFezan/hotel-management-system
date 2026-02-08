#!/bin/bash
set -e

# Function to wait for database
wait_for_db() {
  echo "Waiting for database to be ready..."
  until php -r "try { new PDO('mysql:host=' . getenv('DB_HOST') . ';dbname=' . getenv('DB_DATABASE'), getenv('DB_USERNAME'), getenv('DB_PASSWORD')); exit(0); } catch (Exception \$e) { exit(1); }"; do
    sleep 1
  done
  echo "Database is up!"
}

# Run composer install if vendor doesn't exist
if [ ! -d "vendor" ]; then
  composer install
fi

wait_for_db

# Run migrations and seeder
echo "Initializing database schema..."
php migrate.php migrate
echo "Populating database with seed data..."
php migrate.php seed

# Start Apache in foreground
echo "Starting Apache..."
exec apache2-foreground
