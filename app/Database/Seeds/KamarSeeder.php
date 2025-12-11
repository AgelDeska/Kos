<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class KamarSeeder extends Seeder
{
    public function run()
    {
        // Clear existing data
        $this->db->table('kamar')->truncate();

        $data = [
            [
                'nomor_kamar' => 'A-101',
                'tipe_kamar'  => 'Single',
                'kapasitas'   => 1,
                'harga'       => '500000.00',
                'deskripsi'   => 'Kamar single, cocok untuk mahasiswa.',
                'foto_kamar'  => 'kamar_a101.jpg',
                'status'      => 'Tersedia',
                'created_at'  => date('Y-m-d H:i:s'),
                'updated_at'  => date('Y-m-d H:i:s'),
            ],
            [
                'nomor_kamar' => 'A-102',
                'tipe_kamar'  => 'Double',
                'kapasitas'   => 2,
                'harga'       => '800000.00',
                'deskripsi'   => 'Kamar double dengan AC.',
                'foto_kamar'  => 'kamar_a102.jpg',
                'status'      => 'Tersedia',
                'created_at'  => date('Y-m-d H:i:s'),
                'updated_at'  => date('Y-m-d H:i:s'),
            ],
            [
                'nomor_kamar' => 'B-201',
                'tipe_kamar'  => 'Premium',
                'kapasitas'   => 1,
                'harga'       => '1500000.00',
                'deskripsi'   => 'Kamar premium lengkap fasilitas.',
                'foto_kamar'  => 'kamar_b201.jpg',
                'status'      => 'Tersedia',
                'created_at'  => date('Y-m-d H:i:s'),
                'updated_at'  => date('Y-m-d H:i:s'),
            ],
        ];

        $this->db->table('kamar')->insertBatch($data);
    }
}
