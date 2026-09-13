<?= $this->extend("modules/layouts/master") ?>

<?= $this->section("title") ?>
Pengaturan Promo
<?= $this->endSection() ?>

<?= $this->section("title-page") ?>
<h1>Tambah Pengaturan Promo</h1>
<?= $this->endSection() ?>

<?= $this->section("content") ?>
<form action="<?= base_url('modules/pengaturan-promo/store') ?>" method="POST">
    <?= csrf_field() ?>
    <div class="row">
        <div class="col-12">
            <div class="card shadow">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <strong>Form Pengaturan Promo</strong>
                    <a href="<?= base_url('modules/pengaturan-promo') ?>" class="btn btn-danger btn-sm">
                        <i class="fa fa-sign-out-alt"></i> Kembali
                    </a>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="form-label" for="kode_promo">Kode Promo</label>
                                <select class="form-control <?= isset($errors['kode_promo']) ? 'is-invalid' : '' ?>" name="kode_promo" id="kode_promo">
                                    <option value="">-- Pilih Promo --</option>
                                    <?php foreach ($promos as $item) : ?>
                                        <option value="<?= esc($item['kode_promo']) ?>" <?= old('kode_promo') == $item['kode_promo'] ? 'selected' : '' ?>>
                                            <?= esc($item['kode_promo']) ?> - <?= esc($item['nama_promo']) ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                                <?php if (isset($errors['kode_promo'])) : ?>
                                    <div class="invalid-feedback"><?= $errors['kode_promo'] ?></div>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="form-label" for="tgl_mulai">Tanggal Mulai</label>
                                <input type="date" class="form-control <?= isset($errors['tgl_mulai']) ? 'is-invalid' : '' ?>" name="tgl_mulai" id="tgl_mulai" value="<?= old('tgl_mulai') ?>">
                                <?php if (isset($errors['tgl_mulai'])) : ?>
                                    <div class="invalid-feedback"><?= $errors['tgl_mulai'] ?></div>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="form-label" for="tgl_selesai">Tanggal Selesai</label>
                                <input type="date" class="form-control <?= isset($errors['tgl_selesai']) ? 'is-invalid' : '' ?>" name="tgl_selesai" id="tgl_selesai" value="<?= old('tgl_selesai') ?>">
                                <?php if (isset($errors['tgl_selesai'])) : ?>
                                    <div class="invalid-feedback"><?= $errors['tgl_selesai'] ?></div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label" for="tipe_promo">Tipe Promo</label>
                                <select class="form-control <?= isset($errors['tipe_promo']) ? 'is-invalid' : '' ?>" name="tipe_promo" id="tipe_promo">
                                    <option value="">-- Pilih Tipe Promo --</option>
                                    <option value="PRODUCT_DISCOUNT" <?= old('tipe_promo') == 'PRODUCT_DISCOUNT' ? 'selected' : '' ?>>Diskon Produk</option>
                                    <option value="TOTAL_DISCOUNT" <?= old('tipe_promo') == 'TOTAL_DISCOUNT' ? 'selected' : '' ?>>Potongan Total</option>
                                    <option value="FREE_SHIPPING" <?= old('tipe_promo') == 'FREE_SHIPPING' ? 'selected' : '' ?>>Gratis Ongkir</option>
                                </select>
                                <?php if (isset($errors['tipe_promo'])) : ?>
                                    <div class="invalid-feedback"><?= $errors['tipe_promo'] ?></div>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label" for="nilai_promo">Nilai Promo</label>
                                <input type="text" class="form-control <?= isset($errors['nilai_promo']) ? 'is-invalid' : '' ?>" name="nilai_promo" id="nilai_promo" placeholder="Masukkan Nilai Promo" value="<?= old('nilai_promo') ?>" inputmode="numeric" autocomplete="off">
                                <?php if (isset($errors['nilai_promo'])) : ?>
                                    <div class="invalid-feedback"><?= $errors['nilai_promo'] ?></div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                    <div id="produkPromoSection" class="mt-3">
                        <div class="card border mb-0">
                            <div class="card-header bg-light d-flex justify-content-between align-items-center">
                                <strong>Produk Promo</strong>
                                <button type="button" class="btn btn-primary btn-sm" id="btnTambahBarang">
                                    <i class="fa fa-plus"></i> Tambah Barang
                                </button>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="tableProdukPromo">
                                        <thead>
                                            <tr>
                                                <th width="50%">Barang</th>
                                                <th width="30%">Minimal Qty</th>
                                                <th width="20%">Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr class="produk-row">
                                                <td>
                                                    <select class="form-control" name="produk[0][kode_barang]">
                                                        <option value="">-- Pilih Barang --</option>
                                                        <?php foreach ($barang as $item) : ?>
                                                            <option value="<?= esc($item['kode_barang']) ?>">
                                                                <?= esc($item['kode_barang']) ?> - <?= esc($item['nama_barang']) ?>
                                                            </option>
                                                        <?php endforeach; ?>
                                                    </select>
                                                </td>
                                                <td>
                                                    <input type="number" class="form-control" name="produk[0][min_qty]" min="1" value="1">
                                                </td>
                                                <td>
                                                    <button type="button" class="btn btn-danger btn-sm btnHapusBarang">
                                                        <i class="fa fa-trash"></i> Hapus
                                                    </button>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
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
            </div>
        </div>
    </div>
