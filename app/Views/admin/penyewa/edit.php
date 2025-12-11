<?= $this->extend('layout/admin_template') ?>

<?php helper('form'); ?>

<?= $this->section('content') ?>

<!-- Header -->
<div class="mb-8">
    <div class="flex items-center justify-between">
        <div>
            <h2 class="text-3xl font-bold text-gray-900 flex items-center">
                <i class="fas fa-user-edit text-orange-600 mr-3"></i>Edit Penyewa
            </h2>
            <p class="text-gray-600 mt-1">Perbarui informasi penyewa <span class="font-semibold"><?= esc($penyewa['nama']) ?></span></p>
        </div>
        <a href="<?= base_url('admin/penyewa') ?>" class="inline-flex items-center px-6 py-3 bg-gray-200 hover:bg-gray-300 text-gray-800 font-semibold rounded-lg transition">
            <i class="fas fa-arrow-left mr-2"></i>Kembali
        </a>
    </div>
</div>

<!-- Form Container -->
<div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
    <!-- Form Section -->
    <div class="lg:col-span-2">
        <div class="bg-white rounded-2xl shadow-md border border-gray-100 p-8">
            <?= form_open('/admin/penyewa/update/' . esc($penyewa['user_id']), ['class' => 'space-y-6']) ?>

                <!-- Nama Penyewa -->
                <div>
                    <label for="nama" class="block text-sm font-bold text-gray-700 mb-2">
                        <i class="fas fa-user text-blue-600 mr-2"></i>Nama Lengkap
                    </label>
                    <input type="text" name="nama" id="nama" required
                           value="<?= old('nama', esc($penyewa['nama'])) ?>"
                           placeholder="Contoh: Budi Santoso"
                           class="w-full px-4 py-3 border <?= $validation->hasError('nama') ? 'border-red-500 focus:ring-red-500' : 'border-gray-300 focus:ring-green-500' ?> rounded-lg focus:ring-2 focus:border-transparent transition">
                    <?php if ($validation->hasError('nama')): ?>
                        <p class="mt-2 text-sm text-red-600 flex items-center">
                            <i class="fas fa-exclamation-circle mr-1"></i><?= $validation->getError('nama') ?>
                        </p>
                    <?php endif; ?>
                </div>

                <!-- Email -->
                <div>
                    <label for="email" class="block text-sm font-bold text-gray-700 mb-2">
                        <i class="fas fa-envelope text-blue-600 mr-2"></i>Email
                    </label>
                    <input type="email" name="email" id="email" required
                           value="<?= old('email', esc($penyewa['email'])) ?>"
                           placeholder="Contoh: budi@example.com"
                           class="w-full px-4 py-3 border <?= $validation->hasError('email') ? 'border-red-500 focus:ring-red-500' : 'border-gray-300 focus:ring-green-500' ?> rounded-lg focus:ring-2 focus:border-transparent transition">
                    <?php if ($validation->hasError('email')): ?>
                        <p class="mt-2 text-sm text-red-600 flex items-center">
                            <i class="fas fa-exclamation-circle mr-1"></i><?= $validation->getError('email') ?>
                        </p>
                    <?php endif; ?>
                </div>

                <!-- Username & No Telp Grid (Read-only username) -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <!-- Username (Read-only) -->
                    <div>
                        <label for="username" class="block text-sm font-bold text-gray-700 mb-2">
                            <i class="fas fa-at text-gray-600 mr-2"></i>Username
                        </label>
                        <input type="text" id="username" disabled
                               value="<?= esc($penyewa['username']) ?>"
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg bg-gray-100 text-gray-600 cursor-not-allowed">
                        <p class="text-xs text-gray-500 mt-1">Username tidak dapat diubah</p>
                    </div>

                    <!-- No Telp -->
                    <div>
                        <label for="no_telp" class="block text-sm font-bold text-gray-700 mb-2">
                            <i class="fas fa-phone text-blue-600 mr-2"></i>Nomor Telepon
                        </label>
                        <input type="tel" name="no_telp" id="no_telp" required
                               value="<?= old('no_telp', esc($penyewa['no_telp'])) ?>"
                               placeholder="Contoh: 081234567890"
                               class="w-full px-4 py-3 border <?= $validation->hasError('no_telp') ? 'border-red-500 focus:ring-red-500' : 'border-gray-300 focus:ring-green-500' ?> rounded-lg focus:ring-2 focus:border-transparent transition">
                        <?php if ($validation->hasError('no_telp')): ?>
                            <p class="mt-2 text-sm text-red-600 flex items-center">
                                <i class="fas fa-exclamation-circle mr-1"></i><?= $validation->getError('no_telp') ?>
                            </p>
                        <?php endif; ?>
                    </div>
                </div>

                <!-- Password Section -->
                <div class="border-t-2 border-gray-200 pt-6">
                    <h3 class="text-lg font-bold text-gray-900 mb-4 flex items-center">
                        <i class="fas fa-key text-orange-600 mr-2"></i>Ubah Password (Opsional)
                    </h3>
                    <p class="text-sm text-gray-600 mb-4">Biarkan kosong jika tidak ingin mengubah password</p>

                    <!-- Password & Confirm Password Grid -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <!-- Password -->
                        <div>
                            <label for="password" class="block text-sm font-bold text-gray-700 mb-2">
                                <i class="fas fa-lock text-blue-600 mr-2"></i>Password Baru
                            </label>
                            <input type="password" name="password" id="password"
                                   placeholder="Minimal 6 karakter (biarkan kosong untuk tidak mengubah)"
                                   class="w-full px-4 py-3 border <?= $validation->hasError('password') ? 'border-red-500 focus:ring-red-500' : 'border-gray-300 focus:ring-green-500' ?> rounded-lg focus:ring-2 focus:border-transparent transition">
                            <?php if ($validation->hasError('password')): ?>
                                <p class="mt-2 text-sm text-red-600 flex items-center">
                                    <i class="fas fa-exclamation-circle mr-1"></i><?= $validation->getError('password') ?>
                                </p>
                            <?php endif; ?>
                        </div>

                        <!-- Confirm Password -->
                        <div>
                            <label for="confirm_password" class="block text-sm font-bold text-gray-700 mb-2">
                                <i class="fas fa-lock-open text-blue-600 mr-2"></i>Konfirmasi Password
                            </label>
                            <input type="password" name="confirm_password" id="confirm_password"
                                   placeholder="Ulangi password baru"
                                   class="w-full px-4 py-3 border <?= $validation->hasError('confirm_password') ? 'border-red-500 focus:ring-red-500' : 'border-gray-300 focus:ring-green-500' ?> rounded-lg focus:ring-2 focus:border-transparent transition">
                            <?php if ($validation->hasError('confirm_password')): ?>
                                <p class="mt-2 text-sm text-red-600 flex items-center">
                                    <i class="fas fa-exclamation-circle mr-1"></i><?= $validation->getError('confirm_password') ?>
                                </p>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="flex gap-4 pt-6 border-t border-gray-200">
                    <button type="submit" class="flex-1 inline-flex items-center justify-center px-6 py-3 bg-gradient-to-r from-orange-600 to-orange-700 hover:from-orange-700 hover:to-orange-800 text-white font-bold rounded-lg transition transform hover:scale-105 shadow-lg">
                        <i class="fas fa-save mr-2"></i>Perbarui Penyewa
                    </button>
                    <a href="<?= base_url('admin/penyewa') ?>" class="flex-1 inline-flex items-center justify-center px-6 py-3 bg-gray-200 hover:bg-gray-300 text-gray-800 font-bold rounded-lg transition">
                        <i class="fas fa-times mr-2"></i>Batal
                    </a>
                </div>

            <?= form_close() ?>
        </div>
    </div>

    <!-- Info Sidebar -->
    <div class="lg:col-span-1">
        <!-- User Info Card -->
        <div class="bg-gradient-to-br from-indigo-50 to-indigo-100 rounded-2xl border border-indigo-200 p-6 mb-6">
            <div class="flex items-start">
                <div class="w-12 h-12 bg-gradient-to-br from-indigo-400 to-indigo-600 rounded-xl flex items-center justify-center flex-shrink-0 mr-4">
                    <i class="fas fa-user-circle text-white text-lg"></i>
                </div>
                <div>
                    <h4 class="font-bold text-indigo-900 mb-2">Informasi Penyewa</h4>
                    <ul class="text-sm text-indigo-800 space-y-1">
                        <li><strong>ID:</strong> <?= esc($penyewa['user_id']) ?></li>
                        <li><strong>Username:</strong> <?= esc($penyewa['username']) ?></li>
                        <li><strong>Status:</strong> <?= $penyewa['is_active'] == 1 ? '<span class="text-green-600 font-bold">Aktif</span>' : '<span class="text-red-600 font-bold">Nonaktif</span>' ?></li>
                        <li><strong>Tgl Masuk:</strong> <?= esc($penyewa['tanggal_masuk'] ?? '-') ?></li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- Info Card 1 -->
        <div class="bg-gradient-to-br from-blue-50 to-blue-100 rounded-2xl border border-blue-200 p-6 mb-6">
            <div class="flex items-start">
                <div class="w-12 h-12 bg-blue-500 rounded-xl flex items-center justify-center flex-shrink-0 mr-4">
                    <i class="fas fa-edit text-white text-lg"></i>
                </div>
                <div>
                    <h4 class="font-bold text-blue-900 mb-2">Data yang Dapat Diubah</h4>
                    <ul class="text-sm text-blue-800 space-y-1">
                        <li><i class="fas fa-check text-blue-600 mr-1"></i>Nama Lengkap</li>
                        <li><i class="fas fa-check text-blue-600 mr-1"></i>Email</li>
                        <li><i class="fas fa-check text-blue-600 mr-1"></i>Nomor Telepon</li>
                        <li><i class="fas fa-check text-blue-600 mr-1"></i>Password</li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- Info Card 2 -->
        <div class="bg-gradient-to-br from-orange-50 to-orange-100 rounded-2xl border border-orange-200 p-6">
            <div class="flex items-start">
                <div class="w-12 h-12 bg-orange-500 rounded-xl flex items-center justify-center flex-shrink-0 mr-4">
                    <i class="fas fa-info-circle text-white text-lg"></i>
                </div>
                <div>
                    <h4 class="font-bold text-orange-900 mb-2">Catatan Penting</h4>
                    <p class="text-sm text-orange-800">Username tidak dapat diubah. Jika perlu mengubah username, hubungi administrator sistem.</p>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>
