<?php $this->extend('layouts/pemeriksaan'); ?>

<?php $this->section('content') ?>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header border-bottom">
                <h4 class="card-title">Form Tambah Data Petugas</h4>
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
                                                <label class="control-label">Nama Lengkap</label>
                                                <input name="namaLengkap" id="namaLengkap" class="form-control" type="text" placeholder="Nama Lengkap">
                                            </div>
                                            <div class="form-group mb-2">
                                                <label class="control-label">Tanggal Lahir</label>
                                                <input name="tglLahir" id="tglLahir" class="form-control" type="date" placeholder="Tanggal Lahir">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group mb-2">
                                                <label class="control-label">NIK</label>
                                                <input name="nik" id="nik" class="form-control" type="text" placeholder="NIK">
                                            </div>
                                            <div class="form-group mb-2">
                                                <label class="control-label">Tanggal Tugas</label>
                                                <input name="tglTugas" id="tglTugas" class="form-control" type="date" placeholder="Tanggal Tugas">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <a href="/pemeriksaan/laboratorium" type="button" class="btn btn-secondary">Cancel</a>
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
        let namaLengkap = $('#namaLengkap').val()
        let tglLahir = $('#tglLahir').val()
        let tglTugas = $('#tglTugas').val()
        let nik = $('#nik').val()

        if (namaLengkap && tglLahir && tglTugas && nik) {
            let data = {
                "namaLengkap": namaLengkap,
                "tglLahir": tglLahir,
                "tglTugas": tglTugas,
                "nik": nik,
            }

            Swal.fire({
                icon: 'question',
                title: "Are you sure?",
                text: "This action will be add petugas data!",
                showCancelButton: true,
            }).then((r) => {
                if (r.isConfirmed) {
                    $.ajax({
                        url: "<?php echo site_url('pemeriksaan/petugas-add') ?>",
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
                                window.location = "<?php echo site_url('/pemeriksaan/laboratorium') ?>"
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