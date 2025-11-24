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

    // [C R U D] - R (Read/Index): Menampilkan daftar semua kamar
    public function index()
    {
        $data['kamars'] = $this->kamarModel->orderBy('nomor_kamar', 'ASC')->findAll();
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
            // Pindahkan file ke folder publik (pastikan folder 'img/kamar' ada)
            $fileFoto->move('./img/kamar', $namaFoto); 
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

        if ($fileFoto->isValid() && ! $fileFoto->hasMoved()) {
            // Hapus foto lama jika ada
            if ($kamarLama['foto_kamar'] && file_exists('./img/kamar/' . $kamarLama['foto_kamar'])) {
                unlink('./img/kamar/' . $kamarLama['foto_kamar']);
            }
            $namaFoto = $fileFoto->getRandomName();
            $fileFoto->move('./img/kamar', $namaFoto);
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
            if ($kamar['foto_kamar'] && file_exists('./img/kamar/' . $kamar['foto_kamar'])) {
                unlink('./img/kamar/' . $kamar['foto_kamar']);
            }
            
            $this->kamarModel->delete($kamar_id);
            return redirect()->to('/admin/kamar')->with('success', 'Data Kamar berhasil dihapus.');
        } catch (\Exception $e) {
            // Handle error jika ada batasan Foreign Key yang gagal dihapus (misalnya: jika CASCADE tidak diatur)
            return redirect()->back()->with('error', 'Gagal menghapus kamar. Kamar mungkin memiliki riwayat transaksi aktif.');
        }
    }
}