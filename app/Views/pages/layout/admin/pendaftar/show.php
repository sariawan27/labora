<?php $this->extend('layouts/pendaftaran'); ?>

<?php $this->section('content') ?>
<div class="row">
    <div class="col-12">
        <div class="row">
            <div class="col-6 d-flex justify-content-center flex-column">
                <div class="row align-self-center" style="width: 40%;">
                    <div class="col-12 text-center card p-3 border-3" style="cursor: pointer; border-radius: 20px; width: 30%;">
                        <img src="https://upload.wikimedia.org/wikipedia/commons/5/5e/QR_Code_example.png" style="
    padding: 8px;
" />
                        <h1>10</h1>
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
                        <td style="padding: 15px;">P0000001</td>
                        <th style="padding: 15px; text-align: left;">Tanggal / Jam</th>
                        <td style="padding: 15px;">16/05/2024 / 10:46:00</td>
                    </tr>
                    <tr>
                        <th style="padding: 15px; text-align: left;">Nama Pasien</th>
                        <td style="padding: 15px;">Sapa Namane</td>
                        <th style="padding: 15px; text-align: left;">Dokter</th>
                        <td style="padding: 15px;">dr. Jarjit</td>
                    </tr>
                    <tr>
                        <th style="padding: 15px; text-align: left;">Umur</th>
                        <td style="padding: 15px;">23 Tahun, 8 Bulan, 8 Hari</td>
                        <th style="padding: 15px; text-align: left;">Unit</th>
                        <td style="padding: 15px;">Poli Umum</td>
                    </tr>
                    <tr>
                        <th style="padding: 15px; text-align: left;">Alamat</th>
                        <td style="padding: 15px;">Jalan Ir. Juanda No 117, Cilacap Tengah, Cilacap, Jawa Tengah</td>
                        <th style="padding: 15px; text-align: left;">Diagnosa</th>
                        <td style="padding: 15px;">Hamil</td>
                    </tr>
                </tbody>
            </table>
            <table border="1" style="width: 100%; margin-bottom: 1rem;">
                <thead>
                    <tr>
                        <th style="padding: 15px; text-align: center;">HEMATOLOGI</th>
                        <th style="padding: 15px; text-align: center;">KIMIA DARAH</th>
                        <th style="padding: 15px; text-align: center;">URINE</th>
                        <th style="padding: 15px; text-align: center;">SEROLOGI</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td style="padding: 15px; vertical-align: top;">
                            <p style="margin-bottom: 0;">HB (HEMOGLOBIN)</p>
                            <p style="margin-bottom: 0;">HB (RUJUKAN)</p>
                        </td>
                        <td style="padding: 15px; vertical-align: top;">
                            <p style="margin-bottom: 0;">ALBUMIN</p>
                            <p style="margin-bottom: 0;">ALT (SGPT)</p>
                            <p style="margin-bottom: 0;">ASAM URAT</p>
                            <p style="margin-bottom: 0;">AST (SGOT)</p>
                            <p style="margin-bottom: 0;">BILIRUBIN DIREK</p>
                            <p style="margin-bottom: 0;">BILIRUBIN TOTAL</p>
                            <p style="margin-bottom: 0;">GAMMA GT</p>
                            <p style="margin-bottom: 0;">GLOBULIN</p>
                            <p style="margin-bottom: 0;">GLUKOSA 2JAM PP/SEWAKTU</p>
                            <p style="margin-bottom: 0;">GLUKOSA PUASA</p>
                            <p style="margin-bottom: 0;">HDL</p>
                            <p style="margin-bottom: 0;">KOLESTROL TOTAL</p>
                            <p style="margin-bottom: 0;">KREATININ</p>
                            <p style="margin-bottom: 0;">LDL</p>
                            <p style="margin-bottom: 0;">TRIGLISERID</p>
                            <p style="margin-bottom: 0;">UREUM/UREA</p>
                        </td>
                        <td style="padding: 15px; vertical-align: top;">
                            <p style="margin-bottom: 0;">TES KEHAMILAN</p>
                            <p style="margin-bottom: 0;">URINE RUTIN</p>
                        </td>
                        <td style="padding: 15px; vertical-align: top;">
                            <p style="margin-bottom: 0;">IGG RUBELLA</p>
                            <p style="margin-bottom: 0;">IGG TOXOPLASMA</p>
                            <p style="margin-bottom: 0;">IGM RUBELLA</p>
                            <p style="margin-bottom: 0;">IGM TOXOPLASMA</p>
                        </td>
                    </tr>
                    <tr>
                        <th style="padding: 15px; text-align: center;">FESES</th>
                        <th style="padding: 15px; text-align: center;">LAIN-LAIN</th>
                        <th style="padding: 15px; text-align: center;" rowspan="2"></th>
                    </tr>
                    <tr>
                        <td style="padding: 15px;">
                            <p style="margin-bottom: 0;">AMOEBA</p>
                        </td>
                        <td></td>
                    </tr>
                </tbody>
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