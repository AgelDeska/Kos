# STEP-BY-STEP SETUP GMAIL APP PASSWORD

## LANGKAH 1: Buka Google Account Security
1. Kunjungi: https://myaccount.google.com
2. Pastikan sudah login dengan: smartkos.agezitomik@gmail.com
3. Klik menu "Security" di sebelah kiri

## LANGKAH 2: Aktifkan 2-Step Verification (Jika belum aktif)
1. Scroll ke "How you sign in to Google"
2. Cari "2-Step Verification"
3. Klik "Enable 2-Step Verification"
4. Pilih nomor HP untuk verifikasi
5. Masukkan kode verifikasi yang diterima
6. Klik "Enable"

## LANGKAH 3: Generate App Password
1. Buka ulang: https://myaccount.google.com/apppasswords
2. Pastikan 2-Step Verification sudah aktif
3. Di halaman "App passwords":
   - Dropdown 1 (Select the app): Pilih "Mail"
   - Dropdown 2 (Select the device): Pilih "Windows Computer"
4. Klik "Generate"
5. Google akan menampilkan password 16 karakter dengan spasi
   Contoh: `abcd efgh ijkl mnop`

## LANGKAH 4: Copy Password (Penting!)
1. Jangan lupa spasi-nya
2. COPY password tersebut
3. Ini hanya muncul 1x, jadi simpan dengan aman

## LANGKAH 5: Paste ke File Config
1. Buka file: `app/Config/Email.php`
2. Cari baris: `public string $SMTPPass = 'your-app-password';`
3. Ganti 'your-app-password' dengan password dari Gmail
4. CONTOH HASIL:
   ```
   public string $SMTPPass = 'abcd efgh ijkl mnop';
   ```
5. SIMPAN file

## LANGKAH 6: Test Fitur
1. Buka browser: http://localhost:8080/forgot-password
2. Masukkan email test: penyewa@example.com
3. Klik "Kirim Link Reset"
4. Tunggu 2-5 detik
5. Buka Gmail inbox (atau check spam folder)
6. Cari email dari "SmartKos Agezitomik"
7. Klik link "Reset Password"
8. Buat password baru minimal 6 karakter
9. Selesai! Password sudah direset

---

## JIKA PASSWORD TIDAK BERHASIL DI-GENERATE

Kemungkinan 2-Step Verification belum aktif:
1. Buka: https://myaccount.google.com/security
2. Scroll ke "How you sign in to Google"
3. Klik "2-Step Verification"
4. Ikuti langkah verifikasi

---

## JIKA EMAIL TIDAK TERKIRIM

**Penyebab paling umum:**
1. SMTP Password belum di-update di `app/Config/Email.php`
2. SMTP Password tidak sama persis (check karakter spasi)
3. Belum ada internet connection
4. 2-Step Verification belum aktif

**Solusi:**
1. Cek lagi file `app/Config/Email.php`:
   - `SMTPHost` harus: `smtp.gmail.com`
   - `SMTPPort` harus: `587`
   - `SMTPUser` harus: `smartkos.agezitomik@gmail.com`
   - `SMTPPass` harus: password dari Gmail (dengan spasi)

2. Cek email config:
   ```
   public string $protocol = 'smtp';
   public string $SMTPHost = 'smtp.gmail.com';
   public string $SMTPUser = 'smartkos.agezitomik@gmail.com';
   public string $SMTPPass = 'xxxx xxxx xxxx xxxx';  // ← PASSWORD APP GOOGLE
   public int $SMTPPort = 587;
   public bool $SMTPKeepAlive = true;
   public string $SMTPCrypto = 'tls';
   public string $mailType = 'html';
   ```

3. Test SMTP connection di terminal:
   ```bash
   php spark
   ```

---

## FILE KONFIGURASI EMAIL

**Location:** `app/Config/Email.php`

```php
<?php
namespace Config;

class Email extends BaseConfig
{
    public string $fromEmail  = 'smartkos.agezitomik@gmail.com';
    public string $fromName   = 'SmartKos Agezitomik';
    public string $protocol = 'smtp';
    public string $SMTPHost = 'smtp.gmail.com';
    public string $SMTPUser = 'smartkos.agezitomik@gmail.com';
    public string $SMTPPass = 'YOUR_APP_PASSWORD_HERE';  // ← GANTI INI
    public int $SMTPPort = 587;
    public string $SMTPCrypto = 'tls';
    public bool $SMTPKeepAlive = true;
    public string $mailType = 'html';
    public string $charset = 'UTF-8';
}
```

---

## FITUR LENGKAP

✅ **Forgot Password Page** - User bisa input email
✅ **Email Verification** - Email terkirim ke Gmail dengan link reset
✅ **Reset Token** - Token unik 64 karakter
✅ **Token Expiry** - Link hanya berlaku 1 jam
✅ **Reset Password Form** - User buat password baru
✅ **Validation** - Password minimal 6 karakter
✅ **Success Message** - Konfirmasi password berhasil direset
✅ **Security** - Password di-hash dengan bcrypt

---

## LOGIN TESTING ACCOUNT

**Username:** penyewa1
**Email:** penyewa@example.com
**Default Password:** penyewa123

---

## DOKUMENTASI LENGKAP

Lihat file: `FORGOT_PASSWORD_SETUP.md` di root project

---

Created: 2025-11-25
