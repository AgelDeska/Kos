<?= $this->extend('layout/admin_template') ?>

<?= $this->section('content') ?>

<!-- Welcome Banner -->
<div class="mb-8 bg-gradient-to-r from-indigo-600 via-purple-600 to-pink-600 rounded-2xl shadow-lg p-8 text-white overflow-hidden relative">
    <div class="absolute top-0 right-0 w-40 h-40 bg-white/10 rounded-full -mr-20 -mt-20"></div>
    <div class="absolute bottom-0 left-0 w-32 h-32 bg-white/10 rounded-full -ml-16 -mb-16"></div>
    <div class="relative z-10">
        <h1 class="text-3xl font-bold mb-2">Selamat datang, Admin! 👋</h1>
        <p class="text-indigo-100">Kelola kos dengan mudah melalui dashboard yang intuitif dan informatif</p>
    </div>
</div>

<!-- Statistics Cards Grid -->
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
    <!-- Total Kamar -->
    <div class="group bg-white rounded-2xl shadow-md hover:shadow-2xl transition duration-300 transform hover:-translate-y-1 border border-gray-100 overflow-hidden">
        <div class="bg-gradient-to-br from-blue-50 via-blue-100 to-blue-50 p-6 relative">
            <div class="absolute top-0 right-0 w-24 h-24 bg-blue-200/20 rounded-full -mr-12 -mt-12"></div>
            <div class="flex items-center justify-between relative z-10">
                <div>
                    <p class="text-sm font-semibold text-gray-600 mb-1 uppercase tracking-wider">Total Kamar</p>
                    <h3 class="text-4xl font-bold text-gray-900 mb-2"><?= $total_kamar ?></h3>
                    <div class="flex items-center text-xs font-medium">
                        <span class="inline-block w-2 h-2 bg-green-500 rounded-full mr-2"></span>
                        <span class="text-green-700"><?= $kamar_tersedia ?> tersedia</span>
                    </div>
                </div>
                <div class="w-20 h-20 bg-gradient-to-br from-blue-500 to-blue-600 rounded-2xl flex items-center justify-center shadow-lg group-hover:scale-110 transition duration-300">
                    <i class="fas fa-door-open text-3xl text-white"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Kamar Terisi -->
    <div class="group bg-white rounded-2xl shadow-md hover:shadow-2xl transition duration-300 transform hover:-translate-y-1 border border-gray-100 overflow-hidden">
        <div class="bg-gradient-to-br from-green-50 via-green-100 to-green-50 p-6 relative">
            <div class="absolute top-0 right-0 w-24 h-24 bg-green-200/20 rounded-full -mr-12 -mt-12"></div>
            <div class="flex items-center justify-between relative z-10">
                <div>
                    <p class="text-sm font-semibold text-gray-600 mb-1 uppercase tracking-wider">Okupansi</p>
                    <h3 class="text-4xl font-bold text-gray-900 mb-2"><?= $kamar_terisi ?>/<?= $total_kamar ?></h3>
                    <div class="flex items-center text-xs font-medium">
                        <span class="inline-block w-2 h-2 bg-green-500 rounded-full mr-2"></span>
                        <span class="text-green-700"><?= $total_kamar > 0 ? round(($kamar_terisi / $total_kamar) * 100, 1) : 0 ?>% penuh</span>
                    </div>
                </div>
                <div class="w-20 h-20 bg-gradient-to-br from-green-500 to-green-600 rounded-2xl flex items-center justify-center shadow-lg group-hover:scale-110 transition duration-300">
                    <i class="fas fa-chart-pie text-3xl text-white"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Booking Pending -->
    <div class="group bg-white rounded-2xl shadow-md hover:shadow-2xl transition duration-300 transform hover:-translate-y-1 border border-gray-100 overflow-hidden">
        <div class="bg-gradient-to-br from-orange-50 via-orange-100 to-orange-50 p-6 relative">
            <div class="absolute top-0 right-0 w-24 h-24 bg-orange-200/20 rounded-full -mr-12 -mt-12"></div>
            <div class="flex items-center justify-between relative z-10">
                <div>
                    <p class="text-sm font-semibold text-gray-600 mb-1 uppercase tracking-wider">Booking Pending</p>
                    <h3 class="text-4xl font-bold text-orange-600 mb-2"><?= $booking_menunggu ?></h3>
                    <div class="flex items-center text-xs font-medium">
                        <span class="inline-block w-2 h-2 bg-orange-500 rounded-full mr-2"></span>
                        <span class="text-orange-700">Perlu verifikasi</span>
                    </div>
                </div>
                <div class="w-20 h-20 bg-gradient-to-br from-orange-500 to-orange-600 rounded-2xl flex items-center justify-center shadow-lg group-hover:scale-110 transition duration-300">
                    <i class="fas fa-hourglass-end text-3xl text-white"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Total Penyewa -->
    <div class="group bg-white rounded-2xl shadow-md hover:shadow-2xl transition duration-300 transform hover:-translate-y-1 border border-gray-100 overflow-hidden">
        <div class="bg-gradient-to-br from-purple-50 via-purple-100 to-purple-50 p-6 relative">
            <div class="absolute top-0 right-0 w-24 h-24 bg-purple-200/20 rounded-full -mr-12 -mt-12"></div>
            <div class="flex items-center justify-between relative z-10">
                <div>
                    <p class="text-sm font-semibold text-gray-600 mb-1 uppercase tracking-wider">Total Penyewa</p>
                    <h3 class="text-4xl font-bold text-gray-900 mb-2"><?= $total_penyewa ?></h3>
                    <div class="flex items-center text-xs font-medium">
                        <span class="inline-block w-2 h-2 bg-purple-500 rounded-full mr-2"></span>
                        <span class="text-purple-700">Pengguna aktif</span>
                    </div>
                </div>
                <div class="w-20 h-20 bg-gradient-to-br from-purple-500 to-purple-600 rounded-2xl flex items-center justify-center shadow-lg group-hover:scale-110 transition duration-300">
                    <i class="fas fa-users text-3xl text-white"></i>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Quick Actions & Status Section -->
