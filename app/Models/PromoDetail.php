<?php

namespace App\Models;

use CodeIgniter\Model;

class PromoDetail extends Model
{
    protected $table            = 'promo_detail';

    protected $primaryKey       = 'id';

    protected $useAutoIncrement = true;

    protected $dateFormat       = 'datetime';

    protected $createdField     = 'created_at';
    protected $updatedField     = 'updated_at';

    protected $allowedFields    = [
        'kode_promo',
        'kode_barang',
        'min_qty',
        'created_at',
        'updated_at'
    ];
}
