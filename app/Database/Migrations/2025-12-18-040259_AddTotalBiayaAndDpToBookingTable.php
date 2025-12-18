<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddTotalBiayaAndDpToBookingTable extends Migration
{
    public function up()
    {
        $this->forge->addColumn('booking', [
            'total_biaya' => [
                'type'       => 'DECIMAL',
                'constraint' => '15,2',
                'null'       => true,
                'after'      => 'durasi_sewa_bulan',
            ],
            'dp_amount' => [
                'type'       => 'DECIMAL',
                'constraint' => '15,2',
                'null'       => true,
                'after'      => 'total_biaya',
            ],
        ]);
    }

    public function down()
    {
        $this->forge->dropColumn('booking', ['total_biaya', 'dp_amount']);
    }
}
