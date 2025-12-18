<?= $this->extend('layout/admin_template') ?>

<?= $this->section('content') ?>

<!-- Welcome Banner -->
<div class="mb-8 bg-gradient-to-r from-blue-600 to-blue-700 rounded-2xl shadow-lg p-8 text-white overflow-hidden relative">
    <div class="absolute top-0 right-0 w-40 h-40 bg-white/10 rounded-full -mr-20 -mt-20"></div>
    <div class="absolute bottom-0 left-0 w-32 h-32 bg-white/10 rounded-full -ml-16 -mb-16"></div>
    <div class="relative z-10">
        <h1 class="text-3xl font-bold mb-2">Selamat datang, Admin! 👋</h1>
        <p class="text-blue-100">Kelola kos dengan mudah melalui dashboard yang intuitif dan informatif</p>
    </div>
</div>

<!-- Statistics Cards Grid -->
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
    <!-- Total Kamar -->
    <div class="group bg-white rounded-2xl shadow-md hover:shadow-2xl transition duration-300 transform hover:-translate-y-1 border border-gray-100 overflow-hidden">
        <div class="bg-gradient-to-br from-blue-50 to-blue-100 p-6 relative">
            <div class="absolute top-0 right-0 w-24 h-24 bg-blue-200/20 rounded-full -mr-12 -mt-12"></div>
            <div class="flex items-center justify-between relative z-10">
                <div>
                    <p class="text-sm font-semibold text-gray-600 mb-1 uppercase tracking-wider">Total Kamar</p>
                    <h3 class="text-4xl font-bold text-gray-900 mb-2"><?= $total_kamar ?></h3>
                    <div class="flex items-center text-xs font-medium">
                        <span class="inline-block w-2 h-2 bg-blue-500 rounded-full mr-2"></span>
                        <span class="text-blue-700"><?= $kamar_tersedia ?> tersedia</span>
                    </div>
                </div>
                <div class="w-20 h-20 bg-gradient-to-br from-blue-500 to-blue-600 rounded-2xl flex items-center justify-center shadow-lg group-hover:scale-110 transition duration-300">
                    <i class="fas fa-door-open text-3xl text-white"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Kamar Terisi -->
    <div class="group bg-white rounded-2xl shadow-md hover:shadow-2xl transition duration-300 transform hover:-translate-y-1 border border-gray-100 overflow-hidden">
        <div class="bg-gradient-to-br from-slate-50 to-slate-100 p-6 relative">
            <div class="absolute top-0 right-0 w-24 h-24 bg-slate-200/20 rounded-full -mr-12 -mt-12"></div>
            <div class="flex items-center justify-between relative z-10">
                <div>
                    <p class="text-sm font-semibold text-gray-600 mb-1 uppercase tracking-wider">Okupansi</p>
                    <h3 class="text-4xl font-bold text-gray-900 mb-2"><?= $kamar_terisi ?>/<?= $total_kamar ?></h3>
                    <div class="flex items-center text-xs font-medium">
                        <span class="inline-block w-2 h-2 bg-slate-500 rounded-full mr-2"></span>
                        <span class="text-slate-700"><?= $total_kamar > 0 ? round(($kamar_terisi / $total_kamar) * 100, 1) : 0 ?>% penuh</span>
                    </div>
                </div>
                <div class="w-20 h-20 bg-gradient-to-br from-slate-500 to-slate-600 rounded-2xl flex items-center justify-center shadow-lg group-hover:scale-110 transition duration-300">
                    <i class="fas fa-chart-pie text-3xl text-white"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Booking Pending -->
    <div class="group bg-white rounded-2xl shadow-md hover:shadow-2xl transition duration-300 transform hover:-translate-y-1 border border-gray-100 overflow-hidden">
        <div class="bg-gradient-to-br from-amber-50 to-amber-100 p-6 relative">
            <div class="absolute top-0 right-0 w-24 h-24 bg-amber-200/20 rounded-full -mr-12 -mt-12"></div>
            <div class="flex items-center justify-between relative z-10">
                <div>
                    <p class="text-sm font-semibold text-gray-600 mb-1 uppercase tracking-wider">Booking Pending</p>
                    <h3 class="text-4xl font-bold text-amber-600 mb-2"><?= $booking_menunggu ?></h3>
                    <div class="flex items-center text-xs font-medium">
                        <span class="inline-block w-2 h-2 bg-amber-500 rounded-full mr-2"></span>
                        <span class="text-amber-700">Perlu verifikasi</span>
                    </div>
                </div>
                <div class="w-20 h-20 bg-gradient-to-br from-amber-500 to-amber-600 rounded-2xl flex items-center justify-center shadow-lg group-hover:scale-110 transition duration-300">
                    <i class="fas fa-hourglass-end text-3xl text-white"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Total Penyewa -->
    <div class="group bg-white rounded-2xl shadow-md hover:shadow-2xl transition duration-300 transform hover:-translate-y-1 border border-gray-100 overflow-hidden">
        <div class="bg-gradient-to-br from-blue-50 to-blue-100 p-6 relative">
            <div class="absolute top-0 right-0 w-24 h-24 bg-blue-200/20 rounded-full -mr-12 -mt-12"></div>
            <div class="flex items-center justify-between relative z-10">
                <div>
                    <p class="text-sm font-semibold text-gray-600 mb-1 uppercase tracking-wider">Total Penyewa</p>
                    <h3 class="text-4xl font-bold text-gray-900 mb-2"><?= $total_penyewa ?></h3>
                    <div class="flex items-center text-xs font-medium">
                        <span class="inline-block w-2 h-2 bg-blue-500 rounded-full mr-2"></span>
                        <span class="text-blue-700">Pengguna aktif</span>
                    </div>
                </div>
                <div class="w-20 h-20 bg-gradient-to-br from-blue-500 to-blue-600 rounded-2xl flex items-center justify-center shadow-lg group-hover:scale-110 transition duration-300">
                    <i class="fas fa-users text-3xl text-white"></i>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Financial Summary Cards -->
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
    <!-- Total Pemasukan Bulan Ini -->
    <div class="group bg-white rounded-2xl shadow-md hover:shadow-2xl transition duration-300 transform hover:-translate-y-1 border border-gray-100 overflow-hidden">
        <div class="bg-gradient-to-br from-green-50 to-green-100 p-6 relative">
            <div class="absolute top-0 right-0 w-24 h-24 bg-green-200/20 rounded-full -mr-12 -mt-12"></div>
            <div class="flex items-center justify-between relative z-10">
                <div>
                    <p class="text-sm font-semibold text-gray-600 mb-1 uppercase tracking-wider">Pemasukan Bulan Ini</p>
                    <h3 class="text-3xl font-bold text-gray-900 mb-2">Rp <?= number_format($total_pemasukan_bulan_ini, 0, ',', '.') ?></h3>
                    <div class="flex items-center text-xs font-medium">
                        <span class="inline-block w-2 h-2 bg-green-500 rounded-full mr-2"></span>
                        <span class="text-green-700"><?= $jumlah_pembayaran_bulan_ini ?> transaksi</span>
                    </div>
                </div>
                <div class="w-20 h-20 bg-gradient-to-br from-green-500 to-green-600 rounded-2xl flex items-center justify-center shadow-lg group-hover:scale-110 transition duration-300">
                    <i class="fas fa-money-bill-wave text-3xl text-white"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Total Pemasukan Tahun Ini -->
    <div class="group bg-white rounded-2xl shadow-md hover:shadow-2xl transition duration-300 transform hover:-translate-y-1 border border-gray-100 overflow-hidden">
        <div class="bg-gradient-to-br from-emerald-50 to-emerald-100 p-6 relative">
            <div class="absolute top-0 right-0 w-24 h-24 bg-emerald-200/20 rounded-full -mr-12 -mt-12"></div>
            <div class="flex items-center justify-between relative z-10">
                <div>
                    <p class="text-sm font-semibold text-gray-600 mb-1 uppercase tracking-wider">Pemasukan Tahun Ini</p>
                    <h3 class="text-3xl font-bold text-gray-900 mb-2">Rp <?= number_format($total_pemasukan_tahun_ini, 0, ',', '.') ?></h3>
                    <div class="flex items-center text-xs font-medium">
                        <span class="inline-block w-2 h-2 bg-emerald-500 rounded-full mr-2"></span>
                        <span class="text-emerald-700">Total <?= date('Y') ?></span>
                    </div>
                </div>
                <div class="w-20 h-20 bg-gradient-to-br from-emerald-500 to-emerald-600 rounded-2xl flex items-center justify-center shadow-lg group-hover:scale-110 transition duration-300">
                    <i class="fas fa-calendar-alt text-3xl text-white"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Rata-rata Per Bulan -->
    <div class="group bg-white rounded-2xl shadow-md hover:shadow-2xl transition duration-300 transform hover:-translate-y-1 border border-gray-100 overflow-hidden">
        <div class="bg-gradient-to-br from-teal-50 to-teal-100 p-6 relative">
            <div class="absolute top-0 right-0 w-24 h-24 bg-teal-200/20 rounded-full -mr-12 -mt-12"></div>
            <div class="flex items-center justify-between relative z-10">
                <div>
                    <p class="text-sm font-semibold text-gray-600 mb-1 uppercase tracking-wider">Rata-rata/Bulan</p>
                    <h3 class="text-3xl font-bold text-gray-900 mb-2">Rp <?= number_format($rata_rata_per_bulan, 0, ',', '.') ?></h3>
                    <div class="flex items-center text-xs font-medium">
                        <span class="inline-block w-2 h-2 bg-teal-500 rounded-full mr-2"></span>
                        <span class="text-teal-700">Prediksi bulanan</span>
                    </div>
                </div>
                <div class="w-20 h-20 bg-gradient-to-br from-teal-500 to-teal-600 rounded-2xl flex items-center justify-center shadow-lg group-hover:scale-110 transition duration-300">
                    <i class="fas fa-chart-line text-3xl text-white"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Total Pemasukan Semua Waktu -->
    <div class="group bg-white rounded-2xl shadow-md hover:shadow-2xl transition duration-300 transform hover:-translate-y-1 border border-gray-100 overflow-hidden">
        <div class="bg-gradient-to-br from-cyan-50 to-cyan-100 p-6 relative">
            <div class="absolute top-0 right-0 w-24 h-24 bg-cyan-200/20 rounded-full -mr-12 -mt-12"></div>
            <div class="flex items-center justify-between relative z-10">
                <div>
                    <p class="text-sm font-semibold text-gray-600 mb-1 uppercase tracking-wider">Total Pemasukan</p>
                    <h3 class="text-3xl font-bold text-gray-900 mb-2">Rp <?= number_format($total_pemasukan_semua, 0, ',', '.') ?></h3>
                    <div class="flex items-center text-xs font-medium">
                        <span class="inline-block w-2 h-2 bg-cyan-500 rounded-full mr-2"></span>
                        <span class="text-cyan-700">Semua waktu</span>
                    </div>
                </div>
                <div class="w-20 h-20 bg-gradient-to-br from-cyan-500 to-cyan-600 rounded-2xl flex items-center justify-center shadow-lg group-hover:scale-110 transition duration-300">
                    <i class="fas fa-coins text-3xl text-white"></i>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Detailed Financial Breakdown -->
