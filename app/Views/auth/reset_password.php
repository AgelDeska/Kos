<?= $this->extend('layout/public_template') ?>

<?= $this->section('content') ?>

<style>
  .reset-container {
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

  .reset-container h1 {
    font-size: 28px;
    color: #007bff;
    margin-bottom: 10px;
    font-weight: 700;
  }

  .reset-container .subtitle {
    font-size: 14px;
    color: #6c757d;
    margin-bottom: 30px;
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
    box-sizing: border-box;
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

  .password-requirements {
    background-color: #f8f9fa;
    border: 1px solid #dee2e6;
    border-radius: 8px;
    padding: 15px;
    margin-bottom: 20px;
    text-align: left;
    font-size: 13px;
  }

  .password-requirements h6 {
    font-size: 13px;
    font-weight: 600;
    margin-bottom: 8px;
    color: #343a40;
  }

  .password-requirements ul {
    margin: 0;
    padding-left: 20px;
    list-style-type: none;
  }

  .password-requirements li {
    margin-bottom: 5px;
    color: #6c757d;
  }

  .password-requirements li:before {
    content: '✓ ';
    color: #28a745;
    font-weight: bold;
    margin-right: 5px;
  }

  @media (max-width: 576px) {
    .reset-container {
      width: 90%;
      padding: 30px 20px;
      margin: 40px auto;
    }
    .reset-container h1 {
      font-size: 24px;
    }
    .reset-container .subtitle {
      font-size: 13px;
    }
    .password-requirements {
      padding: 12px;
      font-size: 12px;
    }
  }
</style>

<div class="reset-container">
  <h1><i class="fas fa-key me-2"></i>Reset Password</h1>
  <p class="subtitle">Buat password baru yang kuat untuk akun Anda</p>

  <!-- Alert Messages -->
  <?php if (session()->getFlashdata('error')): ?>
    <div class="alert alert-danger" role="alert">
      <i class="fas fa-exclamation-circle me-2"></i><?= session()->getFlashdata('error') ?>
    </div>
  <?php endif; ?>

  <!-- Password Requirements -->
  <div class="password-requirements">
    <h6>Persyaratan Password:</h6>
    <ul>
      <li>Minimal 6 karakter</li>
      <li>Kombinasi huruf besar dan kecil (opsional)</li>
      <li>Gunakan angka dan simbol untuk keamanan lebih baik</li>
    </ul>
  </div>

  <!-- Form Reset Password -->
  <?= form_open('/reset-password') ?>

    <input type="hidden" name="token" value="<?= esc($token) ?>" />

    <div class="form-group">
      <label for="password"><i class="fas fa-lock me-2"></i>Password Baru</label>
      <input
        type="password"
        id="password"
        name="password"
        class="form-control <?= isset(session()->get('errors')['password']) ? 'is-invalid' : '' ?>"
        placeholder="Masukkan password minimal 6 karakter"
        required
      />
      <?php if (isset(session()->get('errors')['password'])): ?>
        <div class="invalid-feedback"><?= session()->get('errors')['password'] ?></div>
      <?php endif; ?>
    </div>

    <div class="form-group">
      <label for="confirmpassword"><i class="fas fa-check-circle me-2"></i>Konfirmasi Password</label>
      <input
        type="password"
        id="confirmpassword"
        name="confirmpassword"
        class="form-control <?= isset(session()->get('errors')['confirmpassword']) ? 'is-invalid' : '' ?>"
        placeholder="Ulangi password yang sama"
        required
      />
      <?php if (isset(session()->get('errors')['confirmpassword'])): ?>
        <div class="invalid-feedback"><?= session()->get('errors')['confirmpassword'] ?></div>
      <?php endif; ?>
    </div>

    <button type="submit" class="btn-primary">
      <i class="fas fa-refresh me-2"></i>Reset Password
    </button>

  <?= form_close() ?>
</div>

<?= $this->endSection() ?>
