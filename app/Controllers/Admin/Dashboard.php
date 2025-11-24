<?php namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\KamarModel;
use App\Models\BookingModel;
use App\Models\PembayaranModel;
use App\Models\UserModel;

class Dashboard extends BaseController
{
    public function index()
    {
        $kamarModel = new KamarModel();
        $bookingModel = new BookingModel();
        $pembayaranModel = new PembayaranModel();
        $userModel = new UserModel();

        $data = [
            'total_kamar' => $kamarModel->countAllResults(),
            'kamar_tersedia' => $kamarModel->where('status', 'Tersedia')->countAllResults(),
            'kamar_terisi' => $kamarModel->where('status', 'Terisi')->countAllResults(),
            'total_penyewa' => $userModel->where('role', 'Penyewa')->countAllResults(),
            'booking_menunggu' => $bookingModel->where('status', 'Menunggu')->countAllResults(),
            'pembayaran_pending' => $pembayaranModel->where('status', 'Menunggu Verifikasi')->countAllResults(),
            // Ambil data terbaru untuk grafik/tabel ringkas
            'recent_bookings' => $bookingModel->orderBy('created_at', 'DESC')->findAll(5),
            'recent_payments' => $pembayaranModel->orderBy('created_at', 'DESC')->findAll(5),
        ];

        return view('admin/dashboard', $data); // Laporan/Dashboard Admin
    }
}