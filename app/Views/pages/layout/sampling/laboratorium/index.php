<?php $this->extend('layouts/pemeriksaan'); ?>

<?php $this->section('content') ?>

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header border-bottom">
                <h4 class="card-title">Petugas Laboratorium</h4>
            </div>
            <div class="card-body">
                <div class="row mb-4">
                    <div class="col-2">
                        <a class="btn btn-primary" href="/pemeriksaan/laboratorium/add">Tambah Petugas</a>
                    </div>
                </div>
                <div class="table-responsive w-100">
                    <table id="petugas-table" class="table table-striped table-bordered table-hover w-100">
                        <thead>
                            <tr class="text-center">
                                <th>Nama Lengkap</th>
                                <th>Tanggal Lahir</th>
                                <th>NIK</th>
                                <th>Tanggal Tugas</th>
                                <th>Last Update</th>
                                <th class="text-center">Actions</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- jQuery -->
<script src="<?= base_url(); ?>/plugins/jquery/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    const onClickDelete = (id) => {
        Swal.fire({
            icon: 'question',
            title: "Are you sure?",
            text: "This action will be delete petugas data!",
            showCancelButton: true,
        }).then((r) => {
            if (r.isConfirmed) {
                $.ajax({
                    url: "<?php echo site_url('pemeriksaan/petugas-delete') ?>",
                    data: {
                        id: id
                    },
                    type: 'POST',
                    success: function(response) {
                        if (response.error) {
                            return Swal.fire({
                                icon: 'error',
                                title: "Oops..",
                                text: response?.message ?? "Something went wrong!"
                            })
                        }
                        $('#petugas-table').DataTable().draw()
                        return Swal.fire({
                            icon: 'success',
                            title: "Success",
                            text: response?.message ?? ""
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
        var table = $('#petugas-table').DataTable({
            "processing": true,
            "serverSide": true,
            "order": [],
            "ajax": {
                "url": "<?php echo site_url('pemeriksaan/petugas-list') ?>",
                "type": "GET"
            },
            "columnDefs": [{
                "targets": [],
                "orderable": false,
            }, ],
            "columns": [{
                    data: 'namaLengkap',
                    name: 'namaLengkap'
                },
                {
                    data: 'tglLahir',
                    name: 'tglLahir'
                },
                {
                    data: 'nik',
                    name: 'nik'
                },
                {
                    data: 'tglTugas',
                    name: 'tglTugas'
                },
                {
                    data: 'updated_at',
                    name: 'updated_at'
                },
                {
                    "data": "id",
                    "render": function(data, type, row, meta) {
                        return `
                            <div class="d-flex align-items-center justify-content-center">
                                <a href="/pemeriksaan/laboratorium/edit?id=${data}" class="fa fa-edit mr-2"></a>
                                <a href="javascript:;" class="fa fa-trash text-danger" onclick="onClickDelete('${data}')"></a>
                            </div>
                        `;
                    }
                },
            ]
        });
    });
</script>
<?php $this->endSection(); ?>