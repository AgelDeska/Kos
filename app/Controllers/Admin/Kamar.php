<?php namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\KamarModel;

class Kamar extends BaseController
{
    protected $kamarModel;

    public function __construct()
    {
        $this->kamarModel = new KamarModel();
    }

    // [C R U D] - R (Read/Index): Menampilkan daftar semua kamar dengan filter dan search
    public function index()
    {
        $search = $this->request->getGet('search') ?? '';
        $status = $this->request->getGet('status') ?? '';
        $sortBy = $this->request->getGet('sortBy') ?? 'nomor_kamar';
        $sortOrder = $this->request->getGet('sortOrder') ?? 'ASC';

        $query = $this->kamarModel;

        // Filter berdasarkan search (nomor kamar atau tipe kamar)
        if (!empty($search)) {
            $query = $query->groupStart()
                ->like('nomor_kamar', $search)
                ->orLike('tipe_kamar', $search)
                ->orLike('deskripsi', $search)
                ->groupEnd();
        }

        // Filter berdasarkan status
        if (!empty($status)) {
            $query = $query->where('status', $status);
        }

        // Sort (hanya izinkan kolom yang valid)
        $allowedColumns = ['nomor_kamar', 'tipe_kamar', 'kapasitas', 'harga', 'status'];
        if (in_array($sortBy, $allowedColumns)) {
            $query = $query->orderBy($sortBy, strtoupper($sortOrder));
        } else {
            $query = $query->orderBy('nomor_kamar', 'ASC');
        }

        $data['kamars'] = $query->findAll();
        $data['search'] = $search;
        $data['status'] = $status;
        $data['sortBy'] = $sortBy;
        $data['sortOrder'] = $sortOrder;

        return view('admin/kamar/index', $data); // View daftar tabel kamar
    }

    // [C R U D] - C (Create): Menampilkan form tambah kamar
    public function create()
    {
        // helper('form'); // Pastikan helper form dimuat di Config/Autoload.php atau di sini
        $data = ['validation' => \Config\Services::validation()];
        return view('admin/kamar/create', $data);
    }

    // [C R U D] - C (Store): Menyimpan data kamar baru
    public function store()
    {
        // 1. Validasi Input
        if (!$this->validate($this->kamarModel->getValidationRules())) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        // 2. Upload Foto Kamar (Opsional)
        $fileFoto = $this->request->getFile('foto_kamar');
        $namaFoto = null;

        if ($fileFoto && $fileFoto->isValid() && ! $fileFoto->hasMoved()) {
            $namaFoto = $fileFoto->getRandomName();
            // Pindahkan file ke folder publik (pastikan folder 'public/img/kamar' ada)
            try {
                $fileFoto->move(FCPATH . 'img/kamar', $namaFoto);
            } catch (\Exception $e) {
                log_message('error', 'Kamar::store - foto upload gagal: ' . $e->getMessage());
                $namaFoto = null;
            }
        }

        // 3. Simpan Data ke Database
        $success = $this->kamarModel->save([
            'nomor_kamar' => $this->request->getPost('nomor_kamar'),
            'tipe_kamar'  => $this->request->getPost('tipe_kamar'),
            'kapasitas'   => $this->request->getPost('kapasitas'),
            'harga'       => $this->request->getPost('harga'),
            'deskripsi'   => $this->request->getPost('deskripsi'),
            'foto_kamar'  => $namaFoto,
            'status'      => $this->request->getPost('status') ?? 'Tersedia',
        ]);
        
        if ($success) {
            return redirect()->to('/admin/kamar')->with('success', 'Data Kamar berhasil ditambahkan.');
        } else {
            return redirect()->back()->with('error', 'Gagal menyimpan data kamar.');
        }
    }

