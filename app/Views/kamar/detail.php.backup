<?= $this->extend('layout/public_template') ?>

<?= $this->section('content') ?>

<!-- Page Header / Breadcrumb -->
<section class="container" style="padding: 32px 0 8px;">
  <nav class="flex items-center text-sm text-slate-500 gap-2">
    <a href="<?= base_url('/') ?>" class="inline-flex items-center gap-1 text-blue-600 hover:text-blue-700 font-medium"><i class="fas fa-home"></i><span>Beranda</span></a>
    <i class="fas fa-chevron-right text-slate-400"></i>
    <a href="<?= base_url('kamar/katalog') ?>" class="text-blue-600 hover:text-blue-700 font-medium">Katalog</a>
    <i class="fas fa-chevron-right text-slate-400"></i>
    <span class="font-semibold text-slate-700">Kamar <?= esc($kamar['nomor_kamar']) ?></span>
  </nav>
  <div class="mt-4 flex items-end justify-between gap-4">
    <div>
      <h1 class="text-3xl md:text-4xl font-extrabold text-slate-900 tracking-tight">Kamar No. <?= esc($kamar['nomor_kamar']) ?></h1>
      <p class="text-slate-600 mt-1 flex items-center gap-2"><i class="fas fa-door-open text-blue-600"></i>Ruang Nyaman untuk Istirahat & Belajar</p>
    </div>
    <span class="hidden sm:inline-flex bg-blue-100 text-blue-700 px-3 py-1 rounded-full text-sm font-semibold h-8 items-center border border-blue-200">
      <?= esc($kamar['tipe_kamar'] ?? 'Standard') ?>
    </span>
  </div>
</section>

