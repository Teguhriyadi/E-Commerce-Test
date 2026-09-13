<?= $this->extend("modules/layouts/master") ?>

<?= $this->section("title") ?>
Transaksi Penjualan
<?= $this->endSection() ?>

<?= $this->section("css-style") ?>
    <?= view("modules/layouts/components/datatable-css") ?>
<?= $this->endSection() ?>

<?= $this->section("title-page") ?>
<h1>
    Transaksi Penjualan
</h1>
<?= $this->endSection() ?>

<?= $this->section("content") ?>

<div class="row">
    <div class="col-12 px-lg-4">

        <?= view('modules/layouts/components/alert') ?>

        <div class="card shadow border-0" style="border-radius: 14px; overflow: hidden;">

            <div class="card-header bg-white py-3">
                <a href="<?= base_url('modules/penjualan/create') ?>" class="btn btn-primary font-weight-bold px-4 shadow-sm" style="border-radius: 8px;">
                    <i class="fa fa-plus mr-1"></i> Tambah Penjualan
                </a>
            </div>

            <div class="card-body p-4">

                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0" id="table-1" style="border-collapse: separate; border-spacing: 0;">

                        <thead style="background-color: #f8f9fa;">
                            <tr>
                                <th class="text-center py-3" style="width: 5%;">No.</th>
                                <th class="py-3" style="width: 18%;">No. Transaksi</th>
                                <th class="py-3" style="width: 12%;">Tanggal</th>
                                <th class="py-3" style="width: 20%;">Customer</th>
                                <th class="text-center py-3" style="width: 13%;">Total Bayar</th>
                                <th class="text-center py-3" style="width: 10%;">PPN</th>
                                <th class="text-center py-3" style="width: 14%;">Grand Total</th>
                                <th class="text-center py-3" style="width: 8%;">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($penjualan as $key => $item): ?>
                                <tr>
                                    <td class="text-center text-muted font-weight-bold py-3">
                                        <?= $key + 1 ?>
                                    </td>
                                    <td class="py-3 font-weight-bold text-primary">
                                        <?= esc($item['no_transaksi']) ?>
                                    </td>
                                    <td class="py-3 font-weight-medium">
                                        <?= date('d-m-Y', strtotime($item['tgl_transaksi'])) ?>
                                    </td>
                                    <td class="py-3 font-weight-bold text-dark">
                                        <?= esc($item['customer']) ?>
                                    </td>
                                    <td class="text-center py-3">
                                        Rp <?= number_format($item['total_bayar'], 0, ',', '.') ?>
                                    </td>
                                    <td class="text-center py-3">
                                        Rp <?= number_format($item['ppn'], 0, ',', '.') ?>
                                    </td>
                                    <td class="text-center py-3 font-weight-bold text-success">
                                        Rp <?= number_format($item['grand_total'], 0, ',', '.') ?>
                                    </td>
                                    <td class="text-center py-3">
                                        <a
                                            href="<?= base_url('modules/penjualan/' . $item['no_transaksi'] . '/invoice') ?>"
                                            class="btn btn-sm btn-info px-2 py-1 shadow-sm"
                                            style="border-radius: 6px;"
                                            title="Detail"
                                        >
                                            <i class="fa fa-eye"></i>
                                        </a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>

<?= $this->section("js-style") ?>
    <?= view("modules/layouts/components/datatable-js") ?>
<?= $this->endSection() ?>