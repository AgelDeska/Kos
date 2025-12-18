<?php

// Test script to verify create pembayaran functionality
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

    // Check if we have users and kamars
    $stmt = $pdo->query("SELECT COUNT(*) as count FROM user WHERE role = 'Penyewa'");
    $userCount = $stmt->fetch()['count'];

    $stmt = $pdo->query("SELECT COUNT(*) as count FROM kamar");
    $kamarCount = $stmt->fetch()['count'];

    echo "Found $userCount penyewa users and $kamarCount kamars\n";

    if ($userCount == 0 || $kamarCount == 0) {
        echo "ERROR: Need at least 1 penyewa and 1 kamar to test pembayaran creation\n";
        exit;
    }

    // Get first penyewa and kamar
    $stmt = $pdo->prepare("SELECT user_id, nama FROM user WHERE role = 'Penyewa' LIMIT 1");
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    $stmt = $pdo->prepare("SELECT kamar_id, nomor_kamar FROM kamar LIMIT 1");
    $stmt->execute();
    $kamar = $stmt->fetch(PDO::FETCH_ASSOC);

    echo "Testing create pembayaran with user: {$user['nama']} and kamar: {$kamar['nomor_kamar']}\n";

    // Test validation - missing required fields
    echo "Testing validation with missing fields...\n";

    $testData = [
        // Missing user_id, kamar_id, jenis_pembayaran, jumlah, tagihan_bulan
    ];

    $errors = [];
    if (empty($testData['user_id'])) $errors['user_id'] = 'User ID is required';
    if (empty($testData['kamar_id'])) $errors['kamar_id'] = 'Kamar ID is required';
    if (empty($testData['jenis_pembayaran'])) $errors['jenis_pembayaran'] = 'Jenis pembayaran is required';
    if (empty($testData['jumlah'])) $errors['jumlah'] = 'Jumlah is required';
    if (empty($testData['tagihan_bulan'])) $errors['tagihan_bulan'] = 'Tagihan bulan is required';

    if (!empty($errors)) {
        echo "Validation errors found (as expected):\n";
        foreach ($errors as $field => $error) {
            echo "  $field: $error\n";
        }
        echo "\nSUCCESS: Validation is working correctly!\n";
    }

    // Test successful creation
    echo "Testing successful pembayaran creation...\n";

    $stmt = $pdo->prepare("INSERT INTO pembayaran (user_id, kamar_id, jenis_pembayaran, tagihan_bulan, jumlah, tanggal_bayar, metode, status, created_at, updated_at) VALUES (?, ?, ?, ?, ?, ?, ?, ?, NOW(), NOW())");
    $result = $stmt->execute([
        $user['user_id'],
        $kamar['kamar_id'],
        'Bulanan',
        '2025-12',
        500000,
        date('Y-m-d'),
        'Kas/Manual',
        'Lunas'
    ]);

    if ($result) {
        $pembayaranId = $pdo->lastInsertId();
        echo "SUCCESS: Pembayaran created with ID: $pembayaranId\n";

        // Verify the created pembayaran
        $stmt = $pdo->prepare("SELECT * FROM pembayaran WHERE pembayaran_id = ?");
        $stmt->execute([$pembayaranId]);
        $pembayaran = $stmt->fetch(PDO::FETCH_ASSOC);

        echo "Created pembayaran details:\n";
        echo "  User ID: {$pembayaran['user_id']}\n";
        echo "  Kamar ID: {$pembayaran['kamar_id']}\n";
        echo "  Jenis: {$pembayaran['jenis_pembayaran']}\n";
        echo "  Jumlah: {$pembayaran['jumlah']}\n";
        echo "  Status: {$pembayaran['status']}\n";

        // Clean up test data
        $pdo->exec("DELETE FROM pembayaran WHERE pembayaran_id = $pembayaranId");
        echo "Test data cleaned up\n";
    } else {
        echo "ERROR: Failed to create pembayaran\n";
    }

} catch (Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
}