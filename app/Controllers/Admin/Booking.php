<?php namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\BookingModel;
use App\Models\KamarModel;

class Booking extends BaseController
{
    protected $bookingModel;
    protected $kamarModel;

    public function __construct()
    {
        $this->bookingModel = new BookingModel();
        $this->kamarModel = new KamarModel();
    }

    // Daftar semua booking
    public function index()
    {
        $data['bookings'] = $this->bookingModel->getBookingDetail(); // Ambil detail dengan join
        return view('admin/booking/index', $data);
    }

    // Aksi untuk verifikasi booking
    public function verify($booking_id)
    {
        $booking = $this->bookingModel->find($booking_id);
        if (!$booking) {
            return redirect()->back()->with('error', 'Booking tidak ditemukan.');
        }

        $action = $this->request->getPost('action'); // 'terima' atau 'tolak'
        $kamarId = $booking['kamar_id'];

        if ($action === 'terima') {
            // 1. Update status booking menjadi Diterima
            $this->bookingModel->update($booking_id, ['status' => 'Diterima']);

            // 2. Kamar tetap 'Di Booking' sampai ada pembayaran DP/Awal

            return redirect()->back()->with('success', 'Booking berhasil Diterima. Menunggu pembayaran awal.');

        } elseif ($action === 'tolak') {
            // 1. Update status booking menjadi Ditolak
            $this->bookingModel->update($booking_id, ['status' => 'Ditolak']);

            // 2. Kembalikan status kamar menjadi 'Tersedia'
            $this->kamarModel->update($kamarId, ['status' => 'Tersedia']);

            return redirect()->back()->with('success', 'Booking berhasil Ditolak.');
        }

        return redirect()->back();
    }
}