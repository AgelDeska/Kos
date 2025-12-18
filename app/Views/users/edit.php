<?= $this->extend('layout/public_template') ?>

<?= $this->section('content') ?>

<style>
    .edit-header {
        background: linear-gradient(135deg,#667eea 0%,#764ba2 100%);
        color: #fff;
        padding: 18px;
        border-radius: 10px;
        margin-bottom: 18px;
    }
    .edit-card { border-radius: 10px; box-shadow: 0 6px 22px rgba(15,23,42,0.06); }
    .avatar-upload { display:flex; gap:12px; align-items:center; }
    .avatar-preview { width:84px; height:84px; border-radius:50%; background:linear-gradient(135deg,#667eea,#764ba2); display:flex; align-items:center; justify-content:center; color:#fff; font-size:28px; font-weight:800; border:3px solid #fff; }
    .small-note { font-size:0.85rem; color:#64748b; }
    .form-control { padding:10px 12px; border-radius:8px; border:1px solid #e6eef8; }
    .form-label { font-weight:700; font-size:0.88rem; color:#0f172a; }
    .btn-save { background:linear-gradient(135deg,#667eea,#764ba2); color:#fff; border-radius:8px; padding:10px 14px; border:none; }
    .btn-cancel { background:#fff; color:#667eea; border:1px solid #e6eef8; border-radius:8px; padding:10px 14px; }
    @media(max-width:576px){ .avatar-preview{ width:72px; height:72px; font-size:24px } }
</style>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="edit-header">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <h4 style="margin:0; font-weight:800;">Edit Profil</h4>
                        <div class="small-note">Perbarui informasi akun Anda. Perubahan akan langsung disimpan setelah menekan simpan.</div>
                    </div>
                    <div class="d-none d-sm-block">
                        <div class="avatar-preview">
                            <?= strtoupper(substr($user['nama'] ?? $user['username'], 0, 1)) ?>
                        </div>
                    </div>
                </div>
            </div>

            <?php if (session()->getFlashdata('errors')): ?>
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        <?php foreach(session()->getFlashdata('errors') as $err): ?>
                            <li><?= esc($err) ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            <?php endif; ?>

            <?php if (session()->getFlashdata('success')): ?>
                <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
            <?php endif; ?>

            <div class="card edit-card">
                <div class="card-body p-3">
                    <form action="<?= base_url('profile/update') ?>" method="post" enctype="multipart/form-data">
                        <?= csrf_field() ?>

                        <div class="mb-3 avatar-upload">
                            <div class="avatar-preview" id="avatarPreview"> <?= strtoupper(substr($user['nama'] ?? $user['username'], 0, 1)) ?> </div>
                            <div style="flex:1;">
                                <label class="form-label">Foto Profil (opsional)</label>
                                <input type="file" id="avatarInput" name="avatar" class="form-control" accept="image/*">
                                <div class="small-note mt-1">Format: JPG/PNG. Maks 2MB. (Upload backend belum di-handle otomatis)</div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Nama Lengkap</label>
                            <input type="text" name="nama" class="form-control" value="<?= esc(old('nama', $user['nama'])) ?>" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Email</label>
                            <input type="email" name="email" class="form-control" value="<?= esc(old('email', $user['email'])) ?>" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">No. Telepon</label>
                            <input type="text" name="no_telp" class="form-control" value="<?= esc(old('no_telp', $user['no_telp'])) ?>">
                        </div>

                        <div class="d-flex gap-2 justify-content-end mt-3">
                            <a href="<?= base_url('profile') ?>" class="btn-cancel">Batal</a>
                            <button type="submit" class="btn-save">Simpan Perubahan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    // Avatar preview (client-side only)
    const avatarInput = document.getElementById('avatarInput');
    const avatarPreview = document.getElementById('avatarPreview');
    if (avatarInput) {
        avatarInput.addEventListener('change', (e) => {
            const file = e.target.files[0];
            if (!file) return;
            const reader = new FileReader();
            reader.onload = function(ev) {
                avatarPreview.style.backgroundImage = `url(${ev.target.result})`;
                avatarPreview.style.backgroundSize = 'cover';
                avatarPreview.textContent = '';
            }
            reader.readAsDataURL(file);
        });
    }
</script>

<?= $this->endSection() ?>