<?= $this->extend('layout/admin_template') ?>
<?= $this->section('content') ?>

<div class="alert alert-success mt-3">
    Selamat datang, **<?= session()->get('username') ?>**! Anda masuk sebagai Penyewa.
</div>

<div class="row">
    <div class="col-md-6 mb-4">
        <div class="card shadow-sm border-0">
            <div class="card-header bg-primary text-white"><i class="bi bi-house-door me-2"></i> Status Kos Saat Ini</div>
            <div class="card-body">
                <!-- Data ini harusnya diambil dari status booking aktif -->
                <p>Status Aktif: <span class="badge bg-secondary">Belum Ada</span></p>
                <p>Kamar Ditempati: <span class="fw-bold">N/A</span></p>
                <p>Jatuh Tempo Bayar: <span class="fw-bold text-danger">N/A</span></p>
                <a href="/penyewa/riwayat-booking" class="btn btn-sm btn-outline-primary">Lihat Booking</a>
            </div>
        </div>
    </div>
    <div class="col-md-6 mb-4">
        <div class="card shadow-sm border-0">
            <div class="card-header bg-warning text-dark"><i class="bi bi-wallet2 me-2"></i> Pembayaran Saya</div>
            <div class="card-body">
                <p>Pembayaran Terbaru: <span class="badge bg-danger">Pending</span></p>
                <p>Jumlah: <span class="fw-bold">Rp 0</span></p>
                <p>Jenis: <span class="fw-bold">N/A</span></p>
                <a href="/penyewa/pembayaran" class="btn btn-sm btn-outline-warning">Kelola Pembayaran</a>
            </div>
        </div>
    </div>
</div>

<h4 class="mt-4">Riwayat Booking Terbaru</h4>
<div class="table-responsive">
    <table class="table table-striped table-hover">
        <thead>
            <tr>
                <th>ID</th>
                <th>Kamar ID</th>
                <th>Tgl Booking</th>
                <th>Durasi</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            <?php if (empty($riwayat_booking)): ?>
                <tr><td colspan="5" class="text-center text-muted">Belum ada riwayat booking.</td></tr>
            <?php else: ?>
                <?php foreach ($riwayat_booking as $b): ?>
                    <tr>
                        <td><?= esc($b['booking_id']) ?></td>
                        <td><?= esc($b['kamar_id']) ?></td>
                        <td><?= esc($b['tanggal_booking']) ?></td>
                        <td><?= esc($b['durasi_sewa_bulan']) ?> Bulan</td>
                        <td><span class="badge bg-<?= $b['status'] == 'Menunggu' ? 'warning' : ($b['status'] == 'Diterima' ? 'info' : 'secondary') ?>"><?= esc($b['status']) ?></span></td>
                    </tr>
                <?php endforeach; ?>
            <?php endif; ?>
        </tbody>
    </table>
</div>

<?= $this->endSection() ?>