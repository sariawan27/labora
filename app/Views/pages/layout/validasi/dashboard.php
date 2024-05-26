<?php $this->extend('layouts/validasi'); ?>

<?php $this->section('content') ?>
<div class="row">
    <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-info">
            <div class="inner">
                <h3><?= esc($pasienCount) ?></h3>

                <p>Pasien</p>
            </div>
            <div class="icon">
                <i class="ion ion-android-people"></i>
            </div>
            <a href="<?= base_url('admin/pendaftar') ?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-warning">
            <div class="inner">
                <h3><?= esc($atlmCount) ?></h3>

                <p>Dokter</p>
            </div>
            <div class="icon">
                <i class="ion ion-ios-person"></i>
            </div>
            <a href="<?= base_url('admin/users') ?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-success">
            <div class="inner">
                <h3><?= esc($itemPemeriksaanCount) ?></h3>

                <p>Grup Pemeriksaan</p>
            </div>
            <div class="icon">
                <i class="ion ion-clipboard"></i>
            </div>
            <a href="<?= base_url('admin/item-pemeriksaan') ?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-danger">
            <div class="inner">
                <h3><?= esc($subItemPemeriksaanCount) ?></h3>

                <p>Jenis Pemeriksaan</p>
            </div>
            <div class="icon">
                <i class="ion ion-ios-pulse-strong"></i>
            </div>
            <a href="<?= base_url('admin/item-pemeriksaan') ?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="fas fa-signal mr-1"></i>
                    Statistik Pasien
                </h3>
            </div><!-- /.card-header -->
            <div class="card-body">
                <div class="tab-content p-0">
                    <!-- Morris chart - Sales -->
                    <div class="chart tab-pane active" id="revenue-chart" style="position: relative; height: 300px;">
                        <canvas id="revenue-chart-canvas" height="300" style="height: 300px;"></canvas>
                    </div>
                    <div class="chart tab-pane" id="sales-chart" style="position: relative; height: 300px;">
                        <canvas id="sales-chart-canvas" height="300" style="height: 300px;"></canvas>
                    </div>
                </div>
            </div><!-- /.card-body -->
        </div>
    </div>
</div>
<!-- ChartJS -->
<script src="<?= base_url(); ?>/plugins/chart.js/Chart.min.js"></script>
<script>
    /* Chart.js Charts */
    // Sales chart
    var salesChartCanvas = document.getElementById('revenue-chart-canvas').getContext('2d')
    // $('#revenue-chart').get(0).getContext('2d');

    var salesChartData = {
        labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July'],
        datasets: [{
            label: 'Jumlah Pasien Perbulan',
            borderColor: 'rgba(60,141,188,0.8)',
            backgroundColor: 'rgba(60,141,188,0.9)',
            borderWidth: 2,
            borderRadius: 5,
            borderSkipped: false,
            data: JSON.parse("<?= esc($arrPasienPerbulan) ?>")
        }, ]
    }

    var salesChartOptions = {
        maintainAspectRatio: false,
        responsive: true,
        legend: {
            display: false
        },
        scales: {
            xAxes: [{
                gridLines: {
                    display: false
                }
            }],
            yAxes: [{
                gridLines: {
                    display: false
                }
            }]
        }
    }

    // This will get the first returned node in the jQuery collection.
    // eslint-disable-next-line no-unused-vars
    var salesChart = new Chart(salesChartCanvas, { // lgtm[js/unused-local-variable]
        type: 'bar',
        data: salesChartData,
        options: salesChartOptions
    })
</script>
<?php $this->endSection(); ?>