<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UserModel;
use CodeIgniter\HTTP\ResponseInterface;

class AuthController extends BaseController
{
    /**
     * Tampilkan halaman Login
     */
    public function login()
    {
        // Wajib: Memuat Form Helper untuk menggunakan fungsi form_open()
        helper(['form']); 
        
        $data = [
            'title' => 'Login Penyewa & Admin',
            'layout' => 'auth', // Menggunakan layout khusus untuk autentikasi
        ];

        return view('auth/login', $data);
    }

    /**
     * Proses percobaan login
     */
    public function attemptLogin()
    {
        helper(['form']);

        // Validasi input
        $rules = [
            'email'    => 'required|min_length[3]|max_length[255]',
            'password' => 'required|min_length[4]|max_length[255]'
        ];

        if (! $this->validate($rules)) {
            return redirect()->back()->withInput()->with('error', 'Input tidak valid.');
        }

        $identifier = $this->request->getPost('email');
        $password = $this->request->getPost('password');

        $userModel = new UserModel();
        $user = $userModel->findUserByIdentifier($identifier);

        if (! $user) {
            return redirect()->back()->withInput()->with('error', 'Email atau password salah.');
        }

        // Cek apakah akun aktif
        if (isset($user['is_active']) && (int)$user['is_active'] !== 1) {
            return redirect()->back()->withInput()->with('error', 'Akun Anda belum aktif.');
        }

        // Periksa password (asumsikan password disimpan dengan password_hash)
        $passwordOk = false;
        if (isset($user['password']) && password_verify($password, $user['password'])) {
            $passwordOk = true;
        } elseif (isset($user['password']) && $user['password'] === $password) {
            // Fallback jika password belum di-hash (legacy). Disarankan untuk menyimpan hash.
            $passwordOk = true;
        }

        if (! $passwordOk) {
            return redirect()->back()->withInput()->with('error', 'Email atau password salah.');
        }

        // Set session
        $sessionData = [
            'isLoggedIn' => true,
            'user_id'    => $user['id'] ?? $user['user_id'] ?? null,
            'nama'       => $user['nama'] ?? $user['username'] ?? '',
            'email'      => $user['email'] ?? '',
            'role'       => isset($user['nama_role']) ? strtolower($user['nama_role']) : (isset($user['role']) ? strtolower($user['role']) : 'penyewa')
        ];

        session()->set($sessionData);

        // Redirect berdasarkan role
        if ($sessionData['role'] === 'admin') {
            return redirect()->to(route_to('admin_dashboard'));
        }

        // Redirect penyewa ke katalog kamar
        return redirect()->to(route_to('katalog_kamar'));
    }

    /**
     * Tampilkan halaman Registrasi
     */
    public function register()
    {
        // Wajib: Memuat Form Helper untuk menggunakan fungsi form_open()
        helper(['form']); 

        $data = [
            'title' => 'Daftar Akun Baru',
            'layout' => 'auth', // Menggunakan layout khusus untuk autentikasi
        ];

        return view('auth/register', $data);
    }

    /**
     * Proses percobaan registrasi
     */
    public function attemptRegister()
    {
        helper(['form']);

        // Validasi input
        $rules = [
            'nama'              => 'required|min_length[3]|max_length[255]',
            'username'          => 'required|min_length[3]|max_length[100]|is_unique[user.username]',
            'email'             => 'required|valid_email|is_unique[user.email]',
            'no_telp'           => 'required|min_length[10]|max_length[20]|regex_match[/^[0-9+\-\s()]+$/]',
            'password'          => 'required|min_length[6]|max_length[255]',
            'confirmpassword'   => 'required|matches[password]',
        ];

        // Custom error messages
        $messages = [
            'username' => [
                'is_unique' => 'Username sudah digunakan, pilih username lain.',
            ],
            'email' => [
                'is_unique' => 'Email sudah terdaftar.',
            ],
            'no_telp' => [
                'regex_match' => 'Format nomor telepon tidak valid. Gunakan angka, spasi, tanda +, -, (, dan ).',
            ],
            'password' => [
                'matches' => 'Password tidak sesuai dengan konfirmasi password.',
            ],
        ];

        if (!$this->validate($rules, $messages)) {
            // Return dengan error validation
            return redirect()->back()
                ->withInput()
                ->with('errors', $this->validator->getErrors());
        }

        // Siapkan data untuk insert
        $userData = [
            'nama'          => $this->request->getPost('nama'),
            'username'      => $this->request->getPost('username'),
            'email'         => $this->request->getPost('email'),
            'no_telp'       => $this->request->getPost('no_telp'),
            'password'      => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
            'role'          => 'Penyewa',  // Default role untuk registrasi adalah Penyewa
            'is_active'     => 1,          // Langsung aktif saat registrasi
            'tanggal_masuk' => date('Y-m-d'),
        ];

        // Insert ke database
        $userModel = new UserModel();
        if ($userModel->insert($userData)) {
            return redirect()->to(route_to('login'))
                ->with('success', 'Registrasi berhasil! Silakan login dengan username dan password Anda.');
        } else {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Terjadi kesalahan saat registrasi. Silakan coba lagi.');
        }
    }

