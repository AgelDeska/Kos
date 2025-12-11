<?= $this->extend('layout/admin_template') ?>

<?php helper('form'); ?>

<?= $this->section('content') ?>

<!-- Header -->
<div class="mb-8">
    <h2 class="text-3xl font-bold text-gray-900 flex items-center">
        <i class="fas fa-calendar-check text-purple-600 mr-3"></i>Verifikasi Booking
    </h2>
    <p class="text-gray-600 mt-1">Kelola permintaan booking dari penyewa</p>
</div>

<!-- Search & Filter Section -->
<div class="mb-6 bg-white rounded-xl shadow-md border border-gray-100 p-6">
    <form method="GET" action="<?= base_url('admin/booking') ?>" class="space-y-4">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-4 items-end">
            <!-- Search Input -->
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">
                    <i class="fas fa-search text-blue-600 mr-2"></i>Cari Booking
                </label>
                <input type="text" name="search" value="<?= esc($search) ?>" placeholder="Nama penyewa atau nomor kamar..." 
                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition">
            </div>

            <!-- Status Filter -->
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">
                    <i class="fas fa-filter text-purple-600 mr-2"></i>Status Booking
                </label>
                <select name="status" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent transition">
                    <option value="">Semua Status</option>
                    <option value="Menunggu" <?= $status === 'Menunggu' ? 'selected' : '' ?>>Menunggu</option>
                    <option value="Diterima" <?= $status === 'Diterima' ? 'selected' : '' ?>>Diterima</option>
                    <option value="Aktif" <?= $status === 'Aktif' ? 'selected' : '' ?>>Aktif</option>
                    <option value="Ditolak" <?= $status === 'Ditolak' ? 'selected' : '' ?>>Ditolak</option>
                </select>
            </div>

            <!-- Sort By -->
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">
                    <i class="fas fa-arrow-up-down text-green-600 mr-2"></i>Urutkan Berdasarkan
                </label>
                <select name="sortBy" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent transition">
                    <option value="tanggal_booking" <?= $sortBy === 'tanggal_booking' ? 'selected' : '' ?>>Tanggal Booking</option>
                    <option value="tanggal_mulai_sewa" <?= $sortBy === 'tanggal_mulai_sewa' ? 'selected' : '' ?>>Tanggal Mulai Sewa</option>
                    <option value="durasi_sewa_bulan" <?= $sortBy === 'durasi_sewa_bulan' ? 'selected' : '' ?>>Durasi</option>
                    <option value="status" <?= $sortBy === 'status' ? 'selected' : '' ?>>Status</option>
                </select>
            </div>

            <!-- Sort Order -->
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">
                    <i class="fas fa-sort text-orange-600 mr-2"></i>Urutan
                </label>
                <div class="flex gap-2">
                    <button type="submit" name="sortOrder" value="ASC" class="flex-1 px-4 py-2 <?= $sortOrder === 'ASC' ? 'bg-blue-600 text-white' : 'bg-gray-100 text-gray-700' ?> rounded-lg hover:bg-blue-600 hover:text-white transition font-semibold">
                        <i class="fas fa-arrow-up mr-1"></i>Naik
                    </button>
                    <button type="submit" name="sortOrder" value="DESC" class="flex-1 px-4 py-2 <?= $sortOrder === 'DESC' ? 'bg-blue-600 text-white' : 'bg-gray-100 text-gray-700' ?> rounded-lg hover:bg-blue-600 hover:text-white transition font-semibold">
                        <i class="fas fa-arrow-down mr-1"></i>Turun
                    </button>
                </div>
            </div>
        </div>

        <!-- Action Buttons -->
        <div class="flex gap-3 pt-2">
            <button type="submit" class="inline-flex items-center px-6 py-2 bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800 text-white font-semibold rounded-lg transition">
                <i class="fas fa-search mr-2"></i>Terapkan Filter
            </button>
            <a href="<?= base_url('admin/booking') ?>" class="inline-flex items-center px-6 py-2 bg-gray-200 hover:bg-gray-300 text-gray-800 font-semibold rounded-lg transition">
                <i class="fas fa-redo mr-2"></i>Reset
            </a>
        </div>
    </form>
</div>

<!-- Info Alert -->
<div class="mb-6 p-4 bg-blue-50 border-l-4 border-blue-600 rounded-lg">
    <div class="flex items-start">
        <i class="fas fa-info-circle text-blue-600 mt-1 mr-3 flex-shrink-0"></i>
        <div>
            <h4 class="font-bold text-blue-900 mb-1">Perhatian</h4>
            <p class="text-blue-800 text-sm">Permintaan booking dengan status <strong>Menunggu</strong> harus segera ditindaklanjuti. Ubah statusnya menjadi <strong>Diterima</strong> atau <strong>Ditolak</strong>.</p>
        </div>
    </div>
</div>

