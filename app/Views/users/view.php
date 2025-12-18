<?= $this->extend('layout/profile_template') ?>

<?= $this->section('content') ?>

<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
    <!-- Main Profile Info -->
    <div class="lg:col-span-2 space-y-6">
        <!-- Basic Info Card -->
        <div class="card">
            <div class="card-header">
                <h4 class="text-lg font-semibold text-gray-900 flex items-center gap-2">
                    <i class="fas fa-user text-blue-500"></i>
                    Informasi Dasar
                </h4>
            </div>
            <div class="card-body">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div class="info-box">
                        <div class="info-label">Nama Lengkap</div>
                        <div class="info-value"><?= esc($user['nama'] ?? '-') ?></div>
                    </div>
                    <div class="info-box">
                        <div class="info-label">Username</div>
                        <div class="info-value"><?= esc($user['username']) ?></div>
                    </div>
                    <div class="info-box">
                        <div class="info-label">Email</div>
                        <div class="info-value"><?= esc($user['email']) ?></div>
                    </div>
                    <div class="info-box">
                        <div class="info-label">No. Telepon</div>
                        <div class="info-value"><?= esc($user['no_telp'] ?? '-') ?></div>
                    </div>
                    <div class="info-box">
                        <div class="info-label">Role / Peran</div>
                        <div class="info-value">
                            <span class="inline-flex items-center gap-2 px-3 py-1 rounded-full text-sm font-medium bg-blue-50 text-blue-700">
                                <i class="fas fa-tag"></i>
                                <?= ucfirst(esc($user['role'])) ?>
                            </span>
                        </div>
                    </div>
                    <div class="info-box">
                        <div class="info-label">Status Akun</div>
                        <div class="info-value">
                            <span class="inline-flex items-center gap-2 px-3 py-1 rounded-full text-sm font-medium <?= ($user['is_active']) ? 'bg-green-50 text-green-700' : 'bg-red-50 text-red-700' ?>">
                                <i class="fas fa-circle"></i>
                                <?= ($user['is_active']) ? 'Aktif' : 'Non-Aktif' ?>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Additional Info Card -->
        <div class="card">
            <div class="card-header">
                <h4 class="text-lg font-semibold text-gray-900 flex items-center gap-2">
                    <i class="fas fa-info-circle text-blue-500"></i>
                    Informasi Tambahan
                </h4>
            </div>
            <div class="card-body">
                <div class="space-y-4">
                    <div class="flex justify-between items-center py-2 border-b border-gray-100">
                        <span class="font-semibold text-gray-600">Bergabung Sejak</span>
                        <span class="text-gray-900 flex items-center gap-2">
                            <i class="fas fa-calendar text-blue-500"></i>
                            <?= date('d F Y', strtotime($user['tanggal_masuk'] ?? $user['created_at'] ?? date('Y-m-d'))) ?>
                        </span>
                    </div>
                    <div class="flex justify-between items-center py-2 border-b border-gray-100">
                        <span class="font-semibold text-gray-600">Waktu Bergabung</span>
                        <span class="text-gray-900 flex items-center gap-2">
                            <i class="fas fa-clock text-blue-500"></i>
                            <?= date('H:i', strtotime($user['tanggal_masuk'] ?? $user['created_at'] ?? date('Y-m-d H:i'))) ?>
                        </span>
                    </div>
                    <div class="flex justify-between items-center py-2">
                        <span class="font-semibold text-gray-600">ID Pengguna</span>
                        <span class="text-gray-900 font-mono text-sm bg-gray-100 px-2 py-1 rounded">
                            <?= esc($user['user_id']) ?>
                        </span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Action Buttons -->
        <div class="card">
            <div class="card-body">
                <div class="flex flex-wrap gap-3">
                    <a href="<?= base_url('katalog') ?>" class="btn btn-ghost">
                        <i class="fas fa-building"></i> Lihat Kamar Tersedia
                    </a>
                    <?php if (session()->get('user_id') == $user['user_id']): ?>
                        <?php if (session()->get('role') == 'penyewa'): ?>
                            <a href="<?= base_url('penyewa/dashboard') ?>" class="btn btn-primary">
                                <i class="fas fa-tachometer-alt"></i> Dashboard Penyewa
                            </a>
                        <?php elseif (session()->get('role') == 'admin'): ?>
                            <a href="<?= base_url('admin/dashboard') ?>" class="btn btn-primary">
                                <i class="fas fa-chart-line"></i> Dashboard Admin
                            </a>
                        <?php endif; ?>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>

    <!-- Sidebar Stats -->
    <div class="space-y-6">
        <!-- Profile Summary Card -->
        <div class="card">
            <div class="card-body text-center">
                <div class="profile-avatar mx-auto mb-4">
                    <?= strtoupper(substr($user['nama'] ?? $user['username'], 0, 1)) ?>
                </div>
                <h5 class="text-lg font-semibold text-gray-900 mb-1"><?= esc($user['nama'] ?? $user['username']) ?></h5>
                <p class="text-gray-500 mb-4">@<?= esc($user['username']) ?></p>

                <div class="space-y-3">
                    <div class="info-box">
                        <div class="info-label">Role Pengguna</div>
                        <div class="info-value text-center">
                            <?php
                            $role_icon = match($user['role']) {
                                'admin' => 'fa-crown',
                                'penyewa' => 'fa-user',
                                default => 'fa-user-circle'
                            };
                            $role_label = match($user['role']) {
                                'admin' => 'Administrator',
                                'penyewa' => 'Penyewa / Tenant',
                                default => 'Pengguna'
                            };
                            ?>
                            <i class="fas <?= $role_icon ?> text-blue-500 mr-2"></i>
                            <?= $role_label ?>
                        </div>
                    </div>

                    <div class="info-box">
                        <div class="info-label">Status</div>
                        <div class="info-value text-center">
                            <span class="inline-flex items-center gap-2 px-3 py-1 rounded-full text-sm font-medium <?= ($user['is_active']) ? 'bg-green-50 text-green-700' : 'bg-red-50 text-red-700' ?>">
                                <?= ($user['is_active']) ? '✓ Aktif' : '✕ Non-Aktif' ?>
                            </span>
                        </div>
                    </div>

                    <div class="info-box">
                        <div class="info-label">Kontak Cepat</div>
                        <div class="info-value text-center">
                            <?php if ($user['no_telp']): ?>
                                <a href="https://wa.me/<?= preg_replace('/[^0-9]/', '', $user['no_telp']) ?>" target="_blank" class="text-green-600 hover:text-green-700 font-semibold">
                                    <i class="fab fa-whatsapp mr-1"></i> WhatsApp
                                </a>
                            <?php else: ?>
                                <span class="text-gray-400">-</span>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Quick Info Card -->
        <div class="card">
            <div class="card-body">
                <h6 class="text-lg font-semibold text-gray-900 mb-3 flex items-center gap-2">
                    <i class="fas fa-lightbulb text-yellow-500"></i>
                    Tips Singkat
                </h6>
                <ul class="text-sm text-gray-600 space-y-2">
                    <li class="flex items-start gap-2">
                        <i class="fas fa-check text-green-500 mt-0.5"></i>
                        Pastikan data profil Anda lengkap
                    </li>
                    <li class="flex items-start gap-2">
                        <i class="fas fa-check text-green-500 mt-0.5"></i>
                        Perbarui kontak untuk pemberitahuan
                    </li>
                    <li class="flex items-start gap-2">
                        <i class="fas fa-check text-green-500 mt-0.5"></i>
                        Selalu jaga keamanan akun Anda
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>
