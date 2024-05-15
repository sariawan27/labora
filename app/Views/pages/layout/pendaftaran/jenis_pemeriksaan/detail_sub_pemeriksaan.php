<?php $this->extend('layouts/pendaftaran'); ?>

<?php $this->section('content') ?>
<div class="row">
    <div class="col-12">
        <div class="row">
            <div class="col-3">
                <div class="card text-center p-3" style="cursor: pointer;">
                    <img src="<?= esc($subItemData)['picture'] ?>" alt="">
                    <h3><?= esc($subItemData)['nama'] ?></h3>
                </div>
            </div>
            <div class="col d-flex justify-content-center">
            </div>
            <div class="col-4 d-flex justify-content-center">
                <div class="card text-center p-3 border-3" style="cursor: pointer; border-radius: 20px; width: 200px; color: white; background-color: black;" onclick="return window.location.href = '<?= base_url() ?>pendaftaran/temp-sub/<?= esc($subItemData)['id'] ?>'">
                    <h3>Rincian</h3>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <h3>Deskripsi</h3>
            </div>
            <div class="col-12">
                <p style="font-size: 20px;"><?= esc($subItemData)['deskripsi'] ? esc($subItemData)['deskripsi'] : 'Ini test  Desc' ?></p>
            </div>
        </div>
    </div>
</div>
<?php $this->endSection() ?>