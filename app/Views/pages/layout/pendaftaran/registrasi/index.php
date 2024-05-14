<?php $this->extend('layouts/pendaftaran'); ?>

<?php $this->section('content') ?>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header border-bottom">
                <h4 class="card-title">Lengkapi Data Pasien</h4>
                
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-12">

                    <form id="atlmForm" action="<?= base_url() ?>pendaftaran/set-registrasi" method="post">
                        <div class="modal-body">
                            <div class="form-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <input type="hidden" name="idatlm" id="idatlm">
                                        <div class="form-group mb-2">
                                            <label class="control-label">Nama</label>
                                            <input name="nama" id="nama" class="form-control" type="text" placeholder="Nama">
                                        </div>
                                        <div class="form-group mb-2">
                                            <label class="control-label">Tempat Lahir</label>
                                            <input name="tempat_lahir" id="tempat_lahir" class="form-control" type="text" placeholder="Tempat Lahir">
                                        </div>
                                        <div class="form-group mb-2">
                                            <label class="control-label">Tanggal Lahir</label>
                                            <input name="tanggal_lahir" id="tanggal_lahir" class="form-control" type="date" placeholder="Tanggal Lahir">
                                        </div>
                                        <div class="form-group mb-2">
                                            <label class="control-label">Usia</label>
                                            <input name="usia" id="usia" class="form-control" type="text" placeholder="Usia">
                                        </div>
                                        <div class="form-group mb-2">
                                            <label class="control-label">Jenis Kelamin</label>
                                            <select class="form-control"  name="jenis_kelamin" id="jenis_kelamin">
                                                <option value="L">Laki-laki</option>
                                                <option value="P">Perempuan</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group mb-2">
                                            <label class="control-label">NIK</label>
                                            <input name="nik" id="nik" class="form-control" type="text" placeholder="NIK">
                                        </div>
                                        <div class="form-group mb-2">
                                            <label class="control-label">Email</label>
                                            <input name="email" id="email" class="form-control" type="email" placeholder="Email">
                                        </div>
                                        <div class="form-group mb-2">
                                            <label class="control-label">No HP</label>
                                            <input name="no_telp" id="no_telp" class="form-control" type="text" placeholder="No hp">
                                        </div>
                                        <div class="form-group mb-2">
                                            <label class="control-label">Alamat</label>
                                            <textarea name="alamat" id="alamat" class="form-control" placeholder="Alamat" rows="4"></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" id="atlmSubmit" name="atlm-submit" class="btn btn-primary">Simpan</button>
                        </div>
                    </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $this->endSection() ?>