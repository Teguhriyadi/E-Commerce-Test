<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreatePenjualanHeaderTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'no_transaksi' => [
                'type'           => 'VARCHAR',
                'constraint'     => 255
            ],

            'tgl_transaksi' => [
                'type'       => 'DATE',
            ],

            'customer' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
            ],

            'kode_promo' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
                'null'       => true
            ],

            'total_bayar' => [
                'type'       => 'DECIMAL',
                'contraint'  => '15,2',
                'default'    => 0,
            ],

            'ppn' => [
                'type'       => 'DECIMAL',
                'contraint'  => '15,2',
                'default'    => 0,
            ],

            'grand_total' => [
                'type'       => 'DECIMAL',
                'contraint'  => '15,2',
                'default'    => 0,
            ],
        ]);

        $this->forge->addKey('no_transaksi', true);
        $this->forge->addForeignKey(
            'kode_promo',
            'promo',
            'kode_promo',
            'SET NULL',
            'CASCADE'
        );

        $this->forge->createTable('penjualan_header');
    }

    public function down()
    {
        $this->forge->dropTable('penjualan_header');
    }
}
