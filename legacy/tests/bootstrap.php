<?php

require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../app/directory.php';

// Skip loading config.php as we need different connection settings for tests
// require_once __DIR__ . '/../app/config/config.php';

// Use environment variables or fallback to default values
$host = getenv('DB_HOST') ?: '127.0.0.1';
$user = getenv('DB_USERNAME') ?: 'mangsacoding';
$pass = getenv('DB_PASSWORD') ?: 'developer';
$db = getenv('DB_DATABASE') ?: 'hotelmanagement_test';

// Create connection with error reporting
$conn = mysqli_connect($host, $user, $pass, $db);

if (!$conn) {
    echo "Test database connection failed: " . mysqli_connect_error() . "\n";
    echo "Host: $host\n";
    echo "User: $user\n";
    echo "Database: $db\n";
    die();
}

// Make connection available globally
$GLOBALS['conn'] = $conn;
