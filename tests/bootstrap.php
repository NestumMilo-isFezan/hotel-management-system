<?php

require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../app/directory.php';
require_once __DIR__ . '/../app/config/config.php';

// Ensure we're using a test database
$conn = mysqli_connect("maria_db", "mangsacoding", "developer", "hotelmanagement_test");
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
