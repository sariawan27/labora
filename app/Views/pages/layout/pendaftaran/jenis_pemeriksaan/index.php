<?php $this->extend('layouts/pendaftaran'); ?>

<?php $this->section('content') ?>
<div class="row">
    <div class="col-12">
        <div class="row">
            <?php foreach (esc($itemPemeriksaanData) as $item) { ?>
                <div class="col-2">
                    <div class="card text-center p-3" style="font-size: 22px; cursor: pointer;" onclick="return window.location.href = '<?= base_url() ?>pendaftaran/jenis-pemeriksaan/<?= $item['id'] ?>'">
                        <img src="<?= $item['picture'] ?>" alt="" style="width: 55%; align-self: center;">
                        <?= $item['namaPemeriksaan'] ?>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
</div>
<?php $this->endSection() ?>