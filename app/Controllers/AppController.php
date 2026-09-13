<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Barang;
use App\Models\PenjualanHeader;
use App\Models\PenjualanHeaderDetail;
use App\Models\Promo;

class AppController extends BaseController
{
    protected $penjualanHeader, $penjualanDetail, $barang, $promo;

    public function __construct()
    {
        $this->penjualanHeader = new PenjualanHeader();
        $this->penjualanDetail = new PenjualanHeaderDetail();
        $this->barang = new Barang();
        $this->promo = new Promo();
    }

    public function dashboard()
    {
        $totalTransaksi = $this->penjualanHeader
            ->countAllResults();

        $transaksiHariIni = $this->penjualanHeader
            ->where('tgl_transaksi', date('Y-m-d'))
            ->countAllResults();

        $totalPromo = $this->promo
            ->where('kode_promo IS NOT NULL')
            ->where('kode_promo !=', '')
            ->countAllResults();

        $totalProduk = $this->barang
            ->countAllResults();

        $grafikTransaksi = [];

        for ($i = 6; $i >= 0; $i--) {
            $tanggal = date('Y-m-d', strtotime("-{$i} days"));

            $jumlah = $this->penjualanHeader
                ->where('tgl_transaksi', $tanggal)
                ->countAllResults();

            $grafikTransaksi[] = [
                'tanggal' => date('d M', strtotime($tanggal)),
                'jumlah' => (int) $jumlah,
            ];
        }

        $transaksiTerbaru = $this->penjualanHeader
            ->orderBy('tgl_transaksi', 'DESC')
            ->orderBy('no_transaksi', 'DESC')
            ->limit(5)
            ->findAll();

        $produkTerlaris = $this->penjualanDetail
            ->select('
            penjualan_header_detail.kode_barang,
            SUM(penjualan_header_detail.qty) AS total_qty,
            master_barang.nama_barang
        ')
            ->join(
                'master_barang',
                'master_barang.kode_barang = penjualan_header_detail.kode_barang'
            )
            ->groupBy([
                'penjualan_header_detail.kode_barang',
                'master_barang.nama_barang'
            ])
            ->orderBy('total_qty', 'DESC')
            ->limit(5)
            ->findAll();

        $data = [
            'totalTransaksi'    => $totalTransaksi,
            'transaksiHariIni'  => $transaksiHariIni,
            'totalPromo'        => $totalPromo,
            'totalProduk'       => $totalProduk,
            'grafikTransaksi'   => $grafikTransaksi,
            'transaksiTerbaru'  => $transaksiTerbaru,
            'produkTerlaris'    => $produkTerlaris,
        ];

        return view(
            "modules/dashboard",
            $data
        );
    }
}
