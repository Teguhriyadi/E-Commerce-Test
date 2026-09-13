<?= $this->extend("modules/layouts/master") ?>

<?= $this->section("title") ?>
Transaksi Penjualan
<?= $this->endSection() ?>

<?= $this->section("title-page") ?>
<h1>
    Tambah Data Penjualan
</h1>
<?= $this->endSection() ?>

<?= $this->section("content") ?>

<?= view("modules/layouts/components/alert") ?>

<a href="<?= base_url('modules/penjualan') ?>" class="btn btn-danger mb-3">
    <i class="fa fa-sign-out-alt"></i> Kembali
</a>
<div class="row">
    <div class="col-12">
        <div class="card border-0 shadow" style="border-radius: 12px;">
            <div class="card-header bg-white border-0 pt-4 px-4 pb-0">
                <div class="d-flex align-items-center">
                    <div class="rounded-circle d-flex align-items-center justify-content-center mr-2" style="width: 36px; height: 36px; background-color: rgba(0, 123, 255, 0.1);">
                        <i class="fa fa-cart-plus text-primary"></i>
                    </div>
                    <h5 class="font-weight-bold text-dark mb-0" style="font-size: 1.1rem;">Tambah Barang ke Keranjang</h5>
                </div>
            </div>
            <div class="card-body px-4 py-3">
                <form action="<?= base_url('modules/penjualan/store') ?>" method="POST">
                    <?= csrf_field() ?>
                    <div class="row align-items-end">
                        <div class="col-md-7 mb-3 mb-md-0">
                            <label class="form-label font-weight-medium text-secondary small text-uppercase">Pilih Barang</label>
                            <select name="kode_barang" class="form-control shadow-sm" required style="border-radius: 8px;">
                                <option value="">-- Pilih Barang --</option>
                                <?php foreach ($barangs as $b): ?>
                                    <option value="<?= $b['kode_barang'] ?>">
                                        <?= $b['nama_barang'] ?> (Rp <?= number_format($b['harga'], 0, ',', '.') ?>)
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col-md-2 mb-3 mb-md-0">
                            <label class="form-label font-weight-medium text-secondary small text-uppercase">Quantity (Qty)</label>
                            <input type="number" name="qty" class="form-control shadow-sm text-center" value="1" min="1" required style="border-radius: 8px;">
                        </div>
                        <div class="col-md-3">
                            <button type="submit" class="btn btn-success font-weight-bold w-100 py-2 shadow-sm" style="border-radius: 8px;">
                                <i class="fa fa-cart-plus mr-1"></i> Tambah
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-12">
        <div class="card border-0 shadow" style="border-radius: 12px;">
            <div class="card-header bg-white border-0 pt-4 px-4 pb-3 d-flex justify-content-between align-items-center flex-wrap">
                <div class="d-flex align-items-center mb-2 mb-md-0">
                    <div class="rounded-circle d-flex align-items-center justify-content-center mr-2" style="width: 36px; height: 36px; background-color: rgba(108, 117, 125, 0.1);">
                        <i class="fa fa-shopping-cart"></i>
                    </div>
                    <h5 class="font-weight-bold text-dark mb-0" style="font-size: 1.1rem;">Keranjang Belanja</h5>
                </div>
                <?php if (!empty($cart)): ?>
                    <a onclick="return confirm('Yakin ? Ingin Kosongkan Keranjang Belanja?')" href="<?= base_url('modules/penjualan/clear') ?>" class="btn btn-outline-danger btn-sm font-weight-bold px-3 shadow-sm" style="border-radius: 6px;">
                        <i class="fa fa-trash mr-1"></i> Kosongkan Keranjang
                    </a>
                <?php endif; ?>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0" style="border-collapse: separate; border-spacing: 0;">
                        <thead style="background-color: #f8f9fa;">
                            <tr>
                                <th class="border-top-0 border-bottom text-center py-3" style="width: 5%;">No</th>
                                <th class="border-top-0 border-bottom py-3" style="width: 35%;">Nama Barang</th>
                                <th class="border-top-0 border-bottom py-3" style="width: 15%;">Harga</th>
                                <th class="border-top-0 border-bottom text-center py-3" style="width: 10%;">Qty</th>
                                <th class="border-top-0 border-bottom py-3" style="width: 15%;">Diskon Promo</th>
                                <th class="border-top-0 border-bottom py-3" style="width: 13%;">Subtotal</th>
                                <th class="border-top-0 border-bottom text-center py-3" style="width: 7%;">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (empty($cart)): ?>
                                <tr>
                                    <td colspan="7" class="text-center py-5 text-muted">
                                        <div class="mb-2">
                                            <i class="fa fa-shopping-basket fa-2x text-muted opacity-5"></i>
                                        </div>
                                        Keranjang masih kosong.
                                    </td>
                                </tr>
                            <?php else: ?>
                                <?php $no = 1;
                                $grand_total_sementara = 0;
                                foreach ($cart as $row): ?>
                                    <?php $grand_total_sementara += $row['subtotal']; ?>
                                    <tr>
                                        <td class="text-center text-muted font-weight-bold py-3"><?= $no++ ?></td>
                                        <td class="py-3 font-weight-medium text-dark"><?= $row['nama_barang'] ?></td>
                                        <td class="py-3">Rp <?= number_format($row['harga'], 0, ',', '.') ?></td>
                                        <td class="text-center py-3">
                                            <span class="badge badge-light border px-2 py-1 font-weight-bold"><?= $row['qty'] ?></span>
                                        </td>
                                        <td class="py-3 text-danger font-weight-medium">- Rp <?= number_format($row['diskon'], 0, ',', '.') ?></td>
                                        <td class="py-3 font-weight-bold text-dark">Rp <?= number_format($row['subtotal'], 0, ',', '.') ?></td>
                                        <td class="text-center py-3">
                                            <form action="<?= base_url('modules/penjualan/' . $row['id'] . '/delete') ?>" method="POST" class="d-inline">
                                                <?= csrf_field() ?>
                                                <input type="hidden" name="_method" value="DELETE">
                                                <button onclick="return confirm('Yakin? Ingin Menghapus Barang Belanja Ini?')" type="submit" class="btn btn-danger btn-sm shadow-sm px-2 py-1" style="border-radius: 6px;">
                                                    <i class="fa fa-trash"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                                <tr style="background-color: #fcfcfc;">
                                    <td colspan="5" class="text-right font-weight-bold py-3 text-secondary">Total Sementara:</td>
                                    <td colspan="2" class="font-weight-bold text-dark py-3" style="font-size: 1.1rem;">Rp <?= number_format($grand_total_sementara, 0, ',', '.') ?></td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <?php if (!empty($cart)): ?>
                <div class="card-footer bg-white border-0 p-4 text-right">
                    <button type="button" class="btn btn-primary font-weight-bold px-4 py-2 shadow-sm" style="border-radius: 8px;" onclick="toggleFormCheckout()">
                        <i class="fa fa-check mr-1"></i> Proses Pembayaran & Cetak
                    </button>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>

