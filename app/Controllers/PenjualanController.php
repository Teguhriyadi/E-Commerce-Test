<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Barang;
use App\Models\PenjualanHeader;
use App\Models\PenjualanHeaderDetail;
use App\Models\Promo;
use App\Models\PromoAturan;
use App\Models\PromoDetail;
use App\Models\PromoPeriode;
use Config\Database;

class PenjualanController extends BaseController
{
    protected $barangModel, $promoModel, $promoPeriodeModel, $promoAturanModel, $promoDetailModel, $penjualanHeaderModel, $penjualanDetailModel;

    public function __construct()
    {
        $this->barangModel = new Barang();
        $this->promoModel = new Promo();
        $this->promoPeriodeModel = new PromoPeriode();
        $this->promoAturanModel = new PromoAturan();
        $this->promoDetailModel = new PromoDetail();
        $this->penjualanHeaderModel = new PenjualanHeader();
        $this->penjualanDetailModel = new PenjualanHeaderDetail();
    }

    public function index()
    {
        $data = [
            "penjualan" => $this->penjualanHeaderModel->orderBy('tgl_transaksi', 'DESC')
                ->orderBy('no_transaksi', 'DESC')
                ->findAll()
        ];

        return view('modules/penjualan/index', $data);
    }

    public function create()
    {
        $data = [
            'barangs' => $this->barangModel->findAll(),
            'cart' => session()->get('cart') ?? []
        ];

        return view("modules/penjualan/create", $data);
    }

    public function store()
    {
        $kode_barang = $this->request->getPost('kode_barang');
        $qty_tambah = (int) $this->request->getPost('qty');

        if ($qty_tambah <= 0) {
            return redirect()->back()->with('error', 'Qty harus lebih dari 0.');
        }

        $barang = $this->barangModel->where('kode_barang', $kode_barang)->first();

        if (!$barang) {
            return redirect()->back()->with('error', 'Barang tidak ditemukan!');
        }

        $cart = session()->get('cart') ?? [];
        $found = false;

        foreach ($cart as &$item) {
            if ($item['kode_barang'] === $kode_barang) {
                $item['qty'] += $qty_tambah;
                $promo = $this->getPromoProduk($kode_barang, $item['qty']);
                $diskon_item = 0;
                if ($promo) {
                    $kelipatan_promo = floor($item['qty'] / $promo['min_qty']);
                    $diskon_item = $kelipatan_promo * $promo['nilai_promo'];
                }
                $item['diskon'] = $diskon_item;
                $item['subtotal'] = ($item['harga'] * $item['qty']) - $diskon_item;
                $found = true;
                break;
            }
        }

        unset($item);

        if (!$found) {
            $harga_satuan = $barang['harga'];
            $promo = $this->getPromoProduk($kode_barang, $qty_tambah);
            $diskon_item = 0;

            if ($promo) {
                $kelipatan_promo = floor($qty_tambah / $promo['min_qty']);
                $diskon_item = $kelipatan_promo * $promo['nilai_promo'];
            }

            $subtotal = ($harga_satuan * $qty_tambah) - $diskon_item;
            $newItem = [
                'id' => $barang['kode_barang'] . '-' . time(),
                'kode_barang' => $barang['kode_barang'],
                'nama_barang' => $barang['nama_barang'],
                'harga' => $harga_satuan,
                'qty' => $qty_tambah,
                'diskon' => $diskon_item,
                'subtotal' => $subtotal,
            ];

            $cart[] = $newItem;
        }

        session()->set('cart', $cart);

        return redirect()->to(base_url('modules/penjualan/create'))->with('success', 'Keranjang berhasil diperbarui!');
    }

    private function getPromoProduk($kodeBarang, $qty)
    {
        $tanggal = date('Y-m-d');
        $periode = $this->promoPeriodeModel->where('tgl_mulai <=', $tanggal)->where('tgl_selesai >=', $tanggal)->findAll();

        if (empty($periode)) {
            return null;
        }

        foreach ($periode as $itemPeriode) {
            $aturan = $this->promoAturanModel->where('kode_promo', $itemPeriode['kode_promo'])->where('tipe_promo', 'PRODUCT_DISCOUNT')->first();

            if (!$aturan) {
                continue;
            }

            $detail = $this->promoDetailModel->where('kode_promo', $itemPeriode['kode_promo'])->where('kode_barang', $kodeBarang)->first();

            if (!$detail) {
                continue;
            }

            if ($qty < $detail['min_qty']) {
                continue;
            }

            return [
                'kode_promo' => $itemPeriode['kode_promo'],
                'min_qty' => (int) $detail['min_qty'],
                'nilai_promo' => (int) $aturan['nilai_promo'],
            ];
        }

        return null;
    }

