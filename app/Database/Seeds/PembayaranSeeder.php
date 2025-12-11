<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class PembayaranSeeder extends Seeder
{
    public function run()
    {
        // Clear existing payments
        $this->db->table('pembayaran')->truncate();

        $db = \Config\Database::connect();

        $user = $db->table('user')->where('role', 'Penyewa')->get()->getRowArray();
        $kamar = $db->table('kamar')->get()->getRowArray();

        if (! $user) {
            return;
        }

        $data = [
            'user_id' => $user['user_id'],
            'kamar_id' => $kamar['kamar_id'] ?? null,
            'jenis_pembayaran' => 'DP/Awal',
            'tagihan_bulan' => date('Y-m-d'),
            'jumlah' => '250000.00',
            'tanggal_bayar' => date('Y-m-d'),
            'metode' => 'Transfer Bank',
            'bukti_transfer' => null,
            'status' => 'Menunggu Verifikasi',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ];

        $this->db->table('pembayaran')->insert($data);
    }
}
