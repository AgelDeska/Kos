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

    // Daftar semua booking dengan filter dan search
    public function index()
    {
        $search = $this->request->getGet('search') ?? '';
        $status = $this->request->getGet('status') ?? '';
        $sortBy = $this->request->getGet('sortBy') ?? 'tanggal_booking';
        $sortOrder = $this->request->getGet('sortOrder') ?? 'DESC';

        // Ambil booking dengan JOIN
        $bookings = $this->bookingModel->getBookingDetail();

        // Filter berdasarkan search (username, nomor kamar)
        if (!empty($search)) {
            $bookings = array_filter($bookings, function($b) use ($search) {
                $searchLower = strtolower($search);
                return (stripos($b['username'], $searchLower) !== false ||
                        stripos($b['nomor_kamar'], $searchLower) !== false);
            });
        }

        // Filter berdasarkan status
        if (!empty($status)) {
            $bookings = array_filter($bookings, function($b) use ($status) {
                return $b['status'] === $status;
            });
        }

        // Sort
        if (!empty($bookings)) {
            usort($bookings, function($a, $b) use ($sortBy, $sortOrder) {
                $valueA = $a[$sortBy] ?? '';
                $valueB = $b[$sortBy] ?? '';

                if (in_array($sortBy, ['tanggal_booking', 'tanggal_mulai_sewa'])) {
                    $valueA = strtotime($valueA);
                    $valueB = strtotime($valueB);
                } elseif (in_array($sortBy, ['durasi_sewa_bulan'])) {
                    $valueA = (int)$valueA;
                    $valueB = (int)$valueB;
                }

                if ($valueA == $valueB) return 0;
                $result = ($valueA < $valueB) ? -1 : 1;
                return ($sortOrder === 'DESC') ? -$result : $result;
            });
        }

        $data['bookings'] = $bookings;
        $data['search'] = $search;
        $data['status'] = $status;
        $data['sortBy'] = $sortBy;
        $data['sortOrder'] = $sortOrder;

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

            // 2. Otomatis tolak semua booking lain untuk kamar yang sama yang masih 'Menunggu'
            $this->bookingModel->where('kamar_id', $kamarId)
                               ->where('status', 'Menunggu')
                               ->where('booking_id !=', $booking_id)
                               ->set(['status' => 'Ditolak'])
                               ->update();

            // 3. Ubah status kamar menjadi 'Di Booking'
            $this->kamarModel->update($kamarId, ['status' => 'Di Booking']);

            return redirect()->back()->with('success', 'Booking berhasil Diterima. Booking lainnya untuk kamar ini otomatis ditolak.');

        } elseif ($action === 'tolak') {
            // 1. Update status booking menjadi Ditolak
            $this->bookingModel->update($booking_id, ['status' => 'Ditolak']);

            // 2. Kembalikan status kamar menjadi 'Tersedia' jika tidak ada booking aktif
            $activeBookings = $this->bookingModel->where('kamar_id', $kamarId)
                                                 ->whereIn('status', ['Diterima', 'Aktif'])
                                                 ->countAllResults();
            if ($activeBookings == 0) {
                $this->kamarModel->update($kamarId, ['status' => 'Tersedia']);
            }

            return redirect()->back()->with('success', 'Booking berhasil Ditolak.');
        }

        return redirect()->back();
    }
}