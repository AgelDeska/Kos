<?= $this->extend('layout/admin_template') ?>

<?= $this->section('content') ?>
<?php $title = "Tambah Kamar Baru"; ?>

<div class="card shadow-sm mb-4">
    <div class="card-header bg-primary text-white">Form Tambah Kamar</div>
    <div class="card-body">
        <?= form_open_multipart('/admin/kamar/store') ?>
        
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="nomor_kamar" class="form-label">Nomor Kamar</label>
                    <input type="text" class="form-control <?= $validation->hasError('nomor_kamar') ? 'is-invalid' : '' ?>" id="nomor_kamar" name="nomor_kamar" value="<?= old('nomor_kamar') ?>" required>
                    <div class="invalid-feedback"><?= $validation->getError('nomor_kamar') ?></div>
                </div>

                <div class="col-md-6 mb-3">
                    <label for="tipe_kamar" class="form-label">Tipe Kamar</label>
                    <input type="text" class="form-control <?= $validation->hasError('tipe_kamar') ? 'is-invalid' : '' ?>" id="tipe_kamar" name="tipe_kamar" value="<?= old('tipe_kamar') ?>" placeholder="Contoh: Standar, Premium" required>
                    <div class="invalid-feedback"><?= $validation->getError('tipe_kamar') ?></div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-4 mb-3">
                    <label for="kapasitas" class="form-label">Kapasitas (Orang)</label>
                    <input type="number" class="form-control <?= $validation->hasError('kapasitas') ? 'is-invalid' : '' ?>" id="kapasitas" name="kapasitas" value="<?= old('kapasitas') ?>" required min="1">
                    <div class="invalid-feedback"><?= $validation->getError('kapasitas') ?></div>
                </div>
                
                <div class="col-md-4 mb-3">
                    <label for="harga" class="form-label">Harga Sewa Bulanan (Rp)</label>
                    <input type="number" class="form-control <?= $validation->hasError('harga') ? 'is-invalid' : '' ?>" id="harga" name="harga" value="<?= old('harga') ?>" required min="100000">
                    <div class="invalid-feedback"><?= $validation->getError('harga') ?></div>
                </div>
                
                <div class="col-md-4 mb-3">
                    <label for="status" class="form-label">Status</label>
                    <select class="form-select <?= $validation->hasError('status') ? 'is-invalid' : '' ?>" id="status" name="status" required>
                        <option value="Tersedia" <?= old('status') == 'Tersedia' ? 'selected' : '' ?>>Tersedia</option>
                        <option value="Terisi" <?= old('status') == 'Terisi' ? 'selected' : '' ?>>Terisi</option>
                        <option value="Di Booking" <?= old('status') == 'Di Booking' ? 'selected' : '' ?>>Di Booking</option>
                    </select>
                    <div class="invalid-feedback"><?= $validation->getError('status') ?></div>
                </div>
            </div>

            <div class="mb-3">
                <label for="deskripsi" class="form-label">Deskripsi Kamar</label>
                <textarea class="form-control <?= $validation->hasError('deskripsi') ? 'is-invalid' : '' ?>" id="deskripsi" name="deskripsi" rows="3"><?= old('deskripsi') ?></textarea>
                <div class="invalid-feedback"><?= $validation->getError('deskripsi') ?></div>
            </div>

            <div class="mb-3">
                <label for="foto_kamar" class="form-label">Foto Kamar</label>
                <input class="form-control <?= $validation->hasError('foto_kamar') ? 'is-invalid' : '' ?>" type="file" id="foto_kamar" name="foto_kamar">
                <div class="invalid-feedback"><?= $validation->getError('foto_kamar') ?></div>
            </div>

            <button type="submit" class="btn btn-primary mt-3"><i class="bi bi-save me-2"></i> Simpan Kamar</button>
            <a href="/admin/kamar" class="btn btn-secondary mt-3">Batal</a>
            
        <?= form_close() ?>
    </div>
</div>

<?= $this->endSection() ?>