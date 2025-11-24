<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();

// =========================================================
// 1. Rute Publik (Tanpa Login)
// =========================================================

// Halaman Utama/Beranda (L1) dan Katalog Kamar
$routes->get('/', 'Home::index');
$routes->get('katalog', 'Home::katalogKamar');
$routes->get('kamar/(:num)', 'Home::detailKamar/$1'); // Detail Kamar

// Autentikasi (L2 & L3)
$routes->get('login', 'AuthController::login');
$routes->post('login', 'AuthController::attemptLogin');
$routes->get('register', 'AuthController::register');
$routes->post('register', 'AuthController::attemptRegister');
$routes->get('logout', 'AuthController::logout');


// =========================================================
// 2. Rute Area Penyewa (Membutuhkan AuthFilter)
// =========================================================

$routes->group('penyewa', ['filter' => 'auth'], function($routes) {
    // Dashboard Penyewa
    $routes->get('dashboard', 'PenyewaController::dashboard');

    // Proses Booking (UC-5)
    // Tampilkan Form Booking untuk Kamar ID tertentu
    $routes->get('booking/(:num)', 'PenyewaController::formBooking/$1');
    // Proses Simpan Booking
    $routes->post('booking/save', 'PenyewaController::saveBooking');
    // Riwayat Booking
    $routes->get('riwayat-booking', 'PenyewaController::riwayatBooking');
    
    // Pembayaran Penyewa (Upload Bukti Bayar)
    // List pembayaran/tagihan penyewa
    $routes->get('pembayaran', 'PenyewaController::listPembayaran');
    // Form untuk upload bukti bayar DP untuk Booking tertentu
    // Catatan: Route ini disesuaikan dengan view 'riwayat_booking.php'
    $routes->get('pembayaran/form-dp/(:num)', 'PenyewaController::formBayarDP/$1');
    // Proses upload bukti bayar (DP/Bulanan)
    $routes->post('pembayaran/upload', 'PenyewaController::uploadBukti'); 
});


// =========================================================
// 3. Rute Area Admin (Membutuhkan AdminFilter)
// =========================================================

// Gunakan Namespace untuk memanggil Controller dari folder App\Controllers\Admin
$routes->group('admin', ['filter' => 'admin', 'namespace' => 'App\Controllers\Admin'], function($routes) {

    // Dashboard (L5)
    $routes->get('dashboard', 'Dashboard::index');

    // --- Manajemen Kamar (CRUD - UC-3) ---
    // Menggunakan Resource Routing adalah praktik yang bagus, tapi di sini didefinisikan secara eksplisit untuk kejelasan.
    $routes->get('kamar', 'Kamar::index'); 
    $routes->get('kamar/create', 'Kamar::create');
    $routes->post('kamar/store', 'Kamar::store');
    $routes->get('kamar/edit/(:num)', 'Kamar::edit/$1');
    $routes->post('kamar/update/(:num)', 'Kamar::update/$1');
    $routes->get('kamar/delete/(:num)', 'Kamar::delete/$1');

    // --- Manajemen Penyewa (R & U Status - UC-4) ---
    $routes->get('penyewa', 'Penyewa::index');
    // Toggle Status Aktif (Aktifkan/Nonaktifkan)
    $routes->get('penyewa/toggle/(:num)', 'Penyewa::toggleActive/$1');

    // --- Verifikasi Booking (UC-5 Lanjutan) ---
    $routes->get('booking', 'Booking::index');
    // Terima/Tolak Booking
    $routes->post('booking/verify/(:num)', 'Booking::verify/$1'); 

    // --- Manajemen Pembayaran (CRUD & Verifikasi - UC-6) ---
    $routes->get('pembayaran', 'Pembayaran::index'); 
    // Tampilkan form Tambah manual oleh Admin
    $routes->get('pembayaran/create', 'Pembayaran::create'); 
    // Proses Tambah manual
    $routes->post('pembayaran/store', 'Pembayaran::store');
    // Verifikasi Pembayaran (Lunas/Ditolak)
    $routes->post('pembayaran/verify/(:num)', 'Pembayaran::verify/$1'); 
    // Hapus data Pembayaran
    $routes->get('pembayaran/delete/(:num)', 'Pembayaran::delete/$1'); 

    // --- Laporan (Laporan Keuangan & Kamar) ---
    $routes->get('laporan/keuangan', 'Dashboard::laporanKeuangan');
    $routes->get('laporan/kamar', 'Dashboard::laporanKamar');

    $routes->get('/admin/dashboard', 'AdminController::dashboard');
$routes->get('/penyewa/dashboard', 'PenyewaController::dashboard');
});