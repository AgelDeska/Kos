<?= $this->extend('layout/penyewa_template') ?>

<?= $this->section('content') ?>

<!-- Header -->
<div class="mb-6">
    <h2 class="text-3xl font-bold text-gray-900 mb-2">
        <i class="fas fa-wallet text-green-600 mr-2"></i>Pembayaran DP Awal
    </h2>
    <p class="text-gray-600">Upload bukti transfer sebagai konfirmasi pembayaran</p>
</div>

<?php if (session()->getFlashdata('error')): ?>
    <div class="mb-6 p-4 bg-red-100 border border-red-400 text-red-700 rounded-lg flex items-start">
        <i class="fas fa-exclamation-circle mt-1 mr-3 flex-shrink-0"></i>
        <div>
            <p class="font-semibold">Error</p>
            <p><?= session()->getFlashdata('error') ?></p>
        </div>
    </div>
<?php endif; ?>

<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
    <!-- Form -->
    <div class="lg:col-span-2">
        <div class="card p-6 rounded-xl shadow-md">
            <form action="<?= base_url('penyewa/pembayaran/upload') ?>" method="POST" enctype="multipart/form-data" class="space-y-6">
                <?= csrf_field() ?>
                <input type="hidden" name="booking_id" value="<?= esc($booking['booking_id']) ?>">

                <!-- Informasi Booking -->
                <div class="bg-blue-50 border border-blue-200 rounded-lg p-4">
                    <h4 class="font-semibold text-gray-900 mb-4 flex items-center">
                        <i class="fas fa-info-circle text-blue-600 mr-2"></i>Informasi Booking
                    </h4>
                    <div class="grid grid-cols-2 gap-4 text-sm">
                        <div>
                            <p class="text-gray-600">Kamar</p>
                            <p class="font-semibold text-gray-900">No. <?= esc($kamar['nomor_kamar'] ?? '-') ?></p>
                        </div>
                        <div>
                            <p class="text-gray-600">Tipe</p>
                            <p class="font-semibold text-gray-900"><?= esc($kamar['tipe_kamar'] ?? '-') ?></p>
                        </div>
                        <div>
                            <p class="text-gray-600">Harga/Bulan</p>
                            <p class="font-semibold text-gray-900">Rp <?= number_format($kamar['harga_per_bulan'] ?? 0, 0, ',', '.') ?></p>
                        </div>
                        <div>
                            <p class="text-gray-600">Durasi</p>
                            <p class="font-semibold text-gray-900"><?= esc($booking['durasi_sewa_bulan']) ?> Bulan</p>
                        </div>
                        <div>
                            <p class="text-gray-600">Total Biaya</p>
                            <p class="font-semibold text-gray-900">Rp <?= number_format($booking['total_biaya'] ?? 0, 0, ',', '.') ?></p>
                        </div>
                        <div>
                            <p class="text-gray-600">DP 50%</p>
                            <p class="font-semibold text-green-600">Rp <?= number_format($booking['dp_amount'] ?? 0, 0, ',', '.') ?></p>
                        </div>
                    </div>
                </div>

                <!-- Jenis Pembayaran -->
                <div>
                    <label class="block text-sm font-semibold text-gray-900 mb-3">
                        <i class="fas fa-question-circle text-blue-600 mr-2"></i>Jenis Pembayaran
                    </label>
                    <div class="space-y-2">
                        <label class="flex items-center p-4 border border-gray-200 rounded-lg cursor-pointer hover:bg-gray-50 transition">
                            <input type="radio" name="jenis_pembayaran" value="DP/Awal" checked class="w-4 h-4 text-blue-600">
                            <span class="ml-3 flex-1">
                                <span class="block font-semibold text-gray-900">DP Awal (Uang Muka)</span>
                                <span class="text-sm text-gray-600">Pembayaran pertama untuk mengamankan booking</span>
                            </span>
                        </label>
                    </div>
                </div>

                <!-- Jumlah Pembayaran -->
                <div>
                    <label for="jumlah" class="block text-sm font-semibold text-gray-900 mb-3">
                        <i class="fas fa-money-bill-wave text-green-600 mr-2"></i>Jumlah Pembayaran (Rp)
                    </label>
                    <input
                        type="number"
                        id="jumlah"
                        name="jumlah"
                        value="<?= esc($booking['dp_amount'] ?? 0) ?>"
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg bg-gray-50"
                        readonly
                        required
                        min="0"
                        step="1000"
                    >
                    <p class="text-xs text-green-600 mt-2 font-medium">
                        <i class="fas fa-info-circle mr-1"></i>
                        Jumlah DP sudah ditentukan berdasarkan kalkulasi booking (50% dari total biaya).
                    </p>
                </div>

                <!-- Metode Pembayaran -->
                <div>
                    <label for="metode" class="block text-sm font-semibold text-gray-900 mb-3">
                        <i class="fas fa-exchange-alt text-purple-600 mr-2"></i>Metode Pembayaran
                    </label>
                    <select id="metode" name="metode" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent" required>
                        <option value="">-- Pilih Metode --</option>
                        <option value="Transfer Bank">Transfer Bank (BCA/Mandiri/BNI)</option>
                        <option value="E-Wallet">E-Wallet (GCash/Dana/OVO/GoPay)</option>
                        <option value="Cash">Cash (Pembayaran Langsung)</option>
                    </select>
                </div>

                <!-- Upload Bukti -->
                <div>
                    <label for="bukti_transfer" class="block text-sm font-semibold text-gray-900 mb-3">
                        <i class="fas fa-upload text-orange-600 mr-2"></i>Upload Bukti Pembayaran
                    </label>
                    <div class="border-2 border-dashed border-gray-300 rounded-lg p-8 text-center hover:border-blue-500 hover:bg-blue-50 transition cursor-pointer" onclick="document.getElementById('bukti_transfer').click()">
                        <input type="file" id="bukti_transfer" name="bukti_transfer" class="hidden" accept=".jpg,.jpeg,.png,.pdf" required onchange="previewImage(event)">
                        <i class="fas fa-cloud-upload-alt text-4xl text-gray-400 mb-3"></i>
                        <p class="text-gray-900 font-semibold mb-1">Klik atau drag file di sini</p>
                        <p class="text-sm text-gray-600">Format: JPG, PNG, atau PDF (Maksimal 5MB)</p>
                    </div>
                    <div id="imagePreview" class="mt-4 hidden">
                        <img id="previewImg" src="" alt="Preview Bukti" class="max-w-full h-auto rounded-lg shadow-md">
                    </div>
                    <p id="fileName" class="text-sm text-gray-600 mt-3"></p>
                </div>

                <!-- Catatan Penting -->
                <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-4">
                    <h4 class="font-semibold text-gray-900 mb-2 flex items-center">
                        <i class="fas fa-warning text-yellow-600 mr-2"></i>Catatan Penting
                    </h4>
                    <ul class="text-sm text-gray-700 space-y-1 ml-5 list-disc">
                        <li>Pastikan bukti transfer jelas dan lengkap</li>
                        <li>Harus menunjukkan nama penerima (Pemilik Kos)</li>
                        <li>Nominal harus sesuai dengan jumlah yang Anda input</li>
                        <li>Admin akan verifikasi dalam 24 jam</li>
                    </ul>
                </div>

                <!-- Buttons -->
                <div class="flex gap-3 pt-4 border-t border-gray-200">
                    <a href="<?= base_url('penyewa/riwayat-booking') ?>" class="btn-secondary flex-1 flex items-center justify-center">
                        <i class="fas fa-arrow-left mr-2"></i>Kembali
                    </a>
                    <button type="submit" class="btn-primary flex-1 flex items-center justify-center">
                        <i class="fas fa-check-circle mr-2"></i>Kirim Bukti Pembayaran
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Info Sidebar -->
    <div class="lg:col-span-1">
        <!-- Rekening Tujuan -->
        <div class="card p-6 rounded-xl shadow-md mb-6">
            <h3 class="text-lg font-bold text-gray-900 mb-4 flex items-center">
                <i class="fas fa-bank text-blue-600 mr-2"></i>Rekening Tujuan
            </h3>
            
            <div class="space-y-4">
                <div class="p-4 bg-blue-50 rounded-lg">
                    <p class="text-xs text-gray-600 font-semibold uppercase mb-2">Bank BCA</p>
                    <p class="font-mono text-lg font-bold text-gray-900 mb-2">1234 5678 9012</p>
                    <p class="text-sm font-semibold text-gray-900">Pemilik Kos</p>
                    <p class="text-xs text-gray-600">atas nama Pemilik Kos</p>
                </div>

                <div class="p-4 bg-green-50 rounded-lg">
                    <p class="text-xs text-gray-600 font-semibold uppercase mb-2">E-Wallet / QRIS</p>
                    <p class="font-mono text-sm font-bold text-gray-900 mb-2">+62 812 3456 7890</p>
                    <p class="text-sm font-semibold text-gray-900">GCash / Dana</p>
                    <p class="text-xs text-gray-600">atas nama Pemilik Kos</p>
                </div>
            </div>

            <p class="text-xs text-gray-500 mt-4 p-3 bg-gray-50 rounded text-center">
                <i class="fas fa-info-circle mr-1"></i>
                Hubungi admin jika ada perubahan rekening tujuan
            </p>
        </div>

        <!-- Panduan -->
        <div class="card p-6 rounded-xl shadow-md">
            <h3 class="text-lg font-bold text-gray-900 mb-4 flex items-center">
                <i class="fas fa-book text-purple-600 mr-2"></i>Panduan
            </h3>
            
            <ol class="text-sm text-gray-700 space-y-3 ml-5 list-decimal">
                <li>Transfer ke rekening yang tersedia</li>
                <li>Screenshot bukti transfer</li>
                <li>Upload bukti di form ini</li>
                <li>Tunggu verifikasi admin</li>
                <li>Setelah verifikasi, Anda bisa mulai menghuni</li>
            </ol>

            <div class="mt-4 p-3 bg-green-50 border border-green-200 rounded-lg text-sm text-green-900">
                <p class="font-semibold mb-1">
                    <i class="fas fa-check-circle text-green-600 mr-2"></i>Verifikasi Cepat
                </p>
                <p>Biasanya verifikasi hanya membutuhkan waktu 1-2 jam.</p>
            </div>
        </div>
    </div>
</div>

<script>
    // Preview nama file yang dipilih
    document.getElementById('bukti_transfer').addEventListener('change', function(e) {
        const fileName = e.target.files[0]?.name || '';
        document.getElementById('fileName').textContent = fileName ? `✓ File dipilih: ${fileName}` : '';
    });

    // Preview gambar
    function previewImage(event) {
        const file = event.target.files[0];
        const preview = document.getElementById('imagePreview');
        const previewImg = document.getElementById('previewImg');
        
        if (file && file.type.startsWith('image/')) {
            const reader = new FileReader();
            reader.onload = function(e) {
                previewImg.src = e.target.result;
                preview.classList.remove('hidden');
            };
            reader.readAsDataURL(file);
        } else {
            preview.classList.add('hidden');
        }
    }
</script>

<?= $this->endSection() ?>
