<?= $this->extend('layout/public_template') ?>

<?= $this->section('content') ?>

<h1 class="text-center mb-4">Formulir Booking Kamar No. <?= esc($kamar['nomor_kamar']) ?></h1>

<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card shadow-lg p-4">
            <h4 class="text-primary mb-3">Detail Kamar: <?= esc($kamar['tipe_kamar']) ?></h4>
            <p>Harga Sewa: **Rp <?= number_format(esc($kamar['harga']), 0, ',', '.') ?> / Bulan**</p>
            
            <?php if (session()->get('error')): ?>
                <div class="alert alert-danger"><?= session()->get('error') ?></div>
            <?php endif; ?>

            <?= form_open('/penyewa/booking/save') ?>
                <?= form_hidden('kamar_id', esc($kamar['kamar_id'])) ?>
                
                <div class="mb-3">
                    <label for="durasi_sewa_bulan" class="form-label">Durasi Sewa (Bulan)</label>
                    <select class="form-select <?= (isset(session()->get('errors')['durasi_sewa_bulan'])) ? 'is-invalid' : '' ?>" id="durasi_sewa_bulan" name="durasi_sewa_bulan" required>
                        <option value="">Pilih Durasi</option>
                        <option value="1" <?= old('durasi_sewa_bulan') == 1 ? 'selected' : '' ?>>1 Bulan</option>
                        <option value="3" <?= old('durasi_sewa_bulan') == 3 ? 'selected' : '' ?>>3 Bulan</option>
                        <option value="6" <?= old('durasi_sewa_bulan') == 6 ? 'selected' : '' ?>>6 Bulan</option>
                        <option value="12" <?= old('durasi_sewa_bulan') == 12 ? 'selected' : '' ?>>12 Bulan (1 Tahun)</option>
                    </select>
                    <?php if (isset(session()->get('errors')['durasi_sewa_bulan'])): ?><div class="invalid-feedback"><?= session()->get('errors')['durasi_sewa_bulan'] ?></div><?php endif; ?>
                </div>

                <div class="mb-3">
                    <label for="tanggal_mulai_sewa" class="form-label">Tanggal Mulai Sewa</label>
                    <input type="date" class="form-control <?= (isset(session()->get('errors')['tanggal_mulai_sewa'])) ? 'is-invalid' : '' ?>" id="tanggal_mulai_sewa" name="tanggal_mulai_sewa" value="<?= old('tanggal_mulai_sewa') ?>" required min="<?= date('Y-m-d') ?>" />
                    <small class="form-text text-muted">Tanggal di mana Anda akan mulai menempati kos.</small>
                    <?php if (isset(session()->get('errors')['tanggal_mulai_sewa'])): ?><div class="invalid-feedback"><?= session()->get('errors')['tanggal_mulai_sewa'] ?></div><?php endif; ?>
                </div>

                <div class="alert alert-warning mt-4">
                    **Penting:** Setelah booking disubmit, Admin akan memverifikasi. Status kamar akan menjadi **"Di Booking"**. Anda wajib melakukan pembayaran DP dalam 24 jam setelah booking diterima Admin.
                </div>

                <div class="d-grid mt-4">
                    <button type="submit" class="btn btn-success btn-lg"><i class="bi bi-check-circle me-2"></i> Konfirmasi Booking</button>
                </div>
            <?= form_close() ?>
        </div>
    </div>
</div>

<?= $this->endSection() ?>