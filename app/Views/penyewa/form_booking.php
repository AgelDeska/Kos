<?= $this->extend('layout/public_template') ?>

<?= $this->section('content') ?>

<style>
    .booking-container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 40px 20px;
    }

    .booking-header {
        text-align: center;
        margin-bottom: 50px;
    }

    .booking-header h1 {
        font-size: 42px;
        font-weight: 700;
        color: #343a40;
        margin-bottom: 10px;
    }

    .booking-header p {
        font-size: 16px;
        color: #6c757d;
    }

    .booking-grid {
        display: grid;
        grid-template-columns: 2fr 1fr;
        gap: 40px;
        align-items: start;
    }

    .form-section {
        background: white;
        border-radius: 16px;
        padding: 40px;
        box-shadow: 0 4px 15px rgba(0,0,0,0.08);
        border: 1px solid #e9ecef;
    }

    .form-section h2 {
        font-size: 26px;
        font-weight: 700;
        color: #343a40;
        margin-bottom: 30px;
        padding-bottom: 15px;
        border-bottom: 2px solid #007bff;
    }

    .form-group {
        margin-bottom: 25px;
    }

    .form-label {
        font-size: 15px;
        font-weight: 600;
        color: #343a40;
        margin-bottom: 10px;
        display: block;
    }

    .form-control, .form-select {
        padding: 12px 16px;
        border: 2px solid #e9ecef;
        border-radius: 10px;
        font-size: 15px;
        font-family: 'Poppins', sans-serif;
        transition: all 0.3s ease;
    }

    .form-control:focus, .form-select:focus {
        border-color: #007bff;
        box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25);
        outline: none;
    }

    .form-hint {
        font-size: 13px;
        color: #6c757d;
        margin-top: 8px;
        display: flex;
        align-items: center;
    }

    .form-hint i {
        margin-right: 8px;
        color: #007bff;
    }

    .sidebar-section {
        background: white;
        border-radius: 16px;
        padding: 30px;
        box-shadow: 0 4px 15px rgba(0,0,0,0.08);
        border: 1px solid #e9ecef;
        position: sticky;
        top: 20px;
    }

    .sidebar-section h3 {
        font-size: 20px;
        font-weight: 700;
        color: #343a40;
        margin-bottom: 20px;
        padding-bottom: 15px;
        border-bottom: 2px solid #007bff;
    }

    .kamar-info-item {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 12px 0;
        border-bottom: 1px solid #e9ecef;
    }

    .kamar-info-item:last-child {
        border-bottom: none;
    }

    .kamar-info-label {
        font-size: 14px;
        color: #6c757d;
        font-weight: 500;
    }

    .kamar-info-value {
        font-size: 16px;
        font-weight: 700;
        color: #343a40;
    }

    .price-box {
        background: linear-gradient(135deg, #007bff 0%, #0056b3 100%);
        color: white;
        padding: 25px;
        border-radius: 12px;
        margin: 25px 0;
        text-align: center;
    }

    .price-box .label {
        font-size: 13px;
        opacity: 0.9;
        margin-bottom: 8px;
    }

    .price-box .price {
        font-size: 36px;
        font-weight: 700;
    }

    .price-box .duration {
        font-size: 13px;
        opacity: 0.9;
        margin-top: 8px;
    }

    .alert-info-box {
        background: #e7f3ff;
        border: 2px solid #007bff;
        border-radius: 12px;
        padding: 20px;
        margin: 30px 0;
    }

    .alert-info-box h4 {
        color: #007bff;
        font-weight: 700;
        margin-bottom: 10px;
        display: flex;
        align-items: center;
    }

    .alert-info-box h4 i {
        margin-right: 10px;
        font-size: 20px;
    }

    .alert-info-box p {
        color: #0056b3;
        font-size: 14px;
        margin: 0;
        line-height: 1.6;
    }

    .alert-info-box ul {
        list-style: none;
        padding: 0;
        margin: 10px 0 0 0;
    }

    .alert-info-box li {
        color: #0056b3;
        font-size: 14px;
        margin: 8px 0;
        display: flex;
        align-items: center;
    }

    .alert-info-box li:before {
        content: "✓";
        display: inline-block;
        width: 20px;
        height: 20px;
        background: #007bff;
        color: white;
        border-radius: 50%;
        text-align: center;
        line-height: 20px;
        margin-right: 10px;
        font-size: 12px;
    }

    .btn-submit {
        width: 100%;
        padding: 16px;
        background: linear-gradient(135deg, #007bff 0%, #0056b3 100%);
        color: white;
        border: none;
        border-radius: 10px;
        font-size: 16px;
        font-weight: 700;
        cursor: pointer;
        transition: all 0.3s ease;
        font-family: 'Poppins', sans-serif;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 10px;
    }

    .btn-submit:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(0, 123, 255, 0.3);
    }

    .btn-back {
        width: 100%;
        padding: 12px;
        background: white;
        color: #007bff;
        border: 2px solid #007bff;
        border-radius: 10px;
        font-size: 15px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s ease;
        font-family: 'Poppins', sans-serif;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        margin-top: 15px;
        text-decoration: none;
    }

    .btn-back:hover {
        background: #f0f7ff;
    }

    .error-feedback {
        color: #dc3545;
        font-size: 13px;
        margin-top: 8px;
        display: block;
    }

    @media (max-width: 768px) {
        .booking-grid {
            grid-template-columns: 1fr;
        }

        .sidebar-section {
            position: static;
        }

        .booking-header h1 {
            font-size: 32px;
        }
    }
</style>

<div class="booking-container">
    <!-- Header -->
    <div class="booking-header">
        <h1><i class="fas fa-calendar-check" style="color: #007bff; margin-right: 15px;"></i>Form Booking Kamar</h1>
        <p>Isi formulir di bawah untuk melakukan pemesanan kamar kos yang Anda inginkan</p>
    </div>

    <!-- Main Grid -->
    <div class="booking-grid">
        <!-- Form Section -->
        <div class="form-section">
            <h2><i class="fas fa-edit" style="margin-right: 10px;"></i>Data Pemesanan</h2>

            <?php if (session()->get('error')): ?>
                <div style="background: #f8d7da; border: 2px solid #dc3545; border-radius: 10px; padding: 15px; margin-bottom: 25px; color: #721c24;">
                    <i class="fas fa-exclamation-circle" style="margin-right: 10px;"></i>
                    <?= session()->get('error') ?>
                </div>
            <?php endif; ?>

            <?= form_open('penyewa/booking/save') ?>
                <?= form_hidden('kamar_id', esc($kamar['kamar_id'])) ?>

                <!-- Durasi Sewa -->
                <div class="form-group">
                    <label for="durasi_sewa_bulan" class="form-label">
                        <i class="fas fa-calendar-days" style="color: #007bff; margin-right: 8px;"></i>
                        Durasi Sewa (Bulan)
                    </label>
                    <select class="form-select <?= (isset(session()->get('errors')['durasi_sewa_bulan'])) ? 'is-invalid' : '' ?>" id="durasi_sewa_bulan" name="durasi_sewa_bulan" required>
                        <option value="">Pilih Durasi Sewa</option>
                        <option value="1" <?= old('durasi_sewa_bulan') == 1 ? 'selected' : '' ?>>1 Bulan</option>
                        <option value="3" <?= old('durasi_sewa_bulan') == 3 ? 'selected' : '' ?>>3 Bulan</option>
                        <option value="6" <?= old('durasi_sewa_bulan') == 6 ? 'selected' : '' ?>>6 Bulan</option>
                        <option value="12" <?= old('durasi_sewa_bulan') == 12 ? 'selected' : '' ?>>12 Bulan (1 Tahun)</option>
                    </select>
                    <?php if (isset(session()->get('errors')['durasi_sewa_bulan'])): ?>
                        <span class="error-feedback"><?= session()->get('errors')['durasi_sewa_bulan'] ?></span>
                    <?php endif; ?>
                    <div class="form-hint">
                        <i class="fas fa-info-circle"></i>
                        Semakin lama durasi, semakin besar diskon yang Anda dapatkan
                    </div>
                </div>

                <!-- Tanggal Mulai Sewa -->
                <div class="form-group">
                    <label for="tanggal_mulai_sewa" class="form-label">
                        <i class="fas fa-clock" style="color: #007bff; margin-right: 8px;"></i>
                        Tanggal Mulai Sewa
                    </label>
                    <input type="date" class="form-control <?= (isset(session()->get('errors')['tanggal_mulai_sewa'])) ? 'is-invalid' : '' ?>" id="tanggal_mulai_sewa" name="tanggal_mulai_sewa" value="<?= old('tanggal_mulai_sewa') ?>" required min="<?= date('Y-m-d') ?>" />
                    <?php if (isset(session()->get('errors')['tanggal_mulai_sewa'])): ?>
                        <span class="error-feedback"><?= session()->get('errors')['tanggal_mulai_sewa'] ?></span>
                    <?php endif; ?>
                    <div class="form-hint">
                        <i class="fas fa-info-circle"></i>
                        Tanggal di mana Anda akan mulai menempati kamar
                    </div>
                </div>

                <!-- Info Box -->
                <div class="alert-info-box">
                    <h4>
                        <i class="fas fa-exclamation-triangle"></i>
                        Penting untuk Diketahui
                    </h4>
                    <ul>
                        <li>Setelah booking disubmit, admin akan memverifikasi dalam 1x24 jam</li>
                        <li>Status kamar akan berubah menjadi "Di Booking"</li>
                        <li>Anda wajib melakukan pembayaran DP 50% dalam 24 jam setelah booking diterima</li>
                        <li>Jika tidak ada pembayaran DP, booking akan otomatis dibatalkan</li>
                    </ul>
                </div>

                <!-- Submit Button -->
                <button type="submit" class="btn-submit">
                    <i class="fas fa-check-circle"></i>
                    Konfirmasi Booking
                </button>
            <?= form_close() ?>

            <a href="<?= base_url('kamar/katalog') ?>" class="btn-back">
                <i class="fas fa-arrow-left"></i>
                Kembali ke Katalog
            </a>
        </div>

        <!-- Sidebar -->
        <div class="sidebar-section">
            <!-- Kamar Info -->
            <h3><i class="fas fa-door-open" style="margin-right: 10px;"></i>Detail Kamar</h3>

            <div class="kamar-info-item">
                <span class="kamar-info-label">Nomor Kamar</span>
                <span class="kamar-info-value"><?= esc($kamar['nomor_kamar']) ?></span>
            </div>
            <div class="kamar-info-item">
                <span class="kamar-info-label">Tipe Kamar</span>
                <span class="kamar-info-value"><?= esc($kamar['tipe_kamar']) ?></span>
            </div>
            <div class="kamar-info-item">
                <span class="kamar-info-label">Kapasitas</span>
                <span class="kamar-info-value"><?= esc($kamar['kapasitas']) ?> Orang</span>
            </div>
            <div class="kamar-info-item">
                <span class="kamar-info-label">Status</span>
                <span class="kamar-info-value" style="color: #28a745;">
                    <i class="fas fa-check-circle" style="margin-right: 5px;"></i><?= esc($kamar['status']) ?>
                </span>
            </div>

            <!-- Price Highlight -->
            <div class="price-box">
                <div class="label">Harga per Bulan</div>
                <div class="price">Rp <?= number_format(esc($kamar['harga']), 0, ',', '.') ?></div>
                <div class="duration">/ Bulan</div>
            </div>

            <!-- Calculation -->
            <div style="background: #f8f9fa; border-radius: 12px; padding: 20px; margin-top: 25px;">
                <h4 style="font-size: 16px; font-weight: 700; color: #343a40; margin-bottom: 15px;">
                    <i class="fas fa-calculator" style="color: #007bff; margin-right: 8px;"></i>
                    Kalkulasi Biaya
                </h4>
                
                <div style="display: flex; justify-content: space-between; padding: 10px 0; border-bottom: 1px solid #e9ecef;">
                    <span style="color: #6c757d; font-size: 14px;">Harga/Bulan</span>
                    <span style="color: #343a40; font-weight: 600;">Rp <?= number_format(esc($kamar['harga']), 0, ',', '.') ?></span>
                </div>
                <div style="display: flex; justify-content: space-between; padding: 10px 0; border-bottom: 1px solid #e9ecef;">
                    <span style="color: #6c757d; font-size: 14px;">Durasi</span>
                    <span style="color: #343a40; font-weight: 600;" id="durasi-display">-</span>
                </div>
                <div style="display: flex; justify-content: space-between; padding: 10px 0; background: #e7f3ff; border-radius: 8px; padding: 10px; margin: 10px 0;">
                    <span style="color: #007bff; font-size: 14px; font-weight: 600;">Total</span>
                    <span style="color: #007bff; font-weight: 700; font-size: 18px;" id="total-display">Rp 0</span>
                </div>
                <div style="display: flex; justify-content: space-between; padding: 10px 0; color: #28a745;">
                    <span style="font-size: 14px; font-weight: 600;">DP 50%</span>
                    <span style="font-weight: 700; font-size: 16px;" id="dp-display">Rp 0</span>
                </div>
            </div>

            <!-- Fasilitas -->
            <div style="margin-top: 25px;">
                <h4 style="font-size: 16px; font-weight: 700; color: #343a40; margin-bottom: 15px;">
                    <i class="fas fa-star" style="color: #ffc107; margin-right: 8px;"></i>
                    Fasilitas Kamar
                </h4>
                <ul style="list-style: none; padding: 0; margin: 0;">
                    <li style="padding: 8px 0; display: flex; align-items: center; color: #6c757d; font-size: 14px;">
                        <i class="fas fa-check text-success" style="margin-right: 10px; width: 20px;"></i>
                        WiFi Gratis
                    </li>
                    <li style="padding: 8px 0; display: flex; align-items: center; color: #6c757d; font-size: 14px;">
                        <i class="fas fa-check text-success" style="margin-right: 10px; width: 20px;"></i>
                        AC & Kipas Angin
                    </li>
                    <li style="padding: 8px 0; display: flex; align-items: center; color: #6c757d; font-size: 14px;">
                        <i class="fas fa-check text-success" style="margin-right: 10px; width: 20px;"></i>
                        Kamar Mandi Dalam
                    </li>
                    <li style="padding: 8px 0; display: flex; align-items: center; color: #6c757d; font-size: 14px;">
                        <i class="fas fa-check text-success" style="margin-right: 10px; width: 20px;"></i>
                        Kasur & Bantal
                    </li>
                    <li style="padding: 8px 0; display: flex; align-items: center; color: #6c757d; font-size: 14px;">
                        <i class="fas fa-check text-success" style="margin-right: 10px; width: 20px;"></i>
                        Lemari & Meja Belajar
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>

<script>
    const hargaPerBulan = <?= esc($kamar['harga']) ?>;
    const durasiSelect = document.getElementById('durasi_sewa_bulan');
    const durasiDisplay = document.getElementById('durasi-display');
    const totalDisplay = document.getElementById('total-display');
    const dpDisplay = document.getElementById('dp-display');

    function updateCalculation() {
        const durasi = parseInt(durasiSelect.value) || 0;
        if (durasi > 0) {
            const total = hargaPerBulan * durasi;
            const dp = total * 0.5;
            durasiDisplay.textContent = durasi + ' Bulan';
            totalDisplay.textContent = 'Rp ' + total.toLocaleString('id-ID');
            dpDisplay.textContent = 'Rp ' + Math.round(dp).toLocaleString('id-ID');
        } else {
            durasiDisplay.textContent = '-';
            totalDisplay.textContent = 'Rp 0';
            dpDisplay.textContent = 'Rp 0';
        }
    }

    durasiSelect.addEventListener('change', updateCalculation);
    updateCalculation();
</script>

<?= $this->endSection() ?>