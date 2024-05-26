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
                        <h4 class="card-title">Sample yang telah Diambil</h4>

                    </div>
                    <div class="card-body">
                        <table id="user-table" class="table table-striped table-bordered table-hover barang-table" style="width: 100%">
                            <thead>
                                <tr class="text-center">
                                    <th>No</th>
                                    <th>Keterangan</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach (esc($samplingData) as $key => $value) { ?>
                                    <tr>
                                        <td><?= $key + 1 ?></td>
                                        <td><?= $value['keterangan'] ?></td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-12">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header border-bottom">
                        <h4 class="card-title">Item yang Diperiksa</h4>

                    </div>
                    <div class="card-body">
                        <table id="user-table" class="table table-striped table-bordered table-hover barang-table" style="width: 100%">
                            <thead>
                                <tr class="text-center">
                                    <th>No</th>
                                    <th>Item</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach (esc($pemeriksaanData) as $key => $value) { ?>
                                    <tr>
                                        <td><?= $key + 1 ?></td>
                                        <td><?= $value['nama'] ?></td>
                                        <td><a href="<?= base_url('pemeriksaan/data-pemeriksaan/periksa') ?>/<?= $uri->getSegment(4) ?>/<?= $uri->getSegment(5) ?>/<?= $value['idSubPemeriksaan'] ?>">Periksa</a></td>
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