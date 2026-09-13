<?= $this->extend('modules/layouts/master') ?>

<?= $this->section('title') ?>
Invoice Penjualan
<?= $this->endSection() ?>

<?= $this->section("css-style") ?>
<style>
    @media print {
        @page {
            size: A4;
            margin: 10mm;
        }

        body {
            background: #fff !important;
            -webkit-print-color-adjust: exact;
        }

        .no-print {
            display: none !important;
        }

        .card {
            border: none !important;
            box-shadow: none !important;
            width: 100% !important;
        }

        .card-body {
            padding: 10px !important;
        }

        .table {
            font-size: 11px;
        }

        .text-muted {
            color: #555 !important;
        }
    }
</style>
<?= $this->endsection() ?>

<?= $this->section('title-page') ?>
<h1>
    Detail Invoice Penjualan
</h1>
<?= $this->endSection() ?>

<?= $this->section('content') ?>

<div class="d-flex justify-content-between align-items-center mb-4 no-print">
    <a href="<?= base_url('modules/penjualan') ?>"
       class="btn btn-danger font-weight-bold px-4 shadow-sm"
       style="border-radius: 8px;">
        <i class="fa fa-sign-out-alt"></i> Kembali
    </a>
    <div>
        <a href="<?= base_url('modules/penjualan/' . $transaksi['no_transaksi'] . '/pdf') ?>"
           class="btn btn-primary font-weight-bold px-4"
           style="border-radius: 8px;">
            <i class="fa fa-file-pdf"></i> PDF
        </a>
    </div>
</div>

<div class="card border-0 w-100" style="border-radius: 14px; overflow: hidden;">
    <div class="card-body p-4 p-md-5 bg-white">
        <div class="row mb-4 align-items-center">
            <div class="col-md-6 mb-3 mb-md-0">
                <div class="d-flex align-items-center">
                    <div class="rounded-circle d-flex align-items-center justify-content-center mr-3 shadow-sm" style="width: 50px; height: 50px; background-color: #007bff;">
                        <i class="fa fa-file-invoice text-white fa-lg"></i>
                    </div>
                    <div>
                        <h2 class="fw-bold text-dark mb-0 font-weight-bold" style="font-size: 1.75rem;">INVOICE</h2>
                        <span class="text-muted small text-uppercase font-weight-bold">Bukti Transaksi Resmi</span>
                    </div>
                </div>
            </div>
            <div class="col-md-6 text-md-right">
                <h4 class="fw-bold text-primary mb-1 font-weight-bold"><?= esc($transaksi['no_transaksi']) ?></h4>
                <p class="text-muted mb-0 font-weight-medium">
                    <i class="fa fa-calendar-alt mr-1 text-secondary"></i> Tanggal: <?= date('d F Y', strtotime($transaksi['tgl_transaksi'])) ?>
                </p>
            </div>
        </div>

        <hr class="my-4" style="border-top: 1px dashed #dee2e6;">

        <div class="row mb-4">
            <div class="col-12">
                <div class="p-3 rounded-lg border bg-light" style="border-radius: 10px !important;">
                    <span class="text-uppercase text-muted small font-weight-bold d-block mb-1">Nama Customer:</span>
                    <h5 class="font-weight-bold text-dark mb-0"><?= esc($transaksi['customer']) ?></h5>
                </div>
            </div>
        </div>

        <div class="table-responsive mb-4">
            <table class="table table-hover align-middle mb-0" style="border-collapse: separate; border-spacing: 0;">
                <thead style="background-color: #f8f9fa;">
                    <tr>
                        <th class="border-top-0 border-bottom text-center py-3" style="width: 5%;">No</th>
                        <th class="border-top-0 border-bottom py-3" style="width: 45%;">Barang</th>
                        <th class="border-top-0 border-bottom text-right py-3" style="width: 15%;">Harga</th>
                        <th class="border-top-0 border-bottom text-center py-3" style="width: 10%;">Qty</th>
                        <th class="border-top-0 border-bottom text-right py-3" style="width: 12%;">Discount</th>
                        <th class="border-top-0 border-bottom text-right py-3" style="width: 13%;">Subtotal</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($detail)): ?>
                        <?php $no = 1; ?>
                        <?php foreach ($detail as $item): ?>
                            <tr>
                                <td class="text-center text-muted font-weight-bold py-3"><?= $no++ ?></td>
                                <td class="py-3">
                                    <div class="font-weight-bold text-dark">
                                        <?= esc($item['barang']['nama_barang'] ?? $item['kode_barang']) ?>
                                    </div>
                                    <small class="text-muted font-weight-medium">Kode: <?= esc($item['kode_barang']) ?></small>
                                </td>
                                <td class="text-right py-3">Rp <?= number_format($item['harga'], 0, ',', '.') ?></td>
                                <td class="text-center py-3">
                                    <span class="badge badge-light border px-2 py-1 font-weight-bold"><?= (int) $item['qty'] ?></span>
                                </td>
                                <td class="text-right py-3 text-danger font-weight-medium">
                                    <?php if ((float) $item['discount'] > 0): ?>
                                        - Rp <?= number_format($item['discount'], 0, ',', '.') ?>
                                    <?php else: ?>
                                        Rp 0
                                    <?php endif; ?>
                                </td>
                                <td class="text-right py-3 font-weight-bold text-dark">Rp <?= number_format($item['subtotal'], 0, ',', '.') ?></td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="6" class="text-center py-4 text-muted">Tidak ada detail transaksi.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>

        <div class="row justify-content-end">
            <div class="col-md-6 col-lg-5">
                <div class="p-3 rounded-lg border bg-light" style="border-radius: 10px !important;">
                    <table class="table table-sm table-borderless mb-0">
                        <tr>
                            <td class="font-weight-medium py-2">Total Belanja</td>
                            <td class="text-right font-weight-bold py-2 text-dark">Rp <?= number_format($transaksi['total_bayar'], 0, ',', '.') ?></td>
                        </tr>
                        <tr>
                            <td class="font-weight-medium py-2">PPN 11%</td>
                            <td class="text-right font-weight-bold py-2 text-dark">Rp <?= number_format($transaksi['ppn'], 0, ',', '.') ?></td>
                        </tr>
                        <tr class="border-top pt-2">
                            <td class="font-weight-bold text-dark py-3" style="font-size: 1.1rem;">Grand Total</td>
                            <td class="text-right font-weight-bold text-success py-3" style="font-size: 1.25rem;">Rp <?= number_format($transaksi['grand_total'], 0, ',', '.') ?></td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>

        <div class="text-center mt-5 pt-3 border-top">
            <p class="mb-1 font-weight-bold text-dark">Terima kasih atas kepercayaan dan transaksi Anda!</p>
        </div>
    </div>
</div>

<?= $this->endSection() ?>