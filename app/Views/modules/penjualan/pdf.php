<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Invoice <?= esc($transaksi['no_transaksi']) ?></title>
    <style>
        @page {
            size: A4;
            margin: 10mm;
        }

        body {
            font-family: DejaVu Sans, Arial, sans-serif;
            font-size: 10px;
            color: #222;
            margin: 0;
            padding: 0;
        }

        .header {
            width: 100%;
            margin-bottom: 10px;
        }

        .header-left {
            width: 60%;
            float: left;
        }

        .header-right {
            width: 40%;
            float: right;
            text-align: right;
        }

        .clearfix {
            clear: both;
        }

        .title {
            font-size: 20px;
            font-weight: bold;
            margin-bottom: 2px;
        }

        .subtitle {
            font-size: 9px;
            color: #777;
        }

        .invoice-number {
            font-size: 13px;
            font-weight: bold;
            margin-bottom: 2px;
        }

        .date {
            font-size: 9px;
            color: #666;
        }

        .line {
            border-top: 1px solid #ddd;
            margin: 8px 0 10px;
        }

        .customer-box {
            border: 1px solid #ddd;
            background: #f8f9fa;
            padding: 8px 10px;
            margin-bottom: 10px;
        }

        .customer-label {
            font-size: 8px;
            color: #777;
            text-transform: uppercase;
            margin-bottom: 2px;
        }

        .customer-name {
            font-size: 11px;
            font-weight: bold;
        }

        .detail-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 10px;
        }

        .detail-table th {
            background: #f2f2f2;
            border-top: 1px solid #ccc;
            border-bottom: 1px solid #ccc;
            padding: 6px 5px;
            font-size: 9px;
        }

        .detail-table td {
            border-bottom: 1px solid #eee;
            padding: 6px 5px;
            vertical-align: top;
        }

        .text-center {
            text-align: center;
        }

        .text-right {
            text-align: right;
        }

        .item-name {
            font-weight: bold;
            margin-bottom: 1px;
        }

        .item-code {
            font-size: 8px;
            color: #777;
        }

        .summary-wrapper {
            width: 42%;
            margin-left: auto;
        }

        .summary {
            width: 100%;
            border-collapse: collapse;
        }

        .summary td {
            padding: 4px 6px;
        }

        .summary .grand-total td {
            border-top: 2px solid #222;
            padding-top: 6px;
            font-size: 11px;
            font-weight: bold;
        }

        .footer {
            margin-top: 20px;
            padding-top: 8px;
            border-top: 1px solid #ddd;
            text-align: center;
            font-size: 8px;
            color: #777;
        }
    </style>
</head>

<body>
    <div class="header">
        <div class="header-left">
            <div class="title">INVOICE</div>
            <div class="subtitle">Bukti Transaksi Penjualan</div>
        </div>
        <div class="header-right">
            <div class="invoice-number"><?= esc($transaksi['no_transaksi']) ?></div>
            <div class="date">Tanggal: <?= date('d F Y', strtotime($transaksi['tgl_transaksi'])) ?></div>
        </div>
        <div class="clearfix"></div>
    </div>

    <div class="line"></div>

    <div class="customer-box">
        <div class="customer-label">Nama Customer</div>
        <div class="customer-name"><?= esc($transaksi['customer']) ?></div>
    </div>

    <table class="detail-table">
        <thead>
            <tr>
                <th width="5%" class="text-center">No</th>
                <th width="42%">Barang</th>
                <th width="15%" class="text-right">Harga</th>
                <th width="8%" class="text-center">Qty</th>
                <th width="15%" class="text-right">Discount</th>
                <th width="15%" class="text-right">Subtotal</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($detail)): ?>
                <?php $no = 1; ?>
                <?php foreach ($detail as $item): ?>
                    <tr>
                        <td class="text-center"><?= $no++ ?></td>
                        <td>
                            <div class="item-name"><?= esc($item['barang']['nama_barang'] ?? $item['kode_barang']) ?></div>
                            <div class="item-code">Kode: <?= esc($item['kode_barang']) ?></div>
                        </td>
                        <td class="text-right">Rp <?= number_format($item['harga'], 0, ',', '.') ?></td>
                        <td class="text-center"><?= (int) $item['qty'] ?></td>
                        <td class="text-right">
                            <?php if ((float) $item['discount'] > 0): ?>
                                - Rp <?= number_format($item['discount'], 0, ',', '.') ?>
                            <?php else: ?>
                                Rp 0
                            <?php endif; ?>
                        </td>
                        <td class="text-right">
                            <strong>Rp <?= number_format($item['subtotal'], 0, ',', '.') ?></strong>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="6" class="text-center">Tidak ada detail transaksi.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>

    <div class="summary-wrapper">
        <table class="summary">
            <tr>
                <td>Total Belanja</td>
                <td class="text-right">Rp <?= number_format($transaksi['total_bayar'], 0, ',', '.') ?></td>
            </tr>
            <tr>
                <td>PPN 11%</td>
                <td class="text-right">Rp <?= number_format($transaksi['ppn'], 0, ',', '.') ?></td>
            </tr>
            <tr class="grand-total">
                <td>Grand Total</td>
                <td class="text-right">Rp <?= number_format($transaksi['grand_total'], 0, ',', '.') ?></td>
            </tr>
        </table>
    </div>

    <div class="footer">
        Terima kasih atas kepercayaan dan transaksi Anda.
    </div>

</body>

</html>