<?php $this->extend('layouts/admin'); ?>

<?php $this->section('content') ?>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header border-bottom">
                <h4 class="card-title">Data Item Pemeriksaan</h4>

            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-2">
                        <a class="btn btn-primary" href="<?= base_url() ?>admin/item-pemeriksaan/create-item">Tambah Item</a>
                    </div>
                </div>
                <table id="user-table" class="table table-striped table-bordered table-hover barang-table" style="width: 100%">
                    <thead>
                        <tr class="text-center">
                            <th>No</th>
                            <th>Nama Pemeriksaan</th>
                            <th class="text-center">Action</th>
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
    const onClickDelete = (id) => {
        Swal.fire({
            icon: 'question',
            title: "Are you sure?",
            text: "This action will be delete item pemeriksaan!",
            showCancelButton: true,
        }).then((r) => {
            if (r.isConfirmed) {
                $.ajax({
                    url: "<?php echo site_url('admin/item-pemeriksaan/delete-item') ?>",
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
                        $('#user-table').DataTable().draw()
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
        var table = $('#user-table').DataTable({
            "processing": true,
            "serverSide": true,
            "order": [],
            "ajax": {
                "url": "<?php echo site_url('admin/item-pemeriksaan-list') ?>",
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
                    data: 'namaPemeriksaan',
                    name: 'namaPemeriksaan'
                },
                {
                    "data": "id", // Tampilkan kolomid_kategori pada table kategori
                    "render": function(data, type, row, meta) {
                        return `
                            <div class="d-flex align-items-center justify-content-center">
                                <a href="<?= base_url('admin/item-pemeriksaan/show-item/') ?>${data}" class="mr-2">Show</a>
                                <a href="javascript:;" class="text-danger" onclick="onClickDelete('${data}')">Delete</a>
                            </div>
                        `
                    }
                },
            ]
        });
    });
</script>
<?php $this->endSection(); ?>