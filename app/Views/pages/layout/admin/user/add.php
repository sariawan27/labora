<?php $this->extend('layouts/admin'); ?>

<?php $this->section('content') ?>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header border-bottom">
                <h4 class="card-title">Tambah User</h4>
                
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-12">

                    <form id="atlmForm" action="<?= base_url() ?>admin/users/store-user" method="post">
                        <div class="modal-body">
                            <div class="form-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <input type="hidden" name="idatlm" id="idatlm">
                                        <div class="form-group mb-2">
                                            <label class="control-label">Nama Depan</label>
                                            <input name="depan" id="depan" class="form-control" type="text" placeholder="Nama Depan">
                                        </div>
                                        <div class="form-group mb-2">
                                            <label class="control-label">Nama Belakang</label>
                                            <input name="belakang" id="belakang" class="form-control" type="text" placeholder="Nama Belakang">
                                        </div>
                                        <div class="form-group mb-2">
                                            <label class="control-label">Email</label>
                                            <input name="email" id="email" class="form-control" type="text" placeholder="Email">
                                        </div>
                                        <div class="form-group mb-2">
                                            <label class="control-label">Nomor HP / Telp</label>
                                            <input name="nomor" id="nomor" class="form-control" type="text" placeholder="Nomor Hp/Telp">
                                        </div>
                                        <div class="form-group mb-2">
                                            <label class="control-label">Role</label>
                                            <select class="form-control"  name="role" id="role">
                                                <option value="1">Admin</option>
                                                <option value="2">Validator</option>
                                                <option value="3">Pasien</option>
                                                <option value="4">ATLM</option>
                                            </select>
                                        </div>
                                        <div class="form-group mb-2">
                                            <label class="control-label">Password</label>
                                            <input name="password" id="password" class="form-control" type="text" placeholder="Password">
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