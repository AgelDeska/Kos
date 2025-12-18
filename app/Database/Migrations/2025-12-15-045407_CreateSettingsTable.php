<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateSettingsTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'key' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
                'unique'     => true,
            ],
            'value' => [
                'type' => 'TEXT',
                'null' => true,
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
        $this->forge->addKey('id', true);
        $this->forge->createTable('settings');

        // Insert default kos location (example: Jakarta)
        $this->db->table('settings')->insertBatch([
            ['key' => 'kos_latitude', 'value' => '-6.2088', 'created_at' => date('Y-m-d H:i:s')],
            ['key' => 'kos_longitude', 'value' => '106.8456', 'created_at' => date('Y-m-d H:i:s')],
            ['key' => 'kos_address', 'value' => 'Jakarta, Indonesia', 'created_at' => date('Y-m-d H:i:s')],
        ]);
    }

    public function down()
    {
        $this->forge->dropTable('settings');
    }
}