<div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
    <!-- Monthly Income Breakdown -->
    <div class="bg-white rounded-2xl shadow-md border border-gray-100 p-6">
        <h3 class="text-lg font-bold text-gray-900 mb-4 flex items-center">
            <i class="fas fa-chart-pie text-green-500 mr-2"></i>Rincian Pemasukan Bulan Ini
        </h3>
        <div class="space-y-4">
            <div class="flex items-center justify-between p-4 bg-gradient-to-r from-blue-50 to-blue-100 rounded-xl border border-blue-200">
                <div class="flex items-center">
                    <div class="w-12 h-12 bg-blue-500 rounded-xl flex items-center justify-center mr-4">
                        <i class="fas fa-home text-white"></i>
                    </div>
                    <div>
                        <p class="font-semibold text-blue-900">Pembayaran Bulanan</p>
                        <p class="text-sm text-blue-700">Sewa rutin kamar</p>
                    </div>
                </div>
                <div class="text-right">
                    <p class="text-2xl font-bold text-blue-600">Rp <?= number_format($pemasukan_bulanan_bulan_ini, 0, ',', '.') ?></p>
                </div>
            </div>

            <div class="flex items-center justify-between p-4 bg-gradient-to-r from-purple-50 to-purple-100 rounded-xl border border-purple-200">
                <div class="flex items-center">
                    <div class="w-12 h-12 bg-purple-500 rounded-xl flex items-center justify-center mr-4">
                        <i class="fas fa-key text-white"></i>
                    </div>
                    <div>
                        <p class="font-semibold text-purple-900">DP/Awal</p>
                        <p class="text-sm text-purple-700">Uang jaminan awal</p>
                    </div>
                </div>
                <div class="text-right">
                    <p class="text-2xl font-bold text-purple-600">Rp <?= number_format($pemasukan_dp_bulan_ini, 0, ',', '.') ?></p>
                </div>
            </div>

            <div class="border-t border-gray-200 pt-4">
                <div class="flex items-center justify-between">
                    <span class="text-lg font-bold text-gray-900">Total Bulan Ini</span>
                    <span class="text-2xl font-bold text-green-600">Rp <?= number_format($total_pemasukan_bulan_ini, 0, ',', '.') ?></span>
                </div>
            </div>
        </div>
    </div>

    <!-- Financial Insights -->
    <div class="bg-white rounded-2xl shadow-md border border-gray-100 p-6">
        <h3 class="text-lg font-bold text-gray-900 mb-4 flex items-center">
            <i class="fas fa-lightbulb text-amber-500 mr-2"></i>Wawasan Keuangan
        </h3>
        <div class="space-y-4">
            <?php
            $persentaseBulanan = $total_pemasukan_bulan_ini > 0 ? (($pemasukan_bulanan_bulan_ini / $total_pemasukan_bulan_ini) * 100) : 0;
            $persentaseDP = $total_pemasukan_bulan_ini > 0 ? (($pemasukan_dp_bulan_ini / $total_pemasukan_bulan_ini) * 100) : 0;
            ?>

            <div class="p-4 bg-gradient-to-r from-amber-50 to-amber-100 rounded-xl border border-amber-200">
                <div class="flex items-start">
                    <i class="fas fa-info-circle text-amber-600 mt-1 mr-3"></i>
                    <div>
                        <p class="font-semibold text-amber-900">Komposisi Pemasukan</p>
                        <p class="text-sm text-amber-800 mt-1">
                            Bulanan: <span class="font-bold"><?= round($persentaseBulanan, 1) ?>%</span> |
                            DP/Awal: <span class="font-bold"><?= round($persentaseDP, 1) ?>%</span>
                        </p>
                    </div>
                </div>
            </div>

            <?php if ($rata_rata_per_bulan > 0): ?>
            <div class="p-4 bg-gradient-to-r from-blue-50 to-blue-100 rounded-xl border border-blue-200">
                <div class="flex items-start">
                    <i class="fas fa-chart-line text-blue-600 mt-1 mr-3"></i>
                    <div>
                        <p class="font-semibold text-blue-900">Performa Bulanan</p>
                        <p class="text-sm text-blue-800 mt-1">
                            <?php
                            $selisih = $total_pemasukan_bulan_ini - $rata_rata_per_bulan;
                            $persentase = $rata_rata_per_bulan > 0 ? (($selisih / $rata_rata_per_bulan) * 100) : 0;
                            if ($selisih > 0) {
                                echo "Bulan ini <span class='font-bold text-green-600'>+" . round($persentase, 1) . "%</span> dari rata-rata";
                            } elseif ($selisih < 0) {
                                echo "Bulan ini <span class='font-bold text-red-600'>" . round($persentase, 1) . "%</span> dari rata-rata";
                            } else {
                                echo "Bulan ini sesuai dengan rata-rata";
                            }
                            ?>
                        </p>
                    </div>
                </div>
            </div>
            <?php endif; ?>

            <div class="p-4 bg-gradient-to-r from-green-50 to-green-100 rounded-xl border border-green-200">
                <div class="flex items-start">
                    <i class="fas fa-trophy text-green-600 mt-1 mr-3"></i>
                    <div>
                        <p class="font-semibold text-green-900">Total Pendapatan</p>
                        <p class="text-sm text-green-800 mt-1">
                            Total pemasukan dari semua transaksi yang telah lunas
                        </p>
                        <p class="text-2xl font-bold text-green-600 mt-2">
                            Rp <?= number_format($total_pemasukan_semua, 0, ',', '.') ?>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Quick Actions & Status Section -->
