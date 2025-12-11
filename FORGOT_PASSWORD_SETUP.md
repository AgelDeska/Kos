# SETUP FORGOT PASSWORD DENGAN GMAIL

## Fitur yang Sudah Dibuat:
✅ Halaman "Lupa Password" (`/forgot-password`)
✅ Pengiriman Email Reset ke Gmail
✅ Link Reset dengan Token Unik (berlaku 1 jam)
✅ Halaman Reset Password
✅ Validasi dan Update Password Baru
✅ Integrasi dengan UserModel

---

## SETUP GMAIL - PENTING!

Ikuti langkah ini untuk setup Gmail SMTP:

### 1. Aktifkan 2-Step Verification (Verifikasi 2 Langkah)
1. Buka https://myaccount.google.com
2. Klik "Security" di menu kiri
3. Scroll ke bagian "How you sign in to Google"
4. Klik "2-Step Verification"
5. Ikuti proses verifikasi dengan nomor HP Anda

### 2. Generate App Password
1. Buka https://myaccount.google.com/apppasswords
2. Pastikan sudah login dengan akun smartkos.agezitomik@gmail.com
3. Di bagian "Select the app and device you want to generate the app password for":
   - App: Pilih "Mail"
   - Device: Pilih "Windows Computer" (atau device yang sesuai)
4. Klik "Generate"
5. Google akan menampilkan password 16 karakter, COPY password ini

### 3. Update Email Config di Code
1. Buka file: `app/Config/Email.php`
2. Cari baris: `public string $SMTPPass = 'your-app-password';`
3. Ganti dengan password 16 karakter yang Anda dapatkan dari Gmail
   Contoh: `public string $SMTPPass = 'abcd efgh ijkl mnop';`
4. JANGAN lupa untuk menghapus spasi, hanya gunakan karakter yang ada

---

## TESTING FORGOT PASSWORD

### Test via Browser:
1. Buka http://localhost:8080/forgot-password
2. Masukkan email yang terdaftar (contoh: penyewa@example.com)
3. Klik "Kirim Link Reset"
4. Buka Gmail inbox untuk email reset
5. Klik link "Reset Password" di email
6. Buat password baru
7. Klik "Reset Password"
8. Sekarang bisa login dengan password baru!

---

## EMAIL YANG DIKIRIM

Email akan berbentuk HTML dengan:
- ✓ Logo/Brand SmartKos
- ✓ Link Reset Password yang aman
- ✓ Informasi waktu expiry (1 jam)
- ✓ Panduan keamanan

---

## ROUTES YANG DITAMBAHKAN

```
GET  /forgot-password              → Tampilkan form lupa password
POST /forgot-password              → Proses pengiriman email reset
GET  /reset-password/:token        → Tampilkan form reset password
POST /reset-password               → Proses update password baru
```

---

## FILES YANG DIBUAT/DIUBAH

✅ **Dibuat:**
- app/Views/auth/forgot_password.php      (Form lupa password)
- app/Views/auth/reset_password.php       (Form reset password)
- app/Database/Migrations/2025-11-25-000001_AddPasswordResetToUser.php

✅ **Diubah:**
- app/Config/Email.php              (Setup SMTP Gmail)
- app/Config/Routes.php             (Tambah routes forgot password)
- app/Controllers/AuthController.php (Tambah method forgot/reset password)
- app/Views/auth/login.php          (Update link forgot password)

---

## SECURITY FEATURES

🔒 Token Unik 64 Karakter (menggunakan random_bytes)
🔒 Token Expires setelah 1 jam
🔒 Password di-hash dengan PASSWORD_DEFAULT
🔒 Validasi email format
🔒 Validasi password match (confirm password)
🔒 CSRF Protection (form_open() sudah include)
🔒 Input sanitization

---

## TROUBLESHOOTING

### Email tidak terkirim?
1. Pastikan App Password sudah di-set di Email.php
2. Cek internet connection
3. Cek spam folder di Gmail
4. Verifikasi email di Email.php sudah benar: smartkos.agezitomik@gmail.com

### Token error?
1. Pastikan migration sudah dijalankan: `php spark migrate`
2. Cek database punya kolom reset_token dan reset_expires di tabel user

### Password tidak bisa di-reset?
1. Pastikan password minimal 6 karakter
2. Pastikan confirm password sama dengan password
3. Cek token belum expired (lebih dari 1 jam)

---

## NEXT STEPS (OPTIONAL)

Untuk meningkatkan fitur lebih lanjut, bisa tambahkan:
- Email rate limiting (cegah spam)
- OTP verification di email
- Resend link option
- Password strength indicator di frontend
- Email notification untuk login baru
- Activity log untuk password change

---

Last Updated: 2025-11-25
