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
            ],
            [
                'username'      => 'penyewa1',
                'password'      => password_hash('penyewa123', PASSWORD_DEFAULT),
                'role'          => 'Penyewa',
                'nama'          => 'Penyewa Contoh',
                'email'         => 'penyewa@example.com',
                'no_telp'       => '0850987654321',
                'is_active'     => 1,
                'tanggal_masuk' => date('Y-m-d'),
                'created_at'    => date('Y-m-d H:i:s'),
                'updated_at'    => date('Y-m-d H:i:s'),
            ]
        ];

        $this->db->table('user')->insertBatch($data);
    }
}
