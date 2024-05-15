<?php $this->extend('layouts/pendaftaran'); ?>

<?php $this->section('content') ?>
<?php
$uri = service('uri');
$segment = $uri->getSegment(2);
?>
<div class="row">
    <div class="col-12">
        <form name="search-form" class="search-form" action="<?= base_url() ?>pendaftaran/store-pemeriksaan" method="post">
            <div class="row">
                <div class="col-6 d-flex justify-content-center flex-column">
                    <div class="row align-self-center" style="width: 70%;">
                        <div class="col-12 pl-1 text-left align-items-left">
                            <h4>Rincian Pesanan</h4>
                        </div>
                        <div class="col-12  card p-3 border-3" style="cursor: pointer; border-radius: 20px; width: 70%; background-color: rgb(232, 151, 222);">
                            <div class="row flex-column">
                                <?php foreach (esc($itemSessionData) as $key => $value) { ?>
                                    <div class="col mt-1" style="font-size: 20px">
                                        <div class="row ml-1">
                                            <div class="col-8"><?= $value['nama'] ?></div>
                                            <div class="col-4">Rp <?= $value['harga'] ?></div>
                                            <div class="col-12"><a href="<?= base_url('pendaftaran/del-jenis-pemeriksaan') ?>/<?= $key ?>" style="color: red;">Hapus</a></div>
                                        </div>
                                    </div>
                                <?php } ?>
                            </div>
                        </div>
                        <div class="col-12 text-center"><a href="<?= base_url('pendaftaran/jenis-pemeriksaan') ?>" style="font-size: 20px;">Tambah Pemeriksaan</a></div>
                    </div>
                </div>
                <div class="col-6 d-flex flex-column align-items-center">
                    <div class="row align-self-center" style="width: 60%;">
                        <div class="pl-1">
                            &nbsp;
                        </div>
                        <div class="card p-3 border-3" style="align-items:center; cursor: pointer; border-radius: 20px; width: 100%; background-color: rgb(232, 151, 222);">
                            <div class="form-group" style="width: 80%;">
                                <label class="control-label" style="font-size: 20px">Jadwal</label>
                                <input name="jadwal" id="jadwal" class="form-control" type="date" placeholder="Jadwal" style="border-radius:12px;">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-6 d-flex justify-content-center flex-column">
                    <div class="row align-self-center" style="width: 70%;">
                        <div class="col-12 pl-1 text-left align-items-left">
                            <h4>Rincian Biaya</h4>
                        </div>
                        <div class="col-12  card p-3 border-3" style="cursor: pointer; border-radius: 20px; width: 70%; background-color: rgb(232, 151, 222);">
                            <div class="row flex-column">
                                <div class="col mt-1" style="font-size: 20px">
                                    <div class="row ml-1">
                                        <div class="col-8">Total Harga</div>
                                        <div class="col-4">Rp <?= esc($totalPembayaran) ?></div>
                                    </div>
                                </div>
                                <div class="col mt-1" style="font-size: 20px">
                                    <div class="row ml-1">
                                        <div class="col-8">PPN</div>
                                        <div class="col-4">Rp 0</div>
                                        <div class="col-12">
                                            <hr />
                                        </div>
                                    </div>
                                </div>
                                <div class="col mt-1" style="font-size: 20px">
                                    <div class="row ml-1">
                                        <div class="col-8">Total Pembayaran</div>
                                        <div class="col-4">Rp <?= esc($totalPembayaran) ?></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-6 d-flex flex-column align-items-center">
                    <div class="row align-self-center" style="width: 60%;">
                        <div class="pl-1">
                            &nbsp;
                        </div>
                        <div class="card p-3 border-3" style="align-items:center; cursor: pointer; border-radius: 20px; width: 100%; background-color: rgb(232, 151, 222);">
                            <div class="form-group" style="width: 80%;">
                                <label class="control-label" style="font-size: 20px">Pilih metode pembayaran:</label>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="metode_pembayaran" id="metode_pembayaran1" value="BPJS" checked style="transform:scale(1.5);">
                                    <label class="form-check-label" for="metode_pembayaran1" style="font-size: 20px">
                                        BPJS
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="metode_pembayaran" id="metode_pembayaran2" value="UMUM" style="transform:scale(1.5);">
                                    <label class="form-check-label" for="metode_pembayaran2" style="font-size: 20px">
                                        UMUM
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-6 d-flex justify-content-center flex-column">
                    <div class="row align-self-center" style="width: 70%;">
                        <div class="col-12 pl-1 text-left align-items-left">
                            <h4>Syarat & Ketentuan Labora Digital</h4>
                        </div>
                        <div class="col-12 pl-1 text-left align-items-left">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="gridCheck1" style="transform:scale(1.5);">
                                <label class="form-check-label" for="gridCheck1" style="font-size: 16px">
                                    Saya setuju
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-6 d-flex justify-content-end flex-column align-items-end">
                    <div class="row align-self-end" style="width: 60%;">
                        <div class="card text-center p-3 border-3" style="cursor: pointer; border-radius: 20px; width: 200px; color: white; background-color: black;" onclick="return document.forms['search-form'].submit();">
                            <h3>Simpan</h3>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
<?php $this->endSection() ?>