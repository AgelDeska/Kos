<?= $this->extend('layout/admin_template') ?>

<?= $this->section('content') ?>

<!-- Header -->
<div class="mb-8">
    <div class="flex flex-col md:flex-row md:items-center md:justify-between">
        <div>
            <h2 class="text-3xl font-bold text-gray-900 flex items-center">
                <i class="fas fa-door-open text-blue-600 mr-3"></i>Kelola Data Kamar
            </h2>
            <p class="text-gray-600 mt-1">Manage semua kamar kos dan statusnya</p>
        </div>
        <div class="flex gap-3 mt-4 md:mt-0">
            <a href="<?= base_url('admin/kamar/create') ?>" class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800 text-white font-semibold rounded-lg transition transform hover:scale-105 shadow-lg">
                <i class="fas fa-plus mr-2"></i>Tambah Kamar Baru
            </a>
        </div>
    </div>
</div>

<!-- Search & Filter Section -->
<div class="mb-6 bg-white rounded-xl shadow-md border border-gray-100 p-6">
    <form method="GET" action="<?= base_url('admin/kamar') ?>" class="space-y-4">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-4 items-end">
            <!-- Search Input -->
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">
                    <i class="fas fa-search text-blue-600 mr-2"></i>Cari Kamar
                </label>
                <input type="text" name="search" value="<?= esc($search) ?>" placeholder="Nomor, tipe, atau deskripsi..." 
                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition">
            </div>

            <!-- Status Filter -->
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">
                    <i class="fas fa-filter text-blue-600 mr-2"></i>Status
                </label>
                <select name="status" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition">
                    <option value="">Semua Status</option>
                    <option value="Tersedia" <?= $status === 'Tersedia' ? 'selected' : '' ?>>Tersedia</option>
                    <option value="Di Booking" <?= $status === 'Di Booking' ? 'selected' : '' ?>>Di Booking</option>
                    <option value="Terisi" <?= $status === 'Terisi' ? 'selected' : '' ?>>Terisi</option>
                </select>
            </div>

            <!-- Sort By -->
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">
                    <i class="fas fa-arrow-up-down text-blue-600 mr-2"></i>Urutkan Berdasarkan
                </label>
                <select name="sortBy" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition">
                    <option value="nomor_kamar" <?= $sortBy === 'nomor_kamar' ? 'selected' : '' ?>>Nomor Kamar</option>
                    <option value="tipe_kamar" <?= $sortBy === 'tipe_kamar' ? 'selected' : '' ?>>Tipe Kamar</option>
                    <option value="harga" <?= $sortBy === 'harga' ? 'selected' : '' ?>>Harga</option>
                    <option value="kapasitas" <?= $sortBy === 'kapasitas' ? 'selected' : '' ?>>Kapasitas</option>
                    <option value="status" <?= $sortBy === 'status' ? 'selected' : '' ?>>Status</option>
                </select>
            </div>

            <!-- Sort Order -->
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">
                    <i class="fas fa-sort text-blue-600 mr-2"></i>Urutan
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
            <a href="<?= base_url('admin/kamar') ?>" class="inline-flex items-center px-6 py-2 bg-gray-200 hover:bg-gray-300 text-gray-800 font-semibold rounded-lg transition">
                <i class="fas fa-redo mr-2"></i>Reset
            </a>
        </div>
    </form>
</div>

<!-- Success Message -->
<?php if (session()->getFlashdata('success')): ?>
    <div class="mb-6 p-4 bg-green-50 border-l-4 border-green-600 rounded-lg">
        <div class="flex items-start">
            <i class="fas fa-check-circle text-green-600 mt-1 mr-3"></i>
            <div>
                <p class="font-semibold text-green-900"><?= session()->getFlashdata('success') ?></p>
            </div>
        </div>
    </div>
<?php endif; ?>

<!-- Error Message -->
<?php if (session()->getFlashdata('error')): ?>
    <div class="mb-6 p-4 bg-red-50 border-l-4 border-red-600 rounded-lg">
        <div class="flex items-start">
            <i class="fas fa-exclamation-circle text-red-600 mt-1 mr-3"></i>
            <div>
                <p class="font-semibold text-red-900"><?= session()->getFlashdata('error') ?></p>
            </div>
        </div>
    </div>
<?php endif; ?>

