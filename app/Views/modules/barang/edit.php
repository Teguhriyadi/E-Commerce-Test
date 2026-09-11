<?= $this->extend("modules/layouts/master") ?>

<?= $this->section("title") ?>
Barang
<?= $this->endSection() ?>

<?= $this->section("title-page") ?>
<h1>
    Edit Master Barang
</h1>
<?= $this->endSection() ?>

<?= $this->section("content") ?>
<div class="row">
    <div class="col-8">
        <div class="card shadow">
            <div class="card-header">
                <a href="<?= base_url('modules/barang') ?>" class="btn btn-danger">
                    <i class="fa fa-sign-out-alt"></i> Kembali
                </a>
            </div>
            <form action="<?= base_url('modules/barang/' . $barang['kode_barang'] . '/update') ?>" method="POST">
                <?= csrf_field() ?>
                <input type="hidden" name="_method" value="PUT">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label" for="kode_barang">Kode Barang</label>
                                <input type="text" class="form-control <?= isset($errors['kode_barang']) ? 'is-invalid' : '' ?>" name="kode_barang" id="kode_barang" placeholder="Masukkan Kode Barang" value="<?= old('kode_barang', $barang['kode_barang']) ?>">

                                <?php if (isset($errors['kode_barang'])) : ?>
                                    <div class="invalid-feedback">
                                        <?= $errors['kode_barang'] ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label" for="harga">Harga Barang</label>
                                <input type="text" class="form-control <?= isset($errors['harga']) ? 'is-invalid' : '' ?>" name="harga" id="harga" placeholder="Masukkan Harga Barang" value="<?= old('harga', 'Rp ' . number_format((float) $barang['harga'], 0, ',', '.')) ?>" inputmode="numeric" autocomplete="off">
                                <?php if (isset($errors['harga'])) : ?>
                                    <div class="invalid-feedback"> <?= $errors['harga'] ?></div> 
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="form-label" for="nama_barang">Nama Barang</label>
                                <input type="text" class="form-control <?= isset($errors['nama_barang']) ? 'is-invalid' : '' ?>" name="nama_barang" id="nama_barang" placeholder="Masukkan Nama Barang" value="<?= old('nama_barang', $barang['nama_barang']) ?>">

                                <?php if (isset($errors['nama_barang'])) : ?>
                                    <div class="invalid-feedback">
                                        <?= $errors['nama_barang'] ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <button type="reset" class="btn btn-danger">
                        <i class="fa fa-times"></i> Batal
                    </button>
                    <button type="submit" class="btn btn-success">
                        <i class="fa fa-save"></i> Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
<?= $this->endsection() ?>

<?= $this->section("js-style") ?>
<script type="text/javascript">
    const form = document.querySelector('form'); 
    const hargaInput = document.getElementById('harga'); 
    hargaInput.addEventListener('input', function () { 
        let value = this.value.replace(/\D/g, ''); 
        if (value) { 
            this.value = 'Rp ' + new Intl.NumberFormat('id-ID').format(value); 
        } else { 
            this.value = ''; 
        }
    }); 
    
    form.addEventListener('submit', function () { 
        hargaInput.value = hargaInput.value.replace(/\D/g, '');
    });
</script>
<?= $this->endSection() ?>