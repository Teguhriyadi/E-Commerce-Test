<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Promo;
use App\Validation\Promo\CreateValidation;
use App\Validation\Promo\UpdateValidation;
use Config\Database;

class PromoController extends BaseController
{
    protected $promoModel;

    public function __construct()
    {
        $this->promoModel = new Promo();
    }

    public function index()
    {
        $data = [
            'promos' => $this->promoModel->findAll(),
            'errors' => session()->getFlashdata('errors') ?? [],
        ];

        return view("modules/promo/index", $data);
    }

    public function create()
    {
        return view('modules/promo/create', [
            'errors' => session('errors') ?? [],
        ]);
    }

    public function store()
    {
        if (!$this->validate(CreateValidation::rules())) {
            return redirect()
                ->back()
                ->withInput()
                ->with('errors', $this->validator->getErrors());
        }

        $db = Database::connect();

        try {
            $db->transBegin();

            $data = $this->request->getPost();

            $this->promoModel->insert($data);

            if ($db->transStatus() === false) {
                throw new \Exception('Gagal menyimpan data.');
            }

            $db->transCommit();

            return redirect()
                ->to(base_url('modules/promo'))
                ->with('success', 'Promo berhasil disimpan.');
        } catch (\Throwable $e) {

            $db->transRollback();

            return redirect()
                ->back()
                ->withInput()
                ->with('error', $e->getMessage());
        }
    }

    public function edit($kodePromo)
    {
        $data = [
            'promo'  => $this->promoModel->find($kodePromo),
            'errors' => session()->getFlashdata('errors') ?? [],
        ];

        return view('modules/promo/edit', $data);
    }

    public function update($kodePromo)
    {
        $promo = $this->promoModel->find($kodePromo);

        if (!$promo) {
            return redirect()
                ->to(base_url('modules/promo'))
                ->with('error', 'Data promo tidak ditemukan.');
        }

        if (!$this->validate(UpdateValidation::rules($kodePromo))) {
            return redirect()
                ->back()
                ->withInput()
                ->with('errors', $this->validator->getErrors());
        }

        try {
            $data = [
                'kode_promo' => $this->request->getPost('kode_promo'),
                'nama_promo' => $this->request->getPost('nama_promo'),
                'keterangan' => $this->request->getPost('keterangan'),
            ];

            $this->promoModel->update($kodePromo, $data);

            return redirect()
                ->to(base_url('modules/promo'))
                ->with('success', 'Promo berhasil diperbarui.');
        } catch (\Throwable $e) {
            return redirect()
                ->back()
                ->withInput()
                ->with('error', $e->getMessage());
        }
    }

    public function delete($kodePromo)
    {
        try {
            $this->promoModel->delete($kodePromo);

            return redirect()
                ->to(base_url('modules/promo'))
                ->with('success', 'Promo berhasil dihapus.');
        } catch (\Throwable $e) {
            return redirect()
                ->back()
                ->with('error', $e->getMessage());
        }
    }
}
