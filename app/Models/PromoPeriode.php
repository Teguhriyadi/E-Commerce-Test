<?php

namespace App\Models;

use CodeIgniter\Model;

class PromoPeriode extends Model
{
    protected $table            = 'promo_periode';

    protected $primaryKey       = 'id';

    protected $useAutoIncrement = true;

    protected $dateFormat       = 'datetime';

    protected $createdField     = 'created_at';
    protected $updatedField     = 'updated_at';

    protected $allowedFields    = [
        'kode_promo',
        'tgl_mulai',
        'tgl_selesai',
        'created_at',
        'updated_at'
    ];
}