<!-- Table Card -->
<div class="card">
    <div class="card-header">
        <h3 class="text-lg font-bold text-gray-900 flex items-center">
            <i class="fas fa-list text-blue-600 mr-2"></i>Daftar Kamar Kos SmartKos
        </h3>
    </div>
    <div class="card-body overflow-x-auto">
        <table class="table-styled min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">ID</th>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Nomor Kamar</th>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Tipe</th>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Kapasitas</th>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Harga/Bulan</th>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Status</th>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Aksi</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                <?php if (empty($kamars)): ?>
                    <tr>
                        <td colspan="7" class="px-6 py-8 text-center">
                            <div class="flex flex-col items-center justify-center space-y-2">
                                <i class="fas fa-inbox text-4xl text-gray-300"></i>
                                <p class="text-gray-500 font-medium">Belum ada data kamar yang tercatat</p>
                                <p class="text-gray-400 text-sm">Mulai dengan menambah kamar baru</p>
                                <a href="<?= base_url('admin/kamar/create') ?>" class="btn btn-primary btn-sm mt-3 inline-flex items-center">
                                    <i class="fas fa-plus"></i><span>Tambah Kamar</span>
                                </a>
                            </div>
                        </td>
                    </tr>
                <?php else: ?>
                    <?php foreach ($kamars as $kamar): ?>
                    <tr class="hover:bg-gray-50 transition">
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">#<?= esc($kamar['kamar_id']) ?></td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center space-x-3">
                                <?php
                                $foto = $kamar['foto_kamar'] ?? null;
                                $displayPhoto = 'placeholder.jpg';

                                if ($foto) {
                                    $decoded = json_decode($foto, true);
                                    if (is_array($decoded) && !empty($decoded)) {
                                        $displayPhoto = $decoded[0]; // Show first photo
                                    } elseif (!empty($foto)) {
                                        $displayPhoto = $foto; // Legacy single photo
                                    }
                                }
                                ?>
                                <div class="w-14 h-10 rounded-lg overflow-hidden flex-shrink-0 bg-gray-100 border border-gray-200">
                                    <img src="<?= base_url('img/kamar/' . $displayPhoto) ?>" alt="Foto Kamar <?= esc($kamar['nomor_kamar']) ?>" class="w-full h-full object-cover" onerror="this.src='<?= base_url('img/kamar/placeholder.jpg') ?>'">
                                </div>
                                <div>
                                    <div class="font-bold text-gray-900"><?= esc($kamar['nomor_kamar']) ?></div>
                                    <div class="text-xs text-gray-500">Nomor: #<?= esc($kamar['kamar_id']) ?></div>
                                    <?php if ($foto): ?>
                                        <?php
                                        $decoded = json_decode($foto, true);
                                        $photoCount = is_array($decoded) ? count($decoded) : 1;
                                        ?>
                                        <div class="text-xs text-blue-600 flex items-center mt-1">
                                            <i class="fas fa-images mr-1"></i>
                                            <?= $photoCount ?> foto
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600"><?= esc($kamar['tipe_kamar']) ?></td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">
                            <div class="flex items-center">
                                <i class="fas fa-users text-gray-400 mr-2"></i><?= esc($kamar['kapasitas']) ?> orang
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-semibold text-blue-600">Rp <?= number_format(esc($kamar['harga']), 0, ',', '.') ?></td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <?php 
                                $current = $kamar['status'];
                                $badgeClass = $current == 'Tersedia' ? 'bg-green-100 text-green-800' : ($current == 'Di Booking' ? 'bg-yellow-100 text-yellow-800' : 'bg-red-100 text-red-800');
                            ?>

                            <form method="post" action="<?= base_url('admin/kamar/status/' . esc($kamar['kamar_id'])) ?>" class="inline-flex items-center" onsubmit="return confirm('Ubah status kamar <?= esc($kamar['nomor_kamar']) ?>?');">
                                <?= csrf_field() ?>
                                <select name="status" onchange="this.form.submit()" class="px-2 py-1 rounded-md border border-gray-200 bg-white text-sm font-semibold">
                                    <option value="Tersedia" <?= $current == 'Tersedia' ? 'selected' : '' ?>>Tersedia</option>
                                    <option value="Di Booking" <?= $current == 'Di Booking' ? 'selected' : '' ?>>Di Booking</option>
                                    <option value="Terisi" <?= $current == 'Terisi' ? 'selected' : '' ?>>Terisi</option>
                                    <option value="Perbaikan" <?= $current == 'Perbaikan' ? 'selected' : '' ?>>Perbaikan</option>
                                </select>
                                <noscript>
                                    <button type="submit" class="ml-2 px-2 py-1 text-sm rounded bg-blue-600 text-white">Update</button>
                                </noscript>
                            </form>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium space-x-2">
                            <a href="<?= base_url('admin/kamar/edit/' . esc($kamar['kamar_id'])) ?>" class="btn btn-ghost btn-sm inline-flex items-center">
                                <i class="fas fa-edit"></i> Edit
                            </a>
                            <a href="<?= base_url('admin/kamar/delete/' . esc($kamar['kamar_id'])) ?>" data-confirm="Yakin ingin menghapus kamar No. <?= esc($kamar['nomor_kamar']) ?>? Data terkait mungkin ikut terhapus!" class="btn btn-danger btn-sm inline-flex items-center">
                                <i class="fas fa-trash"></i> Hapus
                            </a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<?= $this->endSection() ?>