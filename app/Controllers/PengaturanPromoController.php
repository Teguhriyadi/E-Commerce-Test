<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Barang;
use App\Models\Promo;
use App\Models\PromoAturan;
use App\Models\PromoDetail;
use App\Models\PromoPeriode;
use App\Validation\PengaturanPromo\CreateValidation;
use App\Validation\PengaturanPromo\UpdateValidation;
use Config\Database;

class PengaturanPromoController extends BaseController
{
    protected $promoModel, $barangModel, $promoPeriodeModel, $promoAturanModel, $promoDetailModel;

    public function __construct()
    {
        $this->barangModel = new Barang();
        $this->promoModel = new Promo();
        $this->promoPeriodeModel = new PromoPeriode();
        $this->promoAturanModel = new PromoAturan();
        $this->promoDetailModel = new PromoDetail();
    }

    public function index()
    {
        $data = [
            'pengaturanPromo' => $this->promoModel->getWithPengaturan(),
            'errors'           => session()->getFlashdata('errors') ?? [],
        ];

        return view("modules/pengaturan-promo/index", $data);
    }

    public function create()
    {
        $data = [
            'promos' => $this->promoModel->findAll(),
            'barang' => $this->barangModel->findAll(),
            'errors' => session()->getFlashdata('errors') ?? [],
        ];

        return view('modules/pengaturan-promo/create', $data);
    }

    public function store()
    {
        $data = [
            'kode_promo'  => $this->request->getPost('kode_promo'),
            'tgl_mulai'   => $this->request->getPost('tgl_mulai'),
            'tgl_selesai' => $this->request->getPost('tgl_selesai'),
            'tipe_promo'  => $this->request->getPost('tipe_promo'),
            'nilai_promo' => preg_replace(
                '/\D/',
                '',
                (string) $this->request->getPost('nilai_promo')
            ),
            'produk'      => $this->request->getPost('produk') ?? [],
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

            /*
         * Simpan periode promo
         */
            $this->promoPeriodeModel->insert([
                'kode_promo'  => $data['kode_promo'],
                'tgl_mulai'   => $data['tgl_mulai'],
                'tgl_selesai' => $data['tgl_selesai'],
            ]);

            /*
         * Simpan aturan promo
         */
            $this->promoAturanModel->insert([
                'kode_promo'  => $data['kode_promo'],
                'tipe_promo'  => $data['tipe_promo'],
                'nilai_promo' => $data['nilai_promo'],
            ]);

            /*
         * Simpan detail produk
         * hanya untuk promo produk
         */
            if ($data['tipe_promo'] === 'PRODUCT_DISCOUNT') {
                foreach ($data['produk'] as $produk) {
                    $this->promoDetailModel->insert([
                        'kode_promo'  => $data['kode_promo'],
                        'kode_barang' => $produk['kode_barang'],
                        'min_qty'     => $produk['min_qty'],
                    ]);
                }
            }

            if ($db->transStatus() === false) {
                throw new \Exception('Gagal menyimpan data.');
            }

            $db->transCommit();

            return redirect()
                ->to(base_url('modules/pengaturan-promo'))
                ->with('success', 'Pengaturan promo berhasil disimpan.');
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
        $promo = $this->promoModel->find($kodePromo);

        if (!$promo) {
            return redirect()
                ->to(base_url('modules/pengaturan-promo'))
                ->with('error', 'Data promo tidak ditemukan.');
        }

        $data = [
            'promo' => $promo,

            'periode' => $this->promoPeriodeModel
                ->where('kode_promo', $kodePromo)
                ->first(),

            'aturan' => $this->promoAturanModel
                ->where('kode_promo', $kodePromo)
                ->first(),

            'detail' => $this->promoDetailModel
                ->where('kode_promo', $kodePromo)
                ->findAll(),

            'barang' => $this->barangModel->findAll(),

            'errors' => session()->getFlashdata('errors') ?? [],
        ];

        return view('modules/pengaturan-promo/edit', $data);
    }

    public function update($kodePromo)
    {
        $data = [
            'kode_promo'  => $this->request->getPost('kode_promo'),
            'tgl_mulai'   => $this->request->getPost('tgl_mulai'),
            'tgl_selesai' => $this->request->getPost('tgl_selesai'),
            'tipe_promo'  => $this->request->getPost('tipe_promo'),
            'nilai_promo' => preg_replace(
                '/\D/',
                '',
                (string) $this->request->getPost('nilai_promo')
            ),
            'produk'      => $this->request->getPost('produk') ?? [],
        ];

        if ($kodePromo !== $data['kode_promo']) {
            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'Kode promo tidak valid.');
        }

        if (!$this->validateData($data, UpdateValidation::rules())) {
            return redirect()
                ->back()
                ->withInput()
                ->with('errors', $this->validator->getErrors());
        }

        $db = Database::connect();

        try {
            $db->transBegin();

            $this->promoPeriodeModel
                ->where('kode_promo', $kodePromo)
                ->set([
                    'tgl_mulai'   => $data['tgl_mulai'],
                    'tgl_selesai' => $data['tgl_selesai'],
                ])
                ->update();

            $this->promoAturanModel
                ->where('kode_promo', $kodePromo)
                ->set([
                    'tipe_promo'  => $data['tipe_promo'],
                    'nilai_promo' => $data['nilai_promo'],
                ])
                ->update();

            $this->promoDetailModel
                ->where('kode_promo', $kodePromo)
                ->delete();

            if ($data['tipe_promo'] === 'PRODUCT_DISCOUNT') {
                foreach ($data['produk'] as $produk) {

                    if (
                        empty($produk['kode_barang']) ||
                        empty($produk['min_qty'])
                    ) {
                        continue;
                    }

                    $this->promoDetailModel->insert([
                        'kode_promo'  => $kodePromo,
                        'kode_barang' => $produk['kode_barang'],
                        'min_qty'     => $produk['min_qty'],
                    ]);
                }
            }

            if ($db->transStatus() === false) {
                throw new \Exception('Gagal memperbarui pengaturan promo.');
            }

            $db->transCommit();

            return redirect()
                ->to(base_url('modules/pengaturan-promo'))
                ->with('success', 'Pengaturan promo berhasil diperbarui.');
        } catch (\Throwable $e) {
            $db->transRollback();

            return redirect()
                ->back()
                ->withInput()
                ->with('error', $e->getMessage());
        }
    }

