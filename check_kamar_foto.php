<?php

// Test script to check kamar foto data
require_once __DIR__ . '/vendor/autoload.php';

try {
    $config = require 'app/Config/Database.php';
    $db = \Config\Database::connect();

    $kamars = $db->table('kamar')->select('kamar_id, nomor_kamar, foto_kamar')->limit(5)->get()->getResultArray();

    echo "Sample kamar data:\n";
    foreach ($kamars as $kamar) {
        echo 'ID: ' . $kamar['kamar_id'] . ', Nomor: ' . $kamar['nomor_kamar'] . ', Foto: ' . ($kamar['foto_kamar'] ?: 'NULL') . "\n";
    }
} catch (Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
}