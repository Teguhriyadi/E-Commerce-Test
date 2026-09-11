<?php

namespace App\Models;

use CodeIgniter\Model;

class PenjualanHeaderDetail extends Model
{
    protected $table            = 'penjualan_header_detail';

    protected $primaryKey       = 'id';

    protected $useAutoIncrement = true;

    protected $allowedFields    = [
        'no_transaksi',
        'kode_barang',
        'qty',
        'harga',
        'discount',
        'subtotal'
    ];
}
