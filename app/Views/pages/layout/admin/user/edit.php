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
                <h4 class="card-title">Edit User</h4>

            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-12">

                        <form id="atlmForm" action="<?= base_url() ?>admin/users/update-user/<?= $uri->getSegment(4) ?>" method="post">
                            <div class="modal-body">
                                <div class="form-body">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <input type="hidden" name="idatlm" id="idatlm">
                                            <div class="form-group mb-2">
                                                <label class="control-label">Nama Depan</label>
                                                <input name="depan" id="depan" class="form-control" type="text" placeholder="Nama Depan" value="<?= esc($userData)['namaDepan'] ?>">
                                            </div>
                                            <div class="form-group mb-2">
                                                <label class="control-label">Nama Belakang</label>
                                                <input name="belakang" id="belakang" class="form-control" type="text" placeholder="Nama Belakang" value="<?= esc($userData)['namaBelakang'] ?>">
                                            </div>
                                            <div class="form-group mb-2">
                                                <label class="control-label">Email</label>
                                                <input name="email" id="email" class="form-control" type="text" placeholder="Email" value="<?= esc($userData)['email'] ?>">
                                            </div>
                                            <div class="form-group mb-2">
                                                <label class="control-label">Nomor HP / Telp</label>
                                                <input name="nomor" id="nomor" class="form-control" type="text" placeholder="Nomor Hp/Telp" value="<?= esc($userData)['nomor'] ?>">
                                            </div>
                                            <div class="form-group mb-2">
                                                <label class="control-label">Role</label>
                                                <select class="form-control" name="role" id="role">
                                                    <option value="1" <?= esc($userData)['roleId'] == 1 ? "selected" : "" ?>>Admin</option>
                                                    <option value="2" <?= esc($userData)['roleId'] == 2 ? "selected" : "" ?>>Validator</option>
                                                    <option value="3" <?= esc($userData)['roleId'] == 3 ? "selected" : "" ?>>Pasien</option>
                                                    <option value="4" <?= esc($userData)['roleId'] == 4 ? "selected" : "" ?>>ATLM</option>
                                                </select>
                                            </div>
                                            <div class="form-group mb-2">
                                                <label class="control-label">Username</label>
                                                <input name="username" id="username" class="form-control" type="text" placeholder="Username" value="<?= esc($userData)['username'] ?>">
                                            </div>
                                            <div class="form-group mb-2">
                                                <label class="control-label">Password</label>
                                                <input name="password" id="password" class="form-control" type="text" placeholder="Password" value="<?= esc($userData)['password'] ?>">
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