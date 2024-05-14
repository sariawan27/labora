<?php $this->extend('layouts/admin'); ?>

<?php $this->section('content') ?>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header border-bottom">
                <h4 class="card-title">Tambah Item</h4>
                
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-12">

                    <form id="atlmForm" action="<?= base_url() ?>admin/item-pemeriksaan/store-item" method="post">
                        <div class="modal-body">
                            <div class="form-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <input type="hidden" name="idatlm" id="idatlm">
                                        <div class="form-group mb-2">
                                            <label class="control-label">Nama Pemeriksaan</label>
                                            <input name="namaPemeriksaan" id="depan" class="form-control" type="text" placeholder="Nama Pemeriksaan">
                                        </div>
                                        <div class="form-group mb-2">
                                            <label class="control-label">Picture</label>
                                            <input name="picture" id="picture" class="form-control" type="text" placeholder="Picture">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
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