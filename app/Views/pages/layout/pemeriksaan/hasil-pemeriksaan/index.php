<?php $this->extend('layouts/pemeriksaan'); ?>

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

        <div style="padding: 2rem; width: 100%; background-color: white;" id="doc-preview-pdf">
            <h2 style="text-align: center; margin-bottom: 1rem; font-weight: bold;">FORM PERMINTAAN PEMERIKSAAN LABORATORIUM</h2>
            <table border="1" style="width: 100%; margin-bottom: 2rem;">
                <tbody>
                    <tr>
                        <th style="padding: 15px; text-align: left;">No. RM</th>
                        <td style="padding: 15px;"></td>
                        <th style="padding: 15px; text-align: left;">Tanggal</th>
                        <td style="padding: 15px;"></td>
                    </tr>
                    <tr>
                        <th style="padding: 15px; text-align: left;">Nama Pasien</th>
                        <td style="padding: 15px;"></td>
                        <th style="padding: 15px; text-align: left;">Dokter</th>
                        <td style="padding: 15px;">.....</td>
                    </tr>
                    <tr>
                        <th style="padding: 15px; text-align: left;">Umur</th>
                        <td style="padding: 15px;"></td>
                        <th style="padding: 15px; text-align: left;">Unit</th>
                        <td style="padding: 15px;">Poli .....</td>
                    </tr>
                    <tr>
                        <th style="padding: 15px; text-align: left;">Alamat</th>
                        <td style="padding: 15px;"></td>
                        <th style="padding: 15px; text-align: left;">Diagnosa</th>
                        <td style="padding: 15px;">.....</td>
                    </tr>
                </tbody>
            </table>
            <table border="1" style="width: 100%; margin-bottom: 1rem;">
                <thead>
                    <tr>
                        <th style="padding: 15px; text-align: center;"></th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td style="padding: 15px; vertical-align: top;">
                            <p style="margin-bottom: 0;"></p>
                        </td>
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
                        return '<a href="<?= base_url('pemeriksaan/data-pemeriksaan/show/') ?>' + data + '/' + row.idPasien + '">Unduh</a>';
                    }
                },
            ]
        });
    });

    function getData(id, idPasien) {
        $.ajax({
            url: "<?php echo site_url('sampling/petugas-edit') ?>",
            data: data,
            type: 'GET',
            success: function(response) {
                if (response.error) {
                    return Swal.fire({
                        icon: 'error',
                        title: "Oops..",
                        text: response?.message ?? "Something went wrong!"
                    })
                }
                return Swal.fire({
                    icon: 'success',
                    title: "Success",
                    text: response?.message ?? ""
                }).then((res) => {
                    window.location = "<?php echo site_url('/sampling/laboratorium') ?>"
                })
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
</script>
<?php $this->endSection(); ?>