<div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-8">
    <!-- Quick Actions -->
    <div class="bg-white rounded-2xl shadow-md border border-gray-100 p-6">
        <h3 class="text-lg font-bold text-gray-900 mb-4 flex items-center">
            <i class="fas fa-bolt text-blue-500 mr-2"></i>Aksi Cepat
        </h3>
        <div class="space-y-3">
            <a href="<?= base_url('admin/kamar/create') ?>" class="group flex items-center p-4 bg-gradient-to-r from-blue-50 to-blue-100 hover:from-blue-100 hover:to-blue-200 rounded-xl transition duration-300 border border-blue-200">
                <div class="w-10 h-10 bg-blue-500 rounded-lg flex items-center justify-center mr-3 group-hover:scale-110 transition duration-300">
                    <i class="fas fa-plus text-white"></i>
                </div>
                <span class="font-semibold text-blue-900">Tambah Kamar Baru</span>
            </a>            <a href="<?= base_url('admin/pembayaran/create') ?>" class="group flex items-center p-4 bg-gradient-to-r from-green-50 to-green-100 hover:from-green-100 hover:to-green-200 rounded-xl transition duration-300 border border-green-200">
                <div class="w-10 h-10 bg-green-600 rounded-lg flex items-center justify-center mr-3 group-hover:scale-110 transition duration-300">
                    <i class="fas fa-plus-circle text-white"></i>
                </div>
                <span class="font-semibold text-green-900">Catat Pembayaran</span>
            </a>            <a href="<?= base_url('admin/booking') ?>" class="group flex items-center p-4 bg-gradient-to-r from-blue-50 to-blue-100 hover:from-blue-100 hover:to-blue-200 rounded-xl transition duration-300 border border-blue-200">
                <div class="w-10 h-10 bg-blue-600 rounded-lg flex items-center justify-center mr-3 group-hover:scale-110 transition duration-300">
                    <i class="fas fa-calendar-check text-white"></i>
                </div>
                <span class="font-semibold text-blue-900">Verifikasi Booking</span>
            </a>
            <a href="<?= base_url('admin/pembayaran') ?>" class="group flex items-center p-4 bg-gradient-to-r from-green-50 to-green-100 hover:from-green-100 hover:to-green-200 rounded-xl transition duration-300 border border-green-200">
                <div class="w-10 h-10 bg-green-500 rounded-lg flex items-center justify-center mr-3 group-hover:scale-110 transition duration-300">
                    <i class="fas fa-chart-bar text-white"></i>
                </div>
                <span class="font-semibold text-green-900">Lihat Laporan Keuangan</span>
            </a>
            <a href="<?= base_url('admin/penyewa') ?>" class="group flex items-center p-4 bg-gradient-to-r from-blue-50 to-blue-100 hover:from-blue-100 hover:to-blue-200 rounded-xl transition duration-300 border border-blue-200">
                <div class="w-10 h-10 bg-blue-800 rounded-lg flex items-center justify-center mr-3 group-hover:scale-110 transition duration-300">
                    <i class="fas fa-users text-white"></i>
                </div>
                <span class="font-semibold text-blue-900">Kelola Penyewa</span>
            </a>
        </div>
    </div>

    <!-- System Status -->
    <div class="lg:col-span-2 bg-white rounded-2xl shadow-md border border-gray-100 p-6">
        <h3 class="text-lg font-bold text-gray-900 mb-4 flex items-center">
            <i class="fas fa-heartbeat text-blue-500 mr-2"></i>Status Sistem
        </h3>
        <div class="grid grid-cols-2 gap-3">
            <div class="p-4 bg-gradient-to-br from-blue-50 to-blue-100 rounded-xl border border-blue-200">
                <p class="text-xs font-semibold text-gray-600 mb-1 uppercase">Kamar Total</p>
                <h4 class="text-2xl font-bold text-blue-600"><?= $total_kamar ?></h4>
                <p class="text-xs text-gray-500 mt-1">
                    <i class="fas fa-check-circle text-blue-500 mr-1"></i><?= $kamar_tersedia ?> tersedia
                </p>
            </div>
            <div class="p-4 bg-gradient-to-br from-slate-50 to-slate-100 rounded-xl border border-slate-200">
                <p class="text-xs font-semibold text-gray-600 mb-1 uppercase">Penyewa</p>
                <h4 class="text-2xl font-bold text-slate-600"><?= $total_penyewa ?></h4>
                <p class="text-xs text-gray-500 mt-1">
                    <i class="fas fa-user-check text-slate-500 mr-1"></i>Terdaftar
                </p>
            </div>
            <div class="p-4 bg-gradient-to-br from-amber-50 to-amber-100 rounded-xl border border-amber-200">
                <p class="text-xs font-semibold text-gray-600 mb-1 uppercase">Booking Pending</p>
                <h4 class="text-2xl font-bold text-amber-600"><?= $booking_menunggu ?></h4>
                <p class="text-xs text-gray-500 mt-1">
                    <i class="fas fa-hourglass mr-1 text-amber-500"></i>Menunggu tindakan
                </p>
            </div>
            <div class="p-4 bg-gradient-to-br from-red-50 to-red-100 rounded-xl border border-red-200">
                <p class="text-xs font-semibold text-gray-600 mb-1 uppercase">Pembayaran Pending</p>
                <h4 class="text-2xl font-bold text-red-600"><?= $pembayaran_pending ?></h4>
                <p class="text-xs text-gray-500 mt-1">
                    <i class="fas fa-file-invoice mr-1 text-red-500"></i>Verifikasi
                </p>
            </div>
        </div>
    </div>