<div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-8">
    <!-- Quick Actions -->
    <div class="bg-white rounded-2xl shadow-md border border-gray-100 p-6">
        <h3 class="text-lg font-bold text-gray-900 mb-4 flex items-center">
            <i class="fas fa-bolt text-yellow-500 mr-2"></i>Aksi Cepat
        </h3>
        <div class="space-y-3">
            <a href="<?= base_url('admin/kamar/create') ?>" class="group flex items-center p-4 bg-gradient-to-r from-blue-50 to-blue-100 hover:from-blue-100 hover:to-blue-200 rounded-xl transition duration-300 border border-blue-200">
                <div class="w-10 h-10 bg-blue-500 rounded-lg flex items-center justify-center mr-3 group-hover:scale-110 transition duration-300">
                    <i class="fas fa-plus text-white"></i>
                </div>
                <span class="font-semibold text-blue-900">Tambah Kamar Baru</span>
            </a>
            <a href="<?= base_url('admin/booking') ?>" class="group flex items-center p-4 bg-gradient-to-r from-orange-50 to-orange-100 hover:from-orange-100 hover:to-orange-200 rounded-xl transition duration-300 border border-orange-200">
                <div class="w-10 h-10 bg-orange-500 rounded-lg flex items-center justify-center mr-3 group-hover:scale-110 transition duration-300">
                    <i class="fas fa-calendar-check text-white"></i>
                </div>
                <span class="font-semibold text-orange-900">Verifikasi Booking</span>
            </a>
            <a href="<?= base_url('admin/pembayaran') ?>" class="group flex items-center p-4 bg-gradient-to-r from-green-50 to-green-100 hover:from-green-100 hover:to-green-200 rounded-xl transition duration-300 border border-green-200">
                <div class="w-10 h-10 bg-green-500 rounded-lg flex items-center justify-center mr-3 group-hover:scale-110 transition duration-300">
                    <i class="fas fa-credit-card text-white"></i>
                </div>
                <span class="font-semibold text-green-900">Verifikasi Pembayaran</span>
            </a>
            <a href="<?= base_url('admin/penyewa') ?>" class="group flex items-center p-4 bg-gradient-to-r from-purple-50 to-purple-100 hover:from-purple-100 hover:to-purple-200 rounded-xl transition duration-300 border border-purple-200">
                <div class="w-10 h-10 bg-purple-500 rounded-lg flex items-center justify-center mr-3 group-hover:scale-110 transition duration-300">
                    <i class="fas fa-users text-white"></i>
                </div>
                <span class="font-semibold text-purple-900">Kelola Penyewa</span>
            </a>
        </div>
    </div>

    <!-- System Status -->
    <div class="lg:col-span-2 bg-white rounded-2xl shadow-md border border-gray-100 p-6">
        <h3 class="text-lg font-bold text-gray-900 mb-4 flex items-center">
            <i class="fas fa-heartbeat text-red-500 mr-2"></i>Status Sistem
        </h3>
        <div class="grid grid-cols-2 gap-3">
            <div class="p-4 bg-gradient-to-br from-blue-50 to-blue-100 rounded-xl border border-blue-200">
                <p class="text-xs font-semibold text-gray-600 mb-1 uppercase">Kamar Total</p>
                <h4 class="text-2xl font-bold text-blue-600"><?= $total_kamar ?></h4>
                <p class="text-xs text-gray-500 mt-1">
                    <i class="fas fa-check-circle text-green-500 mr-1"></i><?= $kamar_tersedia ?> tersedia
                </p>
            </div>
            <div class="p-4 bg-gradient-to-br from-green-50 to-green-100 rounded-xl border border-green-200">
                <p class="text-xs font-semibold text-gray-600 mb-1 uppercase">Penyewa</p>
                <h4 class="text-2xl font-bold text-green-600"><?= $total_penyewa ?></h4>
                <p class="text-xs text-gray-500 mt-1">
                    <i class="fas fa-user-check text-green-500 mr-1"></i>Terdaftar
                </p>
            </div>
            <div class="p-4 bg-gradient-to-br from-orange-50 to-orange-100 rounded-xl border border-orange-200">
                <p class="text-xs font-semibold text-gray-600 mb-1 uppercase">Booking Pending</p>
                <h4 class="text-2xl font-bold text-orange-600"><?= $booking_menunggu ?></h4>
                <p class="text-xs text-gray-500 mt-1">
                    <i class="fas fa-hourglass mr-1 text-orange-500"></i>Menunggu tindakan
                </p>
            </div>
            <div class="p-4 bg-gradient-to-br from-red-50 to-red-100 rounded-xl border border-red-200">
                <p class="text-xs font-semibold text-gray-600 mb-1 uppercase">Pembayaran Pending</p>
                <h4 class="text-2xl font-bold text-red-600"><?= $pembayaran_pending ?></h4>
                <p class="text-xs text-gray-500 mt-1">
                    <i class="fas fa-file-invoice mr-1 text-red-500"></i>Verifikasi
                </p>
            </div>
        </div>
    </div>
