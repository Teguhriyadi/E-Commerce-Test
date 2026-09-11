<?php

namespace App\Validation\Promo;

class CreateValidation
{
    public static function rules(): array
    {
        return [
            'kode_promo' => [
                'label' => 'Kode Promo',
                'rules' => 'required|max_length[100]|regex_match[/^[a-zA-Z0-9_-]+$/]|is_unique[promo.kode_promo]',
                'errors' => [
                    'required'    => '{field} wajib diisi.',
                    'max_length'  => '{field} maksimal 100 karakter.',
                    'regex_match' => '{field} hanya boleh menggunakan huruf, angka, tanda - dan _.',
                    'is_unique'   => '{field} sudah digunakan.',
                ],
            ],

            'nama_promo' => [
                'label' => 'Nama Promo',
                'rules' => 'required|max_length[255]',
                'errors' => [
                    'required'   => '{field} wajib diisi.',
                    'max_length' => '{field} maksimal 255 karakter.',
                ],
            ],

            'keterangan' => [
                'label' => 'Keterangan',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} wajib diisi.',
                ],
            ],
        ];
    }
}
