<?php $this->extend('layouts/pendaftaran'); ?>

<?php $this->section('content') ?>
<div class="row">
    <div class="col-12">
        <div class="row">
            <?php foreach (esc($itemPemeriksaanData) as $item) { ?>
                <div class="col-2">
                    <div class="card text-center p-3" style="background-color: #99AAC4; font-size: 24px; cursor: pointer; border-radius: 10px;" onclick="return window.location.href = '<?= base_url() ?>pendaftaran/jenis-pemeriksaan/<?= $item['id'] ?>'">
                        <img src="<?= $item['picture'] ?>" alt="" style="
                            max-width:500px;
                            max-height:150px;
                            width: auto;
                            height: auto;
                            align-self: center; margin-bottom: 1rem;">
                        <?= $item['namaPemeriksaan'] ?>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
</div>
<?php $this->endSection() ?>