<section class="container" style="padding-top: 24px; padding-bottom: 48px;">
<div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
    <!-- Main Content -->
    <div class="lg:col-span-2">
        <!-- Image Banner -->
        <div class="bg-white rounded-2xl shadow-xl overflow-hidden mb-8 border border-gray-100">
          <div class="relative bg-gray-200 h-96 md:h-[520px] group">
            <img
              id="mainImage"
              src="<?= base_url('img/kamar/' . ($kamar['foto_kamar'] ?? 'placeholder.jpg')) ?>"
              alt="Foto Kamar <?= esc($kamar['nomor_kamar']) ?>"
              class="w-full h-full object-cover transition duration-500 group-hover:scale-[1.03]"
              onerror="this.src='https://via.placeholder.com/1200x800?text=Kamar+<?= esc($kamar['nomor_kamar']) ?>'"
            />
            <div class="absolute inset-0 bg-gradient-to-t from-black/40 via-black/10 to-transparent opacity-0 group-hover:opacity-100 transition duration-500"></div>
            <!-- Status Badge -->
            <div class="absolute top-4 left-4 z-10">
              <?php 
                if ($kamar['status'] == 'Tersedia') { $badgeClass = 'bg-emerald-100 text-emerald-800 border border-emerald-300'; $icon = 'fa-check-circle'; }
                elseif ($kamar['status'] == 'Di Booking') { $badgeClass = 'bg-amber-100 text-amber-800 border border-amber-300'; $icon = 'fa-hourglass-half'; }
                else { $badgeClass = 'bg-rose-100 text-rose-800 border border-rose-300'; $icon = 'fa-times-circle'; }
              ?>
              <span class="px-4 py-2 <?= $badgeClass ?> rounded-full font-semibold text-sm inline-flex items-center shadow-lg backdrop-blur-sm">
                <i class="fas <?= $icon ?> mr-1"></i><?= esc($kamar['status']) ?>
              </span>
            </div>
          </div>
        </div>

        <!-- Room Info Card -->
        <div class="bg-white rounded-2xl shadow-lg p-8 mb-8 border border-gray-100">
          <!-- Quick Stats -->
          <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 mb-6">
            <div class="rounded-xl border border-slate-200 p-4 text-center hover:shadow-md transition">
              <div class="bg-blue-100 w-12 h-12 rounded-full flex items-center justify-center mx-auto mb-2">
                <i class="fas fa-users text-blue-600 text-lg"></i>
              </div>
              <p class="text-sm text-slate-600">Kapasitas</p>
              <p class="font-bold text-slate-900 text-lg"><?= esc($kamar['kapasitas']) ?> orang</p>
            </div>
            <div class="rounded-xl border border-slate-200 p-4 text-center hover:shadow-md transition">
              <div class="bg-green-100 w-12 h-12 rounded-full flex items-center justify-center mx-auto mb-2">
                <i class="fas fa-ruler text-green-600 text-lg"></i>
              </div>
              <p class="text-sm text-slate-600">Luas</p>
              <p class="font-bold text-slate-900 text-lg">3 x 4 m²</p>
            </div>
            <div class="rounded-xl border border-slate-200 p-4 text-center hover:shadow-md transition">
              <div class="bg-purple-100 w-12 h-12 rounded-full flex items-center justify-center mx-auto mb-2">
                <i class="fas fa-star text-purple-600 text-lg"></i>
              </div>
              <p class="text-sm text-slate-600">Rating</p>
              <p class="font-bold text-slate-900 text-lg"><i class="fas fa-star text-yellow-400 mr-1"></i>4.8/5</p>
            </div>
          </div>

          <!-- Description -->
          <div>
            <h3 class="text-xl font-bold text-slate-900 mb-3"><i class="fas fa-align-left text-blue-600 mr-2"></i>Deskripsi Kamar</h3>
            <p class="text-slate-700 leading-relaxed text-base"><?= nl2br(esc($kamar['deskripsi'])) ?></p>
          </div>
        </div>

        <!-- Facilities Section -->
        <div class="bg-white rounded-2xl shadow-lg p-8 mb-8 border border-gray-100">
          <h3 class="text-2xl font-bold text-slate-900 mb-6"><i class="fas fa-star text-amber-500 mr-2"></i>Fasilitas & Fitur Kamar</h3>
          <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div class="flex items-center p-4 rounded-xl border border-emerald-200 bg-emerald-50/70 hover:bg-white hover:shadow-md transition">
              <div class="bg-emerald-200 w-12 h-12 rounded-lg flex items-center justify-center mr-4 flex-shrink-0"><i class="fas fa-water text-emerald-700 text-lg"></i></div>
              <div><p class="text-slate-900 font-semibold">Kamar Mandi Dalam</p><p class="text-slate-600 text-xs">Dengan air panas</p></div>
            </div>
            <div class="flex items-center p-4 rounded-xl border border-blue-200 bg-blue-50/70 hover:bg-white hover:shadow-md transition">
              <div class="bg-blue-200 w-12 h-12 rounded-lg flex items-center justify-center mr-4 flex-shrink-0"><i class="fas fa-wind text-blue-700 text-lg"></i></div>
              <div><p class="text-slate-900 font-semibold">AC & Kipas Angin</p><p class="text-slate-600 text-xs">Pendingin ruangan optimal</p></div>
            </div>
            <div class="flex items-center p-4 rounded-xl border border-purple-200 bg-purple-50/70 hover:bg-white hover:shadow-md transition">
              <div class="bg-purple-200 w-12 h-12 rounded-lg flex items-center justify-center mr-4 flex-shrink-0"><i class="fas fa-cabinet-filing text-purple-700 text-lg"></i></div>
              <div><p class="text-slate-900 font-semibold">Lemari & Meja Belajar</p><p class="text-slate-600 text-xs">Ruang penyimpanan lengkap</p></div>
            </div>
            <div class="flex items-center p-4 rounded-xl border border-amber-200 bg-amber-50/70 hover:bg-white hover:shadow-md transition">
              <div class="bg-amber-200 w-12 h-12 rounded-lg flex items-center justify-center mr-4 flex-shrink-0"><i class="fas fa-wifi text-amber-700 text-lg"></i></div>
              <div><p class="text-slate-900 font-semibold">Wi-Fi Cepat Gratis</p><p class="text-slate-600 text-xs">Kecepatan hingga 100 Mbps</p></div>
            </div>
            <div class="flex items-center p-4 rounded-xl border border-rose-200 bg-rose-50/70 hover:bg-white hover:shadow-md transition">
              <div class="bg-rose-200 w-12 h-12 rounded-lg flex items-center justify-center mr-4 flex-shrink-0"><i class="fas fa-bed text-rose-700 text-lg"></i></div>
              <div><p class="text-slate-900 font-semibold">Kasur & Bantal</p><p class="text-slate-600 text-xs">Kualitas premium</p></div>
            </div>
            <div class="flex items-center p-4 rounded-xl border border-indigo-200 bg-indigo-50/70 hover:bg-white hover:shadow-md transition">
              <div class="bg-indigo-200 w-12 h-12 rounded-lg flex items-center justify-center mr-4 flex-shrink-0"><i class="fas fa-broom text-indigo-700 text-lg"></i></div>
              <div><p class="text-slate-900 font-semibold">Cleaning Service</p><p class="text-slate-600 text-xs">2x per minggu</p></div>
            </div>
          </div>
        </div>

        <!-- Rules & Information -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
          <div class="bg-gradient-to-br from-blue-50 to-blue-100 rounded-2xl shadow-lg p-6 border border-blue-200">
            <h4 class="font-bold text-slate-900 mb-4 flex items-center"><i class="fas fa-book text-blue-600 mr-2"></i>Aturan Kamar</h4>
            <ul class="space-y-2 text-sm text-slate-700">
              <li class="flex items-start"><i class="fas fa-check text-blue-600 mr-2 mt-1 flex-shrink-0"></i><span>Jam malam pukul 22:00 - 06:00</span></li>
              <li class="flex items-start"><i class="fas fa-check text-blue-600 mr-2 mt-1 flex-shrink-0"></i><span>Tidak boleh membawa hewan peliharaan</span></li>
              <li class="flex items-start"><i class="fas fa-check text-blue-600 mr-2 mt-1 flex-shrink-0"></i><span>Menjaga kebersihan kamar & area umum</span></li>
              <li class="flex items-start"><i class="fas fa-check text-blue-600 mr-2 mt-1 flex-shrink-0"></i><span>Dilarang merokok di dalam kamar</span></li>
            </ul>
          </div>
          <div class="bg-gradient-to-br from-amber-50 to-amber-100 rounded-2xl shadow-lg p-6 border border-amber-200">
            <h4 class="font-bold text-slate-900 mb-4 flex items-center"><i class="fas fa-info-circle text-amber-600 mr-2"></i>Informasi Penting</h4>
            <ul class="space-y-2 text-sm text-slate-700">
              <li class="flex items-start"><i class="fas fa-arrow-right text-amber-600 mr-2 mt-1 flex-shrink-0"></i><span>Booking minimal 1 bulan</span></li>
              <li class="flex items-start"><i class="fas fa-arrow-right text-amber-600 mr-2 mt-1 flex-shrink-0"></i><span>Pembayaran DP 50% saat booking</span></li>
              <li class="flex items-start"><i class="fas fa-arrow-right text-amber-600 mr-2 mt-1 flex-shrink-0"></i><span>Kontrak disimpan 30 hari sebelum checkout</span></li>
              <li class="flex items-start"><i class="fas fa-arrow-right text-amber-600 mr-2 mt-1 flex-shrink-0"></i><span>Deposit keamanan 2 juta rupiah</span></li>
            </ul>
          </div>
        </div>
    </div>

    <!-- Sidebar: Booking Card -->
    <div class="lg:col-span-1">
      <div class="sticky top-24">
        <!-- Price Card -->
        <div class="bg-gradient-to-br from-blue-600 via-blue-600 to-blue-700 rounded-2xl shadow-2xl overflow-hidden mb-6 text-white border border-blue-400">
          <div class="p-8">
            <p class="text-blue-100 text-sm font-medium mb-2"><i class="fas fa-tag mr-2"></i>Harga per Bulan</p>
            <h2 class="text-5xl font-black mb-1">Rp <?= number_format(esc($kamar['harga']), 0, ',', '.') ?></h2>
            <p class="text-blue-100 text-sm">*Pembayaran pertama (DP 50%)</p>
          </div>
          <div class="bg-blue-700/50 px-8 py-4 border-t border-blue-500/30">
            <div class="flex items-center justify-between">
              <span class="text-sm">DP Awal</span>
              <span class="font-bold">Rp <?= number_format(esc($kamar['harga']) / 2, 0, ',', '.') ?></span>
            </div>
          </div>
        </div>

        <!-- Booking Button & Info -->
        <div class="bg-white rounded-2xl shadow-xl border border-gray-100 overflow-hidden mb-6">
          <div class="p-6 space-y-4">
            <?php if ($kamar['status'] == 'Tersedia'): ?>
              <?php if (session()->get('isLoggedIn') && strtolower(session()->get('role')) == 'penyewa'): ?>
                <a href="<?= base_url('penyewa/booking/' . esc($kamar['kamar_id'])) ?>" class="w-full block text-center bg-gradient-to-r from-emerald-500 to-emerald-600 hover:from-emerald-600 hover:to-emerald-700 text-white font-bold py-4 px-4 rounded-xl transition duration-300 transform hover:scale-105 shadow-lg hover:shadow-xl">
                  <i class="fas fa-calendar-check mr-2"></i>Booking Sekarang
                </a>
              <?php else: ?>
                <a href="<?= base_url('login') ?>" class="w-full block text-center bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800 text-white font-bold py-4 px-4 rounded-xl transition duration-300 transform hover:scale-105 shadow-lg hover:shadow-xl">
                  <i class="fas fa-sign-in-alt mr-2"></i>Login untuk Booking
                </a>
              <?php endif; ?>
            <?php else: ?>
              <button disabled class="w-full bg-gray-300 text-gray-500 font-bold py-4 px-4 rounded-xl cursor-not-allowed opacity-75">
                <i class="fas fa-lock mr-2"></i>Status: <?= esc($kamar['status']) ?>
              </button>
              <p class="text-center text-gray-600 text-sm font-medium">
                <i class="fas fa-exclamation-triangle mr-1"></i>Kamar tidak tersedia untuk booking saat ini.
              </p>
            <?php endif; ?>

            <div class="bg-gradient-to-br from-blue-50 to-cyan-50 p-4 rounded-xl border border-blue-200 space-y-3 text-sm">
              <div class="flex items-start space-x-3">
                <i class="fas fa-lightbulb text-blue-600 mt-0.5 flex-shrink-0"></i>
                <div>
                  <p class="font-semibold text-gray-900">Proses Booking Mudah</p>
                  <p class="text-gray-600 text-xs mt-1">Klik booking, isi data, transfer DP, dan kamar siap dihuni!</p>
                </div>
              </div>
            </div>

            <a href="<?= base_url('kamar/katalog') ?>" class="w-full block text-center border-2 border-gray-300 hover:border-blue-600 hover:bg-blue-50 text-gray-700 hover:text-blue-600 font-semibold py-3 px-4 rounded-xl transition">
              <i class="fas fa-arrow-left mr-2"></i>Kembali ke Katalog
            </a>
          </div>
        </div>

        <!-- Contact Card -->
        <div class="bg-gradient-to-br from-purple-50 to-pink-50 rounded-2xl shadow-lg p-6 border border-purple-200">
          <h4 class="font-bold text-gray-900 mb-4 flex items-center"><i class="fas fa-phone text-purple-600 mr-2"></i>Hubungi Admin</h4>
          <div class="space-y-3 text-sm">
            <p class="flex items-center text-gray-700"><i class="fas fa-mobile-alt text-green-600 mr-3 w-4"></i><span class="font-medium">+62 812 3456 7890</span></p>
            <p class="flex items-center text-gray-700"><i class="fas fa-envelope text-red-600 mr-3 w-4"></i><span class="font-medium text-sm">admin@smartkos.id</span></p>
            <p class="flex items-center text-gray-700"><i class="fas fa-clock text-amber-600 mr-3 w-4"></i><span class="text-xs">08:00 - 21:00 WIB</span></p>
          </div>
        </div>
      </div>
    </div>
</div>
</section>

<?= $this->endSection() ?>