<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreatePromoAturanTable extends Migration
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
            'kode_promo' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
            ],
            'tipe_promo' => [
                'type'       => 'VARCHAR',
                'constraint' => 30,
            ],
            'nilai_promo' => [
                'type'       => 'DECIMAL',
                'constraint' => '15,2',
                'default'    => 0,
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

        $this->forge->addForeignKey(
            'kode_promo',
            'promo',
            'kode_promo',
            'CASCADE',
            'CASCADE'
        );

        $this->forge->createTable('promo_aturan');
    }

    public function down()
    {
        $this->forge->dropTable('promo_aturan');
    }
}
