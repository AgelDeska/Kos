<?= $this->extend('layout/admin_template') ?>

<?= $this->section('content') ?>
<?php $title = "Riwayat Booking Saya"; ?>

<h3 class="mb-4">Daftar Semua Booking yang Pernah Anda Ajukan</h3>

<div class="table-responsive">
    <table class="table table-striped table-hover">
        <thead class="bg-dark text-white">
            <tr>
                <th>ID</th>
                <th>Kamar</th>
                <th>Tgl Booking</th>
                <th>Mulai Sewa</th>
                <th>Durasi</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php if (empty($bookings)): ?>
                <tr><td colspan="7" class="text-center text-muted">Anda belum memiliki riwayat booking.</td></tr>
            <?php else: ?>
                <?php foreach ($bookings as $b): ?>
                    <tr>
                        <td><?= esc($b['booking_id']) ?></td>
                        <td>**No. <?= esc($b['nomor_kamar']) ?>** (<?= esc($b['tipe_kamar']) ?>)</td>
                        <td><?= date('d M Y', strtotime(esc($b['tanggal_booking']))) ?></td>
                        <td><?= date('d M Y', strtotime(esc($b['tanggal_mulai_sewa']))) ?></td>
                        <td><?= esc($b['durasi_sewa_bulan']) ?> Bulan</td>
                        <td><span class="badge bg-<?= $b['status'] == 'Menunggu' ? 'warning' : ($b['status'] == 'Diterima' ? 'info' : ($b['status'] == 'Aktif' ? 'success' : 'danger')) ?>"><?= esc($b['status']) ?></span></td>
                        <td>
                            <?php if ($b['status'] == 'Diterima'): ?>
                                <a href="/penyewa/pembayaran/form-dp/<?= esc($b['booking_id']) ?>" class="btn btn-sm btn-success">Bayar DP</a>
                            <?php elseif ($b['status'] == 'Menunggu'): ?>
                                <button class="btn btn-sm btn-secondary" disabled>Menunggu Admin</button>
                            <?php else: ?>
                                <span class="text-muted">Selesai</span>
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php endif; ?>
        </tbody>
    </table>
</div>

<?= $this->endSection() ?>