    public function detail($kodePromo)
    {
        $promo = $this->promoModel->find($kodePromo);

        if (!$promo) {
            return redirect()
                ->to(base_url('modules/pengaturan-promo'))
                ->with('error', 'Data promo tidak ditemukan.');
        }

        $periode = $this->promoPeriodeModel
            ->where('kode_promo', $kodePromo)
            ->first();

        $aturan = $this->promoAturanModel
            ->where('kode_promo', $kodePromo)
            ->first();

        $detail = $this->promoDetailModel
            ->where('kode_promo', $kodePromo)
            ->findAll();

        $barangModel = new Barang();

        foreach ($detail as &$item) {
            $item['barang'] = $barangModel
                ->where('kode_barang', $item['kode_barang'])
                ->first();
        }

        $data = [
            'promo'   => $promo,
            'periode' => $periode,
            'aturan'  => $aturan,
            'detail'  => $detail,
        ];

        return view('modules/pengaturan-promo/detail', $data);
    }

    public function delete($kodePromo)
    {
        $db = Database::connect();

        try {

            $db->transBegin();

            $this->promoDetailModel
                ->where('kode_promo', $kodePromo)
                ->delete();

            $this->promoAturanModel
                ->where('kode_promo', $kodePromo)
                ->delete();

            $this->promoPeriodeModel
                ->where('kode_promo', $kodePromo)
                ->delete();

            if ($db->transStatus() === false) {
                throw new \Exception('Gagal menghapus pengaturan promo.');
            }

            $db->transCommit();

            return redirect()
                ->to(base_url('modules/pengaturan-promo'))
                ->with('success', 'Pengaturan promo berhasil dihapus.');
        } catch (\Throwable $e) {

            $db->transRollback();

            return redirect()
                ->back()
                ->with('error', $e->getMessage());
        }
    }
}
