<?php $this->extend('layouts/admin'); ?>

<?php $this->section('content') ?>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header border-bottom">
                <h4 class="card-title">Data Pendaftar</h4>

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
                            <th>Total Bayar</th>
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
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    const doSubmit = (id) => {
        Swal.fire({
            icon: 'question',
            title: "Apakah anda yakin?",
            text: "Tekan Ok, jika ingin mengkonfirmasi pembayaran!",
            showCancelButton: true,
        }).then((r) => {
            if (r.isConfirmed) {
                $.ajax({
                    url: "<?php echo site_url('admin/pendaftar/update-pembayaran/') ?>" + id,
                    data: [],
                    type: 'POST',
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
                            window.location = "<?php echo site_url('/admin/pendaftar') ?>"
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
        })

    }
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
                    data: 'totalPembayaran',
                    name: 'totalPembayaran'
                },
                {
                    "data": "id", // Tampilkan kolomid_kategori pada table kategori
                    "render": function(data, type, row, meta) {
                        return '<button class="btn btn-primary" onclick="doSubmit(' + data + ');">Konfirmasi Pembayaran</button>';
                    }
                },
            ]
        });
    });
</script>
<?php $this->endSection(); ?>