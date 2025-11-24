<?= $this->extend('layout/admin_template') ?>

<?= $this->section('content') ?>
<?php $title = "Verifikasi Permintaan Booking"; ?>

<div class="alert alert-info">
    <i class="bi bi-info-circle-fill me-2"></i> Permintaan booking baru harus segera ditindaklanjuti. Status **Menunggu** harus diubah menjadi **Diterima** atau **Ditolak**.
</div>

<div class="card shadow-sm">
    <div class="card-header bg-dark text-white">
        Daftar Permintaan Booking
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-striped table-hover align-middle">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Penyewa</th>
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
                        <tr><td colspan="8" class="text-center text-muted">Tidak ada permintaan booking saat ini.</td></tr>
                    <?php else: ?>
                        <?php foreach ($bookings as $b): ?>
                        <tr>
                            <td><?= esc($b['booking_id']) ?></td>
                            <td><?= esc($b['username']) ?> (ID: <?= esc($b['user_id']) ?>)</td>
                            <td>No. <?= esc($b['nomor_kamar']) ?></td>
                            <td><?= date('d M Y', strtotime(esc($b['tanggal_booking']))) ?></td>
                            <td><?= date('d M Y', strtotime(esc($b['tanggal_mulai_sewa']))) ?></td>
                            <td><?= esc($b['durasi_sewa_bulan']) ?> Bulan</td>
                            <td><span class="badge bg-<?= $b['status'] == 'Menunggu' ? 'warning' : ($b['status'] == 'Diterima' ? 'info' : ($b['status'] == 'Aktif' ? 'success' : 'danger')) ?>"><?= esc($b['status']) ?></span></td>
                            <td>
                                <?php if ($b['status'] == 'Menunggu'): ?>
                                    <?= form_open('/admin/booking/verify/' . esc($b['booking_id']), ['class' => 'd-inline']) ?>
                                        <?= form_hidden('action', 'terima') ?>
                                        <button type="submit" class="btn btn-sm btn-success mb-1" onclick="return confirm('Terima booking ini? Status kamar akan Di Booking.');"><i class="bi bi-check"></i> Terima</button>
                                    <?= form_close() ?>
                                    
                                    <?= form_open('/admin/booking/verify/' . esc($b['booking_id']), ['class' => 'd-inline']) ?>
                                        <?= form_hidden('action', 'tolak') ?>
                                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Tolak booking ini? Status kamar akan kembali Tersedia.');"><i class="bi bi-x"></i> Tolak</button>
                                    <?= form_close() ?>
                                <?php else: ?>
                                    <span class="text-muted">Sudah diproses</span>
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