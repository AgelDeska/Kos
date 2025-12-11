<?= $this->extend('layout/public_template') ?>

<?= $this->section('content') ?>

<style>
  .forgot-container {
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

  .forgot-container h1 {
    font-size: 28px;
    color: #007bff;
    margin-bottom: 10px;
    font-weight: 700;
  }

  .forgot-container .subtitle {
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
    margin-top: 20px;
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

  .info-box {
    background-color: #e7f3ff;
    border-left: 4px solid #2196F3;
    padding: 15px;
    border-radius: 4px;
    margin-bottom: 20px;
    text-align: left;
    font-size: 13px;
    color: #1565c0;
  }

  @media (max-width: 576px) {
    .forgot-container {
      width: 90%;
      padding: 30px 20px;
      margin: 40px auto;
    }
    .forgot-container h1 {
      font-size: 24px;
    }
    .forgot-container .subtitle {
      font-size: 13px;
    }
  }
</style>

<div class="forgot-container">
  <h1><i class="fas fa-lock me-2"></i>Lupa Password?</h1>
  <p class="subtitle">Masukkan email Anda untuk menerima link reset password</p>

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

  <!-- Info Box -->
  <div class="info-box">
    <i class="fas fa-info-circle me-2"></i>
    Link reset password akan dikirim ke email Anda. Link berlaku selama 1 jam.
  </div>

  <!-- Form Forgot Password -->
  <?= form_open('/forgot-password') ?>

    <div class="form-group">
      <label for="email"><i class="fas fa-envelope me-2"></i>Email</label>
      <input
        type="email"
        id="email"
        name="email"
        class="form-control"
        placeholder="Masukkan email akun Anda"
        value="<?= old('email') ?>"
        required
        autofocus
      />
    </div>

    <button type="submit" class="btn-primary">
      <i class="fas fa-paper-plane me-2"></i>Kirim Link Reset
    </button>

    <div class="text-link">
      <a href="<?= base_url('login') ?>">
        <i class="fas fa-arrow-left me-2"></i>Kembali ke Login
      </a>
    </div>

  <?= form_close() ?>
</div>

<?= $this->endSection() ?>
