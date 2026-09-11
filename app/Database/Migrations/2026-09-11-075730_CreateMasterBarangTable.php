<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateMasterBarangTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'kode_barang' => [
                'type'           => 'VARCHAR',
                'constraint'     => 100
            ],

            'nama_barang' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
            ],

            'harga' => [
                'type'       => 'DECIMAL',
                'constraint' => '15,2',
                'default'    => 0,
            ],
        ]);

        $this->forge->addKey('kode_barang', true);
        $this->forge->createTable('master_barang');
    }

    public function down()
    {
        $this->forge->dropTable('master_barang');
    }
}