<?php if (!empty($cart)): ?>
    <div class="row mt-4" id="formCheckoutSection" style="display: none;">
        <div class="col-md-12">
            <div class="card border-0 shadow-sm" style="border-radius: 12px; border-left: 4px solid #007bff !important;">
                <div class="card-header bg-white border-0 pt-4 px-4 pb-0">
                    <div class="d-flex align-items-center">
                        <div class="rounded-circle d-flex align-items-center justify-content-center mr-2" style="width: 36px; height: 36px; background-color: rgba(0, 123, 255, 0.1);">
                            <i class="fa fa-file-invoice-dollar text-primary"></i>
                        </div>
                        <h5 class="font-weight-bold text-dark mb-0" style="font-size: 1.1rem;">Form Konfirmasi Pembayaran & Cetak Invoice</h5>
                    </div>
                </div>
                <div class="card-body p-4">
                    <form action="<?= base_url('modules/penjualan/checkout') ?>" method="POST">
                        <?= csrf_field() ?>
                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <div class="form-group mb-0">
                                    <label class="form-label font-weight-medium text-secondary small text-uppercase">Nama Customer</label>
                                    <input type="text" name="customer" class="form-control shadow-sm" placeholder="Masukkan nama pembeli..." required style="border-radius: 8px;">
                                </div>
                            </div>
                            <div class="col-md-4 mb-3">
                                <div class="form-group mb-0">
                                    <label class="form-label font-weight-medium text-secondary small text-uppercase">PPN (11%)</label>
                                    <?php
                                    $ppn = ($grand_total_sementara ?? 0) * 0.11;
                                    $grand_total_final = ($grand_total_sementara ?? 0) + $ppn;
                                    ?>
                                    <input type="text" class="form-control shadow-sm bg-light" value="Rp <?= number_format($ppn, 0, ',', '.') ?>" readonly style="border-radius: 8px;">
                                    <input type="hidden" name="ppn" value="<?= $ppn ?>">
                                    <input type="hidden" name="total_bayar" value="<?= $grand_total_sementara ?? 0 ?>">
                                    <input type="hidden" name="grand_total" value="<?= $grand_total_final ?>">
                                </div>
                            </div>
                        </div>

                        <div class="d-flex justify-content-between align-items-center mt-4 pt-3 border-top flex-wrap">
                            <div class="mb-3 mb-md-0">
                                <span class="text-muted d-block small text-uppercase font-weight-bold">Grand Total Final</span>
                                <h3 class="text-success font-weight-bold mb-0">Rp <?= number_format($grand_total_final, 0, ',', '.') ?></h3>
                            </div>
                            <div>
                                <button type="button" class="btn btn-secondary font-weight-bold px-3 py-2 shadow-sm mr-2" style="border-radius: 8px;" onclick="toggleFormCheckout()">Batal</button>
                                <button type="submit" class="btn btn-success font-weight-bold px-4 py-2 shadow-sm" style="border-radius: 8px;">
                                    <i class="fa fa-print mr-1"></i> Simpan & Cetak Invoice
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        function toggleFormCheckout() {
            const formSection = document.getElementById('formCheckoutSection');
            if (formSection.style.display === 'none') {
                formSection.style.display = 'block';
                formSection.scrollIntoView({
                    behavior: 'smooth'
                });
            } else {
                formSection.style.display = 'none';
            }
        }
    </script>
<?php endif; ?>

<?= $this->endSection() ?>