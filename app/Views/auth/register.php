<?= $this->extend('layout/public_template') ?>

<?= $this->section('content') ?>

<style>
  .register-container {
    background: #fff;
    width: 100%;
    max-width: 500px;
    padding: 40px;
    border-radius: 12px;
    box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
    text-align: center;
    position: relative;
    z-index: 1;
    margin: 60px auto;
  }

  .register-container h1 {
    font-size: 30px;
    color: #007bff;
    margin-bottom: 10px;
    font-weight: 700;
  }

  .register-container p {
    font-size: 15px;
    color: #6c757d;
    margin-bottom: 35px;
  }

  .form-group {
    margin-bottom: 20px;
    text-align: left;
  }

  .form-group label {
    display: block;
    font-weight: 600;
    color: #343a40;
    margin-bottom: 8px;
    font-size: 15px;
  }

  .form-control {
    width: 100%;
    padding: 12px 15px;
    border: 1px solid #ced4da;
    border-radius: 8px;
    transition: all 0.3s ease;
    font-size: 15px;
    font-family: 'Poppins', sans-serif;
  }

  .form-control:focus {
    border-color: #007bff;
    box-shadow: 0 0 0 0.25rem rgba(0, 123, 255, 0.25);
    outline: none;
  }

  .form-control.is-invalid {
    border-color: #dc3545;
  }

  .form-control.is-invalid:focus {
    box-shadow: 0 0 0 0.25rem rgba(220, 53, 69, 0.25);
  }

  .invalid-feedback {
    display: block;
    color: #dc3545;
    font-size: 13px;
    margin-top: 5px;
  }

  .alert {
    margin-bottom: 25px;
    border-radius: 8px;
    padding: 12px 15px;
    font-size: 14px;
  }

  .alert-success {
    background-color: #d4edda;
    color: #155724;
    border: 1px solid #c3e6cb;
  }

  .alert-danger {
    background-color: #f8d7da;
    color: #721c24;
    border: 1px solid #f5c6cb;
  }

  .btn-primary {
    width: 100%;
    background-color: #007bff;
    border-color: #007bff;
    padding: 12px 20px;
    border-radius: 8px;
    font-size: 17px;
    font-weight: 600;
    cursor: pointer;
    transition: background-color 0.3s ease, border-color 0.3s ease, transform 0.2s ease;
    color: #fff;
    border: none;
    font-family: 'Poppins', sans-serif;
  }

  .btn-primary:hover {
    background-color: #0056b3;
    border-color: #0056b3;
    transform: translateY(-2px);
    color: #fff;
  }

  .text-link {
    font-size: 14px;
    margin-top: 15px;
  }

  .text-link a {
    color: #007bff;
    text-decoration: none;
    font-weight: 500;
    transition: color 0.3s ease, text-decoration 0.3s ease;
  }

  .text-link a:hover {
    color: #0056b3;
    text-decoration: underline;
  }

  .login-link {
    margin-top: 30px;
    color: #343a40;
  }

  .divider {
    margin: 25px 0;
    text-align: center;
    position: relative;
  }

  .divider::before {
    content: '';
    position: absolute;
    top: 50%;
    left: 0;
    right: 0;
    height: 1px;
    background: #dee2e6;
  }

  .divider span {
    background: #fff;
    padding: 0 10px;
    position: relative;
    color: #6c757d;
    font-size: 13px;
  }

  .form-row {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 15px;
  }

  .text-muted {
    color: #6c757d;
  }

  @media (max-width: 576px) {
    .register-container {
      width: 90%;
      padding: 30px 25px;
      margin: 40px auto;
    }
    .register-container h1 {
      font-size: 26px;
    }
    .register-container p {
      font-size: 14px;
      margin-bottom: 25px;
    }
    .form-group {
      margin-bottom: 15px;
    }
    .form-control, .btn-primary {
      padding: 10px 12px;
      font-size: 14px;
    }
    .btn-primary {
      font-size: 16px;
    }
    .text-link {
      font-size: 13px;
    }
    .login-link {
      margin-top: 20px;
    }
    .form-row {
      grid-template-columns: 1fr;
      gap: 10px;
    }
  }
</style>

