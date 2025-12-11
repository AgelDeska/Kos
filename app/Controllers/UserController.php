<?php namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UserModel;

class UserController extends BaseController
{
    protected $userModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
    }

    // List semua user (publik)
    public function index()
    {
        $data['title'] = 'Daftar Pengguna';
        $data['users'] = $this->userModel->orderBy('nama', 'ASC')->findAll();

        return view('users/index', $data);
    }

    // Tampilkan profil user berdasarkan ID
    public function view($id = null)
    {
        if (!$id) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('User tidak ditemukan');
        }

        $user = $this->userModel->find($id);
        if (!$user) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('User tidak ditemukan');
        }

        $data['title'] = 'Profil: ' . ($user['nama'] ?? $user['username']);
        $data['user'] = $user;

        return view('users/view', $data);
    }

    // Profil pengguna yang sedang login
    public function profile()
    {
        $uid = session()->get('user_id');
        if (!$uid) {
            return redirect()->to(route_to('login'));
        }

        $user = $this->userModel->find($uid);
        if (!$user) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('User tidak ditemukan');
        }

        $data['title'] = 'Profil Saya';
        $data['user'] = $user;

        return view('users/view', $data);
    }
}
