<?php namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\PembayaranModel;
use App\Models\BookingModel;
use App\Models\KamarModel;
use App\Models\UserModel; // Diperlukan untuk form input manual
use App\Models\SettingModel;

class Pembayaran extends BaseController
{
    protected $pembayaranModel;
    protected $bookingModel;
    protected $kamarModel;
    protected $userModel;
    protected $settingModel;

    public function __construct()
    {
        $this->pembayaranModel = new PembayaranModel();
        $this->bookingModel = new BookingModel();
        $this->kamarModel = new KamarModel();
        $this->userModel = new UserModel();
        $this->settingModel = new SettingModel();
    }

    // [C R U D] - R (Read/Index): Daftar semua pembayaran dengan filter dan search
    public function index()
    {
        $search = $this->request->getGet('search') ?? '';
        $status = $this->request->getGet('status') ?? '';
        $sortBy = $this->request->getGet('sortBy') ?? 'tanggal_bayar';
        $sortOrder = $this->request->getGet('sortOrder') ?? 'DESC';

        // Ambil pembayaran dengan JOIN
        $pembayarans = $this->pembayaranModel->getPembayaranDetail();

        // Filter berdasarkan search (username, nomor kamar)
        if (!empty($search)) {
            $pembayarans = array_filter($pembayarans, function($p) use ($search) {
                $searchLower = strtolower($search);
                return (stripos($p['username'], $searchLower) !== false ||
                        stripos($p['nomor_kamar'], $searchLower) !== false ||
                        stripos($p['jenis_pembayaran'], $searchLower) !== false);
            });
        }

        // Filter berdasarkan status
        if (!empty($status)) {
            $pembayarans = array_filter($pembayarans, function($p) use ($status) {
                return $p['status'] === $status;
            });
        }

        // Sort
        if (!empty($pembayarans)) {
            usort($pembayarans, function($a, $b) use ($sortBy, $sortOrder) {
                $valueA = $a[$sortBy] ?? '';
                $valueB = $b[$sortBy] ?? '';

                if (in_array($sortBy, ['tanggal_bayar'])) {
                    $valueA = strtotime($valueA);
                    $valueB = strtotime($valueB);
                } elseif ($sortBy === 'jumlah') {
                    $valueA = (int)$valueA;
                    $valueB = (int)$valueB;
                }

                if ($valueA == $valueB) return 0;
                $result = ($valueA < $valueB) ? -1 : 1;
                return ($sortOrder === 'DESC') ? -$result : $result;
            });
        }

        $data['pembayarans'] = $pembayarans;
        $data['search'] = $search;
        $data['status'] = $status;
        $data['sortBy'] = $sortBy;
        $data['sortOrder'] = $sortOrder;

        return view('admin/pembayaran/index', $data);
    }

    // [C R U D] - C (Create): Form tambah pembayaran manual (oleh Admin)
    public function create()
    {
        $data['users'] = $this->userModel->where('role', 'Penyewa')->findAll();
        $data['kamars'] = $this->kamarModel->findAll();
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

                // Cari booking yang terkait status 'Diterima' dan ubah menjadi 'Selesai'
                $bookingAktif = $this->bookingModel->where('user_id', $userId)
                                                    ->where('kamar_id', $kamarId)
                                                    ->where('status', 'Diterima')
                                                    ->first();
                if ($bookingAktif) {
                    $this->bookingModel->update($bookingAktif['booking_id'], ['status' => 'Selesai']);
                    // Update juga tanggal masuk penyewa
                    $this->userModel->update($userId, ['tanggal_masuk' => $bookingAktif['tanggal_mulai_sewa']]);
                }
            }
            return redirect()->back()->with('success', 'Pembayaran berhasil diverifikasi (Lunas).');
            
        } elseif ($action === 'tolak') {
            $this->pembayaranModel->update($pembayaran_id, ['status' => 'Ditolak']);
            
            // Kirim notifikasi WhatsApp ke admin
            $user = $this->userModel->find($userId);
            $kamar = $this->kamarModel->find($kamarId);
            $message = "Pemberitahuan: Pembayaran dari {$user['nama']} untuk kamar {$kamar['nomor_kamar']} telah DITOLAK. Silakan tinjau ulang.";
            $this->sendWhatsAppNotification($message);
            
            return redirect()->back()->with('warning', 'Pembayaran ditolak. Notifikasi telah dikirim ke WhatsApp admin.');
        }

        return redirect()->back();
    }
    
    // Method untuk mengirim notifikasi WhatsApp ke admin
    private function sendWhatsAppNotification($message)
    {
        $adminPhone = $this->settingModel->getSetting('admin_whatsapp');
        if (!$adminPhone) {
            log_message('error', 'Nomor WhatsApp admin tidak dikonfigurasi');
            return false;
        }

        // Placeholder untuk integrasi WhatsApp API
        // Contoh menggunakan Twilio atau WhatsApp Business API
        // Untuk saat ini, hanya log pesan
        log_message('info', 'WhatsApp Notification: ' . $message . ' to ' . $adminPhone);
        
        // TODO: Implementasi actual WhatsApp sending
        // Contoh dengan curl ke API WhatsApp:
        /*
        $apiUrl = 'https://api.whatsapp.com/send'; // Ganti dengan URL API yang sesuai
        $data = [
            'phone' => $adminPhone,
            'message' => $message
        ];
        
        $ch = curl_init($apiUrl);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
        curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($ch);
        curl_close($ch);
        
        return $response;
        */
        
        return true; // Placeholder return
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