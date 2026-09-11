<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreatePenjualanHeaderDetailTable extends Migration
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

            'no_transaksi' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'null'       => true
            ],

            'kode_barang' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'null'       => true
            ],

            'qty' => [
                'type'       => 'INT',
                'default'    => 0,
            ],

            'harga' => [
                'type'       => 'DECIMAL',
                'constraint' => '15,2',
                'default'    => 0,
            ],

            'discount' => [
                'type'       => 'DECIMAL',
                'constraint' => '15,2',
                'default'    => 0,
            ],

            'subtotal' => [
                'type'       => 'DECIMAL',
                'constraint' => '15,2',
                'default'    => 0,
            ],
        ]);

        $this->forge->addKey('id', true);
        $this->forge->addForeignKey(
            'no_transaksi',
            'penjualan_header',
            'no_transaksi',
            'CASCADE',
            'CASCADE'
        );

        $this->forge->addForeignKey(
            'kode_barang',
            'master_barang',
            'kode_barang',
            'CASCADE',
            'CASCADE'
        );

        $this->forge->createTable('penjualan_header_detail');
    }

    public function down()
    {
        $this->forge->dropTable('penjualan_header_detail');
    }
}
