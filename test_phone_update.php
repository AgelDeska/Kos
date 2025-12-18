<?php

// Simple test to check if no_telp field exists and can be updated
require_once __DIR__ . '/vendor/autoload.php';

// Load environment
if (file_exists(__DIR__ . '/.env')) {
    $lines = file(__DIR__ . '/.env');
    foreach ($lines as $line) {
        if (strpos($line, '=') !== false && !preg_match('/^\s*#/', $line)) {
            list($key, $value) = explode('=', trim($line), 2);
            putenv("$key=$value");
            $_ENV[$key] = $value;
        }
    }
}

// Simple database connection test
try {
    $host = getenv('database.default.hostname') ?: 'localhost';
    $database = getenv('database.default.database') ?: 'smartkos_db';
    $username = getenv('database.default.username') ?: 'root';
    $password = getenv('database.default.password') ?: '';

    $pdo = new PDO("mysql:host=$host;dbname=$database;charset=utf8mb4", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    echo "Database connected successfully\n";

    // Check if user table has no_telp column
    $stmt = $pdo->query("DESCRIBE user");
    $columns = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $hasNoTelp = false;
    foreach ($columns as $column) {
        if ($column['Field'] === 'no_telp') {
            $hasNoTelp = true;
            echo "no_telp column exists: Type=" . $column['Type'] . ", Null=" . $column['Null'] . "\n";
            break;
        }
    }

    if (!$hasNoTelp) {
        echo "ERROR: no_telp column does not exist in user table\n";
        exit;
    }

    // Find a penyewa user
    $stmt = $pdo->prepare("SELECT user_id, nama, no_telp FROM user WHERE role = 'Penyewa' LIMIT 1");
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$user) {
        echo "No penyewa found in database\n";
        exit;
    }

    echo "Found penyewa: " . $user['nama'] . " (ID: " . $user['user_id'] . ")\n";
    echo "Current no_telp: " . ($user['no_telp'] ?? 'NULL') . "\n";

    // Test update
    $newPhone = '081234567890';
    $stmt = $pdo->prepare("UPDATE user SET no_telp = ?, updated_at = NOW() WHERE user_id = ?");
    $result = $stmt->execute([$newPhone, $user['user_id']]);

    if ($result) {
        echo "Direct SQL update successful!\n";

        // Verify
        $stmt = $pdo->prepare("SELECT no_telp FROM user WHERE user_id = ?");
        $stmt->execute([$user['user_id']]);
        $updated = $stmt->fetch(PDO::FETCH_ASSOC);

        echo "Updated no_telp: " . ($updated['no_telp'] ?? 'NULL') . "\n";

        if ($updated['no_telp'] === $newPhone) {
            echo "SUCCESS: Phone number updated correctly!\n";
        } else {
            echo "FAILED: Phone number not updated\n";
        }
    } else {
        echo "Direct SQL update failed\n";
    }

} catch (Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
}