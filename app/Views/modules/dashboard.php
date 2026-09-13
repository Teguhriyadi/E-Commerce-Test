<?= $this->extend("modules/layouts/master") ?>

<?= $this->section("title") ?>
Dashboard
<?= $this->endSection() ?>

<?= $this->section("title-page") ?>

<h1>Dashboard</h1>

<?= $this->endSection() ?>

<?= $this->section("content") ?>

<div class="row">
    <div class="col-lg-3 col-md-6 col-sm-6">
        <div class="card card-statistic-1 shadow-sm">
            <div class="card-icon bg-primary">
                <i class="fas fa-receipt"></i>
            </div>
            <div class="card-wrap">
                <div class="card-header">
                    <h4>Total Transaksi</h4>
                </div>
                <div class="card-body">
                    <?= number_format($totalTransaksi, 0, ',', '.') ?>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-6 col-sm-6">
        <div class="card card-statistic-1 shadow-sm">
            <div class="card-icon bg-success">
                <i class="fas fa-calendar"></i>
            </div>
            <div class="card-wrap">
                <div class="card-header">
                    <h4>Transaksi Hari Ini</h4>
                </div>
                <div class="card-body">
                    <?= number_format($transaksiHariIni, 0, ',', '.') ?>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-6 col-sm-6">
        <div class="card card-statistic-1 shadow-sm">
            <div class="card-icon bg-warning">
                <i class="fas fa-tags"></i>
            </div>
            <div class="card-wrap">
                <div class="card-header">
                    <h4>Total Promo</h4>
                </div>
                <div class="card-body">
                    <?= $totalPromo ?>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-6 col-sm-6">
        <div class="card card-statistic-1 shadow-sm">
            <div class="card-icon bg-info">
                <i class="fas fa-box"></i>
            </div>
            <div class="card-wrap">
                <div class="card-header">
                    <h4>Total Produk</h4>
                </div>
                <div class="card-body">
                    <?= number_format($totalProduk, 0, ',', '.') ?>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-8">
        <div class="card shadow-sm">
            <div class="card-header">
                <h4>
                    <i class="fas fa-chart-line mr-2"></i>
                    Transaksi 7 Hari Terakhir
                </h4>
            </div>
            <div class="card-body">
                <canvas id="transaksiChart" height="120"></canvas>
            </div>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="card shadow-sm">
            <div class="card-header">
                <h4>
                    <i class="fas fa-fire mr-2"></i>
                    Produk Terlaris
                </h4>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-striped mb-0">
                        <thead>
                            <tr>
                                <th>Produk</th>
                                <th class="text-right">Terjual</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($produkTerlaris)) : ?>
                                <?php foreach ($produkTerlaris as $produk) : ?>
                                    <tr>
                                        <td><?= esc($produk['nama_barang']) ?></td>
                                        <td class="text-right">
                                            <span class="badge badge-primary">
                                                <?= number_format($produk['total_qty'], 0, ',', '.') ?>
                                            </span>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else : ?>
                                <tr>
                                    <td colspan="2" class="text-center text-muted">Belum ada data penjualan.</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-12">
        <div class="card shadow-sm">
            <div class="card-header">
                <h4>
                    <i class="fas fa-history mr-2"></i>
                    Transaksi Terbaru
                </h4>
                <div class="card-header-action">
                    <a href="<?= base_url('modules/penjualan') ?>" class="btn btn-primary btn-sm">
                        Lihat Semua
                        <i class="fas fa-arrow-right ml-1"></i>
                    </a>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>No. Transaksi</th>
                                <th>Tanggal</th>
                                <th>Customer</th>
                                <th class="text-right">Total Bayar</th>
                                <th class="text-right">PPN</th>
                                <th class="text-right">Grand Total</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($transaksiTerbaru)) : ?>
                                <?php foreach ($transaksiTerbaru as $transaksi) : ?>
                                    <tr>
                                        <td>
                                            <strong><?= esc($transaksi['no_transaksi']) ?></strong>
                                        </td>
                                        <td><?= date('d-m-Y', strtotime($transaksi['tgl_transaksi'])) ?></td>
                                        <td><?= esc($transaksi['customer']) ?></td>
                                        <td class="text-right">Rp <?= number_format($transaksi['total_bayar'], 0, ',', '.') ?></td>
                                        <td class="text-right">Rp <?= number_format($transaksi['ppn'], 0, ',', '.') ?></td>
                                        <td class="text-right">
                                            <strong>Rp <?= number_format($transaksi['grand_total'], 0, ',', '.') ?></strong>
                                        </td>
                                        <td class="text-center">
                                            <a href="<?= base_url('modules/penjualan/' . $transaksi['no_transaksi'] . '/invoice') ?>" class="btn btn-info btn-sm" title="Lihat Invoice">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else : ?>
                                <tr>
                                    <td colspan="7" class="text-center text-muted">Belum ada transaksi.</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>

<?= $this->section("js-style") ?>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const grafikTransaksi = <?= json_encode($grafikTransaksi) ?>;
    const labels = grafikTransaksi.map(item => item.tanggal);
    const dataTransaksi = grafikTransaksi.map(item => item.jumlah);
    const ctx = document.getElementById('transaksiChart').getContext('2d');
    new Chart(ctx, {
        type: 'line',
        data: {
            labels: labels,
            datasets: [{
                label: 'Transaksi',
                data: dataTransaksi,
                borderWidth: 3,
                tension: 0.4,
                fill: true,
                pointRadius: 4,
                pointHoverRadius: 6
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    display: false
                },
                tooltip: {
                    callbacks: {
                        label: function(context) {
                            return context.raw + ' transaksi';
                        }
                    }
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        precision: 0,
                        callback: function(value) {
                            return value + ' transaksi';
                        }
                    }
                }
            }
        }
    });
</script>
<?= $this->endSection() ?>