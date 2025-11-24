<?= $this->extend('layout/admin_template') ?>

<?= $this->section('content') ?>
<?php $title = "Catat Pembayaran Manual"; ?>

<div class="card shadow-sm mb-4">
    <div class="card-header bg-primary text-white">Form Catat Pembayaran</div>
    <div class="card-body">
        <?= form_open('/admin/pembayaran/store') ?>
            
            <div class="mb-3">
                <label for="user_id" class="form-label">Penyewa</label>
                <select class="form-select <?= $validation->hasError('user_id') ? 'is-invalid' : '' ?>" id="user_id" name="user_id" required>
                    <option value="">Pilih Penyewa</option>
                    <?php foreach ($users as $user): ?>
                        <option value="<?= esc($user['user_id']) ?>" <?= old('user_id') == $user['user_id'] ? 'selected' : '' ?>><?= esc($user['nama']) ?> (<?= esc($user['username']) ?>)</option>
                    <?php endforeach; ?>
                </select>
                <div class="invalid-feedback"><?= $validation->getError('user_id') ?></div>
            </div>

            <div class="mb-3">
                <label for="kamar_id" class="form-label">Kamar Kos</label>
                <select class="form-select <?= $validation->hasError('kamar_id') ? 'is-invalid' : '' ?>" id="kamar_id" name="kamar_id" required>
                    <option value="">Pilih Kamar</option>
                    <?php foreach ($kamars as $kamar): ?>
                        <option value="<?= esc($kamar['kamar_id']) ?>" <?= old('kamar_id') == $kamar['kamar_id'] ? 'selected' : '' ?>>No. <?= esc($kamar['nomor_kamar']) ?> (<?= esc($kamar['tipe_kamar']) ?>)</option>
                    <?php endforeach; ?>
                </select>
                <div class="invalid-feedback"><?= $validation->getError('kamar_id') ?></div>
            </div>

            <div class="mb-3">
                <label for="jenis_pembayaran" class="form-label">Jenis Pembayaran</label>
                <select class="form-select <?= $validation->hasError('jenis_pembayaran') ? 'is-invalid' : '' ?>" id="jenis_pembayaran" name="jenis_pembayaran" required>
                    <option value="Bulanan" <?= old('jenis_pembayaran') == 'Bulanan' ? 'selected' : '' ?>>Bulanan</option>
                    <option value="DP/Awal" <?= old('jenis_pembayaran') == 'DP/Awal' ? 'selected' : '' ?>>DP/Awal</option>
                </select>
                <div class="invalid-feedback"><?= $validation->getError('jenis_pembayaran') ?></div>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="jumlah" class="form-label">Jumlah (Rp)</label>
                    <input type="number" class="form-control <?= $validation->hasError('jumlah') ? 'is-invalid' : '' ?>" id="jumlah" name="jumlah" value="<?= old('jumlah') ?>" required min="10000">
                    <div class="invalid-feedback"><?= $validation->getError('jumlah') ?></div>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="tagihan_bulan" class="form-label">Untuk Tagihan Bulan (YYYY-MM)</label>
                    <input type="month" class="form-control <?= $validation->hasError('tagihan_bulan') ? 'is-invalid' : '' ?>" id="tagihan_bulan" name="tagihan_bulan" value="<?= old('tagihan_bulan') ?>" required>
                    <div class="invalid-feedback"><?= $validation->getError('tagihan_bulan') ?></div>
                </div>
            </div>
            
            <button type="submit" class="btn btn-success mt-3"><i class="bi bi-save me-2"></i> Simpan Transaksi Lunas</button>
            <a href="/admin/pembayaran" class="btn btn-secondary mt-3">Batal</a>
            
        <?= form_close() ?>
    </div>
</div>

<?= $this->endSection() ?>