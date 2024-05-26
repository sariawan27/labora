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
            <div class="row" style="height: 60%;">
                <div class="col-4 d-flex justify-content-center h-100">
                    <div class="row align-items-center h-100">
                        <div class="col-12 mx-auto text-center">
                            <img src="https://media-private.canva.com/QZmnM/MAFGS0QZmnM/1/s.png?X-Amz-Algorithm=AWS4-HMAC-SHA256&X-Amz-Credential=AKIAJWF6QO3UH4PAAJ6Q%2F20240523%2Fus-east-1%2Fs3%2Faws4_request&X-Amz-Date=20240523T201540Z&X-Amz-Expires=77033&X-Amz-Signature=9bfc67bc1def6b900bc78ae0ef7b9dac40944b9b5df01344540ec332e2b8b4cf&X-Amz-SignedHeaders=host%3Bx-amz-expected-bucket-owner&response-expires=Fri%2C%2024%20May%202024%2017%3A39%3A33%20GMT" style="
                            max-width:550px;
                            max-height:180px;
                            width: auto;
                            height: auto;" alt="">
                            <div class="mt-4">
                                <h4 class="weight-text">Buat janji dan lihat riwayat kesehatan dalam satu Web</h4>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-4 d-flex justify-content-center h-100">
                    <div class="row align-items-center h-100">
                        <div class="col-12 mx-auto text-center">
                            <img src="https://media-public.canva.com/yCl7M/MAF0DqyCl7M/1/t.png" style="
                            max-width:550px;
                            max-height:180px;
                            width: auto;
                            height: auto;" alt="">
                            <div class="mt-4">
                                <h4 class="weight-text">Penting memahami dosis obat yang dikonsumsi</h4>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-4 d-flex justify-content-center h-100">
                    <div class="row align-items-center h-100">
                        <div class="col-12 mx-auto text-center">
                            <img src="https://media-public.canva.com/4wiBU/MAFJvR4wiBU/1/s.png" style="
                            max-width:550px;
                            max-height:180px;
                            width: auto;
                            height: auto;" alt="">
                            <div class="mt-4">
                                <h4 class="weight-text">Dapatkan hasil tes kamu di web ini.</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row d-flex justify-content-center" style="height: 20%;">
                <a href="<?= base_url() ?>landing" style="color: black;">
                    <h3 class="weight-text">Masuk <i class="fas fa-arrow-circle-right"></i></h3>
                </a>
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