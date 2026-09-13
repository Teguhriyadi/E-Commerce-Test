<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreatePromoDetailTable extends Migration
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
            'kode_barang' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
            ],
            'min_qty' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
                'default'    => 1,
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

        $this->forge->addForeignKey(
            'kode_barang',
            'master_barang',
            'kode_barang',
            'RESTRICT',
            'CASCADE'
        );

        $this->forge->addUniqueKey([
            'kode_promo',
            'kode_barang'
        ]);

        $this->forge->createTable('promo_detail');
    }

    public function down()
    {
        $this->forge->dropTable('promo_detail');
    }
}
