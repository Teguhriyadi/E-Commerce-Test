<?= $this->extend("modules/layouts/master") ?>

<?= $this->section("title") ?>
Promo
<?= $this->endSection() ?>

<?= $this->section("title-page") ?>
<h1>
    Edit Master Promo
</h1>
<?= $this->endSection() ?>

<?= $this->section("content") ?>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <a href="<?= base_url('modules/promo') ?>" class="btn btn-danger">
                    <i class="fa fa-sign-out-alt"></i> Kembali
                </a>
            </div>
            <form action="<?= base_url('modules/promo/' . $promo['kode_promo'] . '/update') ?>" method="POST">
                <?= csrf_field() ?>
                <input type="hidden" name="_method" value="PUT">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="form-label" for="kode_promo">Kode Promo</label>
                                <input type="text" class="form-control <?= isset($errors['kode_promo']) ? 'is-invalid' : '' ?>" name="kode_promo" id="kode_promo" placeholder="Masukkan Kode Promo" value="<?= old('kode_promo', $promo['kode_promo']) ?>">

                                <?php if (isset($errors['kode_promo'])) : ?>
                                    <div class="invalid-feedback">
                                        <?= $errors['kode_promo'] ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="col-md-8">
                            <div class="form-group">
                                <label class="form-label" for="nama_promo">Nama Promo</label>
                                <input type="text" class="form-control <?= isset($errors['nama_promo']) ? 'is-invalid' : '' ?>" name="nama_promo" id="nama_promo" placeholder="Masukkan Nama Promo" value="<?= old('nama_promo', $promo['nama_promo']) ?>">

                                <?php if (isset($errors['nama_promo'])) : ?>
                                    <div class="invalid-feedback">
                                        <?= $errors['nama_promo'] ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="keterangan">Keterangan</label>
                        <textarea class="form-control <?= isset($errors['keterangan']) ? 'is-invalid' : '' ?>" name="keterangan" id="keterangan" rows="5" placeholder="Masukkan Keterangan"><?= old('keterangan', $promo['keterangan']) ?></textarea>

                        <?php if (isset($errors['keterangan'])) : ?>
                            <div class="invalid-feedback">
                                <?= $errors['keterangan'] ?>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="card-footer">
                    <button type="reset" class="btn btn-danger">
                        <i class="fa fa-times"></i> Batal
                    </button>
                    <button type="submit" class="btn btn-success">
                        <i class="fa fa-times"></i> Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
<?= $this->endsection() ?>