<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Barang;
use App\Validation\Barang\CreateValidation;
use App\Validation\Barang\UpdateValidation;
use Config\Database;

class BarangController extends BaseController
{
    protected $barangModel;

    public function __construct()
    {
        $this->barangModel = new Barang();
    }

    public function index()
    {
        $data = [
            'barangs' => $this->barangModel->findAll(),
            'errors' => session()->getFlashdata('errors') ?? [],
        ];

        return view("modules/barang/index", $data);
    }

    public function create()
    {
        return view('modules/barang/create', [
            'errors' => session('errors') ?? [],
        ]);
    }

    public function store()
    {
        $data = [
            'kode_barang' => $this->request->getPost('kode_barang'),
            'nama_barang' => $this->request->getPost('nama_barang'),
            'harga'       => preg_replace('/\D/', '', (string) $this->request->getPost('harga')),
        ];

        if (!$this->validateData($data, CreateValidation::rules())) {
            return redirect()
                ->back()
                ->withInput()
                ->with('errors', $this->validator->getErrors());
        }

        $db = Database::connect();

        try {

            $db->transBegin();

            $this->barangModel->insert($data);

            if ($db->transStatus() === false) {
                throw new \Exception('Gagal menyimpan data.');
            }

            $db->transCommit();

            return redirect()
                ->to(base_url('modules/barang'))
                ->with('success', 'Promo berhasil disimpan.');
        } catch (\Throwable $e) {

            $db->transRollback();

            return redirect()
                ->back()
                ->withInput()
                ->with('error', $e->getMessage());
        }
    }

    public function edit($kodeBarang)
    {
        $data = [
            'barang'  => $this->barangModel->find($kodeBarang),
            'errors' => session()->getFlashdata('errors') ?? [],
        ];

        return view('modules/barang/edit', $data);
    }

    public function update($kodeBarang)
    {
        $barang = $this->barangModel->find($kodeBarang);

        if (!$barang) {
            return redirect()
                ->to(base_url('modules/barang'))
                ->with('error', 'Data barang tidak ditemukan.');
        }

        $data = [
            'kode_barang' => $this->request->getPost('kode_barang'),
            'nama_barang' => $this->request->getPost('nama_barang'),
            'harga'       => preg_replace(
                '/\D/',
                '',
                (string) $this->request->getPost('harga')
            ),
        ];

        if (!$this->validateData(
            $data,
            UpdateValidation::rules($kodeBarang)
        )) {
            return redirect()
                ->back()
                ->withInput()
                ->with('errors', $this->validator->getErrors());
        }

        $db = Database::connect();

        try {
            $db->transBegin();

            $this->barangModel->update($kodeBarang, $data);

            if ($db->transStatus() === false) {
                throw new \Exception('Gagal memperbarui data barang.');
            }

            $db->transCommit();

            return redirect()
                ->to(base_url('modules/barang'))
                ->with('success', 'Barang berhasil diperbarui.');
        } catch (\Throwable $e) {
            $db->transRollback();

            return redirect()
                ->back()
                ->withInput()
                ->with('error', $e->getMessage());
        }
    }

    public function delete($kodeBarang)
    {
        try {
            $this->barangModel->delete($kodeBarang);

            return redirect()
                ->to(base_url('modules/barang'))
                ->with('success', 'Promo berhasil dihapus.');
        } catch (\Throwable $e) {
            return redirect()
                ->back()
                ->with('error', $e->getMessage());
        }
    }
}
