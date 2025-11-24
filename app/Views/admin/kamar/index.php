<?= $this->extend('layout/admin_template') ?>

<?= $this->section('content') ?>
<?php $title = "Kelola Data Kamar"; ?>

<div class="d-flex justify-content-end mb-3">
    <a href="/admin/kamar/create" class="btn btn-success"><i class="bi bi-plus-circle me-2"></i> Tambah Kamar Baru</a>
</div>

<?php if (session()->getFlashdata('success')): ?>
    <div class="alert alert-success"><i class="bi bi-check-circle me-2"></i> <?= session()->getFlashdata('success') ?></div>
<?php endif; ?>

<div class="card shadow-sm">
    <div class="card-header bg-dark text-white">
        Daftar Kamar Kos SmartKos
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nomor</th>
                        <th>Tipe</th>
                        <th>Harga/Bulan</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($kamars)): ?>
                        <tr><td colspan="6" class="text-center text-muted">Belum ada data kamar yang tercatat.</td></tr>
                    <?php else: ?>
                        <?php foreach ($kamars as $kamar): ?>
                        <tr>
                            <td><?= esc($kamar['kamar_id']) ?></td>
                            <td class="fw-bold"><?= esc($kamar['nomor_kamar']) ?></td>
                            <td><?= esc($kamar['tipe_kamar']) ?></td>
                            <td>Rp <?= number_format(esc($kamar['harga']), 0, ',', '.') ?></td>
                            <td><span class="badge bg-<?= $kamar['status'] == 'Tersedia' ? 'success' : ($kamar['status'] == 'Terisi' ? 'danger' : 'warning') ?>"><?= esc($kamar['status']) ?></span></td>
                            <td>
                                <a href="/admin/kamar/edit/<?= esc($kamar['kamar_id']) ?>" class="btn btn-sm btn-primary me-2"><i class="bi bi-pencil"></i> Edit</a>
                                <a href="/admin/kamar/delete/<?= esc($kamar['kamar_id']) ?>" class="btn btn-sm btn-danger" onclick="return confirm('Yakin ingin menghapus kamar No. <?= esc($kamar['nomor_kamar']) ?>? Data terkait mungkin ikut terhapus!');"><i class="bi bi-trash"></i> Hapus</a>
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