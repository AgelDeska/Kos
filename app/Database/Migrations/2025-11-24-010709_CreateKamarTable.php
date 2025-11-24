<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateKamarTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'kamar_id' => [
                'type'           => 'INT',
                'constraint'     => 5,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'nomor_kamar' => [
                'type'       => 'VARCHAR',
                'constraint' => '50',
                'unique'     => true,
            ],
            'tipe_kamar' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            'kapasitas' => [
                'type'       => 'INT',
                'constraint' => 2,
            ],
            'harga' => [
                'type'       => 'DECIMAL',
                'constraint' => '12,2',
            ],
            'deskripsi' => [ // Deskripsi detail fasilitas
                'type' => 'TEXT',
                'null' => true,
            ],
            'foto_kamar' => [ // Path/nama file foto kamar
                'type'       => 'VARCHAR',
                'constraint' => '255',
                'null'       => true,
            ],
            'status' => [
                'type'       => 'ENUM',
                'constraint' => ['Tersedia', 'Di Booking', 'Terisi', 'Perbaikan'], // Ditambah 'Di Booking'
                'default'    => 'Tersedia',
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
        
        $this->forge->addKey('kamar_id', true);
        $this->forge->createTable('kamar');
    }

    public function down()
    {
        $this->forge->dropTable('kamar');
    }
}