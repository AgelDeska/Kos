<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreatePembayaranTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'pembayaran_id' => [
                'type'           => 'INT',
                'constraint'     => 5,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'user_id' => [ // Foreign Key ke user (penyewa)
                'type'           => 'INT',
                'constraint'     => 5,
                'unsigned'       => true,
            ],
            'kamar_id' => [ // Foreign Key ke kamar yang dibayarkan
                'type'           => 'INT',
                'constraint'     => 5,
                'unsigned'       => true,
                'null'           => true,
            ],
            'jenis_pembayaran' => [ // Baru: Tipe pembayaran
                'type'       => 'ENUM',
                'constraint' => ['DP/Awal', 'Bulanan', 'Lainnya'],
                'default'    => 'Bulanan',
            ],
            'tagihan_bulan' => [ // Baru: Bulan penagihan (Misal: 2025-06-01)
                'type' => 'DATE',
            ],
            'jumlah' => [
                'type'       => 'DECIMAL',
                'constraint' => '12,2',
            ],
            'tanggal_bayar' => [
                'type' => 'DATE',
            ],
            'metode' => [
                'type'       => 'VARCHAR',
                'constraint' => '50',
            ],
            'bukti_transfer' => [ // Baru: Path/nama file bukti pembayaran
                'type'       => 'VARCHAR',
                'constraint' => '255',
                'null'       => true,
            ],
            'status' => [
                'type'       => 'ENUM',
                'constraint' => ['Menunggu Verifikasi', 'Lunas', 'Ditolak'], // Status pembayaran
                'default'    => 'Menunggu Verifikasi',
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
        
        $this->forge->addKey('pembayaran_id', true);
        $this->forge->addForeignKey('user_id', 'user', 'user_id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('kamar_id', 'kamar', 'kamar_id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('pembayaran');
    }

    public function down()
    {
        $this->forge->dropTable('pembayaran');
    }
}