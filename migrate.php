<?php
declare(strict_types=1);

require_once __DIR__ . '/vendor/autoload.php';

use App\Core\Database;

$command = $argv[1] ?? null;

if ($command === 'migrate') {
    runMigrations();
} elseif ($command === 'seed') {
    runSeeders();
} else {
    echo "Usage: php migrate.php [migrate|seed]
";
}

function runMigrations() {
    echo "Running migrations...
";
    $files = glob(__DIR__ . '/src/Database/Migrations/*.php');
    foreach ($files as $file) {
        require_once $file;
        $className = "App\\Database\\Migrations\\" . pathinfo($file, PATHINFO_FILENAME);
        $migration = new $className();
        $migration->up();
        echo "Migrated: " . pathinfo($file, PATHINFO_FILENAME) . "
";
    }
}

function runSeeders() {
    echo "Running seeders...
";
    $files = glob(__DIR__ . '/src/Database/Seeders/*.php');
    foreach ($files as $file) {
        require_once $file;
        $className = "App\\Database\\Seeders\\" . pathinfo($file, PATHINFO_FILENAME);
        $seeder = new $className();
        $seeder->run();
        echo "Seeded: " . pathinfo($file, PATHINFO_FILENAME) . "
";
    }
}
