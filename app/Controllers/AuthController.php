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
        // Placeholder untuk logika otentikasi
        // ...
        return redirect()->back();
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
        // Placeholder untuk logika registrasi
        // ...
        return redirect()->to('/login')->with('success', 'Registrasi berhasil! Silakan login.');
    }

    /**
     * Proses Logout
     */
    public function logout()
    {
        session()->destroy();
        return redirect()->to('/')->with('success', 'Anda telah berhasil logout.');
    }
}