<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddBookingIdToPembayaranTable extends Migration
{
    public function up()
    {
        $this->forge->addColumn('pembayaran', [
            'booking_id' => [
                'type'       => 'INT',
                'constraint' => 5,
                'unsigned'   => true,
                'null'       => true,
                'after'      => 'kamar_id',
            ],
        ]);

        // Add foreign key constraint
        $this->forge->addForeignKey('booking_id', 'booking', 'booking_id', 'CASCADE', 'CASCADE');
    }

    public function down()
    {
        // Drop foreign key first
        $this->forge->dropForeignKey('pembayaran', 'pembayaran_booking_id_foreign');

        // Drop the column
        $this->forge->dropColumn('pembayaran', 'booking_id');
    }
}
