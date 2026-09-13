<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreatePromoPeriodeTable extends Migration
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
            'tgl_mulai' => [
                'type' => 'DATE',
            ],
            'tgl_selesai' => [
                'type' => 'DATE',
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

        $this->forge->createTable('promo_periode');
    }

    public function down()
    {
        $this->forge->dropTable('promo_periode');
    }
}
