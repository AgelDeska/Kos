<?= $this->extend('layout/penyewa_template') ?>

<?= $this->section('content') ?>

<!-- Welcome Banner -->
<div class="mb-8">
    <div class="card bg-gradient-to-r from-blue-500 via-blue-600 to-blue-700 text-white p-8 rounded-xl shadow-lg overflow-hidden relative">
        <div class="absolute top-0 right-0 opacity-10">
            <i class="fas fa-home text-9xl"></i>
        </div>
        <div class="relative z-10">
            <h2 class="text-3xl md:text-4xl font-bold mb-2">
                <i class="fas fa-wave-hand mr-3"></i>Selamat Datang, <?= esc(session()->get('nama') ?? session()->get('username')) ?>!
            </h2>
            <p class="text-blue-100 text-lg">Kelola booking kamar dan pembayaran Anda dengan mudah di sini</p>
        </div>
    </div>
</div>

<!-- Stats Cards -->
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
    <!-- Total Booking -->
    <div class="stat-card p-6 rounded-xl text-white shadow-lg">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-blue-100 text-sm font-medium mb-1">Total Booking</p>
                <p class="text-4xl font-bold">0</p>
                <p class="text-blue-100 text-xs mt-2">Kamar yang sedang disewa</p>
            </div>
            <i class="fas fa-door-open text-4xl opacity-20"></i>
        </div>
    </div>

    <!-- Pembayaran Pending -->
    <div class="stat-card green p-6 rounded-xl text-white shadow-lg">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-pink-100 text-sm font-medium mb-1">Pembayaran Pending</p>
                <p class="text-4xl font-bold">Rp 0</p>
                <p class="text-pink-100 text-xs mt-2">Menunggu konfirmasi</p>
            </div>
            <i class="fas fa-clock text-4xl opacity-20"></i>
        </div>
    </div>

    <!-- Pembayaran Terverifikasi -->
    <div class="stat-card blue p-6 rounded-xl text-white shadow-lg">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-cyan-100 text-sm font-medium mb-1">Pembayaran Terverifikasi</p>
                <p class="text-4xl font-bold">Rp 0</p>
                <p class="text-cyan-100 text-xs mt-2">Sudah dikonfirmasi</p>
            </div>
            <i class="fas fa-check-circle text-4xl opacity-20"></i>
        </div>
    </div>

    <!-- Jatuh Tempo -->
    <div class="stat-card yellow p-6 rounded-xl text-white shadow-lg">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-yellow-100 text-sm font-medium mb-1">Jatuh Tempo</p>
                <p class="text-2xl font-bold">-</p>
                <p class="text-yellow-100 text-xs mt-2">Belum ada booking aktif</p>
            </div>
            <i class="fas fa-calendar text-4xl opacity-20"></i>
        </div>
    </div>
</div>

<!-- Quick Actions & Recent Activity -->
<div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-8">
    <!-- Quick Actions -->
    <div class="lg:col-span-1 card p-6 rounded-xl shadow-md">
        <h3 class="text-lg font-bold text-gray-900 mb-4 flex items-center">
            <i class="fas fa-bolt text-yellow-500 mr-2"></i>Aksi Cepat
        </h3>
        <div class="space-y-3">
            <a href="<?= base_url('katalog') ?>" class="btn-primary w-full justify-center">
                <i class="fas fa-search mr-2"></i>Cari Kamar Baru
            </a>
            <a href="<?= base_url('penyewa/riwayat-booking') ?>" class="btn-secondary w-full justify-center">
                <i class="fas fa-history mr-2"></i>Lihat Booking Saya
            </a>
            <a href="<?= base_url('penyewa/pembayaran') ?>" class="btn-secondary w-full justify-center">
                <i class="fas fa-wallet mr-2"></i>Lihat Pembayaran
            </a>
            <a href="<?= base_url('forgot-password') ?>" class="btn-secondary w-full justify-center">
                <i class="fas fa-key mr-2"></i>Ubah Password
            </a>
        </div>
    </div>

    <!-- Status Informasi -->
    <div class="lg:col-span-2 card p-6 rounded-xl shadow-md">
        <h3 class="text-lg font-bold text-gray-900 mb-4 flex items-center">
            <i class="fas fa-info-circle text-blue-500 mr-2"></i>Informasi Akun
        </h3>
        <div class="space-y-4">
            <div class="flex items-center justify-between p-4 bg-gray-50 rounded-lg">
                <div class="flex items-center">
                    <i class="fas fa-user text-blue-500 text-xl mr-3"></i>
                    <div>
                        <p class="text-sm text-gray-600">Nama Lengkap</p>
                        <p class="font-semibold text-gray-900"><?= esc(session()->get('nama') ?? '-') ?></p>
                    </div>
                </div>
            </div>
            <div class="flex items-center justify-between p-4 bg-gray-50 rounded-lg">
                <div class="flex items-center">
                    <i class="fas fa-envelope text-green-500 text-xl mr-3"></i>
                    <div>
                        <p class="text-sm text-gray-600">Email</p>
                        <p class="font-semibold text-gray-900"><?= esc(session()->get('email') ?? '-') ?></p>
                    </div>
                </div>
            </div>
            <div class="flex items-center justify-between p-4 bg-gray-50 rounded-lg">
                <div class="flex items-center">
                    <i class="fas fa-shield-alt text-purple-500 text-xl mr-3"></i>
                    <div>
                        <p class="text-sm text-gray-600">Status Akun</p>
                        <p class="font-semibold text-gray-900"><span class="badge badge-success">Aktif</span></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Riwayat Booking Terbaru -->
