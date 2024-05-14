<?php $this->extend('layouts/pendaftaran'); ?>

<?php $this->section('content') ?>
<div class="row">
    <div class="col-12">
        <div class="row">
            <div class="col d-flex justify-content-center flex-column">
                <div class="row align-self-center" style="width: 70%;">
                    <div class="col-12 pl-1 text-left align-items-left">
                        <h4>Rincian Pesanan</h4>
                    </div>
                    <div class="col-12  card p-3 border-3" style="cursor: pointer; border-radius: 20px; width: 70%; background-color: rgb(232, 151, 222);">
                        <div class="row flex-column">
                            <div class="col" style="font-size: 20px">JLLASkl</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col d-flex flex-column align-items-center">
                <div class="row align-self-center" style="width: 60%;">
                    <div class="pl-1">
                        &nbsp;
                    </div>
                    <div class="card p-3 border-3" style="align-items:center; cursor: pointer; border-radius: 20px; width: 100%; background-color: rgb(232, 151, 222);">
                        <div class="form-group" style="width: 80%;">
                            <label class="control-label">Tanggal Lahir</label>
                            <input name="tanggal_lahir" id="tanggal_lahir" class="form-control" type="date" placeholder="Tanggal Lahir" style="border-radius:12px;">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $this->endSection() ?>