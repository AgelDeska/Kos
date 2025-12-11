<?php namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\BookingModel;
use App\Models\KamarModel;
use App\Models\PembayaranModel;

class PenyewaController extends BaseController
{
    protected $bookingModel;
    protected $kamarModel;
    protected $pembayaranModel;
    protected $userId;

    public function __construct()
    {
        $this->bookingModel = new BookingModel();
        $this->kamarModel = new KamarModel();
        $this->pembayaranModel = new PembayaranModel();
        $this->userId = session()->get('user_id');
    }

    public function dashboard()
    {
        // Hanya menampilkan status ringkas Penyewa
        $data['riwayat_booking'] = $this->bookingModel->where('user_id', $this->userId)->orderBy('tanggal_booking', 'DESC')->findAll(5);
        $data['riwayat_pembayaran'] = $this->pembayaranModel->where('user_id', $this->userId)->orderBy('tanggal_bayar', 'DESC')->findAll(5);
        return view('penyewa/dashboard', $data);
    }

    // Menampilkan formulir booking
    public function formBooking($kamar_id)
    {
        $data['kamar'] = $this->kamarModel->find($kamar_id);
        if (!$data['kamar'] || $data['kamar']['status'] != 'Tersedia') {
            return redirect()->back()->with('error', 'Kamar tidak tersedia untuk booking.');
        }
        return view('penyewa/form_booking', $data);
    }

    // Proses booking kamar (UC-5)
    public function saveBooking()
    {
        $rules = [
            'kamar_id'          => 'required|integer',
            'durasi_sewa_bulan' => 'required|integer|greater_than[0]',
            'tanggal_mulai_sewa' => 'required|valid_date',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $kamarId = $this->request->getPost('kamar_id');
        $durasi = (int) $this->request->getPost('durasi_sewa_bulan');
        $tglMulai = $this->request->getPost('tanggal_mulai_sewa');
        $tglSelesai = date('Y-m-d', strtotime("+$durasi months", strtotime($tglMulai)));

        // Simpan data booking dengan status 'Menunggu'
        $this->bookingModel->save([
            'user_id'              => $this->userId,
            'kamar_id'             => $kamarId,
            'tanggal_booking'      => date('Y-m-d H:i:s'),
            'durasi_sewa_bulan'    => $durasi,
            'tanggal_mulai_sewa'   => $tglMulai,
            'tanggal_selesai_sewa' => $tglSelesai,
            'status'               => 'Menunggu',
        ]);

        // Ubah status kamar menjadi 'Di Booking'
        $this->kamarModel->update($kamarId, ['status' => 'Di Booking']);

        return redirect()->to('/penyewa/riwayat-booking')->with('success', 'Booking berhasil! Menunggu verifikasi Admin.');
    }

    // Riwayat Booking Penyewa
    public function riwayatBooking()
    {
        $data['bookings'] = $this->bookingModel->getBookingDetail(null); // Gunakan metode join di Model
        return view('penyewa/riwayat_booking', $data);
    }

    // List Pembayaran Penyewa
    public function listPembayaran()
    {
        $data['title'] = 'Pembayaran Saya';
        $data['pembayaran'] = $this->pembayaranModel
            ->where('user_id', $this->userId)
            ->orderBy('tanggal_bayar', 'DESC')
            ->findAll();
        
        return view('penyewa/pembayaran', $data);
    }

    // Form Bayar DP
    public function formBayarDP($bookingId)
    {
        $booking = $this->bookingModel->find($bookingId);
        
        if (!$booking || $booking['user_id'] != $this->userId) {
            return redirect()->back()->with('error', 'Booking tidak ditemukan.');
        }

        if ($booking['status'] != 'Diterima') {
            return redirect()->back()->with('error', 'Booking harus diterima admin untuk bisa bayar DP.');
        }

        $data['title'] = 'Form Pembayaran DP';
        $data['booking'] = $booking;
        $data['kamar'] = $this->kamarModel->find($booking['kamar_id']);
        
        return view('penyewa/form_bayar_dp', $data);
    }

    // Upload Bukti Pembayaran
    public function uploadBukti()
    {
        $rules = [
            'booking_id'     => 'required|integer',
            'jenis_pembayaran' => 'required|in_list[DP/Awal,Bulanan]',
            'jumlah'         => 'required|numeric|greater_than[0]',
            'metode'         => 'required|in_list[Transfer Bank,E-Wallet,Cash]',
            'bukti_transfer' => 'uploaded[bukti_transfer]|mime_in[bukti_transfer,image/jpeg,image/png,image/jpg,application/pdf]|max_size[bukti_transfer,5120]',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $bookingId = $this->request->getPost('booking_id');
        $booking = $this->bookingModel->find($bookingId);

        if (!$booking || $booking['user_id'] != $this->userId) {
            return redirect()->back()->with('error', 'Booking tidak ditemukan.');
        }

        // Upload file
        $file = $this->request->getFile('bukti_transfer');
        $fileName = $file->getRandomName();
        $file->move('uploads/bukti_pembayaran', $fileName);

        // Simpan data pembayaran
        $this->pembayaranModel->save([
            'user_id'           => $this->userId,
            'kamar_id'          => $booking['kamar_id'],
            'booking_id'        => $bookingId,
            'jenis_pembayaran'  => $this->request->getPost('jenis_pembayaran'),
            'jumlah'            => $this->request->getPost('jumlah'),
            'metode'            => $this->request->getPost('metode'),
            'bukti_transfer'    => $fileName,
            'tanggal_bayar'     => date('Y-m-d H:i:s'),
            'status'            => 'Menunggu Verifikasi',
        ]);

        // Update status booking jika DP pertama
        if ($this->request->getPost('jenis_pembayaran') == 'DP/Awal') {
            $this->bookingModel->update($bookingId, ['status' => 'Aktif']);
        }

        return redirect()->to('/penyewa/pembayaran')->with('success', 'Bukti pembayaran berhasil diupload. Menunggu verifikasi admin.');
    }

    // Detail Pembayaran
    public function detailPembayaran($pembayaranId)
    {
        // Get payment record
        $pembayaran = $this->pembayaranModel
            ->where('pembayaran_id', $pembayaranId)
            ->where('user_id', $this->userId)
            ->first();

        if (!$pembayaran) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Pembayaran tidak ditemukan');
        }

        // Get related booking
        $booking = $this->bookingModel->find($pembayaran['booking_id']);

        $data = [
            'title'      => 'Detail Pembayaran',
            'pembayaran' => $pembayaran,
            'booking'    => $booking,
        ];

        return view('penyewa/detail_pembayaran', $data);
    }
}