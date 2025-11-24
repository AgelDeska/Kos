<?php namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\PembayaranModel;
use App\Models\BookingModel;
use App\Models\KamarModel;
use App\Models\UserModel; // Diperlukan untuk form input manual

class Pembayaran extends BaseController
{
    protected $pembayaranModel;
    protected $bookingModel;
    protected $kamarModel;
    protected $userModel;

    public function __construct()
    {
        $this->pembayaranModel = new PembayaranModel();
        $this->bookingModel = new BookingModel();
        $this->kamarModel = new KamarModel();
        $this->userModel = new UserModel();
    }

    // [C R U D] - R (Read/Index): Daftar semua pembayaran
    public function index()
    {
        // Ambil detail pembayaran dengan JOIN dari Model
        $data['pembayarans'] = $this->pembayaranModel->getPembayaranDetail(); 
        return view('admin/pembayaran/index', $data);
    }

    // [C R U D] - C (Create): Form tambah pembayaran manual (oleh Admin)
    public function create()
    {
        $data['users'] = $this->userModel->where('role', 'Penyewa')->findAll();
        $data['kamars'] = $this->kamarModel->findAll();
        $data['validation'] = \Config\Services::validation();
        return view('admin/pembayaran/create', $data);
    }

    // [C R U D] - C (Store): Menyimpan pembayaran manual
    public function store()
    {
        if (!$this->validate($this->pembayaranModel->getValidationRules())) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        // Simpan Data
        $this->pembayaranModel->save([
            'user_id'          => $this->request->getPost('user_id'),
            'kamar_id'         => $this->request->getPost('kamar_id'),
            'jenis_pembayaran' => $this->request->getPost('jenis_pembayaran'),
            'tagihan_bulan'    => $this->request->getPost('tagihan_bulan'),
            'jumlah'           => $this->request->getPost('jumlah'),
            'tanggal_bayar'    => date('Y-m-d'), // Tanggal hari ini
            'metode'           => $this->request->getPost('metode') ?? 'Kas/Manual',
            'status'           => 'Lunas', // Jika admin input manual, diasumsikan langsung Lunas
        ]);

        return redirect()->to('/admin/pembayaran')->with('success', 'Pembayaran manual berhasil dicatat.');
    }

    // [C R U D] - U (Update/Verify): Proses verifikasi pembayaran
    public function verify($pembayaran_id)
    {
        $pembayaran = $this->pembayaranModel->find($pembayaran_id);
        if (!$pembayaran) {
            return redirect()->back()->with('error', 'Data pembayaran tidak ditemukan.');
        }

        $action = $this->request->getPost('action'); // 'lunas' atau 'tolak'
        $kamarId = $pembayaran['kamar_id'];
        $userId = $pembayaran['user_id'];

        if ($action === 'lunas') {
            $this->pembayaranModel->update($pembayaran_id, ['status' => 'Lunas']);

            // Jika ini pembayaran DP/Awal, segera aktifkan status kamar & booking
            if ($pembayaran['jenis_pembayaran'] === 'DP/Awal') {
                $this->kamarModel->update($kamarId, ['status' => 'Terisi']);

                // Cari booking yang terkait status 'Diterima' dan ubah menjadi 'Aktif'
                $bookingAktif = $this->bookingModel->where('user_id', $userId)
                                                    ->where('kamar_id', $kamarId)
                                                    ->where('status', 'Diterima')
                                                    ->first();
                if ($bookingAktif) {
                    $this->bookingModel->update($bookingAktif['booking_id'], ['status' => 'Aktif']);
                    // Update juga tanggal masuk penyewa
                    $this->userModel->update($userId, ['tanggal_masuk' => $bookingAktif['tanggal_mulai_sewa']]);
                }
            }
            return redirect()->back()->with('success', 'Pembayaran berhasil diverifikasi (Lunas).');
            
        } elseif ($action === 'tolak') {
            $this->pembayaranModel->update($pembayaran_id, ['status' => 'Ditolak']);
            
            // Logika: Jika ini pembayaran DP, maka booking yang terkait harus dibatalkan/ditinjau ulang
            return redirect()->back()->with('warning', 'Pembayaran ditolak/dibatalkan.');
        }

        return redirect()->back();
    }
    
    // [C R U D] - D (Delete): Menghapus data pembayaran
    public function delete($pembayaran_id)
    {
        $pembayaran = $this->pembayaranModel->find($pembayaran_id);
        if (!$pembayaran) {
             return redirect()->back()->with('error', 'Data pembayaran tidak ditemukan.');
        }

        // Hapus bukti transfer (jika ada)
        if ($pembayaran['bukti_transfer'] && file_exists('./img/bukti/' . $pembayaran['bukti_transfer'])) {
            unlink('./img/bukti/' . $pembayaran['bukti_transfer']);
        }
        
        $this->pembayaranModel->delete($pembayaran_id);
        return redirect()->to('/admin/pembayaran')->with('success', 'Data Pembayaran berhasil dihapus.');
    }
}