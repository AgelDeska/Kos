<?= $this->extend('layout/public_template') ?>

<?= $this->section('content') ?>
<section class="container" style="padding-top:48px; padding-bottom:48px;">
  <h2 class="section-title">Daftar Pengguna</h2>
  <p class="section-subtitle">Lihat profil singkat semua pengguna terdaftar di sistem. Klik kartu untuk melihat detail lengkap.</p>

  <div class="" style="margin-top:28px;">
    <div class="gallery-grid" style="display:grid; grid-template-columns: repeat(auto-fit, minmax(260px, 1fr)); gap:20px;">
      <?php if (!empty($users)): ?>
        <?php foreach ($users as $u): ?>
          <a href="<?= base_url('users/' . $u['user_id']) ?>" class="card" style="display:block; text-decoration:none; color:inherit;">
            <div style="display:flex; align-items:center; gap:16px;">
              <div style="width:72px; height:72px; border-radius:999px; background:linear-gradient(135deg,#60a5fa,#3b82f6); display:flex; align-items:center; justify-content:center; color:#fff; font-weight:700; font-size:22px;">
                <?= strtoupper(substr($u['nama'] ?? $u['username'], 0, 1)) ?>
              </div>
              <div style="flex:1;">
                <h3 style="margin:0; font-size:18px; font-weight:700;"><?= esc($u['nama'] ?? $u['username']) ?></h3>
                <p style="margin:6px 0 0; color:var(--muted-color); font-size:14px;"><?= esc($u['role']) ?> • <?= ($u['is_active']) ? '<span style="color:#10b981; font-weight:600;">Aktif</span>' : '<span style="color:#ef4444; font-weight:600;">Non-aktif</span>' ?></p>
                <p style="margin:8px 0 0; color:var(--muted-color); font-size:13px;"><?= esc($u['email']) ?></p>
              </div>
            </div>
            <div style="margin-top:12px; display:flex; gap:12px; align-items:center; justify-content:space-between;">
              <small style="color:var(--muted-color);">Bergabung: <?= date('d M Y', strtotime($u['tanggal_masuk'] ?? $u['created_at'] ?? date('Y-m-d'))) ?></small>
              <span style="color:var(--primary-color); font-weight:700;">Lihat Profil →</span>
            </div>
          </a>
        <?php endforeach; ?>
      <?php else: ?>
        <p>Tidak ada pengguna ditemukan.</p>
      <?php endif; ?>
    </div>
  </div>
</section>
<?= $this->endSection() ?>
