<?php $this->extend('layouts/validasi'); ?>

<?php $this->section('content') ?>
<?php
$uri = service('uri');
$segment = $uri->getSegment(4);
?>
<div class="row">
    <div class="col-12">
        <div class="row">
            <div class="col-12">
                <div style="padding: 2rem; width: 100%; background-color: white;" id="doc-preview-pdf">
                    <h2 style="text-align: center; margin-bottom: 1rem; font-weight: bold;">Hasil PEMERIKSAAN LABORATORIUM</h2>
                    <table style="width: 100%; margin-bottom: 2rem;">
                        <tbody>
                            <tr>
                                <th style="width:25%; padding: 15px; text-align: left;">Dokter</th>
                                <td style="padding: 15px;" id="dokter">....</td>
                                <th style="width:25%; padding: 15px; text-align: left;">Umur</th>
                                <td style="padding: 15px;" id="umur"><?= esc($pasienData['usia']) ?></td>
                            </tr>
                            <tr>
                                <th style="width:25%; padding: 15px; text-align: left;">Nama Pasien</th>
                                <td style="width:25%; padding: 15px;" id="nama_pasien"><?= esc($pasienData['namaPasien']) ?></td>
                                <th style="width:25%; padding: 15px; text-align: left;">Tanggal</th>
                                <td style="width:25%; padding: 15px;">.....</td>
                            </tr>
                            <tr>
                                <th style="width:25%; padding: 15px; text-align: left;">Alamat</th>
                                <td style="width:25%; padding: 15px;" id="alamat"><?= esc($pasienData['alamat']) ?></td>
                                <th style="width:25%; padding: 15px; text-align: left;">No. RM</th>
                                <td style="width:25%; padding: 15px;" id="no_rm"><?= esc($pasienData['nomorRekamMedis']) ?></td>
                            </tr>
                        </tbody>
                    </table>
                    <table border="1" style="width: 100%; margin-bottom: 1rem;">
                        <thead>
                            <tr>
                                <th style="padding: 15px; text-align: center;">No</th>
                                <th style="padding: 15px; text-align: center;">Pemeriksaan</th>
                                <th style="padding: 15px; text-align: center;">Satuan</th>
                                <th style="padding: 15px; text-align: center;">Hasil Pemeriksaan</th>
                                <th style="padding: 15px; text-align: center;">Nilai Normal</th>
                            </tr>
                        </thead>
                        <tbody id="tbody-hasil">
                            <?php foreach (esc($pemeriksaanData) as $key => $value) { ?>
                                <tr>
                                    <td style="padding: 15px; vertical-align: top;">
                                        <p style="margin-bottom: 0;"><?= $key + 1 ?></p>
                                    </td>
                                    <td style="padding: 15px; vertical-align: top;">
                                        <p style="margin-bottom: 0;"><?= $value['namaSubPemeriksaan'] ?></p>
                                    </td>
                                    <td style="padding: 15px; vertical-align: top; text-align: center;">
                                        <p style="margin-bottom: 0;"><?= $value['satuan'] ?></p>
                                    </td>
                                    <td style="padding: 15px; vertical-align: top;">
                                        <p style="margin-bottom: 0;"></p>
                                    </td>
                                    <td style="padding: 15px; vertical-align: top; text-align: center;">
                                        <p style="margin-bottom: 0;"><?= $value['normal'] ?></p>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                    <table style="width: 100%; margin-bottom: 1rem; margin-top: 185px;">
                        <tr>
                            <td style="padding: 25px; text-align: center;">
                                <p style="margin-bottom: 0;">Dokter Penanggung Jawab Laboratorium</p>
                                <p style="padding-top: 130px;">Dr. Khansa Wafa Alifah</p>
                                <p>NIP. 190678534 219001 3 2025</p>
                            </td>
                            <td style="padding: 25px; text-align: center;">
                                <p style="margin-bottom: 0;">Koordinator Laboratorium</p>
                                <p style="padding-top: 130px;">Adinda Zaqiza Ulfa, Amd. Kes</p>
                                <p>NIP. 1977654321 234562 4 2025</p>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
            <div style="position: fixed; right: 2%; bottom: 8%; display: flex; flex-direction: column;">
                <button onclick="return location.href= '<?php echo site_url('validasi/hasil-pemeriksaan/process-validation/' . $uri->getSegment(4) . '/' . $uri->getSegment(5)) ?>'" style="margin-bottom:5px; padding: 10px; color: #fff;background-color: #218838;border-color: #1e7e34; display: inline-block; font-weight: 400; text-align: center; white-space: nowrap; vertical-align: middle;padding: .375rem .75rem;font-size: 1rem;line-height: 1.5;border-radius: .25rem;transition: color .15s ease-in-out,background-color .15s ease-in-out,border-color .15s ease-in-out,box-shadow .15s ease-in-out; border: 1px solid transparent;">VALIDASI</button>
                <button onclick="return location.href= '<?= base_url('validasi/hasil-pemeriksaan') ?>'" style="padding: 10px; color: #fff;background-color: #FF0200;border-color: #1e7e34; display: inline-block; font-weight: 400; text-align: center; white-space: nowrap; vertical-align: middle;padding: .375rem .75rem;font-size: 1rem;line-height: 1.5;border-radius: .25rem;transition: color .15s ease-in-out,background-color .15s ease-in-out,border-color .15s ease-in-out,box-shadow .15s ease-in-out; border: 1px solid transparent;">BATAL VALIDASI</button>
            </div>
        </div>
    </div>
</div>
<!-- jQuery -->
<script src="<?= base_url(); ?>/plugins/jquery/jquery.min.js"></script>
<script>
    function getData(id, idPasien) {
        $.ajax({
            url: "<?php echo site_url('pemeriksaan/hasil-pemeriksaan/hasil/') ?>" + id + "/" + idPasien,
            type: 'GET',
            success: function(response) {
                console.log(JSON.parse(response))
                var pasienData = JSON.parse(response).pasienData
                var pemeriksaanData = JSON.parse(response).pemeriksaanData
                $('#umur').text(pasienData.usia)
                $('#nama_pasien').text(pasienData.namaPasien)
                $('#alamat').text(pasienData.alamat)
                $('#no_rm').text(pasienData.nomorRekamMedis)

                var html;
                pemeriksaanData.forEach((element, index) => {
                    html += `<tr>`
                    html += `
                        <td style="padding: 15px; vertical-align: top;">
                            <p style="margin-bottom: 0;">${index+1}</p>
                        </td>
                        <td style="padding: 15px; vertical-align: top;">
                            <p style="margin-bottom: 0;">${element.namaSubPemeriksaan}</p>
                        </td>
                        <td style="padding: 15px; vertical-align: top;">
                            <p style="margin-bottom: 0;">${element?.satuanAcuan ? element?.satuanAcuan : ''}</p>
                        </td>
                        <td style="padding: 15px; vertical-align: top;">
                            <p style="margin-bottom: 0;">${element.normal}</p>
                        </td>
                        <td style="padding: 15px; vertical-align: top;">
                            <p style="margin-bottom: 0;">${element?.nilaiAcuan ? element?.nilaiAcuan : ''}</p>
                        </td>
                    `
                    html += `</tr>`
                });

                $('#tbody-hasil').html(pemeriksaanData.length < 1 ? '' : html)

                printDiv();
            },
            error: function(xhr, status, error) {
                let res = JSON.parse(xhr.responseText)
                return Swal.fire({
                    icon: 'error',
                    title: "Oops..",
                    text: res?.message ?? "Something went wrong!"
                })
            }
        });
    }
    console.log("wkwkwkwkwkw")
</script>
<?php $this->endSection(); ?>