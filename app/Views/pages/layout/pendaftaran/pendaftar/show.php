<?php $this->extend('layouts/pendaftaran'); ?>

<?php $this->section('content') ?>
<div class="row">
    <div class="col-12">
        <div class="row">
            <div class="col-12 d-flex justify-content-center flex-column">
                <div class="row align-self-center">
                    <div class="col-12 text-center card p-3 border-3" style="cursor: pointer; border-radius: 20px; width: 30%;">
                        <img src="<?= esc($qr) ?>" style="
    padding: 8px;
" />
                    </div>
                </div>
            </div>
        </div>

        <div style="padding: 2rem; width: 100%; background-color: white;" id="doc-preview-pdf">
            <h2 style="text-align: center; margin-bottom: 1rem; font-weight: bold;">FORM PERMINTAAN PEMERIKSAAN LABORATORIUM</h2>
            <table border="1" style="width: 100%; margin-bottom: 2rem;">
                <tbody>
                    <tr>
                        <th style="padding: 15px; text-align: left;">No. RM</th>
                        <td style="padding: 15px;"><?= esc($pasienData['nomorRekamMedis']) ?></td>
                        <th style="padding: 15px; text-align: left;">Tanggal</th>
                        <td style="padding: 15px;"><?= esc($pemeriksaanData['tanggalPemeriksaan']) ?></td>
                    </tr>
                    <tr>
                        <th style="padding: 15px; text-align: left;">Nama Pasien</th>
                        <td style="padding: 15px;"><?= esc($pasienData['namaPasien']) ?></td>
                        <th style="padding: 15px; text-align: left;">Dokter</th>
                        <td style="padding: 15px;">.....</td>
                    </tr>
                    <tr>
                        <th style="padding: 15px; text-align: left;">Umur</th>
                        <td style="padding: 15px;"><?= esc($pasienData['usia']) ?></td>
                        <th style="padding: 15px; text-align: left;">Unit</th>
                        <td style="padding: 15px;">Poli .....</td>
                    </tr>
                    <tr>
                        <th style="padding: 15px; text-align: left;">Alamat</th>
                        <td style="padding: 15px;"><?= esc($pasienData['alamat']) ?></td>
                        <th style="padding: 15px; text-align: left;">Diagnosa</th>
                        <td style="padding: 15px;">.....</td>
                    </tr>
                </tbody>
            </table>
            <table border="1" style="width: 100%; margin-bottom: 1rem;">
                <?php foreach (esc($itemPemeriksaanData) as $key => $value) { ?>
                    <thead>
                        <tr>
                            <?php foreach (($value) as $value1) { ?>
                                <th style="padding: 15px; text-align: center;"><?= $value1['namaPemeriksaan'] ?></th>
                            <?php } ?>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <?php foreach ((esc($subPemeriksaanData)[$key]) as $value2) { ?>
                                <td style="padding: 15px; vertical-align: top;">
                                    <?php foreach (($value2) as $value3) { ?>
                                        <p style="margin-bottom: 0;"><?= $value3['nama'] ?></p>
                                    <?php } ?>
                                </td>
                            <?php } ?>
                        </tr>
                    </tbody>
                <?php } ?>
            </table>
            <p style="margin-bottom: 1rem; text-align: right;">Printed : 16/05/2024 10:46:32</p>
            <table border="1" style="width: 100%; margin-bottom: 1rem;">
                <tr>
                    <td colspan="2" style="padding: 25px; text-align: center;">
                        <p style="margin-bottom: 0;">Bersedia diambil sample</p>
                    </td>
                    <td colspan="2" style="padding: 25px;">
                        <p>Jam diterima :</p>
                        <p style="margin-bottom: 0;">Jam diserahkan :</p>
                    </td>
                </tr>
                <tr>
                    <td style="padding: 25px; text-align: center;">
                        <p style="margin-bottom: 0;">Yang Menyerahkan</p>
                        <p style="padding-top: 60px;">(........................................)</p>
                    </td>
                    <td style="padding: 25px; text-align: center;">
                        <p style="margin-bottom: 0;">Yang Menerima</p>
                        <p style="padding-top: 60px;">(........................................)</p>
                    </td>
                    <td style="padding: 25px; text-align: center;">
                        <p style="margin-bottom: 0;">Yang Menerima</p>
                        <p style="padding-top: 60px;">(........................................)</p>
                    </td>
                    <td style="padding: 25px; text-align: center;">
                        <p style="margin-bottom: 0;">Yang Menyerahkan</p>
                        <p style="padding-top: 60px;">(........................................)</p>
                    </td>
                </tr>
            </table>
        </div>
        <div style="margin-top: 1rem; margin-bottom: 1rem; display: flex; align-items: center; justify-content: end;">
            <button onclick="printDiv()" style="padding: 10px; color: #fff;background-color: #218838;border-color: #1e7e34; display: inline-block; font-weight: 400; text-align: center; white-space: nowrap; vertical-align: middle;padding: .375rem .75rem;font-size: 1rem;line-height: 1.5;border-radius: .25rem;transition: color .15s ease-in-out,background-color .15s ease-in-out,border-color .15s ease-in-out,box-shadow .15s ease-in-out; border: 1px solid transparent;">CETAK FORMULIR</button>
        </div>
    </div>
</div>
<script>
    function printDiv() {
        var printContents = document.getElementById("doc-preview-pdf").innerHTML;
        var originalContents = document.body.innerHTML;
        document.body.innerHTML = printContents;
        window.print();
        document.body.innerHTML = originalContents;

    }
</script>
<?php $this->endSection() ?>