</div>

<!-- Recent Bookings Table -->
<div class="bg-white rounded-2xl shadow-md border border-gray-100 overflow-hidden">
    <div class="px-6 py-6 border-b border-gray-200 bg-gradient-to-r from-blue-50 to-slate-50">
        <h3 class="text-lg font-bold text-gray-900 flex items-center">
            <div class="w-10 h-10 bg-blue-600 rounded-xl flex items-center justify-center mr-3">
                <i class="fas fa-list-check text-white"></i>
            </div>
            Booking Terbaru (Status Menunggu)
        </h3>
    </div>
    
    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50 border-b border-gray-200">
                <tr>
                    <th class="px-6 py-4 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">Penyewa</th>
                    <th class="px-6 py-4 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">Kamar</th>
                    <th class="px-6 py-4 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">Tanggal Booking</th>
                    <th class="px-6 py-4 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">Durasi</th>
                    <th class="px-6 py-4 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">Status</th>
                    <th class="px-6 py-4 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">Aksi</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                <?php if (!empty($recent_bookings)): ?>
                    <?php foreach ($recent_bookings as $booking): ?>
                    <tr class="hover:bg-gray-50 transition duration-150">
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center space-x-3">
                                <div class="w-9 h-9 bg-gradient-to-br from-blue-400 to-blue-500 rounded-full flex items-center justify-center flex-shrink-0">
                                    <i class="fas fa-user text-white text-xs font-bold"></i>
                                </div>
                                <span class="font-semibold text-gray-900"><?= esc($booking['username'] ?? 'N/A') ?></span>
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center">
                                <i class="fas fa-door-open text-blue-500 mr-2"></i>
                                <span class="font-medium text-gray-900"><?= esc($booking['nomor_kamar'] ?? 'N/A') ?></span>
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">
                            <i class="fas fa-calendar text-blue-400 mr-2"></i><?= date('d M Y', strtotime($booking['tanggal_booking'])) ?>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center">
                                <i class="fas fa-hourglass-half text-amber-400 mr-2"></i>
                                <span class="font-medium text-gray-900"><?= esc($booking['durasi_sewa_bulan']) ?> Bulan</span>
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="px-3 py-2 inline-flex items-center text-xs leading-5 font-bold rounded-full bg-yellow-100 text-yellow-800 border border-yellow-300">
                                <span class="w-2 h-2 bg-yellow-500 rounded-full mr-2 inline-block"></span>
                                <?= esc($booking['status']) ?>
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                            <a href="<?= base_url('admin/booking') ?>" class="inline-flex items-center px-4 py-2 bg-gradient-to-r from-blue-500 to-blue-600 text-white rounded-lg hover:shadow-lg hover:-translate-y-0.5 transition duration-200 font-semibold">
                                <i class="fas fa-check-circle mr-2 text-sm"></i>Verifikasi
                            </a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="6" class="px-6 py-12 text-center">
                            <div class="flex flex-col items-center justify-center">
                                <i class="fas fa-inbox text-4xl text-gray-300 mb-3"></i>
                                <p class="text-gray-500 font-medium">Tidak ada booking yang perlu diverifikasi</p>
                                <p class="text-gray-400 text-sm mt-1">Semua booking sudah terverifikasi</p>
                            </div>
                        </td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
    
    <div class="px-6 py-4 bg-gradient-to-r from-gray-50 to-gray-100 border-t border-gray-200 flex items-center justify-between">
        <p class="text-sm text-gray-600">
            Menampilkan <span class="font-semibold"><?= count($recent_bookings ?? []) ?></span> booking dengan status menunggu
        </p>
        <a href="<?= base_url('admin/booking') ?>" class="text-blue-600 hover:text-blue-700 font-bold inline-flex items-center group">
            Lihat semua booking
            <i class="fas fa-arrow-right ml-2 group-hover:translate-x-1 transition duration-200"></i>
        </a>
    </div>
