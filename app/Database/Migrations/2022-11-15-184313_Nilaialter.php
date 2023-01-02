<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Nilaialter extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_nilaialter' => [
                'type'           => 'INT',
                'constraint'     => 5,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'id_kriteria' => [
                'type'           => 'INT',
                'constraint'     => 5,
            ],
            'id_alter' => [
                'type'           => 'INT',
                'constraint'     => 5,
            ],
            'nilai' => [
                'type'          => 'INT',
                'constraint'    => 5,
            ],
        ]);
        $this->forge->addKey('id_nilaialter', true);
        $this->forge->createTable('nilaialter');
    }

    public function down()
    {
        $this->forge->dropTable('nilaialter');
    }
}
