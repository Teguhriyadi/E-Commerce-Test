<?php

namespace App\Validation\PengaturanPromo;

class UpdateValidation
{
    public static function rules(): array
    {
        return [
            'kode_promo' => [
                'label' => 'Kode Promo',
                'rules' => 'required|is_not_unique[promo.kode_promo]',
            ],

            'tgl_mulai' => [
                'label' => 'Tanggal Mulai',
                'rules' => 'required|valid_date[Y-m-d]',
            ],

            'tgl_selesai' => [
                'label' => 'Tanggal Selesai',
                'rules' => 'required|valid_date[Y-m-d]',
            ],

            'tipe_promo' => [
                'label' => 'Tipe Promo',
                'rules' => 'required|in_list[PRODUCT_DISCOUNT,TOTAL_DISCOUNT,FREE_SHIPPING]',
            ],

            'nilai_promo' => [
                'label' => 'Nilai Promo',
                'rules' => 'required|numeric|greater_than_equal_to[0]',
            ],
        ];
    }
}