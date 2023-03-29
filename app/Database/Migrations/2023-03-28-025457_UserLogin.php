<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class UserLogin extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'ID_USER' => [
                'type' => 'VARCHAR',
                'constraint' => '30',
                'null' => false
            ],
            'USERNAME' => [
                'type' => 'VARCHAR',
                'constraint' => '50',
                'null' => true 
            ],
            'GAMBAR_PROFIL' => [
                'type' => 'CHAR',
                'constraint' => '40' 
            ],
            'EMAIL' => [
                'type' => 'VARCHAR',
                'constraint' => '50',
                'null' => true 
            ]
        ]);

        $this->forge->addKey('ID_USER', true);
        $this->forge->createTable('UserLogin');
    }

    public function down()
    {
        $this->forge->dropTable('UserLogin');
    }
}
