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
}