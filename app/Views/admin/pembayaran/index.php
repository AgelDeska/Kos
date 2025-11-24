<?= $this->extend('layout/admin_template') ?>

<?= $this->section('content') ?>
<?php $title = "Kelola Data Pembayaran"; ?>

<div class="d-flex justify-content-between mb-3">
    <a href="/admin/pembayaran/create" class="btn btn-primary"><i class="bi bi-plus-circle me-2"></i> Catat Pembayaran Manual</a>
</div>

<div class="card shadow-sm">
    <div class="card-header bg-dark text-white">
        Daftar Semua Transaksi Pembayaran
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-striped table-hover align-middle">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Penyewa</th>
                        <th>Kamar</th>
                        <th>Jumlah</th>
                        <th>Jenis</th>
                        <th>Tgl Bayar</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($pembayarans)): ?>
                        <tr><td colspan="8" class="text-center text-muted">Tidak ada data pembayaran yang tercatat.</td></tr>
                    <?php else: ?>
                        <?php foreach ($pembayarans as $p): ?>
                        <tr>
                            <td><?= esc($p['pembayaran_id']) ?></td>
                            <td><?= esc($p['username']) ?></td>
                            <td>No. <?= esc($p['nomor_kamar']) ?></td>
                            <td class="fw-bold">Rp <?= number_format(esc($p['jumlah']), 0, ',', '.') ?></td>
                            <td><span class="badge bg-secondary"><?= esc($p['jenis_pembayaran']) ?></span></td>
                            <td><?= date('d M Y', strtotime(esc($p['tanggal_bayar']))) ?></td>
                            <td><span class="badge bg-<?= $p['status'] == 'Menunggu Verifikasi' ? 'warning' : ($p['status'] == 'Lunas' ? 'success' : 'danger') ?>"><?= esc($p['status']) ?></span></td>
                            <td>
                                <?php if ($p['status'] == 'Menunggu Verifikasi'): ?>
                                    <?= form_open('/admin/pembayaran/verify/' . esc($p['pembayaran_id']), ['class' => 'd-inline']) ?>
                                        <?= form_hidden('action', 'lunas') ?>
                                        <button type="submit" class="btn btn-sm btn-success mb-1" onclick="return confirm('Verifikasi pembayaran Lunas?');"><i class="bi bi-check"></i> Lunas</button>
                                    <?= form_close() ?>
                                    
                                    <?= form_open('/admin/pembayaran/verify/' . esc($p['pembayaran_id']), ['class' => 'd-inline']) ?>
                                        <?= form_hidden('action', 'tolak') ?>
                                        <button type="submit" class="btn btn-sm btn-warning" onclick="return confirm('Tolak pembayaran ini?');"><i class="bi bi-x"></i> Tolak</button>
                                    <?= form_close() ?>
                                <?php else: ?>
                                    <a href="/admin/pembayaran/delete/<?= esc($p['pembayaran_id']) ?>" class="btn btn-sm btn-outline-danger" onclick="return confirm('Hapus data pembayaran?');"><i class="bi bi-trash"></i></a>
                                <?php endif; ?>
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