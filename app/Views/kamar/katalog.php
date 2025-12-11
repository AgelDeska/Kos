<?= $this->extend('layout/public_template') ?>

<?= $this->section('content') ?>

<style>
    .katalog-container {
        max-width: 1400px;
        margin: 0 auto;
        padding: 40px 20px;
    }

    /* Header Section */
    .katalog-header {
        text-align: center;
        margin-bottom: 60px;
        animation: fadeInDown 0.6s ease-out;
    }

    .katalog-header h1 {
        font-size: 48px;
        font-weight: 700;
        color: #343a40;
        margin-bottom: 15px;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 15px;
    }

    .katalog-header h1 i {
        color: #007bff;
        font-size: 50px;
    }

    .katalog-header p {
        font-size: 18px;
        color: #6c757d;
        max-width: 700px;
        margin: 0 auto;
        line-height: 1.6;
    }

    /* Filter & Search Section */
    .filter-section {
        background: white;
        border-radius: 16px;
        padding: 30px;
        margin-bottom: 40px;
        box-shadow: 0 4px 15px rgba(0,0,0,0.08);
        border: 1px solid #e9ecef;
    }

    .filter-title {
        font-size: 18px;
        font-weight: 700;
        color: #343a40;
        margin-bottom: 20px;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .filter-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 20px;
    }

    .filter-group {
        display: flex;
        flex-direction: column;
    }

    .filter-group label {
        font-size: 14px;
        font-weight: 600;
        color: #343a40;
        margin-bottom: 10px;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .filter-group label i {
        color: #007bff;
        font-size: 16px;
    }

    .filter-group select {
        padding: 12px 15px;
        border: 2px solid #e9ecef;
        border-radius: 10px;
        font-size: 14px;
        font-family: 'Poppins', sans-serif;
        color: #343a40;
        background: white;
        cursor: pointer;
        transition: all 0.3s ease;
    }

    .filter-group select:focus {
        border-color: #007bff;
        box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25);
        outline: none;
    }

    .filter-actions {
        display: flex;
        gap: 10px;
        align-items: flex-end;
    }

    .btn-filter {
        flex: 1;
        padding: 12px 20px;
        background: linear-gradient(135deg, #007bff 0%, #0056b3 100%);
        color: white;
        border: none;
        border-radius: 10px;
        font-size: 14px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s ease;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        font-family: 'Poppins', sans-serif;
    }

    .btn-filter:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(0, 123, 255, 0.3);
    }

    .btn-reset {
        padding: 12px 20px;
        background: white;
        color: #007bff;
        border: 2px solid #007bff;
        border-radius: 10px;
        font-size: 14px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s ease;
        font-family: 'Poppins', sans-serif;
    }

    .btn-reset:hover {
        background: #f0f7ff;
    }

    /* Kamar Grid */
    .kamar-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(340px, 1fr));
        gap: 30px;
        margin-bottom: 40px;
        animation: fadeInUp 0.8s ease-out;
    }

    .kamar-card {
        background: white;
        border-radius: 16px;
        overflow: hidden;
        box-shadow: 0 4px 15px rgba(0,0,0,0.08);
        border: 1px solid #e9ecef;
        transition: all 0.4s cubic-bezier(0.34, 1.56, 0.64, 1);
        display: flex;
        flex-direction: column;
        height: 100%;
        position: relative;
    }

    .kamar-card:hover {
        transform: translateY(-12px);
        box-shadow: 0 16px 40px rgba(0,0,0,0.15);
        border-color: #007bff;
    }

    /* Image Container */
    .kamar-image-wrapper {
        position: relative;
        overflow: hidden;
        height: 220px;
        background: linear-gradient(135deg, #f5f7fa 0%, #e9ecef 100%);
    }

    .kamar-image {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.6s ease;
    }

    .kamar-card:hover .kamar-image {
        transform: scale(1.15) rotate(2deg);
    }

    /* Status Badge */
    .status-badge {
        position: absolute;
        top: 15px;
        right: 15px;
        padding: 8px 16px;
        border-radius: 50px;
        font-size: 12px;
        font-weight: 700;
        display: flex;
        align-items: center;
        gap: 6px;
        box-shadow: 0 4px 12px rgba(0,0,0,0.15);
        backdrop-filter: blur(10px);
        z-index: 10;
    }

    .badge-tersedia {
        background: rgba(40, 167, 69, 0.95);
        color: white;
    }

    .badge-booking {
        background: rgba(255, 193, 7, 0.95);
        color: #000;
    }

    .badge-penuh {
        background: rgba(220, 53, 69, 0.95);
        color: white;
    }

    /* Rating Badge */
    .rating-badge {
        position: absolute;
        bottom: 15px;
        left: 15px;
        background: white;
        padding: 8px 12px;
        border-radius: 10px;
        display: flex;
        align-items: center;
        gap: 6px;
        font-size: 13px;
        font-weight: 600;
        color: #343a40;
        box-shadow: 0 4px 12px rgba(0,0,0,0.1);
    }

    .rating-badge i {
        color: #ffc107;
    }

    /* Card Content */
    .kamar-content {
        padding: 25px;
        display: flex;
        flex-direction: column;
        flex-grow: 1;
    }

    .kamar-header {
        margin-bottom: 15px;
    }

    .kamar-nomor {
        font-size: 24px;
        font-weight: 700;
        color: #343a40;
        margin-bottom: 5px;
    }

    .kamar-tipe {
        font-size: 13px;
        color: #007bff;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .kamar-info {
        display: flex;
        align-items: center;
        gap: 8px;
        font-size: 13px;
        color: #6c757d;
        margin-bottom: 3px;
    }

    .kamar-info i {
        color: #007bff;
        width: 16px;
    }

    /* Features Grid */
    .kamar-features {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 10px;
        margin: 20px 0;
        padding: 15px 0;
        border-top: 1px solid #e9ecef;
        border-bottom: 1px solid #e9ecef;
    }

    .feature-item {
        display: flex;
        align-items: center;
        gap: 8px;
        font-size: 13px;
        color: #6c757d;
    }

    .feature-item i {
        color: #28a745;
        font-size: 14px;
        width: 16px;
    }

    /* Price Section */
    .price-section {
        background: linear-gradient(135deg, #f0f7ff 0%, #e7f3ff 100%);
        padding: 15px;
        border-radius: 10px;
        margin-bottom: 20px;
        text-align: center;
    }

    .price-label {
        font-size: 12px;
        color: #6c757d;
        margin-bottom: 5px;
        font-weight: 500;
    }

    .price-value {
        font-size: 28px;
        font-weight: 700;
        color: #007bff;
    }

    .price-period {
        font-size: 12px;
        color: #6c757d;
        margin-top: 3px;
    }

    /* Buttons */
    .button-group {
        display: flex;
        gap: 10px;
        margin-top: auto;
    }

    .btn-detail {
        flex: 1;
        padding: 12px;
        background: white;
        color: #007bff;
        border: 2px solid #007bff;
        border-radius: 10px;
        font-size: 14px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s ease;
        font-family: 'Poppins', sans-serif;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 6px;
        text-decoration: none;
    }

    .btn-detail:hover {
        background: #f0f7ff;
        transform: translateY(-2px);
    }

    .btn-booking {
        flex: 1;
        padding: 12px;
        background: linear-gradient(135deg, #007bff 0%, #0056b3 100%);
        color: white;
        border: none;
        border-radius: 10px;
        font-size: 14px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s ease;
        font-family: 'Poppins', sans-serif;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 6px;
        text-decoration: none;
    }

    .btn-booking:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(0, 123, 255, 0.3);
    }

    .btn-disabled {
        flex: 1;
        padding: 12px;
        background: #e9ecef;
        color: #999;
        border: 2px solid #dee2e6;
        border-radius: 10px;
        font-size: 14px;
        font-weight: 600;
        cursor: not-allowed;
        opacity: 0.6;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 6px;
    }

    /* Empty State */
    .empty-state {
        grid-column: 1 / -1;
        text-align: center;
        padding: 80px 20px;
    }

    .empty-state-icon {
        font-size: 80px;
        color: #dee2e6;
        margin-bottom: 20px;
    }

    .empty-state-title {
        font-size: 24px;
        font-weight: 700;
        color: #343a40;
        margin-bottom: 10px;
    }

    .empty-state-text {
        font-size: 16px;
        color: #6c757d;
        margin-bottom: 30px;
    }

    /* Pagination */
    .pagination-wrapper {
        display: flex;
        justify-content: center;
        align-items: center;
        gap: 10px;
        margin-top: 40px;
    }

    .pagination-wrapper a, .pagination-wrapper button {
        padding: 10px 15px;
        border: 2px solid #e9ecef;
        border-radius: 8px;
        background: white;
        color: #007bff;
        cursor: pointer;
        font-size: 14px;
        font-weight: 600;
        transition: all 0.3s ease;
        font-family: 'Poppins', sans-serif;
    }

    .pagination-wrapper a:hover, .pagination-wrapper button:hover {
        border-color: #007bff;
        background: #f0f7ff;
    }

    .pagination-wrapper .active {
        background: #007bff;
        color: white;
        border-color: #007bff;
    }

    /* Animations */
    @keyframes fadeInDown {
        from {
            opacity: 0;
            transform: translateY(-30px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(30px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    /* Responsive */
    @media (max-width: 1024px) {
        .kamar-grid {
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 25px;
        }

        .filter-grid {
            grid-template-columns: repeat(2, 1fr);
        }
    }

    @media (max-width: 768px) {
        .katalog-header h1 {
            font-size: 36px;
        }

        .kamar-grid {
            grid-template-columns: 1fr;
            gap: 20px;
        }

        .filter-grid {
            grid-template-columns: 1fr;
        }

        .filter-actions {
            flex-direction: column;
        }

        .button-group {
            flex-direction: column;
        }
    }
</style>

<div class="katalog-container">
    <!-- Header -->
    <div class="katalog-header">
        <h1>
            <i class="fas fa-door-open"></i>
            Katalog Kamar SmartKos Agezitomik
        </h1>
        <p>Pilih kamar impian Anda dari berbagai pilihan tipe, harga, dan fasilitas yang sesuai dengan kebutuhan Anda</p>
    </div>

    <!-- Filter Section -->
    <div class="filter-section">
        <div class="filter-title">
            <i class="fas fa-sliders-h"></i>
            Filter Kamar
        </div>
        <form method="get" action="<?= base_url('kamar/katalog') ?>" id="filterForm">
            <div class="filter-grid">
                <div class="filter-group">
                    <label for="tipe">
                        <i class="fas fa-door-open"></i>
                        Tipe Kamar
                    </label>
                    <select name="tipe" id="tipe">
                        <option value="">Semua Tipe</option>
                        <option value="Single">Single</option>
                        <option value="Double">Double</option>
                        <option value="Suite">Suite</option>
                        <option value="Standard">Standard</option>
                    </select>
                </div>

                <div class="filter-group">
                    <label for="status">
                        <i class="fas fa-check-circle"></i>
                        Status
                    </label>
                    <select name="status" id="status">
                        <option value="">Semua Status</option>
                        <option value="Tersedia">Tersedia</option>
                        <option value="Di Booking">Di Booking</option>
                        <option value="Penuh">Penuh</option>
                    </select>
                </div>

                <div class="filter-group">
                    <label for="harga">
                        <i class="fas fa-money-bill"></i>
                        Range Harga
                    </label>
                    <select name="harga" id="harga">
                        <option value="">Semua Harga</option>
                        <option value="1000000">Dibawah Rp 1.000.000</option>
                        <option value="1000000-2000000">Rp 1.000.000 - Rp 2.000.000</option>
                        <option value="2000000">Diatas Rp 2.000.000</option>
                    </select>
                </div>

                <div class="filter-group">
                    <label for="kapasitas">
                        <i class="fas fa-users"></i>
                        Kapasitas
                    </label>
                    <select name="kapasitas" id="kapasitas">
                        <option value="">Semua Kapasitas</option>
                        <option value="1">1 Orang</option>
                        <option value="2">2 Orang</option>
                        <option value="3">3 Orang</option>
                        <option value="4">4 Orang</option>
                    </select>
                </div>
            </div>

            <div style="display: flex; gap: 15px; margin-top: 20px;">
                <button type="submit" class="btn-filter">
                    <i class="fas fa-filter"></i>
                    Terapkan Filter
                </button>
                <a href="<?= base_url('kamar/katalog') ?>" class="btn-reset">
                    <i class="fas fa-redo"></i>
                    Reset
                </a>
            </div>
        </form>
    </div>

    <!-- Kamar Grid -->
    <div class="kamar-grid">
        <?php if (empty($kamars)): ?>
            <div class="empty-state">
                <div class="empty-state-icon">
                    <i class="fas fa-inbox"></i>
                </div>
                <h3 class="empty-state-title">Tidak Ada Kamar Tersedia</h3>
                <p class="empty-state-text">Maaf, kamar yang Anda cari tidak ditemukan. Silakan coba filter lain atau hubungi admin.</p>
            </div>
        <?php endif; ?>

        <?php foreach ($kamars as $kamar): ?>
            <div class="kamar-card">
                <!-- Image Container -->
                <div class="kamar-image-wrapper">
                    <img 
                        src="<?= base_url('img/kamar/' . ($kamar['foto_kamar'] ?? 'placeholder.jpg')) ?>" 
                        alt="Kamar <?= esc($kamar['nomor_kamar']) ?>"
                        class="kamar-image"
                        onerror="this.src='https://via.placeholder.com/400x300?text=Kamar+<?= esc($kamar['nomor_kamar']) ?>'"
                    />

                    <!-- Status Badge -->
                    <?php 
                        $statusClass = 'badge-tersedia';
                        $statusIcon = 'fa-check-circle';
                        $statusText = $kamar['status'];
                        
                        if ($kamar['status'] == 'Di Booking') {
                            $statusClass = 'badge-booking';
                            $statusIcon = 'fa-hourglass-half';
                        } elseif ($kamar['status'] == 'Penuh' || $kamar['status'] == 'Terisi') {
                            $statusClass = 'badge-penuh';
                            $statusIcon = 'fa-times-circle';
                        }
                    ?>
                    <div class="status-badge <?= $statusClass ?>">
                        <i class="fas <?= $statusIcon ?>"></i>
                        <?= $statusText ?>
                    </div>

                    <!-- Rating Badge -->
                    <div class="rating-badge">
                        <i class="fas fa-star"></i>
                        <span>4.8</span>
                    </div>
                </div>

                <!-- Content -->
                <div class="kamar-content">
                    <!-- Header Info -->
                    <div class="kamar-header">
                        <div class="kamar-nomor">Kamar No. <?= esc($kamar['nomor_kamar']) ?></div>
                        <div class="kamar-tipe"><?= esc($kamar['tipe_kamar'] ?? 'Standard') ?></div>
                    </div>

                    <!-- Details -->
                    <div class="kamar-info">
                        <i class="fas fa-users"></i>
                        <span>Kapasitas: <?= esc($kamar['kapasitas']) ?> orang</span>
                    </div>

                    <!-- Features Grid -->
                    <div class="kamar-features">
                        <div class="feature-item">
                            <i class="fas fa-wifi"></i>
                            <span>WiFi Gratis</span>
                        </div>
                        <div class="feature-item">
                            <i class="fas fa-fan"></i>
                            <span>AC & Kipas</span>
                        </div>
                        <div class="feature-item">
                            <i class="fas fa-water"></i>
                            <span>Kamar Mandi</span>
                        </div>
                        <div class="feature-item">
                            <i class="fas fa-bed"></i>
                            <span>Kasur Premium</span>
                        </div>
                    </div>

                    <!-- Price -->
                    <div class="price-section">
                        <div class="price-label">Harga per Bulan</div>
                        <div class="price-value">Rp <?= number_format(esc($kamar['harga']), 0, ',', '.') ?></div>
                        <div class="price-period">/ Bulan</div>
                    </div>

                    <!-- Buttons -->
                    <div class="button-group">
                        <a 
                            href="<?= base_url('kamar/' . esc($kamar['kamar_id'])) ?>" 
                            class="btn-detail"
                        >
                            <i class="fas fa-eye"></i>
                            Detail
                        </a>

                        <?php if ($kamar['status'] == 'Tersedia'): ?>
                            <?php if (session()->get('isLoggedIn') && strtolower(session()->get('role')) == 'penyewa'): ?>
                                <a 
                                    href="<?= base_url('penyewa/booking/' . esc($kamar['kamar_id'])) ?>" 
                                    class="btn-booking"
                                >
                                    <i class="fas fa-calendar-check"></i>
                                    Booking
                                </a>
                            <?php else: ?>
                                <a 
                                    href="<?= base_url('login') ?>" 
                                    class="btn-booking"
                                >
                                    <i class="fas fa-sign-in-alt"></i>
                                    Login
                                </a>
                            <?php endif; ?>
                        <?php else: ?>
                            <button disabled class="btn-disabled">
                                <i class="fas fa-lock"></i>
                                Tdk Tersedia
                            </button>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>

<?= $this->endSection() ?>