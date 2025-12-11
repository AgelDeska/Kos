<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class BookingSeeder extends Seeder
{
    public function run()
    {
        // Clear existing bookings
        $this->db->table('booking')->truncate();

        $db = \Config\Database::connect();

        // Ambil satu user penyewa dan satu kamar untuk contoh booking
        $user = $db->table('user')->where('role', 'Penyewa')->get()->getRowArray();
        $kamar = $db->table('kamar')->get()->getRowArray();

        if (! $user || ! $kamar) {
            // Tidak ada data untuk membuat booking
            return;
        }

        $booking = [
            'user_id' => $user['user_id'],
            'kamar_id' => $kamar['kamar_id'],
            'tanggal_booking' => date('Y-m-d H:i:s'),
            'durasi_sewa_bulan' => 1,
            'tanggal_mulai_sewa' => date('Y-m-d', strtotime('+7 days')),
            'tanggal_selesai_sewa' => date('Y-m-d', strtotime('+1 month +7 days')),
            'status' => 'Menunggu',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ];

        $this->db->table('booking')->insert($booking);
    }
}
