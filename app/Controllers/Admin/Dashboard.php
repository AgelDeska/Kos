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

        // Data keuangan
        $currentMonth = date('Y-m');
        $currentYear = date('Y');

        // Total pemasukan bulan ini
        $totalPemasukanBulanIni = $pembayaranModel
            ->selectSum('jumlah')
            ->where('status', 'Lunas')
            ->where('DATE_FORMAT(tanggal_bayar, "%Y-%m")', $currentMonth)
            ->get()
            ->getRowArray()['jumlah'] ?? 0;

        // Total pemasukan tahun ini
        $totalPemasukanTahunIni = $pembayaranModel
            ->selectSum('jumlah')
            ->where('status', 'Lunas')
            ->where('YEAR(tanggal_bayar)', $currentYear)
            ->get()
            ->getRowArray()['jumlah'] ?? 0;

        // Total pemasukan semua waktu
        $totalPemasukanSemua = $pembayaranModel
            ->selectSum('jumlah')
            ->where('status', 'Lunas')
            ->get()
            ->getRowArray()['jumlah'] ?? 0;

        // Jumlah pembayaran bulan ini
        $jumlahPembayaranBulanIni = $pembayaranModel
            ->where('status', 'Lunas')
            ->where('DATE_FORMAT(tanggal_bayar, "%Y-%m")', $currentMonth)
            ->countAllResults();

        // Rata-rata pemasukan per bulan
        $rataRataPerBulan = $pembayaranModel
            ->select('AVG(monthly_total) as rata_rata')
            ->from('(
                SELECT SUM(jumlah) as monthly_total
                FROM pembayaran
                WHERE status = "Lunas"
                GROUP BY DATE_FORMAT(tanggal_bayar, "%Y-%m")
            ) as monthly_totals', false)
            ->get()
            ->getRowArray()['rata_rata'] ?? 0;

        // Pemasukan per jenis pembayaran bulan ini
        $pemasukanBulanan = $pembayaranModel
            ->select('jenis_pembayaran, SUM(jumlah) as total')
            ->where('status', 'Lunas')
            ->where('DATE_FORMAT(tanggal_bayar, "%Y-%m")', $currentMonth)
            ->groupBy('jenis_pembayaran')
            ->findAll();

        $pemasukanDP = 0;
        $pemasukanBulananAmount = 0;
        foreach ($pemasukanBulanan as $pemasukan) {
            if ($pemasukan['jenis_pembayaran'] === 'DP/Awal') {
                $pemasukanDP = $pemasukan['total'];
            } elseif ($pemasukan['jenis_pembayaran'] === 'Bulanan') {
                $pemasukanBulananAmount = $pemasukan['total'];
            }
        }

        $data = [
            'total_kamar' => $kamarModel->countAllResults(),
            'kamar_tersedia' => $kamarModel->where('status', 'Tersedia')->countAllResults(),
            'kamar_terisi' => $kamarModel->where('status', 'Terisi')->countAllResults(),
            'total_penyewa' => $userModel->where('role', 'Penyewa')->countAllResults(),
            'booking_menunggu' => $bookingModel->where('status', 'Menunggu')->countAllResults(),
            'pembayaran_pending' => $pembayaranModel->where('status', 'Menunggu Verifikasi')->countAllResults(),

            // Data keuangan
            'total_pemasukan_bulan_ini' => $totalPemasukanBulanIni,
            'total_pemasukan_tahun_ini' => $totalPemasukanTahunIni,
            'total_pemasukan_semua' => $totalPemasukanSemua,
            'jumlah_pembayaran_bulan_ini' => $jumlahPembayaranBulanIni,
            'rata_rata_per_bulan' => $rataRataPerBulan,
            'pemasukan_dp_bulan_ini' => $pemasukanDP,
            'pemasukan_bulanan_bulan_ini' => $pemasukanBulananAmount,

            // Ambil data terbaru untuk grafik/tabel ringkas
            'recent_bookings' => $bookingModel->orderBy('created_at', 'DESC')->findAll(5),
            'recent_payments' => $pembayaranModel
                ->select('pembayaran.*, user.nama as nama_penyewa, kamar.nomor_kamar')
                ->join('user', 'user.user_id = pembayaran.user_id', 'left')
                ->join('kamar', 'kamar.kamar_id = pembayaran.kamar_id', 'left')
                ->orderBy('pembayaran.created_at', 'DESC')
                ->findAll(5),
        ];

        return view('admin/dashboard', $data); // Laporan/Dashboard Admin
    }
}