</div>

<!-- Recent Bookings Table -->
<div class="bg-white rounded-2xl shadow-md border border-gray-100 overflow-hidden">
    <div class="px-6 py-6 border-b border-gray-200 bg-gradient-to-r from-indigo-50 to-purple-50">
        <h3 class="text-lg font-bold text-gray-900 flex items-center">
            <div class="w-10 h-10 bg-indigo-600 rounded-xl flex items-center justify-center mr-3">
                <i class="fas fa-list-check text-white"></i>
            </div>
            Booking Terbaru (Status Menunggu)
        </h3>
    </div>
    
    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50 border-b border-gray-200">
                <tr>
                    <th class="px-6 py-4 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">Penyewa</th>
                    <th class="px-6 py-4 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">Kamar</th>
                    <th class="px-6 py-4 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">Tanggal Booking</th>
                    <th class="px-6 py-4 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">Durasi</th>
                    <th class="px-6 py-4 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">Status</th>
                    <th class="px-6 py-4 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">Aksi</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                <?php if (!empty($recent_bookings)): ?>
                    <?php foreach ($recent_bookings as $booking): ?>
                    <tr class="hover:bg-gray-50 transition duration-150">
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center space-x-3">
                                <div class="w-9 h-9 bg-gradient-to-br from-indigo-400 to-purple-400 rounded-full flex items-center justify-center flex-shrink-0">
                                    <i class="fas fa-user text-white text-xs font-bold"></i>
                                </div>
                                <span class="font-semibold text-gray-900"><?= esc($booking['username'] ?? 'N/A') ?></span>
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center">
                                <i class="fas fa-door-open text-blue-500 mr-2"></i>
                                <span class="font-medium text-gray-900"><?= esc($booking['nomor_kamar'] ?? 'N/A') ?></span>
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">
                            <i class="fas fa-calendar text-gray-400 mr-2"></i><?= date('d M Y', strtotime($booking['tanggal_booking'])) ?>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center">
                                <i class="fas fa-hourglass-half text-orange-400 mr-2"></i>
                                <span class="font-medium text-gray-900"><?= esc($booking['durasi_sewa_bulan']) ?> Bulan</span>
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="px-3 py-2 inline-flex items-center text-xs leading-5 font-bold rounded-full bg-yellow-100 text-yellow-800 border border-yellow-300">
                                <span class="w-2 h-2 bg-yellow-500 rounded-full mr-2 inline-block"></span>
                                <?= esc($booking['status']) ?>
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                            <a href="<?= base_url('admin/booking') ?>" class="inline-flex items-center px-4 py-2 bg-gradient-to-r from-blue-500 to-blue-600 text-white rounded-lg hover:shadow-lg hover:-translate-y-0.5 transition duration-200 font-semibold">
                                <i class="fas fa-check-circle mr-2 text-sm"></i>Verifikasi
                            </a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="6" class="px-6 py-12 text-center">
                            <div class="flex flex-col items-center justify-center">
                                <i class="fas fa-inbox text-4xl text-gray-300 mb-3"></i>
                                <p class="text-gray-500 font-medium">Tidak ada booking yang perlu diverifikasi</p>
                                <p class="text-gray-400 text-sm mt-1">Semua booking sudah terverifikasi</p>
                            </div>
                        </td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
    
    <div class="px-6 py-4 bg-gradient-to-r from-gray-50 to-gray-100 border-t border-gray-200 flex items-center justify-between">
        <p class="text-sm text-gray-600">
            Menampilkan <span class="font-semibold"><?= count($recent_bookings ?? []) ?></span> booking dengan status menunggu
        </p>
        <a href="<?= base_url('admin/booking') ?>" class="text-indigo-600 hover:text-indigo-700 font-bold inline-flex items-center group">
            Lihat semua booking
            <i class="fas fa-arrow-right ml-2 group-hover:translate-x-1 transition duration-200"></i>
        </a>
    </div>
</div>

<?= $this->endSection() ?>