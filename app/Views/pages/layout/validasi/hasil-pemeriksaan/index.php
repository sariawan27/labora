<?php $this->extend('layouts/validasi'); ?>

<?php $this->section('content') ?>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header border-bottom">
                <h4 class="card-title">Hasil Pemeriksaan</h4>

            </div>
            <div class="card-body">
                <table id="user-table" class="table table-striped table-bordered table-hover barang-table" style="width: 100%">
                    <thead>
                        <tr class="text-center">
                            <th>No</th>
                            <th>Nama Pasien</th>
                            <th>No. RM</th>
                            <th>Status Pembayaran</th>
                            <th>Status Pemeriksaan</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
    <div class="col-12">
        <div style="padding: 2rem; width: 100%; background-color: white; display: none;" id="doc-preview-pdf">
            <h2 style="text-align: center; margin-bottom: 1rem; font-weight: bold;">Hasil PEMERIKSAAN LABORATORIUM</h2>
            <table style="width: 100%; margin-bottom: 2rem;">
                <tbody>
                    <tr>
                        <th style="width:25%; padding: 15px; text-align: left;">Dokter</th>
                        <td style="padding: 15px;" id="dokter">....</td>
                        <th style="width:25%; padding: 15px; text-align: left;">Umur</th>
                        <td style="padding: 15px;" id="umur"></td>
                    </tr>
                    <tr>
                        <th style="width:25%; padding: 15px; text-align: left;">Nama Pasien</th>
                        <td style="width:25%; padding: 15px;" id="nama_pasien"></td>
                        <th style="width:25%; padding: 15px; text-align: left;">Tanggal</th>
                        <td style="width:25%; padding: 15px;">.....</td>
                    </tr>
                    <tr>
                        <th style="width:25%; padding: 15px; text-align: left;">Alamat</th>
                        <td style="width:25%; padding: 15px;" id="alamat"></td>
                        <th style="width:25%; padding: 15px; text-align: left;">No. RM</th>
                        <td style="width:25%; padding: 15px;" id="no_rm">Poli .....</td>
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
</div>
<!-- jQuery -->
<script src="<?= base_url(); ?>/plugins/jquery/jquery.min.js"></script>
<script>
    $(document).ready(function() {
        var table = $('#user-table').DataTable({
            "processing": true,
            "serverSide": true,
            "order": [],
            "ajax": {
                "url": "<?php echo site_url('pemeriksaan/data-pemeriksaan-list') ?>",
                "type": "GET"
            },
            "columnDefs": [{
                "targets": [],
                "orderable": false,
            }, ],
            "columns": [{
                    "data": 'id',
                    "sortable": false,
                    render: function(data, type, row, meta) {
                        return meta.row + meta.settings._iDisplayStart + 1;
                    }
                },
                {
                    data: 'namaPasien',
                    name: 'namaPasien'
                },
                {
                    data: 'nomorRekamMedis',
                    name: 'nomorRekamMedis'
                },
                {
                    data: 'status',
                    name: 'status'
                },
                {
                    data: 'statusSelesai',
                    name: 'statusSelesai'
                },
                {
                    "data": "id", // Tampilkan kolomid_kategori pada table kategori
                    "render": function(data, type, row, meta) {
                        return '<a href="<?= base_url('validasi/hasil-pemeriksaan/show/') ?>' + data + '/' + row.idPasien + '">Edit</a> | ' + '<a onclick="getData(' + data + ',' + row.idPasien + ')">Unduh</a>';
                    }
                },
            ]
        });
    });

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

    function printDiv() {
        var printContents = document.getElementById("doc-preview-pdf").innerHTML;
        var originalContents = document.body.innerHTML;
        document.body.innerHTML = printContents;
        window.print();
        document.body.innerHTML = originalContents;

    }
</script>
<?php $this->endSection(); ?>