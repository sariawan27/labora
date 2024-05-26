<?php $this->extend('layouts/admin'); ?>

<?php $this->section('content') ?>
<?php
$uri = service('uri');
$segment = $uri->getSegment(4);
?>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header border-bottom">
                <h4 class="card-title">Edit Item</h4>

            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-12">

                        <form id="atlmForm" action="<?= base_url() ?>admin/sub-item-pemeriksaan/update-sub-item/<?= $uri->getSegment(4) ?>" method="post">
                            <div class="modal-body">
                                <div class="form-body">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <input type="hidden" name="idatlm" id="idatlm">
                                            <div class="form-group mb-2">
                                                <label class="control-label">Nama</label>
                                                <input name="nama" id="depan" class="form-control" type="text" placeholder="Nama" value="<?= esc($subItemPemeriksaanData)['nama'] ?>">
                                            </div>
                                            <div class="form-group mb-2">
                                                <label class="control-label">Harga</label>
                                                <input name="harga" id="depan" class="form-control" type="text" placeholder="Harga" value="<?= esc($subItemPemeriksaanData)['harga'] ?>">
                                            </div>
                                            <div class="form-group mb-2">
                                                <label class="control-label">Picture</label>
                                                <input name="picture" id="picture" class="form-control" type="text" placeholder="Picture" value="<?= esc($subItemPemeriksaanData)['picture'] ?>">
                                            </div>
                                            <div class="form-group mb-2">
                                                <label class="control-label">Nilai Normal</label>
                                                <textarea name="nilai" id="nilai" class="form-control" type="text" placeholder="Nilai Normal"><?= esc($subItemPemeriksaanData)['normal'] ?></textarea>
                                            </div>
                                            <div class="form-group mb-2">
                                                <label class="control-label">Satuan</label>
                                                <input name="satuan" id="satuan" class="form-control" type="text" placeholder="Satuan" value="<?= esc($subItemPemeriksaanData)['satuan'] ?>">
                                            </div>
                                            <div class="form-group mb-2">
                                                <label class="control-label">Deskripsi</label>
                                                <textarea name="deskripsi" id="depan" class="form-control" type="text" placeholder="Deskripsi"><?= esc($subItemPemeriksaanData)['deskripsi'] ?></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <a href="<?= base_url('admin/item-pemeriksaan/show-item') ?>/<?= esc($subItemPemeriksaanData)['idPemeriksaan'] ?>" type="button" class="btn btn-secondary">Cancel</a>
                                <button type="submit" id="atlmSubmit" name="atlm-submit" class="btn btn-primary">Simpan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $this->endSection() ?>