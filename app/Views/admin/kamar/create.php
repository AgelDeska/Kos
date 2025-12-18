<?= $this->extend('layout/admin_template') ?>

<?php helper('form'); ?>

<?= $this->section('content') ?>

<!-- Header -->
<div class="mb-8">
    <h2 class="text-3xl font-bold text-gray-900 flex items-center">
        <i class="fas fa-plus-circle text-green-600 mr-3"></i>Tambah Kamar Baru
    </h2>
    <p class="text-gray-600 mt-1">Isi form di bawah untuk menambahkan kamar baru ke sistem</p>
</div>

<!-- Form Card -->
<div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
    <!-- Main Form -->
    <div class="lg:col-span-2">
        <div class="card bg-white rounded-xl shadow-lg border border-gray-100 overflow-hidden">
            <div class="p-6 border-b border-gray-200">
                <h3 class="text-lg font-bold text-gray-900">Informasi Kamar</h3>
            </div>

            <div class="p-6">
                <?= form_open_multipart('admin/kamar/store', ['class' => 'space-y-6']) ?>
                <?= csrf_field() ?>

                    <!-- Row 1: Nomor & Tipe -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label for="nomor_kamar" class="block text-sm font-semibold text-gray-700 mb-2">
                                <i class="fas fa-door-open text-blue-600 mr-2"></i>Nomor Kamar
                            </label>
                            <input type="text" id="nomor_kamar" name="nomor_kamar" value="<?= old('nomor_kamar') ?>" placeholder="Contoh: A-101" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-600 focus:border-transparent transition <?= $validation->hasError('nomor_kamar') ? 'border-red-500 ring-red-500 ring-2' : '' ?>" required>
                            <?php if ($validation->hasError('nomor_kamar')): ?>
                                <p class="text-red-600 text-sm mt-1 flex items-center"><i class="fas fa-alert-circle mr-1"></i><?= $validation->getError('nomor_kamar') ?></p>
                            <?php endif; ?>
                        </div>

                        <div>
                            <label for="tipe_kamar" class="block text-sm font-semibold text-gray-700 mb-2">
                                <i class="fas fa-tag text-purple-600 mr-2"></i>Tipe Kamar
                            </label>
                            <input type="text" id="tipe_kamar" name="tipe_kamar" value="<?= old('tipe_kamar') ?>" placeholder="Contoh: Single, Double, Premium" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-600 focus:border-transparent transition <?= $validation->hasError('tipe_kamar') ? 'border-red-500 ring-red-500 ring-2' : '' ?>" required>
                            <?php if ($validation->hasError('tipe_kamar')): ?>
                                <p class="text-red-600 text-sm mt-1 flex items-center"><i class="fas fa-alert-circle mr-1"></i><?= $validation->getError('tipe_kamar') ?></p>
                            <?php endif; ?>
                        </div>
                    </div>

                    <!-- Row 2: Kapasitas, Harga, Status -->
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <div>
                            <label for="kapasitas" class="block text-sm font-semibold text-gray-700 mb-2">
                                <i class="fas fa-users text-green-600 mr-2"></i>Kapasitas (Orang)
                            </label>
                            <input type="number" id="kapasitas" name="kapasitas" value="<?= old('kapasitas') ?>" min="1" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-600 focus:border-transparent transition <?= $validation->hasError('kapasitas') ? 'border-red-500 ring-red-500 ring-2' : '' ?>" required>
                            <?php if ($validation->hasError('kapasitas')): ?>
                                <p class="text-red-600 text-sm mt-1 flex items-center"><i class="fas fa-alert-circle mr-1"></i><?= $validation->getError('kapasitas') ?></p>
                            <?php endif; ?>
                        </div>

                        <div>
                            <label for="harga" class="block text-sm font-semibold text-gray-700 mb-2">
                                <i class="fas fa-money-bill-wave text-orange-600 mr-2"></i>Harga/Bulan (Rp)
                            </label>
                            <input type="number" id="harga" name="harga" value="<?= old('harga') ?>" min="100000" placeholder="Contoh: 500000" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-600 focus:border-transparent transition <?= $validation->hasError('harga') ? 'border-red-500 ring-red-500 ring-2' : '' ?>" required>
                            <?php if ($validation->hasError('harga')): ?>
                                <p class="text-red-600 text-sm mt-1 flex items-center"><i class="fas fa-alert-circle mr-1"></i><?= $validation->getError('harga') ?></p>
                            <?php endif; ?>
                        </div>

                        <div>
                            <label for="status" class="block text-sm font-semibold text-gray-700 mb-2">
                                <i class="fas fa-circle-notch text-blue-600 mr-2"></i>Status
                            </label>
                            <select id="status" name="status" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-600 focus:border-transparent transition <?= $validation->hasError('status') ? 'border-red-500 ring-red-500 ring-2' : '' ?>" required>
                                <option value="Tersedia" <?= old('status') == 'Tersedia' ? 'selected' : '' ?>>Tersedia</option>
                                <option value="Terisi" <?= old('status') == 'Terisi' ? 'selected' : '' ?>>Terisi</option>
                                <option value="Di Booking" <?= old('status') == 'Di Booking' ? 'selected' : '' ?>>Di Booking</option>
                            </select>
                            <?php if ($validation->hasError('status')): ?>
                                <p class="text-red-600 text-sm mt-1 flex items-center"><i class="fas fa-alert-circle mr-1"></i><?= $validation->getError('status') ?></p>
                            <?php endif; ?>
                        </div>
                    </div>

                    <!-- Description -->
                    <div>
                        <label for="deskripsi" class="block text-sm font-semibold text-gray-700 mb-2">
                            <i class="fas fa-align-left text-indigo-600 mr-2"></i>Deskripsi Kamar
                        </label>
                        <textarea id="deskripsi" name="deskripsi" rows="4" placeholder="Jelaskan detail kamar, fasilitas, dan keterangan penting lainnya..." class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-600 focus:border-transparent transition <?= $validation->hasError('deskripsi') ? 'border-red-500 ring-red-500 ring-2' : '' ?>"><?= old('deskripsi') ?></textarea>
                        <?php if ($validation->hasError('deskripsi')): ?>
                            <p class="text-red-600 text-sm mt-1 flex items-center"><i class="fas fa-alert-circle mr-1"></i><?= $validation->getError('deskripsi') ?></p>
                        <?php endif; ?>
                    </div>

                    <!-- Fasilitas & Fitur -->
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-3">
                            <i class="fas fa-concierge-bell text-amber-600 mr-2"></i>Fasilitas & Fitur
                        </label>
                        <div class="grid grid-cols-2 md:grid-cols-3 gap-3">
                            <?php
                            $fasilitas_options = [
                                'WiFi Gratis' => 'fas fa-wifi',
                                'AC & Kipas' => 'fas fa-fan',
                                'Kamar Mandi Dalam' => 'fas fa-shower',
                                'Kasur Premium' => 'fas fa-bed',
                                'Lemari Pakaian' => 'fas fa-archive',
                                'Meja Kerja' => 'fas fa-desktop',
                                'TV' => 'fas fa-tv',
                                'Kulkas' => 'fas fa-refrigerator',
                                'Dapur Kecil' => 'fas fa-utensils',
                                'Parkir Motor' => 'fas fa-motorcycle',
                                'Parkir Mobil' => 'fas fa-car',
                                'Laundry' => 'fas fa-tshirt',
                                'Keamanan 24 Jam' => 'fas fa-shield-alt',
                                'CCTV' => 'fas fa-video',
                                'Lift' => 'fas fa-elevator',
                                'Gym' => 'fas fa-dumbbell',
                                'Kolam Renang' => 'fas fa-swimming-pool',
                                'Restoran' => 'fas fa-utensils',
                                'Masjid' => 'fas fa-mosque',
                                'Supermarket' => 'fas fa-shopping-cart'
                            ];
                            $selected_fasilitas = old('fasilitas_fitur', []);
                            if (!is_array($selected_fasilitas)) {
                                $selected_fasilitas = [];
                            }
                            ?>
                            <?php foreach ($fasilitas_options as $fasilitas => $icon): ?>
                                <label class="flex items-center space-x-2 p-3 border border-gray-200 rounded-lg hover:bg-gray-50 cursor-pointer transition">
                                    <input type="checkbox" name="fasilitas_fitur[]" value="<?= esc($fasilitas) ?>" 
                                           class="w-4 h-4 text-amber-600 bg-gray-100 border-gray-300 rounded focus:ring-amber-500 focus:ring-2"
                                           <?= in_array($fasilitas, $selected_fasilitas) ? 'checked' : '' ?>>
                                    <i class="<?= $icon ?> text-gray-600"></i>
                                    <span class="text-sm text-gray-700 font-medium"><?= esc($fasilitas) ?></span>
                                </label>
                            <?php endforeach; ?>
                        </div>
                        <div class="mt-3">
                            <label for="fasilitas_lainnya" class="block text-sm font-medium text-gray-700 mb-1">Fasilitas Lainnya (Opsional)</label>
                            <input type="text" id="fasilitas_lainnya" name="fasilitas_lainnya" value="<?= old('fasilitas_lainnya') ?>" 
                                   placeholder="Tambahkan fasilitas lain jika tidak ada di daftar..." 
                                   class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-amber-500 focus:border-transparent transition">
                        </div>
                        <?php if ($validation->hasError('fasilitas_fitur')): ?>
                            <p class="text-red-600 text-sm mt-2 flex items-center"><i class="fas fa-alert-circle mr-1"></i><?= $validation->getError('fasilitas_fitur') ?></p>
                        <?php endif; ?>
                    </div>

                    <!-- Informasi Kamar -->
                    <div>
                        <label for="informasi_kamar" class="block text-sm font-semibold text-gray-700 mb-2">
                            <i class="fas fa-info-circle text-blue-600 mr-2"></i>Informasi Kamar
                        </label>
                        <textarea id="informasi_kamar" name="informasi_kamar" rows="4" placeholder="Informasi tambahan tentang kamar, seperti luas, arah, dll..." class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-600 focus:border-transparent transition <?= $validation->hasError('informasi_kamar') ? 'border-red-500 ring-red-500 ring-2' : '' ?>"><?= old('informasi_kamar') ?></textarea>
                        <?php if ($validation->hasError('informasi_kamar')): ?>
                            <p class="text-red-600 text-sm mt-1 flex items-center"><i class="fas fa-alert-circle mr-1"></i><?= $validation->getError('informasi_kamar') ?></p>
                        <?php endif; ?>
                    </div>

                    <!-- Aturan Kamar -->
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-3">
                            <i class="fas fa-book text-green-600 mr-2"></i>Aturan Kamar
                        </label>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                            <?php
                            $aturan_options = [
                                'Jam malam pukul 22:00 WIB' => 'fas fa-moon',
                                'Dilarang merokok di dalam kamar' => 'fas fa-smoking-ban',
                                'Dilarang membawa tamu sembarangan' => 'fas fa-user-friends',
                                'Dilarang membuat kegaduhan' => 'fas fa-volume-off',
                                'Harus menjaga kebersihan kamar' => 'fas fa-broom',
                                'Dilarang memasak di kamar' => 'fas fa-utensils',
                                'Pembayaran tepat waktu' => 'fas fa-calendar-check',
                                'Dilarang membawa hewan peliharaan' => 'fas fa-paw',
                                'Harus melapor jika ada kerusakan' => 'fas fa-tools',
                                'Dilarang menggunakan listrik berlebihan' => 'fas fa-plug'
                            ];
                            $selected_aturan = old('aturan_kamar', []);
                            if (!is_array($selected_aturan)) {
                                $selected_aturan = [];
                            }
                            ?>
                            <?php foreach ($aturan_options as $aturan => $icon): ?>
                                <label class="flex items-center space-x-2 p-3 border border-gray-200 rounded-lg hover:bg-gray-50 cursor-pointer transition">
                                    <input type="checkbox" name="aturan_kamar[]" value="<?= esc($aturan) ?>" 
                                           class="w-4 h-4 text-green-600 bg-gray-100 border-gray-300 rounded focus:ring-green-500 focus:ring-2"
                                           <?= in_array($aturan, $selected_aturan) ? 'checked' : '' ?>>
                                    <i class="<?= $icon ?> text-gray-600"></i>
                                    <span class="text-sm text-gray-700 font-medium"><?= esc($aturan) ?></span>
                                </label>
                            <?php endforeach; ?>
                        </div>
                        <div class="mt-3">
                            <label for="aturan_lainnya" class="block text-sm font-medium text-gray-700 mb-1">Aturan Lainnya (Opsional)</label>
                            <input type="text" id="aturan_lainnya" name="aturan_lainnya" value="<?= old('aturan_lainnya') ?>" 
                                   placeholder="Tambahkan aturan lain jika tidak ada di daftar..." 
                                   class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent transition">
                        </div>
                        <?php if ($validation->hasError('aturan_kamar')): ?>
                            <p class="text-red-600 text-sm mt-2 flex items-center"><i class="fas fa-alert-circle mr-1"></i><?= $validation->getError('aturan_kamar') ?></p>
                        <?php endif; ?>
                    </div>

                    <!-- Informasi Penting -->
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-3">
                            <i class="fas fa-exclamation-triangle text-red-600 mr-2"></i>Informasi Penting
                        </label>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                            <?php
                            $info_options = [
                                'Deposit sebesar 1 bulan sewa' => 'fas fa-money-bill-wave',
                                'Pembayaran dilakukan di awal bulan' => 'fas fa-calendar-alt',
                                'Denda keterlambatan pembayaran Rp 50.000/hari' => 'fas fa-exclamation-circle',
                                'Listrik sudah termasuk dalam harga sewa' => 'fas fa-lightbulb',
                                'Air sudah termasuk dalam harga sewa' => 'fas fa-tint',
                                'Biaya kebersihan Rp 25.000/bulan' => 'fas fa-broom',
                                'Biaya maintenance ditanggung penghuni jika rusak' => 'fas fa-tools',
                                'Kontrak minimal 6 bulan' => 'fas fa-file-contract',
                                'Tidak ada pengembalian uang jika keluar sebelum kontrak' => 'fas fa-handshake',
                                'Perpanjangan kontrak 1 bulan sebelum berakhir' => 'fas fa-clock'
                            ];
                            $selected_info = old('informasi_penting', []);
                            if (!is_array($selected_info)) {
                                $selected_info = [];
                            }
                            ?>
                            <?php foreach ($info_options as $info => $icon): ?>
                                <label class="flex items-center space-x-2 p-3 border border-gray-200 rounded-lg hover:bg-gray-50 cursor-pointer transition">
                                    <input type="checkbox" name="informasi_penting[]" value="<?= esc($info) ?>" 
                                           class="w-4 h-4 text-red-600 bg-gray-100 border-gray-300 rounded focus:ring-red-500 focus:ring-2"
                                           <?= in_array($info, $selected_info) ? 'checked' : '' ?>>
                                    <i class="<?= $icon ?> text-gray-600"></i>
                                    <span class="text-sm text-gray-700 font-medium"><?= esc($info) ?></span>
                                </label>
                            <?php endforeach; ?>
                        </div>
                        <div class="mt-3">
                            <label for="info_lainnya" class="block text-sm font-medium text-gray-700 mb-1">Informasi Lainnya (Opsional)</label>
                            <input type="text" id="info_lainnya" name="info_lainnya" value="<?= old('info_lainnya') ?>" 
                                   placeholder="Tambahkan informasi penting lain jika tidak ada di daftar..." 
                                   class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-transparent transition">
                        </div>
                        <?php if ($validation->hasError('informasi_penting')): ?>
                            <p class="text-red-600 text-sm mt-2 flex items-center"><i class="fas fa-alert-circle mr-1"></i><?= $validation->getError('informasi_penting') ?></p>
                        <?php endif; ?>
                    </div>

                    <!-- Photo Upload -->
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-3">
                            <i class="fas fa-images text-pink-600 mr-2"></i>Foto Kamar (Maksimal 3 Foto)
                        </label>
                        <p class="text-sm text-gray-600 mb-4">Upload foto kamar untuk ditampilkan di katalog. Foto pertama akan menjadi foto utama.</p>

                        <!-- Upload New Photos -->
                        <div class="space-y-3">
                            <?php for ($i = 1; $i <= 3; $i++): ?>
                                <div>
                                    <label for="foto_kamar_<?= $i ?>" class="block text-sm font-medium text-gray-700 mb-1">
                                        Foto <?= $i ?> <?= $i === 1 ? '(Utama)' : '(Opsional)' ?>
                                    </label>
                                    <div class="border-2 border-dashed border-gray-300 rounded-lg p-4 text-center hover:bg-gray-50 transition cursor-pointer" onclick="document.getElementById('foto_kamar_<?= $i ?>').click()">
                                        <i class="fas fa-cloud-upload-alt text-2xl text-gray-400 mb-2"></i>
                                        <p class="text-gray-600 text-sm font-medium">Klik untuk pilih foto</p>
                                        <p class="text-gray-500 text-xs">PNG, JPG, WebP (Max. 2MB)</p>
                                        <input type="file" id="foto_kamar_<?= $i ?>" name="foto_kamar_<?= $i ?>" class="hidden" accept="image/*">
                                    </div>
                                    <div id="preview_create_<?= $i ?>" class="mt-2 hidden">
                                        <img id="img_preview_create_<?= $i ?>" class="w-full h-32 object-cover rounded-lg border border-gray-200">
                                        <button type="button" onclick="clearPhotoCreate(<?= $i ?>)" class="mt-1 text-xs text-red-600 hover:text-red-800">Hapus</button>
                                    </div>
                                </div>
                            <?php endfor; ?>
                        </div>

                        <div class="mt-3 p-3 bg-blue-50 border border-blue-200 rounded-lg">
                            <div class="flex items-start">
                                <i class="fas fa-info-circle text-blue-600 mt-1 mr-2"></i>
                                <div class="text-sm text-blue-800">
                                    <p class="font-medium">Informasi:</p>
                                    <ul class="mt-1 space-y-1">
                                        <li>• Upload minimal 1 foto untuk hasil terbaik</li>
                                        <li>• Foto pertama akan menjadi foto utama</li>
                                        <li>• Semua foto akan ditampilkan di katalog kamar</li>
                                        <li>• Format yang didukung: PNG, JPG, WebP</li>
                                        <li>• Ukuran maksimal per foto: 2MB</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Buttons -->
                    <div class="flex gap-3 pt-4">
                        <button type="submit" class="flex-1 bg-gradient-to-r from-green-600 to-green-700 hover:from-green-700 hover:to-green-800 text-white font-semibold py-3 px-4 rounded-lg transition duration-200 transform hover:scale-105 flex items-center justify-center">
                            <i class="fas fa-save mr-2"></i>Simpan Kamar
                        </button>
                        <a href="<?= base_url('admin/kamar') ?>" class="flex-1 bg-gray-200 hover:bg-gray-300 text-gray-800 font-semibold py-3 px-4 rounded-lg transition duration-200 flex items-center justify-center">
                            <i class="fas fa-times mr-2"></i>Batal
                        </a>
                    </div>

                <?= form_close() ?>
            </div>
        </div>
    </div>

    <!-- Info Sidebar -->
    <div class="lg:col-span-1">
        <div class="bg-blue-50 border-l-4 border-blue-600 rounded-lg p-6">
            <h4 class="font-bold text-blue-900 mb-3 flex items-center">
                <i class="fas fa-info-circle text-blue-600 mr-2"></i>Panduan Pengisian
            </h4>
            <ul class="space-y-2 text-sm text-blue-800">
                <li class="flex items-start">
                    <i class="fas fa-check text-blue-600 mt-1 mr-2 flex-shrink-0"></i>
                    <span><strong>Nomor Kamar:</strong> Gunakan format yang konsisten (A-101, B-202, dll)</span>
                </li>
                <li class="flex items-start">
                    <i class="fas fa-check text-blue-600 mt-1 mr-2 flex-shrink-0"></i>
                    <span><strong>Tipe Kamar:</strong> Single, Double, atau tipe custom lainnya</span>
                </li>
                <li class="flex items-start">
                    <i class="fas fa-check text-blue-600 mt-1 mr-2 flex-shrink-0"></i>
                    <span><strong>Status:</strong> Tersedia = bisa dipesan, Terisi = ditempati, Di Booking = pending verifikasi</span>
                </li>
                <li class="flex items-start">
                    <i class="fas fa-check text-blue-600 mt-1 mr-2 flex-shrink-0"></i>
                    <span><strong>Harga Minimum:</strong> Rp 100.000 per bulan</span>
                </li>
            </ul>
        </div>
    </div>
