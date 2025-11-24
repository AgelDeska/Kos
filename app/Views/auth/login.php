<?= $this->extend('layout/public_template') ?>

<?= $this->section('content') ?>

<div class="row justify-content-center mt-5">
    <div class="col-md-5">
        <div class="card shadow-lg border-0 rounded-lg">
            <div class="card-header bg-primary text-white text-center">
                <h3 class="fw-light my-4">Selamat Datang di SmartKos</h3>
                <p class="mb-0">Silakan masuk untuk melanjutkan.</p>
            </div>
            <div class="card-body p-4">
                
                <?php if (session()->get('success')): ?>
                    <div class="alert alert-success"><?= session()->get('success') ?></div>
                <?php endif; ?>
                <?php if (session()->get('error')): ?>
                    <div class="alert alert-danger"><?= session()->get('error') ?></div>
                <?php endif; ?>

                <?= form_open('/login') ?>
                    <div class="form-floating mb-3">
                        <input class="form-control <?= (isset(session()->get('errors')['email'])) ? 'is-invalid' : '' ?>" id="inputEmail" type="email" name="email" placeholder="name@example.com" value="<?= old('email') ?>" required />
                        <label for="inputEmail">Alamat Email</label>
                        <?php if (isset(session()->get('errors')['email'])): ?>
                            <div class="invalid-feedback"><?= session()->get('errors')['email'] ?></div>
                        <?php endif; ?>
                    </div>
                    <div class="form-floating mb-3">
                        <input class="form-control <?= (isset(session()->get('errors')['password'])) ? 'is-invalid' : '' ?>" id="inputPassword" type="password" name="password" placeholder="Password" required />
                        <label for="inputPassword">Password</label>
                         <?php if (isset(session()->get('errors')['password'])): ?>
                            <div class="invalid-feedback"><?= session()->get('errors')['password'] ?></div>
                        <?php endif; ?>
                    </div>
                    <div class="d-flex align-items-center justify-content-end mt-4 mb-0">
                        <button type="submit" class="btn btn-primary w-100">Login</button>
                    </div>
                <?= form_close() ?>
            </div>
            <div class="card-footer text-center py-3">
                <div class="small"><a href="/register">Belum punya akun? Daftar Sekarang!</a></div>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>