<?= $this->extend("modules/layouts/master") ?>

<?= $this->section("title") ?>
Barang
<?= $this->endSection() ?>

<?= $this->section("css-style") ?>
    <?= view("modules/layouts/components/datatable-css") ?>
<?= $this->endSection() ?>

<?= $this->section("title-page") ?>
<h1>
    Master Barang
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
                <a href="<?= base_url('modules/barang/create') ?>" class="btn btn-primary">
                    <i class="fa fa-plus"></i> Tambah Data
                </a>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped" id="table-1">
                        <thead>
                            <tr>
                                <th class="text-center">No.</th>
                                <th>Kode Barang</th>
                                <th>Nama Barang</th>
                                <th>Harga</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($barangs as $index => $barang) : ?>
                                <tr>
                                    <td class="text-center"><?= $index + 1 ?></td>
                                    <td><?= esc($barang['kode_barang']) ?></td>
                                    <td><?= esc($barang['nama_barang']) ?></td>
                                    <td>Rp. <?= number_format($barang['harga'], 0, '', '.'); ?></td>
                                    <td class="text-center">
                                        <a href="<?= base_url('modules/barang/' . $barang['kode_barang'] . '/edit') ?>" class="btn btn-warning btn-sm">
                                            <i class="fa fa-edit"></i>
                                        </a>
                                        <form action="<?= base_url('modules/barang/' . $barang['kode_barang'] . '/delete') ?>" method="POST" class="d-inline">
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