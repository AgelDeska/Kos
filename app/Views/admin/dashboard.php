<?= $this->extend('layout/admin_template') ?>

<?= $this->section('content') ?>

<div class="row">
    <div class="col-md-3 mb-4">
        <div class="card text-white bg-info shadow-sm">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="card-title mb-0">Total Kamar</h6>
                        <h2 class="display-4"><?= esc($total_kamar) ?></h2>
                    </div>
                    <i class="bi bi-building" style="font-size: 3rem;"></i>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-3 mb-4">
        <div class="card text-white bg-danger shadow-sm">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="card-title mb-0">Kamar Terisi</h6>
                        <h2 class="display-4"><?= esc($kamar_terisi) ?></h2>
                    </div>
                    <i class="bi bi-person-fill-lock" style="font-size: 3rem;"></i>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-md-3 mb-4">
        <div class="card text-white bg-warning shadow-sm">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="card-title mb-0">Booking Menunggu</h6>
                        <h2 class="display-4"><?= esc($booking_menunggu) ?></h2>
                    </div>
                    <i class="bi bi-hourglass-split" style="font-size: 3rem;"></i>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-3 mb-4">
        <div class="card text-white bg-success shadow-sm">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="card-title mb-0">Pembayaran Pending</h6>
                        <h2 class="display-4"><?= esc($pembayaran_pending) ?></h2>
                    </div>
                    <i class="bi bi-credit-card-2-back-fill" style="font-size: 3rem;"></i>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-6">
        <div class="card shadow-sm mb-4">
            <div class="card-header">
                Booking Terbaru
            </div>
            <div class="card-body">
                <table class="table table-striped table-hover">
                    <thead>
                        <tr><th>ID</th><th>Kamar</th><th>Status</th><th>Aksi</th></tr>
                    </thead>
                    <tbody>
                        <?php foreach ($recent_bookings as $b): ?>
                        <tr>
                            <td><?= esc($b['booking_id']) ?></td>
                            <td>Kamar ID: <?= esc($b['kamar_id']) ?></td>
                            <td><span class="badge bg-secondary"><?= esc($b['status']) ?></span></td>
                            <td><a href="/admin/booking" class="btn btn-sm btn-info">Cek</a></td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    
    <div class="col-md-6">
        <div class="card shadow-sm mb-4">
            <div class="card-header">
                Pembayaran Terbaru
            </div>
            <div class="card-body">
                <table class="table table-striped table-hover">
                    <thead>
                        <tr><th>ID</th><th>Jumlah</th><th>Status</th><th>Aksi</th></tr>
                    </thead>
                    <tbody>
                        <?php foreach ($recent_payments as $p): ?>
                        <tr>
                            <td><?= esc($p['pembayaran_id']) ?></td>
                            <td>Rp <?= number_format(esc($p['jumlah']), 0) ?></td>
                            <td><span class="badge bg-warning"><?= esc($p['status']) ?></span></td>
                            <td><a href="/admin/pembayaran" class="btn btn-sm btn-info">Cek</a></td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>