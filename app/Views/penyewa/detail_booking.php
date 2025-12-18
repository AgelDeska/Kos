<?= $this->extend('layout/penyewa_template') ?>

<?= $this->section('content') ?>

<div class="py-6">
    <!-- Header dengan Breadcrumb -->
    <div class="mb-6">
        <div class="flex items-center justify-between mb-4">
            <div>
                <h1 class="text-3xl font-bold text-gray-900">Detail Booking</h1>
                <p class="text-gray-600 text-sm mt-1">Nomor Booking: #<?= esc($booking['booking_id']) ?></p>
            </div>
            <a href="<?= base_url('/penyewa/riwayat-booking') ?>" class="btn btn-secondary flex items-center">
                <i class="fas fa-arrow-left mr-2"></i>Kembali
            </a>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Main Content (2/3) -->
        <div class="lg:col-span-2">
            <!-- Status Card -->
            <div class="bg-white rounded-lg shadow-md p-6 mb-6 border-l-4 border-blue-500">
                <div class="flex items-center justify-between">
                    <div>
                        <h3 class="text-lg font-semibold text-gray-900 mb-1">Status Booking</h3>
                        <p class="text-gray-600 text-sm">Tanggal Booking: <?= date('d M Y H:i', strtotime($booking['tanggal_booking'])) ?></p>
                    </div>
                    <div>
                        <?php
                            $status = $booking['status'];
                            $statusClasses = [
                                'Menunggu' => 'badge-warning',
                                'Diterima' => 'badge-info',
                                'Ditolak' => 'badge-danger',
                                'Selesai' => 'badge-success',
                            ];
                            $statusIcons = [
                                'Menunggu' => 'fa-hourglass-half',
                                'Diterima' => 'fa-check-circle',
                                'Ditolak' => 'fa-times-circle',
                                'Selesai' => 'fa-check',
                            ];
                        ?>
                        <span class="badge <?= $statusClasses[$status] ?? 'badge-info' ?> text-lg px-4 py-2">
                            <i class="fas <?= $statusIcons[$status] ?? 'fa-info-circle' ?> mr-2"></i><?= $status ?>
                        </span>
                    </div>
                </div>
            </div>

            <!-- Informasi Booking -->
            <div class="bg-white rounded-lg shadow-md p-6 mb-6">
                <h3 class="text-lg font-bold text-gray-900 mb-4 pb-3 border-b-2 border-gray-200">
                    <i class="fas fa-calendar-check text-blue-500 mr-2"></i>Detail Booking
                </h3>
                <div class="grid grid-cols-2 gap-4">
                    <div class="bg-gray-50 p-4 rounded-lg">
                        <p class="text-gray-600 text-sm font-medium">Tanggal Booking</p>
                        <p class="text-gray-900 font-bold text-lg mt-1"><?= date('d M Y', strtotime($booking['tanggal_booking'])) ?></p>
                        <p class="text-gray-500 text-xs mt-1"><?= date('H:i', strtotime($booking['tanggal_booking'])) ?> WIB</p>
                    </div>
                    <div class="bg-gray-50 p-4 rounded-lg">
                        <p class="text-gray-600 text-sm font-medium">Tanggal Mulai Sewa</p>
                        <p class="text-gray-900 font-bold text-lg mt-1"><?= date('d M Y', strtotime($booking['tanggal_mulai_sewa'])) ?></p>
                    </div>
                    <div class="bg-blue-50 p-4 rounded-lg border border-blue-200">
                        <p class="text-gray-600 text-sm font-medium">Durasi Sewa</p>
                        <p class="text-blue-900 font-bold text-xl mt-1"><?= esc($booking['durasi_sewa_bulan']) ?> Bulan</p>
                    </div>
                    <div class="bg-gray-50 p-4 rounded-lg">
                        <p class="text-gray-600 text-sm font-medium">Tanggal Selesai</p>
                        <p class="text-gray-900 font-bold text-lg mt-1"><?= date('d M Y', strtotime($booking['tanggal_selesai_sewa'])) ?></p>
                    </div>
                </div>
            </div>

            <!-- Informasi Kamar -->
            <?php if ($kamar): ?>
            <div class="bg-white rounded-lg shadow-md p-6 mb-6">
                <h3 class="text-lg font-bold text-gray-900 mb-4 pb-3 border-b-2 border-gray-200">
                    <i class="fas fa-door-open text-purple-500 mr-2"></i>Informasi Kamar
                </h3>
                <div class="grid grid-cols-2 gap-4">
                    <div class="bg-gray-50 p-4 rounded-lg">
                        <p class="text-gray-600 text-sm font-medium">Nomor Kamar</p>
                        <p class="text-gray-900 font-bold text-lg mt-1"><?= esc($kamar['nomor_kamar']) ?></p>
                    </div>
                    <div class="bg-gray-50 p-4 rounded-lg">
                        <p class="text-gray-600 text-sm font-medium">Tipe Kamar</p>
                        <p class="text-gray-900 font-bold text-lg mt-1"><?= esc($kamar['tipe_kamar']) ?></p>
                    </div>
                    <div class="bg-green-50 p-4 rounded-lg border border-green-200">
                        <p class="text-gray-600 text-sm font-medium">Harga per Bulan</p>
                        <p class="text-green-900 font-bold text-lg mt-1">Rp <?= number_format($kamar['harga'], 0, ',', '.') ?></p>
                    </div>
                    <div class="bg-gray-50 p-4 rounded-lg">
                        <p class="text-gray-600 text-sm font-medium">Status Kamar</p>
                        <p class="text-gray-900 font-bold text-lg mt-1">
                            <span class="badge badge-success">
                                <i class="fas fa-check-circle mr-1"></i>Tersedia
                            </span>
                        </p>
                    </div>
                </div>
            </div>
            <?php endif; ?>

            <!-- Informasi Biaya -->
            <div class="bg-white rounded-lg shadow-md p-6 mb-6">
                <h3 class="text-lg font-bold text-gray-900 mb-4 pb-3 border-b-2 border-gray-200">
                    <i class="fas fa-money-bill-wave text-green-500 mr-2"></i>Ringkasan Biaya
                </h3>
                <div class="space-y-3">
                    <div class="flex justify-between items-center py-2">
                        <span class="text-gray-600">Harga per Bulan</span>
                        <span class="font-semibold">Rp <?= number_format($kamar['harga'] ?? 0, 0, ',', '.') ?></span>
                    </div>
                    <div class="flex justify-between items-center py-2">
                        <span class="text-gray-600">Durasi Sewa</span>
                        <span class="font-semibold"><?= esc($booking['durasi_sewa_bulan']) ?> Bulan</span>
                    </div>
                    <div class="border-t pt-3">
                        <div class="flex justify-between items-center">
                            <span class="text-gray-900 font-semibold">Total Biaya</span>
                            <span class="text-green-600 font-bold text-xl">Rp <?= number_format($booking['total_biaya'], 0, ',', '.') ?></span>
                        </div>
                        <div class="flex justify-between items-center mt-2">
                            <span class="text-gray-600">DP (Down Payment)</span>
                            <span class="font-semibold">Rp <?= number_format($booking['dp_amount'], 0, ',', '.') ?></span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Timeline Status -->
            <div class="bg-white rounded-lg shadow-md p-6">
                <h3 class="text-lg font-bold text-gray-900 mb-4 pb-3 border-b-2 border-gray-200">
                    <i class="fas fa-history text-indigo-500 mr-2"></i>Riwayat Status
                </h3>
                <div class="space-y-4">
                    <!-- Event 1: Booking Created -->
                    <div class="flex items-start">
                        <div class="flex-shrink-0">
                            <div class="flex items-center justify-center h-8 w-8 rounded-full bg-blue-500 text-white">
                                <i class="fas fa-plus text-sm"></i>
                            </div>
                        </div>
                        <div class="ml-4 flex-1">
                            <p class="font-semibold text-gray-900">Booking Dibuat</p>
                            <p class="text-gray-600 text-sm"><?= date('d M Y H:i', strtotime($booking['tanggal_booking'])) ?></p>
                        </div>
                    </div>

                    <!-- Event 2: Waiting Approval -->
                    <?php if ($booking['status'] === 'Menunggu'): ?>
                    <div class="flex items-start">
                        <div class="flex-shrink-0">
                            <div class="flex items-center justify-center h-8 w-8 rounded-full bg-yellow-500 text-white">
                                <i class="fas fa-hourglass-half text-sm"></i>
                            </div>
                        </div>
                        <div class="ml-4 flex-1">
                            <p class="font-semibold text-gray-900">Menunggu Persetujuan Admin</p>
                            <p class="text-gray-600 text-sm">Admin sedang memproses booking Anda</p>
                        </div>
                    </div>
                    <?php endif; ?>

                    <!-- Event 3: Approved -->
                    <?php if ($booking['status'] === 'Diterima'): ?>
                    <div class="flex items-start">
                        <div class="flex-shrink-0">
                            <div class="flex items-center justify-center h-8 w-8 rounded-full bg-green-500 text-white">
                                <i class="fas fa-check text-sm"></i>
                            </div>
                        </div>
                        <div class="ml-4 flex-1">
                            <p class="font-semibold text-gray-900">Booking Diterima</p>
                            <p class="text-gray-600 text-sm">Booking Anda telah disetujui. Silakan lakukan pembayaran DP.</p>
                        </div>
                    </div>
                    <?php elseif ($booking['status'] === 'Ditolak'): ?>
                    <div class="flex items-start">
                        <div class="flex-shrink-0">
                            <div class="flex items-center justify-center h-8 w-8 rounded-full bg-red-500 text-white">
                                <i class="fas fa-times text-sm"></i>
                            </div>
                        </div>
                        <div class="ml-4 flex-1">
                            <p class="font-semibold text-gray-900">Booking Ditolak</p>
                            <p class="text-gray-600 text-sm">Silakan hubungi admin untuk informasi lebih lanjut</p>
                        </div>
                    </div>
                    <?php elseif ($booking['status'] === 'Selesai'): ?>
                    <div class="flex items-start">
                        <div class="flex-shrink-0">
                            <div class="flex items-center justify-center h-8 w-8 rounded-full bg-blue-500 text-white">
                                <i class="fas fa-check-double text-sm"></i>
                            </div>
                        </div>
                        <div class="ml-4 flex-1">
                            <p class="font-semibold text-gray-900">Booking Selesai</p>
                            <p class="text-gray-600 text-sm">Periode sewa telah berakhir</p>
                        </div>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <!-- Sidebar (1/3) -->
        <div>
            <!-- Informasi Penting -->
            <div class="bg-white rounded-lg shadow-md p-6 mb-6 border-l-4 border-orange-500">
                <h4 class="font-bold text-gray-900 mb-4 flex items-center">
                    <i class="fas fa-lightbulb text-orange-500 mr-2"></i>Informasi Penting
                </h4>
                <div class="space-y-3 text-sm text-gray-700">
                    <?php if ($booking['status'] === 'Menunggu'): ?>
                    <p>
                        <i class="fas fa-check text-green-500 mr-2"></i> Booking Anda telah diterima. Mohon tunggu konfirmasi dari admin.
                    </p>
                    <p>
                        <i class="fas fa-clock text-blue-500 mr-2"></i> Proses verifikasi biasanya membutuhkan waktu 1-2 jam kerja.
                    </p>
                    <?php elseif ($booking['status'] === 'Diterima'): ?>
                    <p class="bg-green-50 border border-green-200 rounded p-3 text-green-800">
                        <i class="fas fa-check-circle text-green-500 mr-2"></i> Booking Anda telah disetujui! Silakan lakukan pembayaran DP segera.
                    </p>
                    <?php elseif ($booking['status'] === 'Ditolak'): ?>
                    <p class="bg-red-50 border border-red-200 rounded p-3 text-red-800">
                        <i class="fas fa-exclamation-circle text-red-500 mr-2"></i> Booking ditolak. Silakan hubungi admin untuk informasi lebih lanjut.
                    </p>
                    <?php elseif ($booking['status'] === 'Selesai'): ?>
                    <p class="bg-blue-50 border border-blue-200 rounded p-3 text-blue-800">
                        <i class="fas fa-check-double text-blue-500 mr-2"></i> Periode sewa telah selesai. Terima kasih telah menggunakan SmartKos!
                    </p>
                    <?php endif; ?>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="bg-white rounded-lg shadow-md p-6 mb-6">
                <h4 class="font-bold text-gray-900 mb-4 flex items-center">
                    <i class="fas fa-tasks text-blue-500 mr-2"></i>Aksi
                </h4>
                <div class="space-y-3">
                    <?php if ($booking['status'] === 'Diterima'): ?>
                    <a href="<?= base_url('penyewa/pembayaran/form-dp/' . $booking['booking_id']) ?>" class="btn btn-primary w-full flex items-center justify-center">
                        <i class="fas fa-wallet mr-2"></i>Bayar DP Sekarang
                    </a>
                    <?php elseif ($booking['status'] === 'Menunggu'): ?>
                    <form action="<?= base_url('penyewa/booking/' . $booking['booking_id'] . '/batal') ?>" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin membatalkan booking ini?')">
                        <?= csrf_field() ?>
                        <button type="submit" class="btn btn-danger w-full flex items-center justify-center">
                            <i class="fas fa-times mr-2"></i>Batal Booking
                        </button>
                    </form>
                    <?php elseif ($booking['status'] === 'Selesai'): ?>
                    <a href="<?= base_url('penyewa/pembayaran/form-bulanan/' . $booking['booking_id']) ?>" class="btn btn-primary w-full flex items-center justify-center">
                        <i class="fas fa-credit-card mr-2"></i>Bayar Cicilan
                    </a>
                    <?php endif; ?>
                </div>
            </div>

            <!-- Perlu Bantuan? -->
            <div class="bg-blue-50 rounded-lg shadow-md p-6 border border-blue-200">
                <h4 class="font-bold text-gray-900 mb-3 flex items-center">
                    <i class="fas fa-question-circle text-blue-500 mr-2"></i>Perlu Bantuan?
                </h4>
                <p class="text-gray-700 text-sm mb-4"> Jika ada pertanyaan tentang booking Anda, hubungi admin melalui kontak berikut: </p>
                <div class="space-y-2 text-sm">
                    <p class="flex items-center text-gray-700">
                        <i class="fas fa-phone text-green-500 mr-3 w-5"></i>
                        <span>(+62) 812-3456-7890</span>
                    </p>
                    <p class="flex items-center text-gray-700">
                        <i class="fas fa-envelope text-red-500 mr-3 w-5"></i>
                        <span>admin@smartkos.local</span>
                    </p>
                    <p class="flex items-center text-gray-700">
                        <i class="fas fa-clock text-blue-500 mr-3 w-5"></i>
                        <span>08:00 - 17:00 WIB</span>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>
