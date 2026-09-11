<?= $this->extend("modules/layouts/master") ?>

<?= $this->section("title") ?>
Promo
<?= $this->endSection() ?>

<?= $this->section("css-style") ?>
    <?= view("modules/layouts/components/datatable-css") ?>
<?= $this->endSection() ?>

<?= $this->section("title-page") ?>
<h1>
    Master Promo
</h1>
<?= $this->endSection() ?>

<?= $this->section("content") ?>
<div class="row">
    <div class="col-12">

        <!-- Alert -->
        <?= view('modules/layouts/components/alert') ?>
        <!-- End Alert -->

        <div class="card shadow">
            <div class="card-header">
                <a href="<?= base_url('modules/promo/create') ?>" class="btn btn-primary">
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
                                <th>Keterangan</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($promos as $index => $promo) : ?>
                                <tr>
                                    <td class="text-center"><?= $index + 1 ?></td>
                                    <td><?= esc($promo['kode_promo']) ?></td>
                                    <td><?= esc($promo['nama_promo']) ?></td>
                                    <td><?= esc($promo['keterangan']) ?></td>
                                    <td class="text-center">
                                        <a href="<?= base_url('modules/promo/' . $promo['kode_promo'] . '/edit') ?>" class="btn btn-warning btn-sm">
                                            <i class="fa fa-edit"></i>
                                        </a>
                                        <form action="<?= base_url('modules/promo/' . $promo['kode_promo'] . '/delete') ?>" method="POST" class="d-inline">
                                            <?= csrf_field() ?>
                                            <input type="hidden" name="_method" value="DELETE">
                                            <button onclick="return confirm('Yakin ? Ingin Menghapus Data Ini?')" type="submit" class="btn btn-danger btn-sm">
                                                <i class="fa fa-trash"></i>
                                            </button>
                                        </form>
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