<?php $this->extend('layouts/admin'); ?>

<?php $this->section('content') ?>
<?php
$uri = service('uri');
$segment = $uri->getSegment(4);
?>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header border-bottom">
                <h4 class="card-title">Detail Item</h4>

            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-12">

                        <form id="atlmForm" action="<?= base_url() ?>admin/item-pemeriksaan/update-item/<?= $uri->getSegment(4) ?>" method="post">
                            <div class="modal-body">
                                <div class="form-body">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <input type="hidden" name="idatlm" id="idatlm">
                                            <div class="form-group mb-2">
                                                <label class="control-label">Nama Pemeriksaan</label>
                                                <input name="namaPemeriksaan" id="depan" class="form-control" type="text" placeholder="Nama Pemeriksaan" value="<?= esc($itemPemeriksaanData)['namaPemeriksaan'] ?>">
                                            </div>
                                            <div class="form-group mb-2">
                                                <label class="control-label">Picture</label>
                                                <input name="picture" id="picture" class="form-control" type="text" placeholder="Picture" value="<?= esc($itemPemeriksaanData)['picture'] ?>">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <a href="<?= base_url('admin/item-pemeriksaan') ?>" type="button" class="btn btn-secondary">Cancel</a>
                                <button type="submit" id="atlmSubmit" name="atlm-submit" class="btn btn-primary">Simpan</button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="row">
                            <div class="col-2">
                                <a class="btn btn-primary" href="<?= base_url() ?>admin/sub-item-pemeriksaan/create-sub-item/<?= $uri->getSegment(4) ?>">Tambah Sub Item</a>
                            </div>
                        </div>
                        <table id="user-table" class="table table-striped table-bordered table-hover barang-table" style="width: 100%">
                            <thead>
                                <tr class="text-center">
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>Harga</th>
                                    <th>Deskripsi</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
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
            text: "This action will be delete sub item pemeriksaan!",
            showCancelButton: true,
        }).then((r) => {
            if (r.isConfirmed) {
                $.ajax({
                    url: "<?php echo site_url('admin/sub-item-pemeriksaan/delete-sub-item') ?>",
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
                "url": "<?php echo site_url('admin/sub-item-pemeriksaan-list/') ?><?= $uri->getSegment(4) ?>",
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
                    data: 'nama',
                    name: 'nama'
                },
                {
                    data: 'harga',
                    name: 'harga'
                },
                {
                    data: 'deskripsi',
                    name: 'deskripsi'
                },
                {
                    "data": "id", // Tampilkan kolomid_kategori pada table kategori
                    "render": function(data, type, row, meta) {
                        return `
                            <div class="d-flex align-items-center justify-content-center">
                                <a href="<?= base_url('admin/sub-item-pemeriksaan/edit-sub-item/') ?>${data}" class="mr-2">Edit</a>
                                <a href="javascript:;" class="text-danger" onclick="onClickDelete('${data}')">Delete</a>
                            </div>
                        `
                    }
                },
            ]
        });
    });
</script>
<?php $this->endSection() ?>