<div class="card rounded-xl shadow-md overflow-hidden">
    <div class="p-6 border-b border-gray-200 bg-gray-50">
        <h3 class="text-lg font-bold text-gray-900 flex items-center">
            <i class="fas fa-calendar-check text-indigo-600 mr-2"></i>Riwayat Booking Terbaru
        </h3>
    </div>

    <div class="overflow-x-auto">
        <table class="min-w-full">
            <thead class="bg-gray-50 border-b border-gray-200">
                <tr>
                    <th class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase">ID Booking</th>
                    <th class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase">Kamar</th>
                    <th class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase">Tgl Booking</th>
                    <th class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase">Durasi</th>
                    <th class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase">Status</th>
                    <th class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                <?php if (empty($riwayat_booking)): ?>
                    <tr>
                        <td colspan="6" class="px-6 py-12 text-center">
                            <div class="flex flex-col items-center justify-center">
                                <i class="fas fa-inbox text-5xl text-gray-300 mb-4"></i>
                                <p class="text-gray-500 font-medium text-lg">Belum ada booking</p>
                                <p class="text-gray-400 text-sm mb-4">Mulai dengan mencari kamar yang tersedia</p>
                                <a href="<?= base_url('katalog') ?>" class="btn-primary">
                                    <i class="fas fa-search mr-2"></i>Cari Kamar Sekarang
                                </a>
                            </div>
                        </td>
                    </tr>
                <?php else: ?>
                    <?php foreach ($riwayat_booking as $b): ?>
                        <tr class="hover:bg-gray-50 transition">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="font-semibold text-gray-900">#<?= esc($b['booking_id']) ?></span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center space-x-2">
                                    <div class="w-8 h-8 bg-indigo-100 rounded-lg flex items-center justify-center">
                                        <i class="fas fa-door-open text-indigo-600 text-sm"></i>
                                    </div>
                                    <span class="font-medium text-gray-900"><?= esc($b['kamar_id']) ?></span>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-gray-600">
                                <?= date('d/m/Y', strtotime($b['tanggal_booking'])) ?>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-gray-600">
                                <?= esc($b['durasi_sewa_bulan']) ?> Bulan
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <?php 
                                    $statusClasses = [
                                        'Menunggu' => 'badge-warning',
                                        'Diterima' => 'badge-success',
                                        'Ditolak' => 'badge-danger',
                                    ];
                                    $statusIcon = [
                                        'Menunggu' => 'fa-hourglass-half',
                                        'Diterima' => 'fa-check-circle',
                                        'Ditolak' => 'fa-times-circle',
                                    ];
                                    $status = $b['status'] ?? 'Menunggu';
                                ?>
                                <span class="badge <?= $statusClasses[$status] ?? 'badge-info' ?>">
                                    <i class="fas <?= $statusIcon[$status] ?? 'fa-info-circle' ?> mr-1"></i><?= $status ?>
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <a href="<?= base_url('penyewa/booking/' . $b['booking_id'] . '/detail') ?>" class="text-blue-600 hover:text-blue-700 font-medium text-sm flex items-center">
                                    <i class="fas fa-eye mr-1"></i>Lihat
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

    <?php if (!empty($riwayat_booking)): ?>
        <div class="px-6 py-4 bg-gray-50 border-t border-gray-200 text-center">
            <a href="<?= base_url('penyewa/riwayat-booking') ?>" class="text-blue-600 hover:text-blue-700 font-semibold inline-flex items-center smooth-transition">
                Lihat semua booking
                <i class="fas fa-arrow-right ml-2"></i>
            </a>
        </div>
    <?php endif; ?>
</div>

<?= $this->endSection() ?>