</form>
<?= $this->endSection() ?>

<?= $this->section("js-style") ?>
<script type="text/javascript">
    const form = document.querySelector('form');
    const tipePromo = document.getElementById('tipe_promo');
    const nilaiPromo = document.getElementById('nilai_promo');
    const produkPromoSection = document.getElementById('produkPromoSection');
    const btnTambahBarang = document.getElementById('btnTambahBarang');
    const tableProdukPromo = document.querySelector('#tableProdukPromo tbody');

    nilaiPromo.addEventListener('input', function () {
        let value = this.value.replace(/\D/g, '');
        if (value) {
            this.value = 'Rp ' + new Intl.NumberFormat('id-ID').format(value);
        } else {
            this.value = '';
        }
    });

    function toggleProdukPromo() {
        if (tipePromo.value === 'PRODUCT_DISCOUNT') {
            produkPromoSection.style.display = 'block';
        } else {
            produkPromoSection.style.display = 'none';
        }
    }

    tipePromo.addEventListener('change', toggleProdukPromo);
    toggleProdukPromo();

    let index = 1;
    btnTambahBarang.addEventListener('click', function () {
        const row = document.createElement('tr');
        row.classList.add('produk-row');
        row.innerHTML = `
            <td>
                <select class="form-control" name="produk[${index}][kode_barang]">
                    <option value="">-- Pilih Barang --</option>
                    <?php foreach ($barang as $item) : ?>
                        <option value="<?= esc($item['kode_barang']) ?>">
                            <?= esc($item['kode_barang']) ?> - <?= esc($item['nama_barang']) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </td>
            <td>
                <input type="number" class="form-control" name="produk[${index}][min_qty]" min="1" value="1">
            </td>
            <td>
                <button type="button" class="btn btn-danger btn-sm btnHapusBarang">
                    <i class="fa fa-trash"></i> Hapus
                </button>
            </td>
        `;
        tableProdukPromo.appendChild(row);
        index++;
    });

    document.addEventListener('click', function (event) {
        const button = event.target.closest('.btnHapusBarang');
        if (!button) {
            return;
        }
        const rows = tableProdukPromo.querySelectorAll('.produk-row');
        if (rows.length <= 1) {
            alert('Minimal harus ada 1 barang.');
            return;
        }
        button.closest('.produk-row').remove();
    });

    form.addEventListener('submit', function () {
        nilaiPromo.value = nilaiPromo.value.replace(/\D/g, '');
    });
</script>
<?= $this->endSection() ?>