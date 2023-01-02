<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Kriteria extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_kriteria' => [
                'type'           => 'INT',
                'constraint'     => 5,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'nama_kriteria' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            'atribut' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            'bobot' => [
                'type'       => 'int',
                'constraint' => '10',
            ],
        ]);
        $this->forge->addKey('id_kriteria', true);
        $this->forge->createTable('kriteria');
    }

    public function down()
    {
        $this->forge->dropTable('kriteria');
    }
}