    /**
     * Proses Logout
     */
    public function logout()
    {
        session()->destroy();
        return redirect()->to('/')->with('success', 'Anda telah berhasil logout.');
    }

    /**
     * Tampilkan halaman Forgot Password
     */
    public function forgotPassword()
    {
        helper(['form']);
        
        $data = [
            'title' => 'Lupa Password',
            'layout' => 'auth',
        ];

        return view('auth/forgot_password', $data);
    }

    /**
     * Proses pengiriman email reset password
     */
    public function sendResetEmail()
    {
        helper(['form']);

        $rules = [
            'email' => 'required|valid_email'
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('error', 'Email tidak valid.');
        }

        $email = $this->request->getPost('email');
        $userModel = new UserModel();
        $user = $userModel->where('email', $email)->first();

        if (!$user) {
            // Untuk keamanan, jangan beri tahu email terdaftar atau tidak
            return redirect()->back()->with('success', 'Jika email terdaftar, link reset akan dikirim.');
        }

        // Generate token reset
        $resetToken = bin2hex(random_bytes(32));
        $resetExpires = date('Y-m-d H:i:s', strtotime('+1 hour'));

        // Update database dengan token dan expiry
        $userModel->update($user['user_id'], [
            'reset_token'  => $resetToken,
            'reset_expires' => $resetExpires
        ]);

        // Kirim email dengan link reset
        $resetLink = base_url('reset-password/' . $resetToken);
        
        if ($this->sendResetEmailMessage($user, $resetLink)) {
            return redirect()->back()->with('success', 'Link reset password telah dikirim ke email Anda. Cek email dalam 1 jam.');
        } else {
            return redirect()->back()->with('error', 'Gagal mengirim email. Silakan coba lagi.');
        }
    }

    /**
     * Kirim email reset password
     */
    private function sendResetEmailMessage($user, $resetLink)
    {
        $email = \Config\Services::email();

        $htmlMessage = "
            <h2>Reset Password SmartKos Agezitomik</h2>
            <p>Halo <strong>{$user['nama']}</strong>,</p>
            <p>Kami menerima permintaan untuk mereset password akun Anda.</p>
            <p>Klik tombol di bawah untuk mereset password Anda:</p>
            <p>
                <a href='{$resetLink}' style='
                    background-color: #007bff;
                    color: white;
                    padding: 12px 20px;
                    text-decoration: none;
                    border-radius: 5px;
                    display: inline-block;
                '>
                    Reset Password
                </a>
            </p>
            <p>Atau copy link ini ke browser: <br><code>{$resetLink}</code></p>
            <p><strong>Link ini berlaku selama 1 jam.</strong></p>
            <p>Jika Anda tidak meminta reset password, abaikan email ini.</p>
            <hr>
            <p style='color: #666; font-size: 12px;'>
                Email ini dikirim otomatis dari SmartKos Agezitomik. Jangan reply ke email ini.
            </p>
        ";

        $email->setFrom('smartkos.agezitomik@gmail.com', 'SmartKos Agezitomik');
        $email->setTo($user['email']);
        $email->setSubject('Reset Password - SmartKos Agezitomik');
        $email->setMessage($htmlMessage);

        return $email->send();
    }

    /**
     * Tampilkan halaman Reset Password
     */
    public function resetPassword($token)
    {
        helper(['form']);

        $userModel = new UserModel();
        $user = $userModel->where('reset_token', $token)->first();

        // Validasi token
        if (!$user) {
            return redirect()->to(route_to('login'))->with('error', 'Token reset tidak valid atau sudah kadaluarsa.');
        }

        // Cek apakah token sudah expired
        if (strtotime($user['reset_expires']) < time()) {
            return redirect()->to(route_to('login'))->with('error', 'Link reset password sudah kadaluarsa.');
        }

        $data = [
            'title' => 'Reset Password',
            'layout' => 'auth',
            'token' => $token,
            'user'  => $user
        ];

        return view('auth/reset_password', $data);
    }

    /**
     * Proses update password
     */
    public function updatePassword()
    {
        helper(['form']);

        $rules = [
            'token'             => 'required',
            'password'          => 'required|min_length[6]',
            'confirmpassword'   => 'required|matches[password]'
        ];

        if (!$this->validate($rules)) {
            $errors = $this->validator->getErrors();
            return redirect()->back()->withInput()->with('error', implode(', ', $errors));
        }

        $token = $this->request->getPost('token');
        $password = $this->request->getPost('password');

        $userModel = new UserModel();
        $user = $userModel->where('reset_token', $token)->first();

        if (!$user) {
            return redirect()->to(route_to('login'))->with('error', 'Token reset tidak valid.');
        }

        // Cek apakah token sudah expired
        if (strtotime($user['reset_expires']) < time()) {
            return redirect()->to(route_to('login'))->with('error', 'Link reset password sudah kadaluarsa.');
        }

        // Update password dan hapus token
        $userModel->update($user['user_id'], [
            'password'       => password_hash($password, PASSWORD_DEFAULT),
            'reset_token'    => null,
            'reset_expires'  => null
        ]);

        return redirect()->to(route_to('login'))->with('success', 'Password berhasil direset. Silakan login dengan password baru.');
    }
}