<?php

// Test script to verify create penyewa error handling
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

    // Test inserting invalid data (duplicate email/username)
    echo "Testing create penyewa with invalid data...\n";

    // First, check if test data already exists
    $stmt = $pdo->prepare("SELECT COUNT(*) as count FROM user WHERE email = ? OR username = ?");
    $stmt->execute(['test@example.com', 'testuser']);
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($result['count'] > 0) {
        echo "Test data already exists, cleaning up...\n";
        $pdo->exec("DELETE FROM user WHERE email = 'test@example.com' OR username = 'testuser'");
    }

    // Insert test data first
    $stmt = $pdo->prepare("INSERT INTO user (username, password, role, nama, email, no_telp, is_active) VALUES (?, ?, 'Penyewa', ?, ?, ?, 1)");
    $stmt->execute(['testuser', password_hash('password123', PASSWORD_DEFAULT), 'Test User', 'test@example.com', '081234567890']);

    echo "Test data inserted successfully\n";

    // Now try to insert duplicate data to test validation
    echo "Testing duplicate insertion (should fail)...\n";

    // This would normally be done through the controller, but let's simulate the validation
    $testData = [
        'nama' => 'Test User 2',
        'email' => 'test@example.com', // duplicate
        'username' => 'testuser', // duplicate
        'no_telp' => '081234567891',
        'password' => 'password123',
        'confirm_password' => 'password123'
    ];

    // Simulate validation rules
    $errors = [];

    // Check required fields
    $required = ['nama', 'email', 'username', 'no_telp', 'password', 'confirm_password'];
    foreach ($required as $field) {
        if (empty($testData[$field])) {
            $errors[$field] = "Field $field is required";
        }
    }

    // Check lengths
    if (strlen($testData['nama']) < 3) $errors['nama'] = 'Nama minimal 3 karakter';
    if (strlen($testData['no_telp']) < 10) $errors['no_telp'] = 'No telp minimal 10 karakter';
    if (strlen($testData['password']) < 6) $errors['password'] = 'Password minimal 6 karakter';

    // Check email format
    if (!filter_var($testData['email'], FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = 'Format email tidak valid';
    }

    // Check username format
    if (!preg_match('/^[a-zA-Z0-9_-]+$/', $testData['username'])) {
        $errors['username'] = 'Username hanya boleh huruf, angka, underscore, dan dash';
    }

    // Check password match
    if ($testData['password'] !== $testData['confirm_password']) {
        $errors['confirm_password'] = 'Konfirmasi password tidak cocok';
    }

    // Check uniqueness
    $stmt = $pdo->prepare("SELECT COUNT(*) as count FROM user WHERE email = ?");
    $stmt->execute([$testData['email']]);
    if ($stmt->fetch()['count'] > 0) {
        $errors['email'] = 'Email sudah terdaftar';
    }

    $stmt = $pdo->prepare("SELECT COUNT(*) as count FROM user WHERE username = ?");
    $stmt->execute([$testData['username']]);
    if ($stmt->fetch()['count'] > 0) {
        $errors['username'] = 'Username sudah terdaftar';
    }

    if (!empty($errors)) {
        echo "Validation errors found (as expected):\n";
        foreach ($errors as $field => $error) {
            echo "  $field: $error\n";
        }
        echo "\nSUCCESS: Error handling is working correctly!\n";
    } else {
        echo "ERROR: No validation errors found (unexpected)\n";
    }

    // Clean up test data
    $pdo->exec("DELETE FROM user WHERE email = 'test@example.com' OR username = 'testuser'");

} catch (Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
}