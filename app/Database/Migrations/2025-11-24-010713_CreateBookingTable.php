<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateBookingTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'booking_id' => [
                'type'           => 'INT',
                'constraint'     => 5,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'user_id' => [
                'type'           => 'INT',
                'constraint'     => 5,
                'unsigned'       => true,
            ],
            'kamar_id' => [
                'type'           => 'INT',
                'constraint'     => 5,
                'unsigned'       => true,
            ],
            'tanggal_booking' => [
                'type' => 'DATETIME', // Diubah ke DATETIME
            ],
            'durasi_sewa_bulan' => [ // Durasi sewa yang diminta
                'type'       => 'INT',
                'constraint' => 2,
                'default'    => 1,
            ],
            'tanggal_mulai_sewa' => [ // Tanggal efektif mulai sewa
                'type' => 'DATE',
                'null' => true,
            ],
            'tanggal_selesai_sewa' => [ // Tanggal berakhir sewa
                'type' => 'DATE',
                'null' => true,
            ],
            'status' => [
                'type'       => 'ENUM',
                'constraint' => ['Menunggu', 'Diterima', 'Ditolak', 'Aktif'], // 'Aktif' berarti booking sudah lunas dan penyewa sudah menempati
                'default'    => 'Menunggu',
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'updated_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
        ]);
        
        $this->forge->addKey('booking_id', true);
        $this->forge->addForeignKey('user_id', 'user', 'user_id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('kamar_id', 'kamar', 'kamar_id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('booking');
    }

    public function down()
    {
        $this->forge->dropTable('booking');
    }
}