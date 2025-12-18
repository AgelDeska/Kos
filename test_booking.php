<?php

// Simple test script untuk method getBookingDetail
require_once 'vendor/autoload.php';

use Config\Database;
use App\Models\BookingModel;

$db = Database::connect();
$bookingModel = new BookingModel();

// Test dengan user_id = 1 (asumsi ada user penyewa dengan id 1)
$userId = 1;
$result = $bookingModel->getBookingDetail(null, $userId);

echo "Result type: " . gettype($result) . "\n";
echo "Result:\n";
print_r($result);

?>