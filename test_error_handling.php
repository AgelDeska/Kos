<?php
require_once 'vendor/autoload.php';
require_once 'app/Config/Database.php';
require_once 'app/Config/Autoload.php';

use Config\Database;
use App\Models\KamarModel;

try {
    // Test basic connection
    $db = Database::connect();
    echo "Database connection successful.\n";

    // Test KamarModel
    $kamarModel = new KamarModel();
    echo "KamarModel instantiated successfully.\n";

    // Test find first kamar
    $firstKamar = $kamarModel->first();
    if ($firstKamar) {
        echo "Found first kamar: " . $firstKamar['nomor_kamar'] . " (ID: " . $firstKamar['kamar_id'] . ")\n";

        // Test update with invalid data to trigger specific errors
        echo "\n--- Testing various error scenarios ---\n";

        // Test 1: Duplicate nomor_kamar
        echo "Test 1: Duplicate nomor_kamar\n";
        $duplicateData = [
            'nomor_kamar' => $firstKamar['nomor_kamar'], // Same as existing
            'tipe_kamar' => 'Test Room',
            'kapasitas' => 2,
            'harga' => 500000,
            'status' => 'Tersedia'
        ];

        $result = $kamarModel->update($firstKamar['kamar_id'], $duplicateData);
        if (!$result) {
            $errors = $kamarModel->errors();
            $dbError = $kamarModel->db->error();
            echo "Expected error - Model errors: " . json_encode($errors) . "\n";
            echo "Expected error - DB error: " . json_encode($dbError) . "\n";
        }

        // Test 2: Valid update
        echo "\nTest 2: Valid update\n";
        $validData = [
            'nomor_kamar' => $firstKamar['nomor_kamar'] . '-TEST', // Make it unique
            'tipe_kamar' => 'Test Room Updated',
            'kapasitas' => 3,
            'harga' => 600000,
            'status' => 'Tersedia',
            'deskripsi' => 'Updated via test script'
        ];

        $result = $kamarModel->update($firstKamar['kamar_id'], $validData);
        if ($result) {
            echo "Update successful!\n";
        } else {
            $errors = $kamarModel->errors();
            $dbError = $kamarModel->db->error();
            echo "Unexpected error - Model errors: " . json_encode($errors) . "\n";
            echo "Unexpected error - DB error: " . json_encode($dbError) . "\n";
        }

    } else {
        echo "No kamars found in database.\n";
    }

} catch (Exception $e) {
    echo 'Error: ' . $e->getMessage() . "\n";
    echo 'File: ' . $e->getFile() . ' Line: ' . $e->getLine() . "\n";
}
?>