<?php
// Guarda esto en un archivo test_db.php en la raíz

define('BASEPATH', true);
include('application/config/database.php');

$db_file = $db['default']['database'];
echo "SQLite database file path: {$db_file}\n";

if (file_exists($db_file)) {
    echo "Database file exists!\n";
} else {
    echo "Database file does not exist. Creating directory...\n";
    $dir = dirname($db_file);
    if (!is_dir($dir)) {
        mkdir($dir, 0755, true);
        echo "Directory created: {$dir}\n";
    }
}

try {
    $pdo = new PDO('sqlite:' . $db_file);
    echo "Database connection successful!\n";

    // Check if migrations table exists
    $stmt = $pdo->query("SELECT name FROM sqlite_master WHERE type='table' AND name='migrations'");
    if ($stmt->fetch()) {
        echo "Migrations table exists.\n";
    } else {
        echo "Migrations table does not exist.\n";
    }
} catch (PDOException $e) {
    echo "Database connection failed: " . $e->getMessage() . "\n";
}
