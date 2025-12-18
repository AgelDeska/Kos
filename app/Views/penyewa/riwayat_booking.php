<?= $this->extend('layout/penyewa_template') ?>

<?= $this->section('content') ?>

<!-- Header -->
<div class="mb-6">
    <h2 class="text-3xl font-bold text-gray-900 mb-2">
        <i class="fas fa-calendar-check text-blue-600 mr-2"></i>Riwayat Booking Saya
    </h2>
    <p class="text-gray-600">Kelola semua booking kamar Anda di sini</p>
</div>

<!-- Filter & Search -->
<div class="card p-6 mb-6 rounded-xl shadow-md">
    <div class="flex flex-col md:flex-row gap-4 items-center">
        <input type="text" id="searchBooking" placeholder="Cari berdasarkan nomor kamar atau ID booking..." 
               class="flex-1 px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
        <select id="filterStatus" class="px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
            <option value="">Semua Status</option>
            <option value="Menunggu">Menunggu</option>
            <option value="Diterima">Diterima</option>
            <option value="Selesai">Selesai</option>
        </select>
        <a href="<?= base_url('katalog') ?>" class="btn-primary">
            <i class="fas fa-plus mr-2"></i>Booking Baru
        </a>
    </div>
</div>

<!-- Bookings List -->
<div class="grid gap-6">
    <?php if (empty($bookings)): ?>
        <!-- Empty State -->
        <div class="card p-12 rounded-xl shadow-md text-center">
            <i class="fas fa-inbox text-6xl text-gray-300 mb-4"></i>
            <h3 class="text-2xl font-bold text-gray-900 mb-2">Belum ada booking</h3>
            <p class="text-gray-600 mb-6">Anda belum memiliki riwayat booking. Mulai dengan mencari kamar yang tersedia.</p>
            <a href="<?= base_url('katalog') ?>" class="btn-primary inline-block">
                <i class="fas fa-search mr-2"></i>Cari Kamar Sekarang
            </a>
        </div>
    <?php else: ?>
        <?php foreach ($bookings as $b): ?>
            <div class="card rounded-xl shadow-md hover:shadow-lg transition overflow-hidden" data-booking-id="<?= esc($b['booking_id']) ?>" data-status="<?= esc($b['status']) ?>" data-kamar="<?= esc($b['nomor_kamar'] ?? '') ?>">
                <div class="p-6 border-b border-gray-200 bg-gradient-to-r from-gray-50 to-white">
                    <div class="flex flex-col md:flex-row md:items-center md:justify-between">
                        <div>
                            <div class="flex items-center space-x-4">
                                <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center">
                                    <i class="fas fa-door-open text-blue-600 text-xl"></i>
                                </div>
                                <div>
                                    <p class="text-xs text-gray-500 font-semibold uppercase">Booking ID</p>
                                    <h3 class="text-2xl font-bold text-gray-900">#<?= esc($b['booking_id']) ?></h3>
                                </div>
                            </div>
                        </div>
                        <div class="mt-4 md:mt-0">
                            <?php 
                                $statusBadges = [
                                    'Menunggu' => 'badge-warning',
                                    'Diterima' => 'badge-info',
                                    'Selesai' => 'badge-success',
                                ];
                                $statusIcons = [
                                    'Menunggu' => 'fa-hourglass-half',
                                    'Diterima' => 'fa-check-circle',
                                    'Selesai' => 'fa-check',
                                ];
                                $status = $b['status'] ?? 'Menunggu';
                            ?>
                            <span class="badge <?= $statusBadges[$status] ?? 'badge-info' ?> text-lg px-4 py-2">
                                <i class="fas <?= $statusIcons[$status] ?? 'fa-info-circle' ?> mr-2"></i><?= $status ?>
                            </span>
                        </div>
                    </div>
                </div>

                <div class="p-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-6">
                        <!-- Kamar Info -->
                        <div class="bg-gray-50 p-4 rounded-lg">
                            <p class="text-xs text-gray-500 font-semibold uppercase mb-2">Kamar</p>
                            <p class="text-xl font-bold text-gray-900">No. <?= esc($b['nomor_kamar'] ?? '-') ?></p>
                            <p class="text-sm text-gray-600 mt-1"><?= esc($b['tipe_kamar'] ?? '-') ?></p>
                        </div>

                        <!-- Tanggal Booking -->
                        <div class="bg-gray-50 p-4 rounded-lg">
                            <p class="text-xs text-gray-500 font-semibold uppercase mb-2">Tanggal Booking</p>
                            <p class="text-lg font-bold text-gray-900"><?= date('d M Y', strtotime($b['tanggal_booking'])) ?></p>
                            <p class="text-xs text-gray-500 mt-1"><?= date('H:i', strtotime($b['tanggal_booking'])) ?> WIB</p>
                        </div>

                        <!-- Tanggal Mulai Sewa -->
                        <div class="bg-gray-50 p-4 rounded-lg">
                            <p class="text-xs text-gray-500 font-semibold uppercase mb-2">Mulai Sewa</p>
                            <p class="text-lg font-bold text-gray-900"><?= date('d M Y', strtotime($b['tanggal_mulai_sewa'])) ?></p>
                            <p class="text-sm text-gray-600 mt-1">
                                <i class="fas fa-calendar-alt mr-1"></i><?= esc($b['durasi_sewa_bulan']) ?> Bulan
                            </p>
                        </div>

                        <!-- Total Biaya / DP -->
                        <div class="bg-gray-50 p-4 rounded-lg">
                            <p class="text-xs text-gray-500 font-semibold uppercase mb-2">Total Biaya</p>
                            <p class="text-lg font-bold text-gray-900">Rp <?= number_format($b['total_biaya'] ?? 0, 0, ',', '.') ?></p>
                            <p class="text-sm text-gray-600 mt-1">DP: Rp <?= number_format($b['dp_amount'] ?? 0, 0, ',', '.') ?></p>
                        </div>
                    </div>

                    <!-- Actions -->
                    <div class="flex flex-col md:flex-row gap-3 pt-4 border-t border-gray-200">
                        <?php if ($status == 'Diterima'): ?>
                            <a href="<?= base_url('penyewa/pembayaran/form-dp/' . $b['booking_id']) ?>" class="btn-primary flex items-center justify-center">
                                <i class="fas fa-wallet mr-2"></i>Bayar DP Sekarang
                            </a>
                            <a href="<?= base_url('penyewa/booking/' . $b['booking_id'] . '/detail') ?>" class="btn-secondary flex items-center justify-center">
                                <i class="fas fa-eye mr-2"></i>Lihat Detail
                            </a>
                        <?php elseif ($status == 'Menunggu'): ?>
                            <div class="flex gap-2">
                                <form action="<?= base_url('penyewa/booking/' . $b['booking_id'] . '/batal') ?>" method="POST" class="inline" onsubmit="return confirm('Apakah Anda yakin ingin membatalkan booking ini?')">
                                    <?= csrf_field() ?>
                                    <button type="submit" class="btn-danger flex items-center justify-center">
                                        <i class="fas fa-times mr-2"></i>Batal Booking
                                    </button>
                                </form>
                                <a href="<?= base_url('penyewa/booking/' . $b['booking_id'] . '/detail') ?>" class="btn-secondary flex items-center justify-center">
                                    <i class="fas fa-eye mr-2"></i>Lihat Detail
                                </a>
                            </div>
                        <?php elseif ($status == 'Selesai'): ?>
                            <a href="<?= base_url('penyewa/pembayaran/form-bulanan/' . $b['booking_id']) ?>" class="btn-primary flex items-center justify-center">
                                <i class="fas fa-credit-card mr-2"></i>Bayar Cicilan
                            </a>
                            <a href="<?= base_url('penyewa/booking/' . $b['booking_id'] . '/detail') ?>" class="btn-secondary flex items-center justify-center">
                                <i class="fas fa-eye mr-2"></i>Lihat Detail
                            </a>
                        <?php else: ?>
                            <a href="<?= base_url('penyewa/booking/' . $b['booking_id'] . '/detail') ?>" class="btn-secondary flex items-center justify-center">
                                <i class="fas fa-eye mr-2"></i>Lihat Detail
                            </a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    <?php endif; ?>
</div>

<script>
    // Simple search filter (client-side)
    const searchInput = document.getElementById('searchBooking');
    const statusFilter = document.getElementById('filterStatus');
    const bookingCards = document.querySelectorAll('[data-booking-id]');

    function filterBookings() {
        const searchTerm = (searchInput.value || '').toLowerCase();
        const statusTerm = statusFilter.value;

        bookingCards.forEach(card => {
            const bookingId = (card.getAttribute('data-booking-id') || '').toLowerCase();
            const kamar = (card.getAttribute('data-kamar') || '').toLowerCase();
            const status = card.getAttribute('data-status');

            const matchSearch = !searchTerm || bookingId.includes(searchTerm) || kamar.includes(searchTerm);
            const matchStatus = !statusTerm || status === statusTerm;

            card.style.display = (matchSearch && matchStatus) ? '' : 'none';
        });
    }

    searchInput?.addEventListener('keyup', filterBookings);
    statusFilter?.addEventListener('change', filterBookings);
</script>

<?= $this->endSection() ?>