<!-- Booking Table Card -->
<div class="bg-white rounded-xl shadow-lg border border-gray-100 overflow-hidden">
    <!-- Header -->
    <div class="px-6 py-4 bg-gradient-to-r from-purple-50 to-indigo-50 border-b border-gray-200 flex items-center justify-between">
        <div class="flex items-center">
            <i class="fas fa-list text-purple-600 text-xl mr-3"></i>
            <h3 class="text-lg font-bold text-gray-900">Daftar Permintaan Booking</h3>
            <span class="ml-3 px-3 py-1 bg-purple-200 text-purple-800 rounded-full text-sm font-semibold">
                <?= count($bookings ?? []) ?> Booking
            </span>
        </div>
    </div>

    <!-- Table -->
    <div class="overflow-x-auto">
        <table class="w-full">
            <thead>
                <tr class="bg-gray-50 border-b border-gray-200">
                    <th class="px-6 py-3 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">ID</th>
                    <th class="px-6 py-3 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">Penyewa</th>
                    <th class="px-6 py-3 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">Kamar</th>
                    <th class="px-6 py-3 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">Tgl Booking</th>
                    <th class="px-6 py-3 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">Mulai Sewa</th>
                    <th class="px-6 py-3 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">Durasi</th>
                    <th class="px-6 py-3 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">Status</th>
                    <th class="px-6 py-3 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                <?php if (empty($bookings)): ?>
                    <tr>
                        <td colspan="8" class="px-6 py-12 text-center">
                            <div class="flex flex-col items-center justify-center">
                                <i class="fas fa-clipboard-list text-4xl text-gray-300 mb-3"></i>
                                <p class="text-gray-500 font-medium">Tidak ada permintaan booking saat ini</p>
                                <p class="text-gray-400 text-sm">Booking baru akan muncul di sini</p>
                            </div>
                        </td>
                    </tr>
                <?php else: ?>
                    <?php foreach ($bookings as $b): ?>
                    <tr class="hover:bg-gray-50 transition">
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="text-sm font-semibold text-gray-700">#<?= esc($b['booking_id']) ?></span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center">
                                <div class="w-8 h-8 bg-gradient-to-br from-purple-400 to-purple-600 rounded-full flex items-center justify-center text-white text-xs font-bold">
                                    <?= substr(esc($b['username']), 0, 1) ?>
                                </div>
                                <div class="ml-3">
                                    <p class="text-sm font-semibold text-gray-900"><?= esc($b['username']) ?></p>
                                    <p class="text-xs text-gray-500">ID: <?= esc($b['user_id']) ?></p>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="inline-flex items-center px-2 py-1 rounded-lg bg-gray-100 text-gray-800 text-sm font-semibold">
                                <i class="fas fa-door-open mr-1"></i><?= esc($b['nomor_kamar']) ?>
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">
                            <?= date('d M Y', strtotime(esc($b['tanggal_booking']))) ?>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">
                            <?= date('d M Y', strtotime(esc($b['tanggal_mulai_sewa']))) ?>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-semibold text-gray-700">
                            <?= esc($b['durasi_sewa_bulan']) ?> Bulan
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <?php 
                                $statusClass = $b['status'] == 'Menunggu' ? 'bg-yellow-100 text-yellow-800' : 
                                              ($b['status'] == 'Diterima' ? 'bg-blue-100 text-blue-800' : 
                                              ($b['status'] == 'Aktif' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800'));
                                $statusIcon = $b['status'] == 'Menunggu' ? 'fa-hourglass-half' : 
                                             ($b['status'] == 'Diterima' ? 'fa-check-circle' : 
                                             ($b['status'] == 'Aktif' ? 'fa-check' : 'fa-times-circle'));
                            ?>
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-semibold <?= $statusClass ?>">
                                <i class="fas <?= $statusIcon ?> mr-1"></i><?= esc($b['status']) ?>
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <?php if ($b['status'] == 'Menunggu'): ?>
                                <div class="flex gap-2">
                                    <?= form_open('admin/booking/verify/' . esc($b['booking_id']), ['class' => 'inline']) ?>
                                        <?= form_hidden('action', 'terima') ?>
                                        <button type="submit" class="inline-flex items-center px-3 py-2 rounded-lg bg-green-600 hover:bg-green-700 text-white text-sm font-semibold transition" onclick="return confirm('Terima booking ini?');">
                                            <i class="fas fa-check mr-1"></i>Terima
                                        </button>
                                    <?= form_close() ?>
                                    
                                    <?= form_open('admin/booking/verify/' . esc($b['booking_id']), ['class' => 'inline']) ?>
                                        <?= form_hidden('action', 'tolak') ?>
                                        <button type="submit" class="inline-flex items-center px-3 py-2 rounded-lg bg-red-600 hover:bg-red-700 text-white text-sm font-semibold transition" onclick="return confirm('Tolak booking ini?');">
                                            <i class="fas fa-times mr-1"></i>Tolak
                                        </button>
                                    <?= form_close() ?>
                                </div>
                            <?php else: ?>
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm text-gray-600 bg-gray-100">
                                    <i class="fas fa-check text-green-600 mr-1"></i>Diproses
                                </span>
                            <?php endif; ?>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<?= $this->endSection() ?>