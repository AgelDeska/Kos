<?= $this->extend('layout/admin_template') ?>

<?= $this->section('content') ?>

<!-- Header -->
<div class="mb-8 flex items-center justify-between">
    <div>
        <h2 class="text-3xl font-bold text-gray-900 flex items-center">
            <i class="fas fa-credit-card text-green-600 mr-3"></i>Kelola Pembayaran
        </h2>
        <p class="text-gray-600 mt-1">Verifikasi dan kelola transaksi pembayaran penyewa</p>
    </div>
    <a href="<?= base_url('admin/pembayaran/create') ?>" class="btn btn-primary btn-sm inline-flex items-center">
        <i class="fas fa-plus-circle"></i> Catat Pembayaran Manual
    </a>
</div>

<!-- Search & Filter Section -->
<div class="mb-6 bg-white rounded-xl shadow-md border border-gray-100 p-6">
    <form method="GET" action="<?= base_url('admin/pembayaran') ?>" class="space-y-4">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-4 items-end">
            <!-- Search Input -->
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">
                    <i class="fas fa-search text-blue-600 mr-2"></i>Cari Pembayaran
                </label>
                <input type="text" name="search" value="<?= esc($search) ?>" placeholder="Nama penyewa, kamar, atau jenis..." 
                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition">
            </div>

            <!-- Status Filter -->
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">
                    <i class="fas fa-filter text-purple-600 mr-2"></i>Status Pembayaran
                </label>
                <select name="status" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent transition">
                    <option value="">Semua Status</option>
                    <option value="Menunggu Verifikasi" <?= $status === 'Menunggu Verifikasi' ? 'selected' : '' ?>>Menunggu Verifikasi</option>
                    <option value="Lunas" <?= $status === 'Lunas' ? 'selected' : '' ?>>Lunas</option>
                    <option value="Ditolak" <?= $status === 'Ditolak' ? 'selected' : '' ?>>Ditolak</option>
                </select>
            </div>

            <!-- Sort By -->
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">
                    <i class="fas fa-arrow-up-down text-green-600 mr-2"></i>Urutkan Berdasarkan
                </label>
                <select name="sortBy" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent transition">
                    <option value="tanggal_bayar" <?= $sortBy === 'tanggal_bayar' ? 'selected' : '' ?>>Tanggal Pembayaran</option>
                    <option value="jumlah" <?= $sortBy === 'jumlah' ? 'selected' : '' ?>>Jumlah</option>
                    <option value="username" <?= $sortBy === 'username' ? 'selected' : '' ?>>Nama Penyewa</option>
                    <option value="status" <?= $sortBy === 'status' ? 'selected' : '' ?>>Status</option>
                </select>
            </div>

            <!-- Sort Order -->
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">
                    <i class="fas fa-sort text-orange-600 mr-2"></i>Urutan
                </label>
                <div class="flex gap-2">
                    <button type="submit" name="sortOrder" value="ASC" class="flex-1 px-4 py-2 <?= $sortOrder === 'ASC' ? 'bg-blue-600 text-white' : 'bg-gray-100 text-gray-700' ?> rounded-lg hover:bg-blue-600 hover:text-white transition font-semibold">
                        <i class="fas fa-arrow-up mr-1"></i>Naik
                    </button>
                    <button type="submit" name="sortOrder" value="DESC" class="flex-1 px-4 py-2 <?= $sortOrder === 'DESC' ? 'bg-blue-600 text-white' : 'bg-gray-100 text-gray-700' ?> rounded-lg hover:bg-blue-600 hover:text-white transition font-semibold">
                        <i class="fas fa-arrow-down mr-1"></i>Turun
                    </button>
                </div>
            </div>
        </div>

        <!-- Action Buttons -->
        <div class="flex gap-3 pt-2">
            <button type="submit" class="inline-flex items-center px-6 py-2 bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800 text-white font-semibold rounded-lg transition">
                <i class="fas fa-search mr-2"></i>Terapkan Filter
            </button>
            <a href="<?= base_url('admin/pembayaran') ?>" class="inline-flex items-center px-6 py-2 bg-gray-200 hover:bg-gray-300 text-gray-800 font-semibold rounded-lg transition">
                <i class="fas fa-redo mr-2"></i>Reset
            </a>
        </div>
    </form>
</div>

