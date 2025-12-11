<?= $this->extend('layout/admin_template') ?>

<?php helper('form'); ?>

<?= $this->section('content') ?>

<!-- Header -->
<div class="mb-8">
    <div class="flex items-center justify-between">
        <div>
            <h2 class="text-3xl font-bold text-gray-900 flex items-center">
                <i class="fas fa-receipt text-green-600 mr-3"></i>Catat Pembayaran Manual
            </h2>
            <p class="text-gray-600 mt-1">Catat transaksi pembayaran langsung dari penyewa</p>
        </div>
        <a href="<?= base_url('admin/pembayaran') ?>" class="inline-flex items-center px-6 py-3 bg-gray-200 hover:bg-gray-300 text-gray-800 font-semibold rounded-lg transition">
            <i class="fas fa-arrow-left mr-2"></i>Kembali
        </a>
    </div>
</div>

<!-- Form Container -->
<div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
    <!-- Form Section -->
    <div class="lg:col-span-2">
        <div class="bg-white rounded-2xl shadow-md border border-gray-100 p-8">
            <?= form_open('/admin/pembayaran/store', ['class' => 'space-y-6']) ?>
                
                <!-- Penyewa Selection -->
                <div>
                    <label for="user_id" class="block text-sm font-bold text-gray-700 mb-2">
                        <i class="fas fa-user text-green-600 mr-2"></i>Pilih Penyewa
                    </label>
                    <select name="user_id" id="user_id" required
                            class="w-full px-4 py-3 border <?= $validation->hasError('user_id') ? 'border-red-500 focus:ring-red-500' : 'border-gray-300 focus:ring-green-500' ?> rounded-lg focus:ring-2 focus:border-transparent transition appearance-none bg-white cursor-pointer">
                        <option value="">-- Pilih Penyewa --</option>
                        <?php foreach ($users as $user): ?>
                            <option value="<?= esc($user['user_id']) ?>" <?= old('user_id') == $user['user_id'] ? 'selected' : '' ?>>
                                <?= esc($user['nama']) ?> (<?= esc($user['username']) ?>)
                            </option>
                        <?php endforeach; ?>
                    </select>
                    <?php if ($validation->hasError('user_id')): ?>
                        <p class="mt-2 text-sm text-red-600 flex items-center">
                            <i class="fas fa-exclamation-circle mr-1"></i><?= $validation->getError('user_id') ?>
                        </p>
                    <?php endif; ?>
                </div>

                <!-- Kamar Selection -->
                <div>
                    <label for="kamar_id" class="block text-sm font-bold text-gray-700 mb-2">
                        <i class="fas fa-door-open text-green-600 mr-2"></i>Pilih Kamar
                    </label>
                    <select name="kamar_id" id="kamar_id" required
                            class="w-full px-4 py-3 border <?= $validation->hasError('kamar_id') ? 'border-red-500 focus:ring-red-500' : 'border-gray-300 focus:ring-green-500' ?> rounded-lg focus:ring-2 focus:border-transparent transition appearance-none bg-white cursor-pointer">
                        <option value="">-- Pilih Kamar --</option>
                        <?php foreach ($kamars as $kamar): ?>
                            <option value="<?= esc($kamar['kamar_id']) ?>" <?= old('kamar_id') == $kamar['kamar_id'] ? 'selected' : '' ?>>
                                No. <?= esc($kamar['nomor_kamar']) ?> (<?= esc($kamar['tipe_kamar']) ?>) - Rp <?= number_format($kamar['harga'], 0, ',', '.') ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                    <?php if ($validation->hasError('kamar_id')): ?>
                        <p class="mt-2 text-sm text-red-600 flex items-center">
                            <i class="fas fa-exclamation-circle mr-1"></i><?= $validation->getError('kamar_id') ?>
                        </p>
                    <?php endif; ?>
                </div>

                <!-- Payment Type -->
                <div>
                    <label for="jenis_pembayaran" class="block text-sm font-bold text-gray-700 mb-2">
                        <i class="fas fa-credit-card text-green-600 mr-2"></i>Jenis Pembayaran
                    </label>
                    <select name="jenis_pembayaran" id="jenis_pembayaran" required
                            class="w-full px-4 py-3 border <?= $validation->hasError('jenis_pembayaran') ? 'border-red-500 focus:ring-red-500' : 'border-gray-300 focus:ring-green-500' ?> rounded-lg focus:ring-2 focus:border-transparent transition appearance-none bg-white cursor-pointer">
                        <option value="">-- Pilih Jenis Pembayaran --</option>
                        <option value="Bulanan" <?= old('jenis_pembayaran') == 'Bulanan' ? 'selected' : '' ?>>Bulanan</option>
                        <option value="DP/Awal" <?= old('jenis_pembayaran') == 'DP/Awal' ? 'selected' : '' ?>>DP/Awal</option>
                    </select>
                    <?php if ($validation->hasError('jenis_pembayaran')): ?>
                        <p class="mt-2 text-sm text-red-600 flex items-center">
                            <i class="fas fa-exclamation-circle mr-1"></i><?= $validation->getError('jenis_pembayaran') ?>
                        </p>
                    <?php endif; ?>
                </div>

                <!-- Amount & Month Grid -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <!-- Jumlah -->
                    <div>
                        <label for="jumlah" class="block text-sm font-bold text-gray-700 mb-2">
                            <i class="fas fa-money-bill text-green-600 mr-2"></i>Jumlah Pembayaran (Rp)
                        </label>
                        <input type="number" name="jumlah" id="jumlah" required min="10000" 
                               value="<?= old('jumlah') ?>"
                               placeholder="Contoh: 500000"
                               class="w-full px-4 py-3 border <?= $validation->hasError('jumlah') ? 'border-red-500 focus:ring-red-500' : 'border-gray-300 focus:ring-green-500' ?> rounded-lg focus:ring-2 focus:border-transparent transition">
                        <?php if ($validation->hasError('jumlah')): ?>
                            <p class="mt-2 text-sm text-red-600 flex items-center">
                                <i class="fas fa-exclamation-circle mr-1"></i><?= $validation->getError('jumlah') ?>
                            </p>
                        <?php endif; ?>
                    </div>

                    <!-- Tagihan Bulan -->
                    <div>
                        <label for="tagihan_bulan" class="block text-sm font-bold text-gray-700 mb-2">
                            <i class="fas fa-calendar text-green-600 mr-2"></i>Untuk Tagihan Bulan
                        </label>
                        <input type="month" name="tagihan_bulan" id="tagihan_bulan" required
                               value="<?= old('tagihan_bulan') ?>"
                               class="w-full px-4 py-3 border <?= $validation->hasError('tagihan_bulan') ? 'border-red-500 focus:ring-red-500' : 'border-gray-300 focus:ring-green-500' ?> rounded-lg focus:ring-2 focus:border-transparent transition">
                        <?php if ($validation->hasError('tagihan_bulan')): ?>
                            <p class="mt-2 text-sm text-red-600 flex items-center">
                                <i class="fas fa-exclamation-circle mr-1"></i><?= $validation->getError('tagihan_bulan') ?>
                            </p>
                        <?php endif; ?>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="flex gap-4 pt-6 border-t border-gray-200">
                    <button type="submit" class="flex-1 inline-flex items-center justify-center px-6 py-3 bg-gradient-to-r from-green-600 to-green-700 hover:from-green-700 hover:to-green-800 text-white font-bold rounded-lg transition transform hover:scale-105 shadow-lg">
                        <i class="fas fa-save mr-2"></i>Simpan Pembayaran
                    </button>
                    <a href="<?= base_url('admin/pembayaran') ?>" class="flex-1 inline-flex items-center justify-center px-6 py-3 bg-gray-200 hover:bg-gray-300 text-gray-800 font-bold rounded-lg transition">
                        <i class="fas fa-times mr-2"></i>Batal
                    </a>
                </div>

            <?= form_close() ?>
        </div>
    </div>

    <!-- Info Sidebar -->
    <div class="lg:col-span-1">
        <!-- Info Card 1 -->
        <div class="bg-gradient-to-br from-blue-50 to-blue-100 rounded-2xl border border-blue-200 p-6 mb-6">
            <div class="flex items-start">
                <div class="w-12 h-12 bg-blue-500 rounded-xl flex items-center justify-center flex-shrink-0 mr-4">
                    <i class="fas fa-info-circle text-white text-lg"></i>
                </div>
                <div>
                    <h4 class="font-bold text-blue-900 mb-2">Informasi Pembayaran</h4>
                    <p class="text-sm text-blue-800">Catat setiap pembayaran yang diterima dari penyewa dengan detail yang lengkap dan akurat.</p>
                </div>
            </div>
        </div>

        <!-- Info Card 2 -->
        <div class="bg-gradient-to-br from-green-50 to-green-100 rounded-2xl border border-green-200 p-6 mb-6">
            <div class="flex items-start">
                <div class="w-12 h-12 bg-green-500 rounded-xl flex items-center justify-center flex-shrink-0 mr-4">
                    <i class="fas fa-check-circle text-white text-lg"></i>
                </div>
                <div>
                    <h4 class="font-bold text-green-900 mb-2">Jenis Pembayaran</h4>
                    <ul class="text-sm text-green-800 space-y-1">
                        <li><strong>Bulanan:</strong> Pembayaran sewa rutin</li>
                        <li><strong>DP/Awal:</strong> Uang jaminan awal</li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- Info Card 3 -->
        <div class="bg-gradient-to-br from-orange-50 to-orange-100 rounded-2xl border border-orange-200 p-6">
            <div class="flex items-start">
                <div class="w-12 h-12 bg-orange-500 rounded-xl flex items-center justify-center flex-shrink-0 mr-4">
                    <i class="fas fa-exclamation-triangle text-white text-lg"></i>
                </div>
                <div>
                    <h4 class="font-bold text-orange-900 mb-2">Catatan Penting</h4>
                    <p class="text-sm text-orange-800">Pembayaran yang dicatat akan langsung dianggap LUNAS. Pastikan data sudah benar sebelum menyimpan.</p>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>