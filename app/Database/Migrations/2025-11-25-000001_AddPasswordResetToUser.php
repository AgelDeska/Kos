<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddPasswordResetToUser extends Migration
{
    public function up()
    {
        $this->forge->addColumn('user', [
            'reset_token' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'null'       => true,
                'default'    => null,
                'comment'    => 'Token untuk reset password',
            ],
            'reset_expires' => [
                'type'    => 'DATETIME',
                'null'    => true,
                'default' => null,
                'comment' => 'Waktu expiry token reset password',
            ],
        ]);
    }

    public function down()
    {
        $this->forge->dropColumn('user', 'reset_token');
        $this->forge->dropColumn('user', 'reset_expires');
    }
}
