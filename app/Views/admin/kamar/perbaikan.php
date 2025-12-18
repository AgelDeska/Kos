<?= $this->extend('layout/admin_template') ?>

<?= $this->section('content') ?>

<!-- Header -->
<div class="mb-8">
    <div class="flex flex-col md:flex-row md:items-center md:justify-between">
        <div>
            <h2 class="text-3xl font-bold text-gray-900 flex items-center">
                <i class="fas fa-tools text-orange-600 mr-3"></i>Kelola Kamar Perbaikan
            </h2>
            <p class="text-gray-600 mt-1">Pantau dan kelola kamar yang sedang dalam perbaikan</p>
        </div>
        <a href="<?= base_url('admin/kamar') ?>" class="mt-4 md:mt-0 inline-flex items-center px-6 py-3 bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800 text-white font-semibold rounded-lg transition transform hover:scale-105 shadow-lg">
            <i class="fas fa-arrow-left mr-2"></i>Kembali ke Kelola Kamar
        </a>
    </div>
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

<!-- Stats Cards -->
<div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
    <div class="bg-gradient-to-r from-orange-500 to-orange-600 rounded-xl p-6 text-white">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-orange-100 text-sm font-medium">Total Kamar Perbaikan</p>
                <p class="text-3xl font-bold"><?= count($kamars) ?></p>
            </div>
            <div class="bg-orange-400 bg-opacity-30 p-3 rounded-lg">
                <i class="fas fa-tools text-2xl"></i>
            </div>
        </div>
    </div>

    <div class="bg-gradient-to-r from-blue-500 to-blue-600 rounded-xl p-6 text-white">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-blue-100 text-sm font-medium">Kamar Tersedia</p>
                <p class="text-3xl font-bold">
                    <?php
                    $tersedia = $this->kamarModel->where('status', 'Tersedia')->countAllResults();
                    echo $tersedia;
                    ?>
                </p>
            </div>
            <div class="bg-blue-400 bg-opacity-30 p-3 rounded-lg">
                <i class="fas fa-check-circle text-2xl"></i>
            </div>
        </div>
    </div>

    <div class="bg-gradient-to-r from-green-500 to-green-600 rounded-xl p-6 text-white">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-green-100 text-sm font-medium">Total Kamar</p>
                <p class="text-3xl font-bold">
                    <?php
                    $total = $this->kamarModel->countAllResults();
                    echo $total;
                    ?>
                </p>
            </div>
            <div class="bg-green-400 bg-opacity-30 p-3 rounded-lg">
                <i class="fas fa-building text-2xl"></i>
            </div>
        </div>
    </div>
</div>

<!-- Kamar Perbaikan Table -->
<div class="bg-white rounded-xl shadow-lg border border-gray-100 overflow-hidden">
    <div class="px-6 py-4 border-b border-gray-200">
        <h3 class="text-lg font-semibold text-gray-900 flex items-center">
            <i class="fas fa-wrench text-orange-600 mr-2"></i>Daftar Kamar Dalam Perbaikan
        </h3>
    </div>

    <div class="overflow-x-auto">
        <?php if (empty($kamars)): ?>
            <div class="text-center py-12">
                <div class="mx-auto w-24 h-24 bg-orange-100 rounded-full flex items-center justify-center mb-4">
                    <i class="fas fa-tools text-4xl text-orange-600"></i>
                </div>
                <h3 class="text-xl font-semibold text-gray-900 mb-2">Tidak Ada Kamar Dalam Perbaikan</h3>
                <p class="text-gray-600 mb-6">Semua kamar dalam kondisi baik dan tersedia untuk disewa.</p>
                <a href="<?= base_url('admin/kamar') ?>" class="inline-flex items-center px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded-lg transition">
                    <i class="fas fa-plus mr-2"></i>Kelola Kamar
                </a>
            </div>
        <?php else: ?>
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Kamar</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tipe</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Kapasitas</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Harga</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    <?php foreach ($kamars as $kamar): ?>
                        <tr class="hover:bg-gray-50">
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
                                <span class="px-2 py-1 text-xs font-semibold rounded-full bg-orange-100 text-orange-800">
                                    <i class="fas fa-tools mr-1"></i>Perbaikan
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium space-x-2">
                                <a href="<?= base_url('admin/kamar/edit/' . esc($kamar['kamar_id'])) ?>" class="text-blue-600 hover:text-blue-900 inline-flex items-center">
                                    <i class="fas fa-edit mr-1"></i>Edit
                                </a>
                                <form method="post" action="<?= base_url('admin/kamar/selesai-perbaikan/' . esc($kamar['kamar_id'])) ?>" class="inline-block" onsubmit="return confirm('Tandai kamar <?= esc($kamar['nomor_kamar']) ?> sudah selesai diperbaiki?');">
                                    <?= csrf_field() ?>
                                    <button type="submit" class="text-green-600 hover:text-green-900 inline-flex items-center">
                                        <i class="fas fa-check mr-1"></i>Selesai
                                    </button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php endif; ?>
    </div>
</div>

<!-- Info Section -->
<div class="mt-8 bg-orange-50 border border-orange-200 rounded-xl p-6">
    <div class="flex items-start">
        <i class="fas fa-info-circle text-orange-600 mt-1 mr-3"></i>
        <div>
            <h4 class="font-semibold text-orange-900 mb-2">Panduan Kelola Perbaikan</h4>
            <ul class="text-sm text-orange-800 space-y-1">
                <li>• <strong>Status Perbaikan:</strong> Kamar dengan status ini tidak dapat dipesan penyewa</li>
                <li>• <strong>Selesai Perbaikan:</strong> Klik tombol "Selesai" untuk mengubah status menjadi "Tersedia"</li>
                <li>• <strong>Edit Kamar:</strong> Masih dapat mengubah detail kamar meskipun sedang diperbaiki</li>
                <li>• <strong>Monitoring:</strong> Gunakan halaman ini untuk memantau progress perbaikan</li>
            </ul>
        </div>
    </div>
</div>

<?= $this->endSection() ?>