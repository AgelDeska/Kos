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

    // Tampilkan form edit profil untuk user yang login
    public function edit()
    {
        $uid = session()->get('user_id');
        if (!$uid) {
            return redirect()->to(route_to('login'));
        }

        $user = $this->userModel->find($uid);
        if (!$user) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('User tidak ditemukan');
        }

        $data['title'] = 'Edit Profil';
        $data['user'] = $user;

        return view('users/edit', $data);
    }

    // Proses update profil (POST)
    public function update()
    {
        $uid = session()->get('user_id');
        if (!$uid) {
            return redirect()->to(route_to('login'));
        }

        $user = $this->userModel->find($uid);
        if (!$user) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('User tidak ditemukan');
        }

        $rules = [
            'nama' => 'required|min_length[3]|max_length[255]',
            'email' => 'required|valid_email',
            'no_telp' => 'permit_empty|numeric'
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $data = [
            'nama' => $this->request->getPost('nama'),
            'email' => $this->request->getPost('email'),
            'no_telp' => $this->request->getPost('no_telp') ?: null,
        ];

        $this->userModel->update($uid, $data);

        session()->setFlashdata('success', 'Profil berhasil diperbarui.');
        return redirect()->to(route_to('profile'));
    }
}
