<?php
$uri = service('uri');
$segment = $uri->getSegment(2);
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Labora | Sign In</title>
  <link rel="icon" type="image/x-icon" href="https://media-public.canva.com/Yu9FE/MAFmV5Yu9FE/1/t.png">

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

    textarea:focus,
    input[type="text"]:focus,
    input[type="password"]:focus,
    input[type="datetime"]:focus,
    input[type="datetime-local"]:focus,
    input[type="date"]:focus,
    input[type="month"]:focus,
    input[type="time"]:focus,
    input[type="week"]:focus,
    input[type="number"]:focus,
    input[type="email"]:focus,
    input[type="url"]:focus,
    input[type="search"]:focus,
    input[type="tel"]:focus,
    input[type="color"]:focus,
    .uneditable-input:focus {
      border-color: rgb(255, 207, 36);
      box-shadow: 0 1px 1px rgba(0, 0, 0, 0.075) inset, 0 0 8px rgba(126, 239, 104, 0.6);
      outline: 0 none;
      background-color: rgba(255, 207, 36, 0.75);
    }

    input[type="text"],
    input[type="password"] {
      border-color: rgb(255, 207, 36);
      box-shadow: 0 1px 1px rgba(0, 0, 0, 0.075) inset, 0 0 8px rgba(126, 239, 104, 0.6);
      outline: 0 none;
      background-color: rgb(255, 207, 36);
    }

    .input-login {
      text-align: center;
      font-size: 20px;
      height: calc(2.25rem + 12px);
    }
  </style>
</head>

<body class="hold-transition" style="height:unset !important; background: url('<?= base_url() ?>/dist/img/lab-bg.webp'); background-size: cover; background-repeat: no-repeat; ">

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
          <div>
            <h4 class="weight-text">LOGIN <?= strtoupper($segment) ?></h4>
          </div>
          <form action="<?= base_url('login/process-login/' . $segment) ?>" method="post">
            <div class="form-group" style="width: 350px;">
              <input type="text" name="username" class="form-control input-login" placeholder="Username" id="exampleInputEmail1" aria-describedby="emailHelp">
            </div>
            <div class="form-group">
              <input type="password" name="password" class="form-control input-login" placeholder="Password" id="exampleInputPassword1">
            </div>
            <button type="submit" class="btn" style="width: 350px; background-color: rgba(233, 151, 222)">Submit</button>
            <div class="form-group">
              <button type="button" class="btn" style="width: 350px; background-color: #e6eaee; margin-top:0.3rem" onclick="return location.href='<?= base_url(); ?>landing'">Kembali</button>
            </div>
          </form>
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