    // [C R U D] - U (Edit): Menampilkan form edit kamar
    public function edit($kamar_id)
    {
        $data['kamar'] = $this->kamarModel->find($kamar_id);
        if (!$data['kamar']) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound('Data kamar tidak ditemukan.');
        }
        $data['validation'] = \Config\Services::validation();
        return view('admin/kamar/edit', $data);
    }

    // [C R U D] - U (Update): Memperbarui data kamar
    public function update($kamar_id)
    {
        // 1. Validasi Input (dengan pengecualian untuk nomor_kamar unik)
        $rules = $this->kamarModel->getValidationRules();
        $rules['nomor_kamar'] = "required|max_length[50]|is_unique[kamar.nomor_kamar,kamar_id,{$kamar_id}]";
        
        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $kamarLama = $this->kamarModel->find($kamar_id);
        if (!$kamarLama) {
             return redirect()->back()->with('error', 'Kamar yang akan diupdate tidak ditemukan.');
        }

        // 2. Upload Foto Baru (jika ada)
        $fileFoto = $this->request->getFile('foto_kamar');
        $namaFoto = $kamarLama['foto_kamar']; // Default ke nama foto lama

        if ($fileFoto && $fileFoto->isValid() && ! $fileFoto->hasMoved()) {
            // Hapus foto lama jika ada
            if (! empty($kamarLama['foto_kamar']) && file_exists(FCPATH . 'img/kamar/' . $kamarLama['foto_kamar'])) {
                @unlink(FCPATH . 'img/kamar/' . $kamarLama['foto_kamar']);
            }
            $namaFoto = $fileFoto->getRandomName();
            try {
                $fileFoto->move(FCPATH . 'img/kamar', $namaFoto);
            } catch (\Exception $e) {
                log_message('error', 'Kamar::update - foto upload gagal: ' . $e->getMessage());
                // jika gagal, kembalikan ke nama lama
                $namaFoto = $kamarLama['foto_kamar'];
            }
        }

        // 3. Update Data ke Database
        $this->kamarModel->update($kamar_id, [
            'nomor_kamar' => $this->request->getPost('nomor_kamar'),
            'tipe_kamar'  => $this->request->getPost('tipe_kamar'),
            'kapasitas'   => $this->request->getPost('kapasitas'),
            'harga'       => $this->request->getPost('harga'),
            'deskripsi'   => $this->request->getPost('deskripsi'),
            'foto_kamar'  => $namaFoto,
            'status'      => $this->request->getPost('status'),
        ]);

        return redirect()->to('/admin/kamar')->with('success', 'Data Kamar berhasil diperbarui.');
    }

    // Quick status update from index (AJAX-compatible via POST)
    public function updateStatus($kamar_id)
    {
        $kamar = $this->kamarModel->find($kamar_id);
        if (!$kamar) {
            return redirect()->back()->with('error', 'Kamar tidak ditemukan.');
        }

        $status = $this->request->getPost('status');
        $allowed = ['Tersedia', 'Di Booking', 'Terisi', 'Perbaikan'];
        if (!in_array($status, $allowed)) {
            return redirect()->back()->with('error', 'Status tidak valid.');
        }

        $this->kamarModel->update($kamar_id, ['status' => $status]);
        return redirect()->back()->with('success', 'Status kamar berhasil diperbarui.');
    }

    // [C R U D] - D (Delete): Menghapus data kamar
    public function delete($kamar_id)
    {
        $kamar = $this->kamarModel->find($kamar_id);
        if (!$kamar) {
             return redirect()->back()->with('error', 'Kamar yang akan dihapus tidak ditemukan.');
        }

        // Peringatan: Pastikan tidak ada data booking/pembayaran yang terkait.
        // Karena kita menggunakan CASCADE di migrasi, data terkait akan ikut terhapus.
        try {
            // Hapus file foto jika ada
            if (! empty($kamar['foto_kamar']) && file_exists(FCPATH . 'img/kamar/' . $kamar['foto_kamar'])) {
                @unlink(FCPATH . 'img/kamar/' . $kamar['foto_kamar']);
            }
            
            $this->kamarModel->delete($kamar_id);
            return redirect()->to('/admin/kamar')->with('success', 'Data Kamar berhasil dihapus.');
        } catch (\Exception $e) {
            // Handle error jika ada batasan Foreign Key yang gagal dihapus (misalnya: jika CASCADE tidak diatur)
            return redirect()->back()->with('error', 'Gagal menghapus kamar. Kamar mungkin memiliki riwayat transaksi aktif.');
        }
    }
}