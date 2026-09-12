<?= $this->extend("modules/layouts/master") ?>

<?= $this->section("title") ?>
Detail Pengaturan Promo
<?= $this->endSection() ?>

<?= $this->section("title-page") ?>
<h1>Detail Pengaturan Promo</h1>
<?= $this->endSection() ?>

<?= $this->section("content") ?>
<div class="container-fluid pb-4">
    <div class="card border-0 shadow-sm mb-4 overflow-hidden" style="border-radius: 12px; background: linear-gradient(135deg, #1f2d3d 0%, #343a40 100%);">
        <div class="card-body p-4 p-md-5 text-white">
            <div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center">
                <div class="mb-3 mb-md-0 pr-md-4">
                    <div class="mb-2">
                        <span class="badge badge-pill badge-light text-dark px-3 py-1 font-weight-bold shadow-sm" style="font-size: 0.8rem; letter-spacing: 0.5px;">
                            <i class="fa fa-barcode mr-1 text-muted"></i> <?= esc($promo['kode_promo']) ?>
                        </span>
                    </div>
                    <h2 class="font-weight-bold text-white mb-2" style="font-size: 1.8rem;"><?= esc($promo['nama_promo']) ?></h2>
                    <?php if (!empty($promo['keterangan'])) : ?>
                        <p class="text-white-50 mb-0" style="font-size: 0.95rem; max-width: 700px; line-height: 1.5;">
                            <?= esc($promo['keterangan']) ?>
                        </p>
                    <?php endif; ?>
                </div>
                <div class="d-flex align-items-center flex-shrink-0">
                    <a href="<?= base_url('modules/pengaturan-promo/' . $promo['kode_promo'] . '/edit') ?>" class="btn btn-warning font-weight-bold shadow-sm mr-2 px-3 py-2">
                        <i class="fa fa-edit mr-1"></i> Edit Promo
                    </a>
                    <a href="<?= base_url('modules/pengaturan-promo') ?>" class="btn btn-outline-light font-weight-bold px-3 py-2">
                        <i class="fa fa-arrow-left mr-1"></i> Kembali
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-7 mb-4">
            <div class="card border-0 shadow-sm h-100 mb-0" style="border-radius: 12px;">
                <div class="card-header bg-white border-0 pt-4 px-4 pb-0">
                    <div class="d-flex align-items-center">
                        <div class="bg-primary-light text-primary rounded-circle d-flex align-items-center justify-content-center mr-2" style="width: 36px; height: 36px; background-color: rgba(0, 123, 255, 0.1);">
                            <i class="fa fa-calendar-alt text-primary"></i>
                        </div>
                        <h5 class="font-weight-bold text-dark mb-0" style="font-size: 1.1rem;">Periode Promo</h5>
                    </div>
                </div>
                <div class="card-body p-4">
                    <?php if (!empty($periode)) : ?>
                        <div class="row align-items-center bg-light p-3 rounded-lg border mx-0">
                            <div class="col-5 text-center px-2">
                                <span class="d-block text-muted text-uppercase font-weight-bold mb-1" style="font-size: 0.75rem; letter-spacing: 0.5px;">Mulai Berlaku</span>
                                <span class="font-weight-bold text-dark" style="font-size: 1.05rem;"><?= date('d M Y', strtotime($periode['tgl_mulai'])) ?></span>
                            </div>
                            <div class="col-2 text-center text-muted px-0">
                                <div class="bg-white rounded-circle shadow-sm d-inline-flex align-items-center justify-content-center" style="width: 32px; height: 32px;">
                                    <i class="fa fa-arrow-right text-primary"></i>
                                </div>
                            </div>
                            <div class="col-5 text-center px-2">
                                <span class="d-block text-muted text-uppercase font-weight-bold mb-1" style="font-size: 0.75rem; letter-spacing: 0.5px;">Berakhir Sampai</span>
                                <span class="font-weight-bold text-dark" style="font-size: 1.05rem;"><?= date('d M Y', strtotime($periode['tgl_selesai'])) ?></span>
                            </div>
                        </div>
                    <?php else : ?>
                        <div class="alert alert-light border text-muted text-center py-4 mb-0 rounded" style="font-size: 0.95rem;">
                            <i class="fa fa-info-circle mr-1"></i> Periode promo belum diatur secara spesifik.
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <div class="col-lg-5 mb-4">
            <div class="card border-0 shadow-sm h-100 mb-0" style="border-radius: 12px;">
                <div class="card-header bg-white border-0 pt-4 px-4 pb-0">
                    <div class="d-flex align-items-center">
                        <div class="bg-success-light text-success rounded-circle d-flex align-items-center justify-content-center mr-2" style="width: 36px; height: 36px; background-color: rgba(40, 167, 69, 0.1);">
                            <i class="fa fa-tags text-success"></i>
                        </div>
                        <h5 class="font-weight-bold text-dark mb-0" style="font-size: 1.1rem;">Aturan Promo</h5>
                    </div>
                </div>
                <div class="card-body p-4">
                    <?php if (!empty($aturan)) : ?>
                        <div class="d-flex justify-content-between align-items-center mb-3 pb-3 border-bottom">
                            <span class="text-muted font-weight-medium" style="font-size: 0.9rem;">Tipe Promo</span>
                            <span class="badge badge-pill badge-info px-3 py-1 font-weight-bold" style="font-size: 0.85rem;">
                                <?php
                                if ($aturan['tipe_promo'] === 'PRODUCT_DISCOUNT') {
                                    echo 'Diskon Produk';
                                } elseif ($aturan['tipe_promo'] === 'TOTAL_DISCOUNT') {
                                    echo 'Potongan Total';
                                } elseif ($aturan['tipe_promo'] === 'FREE_SHIPPING') {
                                    echo 'Gratis Ongkir';
                                } else {
                                    echo '-';
                                }
                                ?>
                            </span>
                        </div>
                        <div class="d-flex justify-content-between align-items-center">
                            <span class="text-muted font-weight-medium" style="font-size: 0.9rem;">Nilai Promo</span>
                            <span class="font-weight-bold text-success" style="font-size: 1.25rem;">
                                Rp <?= number_format($aturan['nilai_promo'], 0, ',', '.') ?>
                            </span>
                        </div>
                    <?php else : ?>
                        <div class="alert alert-light border text-muted text-center py-4 mb-0 rounded" style="font-size: 0.95rem;">
                            <i class="fa fa-info-circle mr-1"></i> Aturan promo belum diatur.
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>

    <?php if (!empty($aturan) && $aturan['tipe_promo'] === 'PRODUCT_DISCOUNT') : ?>
        <div class="card border-0 shadow-sm" style="border-radius: 12px;">
            <div class="card-header bg-white border-0 pt-4 px-4 pb-3 d-flex justify-content-between align-items-center flex-wrap">
                <div class="d-flex align-items-center mb-2 mb-md-0">
                    <div class="bg-warning-light text-warning rounded-circle d-flex align-items-center justify-content-center mr-2" style="width: 36px; height: 36px; background-color: rgba(255, 193, 7, 0.1);">
                        <i class="fa fa-cubes text-warning"></i>
                    </div>
                    <h5 class="font-weight-bold text-dark mb-0" style="font-size: 1.1rem;">Daftar Produk Promo</h5>
                </div>
                <span class="badge badge-pill badge-light border px-3 py-2 font-weight-bold" style="font-size: 0.85rem;">
                    Total: <?= count($detail) ?> Produk
                </span>
            </div>
            <div class="card-body px-0 pb-0 pt-2">
                <?php if (!empty($detail)) : ?>
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0" style="border-collapse: separate; border-spacing: 0;">
                            <thead class="thead-light">
                                <tr>
                                    <th class="border-top-0 border-bottom text-center py-3" style="width: 8%;">No</th>
                                    <th class="border-top-0 border-bottom py-3" style="width: 25%;">Kode Barang</th>
                                    <th class="border-top-0 border-bottom py-3" style="width: 47%;">Nama Barang</th>
                                    <th class="border-top-0 border-bottom text-center py-3" style="width: 20%;">Minimal Qty</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($detail as $index => $item) : ?>
                                    <tr>
                                        <td class="text-center text-muted font-weight-bold py-3"><?= $index + 1 ?></td>
                                        <td class="py-3">
                                            <span class="badge badge-light border text-primary font-weight-bold px-2 py-1" style="font-size: 0.9rem;">
                                                <?= esc($item['kode_barang']) ?>
                                            </span>
                                        </td>
                                        <td class="py-3 font-weight-medium text-dark">
                                            <?= !empty($item['barang']) ? esc($item['barang']['nama_barang']) : '<span class="text-muted font-italic">Barang tidak ditemukan</span>' ?>
                                        </td>
                                        <td class="text-center py-3">
                                            <span class="badge badge-pill badge-light border px-3 py-1 font-weight-bold" style="font-size: 0.85rem;">
                                                <?= esc($item['min_qty']) ?> pcs
                                            </span>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                <?php else : ?>
                    <div class="text-center py-5 text-muted px-3">
                        <div class="mb-3">
                            <span class="fa-stack fa-2x text-muted opacity-5">
                                <i class="fa fa-circle fa-stack-2x text-light"></i>
                                <i class="fa fa-inbox fa-stack-1x text-secondary"></i>
                            </span>
                        </div>
                        <h6 class="font-weight-bold text-dark">Belum ada produk yang dikonfigurasi</h6>
                        <p class="text-muted small mb-0">Silakan tambahkan produk melalui menu edit pengaturan promo.</p>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    <?php endif; ?>
</div>
<?= $this->endSection() ?>