<div class="register-container">
    <h1 class="mb-2">SmartKos Agezitomik</h1>
    <p class="text-secondary">Buat akun baru untuk memulai</p>

    <!-- Alert Messages -->
    <?php if (session()->getFlashdata('success')): ?>
      <div class="alert alert-success" role="alert">
        <i class="fas fa-check-circle me-2"></i><?= session()->getFlashdata('success') ?>
      </div>
    <?php endif; ?>

    <?php if (session()->getFlashdata('error')): ?>
      <div class="alert alert-danger" role="alert">
        <i class="fas fa-exclamation-circle me-2"></i><?= session()->getFlashdata('error') ?>
      </div>
    <?php endif; ?>

    <?php $errors = session()->getFlashdata('errors'); ?>
    <?php if ($errors): ?>
      <div class="alert alert-danger" role="alert">
        <i class="fas fa-exclamation-circle me-2"></i>
        <strong>Validasi Error:</strong>
        <ul style="margin: 5px 0 0 0; padding-left: 20px;">
          <?php foreach ($errors as $error): ?>
            <li><?= $error ?></li>
          <?php endforeach; ?>
        </ul>
      </div>
    <?php endif; ?>

    <!-- Form Register -->
    <?= form_open('/register') ?>

      <!-- Nama Lengkap -->
      <div class="form-group">
        <label for="nama"><i class="fas fa-user me-2"></i>Nama Lengkap</label>
        <input
          type="text"
          id="nama"
          name="nama"
          class="form-control <?= isset(session()->get('errors')['nama']) ? 'is-invalid' : '' ?>"
          placeholder="Masukkan nama lengkap"
          value="<?= old('nama') ?>"
          required
        />
        <?php if (isset(session()->get('errors')['nama'])): ?>
          <div class="invalid-feedback"><?= session()->get('errors')['nama'] ?></div>
        <?php endif; ?>
      </div>

      <!-- Username & Email (2 columns on desktop) -->
      <div class="form-row">
        <div class="form-group">
          <label for="username"><i class="fas fa-at me-2"></i>Username</label>
          <input
            type="text"
            id="username"
            name="username"
            class="form-control <?= isset(session()->get('errors')['username']) ? 'is-invalid' : '' ?>"
            placeholder="Username unik"
            value="<?= old('username') ?>"
            required
          />
          <?php if (isset(session()->get('errors')['username'])): ?>
            <div class="invalid-feedback"><?= session()->get('errors')['username'] ?></div>
          <?php endif; ?>
        </div>

        <div class="form-group">
          <label for="email"><i class="fas fa-envelope me-2"></i>Email</label>
          <input
            type="email"
            id="email"
            name="email"
            class="form-control <?= isset(session()->get('errors')['email']) ? 'is-invalid' : '' ?>"
            placeholder="nama@example.com"
            value="<?= old('email') ?>"
            required
          />
          <?php if (isset(session()->get('errors')['email'])): ?>
            <div class="invalid-feedback"><?= session()->get('errors')['email'] ?></div>
          <?php endif; ?>
        </div>
      </div>

      <!-- Password & Confirm Password (2 columns on desktop) -->
      <div class="form-row">
        <div class="form-group">
          <label for="password"><i class="fas fa-lock me-2"></i>Password</label>
          <input
            type="password"
            id="password"
            name="password"
            class="form-control <?= isset(session()->get('errors')['password']) ? 'is-invalid' : '' ?>"
            placeholder="Minimal 6 karakter"
            required
          />
          <?php if (isset(session()->get('errors')['password'])): ?>
            <div class="invalid-feedback"><?= session()->get('errors')['password'] ?></div>
          <?php endif; ?>
        </div>

        <div class="form-group">
          <label for="confirmpassword"><i class="fas fa-check-circle me-2"></i>Konfirmasi</label>
          <input
            type="password"
            id="confirmpassword"
            name="confirmpassword"
            class="form-control <?= isset(session()->get('errors')['confirmpassword']) ? 'is-invalid' : '' ?>"
            placeholder="Ulangi password"
            required
          />
          <?php if (isset(session()->get('errors')['confirmpassword'])): ?>
            <div class="invalid-feedback"><?= session()->get('errors')['confirmpassword'] ?></div>
          <?php endif; ?>
        </div>
      </div>

      <button type="submit" class="btn-primary mt-3">
        <i class="fas fa-user-plus me-2"></i>Daftar Akun
      </button>

      <div class="divider">
        <span>atau</span>
      </div>

      <div class="text-link login-link">
        Sudah punya akun? <a href="<?= base_url('login') ?>">Masuk di sini</a>
      </div>
    <?= form_close() ?>

    <!-- Terms Notice -->
    <p class="text-muted mt-4" style="font-size: 12px;">
      Dengan mendaftar, Anda setuju dengan <a href="#" class="text-link" style="margin: 0;">Syarat & Ketentuan</a>
    </p>
  </div>

<?= $this->endSection() ?>