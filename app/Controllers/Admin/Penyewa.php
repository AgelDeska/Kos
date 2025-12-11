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

    // [C R U D] - R (Read/Index): Tampilkan daftar semua penyewa dengan filter dan search
    public function index()
    {
        $search = $this->request->getGet('search') ?? '';
        $status = $this->request->getGet('status') ?? '';
        $sortBy = $this->request->getGet('sortBy') ?? 'nama';
        $sortOrder = $this->request->getGet('sortOrder') ?? 'ASC';

        $query = $this->userModel->where('role', 'Penyewa');

        // Filter berdasarkan search (nama, email, atau username)
        if (!empty($search)) {
            $query = $query->groupStart()
                ->like('nama', $search)
                ->orLike('email', $search)
                ->orLike('username', $search)
                ->groupEnd();
        }

        // Filter berdasarkan status
        if ($status !== '') {
            $query = $query->where('is_active', (int)$status);
        }

        // Sort (hanya izinkan kolom yang valid)
        $allowedColumns = ['nama', 'email', 'username', 'tanggal_masuk', 'is_active'];
        if (in_array($sortBy, $allowedColumns)) {
            $query = $query->orderBy($sortBy, strtoupper($sortOrder));
        } else {
            $query = $query->orderBy('nama', 'ASC');
        }

        $data['penyewas'] = $query->findAll();
        $data['search'] = $search;
        $data['status'] = $status;
        $data['sortBy'] = $sortBy;
        $data['sortOrder'] = $sortOrder;

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

    // [C R U D] - C (Create): Menampilkan form tambah penyewa
    public function create()
    {
        $data['validation'] = \Config\Services::validation();
        return view('admin/penyewa/create', $data);
    }

    // [C R U D] - C (Store): Menyimpan data penyewa baru
    public function store()
    {
        // Validasi input
        $rules = [
            'nama'     => 'required|min_length[3]|max_length[100]',
            'email'    => 'required|valid_email|is_unique[user.email]',
            'username' => 'required|min_length[5]|max_length[50]|is_unique[user.username]|regex_match[/^[a-zA-Z0-9_-]+$/]',
            'no_telp'  => 'required|min_length[10]|max_length[15]',
            'password' => 'required|min_length[6]|max_length[255]',
            'confirm_password' => 'required|matches[password]',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        // Simpan data penyewa baru
        $success = $this->userModel->save([
            'username'      => $this->request->getPost('username'),
            'password'      => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
            'role'          => 'Penyewa',
            'nama'          => $this->request->getPost('nama'),
            'email'         => $this->request->getPost('email'),
            'no_telp'       => $this->request->getPost('no_telp'),
            'is_active'     => 1,
            'tanggal_masuk' => null,
        ]);

        if ($success) {
            return redirect()->to('/admin/penyewa')->with('success', 'Data penyewa berhasil ditambahkan.');
        } else {
            return redirect()->back()->with('error', 'Gagal menyimpan data penyewa.');
        }
    }

    // [C R U D] - U (Edit): Menampilkan form edit penyewa
    public function edit($user_id)
    {
        $data['penyewa'] = $this->userModel->find($user_id);
        if (!$data['penyewa'] || $data['penyewa']['role'] !== 'Penyewa') {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound('Penyewa tidak ditemukan.');
        }
        $data['validation'] = \Config\Services::validation();
        return view('admin/penyewa/edit', $data);
    }

    // [C R U D] - U (Update): Memperbarui data penyewa
    public function update($user_id)
    {
        $penyewa = $this->userModel->find($user_id);
        if (!$penyewa || $penyewa['role'] !== 'Penyewa') {
            return redirect()->back()->with('error', 'Penyewa tidak ditemukan.');
        }

        // Validasi input
        $rules = [
            'nama'     => 'required|min_length[3]|max_length[100]',
            'email'    => "required|valid_email|is_unique[user.email,user_id,{$user_id}]",
            'no_telp'  => 'required|min_length[10]|max_length[15]',
        ];

        // Jika ada password baru, validasi password
        if (!empty($this->request->getPost('password'))) {
            $rules['password'] = 'min_length[6]|max_length[255]';
            $rules['confirm_password'] = 'matches[password]';
        }

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        // Persiapkan data yang akan diupdate
        $updateData = [
            'nama'    => $this->request->getPost('nama'),
            'email'   => $this->request->getPost('email'),
            'no_telp' => $this->request->getPost('no_telp'),
        ];

        // Jika ada password baru, hash dan update
        if (!empty($this->request->getPost('password'))) {
            $updateData['password'] = password_hash($this->request->getPost('password'), PASSWORD_DEFAULT);
        }

        // Update data
        $this->userModel->update($user_id, $updateData);

        return redirect()->to('/admin/penyewa')->with('success', 'Data penyewa berhasil diperbarui.');
    }

    // [C R U D] - D (Delete): Menghapus data penyewa
    public function delete($user_id)
    {
        $penyewa = $this->userModel->find($user_id);
        if (!$penyewa || $penyewa['role'] !== 'Penyewa') {
            return redirect()->back()->with('error', 'Penyewa tidak ditemukan.');
        }

        try {
            $this->userModel->delete($user_id);
            return redirect()->to('/admin/penyewa')->with('success', 'Data penyewa berhasil dihapus.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal menghapus penyewa. Penyewa mungkin memiliki riwayat transaksi aktif.');
        }
    }

    // **Catatan Tambahan:** Fungsi Update Data Detail (nama, email, dll.) juga dapat ditambahkan di sini.
}