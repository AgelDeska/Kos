<?= $this->extend('layout/admin_template') ?>

<?php helper('form'); ?>

<?= $this->section('content') ?>

<!-- Header -->
<div class="mb-8">
    <div class="flex items-center justify-between">
        <div>
            <h2 class="text-3xl font-bold text-gray-900 flex items-center">
                <i class="fas fa-user-plus text-green-600 mr-3"></i>Tambah Penyewa Baru
            </h2>
            <p class="text-gray-600 mt-1">Tambahkan pengguna penyewa baru ke sistem</p>
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
            <?= form_open('/admin/penyewa/store', ['class' => 'space-y-6']) ?>

                <!-- Nama Penyewa -->
                <div>
                    <label for="nama" class="block text-sm font-bold text-gray-700 mb-2">
                        <i class="fas fa-user text-blue-600 mr-2"></i>Nama Lengkap
                    </label>
                    <input type="text" name="nama" id="nama" required
                           value="<?= old('nama') ?>"
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
                           value="<?= old('email') ?>"
                           placeholder="Contoh: budi@example.com"
                           class="w-full px-4 py-3 border <?= $validation->hasError('email') ? 'border-red-500 focus:ring-red-500' : 'border-gray-300 focus:ring-green-500' ?> rounded-lg focus:ring-2 focus:border-transparent transition">
                    <?php if ($validation->hasError('email')): ?>
                        <p class="mt-2 text-sm text-red-600 flex items-center">
                            <i class="fas fa-exclamation-circle mr-1"></i><?= $validation->getError('email') ?>
                        </p>
                    <?php endif; ?>
                </div>

                <!-- Username & No Telp Grid -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <!-- Username -->
                    <div>
                        <label for="username" class="block text-sm font-bold text-gray-700 mb-2">
                            <i class="fas fa-at text-blue-600 mr-2"></i>Username
                        </label>
                        <input type="text" name="username" id="username" required
                               value="<?= old('username') ?>"
                               placeholder="Contoh: budi_123"
                               class="w-full px-4 py-3 border <?= $validation->hasError('username') ? 'border-red-500 focus:ring-red-500' : 'border-gray-300 focus:ring-green-500' ?> rounded-lg focus:ring-2 focus:border-transparent transition"
                               pattern="^[a-zA-Z0-9_-]+$">
                        <?php if ($validation->hasError('username')): ?>
                            <p class="mt-2 text-sm text-red-600 flex items-center">
                                <i class="fas fa-exclamation-circle mr-1"></i><?= $validation->getError('username') ?>
                            </p>
                        <?php endif; ?>
                        <p class="text-xs text-gray-500 mt-1">Hanya huruf, angka, underscore, dan dash</p>
                    </div>

                    <!-- No Telp -->
                    <div>
                        <label for="no_telp" class="block text-sm font-bold text-gray-700 mb-2">
                            <i class="fas fa-phone text-blue-600 mr-2"></i>Nomor Telepon
                        </label>
                        <input type="tel" name="no_telp" id="no_telp" required
                               value="<?= old('no_telp') ?>"
                               placeholder="Contoh: 081234567890"
                               class="w-full px-4 py-3 border <?= $validation->hasError('no_telp') ? 'border-red-500 focus:ring-red-500' : 'border-gray-300 focus:ring-green-500' ?> rounded-lg focus:ring-2 focus:border-transparent transition">
                        <?php if ($validation->hasError('no_telp')): ?>
                            <p class="mt-2 text-sm text-red-600 flex items-center">
                                <i class="fas fa-exclamation-circle mr-1"></i><?= $validation->getError('no_telp') ?>
                            </p>
                        <?php endif; ?>
                    </div>
                </div>

                <!-- Password & Confirm Password Grid -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <!-- Password -->
                    <div>
                        <label for="password" class="block text-sm font-bold text-gray-700 mb-2">
                            <i class="fas fa-lock text-blue-600 mr-2"></i>Password
                        </label>
                        <input type="password" name="password" id="password" required
                               placeholder="Minimal 6 karakter"
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
                        <input type="password" name="confirm_password" id="confirm_password" required
                               placeholder="Ulangi password"
                               class="w-full px-4 py-3 border <?= $validation->hasError('confirm_password') ? 'border-red-500 focus:ring-red-500' : 'border-gray-300 focus:ring-green-500' ?> rounded-lg focus:ring-2 focus:border-transparent transition">
                        <?php if ($validation->hasError('confirm_password')): ?>
                            <p class="mt-2 text-sm text-red-600 flex items-center">
                                <i class="fas fa-exclamation-circle mr-1"></i><?= $validation->getError('confirm_password') ?>
                            </p>
                        <?php endif; ?>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="flex gap-4 pt-6 border-t border-gray-200">
                    <button type="submit" class="flex-1 inline-flex items-center justify-center px-6 py-3 bg-gradient-to-r from-green-600 to-green-700 hover:from-green-700 hover:to-green-800 text-white font-bold rounded-lg transition transform hover:scale-105 shadow-lg">
                        <i class="fas fa-save mr-2"></i>Tambah Penyewa
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
        <!-- Info Card 1 -->
        <div class="bg-gradient-to-br from-blue-50 to-blue-100 rounded-2xl border border-blue-200 p-6 mb-6">
            <div class="flex items-start">
                <div class="w-12 h-12 bg-blue-500 rounded-xl flex items-center justify-center flex-shrink-0 mr-4">
                    <i class="fas fa-info-circle text-white text-lg"></i>
                </div>
                <div>
                    <h4 class="font-bold text-blue-900 mb-2">Data Penyewa</h4>
                    <p class="text-sm text-blue-800">Isi semua data dengan benar. Data penyewa akan digunakan untuk sistem booking dan pembayaran.</p>
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
                    <h4 class="font-bold text-green-900 mb-2">Requirements</h4>
                    <ul class="text-sm text-green-800 space-y-1">
                        <li><i class="fas fa-check text-green-600 mr-1"></i>Username: 5+ karakter</li>
                        <li><i class="fas fa-check text-green-600 mr-1"></i>Email: Valid & Unik</li>
                        <li><i class="fas fa-check text-green-600 mr-1"></i>Password: 6+ karakter</li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- Info Card 3 -->
        <div class="bg-gradient-to-br from-orange-50 to-orange-100 rounded-2xl border border-orange-200 p-6">
            <div class="flex items-start">
                <div class="w-12 h-12 bg-orange-500 rounded-xl flex items-center justify-center flex-shrink-0 mr-4">
                    <i class="fas fa-key text-white text-lg"></i>
                </div>
                <div>
                    <h4 class="font-bold text-orange-900 mb-2">Keamanan Password</h4>
                    <p class="text-sm text-orange-800">Password akan di-hash secara aman. Pastikan penyewa mencatat password mereka untuk login pertama kali.</p>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>
