<?php $this->extend('layouts/pemeriksaan'); ?>

<?php $this->section('content') ?>
<?php
$uri = service('uri');
$segment = $uri->getSegment(4);
?>
<div class="row">
    <div class="col-12">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header border-bottom">
                        <h4 class="card-title">Riwayat</h4>

                    </div>
                    <div class="card-body">
                        <div class="row mb-3">
                            <div class="col-12">
                                <span style="font-size: 18px;"><b>Nama:</b> <?= $pasienData['namaPasien'] ?></span>
                            </div>
                            <div class="col-12">
                                <span style="font-size: 18px;"><b>No. Rekam Medis:</b> <?= $pasienData['nomorRekamMedis'] ?></span>
                            </div>
                        </div>
                        <table id="user-table" class="table table-striped table-bordered table-hover barang-table" style="width: 100%">
                            <thead>
                                <tr class="text-center">
                                    <th>No</th>
                                    <th>Item</th>
                                    <th>Hasil</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach (esc($pemeriksaanData) as $key => $value) { ?>
                                    <tr>
                                        <td><?= $key + 1 ?></td>
                                        <td><?= $value['nama'] ?></td>
                                        <td style="padding: 5px; display:flex; align-self: center; justify-content:center;">
                                            <div style="
                                            width: 60%;
                                            height: 100%;
                                            padding: 5px;
                                            text-align: center;
                                            background-color: #9ADCA5;
                                        "><?= $value['normal'] ?> <?= $value['satuan'] ?></div>
                                        </td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $this->endSection() ?>