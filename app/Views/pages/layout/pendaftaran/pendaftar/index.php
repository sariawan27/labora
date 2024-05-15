<?php $this->extend('layouts/pendaftaran'); ?>

<?php $this->section('content') ?>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header border-bottom">
                <h4 class="card-title">Data Pendaftar</h4>

            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-2">
                        <a class="btn btn-primary" href="<?= base_url() ?>pendaftaran/registrasi">Tambah Pendaftar</a>
                    </div>
                </div>
                <table id="user-table" class="table table-striped table-bordered table-hover barang-table" style="width: 100%">
                    <thead>
                        <tr class="text-center">
                            <th>No</th>
                            <th>Tanggal Periksa</th>
                            <th>Nama Pasien</th>
                            <th>No. RM</th>
                            <th>No. Antrian</th>
                            <th>Last Update</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                </table>
            </div>
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
                "url": "<?php echo site_url('pendaftaran/pendaftar-list') ?>",
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
                    data: 'tanggalPemeriksaan',
                    name: 'tanggalPemeriksaan'
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
                    data: 'NomorAntrian',
                    name: 'NomorAntrian'
                },
                {
                    data: 'updated_at',
                    name: 'updated_at'
                },
                {
                    "data": "id", // Tampilkan kolomid_kategori pada table kategori
                    "render": function(data, type, row, meta) {
                        return '<a href="show/' + data + '">Show</a>';
                    }
                },
            ]
        });
    });
</script>
<?php $this->endSection(); ?>