    public function delete($id)
    {
        $cart = session()->get('cart') ?? [];

        foreach ($cart as $key => $value) {
            if ($value['id'] === $id) {
                unset($cart[$key]);
                break;
            }
        }

        session()->set('cart', array_values($cart));

        return redirect()
            ->to(
                base_url('modules/penjualan/create')
            )->with('success', 'Item dihapus dari keranjang.');
    }

    public function clear()
    {
        session()->remove('cart');
        return redirect()
            ->to(base_url("modules/penjualan/create"))
            ->with("success", "Keranjang Belanja Berhasil Dikosongkan");
    }

    public function checkout()
    {
        $cart = session()->get('cart') ?? [];

        if (empty($cart)) {
            return redirect()->to(base_url('modules/penjualan'))->with('error', 'Keranjang masih kosong.');
        }

        $customer = trim((string) $this->request->getPost('customer'));

        if ($customer === '') {
            return redirect()->back()->withInput()->with('error', 'Nama customer wajib diisi.');
        }

        $totalBayar = 0;

        foreach ($cart as $item) {
            $totalBayar += (float) $item['subtotal'];
        }

        $ppn = round($totalBayar * 0.11);
        $grandTotal = $totalBayar + $ppn;
        $kodePromo = null;

        foreach ($cart as $item) {
            if (!empty($item['kode_promo'])) {
                $kodePromo = $item['kode_promo'];
                break;
            }
        }

        $noTransaksi = $this->generateNoTransaksi();
        $db = Database::connect();

        try {
            $db->transBegin();
            $this->penjualanHeaderModel->insert([
                'no_transaksi' => $noTransaksi,
                'tgl_transaksi' => date('Y-m-d'),
                'customer' => $customer,
                'kode_promo' => $kodePromo,
                'total_bayar' => $totalBayar,
                'ppn' => $ppn,
                'grand_total' => $grandTotal,
            ]);
            foreach ($cart as $item) {
                $this->penjualanDetailModel->insert([
                    'no_transaksi' => $noTransaksi,
                    'kode_barang' => $item['kode_barang'],
                    'qty' => $item['qty'],
                    'harga' => $item['harga'],
                    'discount' => $item['diskon'] ?? 0,
                    'subtotal' => $item['subtotal'],
                ]);
            }
            if ($db->transStatus() === false) {
                throw new \Exception('Gagal menyimpan transaksi.');
            }
            $db->transCommit();
            session()->remove('cart');
            return redirect()->to(base_url('modules/penjualan/' . $noTransaksi . '/invoice'))->with('success', 'Transaksi berhasil disimpan.');
        } catch (\Throwable $e) {
            $db->transRollback();
            return redirect()->back()->withInput()->with('error', $e->getMessage());
        }
    }

    private function generateNoTransaksi()
    {
        $prefix = date('Ym');
        $lastTransaction = $this->penjualanHeaderModel->like('no_transaksi', $prefix, 'after')->orderBy('no_transaksi', 'DESC')->first();
        if (!$lastTransaction) {
            $number = 1;
        } else {
            $lastNumber = (int) substr($lastTransaction['no_transaksi'], -3);
            $number = $lastNumber + 1;
        }
        return $prefix . '-' . str_pad($number, 3, '0', STR_PAD_LEFT);
    }

    public function invoice($noTransaksi)
    {
        $transaksi = $this->penjualanHeaderModel->where('no_transaksi', $noTransaksi)->first();
        if (!$transaksi) {
            return redirect()->to(base_url('modules/penjualan'))->with('error', 'Transaksi tidak ditemukan.');
        }
        $detail = $this->penjualanDetailModel->where('no_transaksi', $noTransaksi)->findAll();
        foreach ($detail as &$item) {
            $item['barang'] = $this->barangModel->where('kode_barang', $item['kode_barang'])->first();
        }
        unset($item);
        return view('modules/penjualan/invoice', [
            'transaksi' => $transaksi,
            'detail'    => $detail,
        ]);
    }

    public function pdfInvoice($noTransaksi)
    {
        $transaksi = $this->penjualanHeaderModel
            ->where('no_transaksi', $noTransaksi)
            ->first();

        if (!$transaksi) {
            return redirect()->to(base_url('modules/penjualan'))
                ->with('error', 'Transaksi tidak ditemukan.');
        }

        $detail = $this->penjualanDetailModel
            ->where('no_transaksi', $noTransaksi)
            ->findAll();

        foreach ($detail as &$item) {
            $item['barang'] = $this->barangModel
                ->where('kode_barang', $item['kode_barang'])
                ->first();
        }

        unset($item);

        $html = view('modules/penjualan/pdf', [
            'transaksi' => $transaksi,
            'detail'    => $detail,
        ]);

        $dompdf = new \Dompdf\Dompdf();

        $dompdf->loadHtml($html);

        $dompdf->setPaper('A4', 'portrait');

        $dompdf->render();

        $dompdf->stream(
            'Invoice-' . $transaksi['no_transaksi'] . '.pdf',
            [
                'Attachment' => true
            ]
        );
    }
}
