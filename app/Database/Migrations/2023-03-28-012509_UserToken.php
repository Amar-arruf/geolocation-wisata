<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class UserToken extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'ID_TOKEN' => [
                'type' => 'VARCHAR',
                'constraint' => '30',
                'null' => true
            ],
            'ACCESS_TOKEN' => [
                'type' => 'LONGTEXT',
                'null' => true
            ],
            'EXPIRES_IN' => [
                'type' => 'VARCHAR',
                'constraint' => '30',
                'null' =>  true
            ],
            'LOGIN_TYPE' => [
                'type' => 'ENUM',
                'constraint' => ['Google', 'Instagram', 'Tiktok']
            ],
            "ID_AKUN" => [
                'type' => 'VARCHAR',
                'constraint' => '30',
                'null' =>  true
            ]
        ]);
        $this->forge->addKey('ID_TOKEN', true);
        $this->forge->createTable('token');
        $this->forge->addForeignKey('ID_AKUN','UserLogin', 'ID_USER');
    }

    public function down()
    {
        $this->forge->dropTable('token');
    }
}
