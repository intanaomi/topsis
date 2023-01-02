<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Alternatif extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_alter' => [
                'type'           => 'INT',
                'constraint'     => 5,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'nama_alter' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            'hasil_alter' => [
                'type'       => 'INT',
            ],
        ]);
        $this->forge->addKey('id_alter', true);
        $this->forge->createTable('alternatif');
    }

    public function down()
    {
        $this->forge->dropTable('alternatif');
    }
}
