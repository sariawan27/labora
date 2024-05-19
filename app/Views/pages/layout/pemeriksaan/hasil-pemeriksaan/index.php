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
</script>
<?php $this->endSection(); ?>