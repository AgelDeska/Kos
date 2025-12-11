<?= $this->extend('layout/public_template') ?>

<?= $this->section('content') ?>
<section class="container">
  <div style="display:flex; gap:28px; align-items:flex-start; margin-top:40px;">
    <div style="width:220px;">
      <div style="width:220px; height:220px; border-radius:14px; background:linear-gradient(135deg,#60a5fa,#3b82f6); display:flex; align-items:center; justify-content:center; color:#fff; font-size:56px; font-weight:800;">
        <?= strtoupper(substr($user['nama'] ?? $user['username'], 0, 1)) ?>
      </div>
      <div style="margin-top:14px; background:var(--card-bg); padding:12px; border-radius:12px; border:1px solid var(--card-border); box-shadow:var(--card-shadow);">
        <p style="margin:0; font-weight:700; color:var(--primary-color);">Role</p>
        <p style="margin:6px 0 0; font-weight:600;"><?= esc($user['role']) ?></p>
      </div>
    </div>

    <div style="flex:1;">
      <div class="card">
        <div class="card-body">
          <h2 style="margin:0 0 8px; font-size:26px; font-weight:800;"><?= esc($user['nama'] ?? $user['username']) ?></h2>
          <p style="margin:0 0 12px; color:var(--muted-color);">Username: <strong><?= esc($user['username']) ?></strong></p>

          <div style="display:grid; grid-template-columns: repeat(auto-fit, minmax(220px, 1fr)); gap:12px;">
            <div style="background:var(--card-bg); padding:16px; border-radius:12px; border:1px solid var(--card-border);">
              <p style="margin:0; color:var(--muted-color);">Email</p>
              <p style="margin:8px 0 0; font-weight:700;"><?= esc($user['email']) ?></p>
            </div>
            <div style="background:var(--card-bg); padding:16px; border-radius:12px; border:1px solid var(--card-border);">
              <p style="margin:0; color:var(--muted-color);">No. Telepon</p>
              <p style="margin:8px 0 0; font-weight:700;"><?= esc($user['no_telp'] ?? '-') ?></p>
            </div>
            <div style="background:var(--card-bg); padding:16px; border-radius:12px; border:1px solid var(--card-border);">
              <p style="margin:0; color:var(--muted-color);">Status Akun</p>
              <p style="margin:8px 0 0; font-weight:700; color:<?= ($user['is_active']) ? '#10b981' : '#ef4444' ?>;"><?= ($user['is_active']) ? 'Aktif' : 'Non-aktif' ?></p>
            </div>
            <div style="background:var(--card-bg); padding:16px; border-radius:12px; border:1px solid var(--card-border);">
              <p style="margin:0; color:var(--muted-color);">Bergabung Sejak</p>
              <p style="margin:8px 0 0; font-weight:700;"><?= date('d M Y', strtotime($user['tanggal_masuk'] ?? $user['created_at'] ?? date('Y-m-d'))) ?></p>
            </div>
          </div>

          <div style="margin-top:18px; display:flex; gap:12px;">
            <a href="<?= base_url('katalog') ?>" class="btn btn-ghost">Lihat Kamar</a>
            <?php if (session()->get('user_id') == $user['user_id']): ?>
              <a href="<?= base_url('penyewa/dashboard') ?>" class="btn btn-primary">Dashboard Saya</a>
            <?php endif; ?>
          </div>
        </div>
      </div>

      <div style="margin-top:20px;">
        <div class="card">
          <div class="card-header"><strong>Informasi Lengkap</strong></div>
          <div class="card-body">
            <p><strong>Nama:</strong> <?= esc($user['nama'] ?? '-') ?></p>
            <p><strong>Username:</strong> <?= esc($user['username']) ?></p>
            <p><strong>Email:</strong> <?= esc($user['email']) ?></p>
            <p><strong>No. Telepon:</strong> <?= esc($user['no_telp'] ?? '-') ?></p>
            <p><strong>Role:</strong> <?= esc($user['role']) ?></p>
            <p><strong>Tanggal Masuk:</strong> <?= date('d M Y H:i', strtotime($user['tanggal_masuk'] ?? $user['created_at'] ?? date('Y-m-d H:i'))) ?></p>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<?= $this->endSection() ?>
