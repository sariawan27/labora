<?php
$uri = service('uri');
$segment = $uri->getSegment(2);
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Labora | Pendaftaran</title>
  <link rel="icon" type="image/x-icon" href="https://media-public.canva.com/Yu9FE/MAFmV5Yu9FE/1/t.png">

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?= base_url(); ?>/plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bootstrap 4 -->
  <link rel="stylesheet" href="<?= base_url(); ?>/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="<?= base_url(); ?>/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- JQVMap -->
  <link rel="stylesheet" href="<?= base_url(); ?>/plugins/jqvmap/jqvmap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?= base_url(); ?>/dist/css/adminlte.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="<?= base_url(); ?>/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="<?= base_url(); ?>/plugins/daterangepicker/daterangepicker.css">
  <!-- summernote -->
  <link rel="stylesheet" href="<?= base_url(); ?>/plugins/summernote/summernote-bs4.min.css">
</head>

<body class="hold-transition sidebar-mini layout-fixed">
  <div class="wrapper">

    <!-- Preloader -->

    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
      <!-- Left navbar links -->
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
          <a href="/pendaftaran/dashboard" class="nav-link">Home</a>
        </li>
      </ul>

      <!-- Right navbar links -->
      <ul class="navbar-nav ml-auto">
        <!-- Navbar Search -->
        <!-- <li class="nav-item">
          <a class="nav-link" data-widget="navbar-search" href="#" role="button">
            <i class="fas fa-search"></i>
          </a>
          <div class="navbar-search-block">
            <form class="form-inline">
              <div class="input-group input-group-sm">
                <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
                <div class="input-group-append">
                  <button class="btn btn-navbar" type="submit">
                    <i class="fas fa-search"></i>
                  </button>
                  <button class="btn btn-navbar" type="button" data-widget="navbar-search">
                    <i class="fas fa-times"></i>
                  </button>
                </div>
              </div>
            </form>
          </div>
        </li> -->

        <!-- Notifications Dropdown Menu -->
        <li class="nav-item dropdown">
          <a class="nav-link" data-toggle="dropdown" href="#">
            <i class="far fa-bell"></i>
            <span class="badge badge-warning navbar-badge" id="notif-icon-total">0</span>
          </a>
          <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
            <span class="dropdown-item dropdown-header" id="notif-header">0 Notifications</span>
            <div class="dropdown-divider"></div>
            <div id="item-notif">
              <div class="dropdown-divider"></div>
              <a href="#" class="dropdown-item">
                <i class="fas fa-users mr-2"></i> 8 friend requests
                <span class="float-right text-muted text-sm">12 hours</span>
              </a>
              <div class="dropdown-divider"></div>
              <a href="#" class="dropdown-item">
                <i class="fas fa-file mr-2"></i> 3 new reports
                <span class="float-right text-muted text-sm">2 days</span>
              </a>
            </div>
            <div class="dropdown-divider"></div>
            <a href="<?= base_url('pendaftaran/pendaftar') ?>" class="dropdown-item dropdown-footer">See All Notifications</a>
          </div>
        </li>
      </ul>
    </nav>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
      <!-- Brand Logo -->
      <a href="index3.html" class="brand-link">
        <img src="https://media-public.canva.com/Yu9FE/MAFmV5Yu9FE/1/t.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">LABORA</span>
      </a>

      <!-- Sidebar -->
      <div class="sidebar">
        <!-- Sidebar user panel (optional) -->

        <!-- Sidebar Menu -->
        <nav class="mt-3">
          <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
            <li class="nav-item">
              <a href="<?= base_url('pendaftaran') ?>" class="nav-link <?= $segment == '' ? 'active' : '' ?>">
                <i class="nav-icon fas fa-home"></i>
                <p>
                  Dashboard
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="<?= base_url('pendaftaran/registrasi') ?>" class="nav-link <?= $segment == 'registrasi' ? 'active' : '' ?>">
                <i class="nav-icon fas fa-pencil-alt"></i>
                <p>
                  Registrasi
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="<?= base_url('pendaftaran/jenis-pemeriksaan') ?>" class="nav-link <?= $segment == 'jenis-pemeriksaan' || $segment == 'sub-jenis-pemeriksaan' ? 'active' : '' ?>">
                <i class="nav-icon fas fa-stethoscope"></i>
                <p>
                  Jenis Pemeriksaan
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="<?= base_url('pendaftaran/pendaftar') ?>" class="nav-link <?= $segment == 'pendaftar' ? 'active' : '' ?>">
                <i class="nav-icon fas fa-id-card"></i>
                <p>
                  Data Pendaftar
                </p>
              </a>
            </li>
          </ul>
        </nav>
        <nav class="mb-5" style="position: absolute; bottom:0;">
          <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
            <!-- <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="nav-icon fas fa-tachometer-alt"></i>
                <p>
                  Settings
                </p>
              </a>
            </li> -->
            <li class="nav-item">
              <a href="<?= base_url('process-logout') ?>/<?= $uri->getSegment(1) ?>" class="nav-link">
                <i class="nav-icon fas fa-door-open"></i>
                <p>
                  Logout
                </p>
              </a>
            </li>
            <!-- <li class="nav-item mt-3">
              <a href="#" class="nav-link">
                <i class="nav-icon fas fa-tachometer-alt"></i>
                <p>
                  Help!
                </p>
              </a>
            </li> -->
          </ul>
        </nav>
        <!-- /.sidebar-menu -->
      </div>

    </aside>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <div class="content-header">
        <!-- <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Dashboard</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Dashboard v1</li>
            </ol>
          </div>
        </div>
      </div> -->
      </div>
      <!-- /.content-header -->

      <!-- Main content -->
      <section class="content">
        <div class="container-fluid">
          <!-- Small boxes (Stat box) -->
          <?= $this->renderSection('content') ?>
        </div><!-- /.container-fluid -->
      </section>
      <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
    <footer class="main-footer">
      <strong>Copyright &copy; <span id="year"></span>. All rights reserved.
        <div class="float-right d-none d-sm-inline-block">
          <b>V.1.0</b>
        </div>
    </footer>

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
      <!-- Control sidebar content goes here -->
    </aside>
    <!-- /.control-sidebar -->
  </div>
  <!-- ./wrapper -->

  <script>
    document.getElementById("year").innerHTML = new Date().getFullYear();
  </script>

  <!-- jQuery -->
  <script src="<?= base_url(); ?>/plugins/jquery/jquery.min.js"></script>
  <!-- jQuery UI 1.11.4 -->
  <script src="<?= base_url(); ?>/plugins/jquery-ui/jquery-ui.min.js"></script>
  <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
  <script>
    $.widget.bridge('uibutton', $.ui.button)
  </script>
  <!-- Bootstrap 4 -->
  <script src="<?= base_url(); ?>/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- ChartJS -->
  <script src="<?= base_url(); ?>/plugins/chart.js/Chart.min.js"></script>
  <!-- Sparkline -->
  <script src="<?= base_url(); ?>/plugins/sparklines/sparkline.js"></script>
  <!-- JQVMap -->
  <script src="<?= base_url(); ?>/plugins/jqvmap/jquery.vmap.min.js"></script>
  <script src="<?= base_url(); ?>/plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
  <!-- jQuery Knob Chart -->
  <script src="<?= base_url(); ?>/plugins/jquery-knob/jquery.knob.min.js"></script>
  <!-- daterangepicker -->
  <script src="<?= base_url(); ?>/plugins/moment/moment.min.js"></script>
  <script src="<?= base_url(); ?>/plugins/daterangepicker/daterangepicker.js"></script>
  <!-- Tempusdominus Bootstrap 4 -->
  <script src="<?= base_url(); ?>/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
  <!-- Summernote -->
  <script src="<?= base_url(); ?>/plugins/summernote/summernote-bs4.min.js"></script>
  <!-- overlayScrollbars -->
  <script src="<?= base_url(); ?>/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
  <!-- AdminLTE App -->
  <script src="<?= base_url(); ?>/dist/js/adminlte.js"></script>
  <!-- AdminLTE for demo purposes -->
  <script src="<?= base_url(); ?>/dist/js/demo.js"></script>
  <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
  <script src="<?= base_url(); ?>/dist/js/pages/dashboard.js"></script>

  <!-- DataTables  & Plugins -->
  <script src="<?= base_url(); ?>/plugins/datatables/jquery.dataTables.min.js"></script>
  <script src="<?= base_url(); ?>/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
  <script src="<?= base_url(); ?>/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
  <script src="<?= base_url(); ?>/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
  <script src="<?= base_url(); ?>/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
  <script src="<?= base_url(); ?>/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
  <script src="<?= base_url(); ?>/plugins/jszip/jszip.min.js"></script>
  <script src="<?= base_url(); ?>/plugins/pdfmake/pdfmake.min.js"></script>
  <script src="<?= base_url(); ?>/plugins/pdfmake/vfs_fonts.js"></script>
  <script src="<?= base_url(); ?>/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
  <script src="<?= base_url(); ?>/plugins/datatables-buttons/js/buttons.print.min.js"></script>
  <script src="<?= base_url(); ?>/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
  <!-- script tambahan -->
  <script>
    $.ajax({
      url: "<?php echo base_url('notification') ?>",
      type: 'GET',
      success: function(response) {
        console.log(JSON.parse(response)?.unreadNotif)
        $('#notif-icon-total').text(JSON.parse(response)?.unreadNotif?.length ? JSON.parse(response)?.unreadNotif?.length : 0)
        $('#notif-header').text(JSON.parse(response)?.unreadNotif?.length ? (JSON.parse(response)?.unreadNotif?.length + " Notifications") : (0 + " Notifications"))
        var html = ``
        JSON.parse(response)?.unreadNotif.forEach(element => {
          html += `
        <a href="#" class="dropdown-item">
                ${element?.nomorRekamMedis}
              </a>`
        });
        $('#item-notif').html(html)
        if (response.error) {
          return Swal.fire({
            icon: 'error',
            title: "Oops..",
            text: response?.message ?? "Something went wrong!"
          })
        }
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
  </script>
</body>

</html>