<?= $this->extend('penyewa_template') ?>

<?= $this->section('content') ?>

<div class="py-6">
    <!-- Header dengan Breadcrumb -->
    <div class="mb-6">
        <div class="flex items-center justify-between mb-4">
            <div>
                <h1 class="text-3xl font-bold text-gray-900">Detail Pembayaran</h1>
                <p class="text-gray-600 text-sm mt-1">Pembayaran ID: #<?= esc($pembayaran['pembayaran_id']) ?></p>
            </div>
            <a href="<?= base_url('/penyewa/pembayaran') ?>" class="btn btn-secondary flex items-center">
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
                        <h3 class="text-lg font-semibold text-gray-900 mb-1">Status Pembayaran</h3>
                        <p class="text-gray-600 text-sm">Tanggal Upload: <?= date('d M Y H:i', strtotime($pembayaran['tanggal_bayar'])) ?></p>
                    </div>
                    <div>
                        <?php 
                            $status = $pembayaran['status'];
                            $statusClasses = [
                                'Menunggu Verifikasi' => 'badge-warning',
                                'Lunas' => 'badge-success',
                                'Ditolak' => 'badge-danger',
                            ];
                            $statusIcons = [
                                'Menunggu Verifikasi' => 'fa-hourglass-half',
                                'Lunas' => 'fa-check-circle',
                                'Ditolak' => 'fa-times-circle',
                            ];
                        ?>
                        <span class="badge <?= $statusClasses[$status] ?? 'badge-info' ?> text-lg px-4 py-2">
                            <i class="fas <?= $statusIcons[$status] ?? 'fa-info-circle' ?> mr-2"></i><?= $status ?>
                        </span>
                    </div>
                </div>
            </div>

            <!-- Informasi Pembayaran -->
            <div class="bg-white rounded-lg shadow-md p-6 mb-6">
                <h3 class="text-lg font-bold text-gray-900 mb-4 pb-3 border-b-2 border-gray-200">
                    <i class="fas fa-receipt text-blue-500 mr-2"></i>Detail Pembayaran
                </h3>
                
                <div class="grid grid-cols-2 gap-4">
                    <div class="bg-gray-50 p-4 rounded-lg">
                        <p class="text-gray-600 text-sm font-medium">Jenis Pembayaran</p>
                        <p class="text-gray-900 font-bold text-lg mt-1"><?= esc($pembayaran['jenis_pembayaran']) ?></p>
                    </div>
                    <div class="bg-gray-50 p-4 rounded-lg">
                        <p class="text-gray-600 text-sm font-medium">Metode Pembayaran</p>
                        <p class="text-gray-900 font-bold text-lg mt-1">
                            <i class="fas fa-credit-card text-green-500 mr-2"></i><?= esc($pembayaran['metode']) ?>
                        </p>
                    </div>
                    <div class="bg-blue-50 p-4 rounded-lg border border-blue-200">
                        <p class="text-gray-600 text-sm font-medium">Jumlah Pembayaran</p>
                        <p class="text-blue-900 font-bold text-xl mt-1">Rp <?= number_format($pembayaran['jumlah'], 0, ',', '.') ?></p>
                    </div>
                    <div class="bg-gray-50 p-4 rounded-lg">
                        <p class="text-gray-600 text-sm font-medium">Nomor Booking</p>
                        <p class="text-gray-900 font-bold text-lg mt-1">#<?= esc($pembayaran['booking_id']) ?></p>
                    </div>
                </div>
            </div>

            <!-- Informasi Kamar -->
            <?php if ($booking): ?>
            <div class="bg-white rounded-lg shadow-md p-6 mb-6">
                <h3 class="text-lg font-bold text-gray-900 mb-4 pb-3 border-b-2 border-gray-200">
                    <i class="fas fa-door-open text-purple-500 mr-2"></i>Informasi Kamar
                </h3>
                
                <div class="grid grid-cols-2 gap-4">
                    <div class="bg-gray-50 p-4 rounded-lg">
                        <p class="text-gray-600 text-sm font-medium">Nomor Kamar</p>
                        <p class="text-gray-900 font-bold text-lg mt-1"><?= esc($booking['nomor_kamar']) ?></p>
                    </div>
                    <div class="bg-gray-50 p-4 rounded-lg">
                        <p class="text-gray-600 text-sm font-medium">Tipe Kamar</p>
                        <p class="text-gray-900 font-bold text-lg mt-1"><?= esc($booking['tipe']) ?></p>
                    </div>
                    <div class="bg-green-50 p-4 rounded-lg border border-green-200">
                        <p class="text-gray-600 text-sm font-medium">Harga per Bulan</p>
                        <p class="text-green-900 font-bold text-lg mt-1">Rp <?= number_format($booking['harga'], 0, ',', '.') ?></p>
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

            <!-- Bukti Transfer -->
            <div class="bg-white rounded-lg shadow-md p-6 mb-6">
                <h3 class="text-lg font-bold text-gray-900 mb-4 pb-3 border-b-2 border-gray-200">
                    <i class="fas fa-image text-orange-500 mr-2"></i>Bukti Transfer
                </h3>

                <?php if (!empty($pembayaran['bukti_transfer'])): ?>
                    <div class="bg-gray-100 rounded-lg p-4 flex justify-center items-center min-h-[400px]">
                        <?php 
                            $file = $pembayaran['bukti_transfer'];
                            $ext = strtolower(pathinfo($file, PATHINFO_EXTENSION));
                        ?>
                        
                        <?php if (in_array($ext, ['jpg', 'jpeg', 'png'])): ?>
                            <img src="<?= base_url('uploads/bukti_pembayaran/' . esc($file)) ?>" alt="Bukti Transfer" class="max-h-[400px] rounded-lg shadow-lg">
                        <?php elseif ($ext === 'pdf'): ?>
                            <div class="text-center">
                                <i class="fas fa-file-pdf text-red-500" style="font-size: 80px;"></i>
                                <p class="text-gray-600 font-medium mt-4">File PDF</p>
                                <a href="<?= base_url('uploads/bukti_pembayaran/' . esc($file)) ?>" target="_blank" class="btn btn-primary mt-4">
                                    <i class="fas fa-download mr-2"></i>Download File
                                </a>
                            </div>
                        <?php else: ?>
                            <p class="text-gray-600">Format file tidak didukung untuk ditampilkan di sini</p>
                        <?php endif; ?>
                    </div>
                    <p class="text-gray-600 text-xs mt-3 text-center">
                        <i class="fas fa-info-circle mr-1"></i>Nama File: <?= esc($file) ?>
                    </p>
                <?php else: ?>
                    <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-6 text-center">
                        <i class="fas fa-exclamation-triangle text-yellow-500" style="font-size: 40px;"></i>
                        <p class="text-yellow-700 font-medium mt-3">Bukti transfer tidak tersedia</p>
                    </div>
                <?php endif; ?>
            </div>

            <!-- Timeline Status -->
            <div class="bg-white rounded-lg shadow-md p-6">
                <h3 class="text-lg font-bold text-gray-900 mb-4 pb-3 border-b-2 border-gray-200">
                    <i class="fas fa-history text-indigo-500 mr-2"></i>Riwayat Status
                </h3>

                <div class="space-y-4">
                    <!-- Event 1: Uploaded -->
                    <div class="flex items-start">
                        <div class="flex-shrink-0">
                            <div class="flex items-center justify-center h-8 w-8 rounded-full bg-blue-500 text-white">
                                <i class="fas fa-upload text-sm"></i>
                            </div>
                        </div>
                        <div class="ml-4 flex-1">
                            <p class="font-semibold text-gray-900">Bukti Pembayaran Diupload</p>
                            <p class="text-gray-600 text-sm"><?= date('d M Y H:i', strtotime($pembayaran['tanggal_bayar'])) ?></p>
                        </div>
                    </div>

                    <!-- Event 2: Waiting Verification -->
                    <?php if ($pembayaran['status'] === 'Menunggu Verifikasi'): ?>
                        <div class="flex items-start">
                            <div class="flex-shrink-0">
                                <div class="flex items-center justify-center h-8 w-8 rounded-full bg-yellow-500 text-white">
                                    <i class="fas fa-hourglass-half text-sm"></i>
                                </div>
                            </div>
                            <div class="ml-4 flex-1">
                                <p class="font-semibold text-gray-900">Menunggu Verifikasi Admin</p>
                                <p class="text-gray-600 text-sm">Admin sedang memeriksa bukti pembayaran Anda</p>
                            </div>
                        </div>
                    <?php endif; ?>

                    <!-- Event 3: Approved or Rejected -->
                    <?php if ($pembayaran['status'] === 'Lunas'): ?>
                        <div class="flex items-start">
                            <div class="flex-shrink-0">
                                <div class="flex items-center justify-center h-8 w-8 rounded-full bg-green-500 text-white">
                                    <i class="fas fa-check text-sm"></i>
                                </div>
                            </div>
                            <div class="ml-4 flex-1">
                                <p class="font-semibold text-gray-900">Pembayaran Diverifikasi</p>
                                <p class="text-gray-600 text-sm">Pembayaran Anda telah diterima dan diverifikasi</p>
                            </div>
                        </div>
                    <?php elseif ($pembayaran['status'] === 'Ditolak'): ?>
                        <div class="flex items-start">
                            <div class="flex-shrink-0">
                                <div class="flex items-center justify-center h-8 w-8 rounded-full bg-red-500 text-white">
                                    <i class="fas fa-times text-sm"></i>
                                </div>
                            </div>
                            <div class="ml-4 flex-1">
                                <p class="font-semibold text-gray-900">Pembayaran Ditolak</p>
                                <p class="text-gray-600 text-sm">Silakan hubungi admin untuk informasi lebih lanjut</p>
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
                    <?php if ($pembayaran['status'] === 'Menunggu Verifikasi'): ?>
                        <p>
                            <i class="fas fa-check text-green-500 mr-2"></i>
                            Bukti pembayaran Anda telah diterima. Mohon tunggu konfirmasi dari admin.
                        </p>
                        <p>
                            <i class="fas fa-clock text-blue-500 mr-2"></i>
                            Verifikasi biasanya membutuhkan waktu 1-2 jam kerja.
                        </p>
                    <?php elseif ($pembayaran['status'] === 'Lunas'): ?>
                        <p class="bg-green-50 border border-green-200 rounded p-3 text-green-800">
                            <i class="fas fa-check-circle text-green-500 mr-2"></i>
                            Pembayaran Anda telah diverifikasi. Terima kasih!
                        </p>
                    <?php elseif ($pembayaran['status'] === 'Ditolak'): ?>
                        <p class="bg-red-50 border border-red-200 rounded p-3 text-red-800">
                            <i class="fas fa-exclamation-circle text-red-500 mr-2"></i>
                            Pembayaran ditolak. Silakan hubungi admin untuk informasi lebih lanjut.
                        </p>
                    <?php endif; ?>
                </div>
            </div>

            <!-- Perlu Bantuan? -->
            <div class="bg-blue-50 rounded-lg shadow-md p-6 border border-blue-200">
                <h4 class="font-bold text-gray-900 mb-3 flex items-center">
                    <i class="fas fa-question-circle text-blue-500 mr-2"></i>Perlu Bantuan?
                </h4>
                <p class="text-gray-700 text-sm mb-4">
                    Jika ada pertanyaan tentang pembayaran Anda, hubungi admin melalui kontak berikut:
                </p>
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