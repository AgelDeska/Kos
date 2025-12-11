<?= $this->extend('layout/admin_template') ?>

<?php helper('form'); ?>

<?= $this->section('content') ?>

<!-- Header -->
<div class="mb-8">
    <h2 class="text-3xl font-bold text-gray-900 flex items-center">
        <i class="fas fa-plus-circle text-green-600 mr-3"></i>Tambah Kamar Baru
    </h2>
    <p class="text-gray-600 mt-1">Isi form di bawah untuk menambahkan kamar baru ke sistem</p>
</div>

<!-- Form Card -->
<div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
    <!-- Main Form -->
    <div class="lg:col-span-2">
        <div class="card bg-white rounded-xl shadow-lg border border-gray-100 overflow-hidden">
            <div class="p-6 border-b border-gray-200">
                <h3 class="text-lg font-bold text-gray-900">Informasi Kamar</h3>
            </div>

            <div class="p-6">
                <?= form_open_multipart('admin/kamar/store', ['class' => 'space-y-6']) ?>

                    <!-- Row 1: Nomor & Tipe -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label for="nomor_kamar" class="block text-sm font-semibold text-gray-700 mb-2">
                                <i class="fas fa-door-open text-blue-600 mr-2"></i>Nomor Kamar
                            </label>
                            <input type="text" id="nomor_kamar" name="nomor_kamar" value="<?= old('nomor_kamar') ?>" placeholder="Contoh: A-101" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-600 focus:border-transparent transition <?= $validation->hasError('nomor_kamar') ? 'border-red-500 ring-red-500 ring-2' : '' ?>" required>
                            <?php if ($validation->hasError('nomor_kamar')): ?>
                                <p class="text-red-600 text-sm mt-1 flex items-center"><i class="fas fa-alert-circle mr-1"></i><?= $validation->getError('nomor_kamar') ?></p>
                            <?php endif; ?>
                        </div>

                        <div>
                            <label for="tipe_kamar" class="block text-sm font-semibold text-gray-700 mb-2">
                                <i class="fas fa-tag text-purple-600 mr-2"></i>Tipe Kamar
                            </label>
                            <input type="text" id="tipe_kamar" name="tipe_kamar" value="<?= old('tipe_kamar') ?>" placeholder="Contoh: Single, Double, Premium" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-600 focus:border-transparent transition <?= $validation->hasError('tipe_kamar') ? 'border-red-500 ring-red-500 ring-2' : '' ?>" required>
                            <?php if ($validation->hasError('tipe_kamar')): ?>
                                <p class="text-red-600 text-sm mt-1 flex items-center"><i class="fas fa-alert-circle mr-1"></i><?= $validation->getError('tipe_kamar') ?></p>
                            <?php endif; ?>
                        </div>
                    </div>

                    <!-- Row 2: Kapasitas, Harga, Status -->
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <div>
                            <label for="kapasitas" class="block text-sm font-semibold text-gray-700 mb-2">
                                <i class="fas fa-users text-green-600 mr-2"></i>Kapasitas (Orang)
                            </label>
                            <input type="number" id="kapasitas" name="kapasitas" value="<?= old('kapasitas') ?>" min="1" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-600 focus:border-transparent transition <?= $validation->hasError('kapasitas') ? 'border-red-500 ring-red-500 ring-2' : '' ?>" required>
                            <?php if ($validation->hasError('kapasitas')): ?>
                                <p class="text-red-600 text-sm mt-1 flex items-center"><i class="fas fa-alert-circle mr-1"></i><?= $validation->getError('kapasitas') ?></p>
                            <?php endif; ?>
                        </div>

                        <div>
                            <label for="harga" class="block text-sm font-semibold text-gray-700 mb-2">
                                <i class="fas fa-money-bill-wave text-orange-600 mr-2"></i>Harga/Bulan (Rp)
                            </label>
                            <input type="number" id="harga" name="harga" value="<?= old('harga') ?>" min="100000" placeholder="Contoh: 500000" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-600 focus:border-transparent transition <?= $validation->hasError('harga') ? 'border-red-500 ring-red-500 ring-2' : '' ?>" required>
                            <?php if ($validation->hasError('harga')): ?>
                                <p class="text-red-600 text-sm mt-1 flex items-center"><i class="fas fa-alert-circle mr-1"></i><?= $validation->getError('harga') ?></p>
                            <?php endif; ?>
                        </div>

                        <div>
                            <label for="status" class="block text-sm font-semibold text-gray-700 mb-2">
                                <i class="fas fa-circle-notch text-blue-600 mr-2"></i>Status
                            </label>
                            <select id="status" name="status" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-600 focus:border-transparent transition <?= $validation->hasError('status') ? 'border-red-500 ring-red-500 ring-2' : '' ?>" required>
                                <option value="Tersedia" <?= old('status') == 'Tersedia' ? 'selected' : '' ?>>Tersedia</option>
                                <option value="Terisi" <?= old('status') == 'Terisi' ? 'selected' : '' ?>>Terisi</option>
                                <option value="Di Booking" <?= old('status') == 'Di Booking' ? 'selected' : '' ?>>Di Booking</option>
                            </select>
                            <?php if ($validation->hasError('status')): ?>
                                <p class="text-red-600 text-sm mt-1 flex items-center"><i class="fas fa-alert-circle mr-1"></i><?= $validation->getError('status') ?></p>
                            <?php endif; ?>
                        </div>
                    </div>

                    <!-- Description -->
                    <div>
                        <label for="deskripsi" class="block text-sm font-semibold text-gray-700 mb-2">
                            <i class="fas fa-align-left text-indigo-600 mr-2"></i>Deskripsi Kamar
                        </label>
                        <textarea id="deskripsi" name="deskripsi" rows="4" placeholder="Jelaskan detail kamar, fasilitas, dan keterangan penting lainnya..." class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-600 focus:border-transparent transition <?= $validation->hasError('deskripsi') ? 'border-red-500 ring-red-500 ring-2' : '' ?>"><?= old('deskripsi') ?></textarea>
                        <?php if ($validation->hasError('deskripsi')): ?>
                            <p class="text-red-600 text-sm mt-1 flex items-center"><i class="fas fa-alert-circle mr-1"></i><?= $validation->getError('deskripsi') ?></p>
                        <?php endif; ?>
                    </div>

                    <!-- Photo -->
                    <div>
                        <label for="foto_kamar" class="block text-sm font-semibold text-gray-700 mb-2">
                            <i class="fas fa-image text-pink-600 mr-2"></i>Foto Kamar
                        </label>
                        <div class="border-2 border-dashed border-gray-300 rounded-lg p-6 text-center hover:bg-gray-50 transition cursor-pointer" onclick="document.getElementById('foto_kamar').click()">
                            <i class="fas fa-cloud-upload-alt text-4xl text-gray-400 mb-2"></i>
                            <p class="text-gray-600 font-medium">Klik untuk upload atau drag & drop</p>
                            <p class="text-gray-500 text-sm">PNG, JPG, atau GIF (Max. 2MB)</p>
                            <input type="file" id="foto_kamar" name="foto_kamar" class="hidden" accept="image/*">
                        </div>
                        <?php if ($validation->hasError('foto_kamar')): ?>
                            <p class="text-red-600 text-sm mt-2 flex items-center"><i class="fas fa-alert-circle mr-1"></i><?= $validation->getError('foto_kamar') ?></p>
                        <?php endif; ?>
                    </div>

                    <!-- Buttons -->
                    <div class="flex gap-3 pt-4">
                        <button type="submit" class="flex-1 bg-gradient-to-r from-green-600 to-green-700 hover:from-green-700 hover:to-green-800 text-white font-semibold py-3 px-4 rounded-lg transition duration-200 transform hover:scale-105 flex items-center justify-center">
                            <i class="fas fa-save mr-2"></i>Simpan Kamar
                        </button>
                        <a href="<?= base_url('admin/kamar') ?>" class="flex-1 bg-gray-200 hover:bg-gray-300 text-gray-800 font-semibold py-3 px-4 rounded-lg transition duration-200 flex items-center justify-center">
                            <i class="fas fa-times mr-2"></i>Batal
                        </a>
                    </div>

                <?= form_close() ?>
            </div>
        </div>
    </div>

    <!-- Info Sidebar -->
    <div class="lg:col-span-1">
        <div class="bg-blue-50 border-l-4 border-blue-600 rounded-lg p-6">
            <h4 class="font-bold text-blue-900 mb-3 flex items-center">
                <i class="fas fa-info-circle text-blue-600 mr-2"></i>Panduan Pengisian
            </h4>
            <ul class="space-y-2 text-sm text-blue-800">
                <li class="flex items-start">
                    <i class="fas fa-check text-blue-600 mt-1 mr-2 flex-shrink-0"></i>
                    <span><strong>Nomor Kamar:</strong> Gunakan format yang konsisten (A-101, B-202, dll)</span>
                </li>
                <li class="flex items-start">
                    <i class="fas fa-check text-blue-600 mt-1 mr-2 flex-shrink-0"></i>
                    <span><strong>Tipe Kamar:</strong> Single, Double, atau tipe custom lainnya</span>
                </li>
                <li class="flex items-start">
                    <i class="fas fa-check text-blue-600 mt-1 mr-2 flex-shrink-0"></i>
                    <span><strong>Status:</strong> Tersedia = bisa dipesan, Terisi = ditempati, Di Booking = pending verifikasi</span>
                </li>
                <li class="flex items-start">
                    <i class="fas fa-check text-blue-600 mt-1 mr-2 flex-shrink-0"></i>
                    <span><strong>Harga Minimum:</strong> Rp 100.000 per bulan</span>
                </li>
            </ul>
        </div>
    </div>
</div>

<?= $this->endSection() ?>