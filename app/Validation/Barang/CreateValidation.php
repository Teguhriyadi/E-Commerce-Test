<?php

namespace App\Validation\Barang;

class CreateValidation
{
    public static function rules(): array
    {
        return [
            'kode_barang' => [
                'label' => 'Kode Barang',
                'rules' => 'required|max_length[100]|regex_match[/^[a-zA-Z0-9_-]+$/]|is_unique[master_barang.kode_barang]',
                'errors' => [
                    'required'    => '{field} wajib diisi.',
                    'max_length'  => '{field} maksimal 100 karakter.',
                    'regex_match' => '{field} hanya boleh menggunakan huruf, angka, tanda - dan _.',
                    'is_unique'   => '{field} sudah digunakan.',
                ],
            ],

            'nama_barang' => [
                'label' => 'Nama Barang',
                'rules' => 'required|max_length[255]',
                'errors' => [
                    'required'   => '{field} wajib diisi.',
                    'max_length' => '{field} maksimal 255 karakter.',
                ],
            ],

            'harga' => [
                'label' => 'Harga Barang',
                'rules' => 'required|numeric',
                'errors' => [
                    'required' => '{field} wajib diisi.',
                    'numeric'  => '{field} harus berupa angka.',
                ],
            ],
        ];
    }
}
