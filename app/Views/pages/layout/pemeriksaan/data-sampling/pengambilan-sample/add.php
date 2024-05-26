<?php $this->extend('layouts/pemeriksaan'); ?>

<?php $this->section('content') ?>
<?php
$uri = service('uri');
$segment = $uri->getSegment(4);
?>
<div class="row">
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
                                        <div class="col-md-6">
                                            <input type="hidden" name="idatlm" id="idatlm">
                                            <div class="form-group mb-2">
                                                <label class="control-label">Item</label>
                                                <input name="idSubPemeriksaan" id="idSubPemeriksaan" class="form-control" style="display: none;" type="text" placeholder="Nama Item" value="<?= esc($pemeriksaanData['idSubPemeriksaan']) ?>">
                                                <input name="item" id="item" class="form-control" type="text" placeholder="Nama Item" value="<?= esc($pemeriksaanData['nama']) ?>">
                                            </div>
                                            <div class="form-group mb-2">
                                                <label class="control-label">Satuan</label>
                                                <input name="satuan" id="satuan" class="form-control" type="text" placeholder="Satuan">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group mb-2">
                                                <label class="control-label">Nilai</label>
                                                <textarea name="nilai" id="nilai" class="form-control" type="text" placeholder="Nilai"></textarea>
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
        let idSubPemeriksaan = $('#idSubPemeriksaan').val()
        let item = $('#item').val()
        let satuan = $('#satuan').val()
        let nilai = $('#nilai').val()

        if (idSubPemeriksaan && item && satuan && nilai) {
            let data = {
                "idSubPemeriksaan": idSubPemeriksaan,
                "item": item,
                "satuan": satuan,
                "nilai": nilai,
            }

            Swal.fire({
                icon: 'question',
                title: "Apakah anda yakin?",
                text: "Anda akan menambahkan data pemeriksaan!",
                showCancelButton: true,
            }).then((r) => {
                if (r.isConfirmed) {
                    $.ajax({
                        url: "<?php echo site_url('pemeriksaan/data-pemeriksaan/add-pengambilan-sample') ?>/<?= $segment ?>",
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
                                window.location = "<?php echo site_url('/pemeriksaan/data-pemeriksaan/show') ?>/<?= $uri->getSegment(4) ?>/<?= $uri->getSegment(5) ?>"
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