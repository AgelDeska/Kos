<?= $this->extend('layout/admin_template') ?>

<?= $this->section('content') ?>

<!-- Header -->
<div class="mb-8">
    <div class="flex flex-col md:flex-row md:items-center md:justify-between">
        <div>
            <h2 class="text-3xl font-bold text-gray-900 flex items-center">
                <i class="fas fa-users text-blue-600 mr-3"></i>Kelola Penyewa
            </h2>
            <p class="text-gray-600 mt-1">Manage status akun penyewa dan informasi pengguna</p>
        </div>
        <a href="<?= base_url('admin/penyewa/create') ?>" class="btn btn-primary btn-sm mt-4 md:mt-0 inline-flex items-center">
            <i class="fas fa-plus"></i> Tambah Penyewa Baru
        </a>
    </div>
</div>

<!-- Search & Filter Section -->
<div class="mb-6 bg-white rounded-xl shadow-md border border-gray-100 p-6">
    <form method="GET" action="<?= base_url('admin/penyewa') ?>" class="space-y-4">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-4 items-end">
            <!-- Search Input -->
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">
                    <i class="fas fa-search text-blue-600 mr-2"></i>Cari Penyewa
                </label>
                <input type="text" name="search" value="<?= esc($search) ?>" placeholder="Nama, email, atau username..." 
                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition">
            </div>

            <!-- Status Filter -->
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">
                    <i class="fas fa-filter text-blue-600 mr-2"></i>Status Akun
                </label>
                <select name="status" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition">
                    <option value="">Semua Status</option>
                    <option value="1" <?= $status === '1' ? 'selected' : '' ?>>Aktif</option>
                    <option value="0" <?= $status === '0' ? 'selected' : '' ?>>Nonaktif</option>
                </select>
            </div>

            <!-- Sort By -->
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">
                    <i class="fas fa-arrow-up-down text-blue-600 mr-2"></i>Urutkan Berdasarkan
                </label>
                <select name="sortBy" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition">
                    <option value="nama" <?= $sortBy === 'nama' ? 'selected' : '' ?>>Nama</option>
                    <option value="email" <?= $sortBy === 'email' ? 'selected' : '' ?>>Email</option>
                    <option value="username" <?= $sortBy === 'username' ? 'selected' : '' ?>>Username</option>
                    <option value="tanggal_masuk" <?= $sortBy === 'tanggal_masuk' ? 'selected' : '' ?>>Tanggal Masuk</option>
                    <option value="is_active" <?= $sortBy === 'is_active' ? 'selected' : '' ?>>Status</option>
                </select>
            </div>

            <!-- Sort Order -->
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">
                    <i class="fas fa-sort text-blue-600 mr-2"></i>Urutan
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
            <a href="<?= base_url('admin/penyewa') ?>" class="inline-flex items-center px-6 py-2 bg-gray-200 hover:bg-gray-300 text-gray-800 font-semibold rounded-lg transition">
                <i class="fas fa-redo mr-2"></i>Reset
            </a>
        </div>
    </form>
</div>

<!-- Management Card -->
<div class="card">
    <div class="card-header flex items-center justify-between">
        <div class="flex items-center">
            <i class="fas fa-table text-blue-600 text-xl mr-3"></i>
            <h3 class="text-lg font-bold text-gray-900">Daftar Penyewa</h3>
            <span class="ml-3 px-3 py-1 bg-blue-200 text-blue-800 rounded-full text-sm font-semibold">
                <?= count($penyewas ?? []) ?> Penyewa
            </span>
        </div>
    </div>
    <div class="card-body overflow-x-auto">
        <table class="table-styled w-full">
            <thead>
                <tr class="bg-gray-50 border-b border-gray-200">
                    <th class="px-6 py-3 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">ID</th>
                    <th class="px-6 py-3 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">Nama</th>
                    <th class="px-6 py-3 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">Email</th>
                    <th class="px-6 py-3 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">Username</th>
                    <th class="px-6 py-3 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">Status</th>
                    <th class="px-6 py-3 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">Tgl Masuk</th>
                    <th class="px-6 py-3 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                <?php if (empty($penyewas)): ?>
                    <tr>
                        <td colspan="7" class="px-6 py-12 text-center">
                            <div class="flex flex-col items-center justify-center">
                                <i class="fas fa-inbox text-4xl text-gray-300 mb-3"></i>
                                <p class="text-gray-500 font-medium">Belum ada data penyewa yang tercatat</p>
                                <p class="text-gray-400 text-sm">Penyewa akan muncul di sini setelah mendaftar</p>
                            </div>
                        </td>
                    </tr>
                <?php else: ?>
                    <?php foreach ($penyewas as $user): ?>
                    <tr class="hover:bg-gray-50 transition">
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="text-sm font-semibold text-gray-700">#<?= esc($user['user_id']) ?></span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center">
                                <div class="w-10 h-10 bg-gradient-to-br from-blue-400 to-blue-600 rounded-full flex items-center justify-center text-white font-bold">
                                    <?= substr(esc($user['nama']), 0, 1) ?>
                                </div>
                                <span class="ml-3 text-sm font-semibold text-gray-900"><?= esc($user['nama']) ?></span>
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <a href="mailto:<?= esc($user['email']) ?>" class="text-sm text-blue-600 hover:text-blue-800 hover:underline">
                                <?= esc($user['email']) ?>
                            </a>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <code class="bg-gray-100 text-gray-800 px-2 py-1 rounded text-sm"><?= esc($user['username']) ?></code>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <?php if ($user['is_active'] == 1): ?>
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-semibold bg-green-100 text-green-800">
                                    <i class="fas fa-check-circle mr-1"></i>Aktif
                                </span>
                            <?php else: ?>
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-semibold bg-red-100 text-red-800">
                                    <i class="fas fa-times-circle mr-1"></i>Nonaktif
                                </span>
                            <?php endif; ?>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="text-sm text-gray-600"><?= esc($user['tanggal_masuk'] ?? '-') ?></span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium space-x-2 flex">
                            <a href="<?= base_url('admin/penyewa/toggle/' . esc($user['user_id'])) ?>" data-confirm="Ubah status akun penyewa ini?" class="btn btn-sm <?= $user['is_active'] == 1 ? 'btn-danger' : 'btn btn-primary' ?> inline-flex items-center" title="Ubah Status">
                                <i class="fas fa-power-off"></i>
                            </a>
                            <a href="<?= base_url('admin/penyewa/edit/' . esc($user['user_id'])) ?>" class="btn btn-ghost btn-sm inline-flex items-center" title="Edit Penyewa">
                                <i class="fas fa-edit"></i>
                            </a>
                            <a href="<?= base_url('admin/penyewa/delete/' . esc($user['user_id'])) ?>" data-confirm="Yakin ingin menghapus penyewa <?= esc($user['nama']) ?>? Data terkait mungkin ikut terhapus!" class="btn btn-danger btn-sm inline-flex items-center" title="Hapus Penyewa">
                                <i class="fas fa-trash"></i>
                            </a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<?= $this->endSection() ?>