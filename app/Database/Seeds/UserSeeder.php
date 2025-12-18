<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run()
    {
        // Clear existing data to avoid duplicate key errors
        $this->db->table('user')->truncate();

        $data = [
            [
                'username'      => 'admin',
                'password'      => password_hash('admin123', PASSWORD_DEFAULT),
                'role'          => 'Admin',
                'nama'          => 'Admin SmartKos',
                'email'         => 'admin@smartkos.com',
                'no_telp'       => '081234567890',
                'is_active'     => 1,
                'tanggal_masuk' => date('Y-m-d'),
                'created_at'    => date('Y-m-d H:i:s'),
                'updated_at'    => date('Y-m-d H:i:s'),
            ]
        ];

        // Data 10 user perempuan sebagai penyewa
        $namaPerempuan = [
            'Siti Nurhaliza',
            'Maya Sari Dewi',
            'Rina Kartika',
            'Dewi Lestari',
            'Anita Permata',
            'Sri Wahyuni',
            'Putri Amelia',
            'Novi Indah Sari',
            'Lina Marlina',
            'Ratna Sari'
        ];

        foreach ($namaPerempuan as $index => $nama) {
            $username = 'penyewa' . ($index + 1);
            $email = strtolower(str_replace(' ', '', $nama)) . '@gmail.com';
            $noTelp = '08' . str_pad(mt_rand(100000000, 999999999), 9, '0', STR_PAD_LEFT);

            $data[] = [
                'username'      => $username,
                'password'      => password_hash('penyewa123', PASSWORD_DEFAULT),
                'role'          => 'Penyewa',
                'nama'          => $nama,
                'email'         => $email,
                'no_telp'       => $noTelp,
                'is_active'     => 1,
                'tanggal_masuk' => date('Y-m-d', strtotime('-' . mt_rand(1, 365) . ' days')),
                'created_at'    => date('Y-m-d H:i:s'),
                'updated_at'    => date('Y-m-d H:i:s'),
            ];
        }

        $this->db->table('user')->insertBatch($data);
    }
}
