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
        // Hitung statistik dashboard
        $totalBooking = $this->bookingModel->where('user_id', $this->userId)->countAllResults();
        $bookingAktif = $this->bookingModel->where('user_id', $this->userId)->where('status', 'Selesai')->countAllResults();

        // Hitung pembayaran pending (menunggu verifikasi)
        $pembayaranPending = $this->pembayaranModel
            ->join('booking', 'booking.booking_id = pembayaran.booking_id')
            ->where('pembayaran.user_id', $this->userId)
            ->where('pembayaran.status', 'Menunggu Verifikasi')
            ->whereIn('booking.status', ['Diterima', 'Selesai'])
            ->countAllResults();

        // Hitung total pembayaran terverifikasi
        $totalPembayaranTerverifikasi = $this->pembayaranModel
            ->selectSum('jumlah')
            ->join('booking', 'booking.booking_id = pembayaran.booking_id')
            ->where('pembayaran.user_id', $this->userId)
            ->where('pembayaran.status', 'Lunas')
            ->whereIn('booking.status', ['Diterima', 'Selesai'])
            ->get()
            ->getRow()
            ->jumlah ?? 0;

        // Hitung jatuh tempo (booking aktif dengan tanggal selesai mendekati)
        $jatuhTempo = '-'; // Untuk sementara, bisa dikembangkan nanti

        $data['stats'] = [
            'total_booking' => $totalBooking,
            'booking_aktif' => $bookingAktif,
            'pembayaran_pending' => $pembayaranPending,
            'pembayaran_terverifikasi' => $totalPembayaranTerverifikasi,
            'jatuh_tempo' => $jatuhTempo
        ];

        // Riwayat terbaru
        $data['riwayat_booking'] = $this->bookingModel->where('user_id', $this->userId)->orderBy('tanggal_booking', 'DESC')->findAll(5);
        $data['riwayat_pembayaran'] = $this->pembayaranModel
            ->select('pembayaran.*, booking.status as booking_status')
            ->join('booking', 'booking.booking_id = pembayaran.booking_id')
            ->where('pembayaran.user_id', $this->userId)
            ->whereIn('booking.status', ['Diterima', 'Selesai'])
            ->orderBy('pembayaran.tanggal_bayar', 'DESC')
            ->findAll(5);

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

        // Ambil data kamar untuk kalkulasi biaya
        $kamar = $this->kamarModel->find($kamarId);
        if (!$kamar) {
            return redirect()->back()->with('error', 'Data kamar tidak ditemukan.');
        }

        // Kalkulasi biaya sesuai form booking
        $hargaPerBulan = $kamar['harga'];
        $totalBiaya = $hargaPerBulan * $durasi;
        $dpAmount = $totalBiaya * 0.5; // DP 50%

        // Simpan data booking dengan kalkulasi biaya
        $this->bookingModel->save([
            'user_id'              => $this->userId,
            'kamar_id'             => $kamarId,
            'tanggal_booking'      => date('Y-m-d H:i:s'),
            'durasi_sewa_bulan'    => $durasi,
            'tanggal_mulai_sewa'   => $tglMulai,
            'tanggal_selesai_sewa' => $tglSelesai,
            'total_biaya'          => $totalBiaya,
            'dp_amount'            => $dpAmount,
            'status'               => 'Menunggu',
        ]);

        return redirect()->to('/penyewa/riwayat-booking')->with('success', 'Booking berhasil! Menunggu verifikasi Admin.');
    }

    // Riwayat Booking Penyewa
    public function riwayatBooking()
    {
        $data['bookings'] = $this->bookingModel->getBookingDetail(null, $this->userId); // Filter berdasarkan user yang login

        if (!is_array($data['bookings'])) {
            $data['bookings'] = [];
        }
        return view('penyewa/riwayat_booking', $data);
    }

    // Detail Booking
    public function detailBooking($bookingId)
    {
        $booking = $this->bookingModel->find($bookingId);
        
        // Check if booking exists and belongs to current user
        if (!$booking) {
            session()->setFlashdata('error', 'Booking tidak ditemukan.');
            return redirect()->to('/penyewa/riwayat-booking');
        }

        // Verify ownership - only allow if user owns this booking
        if ($booking['user_id'] != $this->userId) {
            session()->setFlashdata('error', 'Anda tidak memiliki akses ke booking ini.');
            return redirect()->to('/penyewa/riwayat-booking');
        }

        $data['title'] = 'Detail Booking';
        $data['booking'] = $booking;
        $data['kamar'] = $this->kamarModel->find($booking['kamar_id']);
        
        return view('penyewa/detail_booking', $data);
    }

    // Batal Booking
    public function batalBooking($bookingId)
    {
        $booking = $this->bookingModel->find($bookingId);
        
        // Check if booking exists and belongs to current user
        if (!$booking) {
            session()->setFlashdata('error', 'Booking tidak ditemukan.');
            return redirect()->to('/penyewa/riwayat-booking');
        }

        // Verify ownership - only allow if user owns this booking
        if ($booking['user_id'] != $this->userId) {
            session()->setFlashdata('error', 'Anda tidak memiliki akses ke booking ini.');
            return redirect()->to('/penyewa/riwayat-booking');
        }

        // Only allow cancellation if status is 'Menunggu' and no payment has been made
        if ($booking['status'] != 'Menunggu') {
            session()->setFlashdata('error', 'Booking tidak dapat dibatalkan karena sudah diproses.');
            return redirect()->to('/penyewa/riwayat-booking');
        }

        // Check if there's any payment for this booking
        $existingPayment = $this->pembayaranModel
            ->where('booking_id', $bookingId)
            ->where('user_id', $this->userId)
            ->first();

        if ($existingPayment) {
            session()->setFlashdata('error', 'Booking tidak dapat dibatalkan karena sudah ada pembayaran.');
            return redirect()->to('/penyewa/riwayat-booking');
        }

        // Update booking status to 'Ditolak' (cancelled)
        $this->bookingModel->update($bookingId, ['status' => 'Ditolak']);

        // Update room status back to 'Tersedia'
        $this->kamarModel->update($booking['kamar_id'], ['status' => 'Tersedia']);

        session()->setFlashdata('success', 'Booking berhasil dibatalkan. Status kamar telah dikembalikan ke tersedia.');
        return redirect()->to('/penyewa/riwayat-booking');
    }

    // List Pembayaran Penyewa
    public function listPembayaran()
    {
        $data['title'] = 'Pembayaran Saya';

        // Ambil pembayaran yang hanya terkait dengan booking yang sudah diterima admin
        $data['pembayaran'] = $this->pembayaranModel
            ->select('pembayaran.*, booking.status as booking_status')
            ->join('booking', 'booking.booking_id = pembayaran.booking_id')
            ->where('pembayaran.user_id', $this->userId)
            ->whereIn('booking.status', ['Diterima', 'Selesai']) // Hanya booking yang sudah diterima admin
            ->orderBy('pembayaran.tanggal_bayar', 'DESC')
            ->findAll();

        // Hitung summary pembayaran
        $totalHutang = 0;
        $sudahDibayar = 0;

        // Hitung total hutang dari booking aktif (menggunakan total_biaya yang sudah tersimpan)
        $bookingAktif = $this->bookingModel
            ->where('user_id', $this->userId)
            ->where('status', 'Selesai')
            ->findAll();

        foreach ($bookingAktif as $booking) {
            $totalHutang += $booking['total_biaya'] ?? 0;
        }

        // Hitung total sudah dibayar (pembayaran yang lunas dari booking yang diterima)
        $pembayaranLunas = $this->pembayaranModel
            ->select('pembayaran.*')
            ->join('booking', 'booking.booking_id = pembayaran.booking_id')
            ->where('pembayaran.user_id', $this->userId)
            ->where('pembayaran.status', 'Lunas')
            ->whereIn('booking.status', ['Diterima', 'Selesai'])
            ->findAll();

        foreach ($pembayaranLunas as $pembayaran) {
            $sudahDibayar += $pembayaran['jumlah'];
        }

        $data['summary'] = [
            'total_hutang' => $totalHutang,
            'sudah_dibayar' => $sudahDibayar,
            'sisa_hutang' => max(0, $totalHutang - $sudahDibayar)
        ];

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

        $jenisPembayaran = $this->request->getPost('jenis_pembayaran');
        $jumlahDibayar = (float) $this->request->getPost('jumlah');

        // Validasi jumlah pembayaran sesuai dengan kalkulasi
        if ($jenisPembayaran == 'DP/Awal') {
            $expectedDp = $booking['dp_amount'] ?? 0;
            if (abs($jumlahDibayar - $expectedDp) > 0.01) { // Toleransi kecil untuk floating point
                return redirect()->back()->withInput()->with('error', 'Jumlah DP harus sesuai dengan kalkulasi: Rp ' . number_format($expectedDp, 0, ',', '.'));
            }
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

        // Get related booking with joined data
        $booking = $this->bookingModel->getBookingDetail($pembayaran['booking_id'], $this->userId);

        $data = [
            'title'      => 'Detail Pembayaran',
            'pembayaran' => $pembayaran,
            'booking'    => $booking,
        ];

        return view('penyewa/detail_pembayaran', $data);
    }

    // Download Surat Serah Terima Kamar
    public function downloadSerahTerima($pembayaranId)
    {
        $pembayaran = $this->pembayaranModel
            ->where('pembayaran_id', $pembayaranId)
            ->where('user_id', $this->userId)
            ->where('status', 'Lunas')
            ->first();

        if (!$pembayaran) {
            return redirect()->back()->with('error', 'Pembayaran tidak ditemukan atau belum lunas.');
        }

        $booking = $this->bookingModel->find($pembayaran['booking_id']);
        $kamar = $this->kamarModel->find($pembayaran['kamar_id']);
        $user = session()->get();

        // Generate document content and attempt to render PDF via Dompdf if available
        $companyName = 'SmartKos Agezitomik';
        $ownerName = 'Wita Sarmila';

        $html = "
        <html>
        <head>
            <meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />
            <style>
                body { font-family: DejaVu Sans, Arial, sans-serif; font-size:14px; color:#222; }
                .header { text-align: center; margin-bottom: 20px; }
                .header h1 { margin:0; font-size:18px; }
                .header h2 { margin:0; font-size:16px; font-weight:600; }
                .section { margin: 18px 0; }
                .muted { color:#666; font-size:13px; }
                ul { margin-left:18px; }
                .signature { margin-top:40px; display:flex; justify-content:space-between; }
                .sig-block { width:45%; text-align:center; }
            </style>
        </head>
        <body>
            <div class=\"header\">
                <h1>SURAT SERAH TERIMA KAMAR</h1>
                <h2>{$companyName}</h2>
            </div>

            <div class=\"section\">
                <p>Yang bertanda tangan di bawah ini:</p>
                <p><strong>Pemilik Kos:</strong> {$ownerName}</p>
                <p><strong>Penyewa:</strong> " . esc($user['nama']) . "</p>
            </div>

            <div class=\"section\">
                <p>Dengan ini menyatakan bahwa telah terjadi serah terima kamar sebagai berikut:</p>
                <ul>
                    <li>Nomor Kamar: " . esc($kamar['nomor_kamar']) . "</li>
                    <li>Tipe Kamar: " . esc($kamar['tipe_kamar']) . "</li>
                    <li>Tanggal Mulai Sewa: " . date('d-m-Y', strtotime($booking['tanggal_mulai_sewa'])) . "</li>
                    <li>Tanggal Selesai Sewa: " . date('d-m-Y', strtotime($booking['tanggal_selesai_sewa'])) . "</li>
                    <li>Jumlah Pembayaran: Rp " . number_format($pembayaran['jumlah'], 0, ',', '.') . "</li>
                </ul>
            </div>

            <div class=\"section muted\">
                <p>Keterangan: Kamar diserahkan dalam kondisi baik sesuai pemeriksaan awal. Penyewa bertanggung jawab atas kerusakan yang terjadi akibat kelalaian selama masa sewa.</p>
            </div>

            <div class=\"signature\">
                <div class=\"sig-block\">
                    <p>Hormat Kami,</p>
                    <br><br><br>
                    <p><strong>{$ownerName}</strong></p>
                    <p>Pemilik Kos</p>
                </div>
                <div class=\"sig-block\">
                    <p>Penyewa,</p>
                    <br><br><br>
                    <p><strong>" . esc($user['nama']) . "</strong></p>
                </div>
            </div>

            <div class=\"section muted\" style=\"margin-top:30px; text-align:right;\">
                <small>Dicetak pada: " . date('d-m-Y') . "</small>
            </div>
        </body>
        </html>
        ";

        // If Dompdf is available, generate PDF
        if (class_exists('Dompdf\Dompdf')) {
            try {
                $dompdf = new \Dompdf\Dompdf(['isHtml5ParserEnabled' => true]);
                $dompdf->loadHtml($html);
                $dompdf->setPaper('A4', 'portrait');
                $dompdf->render();

                $pdfOutput = $dompdf->output();

                return $this->response->setHeader('Content-Type', 'application/pdf')
                                      ->setHeader('Content-Disposition', 'attachment; filename="surat_serah_terima_' . $pembayaranId . '.pdf"')
                                      ->setBody($pdfOutput);
            } catch (\Exception $e) {
                // Fall through to HTML fallback
                log_message('error', 'PDF generation failed: ' . $e->getMessage());
            }
        }

        // Fallback: return HTML with instructions and correct company/owner name
        $fallback = "<html><body><h2>Surat Serah Terima - {$companyName}</h2>" . $html . "<p style=\"color:#c00;\">Note: PDF generation library (Dompdf) belum terpasang pada server. Silakan install dengan: <code>composer require dompdf/dompdf</code></p></body></html>";

        return $this->response->setHeader('Content-Type', 'text/html')
                              ->setHeader('Content-Disposition', 'attachment; filename="surat_serah_terima_' . $pembayaranId . '.html"')
                              ->setBody($fallback);
    }
}