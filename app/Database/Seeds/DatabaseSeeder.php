<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        // Disable foreign key checks temporarily so truncates won't fail
        $this->db->disableForeignKeyChecks();

        // Ensure a safe truncate order (children first) in case DB user cannot toggle FK checks
        $this->db->table('pembayaran')->truncate();
        $this->db->table('booking')->truncate();
        $this->db->table('kamar')->truncate();
        $this->db->table('user')->truncate();

        // Seed in order: users -> kamar -> booking -> pembayaran
        $this->call('App\\Database\\Seeds\\UserSeeder');
        $this->call('App\\Database\\Seeds\\KamarSeeder');
        $this->call('App\\Database\\Seeds\\BookingSeeder');
        $this->call('App\\Database\\Seeds\\PembayaranSeeder');

        // Re-enable foreign key checks
        $this->db->enableForeignKeyChecks();
    }
}
