<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddNewColumnsToKamarTable extends Migration
{
    public function up()
    {
        $this->forge->addColumn('kamar', [
            'fasilitas_fitur' => [
                'type' => 'TEXT',
                'null' => true,
                'after' => 'deskripsi',
            ],
            'informasi_kamar' => [
                'type' => 'TEXT',
                'null' => true,
                'after' => 'fasilitas_fitur',
            ],
            'aturan_kamar' => [
                'type' => 'TEXT',
                'null' => true,
                'after' => 'informasi_kamar',
            ],
            'informasi_penting' => [
                'type' => 'TEXT',
                'null' => true,
                'after' => 'aturan_kamar',
            ],
        ]);
    }

    public function down()
    {
        $this->forge->dropColumn('kamar', ['fasilitas_fitur', 'informasi_kamar', 'aturan_kamar', 'informasi_penting']);
    }
}
