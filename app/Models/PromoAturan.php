<?php

namespace App\Models;

use CodeIgniter\Model;

class PromoAturan extends Model
{
    protected $table            = 'promo_aturan';

    protected $primaryKey       = 'id';

    protected $useAutoIncrement = true;
    
    protected $dateFormat       = 'datetime';

    protected $createdField     = 'created_at';
    protected $updatedField     = 'updated_at';

    protected $allowedFields    = [
        'kode_promo',
        'tipe_promo',
        'nilai_promo',
        'created_at',
        'updated_at'
    ];
}
