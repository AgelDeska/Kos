<?= $this->extend('layout/public_template') ?>

<?= $this->section('content') ?>

<h1 class="text-center mb-5">Katalog Lengkap Kamar SmartKos</h1>

<div class="row row-cols-1 row-cols-md-3 g-4">
    <?php if (empty($kamars)): ?>
        <div class="col-12">
            <div class="alert alert-info text-center">
                <i class="bi bi-info-circle"></i> Maaf, saat ini tidak ada kamar yang terdaftar.
            </div>
        </div>
    <?php endif; ?>
    <?php foreach ($kamars as $kamar): ?>
    <div class="col">
        <div class="card h-100 shadow-sm border-0">
            <img src="<?= base_url('img/kamar/' . ($kamar['foto_kamar'] ?? 'placeholder/286x180/000000/ffffff?text=KosFoto')) ?>" class="card-img-top" alt="Foto Kamar" style="height: 220px; object-fit: cover;">
            <div class="card-body">
                <span class="badge rounded-pill bg-<?= $kamar['status'] == 'Tersedia' ? 'success' : ($kamar['status'] == 'Di Booking' ? 'warning' : 'danger') ?> mb-2">
                    <?= esc($kamar['status']) ?>
                </span>
                <h4 class="card-title fw-bold mb-1">Kamar No. <?= esc($kamar['nomor_kamar']) ?></h4>
                <p class="text-muted"><?= esc($kamar['tipe_kamar']) ?> (Kapasitas: <?= esc($kamar['kapasitas']) ?> orang)</p>
                
                <h3 class="text-primary mt-3">Rp <?= number_format(esc($kamar['harga']), 0, ',', '.') ?><small class="text-muted fs-6">/Bulan</small></h3>
                
                <div class="mt-3">
                    <a href="/kamar/<?= esc($kamar['kamar_id']) ?>" class="btn btn-outline-secondary btn-sm me-2">Lihat Detail</a>
                    <?php if ($kamar['status'] == 'Tersedia'): ?>
                        <a href="/login" class="btn btn-primary btn-sm"><i class="bi bi-calendar-plus"></i> Booking Sekarang</a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
    <?php endforeach; ?>
</div>

<?= $this->endSection() ?>