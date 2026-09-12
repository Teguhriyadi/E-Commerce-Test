<?php

namespace App\Models;

use CodeIgniter\Model;

class Promo extends Model
{
    protected $table            = 'promo';

    protected $primaryKey       = 'kode_promo';

    protected $useAutoIncrement = false;

    protected $allowedFields    = [
        'kode_promo',
        'nama_promo',
        'keterangan',
    ];

    public function getWithPengaturan()
    {
        $promos = $this->findAll();

        $periodeModel = new PromoPeriode();
        $aturanModel  = new PromoAturan();
        $detailModel  = new PromoDetail();

        foreach ($promos as &$promo) {

            $promo['periode'] = $periodeModel
                ->where('kode_promo', $promo['kode_promo'])
                ->first();

            $promo['aturan'] = $aturanModel
                ->where('kode_promo', $promo['kode_promo'])
                ->first();

            $promo['detail'] = $detailModel
                ->where('kode_promo', $promo['kode_promo'])
                ->findAll();
        }

        return $promos;
    }
}