</div>

<script>
// Photo preview functionality for create form
<?php for ($i = 1; $i <= 3; $i++): ?>
document.getElementById('foto_kamar_<?= $i ?>').addEventListener('change', function(e) {
    const file = e.target.files[0];
    const preview = document.getElementById('preview_create_<?= $i ?>');
    const imgPreview = document.getElementById('img_preview_create_<?= $i ?>');

    if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            imgPreview.src = e.target.result;
            preview.classList.remove('hidden');
        };
        reader.readAsDataURL(file);
    } else {
        preview.classList.add('hidden');
    }
});
<?php endfor; ?>

function clearPhotoCreate(index) {
    document.getElementById('foto_kamar_' + index).value = '';
    document.getElementById('preview_create_' + index).classList.add('hidden');
}

// Form validation
document.getElementById('createKamarForm').addEventListener('submit', function(e) {
    const files = [];
    for (let i = 1; i <= 3; i++) {
        const fileInput = document.getElementById('foto_kamar_' + i);
        if (fileInput.files[0]) {
            files.push(fileInput.files[0]);
        }
    }

    // Check if at least one photo is uploaded
    if (files.length === 0) {
        alert('Harap upload minimal 1 foto kamar.');
        e.preventDefault();
        return;
    }

    // Validate file types and sizes
    for (let file of files) {
        const allowedTypes = ['image/jpeg', 'image/png', 'image/webp'];
        if (!allowedTypes.includes(file.type)) {
            alert('Format file tidak didukung. Gunakan PNG, JPG, atau WebP.');
            e.preventDefault();
            return;
        }
        if (file.size > 2 * 1024 * 1024) { // 2MB
            alert('Ukuran file terlalu besar. Maksimal 2MB.');
            e.preventDefault();
            return;
        }
    }
});
</script>

<?= $this->endSection() ?>