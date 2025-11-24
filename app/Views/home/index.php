<?= $this->extend('layout/public_template') ?>

<?= $this->section('content') ?>

<div class="hero-section text-center bg-primary text-white rounded p-5 mb-4">
    <h1 class="display-4">Temukan Kos Impian Anda di SmartKos!</h1>
    <p class="lead">Sistem informasi yang mudah dan cepat untuk booking kamar kos Anda.</p>
    <a href="/katalog" class="btn btn-warning btn-lg mt-3">Mulai Cari Kamar <i class="bi bi-arrow-right"></i></a>
</div>
<h2 class="mb-4 text-center">Kamar Tersedia Pilihan</h2>
<div class="row row-cols-1 row-cols-md-3 g-4">
    <?php if (empty($kamar_tersedia)): ?>
        <p class="text-center w-100">Maaf, saat ini belum ada kamar yang tersedia.</p>
    <?php endif; ?>
    <?php foreach ($kamar_tersedia as $kamar): ?>
    <div class="col">
        <div class="card h-100 shadow-sm">
            <img src="<?= base_url('img/kamar/' . ($kamar['foto_kamar'] ?? 'default.jpg')) ?>" class="card-img-top" alt="Foto Kamar" style="height: 200px; object-fit: cover;">
            <div class="card-body">
                <h5 class="card-title">Kamar No. <?= esc($kamar['nomor_kamar']) ?> (<?= esc($kamar['tipe_kamar']) ?>)</h5>
                <p class="card-text">Harga: **Rp <?= number_format(esc($kamar['harga']), 0, ',', '.') ?>**/Bulan</p>
                <span class="badge bg-success"><?= esc($kamar['status']) ?></span>
            </div>
            <div class="card-footer">
                <a href="/kamar/<?= esc($kamar['kamar_id']) ?>" class="btn btn-outline-primary btn-sm">Lihat Detail</a>
            </div>
        </div>
    </div>
    <?php endforeach; ?>
</div>

<div class="text-center mt-5">
    <a href="/katalog" class="btn btn-secondary btn-lg">Lihat Semua Katalog</a>
</div>

<?= $this->endSection() ?>