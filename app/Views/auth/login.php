<?= $this->extend('layout/public_template') ?>

<?= $this->section('content') ?>

<style>
  .login-container {
    background: #fff;
    width: 100%;
    max-width: 450px;
    padding: 40px;
    border-radius: 12px;
    box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
    text-align: center;
    position: relative;
    z-index: 1;
    margin: 60px auto;
  }

  .login-container h1 {
    font-size: 30px;
    color: #007bff;
    margin-bottom: 10px;
    font-weight: 700;
  }

  .login-container p {
    font-size: 15px;
    color: #6c757d;
    margin-bottom: 35px;
  }

  .form-group {
    margin-bottom: 25px;
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

  .register-link {
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

  @media (max-width: 576px) {
    .login-container {
      width: 90%;
      padding: 30px 25px;
      margin: 40px auto;
    }
    .login-container h1 {
      font-size: 26px;
    }
    .login-container p {
      font-size: 14px;
      margin-bottom: 25px;
    }
    .form-group {
      margin-bottom: 20px;
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
    .register-link {
      margin-top: 20px;
    }
  }
</style>

<div class="login-container">
  <h1 class="mb-2">SmartKos Agezitomik</h1>
  <p class="text-secondary">Silakan login untuk melanjutkan</p>

  <!-- Alert Messages -->
  <?php if (session()->getFlashdata('success')): ?>
    <div class="alert alert-success" role="alert">
      <i class="fas fa-check-circle me-2"></i><?= session()->getFlashdata('success') ?>
    </div>
  <?php endif; ?>

  <?php if (session()->get('error')): ?>
    <div class="alert alert-danger" role="alert">
      <i class="fas fa-exclamation-circle me-2"></i><?= session()->get('error') ?>
    </div>
  <?php endif; ?>

  <!-- Form login -->
  <?= form_open('/login') ?>

    <!-- Email input group -->
    <div class="form-group">
      <label for="email"><i class="fas fa-envelope me-2"></i>Email</label>
      <input
        type="email"
        id="email"
        name="email"
        class="form-control <?= isset(session()->get('errors')['email']) ? 'is-invalid' : '' ?>"
        placeholder="Masukkan email terdaftar"
        value="<?= old('email') ?>"
        required
      />
      <?php if (isset(session()->get('errors')['email'])): ?>
        <div class="invalid-feedback"><?= session()->get('errors')['email'] ?></div>
      <?php endif; ?>
    </div>

    <!-- Password input group -->
    <div class="form-group">
      <label for="password"><i class="fas fa-lock me-2"></i>Kata Sandi</label>
      <input
        type="password"
        id="password"
        name="password"
        class="form-control <?= isset(session()->get('errors')['password']) ? 'is-invalid' : '' ?>"
        placeholder="Masukkan kata sandi"
        required
      />
      <?php if (isset(session()->get('errors')['password'])): ?>
        <div class="invalid-feedback"><?= session()->get('errors')['password'] ?></div>
      <?php endif; ?>
    </div>

    <!-- Remember Me & Forgot Password -->
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 15px;">
      <label style="margin: 0; font-size: 14px;">
        <input type="checkbox" name="remember" style="margin-right: 5px;">
        Ingat saya
      </label>
      <a href="<?= base_url('/forgot-password') ?>" class="text-link" style="margin: 0; font-size: 14px;">Lupa kata sandi?</a>
    </div>

    <button type="submit" class="btn-primary mt-3">
      <i class="fas fa-sign-in-alt me-2"></i>Login
    </button>

    <div class="divider">
      <span>atau</span>
    </div>

    <div class="text-link register-link">
      Belum punya akun? <a href="<?= base_url('register') ?>">Daftar Sekarang</a>
    </div>
  <?= form_close() ?>
</div>

<?= $this->endSection() ?>