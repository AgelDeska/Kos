<?= $this->extend('layout/admin_template') ?>

<?= $this->section('content') ?>
<?php $title = "Kelola Data Penyewa"; ?>

<div class="card shadow-sm">
    <div class="card-header bg-dark text-white">
        Daftar Pengguna Role Penyewa
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>Username</th>
                        <th>Status Akun</th>
                        <th>Tgl Masuk</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($penyewas)): ?>
                        <tr><td colspan="7" class="text-center text-muted">Belum ada data penyewa yang tercatat.</td></tr>
                    <?php else: ?>
                        <?php foreach ($penyewas as $user): ?>
                        <tr>
                            <td><?= esc($user['user_id']) ?></td>
                            <td class="fw-bold"><?= esc($user['nama']) ?></td>
                            <td><?= esc($user['email']) ?></td>
                            <td><?= esc($user['username']) ?></td>
                            <td><span class="badge bg-<?= $user['is_active'] == 1 ? 'success' : 'danger' ?>"><?= $user['is_active'] == 1 ? 'Aktif' : 'Nonaktif' ?></span></td>
                            <td><?= esc($user['tanggal_masuk'] ?? '-') ?></td>
                            <td>
                                <a href="/admin/penyewa/toggle/<?= esc($user['user_id']) ?>" class="btn btn-sm btn-<?= $user['is_active'] == 1 ? 'danger' : 'success' ?>" onclick="return confirm('Ubah status akun ini?');">
                                    <i class="bi bi-toggle-<?= $user['is_active'] == 1 ? 'on' : 'off' ?>"></i> <?= $user['is_active'] == 1 ? 'Nonaktifkan' : 'Aktifkan' ?>
                                </a>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?= $this->endSection() ?>