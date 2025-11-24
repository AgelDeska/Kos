<?php namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\UserModel;

class Penyewa extends BaseController
{
    protected $userModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
    }

    // [C R U D] - R (Read/Index): Tampilkan daftar semua penyewa
    public function index()
    {
        $data['penyewas'] = $this->userModel->where('role', 'Penyewa')->findAll();
        return view('admin/penyewa/index', $data);
    }

    // [C R U D] - U (Update Status): Ubah status aktif/nonaktif penyewa
    public function toggleActive($user_id)
    {
        $user = $this->userModel->find($user_id);
        if (!$user || $user['role'] !== 'Penyewa') {
            return redirect()->back()->with('error', 'Penyewa tidak ditemukan.');
        }

        $newStatus = $user['is_active'] == 1 ? 0 : 1;
        $this->userModel->update($user_id, ['is_active' => $newStatus]);

        $message = $newStatus == 1 ? 'diaktifkan' : 'dinonaktifkan';
        return redirect()->back()->with('success', "Akun penyewa $message.");
    }

    // **Catatan Tambahan:** Fungsi Update Data Detail (nama, email, dll.) juga dapat ditambahkan di sini.
}