</div>

<!-- Recent Payments Table -->
<div class="bg-white rounded-2xl shadow-md border border-gray-100 overflow-hidden">
    <div class="px-6 py-6 border-b border-gray-200 bg-gradient-to-r from-green-50 to-emerald-50">
        <h3 class="text-lg font-bold text-gray-900 flex items-center">
            <div class="w-10 h-10 bg-green-600 rounded-xl flex items-center justify-center mr-3">
                <i class="fas fa-receipt text-white"></i>
            </div>
            Pembayaran Terbaru
        </h3>
    </div>

    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50 border-b border-gray-200">
                <tr>
                    <th class="px-6 py-4 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">Penyewa</th>
                    <th class="px-6 py-4 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">Kamar</th>
                    <th class="px-6 py-4 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">Jenis</th>
                    <th class="px-6 py-4 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">Jumlah</th>
                    <th class="px-6 py-4 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">Tanggal</th>
                    <th class="px-6 py-4 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">Status</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                <?php if (!empty($recent_payments)): ?>
                    <?php foreach ($recent_payments as $payment): ?>
                    <tr class="hover:bg-gray-50 transition duration-150">
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center space-x-3">
                                <div class="w-9 h-9 bg-gradient-to-br from-green-400 to-green-500 rounded-full flex items-center justify-center flex-shrink-0">
                                    <i class="fas fa-user text-white text-xs font-bold"></i>
                                </div>
                                <span class="font-semibold text-gray-900"><?= esc($payment['nama_penyewa'] ?? 'N/A') ?></span>
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center">
                                <i class="fas fa-door-open text-green-500 mr-2"></i>
                                <span class="font-medium text-gray-900"><?= esc($payment['nomor_kamar'] ?? 'N/A') ?></span>
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="px-3 py-1 inline-flex items-center text-xs leading-5 font-semibold rounded-full
                                <?php
                                if ($payment['jenis_pembayaran'] === 'DP/Awal') {
                                    echo 'bg-purple-100 text-purple-800 border border-purple-300';
                                } elseif ($payment['jenis_pembayaran'] === 'Bulanan') {
                                    echo 'bg-blue-100 text-blue-800 border border-blue-300';
                                } else {
                                    echo 'bg-gray-100 text-gray-800 border border-gray-300';
                                }
                                ?>">
                                <?= esc($payment['jenis_pembayaran']) ?>
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="font-bold text-green-600">Rp <?= number_format($payment['jumlah'], 0, ',', '.') ?></span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">
                            <i class="fas fa-calendar text-green-400 mr-2"></i><?= date('d M Y', strtotime($payment['tanggal_bayar'])) ?>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <?php
                            $statusClass = '';
                            $statusIcon = '';
                            if ($payment['status'] === 'Lunas') {
                                $statusClass = 'bg-green-100 text-green-800 border border-green-300';
                                $statusIcon = 'fa-check-circle';
                            } elseif ($payment['status'] === 'Menunggu Verifikasi') {
                                $statusClass = 'bg-yellow-100 text-yellow-800 border border-yellow-300';
                                $statusIcon = 'fa-hourglass-half';
                            } elseif ($payment['status'] === 'Ditolak') {
                                $statusClass = 'bg-red-100 text-red-800 border border-red-300';
                                $statusIcon = 'fa-times-circle';
                            }
                            ?>
                            <span class="px-3 py-2 inline-flex items-center text-xs leading-5 font-bold rounded-full <?= $statusClass ?>">
                                <i class="fas <?= $statusIcon ?> mr-2"></i>
                                <?= esc($payment['status']) ?>
                            </span>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="6" class="px-6 py-12 text-center">
                            <div class="flex flex-col items-center justify-center">
                                <i class="fas fa-receipt text-4xl text-gray-300 mb-3"></i>
                                <p class="text-gray-500 font-medium">Belum ada pembayaran</p>
                                <p class="text-gray-400 text-sm mt-1">Pembayaran akan muncul di sini setelah ada transaksi</p>
                            </div>
                        </td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

    <div class="px-6 py-4 bg-gradient-to-r from-gray-50 to-gray-100 border-t border-gray-200 flex items-center justify-between">
        <p class="text-sm text-gray-600">
            Menampilkan <span class="font-semibold"><?= count($recent_payments ?? []) ?></span> pembayaran terbaru
        </p>
        <a href="<?= base_url('admin/pembayaran') ?>" class="text-green-600 hover:text-green-700 font-bold inline-flex items-center group">
            Lihat semua pembayaran
            <i class="fas fa-arrow-right ml-2 group-hover:translate-x-1 transition duration-200"></i>
        </a>
    </div>
</div>

<?= $this->endSection() ?>