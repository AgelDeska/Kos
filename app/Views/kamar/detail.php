<?= $this->extend('layout/room_template') ?>

<?= $this->section('content') ?>

<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
    <!-- Main Content -->
    <div class="lg:col-span-2 space-y-6">
        <!-- Room Image Gallery -->
        <div class="card">
            <div class="card-body p-0">
                <?php
                $photos = [];
                if (!empty($kamar['foto_kamar'])) {
                    $decoded = json_decode($kamar['foto_kamar'], true);
                    if (is_array($decoded)) {
                        $photos = $decoded;
                    } elseif (!empty($kamar['foto_kamar'])) {
                        // Legacy single photo
                        $photos = [$kamar['foto_kamar']];
                    }
                }

                if (empty($photos)) {
                    $photos = ['placeholder.jpg'];
                }
                ?>

                <!-- Main Image Display -->
                <div class="relative overflow-hidden rounded-t-lg">
                    <div id="main-image-container" class="relative aspect-[9/16] w-full max-w-sm mx-auto overflow-hidden bg-gray-200 cursor-grab active:cursor-grabbing rounded-lg shadow-inner">
                        <?php foreach ($photos as $index => $photo): ?>
                            <div class="gallery-image-wrapper absolute inset-0 w-full h-full">
                                <!-- Loading Spinner -->
                                <div class="absolute inset-0 flex items-center justify-center bg-gray-200">
                                    <div class="animate-spin rounded-full h-8 w-8 border-b-2 border-blue-500"></div>
                                </div>

                                <img
                                    src="<?= base_url('img/kamar/' . $photo) ?>"
                                    alt="Foto Kamar <?= esc($kamar['nomor_kamar']) ?> - <?= $index + 1 ?>"
                                    class="gallery-main-image w-full h-full transition-all duration-500 ease-in-out <?= $index === 0 ? 'active translate-x-0 opacity-100' : 'translate-x-full opacity-0' ?>"
                                    onerror="this.src='https://via.placeholder.com/400x600?text=Kamar+<?= esc($kamar['nomor_kamar']) ?>'"
                                    onload="handleImageLoad(this)"
                                />
                            </div>
                        <?php endforeach; ?>

                        <!-- Swipe Indicator (only show on mobile) -->
                        <?php if (count($photos) > 1): ?>
                            <div class="absolute bottom-4 left-1/2 transform -translate-x-1/2 bg-black/50 text-white px-3 py-1 rounded-full text-xs opacity-0 md:opacity-100 transition-opacity duration-300">
                                <i class="fas fa-arrows-alt-h mr-1"></i>Geser untuk melihat foto lain
                            </div>
                        <?php endif; ?>
                    </div>

                    <div class="absolute inset-0 bg-gradient-to-t from-black/10 via-transparent to-black/10 pointer-events-none"></div>

                    <!-- Navigation Arrows -->
                    <?php if (count($photos) > 1): ?>
                        <button id="prev-image" class="absolute left-2 top-1/2 transform -translate-y-1/2 bg-black/60 hover:bg-black/80 text-white p-3 rounded-full transition-all duration-300 z-10 shadow-lg">
                            <i class="fas fa-chevron-left text-lg"></i>
                        </button>
                        <button id="next-image" class="absolute right-2 top-1/2 transform -translate-y-1/2 bg-black/60 hover:bg-black/80 text-white p-3 rounded-full transition-all duration-300 z-10 shadow-lg">
                            <i class="fas fa-chevron-right text-lg"></i>
                        </button>
                    <?php endif; ?>

                    <div class="absolute inset-0 bg-gradient-to-t from-black/20 to-transparent"></div>
                </div>

                <!-- Thumbnail Gallery -->
                <?php if (count($photos) > 1): ?>
                    <div class="p-4 bg-gray-50">
                        <div class="flex gap-2 overflow-x-auto pb-2 justify-center">
                            <?php foreach ($photos as $index => $photo): ?>
                                <img
                                    src="<?= base_url('img/kamar/' . $photo) ?>"
                                    alt="Thumbnail <?= $index + 1 ?>"
                                    class="gallery-thumbnail w-16 h-24 object-cover rounded-lg cursor-pointer border-2 transition-all duration-300 flex-shrink-0 <?= $index === 0 ? 'border-blue-500 opacity-100' : 'border-gray-300 opacity-70 hover:opacity-100' ?>"
                                    data-index="<?= $index ?>"
                                    onerror="this.src='https://via.placeholder.com/64x96?text=<?= $index + 1 ?>'"
                                />
                            <?php endforeach; ?>
                        </div>

                        <!-- Image Indicators -->
                        <div class="flex justify-center gap-2 mt-3">
                            <?php for ($i = 0; $i < count($photos); $i++): ?>
                                <button
                                    class="gallery-indicator w-2 h-2 rounded-full transition-all duration-300 <?= $i === 0 ? 'bg-blue-500' : 'bg-gray-300' ?>"
                                    data-index="<?= $i ?>"
                                ></button>
                            <?php endfor; ?>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>

        <!-- Room Overview -->
        <div class="card">
            <div class="card-header">
                <h4 class="text-lg font-semibold text-gray-900 flex items-center gap-2">
                    <i class="fas fa-info-circle text-blue-500"></i>
                    Informasi Kamar
                </h4>
            </div>
            <div class="card-body">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
                    <div class="facility-item text-center">
                        <div class="w-12 h-12 bg-blue-100 rounded-full flex items-center justify-center mx-auto mb-3">
                            <i class="fas fa-users text-blue-600 text-lg"></i>
                        </div>
                        <div class="info-label">Kapasitas</div>
                        <div class="info-value text-center font-bold text-lg"><?= esc($kamar['kapasitas']) ?> Orang</div>
                    </div>
                    <div class="facility-item text-center">
                        <div class="w-12 h-12 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-3">
                            <i class="fas fa-ruler-combined text-green-600 text-lg"></i>
                        </div>
                        <div class="info-label">Luas Kamar</div>
                        <div class="info-value text-center font-bold text-lg">3 x 4 m²</div>
                    </div>
                    <div class="facility-item text-center">
                        <div class="w-12 h-12 bg-purple-100 rounded-full flex items-center justify-center mx-auto mb-3">
                            <i class="fas fa-star text-purple-600 text-lg"></i>
                        </div>
                        <div class="info-label">Rating</div>
                        <div class="info-value text-center font-bold text-lg flex items-center justify-center gap-1">
                            <i class="fas fa-star text-yellow-400"></i> 4.8/5
                        </div>
                    </div>
                </div>

                <div class="border-t border-gray-100 pt-6">
                    <h5 class="text-lg font-semibold text-gray-900 mb-3 flex items-center gap-2">
                        <i class="fas fa-align-left text-blue-500"></i>
                        Deskripsi Kamar
                    </h5>
                    <p class="text-gray-700 leading-relaxed">
                        <?= nl2br(esc($kamar['deskripsi'] ?? 'Kamar nyaman dengan fasilitas lengkap untuk kenyamanan Anda selama menginap. Dilengkapi dengan berbagai fasilitas modern dan lokasi strategis.')) ?>
                    </p>
                </div>

                <?php if (!empty($kamar['informasi_kamar'])): ?>
                <div class="border-t border-gray-100 pt-6">
                    <h5 class="text-lg font-semibold text-gray-900 mb-3 flex items-center gap-2">
                        <i class="fas fa-info-circle text-green-500"></i>
                        Informasi Tambahan
                    </h5>
                    <p class="text-gray-700 leading-relaxed">
                        <?= nl2br(esc($kamar['informasi_kamar'])) ?>
                    </p>
                </div>
                <?php endif; ?>
            </div>
        </div>

        <!-- Facilities -->
        <div class="card">
            <div class="card-header">
                <h4 class="text-lg font-semibold text-gray-900 flex items-center gap-2">
                    <i class="fas fa-concierge-bell text-amber-500"></i>
                    Fasilitas & Fitur
                </h4>
            </div>
            <div class="card-body">
                <?php if (!empty($kamar['fasilitas_fitur'])): ?>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <?php 
                        $fasilitas = explode("\n", trim($kamar['fasilitas_fitur']));
                        $fasilitas = array_filter($fasilitas); // Remove empty lines
                        foreach ($fasilitas as $index => $item): 
                            $item = trim($item);
                            if (empty($item)) continue;
                            $icons = ['fas fa-shower', 'fas fa-wind', 'fas fa-archive', 'fas fa-wifi', 'fas fa-bed', 'fas fa-broom'];
                            $colors = ['emerald', 'blue', 'purple', 'amber', 'rose', 'indigo'];
                            $icon = $icons[$index % count($icons)];
                            $color = $colors[$index % count($colors)];
                        ?>
                            <div class="facility-item">
                                <div class="flex items-start gap-3">
                                    <div class="w-10 h-10 bg-<?= $color ?>-100 rounded-lg flex items-center justify-center flex-shrink-0">
                                        <i class="<?= $icon ?> text-<?= $color ?>-600"></i>
                                    </div>
                                    <div>
                                        <h6 class="font-semibold text-gray-900"><?= esc($item) ?></h6>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php else: ?>
                    <p class="text-gray-600">Informasi fasilitas belum tersedia.</p>
                <?php endif; ?>
            </div>
        </div>

        <!-- Rules & Information -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div class="card">
                <div class="card-header">
                    <h4 class="text-lg font-semibold text-gray-900 flex items-center gap-2">
                        <i class="fas fa-book text-blue-500"></i>
                        Aturan Kamar
                    </h4>
                </div>
                <div class="card-body">
                    <?php if (!empty($kamar['aturan_kamar'])): ?>
                        <ul class="space-y-3">
                            <?php 
                            $aturan = explode("\n", trim($kamar['aturan_kamar']));
                            $aturan = array_filter($aturan);
                            foreach ($aturan as $item): 
                                $item = trim($item);
                                if (empty($item)) continue;
                            ?>
                                <li class="flex items-start gap-3">
                                    <i class="fas fa-check-circle text-green-500 mt-0.5 flex-shrink-0"></i>
                                    <span class="text-sm text-gray-700"><?= esc($item) ?></span>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    <?php else: ?>
                        <p class="text-gray-600">Informasi aturan belum tersedia.</p>
                    <?php endif; ?>
                </div>
            </div>

            <div class="card">
                <div class="card-header">
                    <h4 class="text-lg font-semibold text-gray-900 flex items-center gap-2">
                        <i class="fas fa-info-circle text-amber-500"></i>
                        Informasi Penting
                    </h4>
                </div>
                <div class="card-body">
                    <?php if (!empty($kamar['informasi_penting'])): ?>
                        <ul class="space-y-3">
                            <?php 
                            $info = explode("\n", trim($kamar['informasi_penting']));
                            $info = array_filter($info);
                            foreach ($info as $item): 
                                $item = trim($item);
                                if (empty($item)) continue;
                            ?>
                                <li class="flex items-start gap-3">
                                    <i class="fas fa-arrow-right text-amber-500 mt-0.5 flex-shrink-0"></i>
                                    <span class="text-sm text-gray-700"><?= esc($item) ?></span>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    <?php else: ?>
                        <p class="text-gray-600">Informasi penting belum tersedia.</p>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>

    <!-- Sidebar -->
    <div class="space-y-6">
        <!-- Price Card -->
        <div class="card price-card">
            <div class="card-body text-center">
                <div class="mb-4">
                    <i class="fas fa-tag text-white/80 text-2xl mb-2 block"></i>
                    <p class="text-white/80 text-sm font-medium">Harga per Bulan</p>
                </div>
                <h2 class="text-4xl font-black text-white mb-2">
                    Rp <?= number_format(esc($kamar['harga']), 0, ',', '.') ?>
                </h2>
                <p class="text-white/80 text-sm mb-4">*Pembayaran pertama (DP 50%)</p>

                <div class="bg-white/10 rounded-lg p-3 backdrop-blur-sm">
                    <div class="flex justify-between items-center text-white">
                        <span class="text-sm">DP Awal</span>
                        <span class="font-bold text-lg">Rp <?= number_format(esc($kamar['harga']) / 2, 0, ',', '.') ?></span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Booking Actions -->
        <div class="card">
            <div class="card-body">
                <?php if ($kamar['status'] == 'Tersedia'): ?>
                    <?php if (session()->get('isLoggedIn') && strtolower(session()->get('role')) == 'penyewa'): ?>
                        <a href="<?= base_url('penyewa/booking/' . esc($kamar['kamar_id'])) ?>" class="btn btn-primary w-full justify-center mb-3">
                            <i class="fas fa-calendar-check"></i>
                            Booking Sekarang
                        </a>
                    <?php else: ?>
                        <a href="<?= base_url('login') ?>" class="btn btn-primary w-full justify-center mb-3">
                            <i class="fas fa-sign-in-alt"></i>
                            Login untuk Booking
                        </a>
                    <?php endif; ?>
                <?php else: ?>
                    <button disabled class="btn btn-ghost w-full justify-center opacity-50 cursor-not-allowed mb-3">
                        <i class="fas fa-lock"></i>
                        Status: <?= esc($kamar['status']) ?>
                    </button>
                <?php endif; ?>

                <div class="bg-blue-50 rounded-lg p-4 mb-4">
                    <div class="flex items-start gap-3">
                        <i class="fas fa-lightbulb text-blue-500 mt-0.5"></i>
                        <div>
                            <p class="font-semibold text-gray-900 text-sm">Proses Booking Mudah</p>
                            <p class="text-gray-600 text-xs mt-1">Klik booking, isi data, transfer DP, dan kamar siap dihuni!</p>
                        </div>
                    </div>
                </div>

                <a href="<?= base_url('katalog') ?>" class="btn btn-ghost w-full justify-center">
                    <i class="fas fa-arrow-left"></i>
                    Kembali ke Katalog
                </a>
            </div>
        </div>

        <!-- Contact Info -->
        <div class="card">
            <div class="card-header">
                <h4 class="text-lg font-semibold text-gray-900 flex items-center gap-2">
                    <i class="fas fa-phone text-purple-500"></i>
                    Hubungi Admin
                </h4>
            </div>
            <div class="card-body">
                <div class="space-y-3">
                    <div class="flex items-center gap-3">
                        <i class="fas fa-mobile-alt text-green-500"></i>
                        <span class="text-sm font-medium text-gray-900">+62 812 3456 7890</span>
                    </div>
                    <div class="flex items-center gap-3">
                        <i class="fas fa-envelope text-red-500"></i>
                        <span class="text-sm font-medium text-gray-900">admin@smartkos.id</span>
                    </div>
                    <div class="flex items-center gap-3">
                        <i class="fas fa-clock text-amber-500"></i>
                        <span class="text-sm text-gray-600">08:00 - 21:00 WIB</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Quick Stats -->
        <div class="card">
            <div class="card-header">
                <h4 class="text-lg font-semibold text-gray-900 flex items-center gap-2">
                    <i class="fas fa-chart-bar text-green-500"></i>
                    Statistik Kamar
                </h4>
            </div>
            <div class="card-body">
                <div class="space-y-4">
                    <div class="flex justify-between items-center">
                        <span class="text-sm text-gray-600">Tipe Kamar</span>
                        <span class="font-semibold text-gray-900"><?= esc($kamar['tipe_kamar'] ?? 'Standard') ?></span>
                    </div>
                    <div class="flex justify-between items-center">
                        <span class="text-sm text-gray-600">Nomor Kamar</span>
                        <span class="font-semibold text-gray-900"><?= esc($kamar['nomor_kamar']) ?></span>
                    </div>
                    <div class="flex justify-between items-center">
                        <span class="text-sm text-gray-600">Kapasitas</span>
                        <span class="font-semibold text-gray-900"><?= esc($kamar['kapasitas']) ?> orang</span>
                    </div>
                    <div class="flex justify-between items-center">
                        <span class="text-sm text-gray-600">Status</span>
                        <span class="status-badge <?=
                            $kamar['status'] == 'Tersedia' ? 'status-available' :
                            ($kamar['status'] == 'Di Booking' ? 'status-booked' : 'status-occupied')
                        ?>">
                            <?= esc($kamar['status']) ?>
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
// Image gallery functionality
document.addEventListener('DOMContentLoaded', function() {
    const mainImages = document.querySelectorAll('.gallery-main-image');
    const thumbnails = document.querySelectorAll('.gallery-thumbnail');
    const indicators = document.querySelectorAll('.gallery-indicator');
    const prevBtn = document.getElementById('prev-image');
    const nextBtn = document.getElementById('next-image');

    let currentIndex = 0;

    // Handle image load to optimize display
    function handleImageLoad(img) {
        // Hide loading spinner
        const wrapper = img.parentElement;
        const spinner = wrapper.querySelector('.animate-spin');
        if (spinner) {
            spinner.style.display = 'none';
        }

        // Remove any existing fit classes
        img.classList.remove('object-contain', 'object-cover');

        // Check if image dimensions are available
        if (img.naturalWidth && img.naturalHeight) {
            const imgRatio = img.naturalWidth / img.naturalHeight;
            const containerRatio = 9 / 16; // 9:16 ratio

            // If image ratio is close to container ratio, use cover
            // If image is significantly different, use contain
            const ratioDiff = Math.abs(imgRatio - containerRatio);

            if (ratioDiff < 0.3) {
                // Ratio is similar, crop to fill container
                img.classList.add('object-cover');
            } else if (imgRatio < containerRatio) {
                // Image is much taller, crop height
                img.classList.add('object-cover');
            } else {
                // Image is much wider, fit to show full content
                img.classList.add('object-contain');
            }
        } else {
            // Fallback to cover if dimensions not available
            img.classList.add('object-cover');
        }
    }

    function showImage(index) {
        // Update all main images with smooth transitions
        mainImages.forEach((img, i) => {
            if (i === index) {
                // Show current image
                img.classList.remove('translate-x-full', '-translate-x-full', 'opacity-0');
                img.classList.add('translate-x-0', 'opacity-100', 'active');
            } else if (i < index) {
                // Hide previous images (slide left)
                img.classList.remove('translate-x-0', 'opacity-100', 'active');
                img.classList.add('-translate-x-full', 'opacity-0');
            } else {
                // Hide next images (slide right)
                img.classList.remove('translate-x-0', 'opacity-100', 'active');
                img.classList.add('translate-x-full', 'opacity-0');
            }
        });

        // Update thumbnails
        thumbnails.forEach((thumb, i) => {
            if (i === index) {
                thumb.classList.remove('border-gray-300', 'opacity-70');
                thumb.classList.add('border-blue-500', 'opacity-100');
            } else {
                thumb.classList.remove('border-blue-500', 'opacity-100');
                thumb.classList.add('border-gray-300', 'opacity-70');
            }
        });

        // Update indicators
        indicators.forEach((indicator, i) => {
            if (i === index) {
                indicator.classList.remove('bg-gray-300');
                indicator.classList.add('bg-blue-500');
            } else {
                indicator.classList.remove('bg-blue-500');
                indicator.classList.add('bg-gray-300');
            }
        });

        currentIndex = index;

        // Re-process image optimization for the newly active image
        setTimeout(() => {
            const activeImage = mainImages[index];
            if (activeImage) {
                const wrapper = activeImage.parentElement;
                const spinner = wrapper.querySelector('.animate-spin');
                if (activeImage.complete) {
                    // Image already loaded
                    if (spinner) spinner.style.display = 'none';
                    handleImageLoad(activeImage);
                } else {
                    // Image still loading, show spinner
                    if (spinner) spinner.style.display = 'flex';
                    activeImage.addEventListener('load', () => {
                        if (spinner) spinner.style.display = 'none';
                        handleImageLoad(activeImage);
                    });
                }
            }
        }, 100);
    }

    // Thumbnail click handlers
    thumbnails.forEach((thumbnail, index) => {
        thumbnail.addEventListener('click', () => {
            showImage(index);
        });
    });

    // Indicator click handlers
    indicators.forEach((indicator, index) => {
        indicator.addEventListener('click', () => {
            showImage(index);
        });
    });

    // Navigation button handlers
    if (prevBtn && nextBtn) {
        prevBtn.addEventListener('click', () => {
            const newIndex = currentIndex > 0 ? currentIndex - 1 : mainImages.length - 1;
            showImage(newIndex);
        });

        nextBtn.addEventListener('click', () => {
            const newIndex = currentIndex < mainImages.length - 1 ? currentIndex + 1 : 0;
            showImage(newIndex);
        });
    }

    // Keyboard navigation
    document.addEventListener('keydown', (e) => {
        if (mainImages.length > 1) {
            if (e.key === 'ArrowLeft') {
                const newIndex = currentIndex > 0 ? currentIndex - 1 : mainImages.length - 1;
                showImage(newIndex);
            } else if (e.key === 'ArrowRight') {
                const newIndex = currentIndex < mainImages.length - 1 ? currentIndex + 1 : 0;
                showImage(newIndex);
            }
        }
    });

    // Touch/Swipe support for mobile
    let touchStartX = 0;
    let touchStartY = 0;
    let touchEndX = 0;
    let touchEndY = 0;
    const mainImageContainer = document.getElementById('main-image-container');
    let isSwiping = false;

    if (mainImageContainer && mainImages.length > 1) {
        mainImageContainer.addEventListener('touchstart', (e) => {
            touchStartX = e.changedTouches[0].screenX;
            touchStartY = e.changedTouches[0].screenY;
            isSwiping = false;
            // Pause auto-play during touch
            stopAutoPlay();
        });

        mainImageContainer.addEventListener('touchmove', (e) => {
            if (!touchStartX || !touchStartY) return;

            touchEndX = e.changedTouches[0].screenX;
            touchEndY = e.changedTouches[0].screenY;

            const diffX = Math.abs(touchStartX - touchEndX);
            const diffY = Math.abs(touchStartY - touchEndY);

            // Only consider horizontal swipes
            if (diffX > diffY && diffX > 10) {
                isSwiping = true;
                e.preventDefault(); // Prevent scrolling when swiping horizontally
            }
        });

        mainImageContainer.addEventListener('touchend', (e) => {
            if (isSwiping) {
                handleSwipe();
            }
            // Resume auto-play
            startAutoPlay();
        });

        function handleSwipe() {
            const swipeThreshold = 50; // Minimum swipe distance
            const swipeDistance = touchStartX - touchEndX;

            if (Math.abs(swipeDistance) > swipeThreshold) {
                if (swipeDistance > 0) {
                    // Swipe left - next image
                    const newIndex = currentIndex < mainImages.length - 1 ? currentIndex + 1 : 0;
                    showImage(newIndex);
                } else {
                    // Swipe right - previous image
                    const newIndex = currentIndex > 0 ? currentIndex - 1 : mainImages.length - 1;
                    showImage(newIndex);
                }
            }

            // Reset touch coordinates
            touchStartX = 0;
            touchStartY = 0;
            touchEndX = 0;
            touchEndY = 0;
            isSwiping = false;
        }
    }

    // Auto-play functionality (optional)
    let autoPlayInterval;

    function startAutoPlay() {
        if (mainImages.length > 1) {
            autoPlayInterval = setInterval(() => {
                const newIndex = currentIndex < mainImages.length - 1 ? currentIndex + 1 : 0;
                showImage(newIndex);
            }, 4000); // Change image every 4 seconds
        }
    }

    function stopAutoPlay() {
        clearInterval(autoPlayInterval);
    }

    // Pause auto-play on hover
    const galleryContainer = document.querySelector('.card-body');
    if (galleryContainer) {
        galleryContainer.addEventListener('mouseenter', stopAutoPlay);
        galleryContainer.addEventListener('mouseleave', startAutoPlay);
    }

    // Start auto-play
    startAutoPlay();
});
</script>

<?= $this->endSection() ?>