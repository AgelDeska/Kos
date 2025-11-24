<?= $this->extend('layout/public_template') ?>

<?= $this->section('content') ?>

<div class="row justify-content-center mt-5">
    <div class="col-md-6">
        <div class="card shadow-lg border-0 rounded-lg">
            <div class="card-header bg-success text-white text-center">
                <h3 class="fw-light my-4">Daftar Akun Penyewa Baru</h3>
            </div>
            <div class="card-body p-4">
                <?= form_open('/register') ?>
                    <div class="form-floating mb-3">
                        <input class="form-control <?= (isset(session()->get('errors')['nama'])) ? 'is-invalid' : '' ?>" id="inputNama" type="text" name="nama" placeholder="Nama Lengkap" value="<?= old('nama') ?>" required />
                        <label for="inputNama">Nama Lengkap</label>
                        <?php if (isset(session()->get('errors')['nama'])): ?><div class="invalid-feedback"><?= session()->get('errors')['nama'] ?></div><?php endif; ?>
                    </div>
                    <div class="form-floating mb-3">
                        <input class="form-control <?= (isset(session()->get('errors')['username'])) ? 'is-invalid' : '' ?>" id="inputUsername" type="text" name="username" placeholder="Username" value="<?= old('username') ?>" required />
                        <label for="inputUsername">Username</label>
                        <?php if (isset(session()->get('errors')['username'])): ?><div class="invalid-feedback"><?= session()->get('errors')['username'] ?></div><?php endif; ?>
                    </div>
                    <div class="form-floating mb-3">
                        <input class="form-control <?= (isset(session()->get('errors')['email'])) ? 'is-invalid' : '' ?>" id="inputEmail" type="email" name="email" placeholder="name@example.com" value="<?= old('email') ?>" required />
                        <label for="inputEmail">Alamat Email</label>
                        <?php if (isset(session()->get('errors')['email'])): ?><div class="invalid-feedback"><?= session()->get('errors')['email'] ?></div><?php endif; ?>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <div class="form-floating mb-3 mb-md-0">
                                <input class="form-control <?= (isset(session()->get('errors')['password'])) ? 'is-invalid' : '' ?>" id="inputPassword" type="password" name="password" placeholder="Password" required />
                                <label for="inputPassword">Password</label>
                                <?php if (isset(session()->get('errors')['password'])): ?><div class="invalid-feedback"><?= session()->get('errors')['password'] ?></div><?php endif; ?>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-floating mb-3 mb-md-0">
                                <input class="form-control <?= (isset(session()->get('errors')['confirmpassword'])) ? 'is-invalid' : '' ?>" id="inputConfirmPassword" type="password" name="confirmpassword" placeholder="Konfirmasi Password" required />
                                <label for="inputConfirmPassword">Konfirmasi Password</label>
                                <?php if (isset(session()->get('errors')['confirmpassword'])): ?><div class="invalid-feedback"><?= session()->get('errors')['confirmpassword'] ?></div><?php endif; ?>
                            </div>
                        </div>
                    </div>
                    <div class="mt-4 mb-0">
                        <div class="d-grid"><button type="submit" class="btn btn-success btn-block">Buat Akun</button></div>
                    </div>
                <?= form_close() ?>
            </div>
            <div class="card-footer text-center py-3">
                <div class="small"><a href="/login">Sudah punya akun? Masuk</a></div>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>