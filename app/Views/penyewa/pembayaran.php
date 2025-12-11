<?= $this->extend('layout/penyewa_template') ?>

<?= $this->section('content') ?>

<!-- Header -->
<div class="mb-6">
    <h2 class="text-3xl font-bold text-gray-900 mb-2">
        <i class="fas fa-credit-card text-green-600 mr-2"></i>Pembayaran Saya
    </h2>
    <p class="text-gray-600">Kelola dan upload bukti pembayaran untuk booking Anda</p>
</div>

<!-- Summary Cards -->
<div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
    <!-- Total Hutang -->
    <div class="card p-6 rounded-xl shadow-md">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-gray-600 text-sm font-medium mb-1">Total Hutang</p>
                <p class="text-3xl font-bold text-gray-900">Rp 0</p>
                <p class="text-gray-500 text-xs mt-2">Belum ada booking aktif</p>
            </div>
            <i class="fas fa-wallet text-4xl text-red-300"></i>
        </div>
    </div>

    <!-- Sudah Dibayar -->
    <div class="card p-6 rounded-xl shadow-md">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-gray-600 text-sm font-medium mb-1">Sudah Dibayar</p>
                <p class="text-3xl font-bold text-gray-900">Rp 0</p>
                <p class="text-gray-500 text-xs mt-2">Sudah diverifikasi</p>
            </div>
            <i class="fas fa-check-circle text-4xl text-green-300"></i>
        </div>
    </div>

    <!-- Sisa Hutang -->
    <div class="card p-6 rounded-xl shadow-md">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-gray-600 text-sm font-medium mb-1">Sisa Hutang</p>
                <p class="text-3xl font-bold text-gray-900">Rp 0</p>
                <p class="text-gray-500 text-xs mt-2">Belum ada transaksi</p>
            </div>
            <i class="fas fa-calculator text-4xl text-yellow-300"></i>
        </div>
    </div>
</div>

<!-- Filter & Search -->
<div class="card p-6 mb-6 rounded-xl shadow-md">
    <div class="flex flex-col md:flex-row gap-4 items-center">
        <input type="text" placeholder="Cari berdasarkan ID pembayaran atau booking..." 
               class="flex-1 px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
        <select class="px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
            <option value="">Semua Status</option>
            <option value="pending">Pending</option>
            <option value="verified">Terverifikasi</option>
            <option value="rejected">Ditolak</option>
        </select>
    </div>
</div>

<!-- Pembayaran List -->
<div class="card rounded-xl shadow-md overflow-hidden">
    <div class="p-6 border-b border-gray-200 bg-gray-50">
        <h3 class="text-lg font-bold text-gray-900 flex items-center">
            <i class="fas fa-list text-blue-600 mr-2"></i>Riwayat Pembayaran
        </h3>
    </div>

    <div class="overflow-x-auto">
        <table class="min-w-full">
            <thead class="bg-gray-50 border-b border-gray-200">
                <tr>
                    <th class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase">ID Pembayaran</th>
                    <th class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase">Booking</th>
                    <th class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase">Tipe Bayar</th>
                    <th class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase">Jumlah</th>
                    <th class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase">Tgl Upload</th>
                    <th class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase">Status</th>
                    <th class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                <?php if (empty($pembayaran)): ?>
                    <tr>
                        <td colspan="7" class="px-6 py-12 text-center">
                            <div class="flex flex-col items-center justify-center">
                                <i class="fas fa-inbox text-5xl text-gray-300 mb-4"></i>
                                <p class="text-gray-500 font-medium text-lg">Belum ada pembayaran</p>
                                <p class="text-gray-400 text-sm">Pembayaran Anda akan muncul di sini setelah booking diterima</p>
                            </div>
                        </td>
                    </tr>
                <?php else: ?>
                    <?php foreach ($pembayaran as $p): ?>
                        <tr class="hover:bg-gray-50 transition">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="font-semibold text-gray-900">#<?= esc($p['pembayaran_id'] ?? $p['id'] ?? '-') ?></span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="text-gray-600">B#<?= esc($p['booking_id'] ?? '-') ?></span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="text-gray-600"><?= esc($p['jenis_pembayaran'] ?? '-') ?></span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="font-semibold text-gray-900">Rp <?= number_format($p['jumlah'] ?? 0, 0, ',', '.') ?></span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-gray-600">
                                <?= isset($p['tanggal_bayar']) ? date('d/m/Y', strtotime($p['tanggal_bayar'])) : '-' ?>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <?php 
                                    $status = $p['status'] ?? 'Menunggu Verifikasi';
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
                                <span class="badge <?= $statusClasses[$status] ?? 'badge-info' ?>">
                                    <i class="fas <?= $statusIcons[$status] ?? 'fa-info-circle' ?> mr-1"></i><?= $status ?>
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <a href="<?= base_url('penyewa/pembayaran/' . ($p['pembayaran_id'] ?? $p['id']) . '/detail') ?>" class="text-blue-600 hover:text-blue-700 font-medium text-sm flex items-center">
                                    <i class="fas fa-eye mr-1"></i>Detail
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

    <div class="px-6 py-4 bg-gray-50 border-t border-gray-200">
        <p class="text-sm text-gray-600 flex items-center">
            <i class="fas fa-info-circle text-blue-500 mr-2"></i>
            Upload bukti transfer ke rekening yang sudah ditentukan oleh pemilik kos.
        </p>
    </div>
</div>

<!-- Metode Pembayaran -->
<div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-8">
    <div class="card p-6 rounded-xl shadow-md">
        <h3 class="text-lg font-bold text-gray-900 mb-4 flex items-center">
            <i class="fas fa-bank text-blue-600 mr-2"></i>Transfer Bank
        </h3>
        <div class="space-y-3 text-sm text-gray-600">
            <p><strong>Bank:</strong> BCA / Mandiri / BNI</p>
            <p><strong>Nomor Rekening:</strong> Hubungi admin untuk detail</p>
            <p><strong>Atas Nama:</strong> Pemilik Kos</p>
            <p class="text-xs text-gray-500 bg-blue-50 p-3 rounded mt-3">
                <i class="fas fa-lightbulb mr-2"></i>Simpan bukti transfer Anda dan upload di sini untuk verifikasi.
            </p>
        </div>
    </div>

    <div class="card p-6 rounded-xl shadow-md">
        <h3 class="text-lg font-bold text-gray-900 mb-4 flex items-center">
            <i class="fas fa-mobile-alt text-green-600 mr-2"></i>E-Wallet / QRIS
        </h3>
        <div class="space-y-3 text-sm text-gray-600">
            <p><strong>Tersedia:</strong> GCash, Dana, OVO, GoPay</p>
            <p><strong>Nomor:</strong> Hubungi admin untuk detail</p>
            <p><strong>Nominal:</strong> Sesuai tagihan bulanan</p>
            <p class="text-xs text-gray-500 bg-green-50 p-3 rounded mt-3">
                <i class="fas fa-lightbulb mr-2"></i>Screenshot notifikasi pembayaran dan upload untuk konfirmasi.
            </p>
        </div>
    </div>
</div>

<?= $this->endSection() ?>
