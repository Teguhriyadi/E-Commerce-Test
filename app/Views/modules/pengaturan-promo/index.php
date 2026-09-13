<?= $this->extend("modules/layouts/master") ?>

<?= $this->section("title") ?>

Pengaturan Promo

<?= $this->endSection() ?>

<?= $this->section("css-style") ?>
    <?= view("modules/layouts/components/datatable-css") ?>
<?= $this->endSection() ?>

<?= $this->section("title-page") ?>

<h1>Master Pengaturan Promo</h1>

<?= $this->endSection() ?>

<?= $this->section("content") ?>
<div class="row">
    <div class="col-12">
        <?= view('modules/layouts/components/alert') ?>
        <div class="card shadow">
            <div class="card-header">
                <a href="<?= base_url('modules/pengaturan-promo/create') ?>" class="btn btn-primary">
                    <i class="fa fa-plus"></i> Tambah Data
                </a>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped" id="table-1">
                        <thead>
                            <tr>
                                <th class="text-center">No.</th>
                                <th>Kode Promo</th>
                                <th>Nama Promo</th>
                                <th>Periode</th>
                                <th>Tipe Promo</th>
                                <th>Nilai Promo</th>
                                <th>Barang</th>
                                <th>Status</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($pengaturanPromo as $index => $promo) : ?>
                                <?php
                                $isConfigured = !empty($promo['periode']) && !empty($promo['aturan']) && !empty($promo['detail']);
                                ?>
                                <tr>
                                    <td class="text-center">
                                        <?= $index + 1 ?>
                                    </td>
                                    <td>
                                        <?= esc($promo['kode_promo']) ?>
                                    </td>
                                    <td>
                                        <?= esc($promo['nama_promo']) ?>
                                    </td>
                                    <td>
                                        <?php if (!empty($promo['periode'])) : ?>
                                            <?= date('d-m-Y', strtotime($promo['periode']['tgl_mulai'])) ?> s/d <?= date('d-m-Y', strtotime($promo['periode']['tgl_selesai'])) ?>
                                        <?php else : ?>
                                            <span class="text-muted">Belum diatur</span>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <?php if (!empty($promo['aturan'])) : ?>
                                            <?= esc($promo['aturan']['tipe_promo']) ?>
                                        <?php else : ?>
                                            <span class="text-muted">Belum diatur</span>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <?php if (!empty($promo['aturan'])) : ?>
                                            Rp <?= number_format($promo['aturan']['nilai_promo'], 0, ',', '.') ?>
                                        <?php else : ?>
                                            <span class="text-muted">-</span>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <?php if (!empty($promo['detail'])) : ?>
                                            <?= count($promo['detail']) ?> Produk
                                        <?php else : ?>
                                            <span class="text-muted">Belum diatur</span>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <?php if ($isConfigured) : ?>
                                            <span class="badge badge-success">Sudah Diatur</span>
                                        <?php else : ?>
                                            <span class="badge badge-secondary">Belum Diatur</span>
                                        <?php endif; ?>
                                    </td>
                                    <td class="text-center">
                                        <?php if (!$isConfigured) : ?>
                                            -
                                        <?php else : ?>
                                            <a href="<?= base_url('modules/pengaturan-promo/' . $promo['kode_promo'] . '/detail') ?>" class="btn btn-info btn-sm" title="Detail">
                                                <i class="fa fa-eye"></i>
                                            </a>
                                            <a href="<?= base_url('modules/pengaturan-promo/' . $promo['kode_promo'] . '/edit') ?>" class="btn btn-warning btn-sm" title="Edit">
                                                <i class="fa fa-edit"></i>
                                            </a>
                                            <form action="<?= base_url('modules/pengaturan-promo/' . $promo['kode_promo'] . '/delete') ?>" method="POST" class="d-inline">
                                                <?= csrf_field() ?>
                                                <input type="hidden" name="_method" value="DELETE">
                                                <button type="submit" class="btn btn-danger btn-sm" title="Hapus" onclick="return confirm('Yakin? Ingin Menghapus Data Ini?')">
                                                    <i class="fa fa-trash"></i>
                                                </button>
                                            </form>
                                        <?php endif; ?>
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
<?= $this->endsection() ?>
<?= $this->section("js-style") ?>
<?= view("modules/layouts/components/datatable-js") ?>
<?= $this->endSection() ?>