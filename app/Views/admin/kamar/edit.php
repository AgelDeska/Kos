<?= $this->extend('layout/admin_template') ?>

<?php helper('form'); ?>

<?= $this->section('content') ?>

<!-- Header -->
<div class="mb-8">
    <h2 class="text-3xl font-bold text-gray-900 flex items-center">
        <i class="fas fa-edit text-orange-600 mr-3"></i>Edit Kamar
    </h2>
    <p class="text-gray-600 mt-1">Perbarui informasi kamar nomor <span class="font-semibold"><?= $kamar['nomor_kamar'] ?></span></p>
</div>

<!-- Error Message -->
<?php if (session()->getFlashdata('error')): ?>
    <div class="mb-6 p-4 bg-red-50 border-l-4 border-red-600 rounded-lg">
        <div class="flex items-start">
            <i class="fas fa-exclamation-circle text-red-600 mt-1 mr-3"></i>
            <div>
                <p class="font-semibold text-red-900"><?= session()->getFlashdata('error') ?></p>
            </div>
        </div>
    </div>
<?php endif; ?>

<!-- Form Card -->
<div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
    <!-- Main Form -->
    <div class="lg:col-span-2">
        <div class="card bg-white rounded-xl shadow-lg border border-gray-100 overflow-hidden">
            <div class="p-6 border-b border-gray-200">
                <h3 class="text-lg font-bold text-gray-900">Informasi Kamar</h3>
            </div>

            <div class="p-6">
                <?= form_open_multipart('admin/kamar/update/' . esc($kamar['kamar_id']), ['class' => 'space-y-6']) ?>
                <?= csrf_field() ?>

                    <!-- Row 1: Nomor & Tipe -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label for="nomor_kamar" class="block text-sm font-semibold text-gray-700 mb-2">
                                <i class="fas fa-door-open text-blue-600 mr-2"></i>Nomor Kamar
                            </label>
                            <input type="text" id="nomor_kamar" name="nomor_kamar" value="<?= old('nomor_kamar', $kamar['nomor_kamar']) ?>" placeholder="Contoh: A-101" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-600 focus:border-transparent transition <?= $validation->hasError('nomor_kamar') ? 'border-red-500 ring-red-500 ring-2' : '' ?>" required>
                            <?php if ($validation->hasError('nomor_kamar')): ?>
                                <p class="text-red-600 text-sm mt-1 flex items-center"><i class="fas fa-alert-circle mr-1"></i><?= $validation->getError('nomor_kamar') ?></p>
                            <?php endif; ?>
                        </div>

                        <div>
                            <label for="tipe_kamar" class="block text-sm font-semibold text-gray-700 mb-2">
                                <i class="fas fa-tag text-purple-600 mr-2"></i>Tipe Kamar
                            </label>
                            <input type="text" id="tipe_kamar" name="tipe_kamar" value="<?= old('tipe_kamar', $kamar['tipe_kamar']) ?>" placeholder="Contoh: Single, Double, Premium" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-600 focus:border-transparent transition <?= $validation->hasError('tipe_kamar') ? 'border-red-500 ring-red-500 ring-2' : '' ?>" required>
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
                            <input type="number" id="kapasitas" name="kapasitas" value="<?= old('kapasitas', $kamar['kapasitas']) ?>" min="1" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-600 focus:border-transparent transition <?= $validation->hasError('kapasitas') ? 'border-red-500 ring-red-500 ring-2' : '' ?>" required>
                            <?php if ($validation->hasError('kapasitas')): ?>
                                <p class="text-red-600 text-sm mt-1 flex items-center"><i class="fas fa-alert-circle mr-1"></i><?= $validation->getError('kapasitas') ?></p>
                            <?php endif; ?>
                        </div>

                        <div>
                            <label for="harga" class="block text-sm font-semibold text-gray-700 mb-2">
                                <i class="fas fa-money-bill-wave text-orange-600 mr-2"></i>Harga/Bulan (Rp)
                            </label>
                            <input type="number" id="harga" name="harga" value="<?= old('harga', $kamar['harga']) ?>" min="100000" placeholder="Contoh: 500000" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-600 focus:border-transparent transition <?= $validation->hasError('harga') ? 'border-red-500 ring-red-500 ring-2' : '' ?>" required>
                            <?php if ($validation->hasError('harga')): ?>
                                <p class="text-red-600 text-sm mt-1 flex items-center"><i class="fas fa-alert-circle mr-1"></i><?= $validation->getError('harga') ?></p>
                            <?php endif; ?>
                        </div>

                        <div>
                            <label for="status" class="block text-sm font-semibold text-gray-700 mb-2">
                                <i class="fas fa-circle-notch text-orange-600 mr-2"></i>Status
                            </label>
                            <select id="status" name="status" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-600 focus:border-transparent transition <?= $validation->hasError('status') ? 'border-red-500 ring-red-500 ring-2' : '' ?>" required>
                                <?php $currentStatus = old('status', $kamar['status']); ?>
                                <option value="Tersedia" <?= $currentStatus == 'Tersedia' ? 'selected' : '' ?>>Tersedia</option>
                                <option value="Terisi" <?= $currentStatus == 'Terisi' ? 'selected' : '' ?>>Terisi</option>
                                <option value="Di Booking" <?= $currentStatus == 'Di Booking' ? 'selected' : '' ?>>Di Booking</option>
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
                        <textarea id="deskripsi" name="deskripsi" rows="4" placeholder="Jelaskan detail kamar, fasilitas, dan keterangan penting lainnya..." class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-600 focus:border-transparent transition <?= $validation->hasError('deskripsi') ? 'border-red-500 ring-red-500 ring-2' : '' ?>"><?= old('deskripsi', $kamar['deskripsi']) ?></textarea>
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
                            // Parse existing fasilitas from database
                            $existing_fasilitas = old('fasilitas_fitur', $kamar['fasilitas_fitur'] ?? '');
                            $selected_fasilitas = [];
                            $fasilitas_lainnya_value = '';
                            if (!empty($existing_fasilitas)) {
                                if (is_array($existing_fasilitas)) {
                                    // From form submission (checkbox array)
                                    $selected_fasilitas = $existing_fasilitas;
                                } else {
                                    // From database (newline-separated string)
                                    $all_fasilitas = array_map('trim', explode("\n", $existing_fasilitas));
                                    $predefined_fasilitas = array_keys($fasilitas_options);
                                    $selected_fasilitas = array_intersect($all_fasilitas, $predefined_fasilitas);
                                    $custom_fasilitas = array_diff($all_fasilitas, $predefined_fasilitas);
                                    $fasilitas_lainnya_value = implode(', ', $custom_fasilitas);
                                }
                            }
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
                            <input type="text" id="fasilitas_lainnya" name="fasilitas_lainnya" value="<?= old('fasilitas_lainnya', $fasilitas_lainnya_value) ?>" 
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
                        <textarea id="informasi_kamar" name="informasi_kamar" rows="4" placeholder="Informasi tambahan tentang kamar, seperti luas, arah, dll..." class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-600 focus:border-transparent transition <?= $validation->hasError('informasi_kamar') ? 'border-red-500 ring-red-500 ring-2' : '' ?>"><?= old('informasi_kamar', $kamar['informasi_kamar']) ?></textarea>
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
                                'Tidak merokok di dalam kamar' => 'fas fa-smoking-ban',
                                'Tidak membawa tamu sembarangan' => 'fas fa-user-friends',
                                'Jam malam pukul 22:00' => 'fas fa-clock',
                                'Dilarang membawa hewan peliharaan' => 'fas fa-paw',
                                'Dilarang membuat kegaduhan' => 'fas fa-volume-off',
                                'Harus menjaga kebersihan kamar' => 'fas fa-broom',
                                'Dilarang memasak di kamar' => 'fas fa-utensils',
                                'Pembayaran tepat waktu' => 'fas fa-money-bill-wave',
                                'Tidak boleh mengubah interior kamar' => 'fas fa-tools',
                                'Harus melapor jika ada kerusakan' => 'fas fa-exclamation-triangle'
                            ];
                            // Parse existing aturan from database
                            $existing_aturan = old('aturan_kamar', $kamar['aturan_kamar'] ?? '');
                            $selected_aturan = [];
                            $aturan_lainnya_value = '';
                            if (!empty($existing_aturan)) {
                                if (is_array($existing_aturan)) {
                                    // From form submission (checkbox array)
                                    $selected_aturan = $existing_aturan;
                                } else {
                                    // From database (newline-separated string)
                                    $all_aturan = array_map('trim', explode("\n", $existing_aturan));
                                    $predefined_aturan = array_keys($aturan_options);
                                    $selected_aturan = array_intersect($all_aturan, $predefined_aturan);
                                    $custom_aturan = array_diff($all_aturan, $predefined_aturan);
                                    $aturan_lainnya_value = implode(', ', $custom_aturan);
                                }
                            }
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
                            <input type="text" id="aturan_lainnya" name="aturan_lainnya" value="<?= old('aturan_lainnya', $aturan_lainnya_value) ?>" 
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
                                'Deposit wajib dibayar di awal' => 'fas fa-money-bill-wave',
                                'Pembayaran bulanan maksimal tanggal 5' => 'fas fa-calendar-alt',
                                'Denda keterlambatan Rp 50.000/hari' => 'fas fa-exclamation-circle',
                                'Kontrak minimal 6 bulan' => 'fas fa-file-contract',
                                'Tidak ada pengembalian deposit jika keluar sebelum kontrak' => 'fas fa-handshake',
                                'Listrik sudah termasuk dalam harga' => 'fas fa-lightbulb',
                                'Air bersih sudah termasuk dalam harga' => 'fas fa-tint',
                                'Internet sudah termasuk dalam harga' => 'fas fa-wifi',
                                'Kebersihan kamar ditanggung penyewa' => 'fas fa-broom',
                                'Perbaikan kerusakan ditanggung penyewa' => 'fas fa-tools'
                            ];
                            // Parse existing informasi penting from database
                            $existing_info = old('informasi_penting', $kamar['informasi_penting'] ?? '');
                            $selected_info = [];
                            $info_lainnya_value = '';
                            if (!empty($existing_info)) {
                                if (is_array($existing_info)) {
                                    // From form submission (checkbox array)
                                    $selected_info = $existing_info;
                                } else {
                                    // From database (newline-separated string)
                                    $all_info = array_map('trim', explode("\n", $existing_info));
                                    $predefined_info = array_keys($info_options);
                                    $selected_info = array_intersect($all_info, $predefined_info);
                                    $custom_info = array_diff($all_info, $predefined_info);
                                    $info_lainnya_value = implode(', ', $custom_info);
                                }
                            }
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
                            <input type="text" id="info_lainnya" name="info_lainnya" value="<?= old('info_lainnya', $info_lainnya_value) ?>" 
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
                            <i class="fas fa-images text-pink-600 mr-2"></i>Foto Kamar (Opsional - Max 3 Foto)
                        </label>
                        <p class="text-sm text-gray-600 mb-4">Upload foto kamar untuk ditampilkan di katalog. Jika tidak diubah, foto lama akan tetap digunakan.</p>

                        <!-- Current Photos Display -->
                        <?php
                        $currentPhotos = [];
                        if (!empty($kamar['foto_kamar'])) {
                            $decoded = json_decode($kamar['foto_kamar'], true);
                            if (is_array($decoded)) {
                                $currentPhotos = $decoded;
                            } elseif (!empty($kamar['foto_kamar'])) {
                                // Legacy single photo
                                $currentPhotos = [$kamar['foto_kamar']];
                            }
                        }
                        ?>

                        <?php if (!empty($currentPhotos)): ?>
                            <div class="mb-4">
                                <h4 class="text-sm font-medium text-gray-700 mb-2">Foto Saat Ini:</h4>
                                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-3">
                                    <?php foreach ($currentPhotos as $index => $photo): ?>
                                        <div class="relative">
                                            <img src="<?= base_url('img/kamar/' . $photo) ?>" alt="Foto Kamar <?= $index + 1 ?>"
                                                 class="w-full h-24 object-cover rounded-lg border border-gray-200">
                                            <div class="absolute top-1 right-1 bg-red-500 text-white text-xs px-2 py-1 rounded">
                                                Foto <?= $index + 1 ?>
                                            </div>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                                <p class="text-xs text-gray-500 mt-2">Foto akan diganti jika Anda upload foto baru</p>
                            </div>
                        <?php endif; ?>

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
                                    <div id="preview_<?= $i ?>" class="mt-2 hidden">
                                        <img id="img_preview_<?= $i ?>" class="w-full h-32 object-cover rounded-lg border border-gray-200">
                                        <button type="button" onclick="clearPhoto(<?= $i ?>)" class="mt-1 text-xs text-red-600 hover:text-red-800">Hapus</button>
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
                                        <li>• Jika tidak upload foto baru, foto lama akan tetap digunakan</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Buttons -->
                    <div class="flex gap-3 pt-4">
                        <button type="submit" class="flex-1 bg-gradient-to-r from-orange-600 to-orange-700 hover:from-orange-700 hover:to-orange-800 text-white font-semibold py-3 px-4 rounded-lg transition duration-200 transform hover:scale-105 flex items-center justify-center">
                            <i class="fas fa-save mr-2"></i>Perbarui Kamar
                        </button>
                        <a href="<?= base_url('admin/kamar') ?>" class="flex-1 bg-gray-200 hover:bg-gray-300 text-gray-800 font-semibold py-3 px-4 rounded-lg transition duration-200 flex items-center justify-center">
                            <i class="fas fa-times mr-2"></i>Batal
                        </a>
                    </div>

                <?= form_close() ?>
            </div>
        </div>
    </div>

    <!-- Current Photo Sidebar -->
    <div class="lg:col-span-1 space-y-4">
        <div class="bg-white rounded-xl shadow-lg border border-gray-100 overflow-hidden">
            <div class="p-4 bg-gradient-to-r from-orange-50 to-yellow-50 border-b border-gray-200">
                <h4 class="font-bold text-gray-900 flex items-center">
                    <i class="fas fa-photo-video text-orange-600 mr-2"></i>Foto Saat Ini
                </h4>
            </div>
            
            <div class="p-4">
                <?php if ($kamar['foto_kamar']): ?>
                    <img src="<?= base_url('img/kamar/' . $kamar['foto_kamar']) ?>" alt="<?= $kamar['nomor_kamar'] ?>" class="w-full h-48 object-cover rounded-lg border-2 border-gray-200 mb-3">
                    <p class="text-sm text-gray-600 mb-3">
                        <strong>File:</strong> <?= $kamar['foto_kamar'] ?>
                    </p>
                <?php else: ?>
                    <div class="bg-gray-100 rounded-lg p-8 text-center mb-3">
                        <i class="fas fa-image text-4xl text-gray-400 mb-2"></i>
                        <p class="text-gray-600 text-sm">Belum ada foto</p>
                    </div>
                <?php endif; ?>
            </div>
        </div>

        <!-- Info Sidebar -->
        <div class="bg-orange-50 border-l-4 border-orange-600 rounded-lg p-6">
            <h4 class="font-bold text-orange-900 mb-3 flex items-center">
                <i class="fas fa-info-circle text-orange-600 mr-2"></i>Panduan Edit
            </h4>
            <ul class="space-y-2 text-sm text-orange-800">
                <li class="flex items-start">
                    <i class="fas fa-check text-orange-600 mt-1 mr-2 flex-shrink-0"></i>
                    <span>Perbarui data kamar sesuai kebutuhan</span>
                </li>
                <li class="flex items-start">
                    <i class="fas fa-check text-orange-600 mt-1 mr-2 flex-shrink-0"></i>
                    <span>Foto kamar bersifat opsional, hanya upload jika ingin mengubah</span>
                </li>
                <li class="flex items-start">
                    <i class="fas fa-check text-orange-600 mt-1 mr-2 flex-shrink-0"></i>
                    <span>Format file: PNG, JPG, GIF (Max 2MB)</span>
                </li>
                <li class="flex items-start">
                    <i class="fas fa-check text-orange-600 mt-1 mr-2 flex-shrink-0"></i>
                    <span>Pastikan data yang diubah sudah benar sebelum disimpan</span>
                </li>
            </ul>
        </div>
    </div>
</div>

<script>
// Photo preview functionality
<?php for ($i = 1; $i <= 3; $i++): ?>
document.getElementById('foto_kamar_<?= $i ?>').addEventListener('change', function(e) {
    const file = e.target.files[0];
    const preview = document.getElementById('preview_<?= $i ?>');
    const imgPreview = document.getElementById('img_preview_<?= $i ?>');

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

function clearPhoto(index) {
    document.getElementById('foto_kamar_' + index).value = '';
    document.getElementById('preview_' + index).classList.add('hidden');
}

// Form validation
document.getElementById('editKamarForm').addEventListener('submit', function(e) {
    const files = [];
    for (let i = 1; i <= 3; i++) {
        const fileInput = document.getElementById('foto_kamar_' + i);
        if (fileInput.files[0]) {
            files.push(fileInput.files[0]);
        }
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