<!-- Payment Table Card -->
<div class="card">
    <div class="card-header flex items-center justify-between">
        <div class="flex items-center">
            <i class="fas fa-receipt text-green-600 text-xl mr-3"></i>
            <h3 class="text-lg font-bold text-gray-900">Daftar Transaksi Pembayaran</h3>
            <span class="ml-3 px-3 py-1 bg-green-200 text-green-800 rounded-full text-sm font-semibold">
                <?= count($pembayarans ?? []) ?> Transaksi
            </span>
        </div>
    </div>
    <div class="card-body overflow-x-auto">
        <table class="table-styled w-full">
            <thead>
                <tr class="bg-gray-50 border-b border-gray-200">
                    <th class="px-6 py-3 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">ID</th>
                    <th class="px-6 py-3 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">Penyewa</th>
                    <th class="px-6 py-3 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">Kamar</th>
                    <th class="px-6 py-3 text-right text-xs font-bold text-gray-700 uppercase tracking-wider">Jumlah</th>
                    <th class="px-6 py-3 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">Jenis</th>
                    <th class="px-6 py-3 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">Tgl Bayar</th>
                    <th class="px-6 py-3 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">Status</th>
                    <th class="px-6 py-3 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                <?php if (empty($pembayarans)): ?>
                    <tr>
                        <td colspan="8" class="px-6 py-12 text-center">
                            <div class="flex flex-col items-center justify-center">
                                <i class="fas fa-inbox text-4xl text-gray-300 mb-3"></i>
                                <p class="text-gray-500 font-medium">Tidak ada data pembayaran yang tercatat</p>
                                <p class="text-gray-400 text-sm">Data pembayaran akan muncul di sini</p>
                            </div>
                        </td>
                    </tr>
                <?php else: ?>
                    <?php foreach ($pembayarans as $p): ?>
                    <tr class="hover:bg-gray-50 transition">
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="text-sm font-semibold text-gray-700">#<?= esc($p['pembayaran_id']) ?></span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center">
                                <div class="w-8 h-8 bg-gradient-to-br from-green-400 to-green-600 rounded-full flex items-center justify-center text-white text-xs font-bold">
                                    <?= substr(esc($p['username']), 0, 1) ?>
                                </div>
                                <span class="ml-2 text-sm font-semibold text-gray-900"><?= esc($p['username']) ?></span>
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="inline-flex items-center px-2 py-1 rounded-lg bg-gray-100 text-gray-800 text-sm font-semibold">
                                <i class="fas fa-door-open mr-1"></i><?= esc($p['nomor_kamar']) ?>
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-right">
                            <span class="text-sm font-bold text-green-700">Rp <?= number_format(esc($p['jumlah']), 0, ',', '.') ?></span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-semibold bg-gray-100 text-gray-800">
                                <?= esc($p['jenis_pembayaran']) ?>
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">
                            <?= date('d M Y', strtotime(esc($p['tanggal_bayar']))) ?>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <?php 
                                $statusClass = $p['status'] == 'Menunggu Verifikasi' ? 'bg-yellow-100 text-yellow-800' : 
                                              ($p['status'] == 'Lunas' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800');
                                $statusIcon = $p['status'] == 'Menunggu Verifikasi' ? 'fa-hourglass-half' : 
                                             ($p['status'] == 'Lunas' ? 'fa-check-circle' : 'fa-times-circle');
                            ?>
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-semibold <?= $statusClass ?>">
                                <i class="fas <?= $statusIcon ?> mr-1"></i><?= esc($p['status']) ?>
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <?php if ($p['status'] == 'Menunggu Verifikasi'): ?>
                                    <div class="flex gap-2">
                                        <form id="verify-form-<?= esc($p['pembayaran_id']) ?>-lunas" action="<?= base_url('admin/pembayaran/verify/' . esc($p['pembayaran_id'])) ?>" method="post" class="inline">
                                            <?= csrf_field() ?>
                                            <input type="hidden" name="action" value="lunas">
                                        </form>
                                        <button data-target="#verify-form-<?= esc($p['pembayaran_id']) ?>-lunas" data-confirm="Verifikasi pembayaran sebagai Lunas?" class="btn btn-primary btn-sm"> <i class="fas fa-check mr-1"></i> Lunas</button>

                                        <form id="verify-form-<?= esc($p['pembayaran_id']) ?>-tolak" action="<?= base_url('admin/pembayaran/verify/' . esc($p['pembayaran_id'])) ?>" method="post" class="inline">
                                            <?= csrf_field() ?>
                                            <input type="hidden" name="action" value="tolak">
                                        </form>
                                        <button data-target="#verify-form-<?= esc($p['pembayaran_id']) ?>-tolak" data-confirm="Tolak pembayaran ini?" class="btn btn-ghost btn-sm"> <i class="fas fa-times mr-1"></i> Tolak</button>
                                    </div>
                                <?php else: ?>
                                    <a href="<?= base_url('admin/pembayaran/delete/' . esc($p['pembayaran_id'])) ?>" data-confirm="Hapus data pembayaran ini?" class="btn btn-danger btn-sm inline-flex items-center">
                                        <i class="fas fa-trash mr-1"></i>Hapus
                                    </a>
                                <?php endif; ?>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<?= $this->endSection() ?>