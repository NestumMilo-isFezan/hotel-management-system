<?php

require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../app/directory.php';

// Use environment variables or fallback to default values
$host = getenv('DB_HOST') ?: '127.0.0.1';
$user = getenv('DB_USERNAME') ?: 'mangsacoding';
$pass = getenv('DB_PASSWORD') ?: 'mangsacoding';
$db = getenv('DB_DATABASE') ?: 'hotelmanagement_test';

$conn = mysqli_connect($host, $user, $pass, $db);
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
