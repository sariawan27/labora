<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>AdminLTE 3 | Log in</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?= base_url(); ?>/plugins/fontawesome-free/css/all.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="<?= base_url(); ?>/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?= base_url(); ?>/dist/css/adminlte.min.css">
  <style>
    .weight-text {
        font-weight: 650;
    }
    .button-landing {
        font-weight: 800;
        font-size: 20px;
        border: 3px solid #ffc107;
        color: black;
    }
  </style>
</head>
<body class="hold-transition" style="height:unset !important; background: url('<?= base_url()?>/dist/img/lab-bg.webp'); background-size: cover; background-repeat: no-repeat; ">

<div style="background: rgba(97, 227, 250, 0.5); position: absolute; z-index: 2; width: 100%; height: 100vh;">

    <div class="row d-flex flex-column" style="margin: 1.5rem; height:100%;">
        <div class="row d-flex justify-content-center" style="height: 20%;">
                <div class="col-12 d-flex justify-content-center">
                    <img src="https://media-public.canva.com/Yu9FE/MAFmV5Yu9FE/1/t.png" alt="logokemenkes" style="height:  85px;  width: 85px;">
                </div>
                <div class="col-12 d-flex justify-content-center mt-4">
                    <h4 class="weight-text">LABORA</h4>
                </div>
                <div class="col-12 d-flex justify-content-center">
                    <h4 class="weight-text">YOUR PERSONAL HEALTH & WELLNESS COMPANION</h4>
                </div>
        </div>
        <div class="row" style="height: 60%; margin-top: 3rem;">
            <div class="col-12 d-flex flex-column align-items-center">
                <a href="<?= base_url() ?>login/pendaftaran" class="btn btn-outline-warning button-landing" style="width: 350px;">PENDAFTARAN</a>
                <a href="<?= base_url() ?>login/sampling" class="btn btn-outline-warning button-landing" style="width: 350px; margin-top: 1rem;">SAMPLING</a>
                <a href="<?= base_url() ?>login/pemeriksaan" class="btn btn-outline-warning button-landing" style="width: 350px; margin-top: 1rem;">PEMERIKSAAN</a>
                <a href="<?= base_url() ?>login/validasi" class="btn btn-outline-warning button-landing" style="width: 350px; margin-top: 1rem;">VALIDASI</a>
            </div>
        </div>
    </div>
</div>
<!-- /.login-box -->

<!-- jQuery -->
<script src="<?= base_url(); ?>/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="<?= base_url(); ?>/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="<?= base_url(); ?>/dist/js/adminlte.min.js"></script>
</body>
</html>
