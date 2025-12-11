<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

// Konfigurasi Default CodeIgniter
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(false); // Disarankan untuk keamanan

// =========================================================
// 1. Rute Publik (Tanpa Login)
// =========================================================

// Halaman Utama/Beranda (L1)
$routes->get('/', 'Home::index', ['as' => 'home']);

// Daftar Pengguna / Profil Publik
$routes->get('users', 'UserController::index', ['as' => 'users_index']);
$routes->get('users/(:num)', 'UserController::view/$1', ['as' => 'users_view']);

// Profil pengguna (khusus user yang login)
$routes->get('profile', 'UserController::profile', ['as' => 'profile', 'filter' => 'auth']);

// Katalog Kamar
$routes->get('katalog', 'Home::katalogKamar', ['as' => 'katalog_kamar']);
$routes->get('kamar', 'Home::katalogKamar', ['as' => 'katalog_kamar2']);
$routes->get('kamar/katalog', 'Home::katalogKamar', ['as' => 'katalog_kamar3']);
$routes->get('kamar/(:num)', 'Home::detailKamar/$1', ['as' => 'detail_kamar']); // Detail Kamar

// Autentikasi (L2 & L3)
$routes->get('login', 'AuthController::login', ['as' => 'login']);
$routes->post('login', 'AuthController::attemptLogin');
$routes->get('register', 'AuthController::register', ['as' => 'register']);
$routes->post('register', 'AuthController::attemptRegister');
$routes->get('logout', 'AuthController::logout', ['as' => 'logout']);
$routes->post('auth/logout', 'AuthController::logout');

// Forgot Password
$routes->get('forgot-password', 'AuthController::forgotPassword', ['as' => 'forgot_password']);
$routes->post('forgot-password', 'AuthController::sendResetEmail');
$routes->get('reset-password/(:any)', 'AuthController::resetPassword/$1', ['as' => 'reset_password']);
$routes->post('reset-password', 'AuthController::updatePassword');


// =========================================================
// 2. Rute Area Penyewa (Membutuhkan AuthFilter)
// =========================================================

$routes->group('penyewa', ['filter' => 'auth'], function($routes) {
    // Dashboard Penyewa
    $routes->get('dashboard', 'PenyewaController::dashboard', ['as' => 'penyewa_dashboard']);

    // Proses Booking (UC-5)
    // Tampilkan Form Booking untuk Kamar ID tertentu
    $routes->get('booking/(:num)', 'PenyewaController::formBooking/$1', ['as' => 'form_booking']);
    // Proses Simpan Booking
    $routes->post('booking/save', 'PenyewaController::saveBooking', ['as' => 'save_booking']);
    // Riwayat Booking
    $routes->get('riwayat-booking', 'PenyewaController::riwayatBooking', ['as' => 'riwayat_booking']);
    
    // Pembayaran Penyewa (Upload Bukti Bayar)
    // List pembayaran/tagihan penyewa
    $routes->get('pembayaran', 'PenyewaController::listPembayaran', ['as' => 'penyewa_pembayaran']);
    // Form untuk upload bukti bayar DP untuk Booking tertentu
    $routes->get('pembayaran/form-dp/(:num)', 'PenyewaController::formBayarDP/$1', ['as' => 'form_bayar_dp']);
    // Proses upload bukti bayar (DP/Bulanan)
    $routes->post('pembayaran/upload', 'PenyewaController::uploadBukti', ['as' => 'upload_bukti']);
    // Detail pembayaran
    $routes->get('pembayaran/(:num)/detail', 'PenyewaController::detailPembayaran/$1', ['as' => 'detail_pembayaran']);
});


// =========================================================
// 3. Rute Area Admin (Membutuhkan AdminFilter)
// =========================================================

// Gunakan Namespace untuk memanggil Controller dari folder App\Controllers\Admin
$routes->group('admin', ['filter' => 'admin', 'namespace' => 'App\Controllers\Admin'], function($routes) {

    // Dashboard (L5)
    $routes->get('dashboard', 'Dashboard::index', ['as' => 'admin_dashboard']);

    // --- Manajemen Kamar (CRUD - UC-3) ---
    $routes->get('kamar', 'Kamar::index', ['as' => 'admin_kamar_index']); 
    $routes->get('kamar/create', 'Kamar::create', ['as' => 'admin_kamar_create']);
    $routes->post('kamar/store', 'Kamar::store', ['as' => 'admin_kamar_store']);
    $routes->get('kamar/edit/(:num)', 'Kamar::edit/$1', ['as' => 'admin_kamar_edit']);
    $routes->post('kamar/update/(:num)', 'Kamar::update/$1', ['as' => 'admin_kamar_update']);
    // Quick status update from index view
    $routes->post('kamar/status/(:num)', 'Kamar::updateStatus/$1', ['as' => 'admin_kamar_status']);
    $routes->get('kamar/delete/(:num)', 'Kamar::delete/$1', ['as' => 'admin_kamar_delete']);

    // --- Manajemen Penyewa (CRUD - UC-4) ---
    $routes->get('penyewa', 'Penyewa::index', ['as' => 'admin_penyewa_index']);
    $routes->get('penyewa/create', 'Penyewa::create', ['as' => 'admin_penyewa_create']);
    $routes->post('penyewa/store', 'Penyewa::store', ['as' => 'admin_penyewa_store']);
    $routes->get('penyewa/edit/(:num)', 'Penyewa::edit/$1', ['as' => 'admin_penyewa_edit']);
    $routes->post('penyewa/update/(:num)', 'Penyewa::update/$1', ['as' => 'admin_penyewa_update']);
    $routes->get('penyewa/delete/(:num)', 'Penyewa::delete/$1', ['as' => 'admin_penyewa_delete']);
    // Toggle Status Aktif (Aktifkan/Nonaktifkan)
    $routes->get('penyewa/toggle/(:num)', 'Penyewa::toggleActive/$1', ['as' => 'admin_penyewa_toggle']);

    // --- Verifikasi Booking (UC-5 Lanjutan) ---
    $routes->get('booking', 'Booking::index', ['as' => 'admin_booking_index']);
    // Terima/Tolak Booking
    $routes->post('booking/verify/(:num)', 'Booking::verify/$1', ['as' => 'admin_booking_verify']); 

    // --- Manajemen Pembayaran (CRUD & Verifikasi - UC-6) ---
    $routes->get('pembayaran', 'Pembayaran::index', ['as' => 'admin_pembayaran_index']); 
    // Tampilkan form Tambah manual oleh Admin
    $routes->get('pembayaran/create', 'Pembayaran::create', ['as' => 'admin_pembayaran_create']); 
    // Proses Tambah manual
    $routes->post('pembayaran/store', 'Pembayaran::store', ['as' => 'admin_pembayaran_store']);
    // Verifikasi Pembayaran (Lunas/Ditolak)
    $routes->post('pembayaran/verify/(:num)', 'Pembayaran::verify/$1', ['as' => 'admin_pembayaran_verify']); 
    // Hapus data Pembayaran
    $routes->get('pembayaran/delete/(:num)', 'Pembayaran::delete/$1', ['as' => 'admin_pembayaran_delete']); 

    // --- Laporan (Laporan Keuangan & Kamar) ---
    $routes->get('laporan/keuangan', 'Dashboard::laporanKeuangan');
    $routes->get('laporan/kamar', 'Dashboard::laporanKamar');

    $routes->get('/admin/dashboard', 'AdminController::dashboard');
$routes->get('/penyewa/dashboard', 'PenyewaController::dashboard');
});