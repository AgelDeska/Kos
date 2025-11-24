<?= $this->extend('layout/public_template') ?>

<?= $this->section('content') ?>

<div class="row">
    <div class="col-lg-8">
        <div class="card shadow-lg border-0 mb-4">
            <img src="<?= base_url('img/kamar/' . ($kamar['foto_kamar'] ?? 'placeholder/800x600/000000/ffffff?text=KosFoto')) ?>" class="card-img-top rounded-top" alt="Foto Kamar" style="max-height: 500px; object-fit: cover;">
            <div class="card-body p-4">
                <h1 class="display-5 fw-bold">Kamar No. <?= esc($kamar['nomor_kamar']) ?></h1>
                <p class="lead text-muted"><?= esc($kamar['tipe_kamar']) ?></p>

                <div class="alert alert-info d-flex align-items-center mt-3" role="alert">
                    <i class="bi bi-person-fill me-2 fs-4"></i>
                    <div>Kapasitas Maksimal: **<?= esc($kamar['kapasitas']) ?> orang**</div>
                </div>

                <h4 class="mt-4">Deskripsi Kamar</h4>
                <p><?= nl2br(esc($kamar['deskripsi'])) ?></p>

                <h4 class="mt-4">Fasilitas & Fitur</h4>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item"><i class="bi bi-check-circle-fill text-success me-2"></i> Kamar Mandi Dalam</li>
                    <li class="list-group-item"><i class="bi bi-check-circle-fill text-success me-2"></i> AC/Kipas (Sesuai Tipe)</li>
                    <li class="list-group-item"><i class="bi bi-check-circle-fill text-success me-2"></i> Lemari dan Meja Belajar</li>
                    <li class="list-group-item"><i class="bi bi-check-circle-fill text-success me-2"></i> Wi-Fi Cepat</li>
                </ul>
            </div>
        </div>
    </div>
    
    <div class="col-lg-4">
        <div class="card shadow-lg border-0 bg-light p-3">
            <div class="card-body">
                <h4 class="text-center mb-4">Informasi Harga</h4>
                <h2 class="text-center text-primary mb-3">Rp <?= number_format(esc($kamar['harga']), 0, ',', '.') ?> <small class="text-muted fs-5">/Bulan</small></h2>
                
                <div class="d-grid gap-2">
                    <?php if ($kamar['status'] == 'Tersedia'): ?>
                        <?php if (session()->get('isLoggedIn') && session()->get('role') == 'Penyewa'): ?>
                            <a href="/penyewa/booking/<?= esc($kamar['kamar_id']) ?>" class="btn btn-success btn-lg"><i class="bi bi-calendar-plus"></i> Booking Kamar Ini</a>
                        <?php else: ?>
                            <a href="/login" class="btn btn-warning btn-lg"><i class="bi bi-box-arrow-in-right"></i> Login untuk Booking</a>
                        <?php endif; ?>
                    <?php else: ?>
                        <button class="btn btn-danger btn-lg" disabled>Status: <?= esc($kamar['status']) ?></button>
                        <p class="text-center text-muted mt-2">Kamar ini sedang tidak tersedia untuk booking.</p>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>