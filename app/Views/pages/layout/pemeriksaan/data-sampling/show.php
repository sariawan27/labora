<?php $this->extend('layouts/pemeriksaan'); ?>

<?php $this->section('content') ?>
<?php
$uri = service('uri');
$segment = $uri->getSegment(4);
?>
<div class="row">
    <div class="col-12">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header border-bottom">
                        <h4 class="card-title">Item Sample</h4>

                    </div>
                    <div class="card-body">
                        <table id="user-table" class="table table-striped table-bordered table-hover barang-table" style="width: 100%">
                            <thead>
                                <tr class="text-center">
                                    <th>No</th>
                                    <th>Keterangan</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach (esc($samplingData) as $key => $value) { ?>
                                    <tr>
                                        <td><?= $key + 1 ?></td>
                                        <td><?= $value['keterangan'] ?></td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-12">
        <div class="card">
            <div class="card-header border-bottom">
                <h4 class="card-title">Form Pemeriksaan</h4>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-12">
                        <form id="atlmForm">
                            <div class="modal-body">
                                <div class="form-body">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <input type="hidden" name="idatlm" id="idatlm">
                                            <div class="form-group mb-2">
                                                <label class="control-label">Keterangan</label>
                                                <textarea name="keterangan" id="keterangan" class="form-control" type="text" placeholder="Keterangan"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <a href="<?= base_url('pemeriksaan/data-pemeriksaan/show') ?>/<?= $uri->getSegment(4) ?>/<?= $uri->getSegment(5) ?>" type="button" class="btn btn-secondary">Cancel</a>
                                <button type="button" id="atlmSubmit" name="atlm-submit" class="btn btn-primary" onclick="doSubmit()">Simpan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="<?= base_url(); ?>/plugins/jquery/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    const doSubmit = () => {
        let keterangan = $('#keterangan').val()

        if (keterangan) {
            let data = {
                "keterangan": keterangan,
            }

            Swal.fire({
                icon: 'question',
                title: "Apakah anda yakin?",
                text: "Anda akan menambahkan data sample!",
                showCancelButton: true,
            }).then((r) => {
                if (r.isConfirmed) {
                    $.ajax({
                        url: "<?php echo site_url('pemeriksaan/data-sampling/add-sample') ?>/<?= $segment ?>",
                        data: data,
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
                                window.location = "<?php echo site_url('/pemeriksaan/data-sampling/show') ?>/<?= $uri->getSegment(4) ?>"
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

    }
</script>
<?php $this->endSection() ?>