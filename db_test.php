<?php
// Arreglar problema de constantes no definidas
define('BASEPATH', __DIR__ . '/system/');
define('ENVIRONMENT', 'development');
define('FCPATH', __DIR__ . '/');
define('APPPATH', __DIR__ . '/application/');

// Incluir archivo de base de datos
include('application/config/database.php');

// Obtener la ruta del archivo de base de datos
$db_file = $db['default']['database'];
echo "SQLite database file path: {$db_file}\n";

// Verificar si el archivo existe
if (file_exists($db_file)) {
    echo "Database file exists!\n";
    echo "File size: " . filesize($db_file) . " bytes\n";
    echo "Permissions: " . substr(sprintf('%o', fileperms($db_file)), -4) . "\n";
} else {
    echo "Database file does not exist. Creating directory...\n";
    $dir = dirname($db_file);
    if (!is_dir($dir)) {
        mkdir($dir, 0775, true);
        echo "Directory created: {$dir}\n";
    }

    // Intentar crear el archivo
    touch($db_file);
    if (file_exists($db_file)) {
        echo "Empty database file created successfully!\n";
        chmod($db_file, 0666);
        echo "Permissions set to 666\n";
    } else {
        echo "Failed to create database file. Check permissions.\n";
    }
}

// Probar la conexión
try {
    $pdo = new PDO('sqlite:' . $db_file);
    echo "Database connection successful!\n";

    // Intentar crear la tabla de migraciones
    $pdo->exec("
        CREATE TABLE IF NOT EXISTS migrations (
            version INT NOT NULL PRIMARY KEY
        )
    ");

    // Verificar si se creó la tabla
    $stmt = $pdo->query("SELECT name FROM sqlite_master WHERE type='table' AND name='migrations'");
    if ($stmt->fetch()) {
        echo "Migrations table exists or was created successfully.\n";

        // Verificar si hay una versión
        $stmt = $pdo->query("SELECT version FROM migrations LIMIT 1");
        $row = $stmt->fetch();
        echo "Current migration version: " . ($row ? $row['version'] : 'None') . "\n";

        // Si no hay versión, insertar 0
        if (!$row) {
            $pdo->exec("INSERT INTO migrations (version) VALUES (0)");
            echo "Initialized migration version to 0\n";
        }
    } else {
        echo "Failed to create migrations table.\n";
    }
} catch (PDOException $e) {
    echo "Database connection failed: " . $e->getMessage() . "\n";
}
