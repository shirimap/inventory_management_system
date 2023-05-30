@include('includes/header')
@include('includes/nav')
@include('sweetalert::alert')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">dashboard</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Dashboard</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <!-- Small boxes (Stat box) -->
            <div class="row">
                <div class="col-12 col-sm-6 col-md-3">
                    <div class="info-box bg-dark">
                        <span class="info-box-icon bg-info elevation-1"><i class="fas fa-users"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">Users</span>
                            <span class="info-box-number">
                                <h4> {{ $user->count() }}</h4>
                                <small class="pull-right"><a href="#" class="small-box-footer">More info <i
                                            class="fas fa-arrow-circle-right"></i></a></small>
                            </span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>
                <div class="col-12 col-sm-6 col-md-3">
                    <div class="info-box bg-dark">
                        <span class="info-box-icon bg-secondary elevation-1"><i class="fas fa-users"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">Products</span>
                            <span class="info-box-number">
                                <h4> {{ $product->count() }}</h4>
                                <small class="pull-right"><a href="#" class="small-box-footer">More info <i
                                            class="fas fa-arrow-circle-right"></i></a></small>
                            </span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>
                

                <div class="col-12 col-sm-6 col-md-3">
                    <div class="info-box bg-dark">
                        <span class="info-box-icon bg-primary elevation-1"> <i class="fas fa-shopping-cart"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">Total Sales</span>
                            <span class="info-box-number">
                                <h4>{{ number_format($sell,2) }}<sup style="font-size: 12px"> TZS</sup></h4>
                                <small class="pull-right"><a href="#" class="small-box-footer">More info <i
                                            class="fas fa-arrow-circle-right"></i></a></small>
                            </span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>

                <div class="col-12 col-sm-6 col-md-3">
                    <div class="info-box bg-dark">
                        <span class="info-box-icon bg-danger elevation-1"> <i class="fas fa-shopping-cart"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">Stock</span>
                            <span class="info-box-number">
                                <h4>{{ number_format($capital,2) }}<sup style="font-size: 12px"> TZS</sup></h4>
                                <small class="pull-right"><a href="#" class="small-box-footer">More info <i
                                            class="fas fa-arrow-circle-right"></i></a></small>
                            </span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>
                <div class="col-12 col-sm-6 col-md-3">
                    <div class="info-box bg-dark">
                        <span class="info-box-icon bg-danger elevation-1"> <i class="fas fa-shopping-cart"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">Total Profit</span>
                            <span class="info-box-number">
                            <h4>{{ number_format($pprofit,2) }}<sup style="font-size: 12px"> TZS</sup></h4>
                                <small class="pull-right"><a href="#" class="small-box-footer">More info <i
                                            class="fas fa-arrow-circle-right"></i></a></small>
                            </span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>
              
                <div class="col-12 col-sm-6 col-md-3">
                    <div class="info-box bg-dark">
                        <span class="info-box-icon bg-info elevation-1"> <i class="fas fa-plus-circle"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">Todays Sales</span>
                            <span class="info-box-number">
                                <h4>{{ number_format($todaysales,2) }} <sup style="font-size: 12px"> TZS</sup></h4>
                                <small class="pull-right"><a href="{{ route('mauzomuuzaji') }}" class="small-box-footer">More info <i
                                            class="fas fa-arrow-circle-right"></i></a></small>
                            </span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>
                <div class="col-12 col-sm-6 col-md-3">
                    <div class="info-box bg-dark">
                        <span class="info-box-icon bg-info elevation-1"> <i class="fas fa-plus-circle"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">Todayas Profit</span>
                            <span class="info-box-number">
                                <h4>{{ number_format($faida)}} <sup style="font-size: 12px"> TZS</sup></h4>
                                <small class="pull-right"><a href="#" class="small-box-footer">More info <i
                                            class="fas fa-arrow-circle-right"></i></a></small>
                            </span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>
                <div class="col-12 col-sm-6 col-md-3">
                    <div class="info-box bg-dark">
                        <span class="info-box-icon bg-danger elevation-1"> <i class="fas fa-minus-circle"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">Debits</span>
                            <span class="info-box-number">
                                <h4>{{ number_format($madeni)}} <sup style="font-size: 12px"> TZS</sup></h4>
                                <small class="pull-right"><a href="{{ route('madeni') }}" class="small-box-footer">More info <i
                                            class="fas fa-arrow-circle-right"></i></a></small>
                            </span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <!-- AREA CHART -->
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Graph Ya Mauzo</h3>

                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                                <button type="button" class="btn btn-tool" data-card-widget="remove">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="chart">
                                <canvas id="areaChart"
                                    style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                            </div>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->


                </div>
                <!-- /.col (LEFT) -->
                <div class="col-md-6">
                    <!-- BAR CHART -->
                    <div class="card card-success">
                        <div class="card-header">
                            <h3 class="card-title">Graph Ya Mauzo</h3>

                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                                <button type="button" class="btn btn-tool" data-card-widget="remove">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="chart">
                                <canvas id="barChart"
                                    style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                            </div>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                    <!-- Profile Image -->
                    

                </div>
                <!-- /.col (RIGHT) -->
            </div>
            <!-- /.row -->

        </div>
        <!-- /.col -->


</section>
<!-- /.content -->
</section>


</div>
<!-- /.content-wrapper -->
<script>
$(function() {
    /* ChartJS
     * -------
     * Here we will create a few charts using ChartJS
     */

    //--------------
    //- AREA CHART -
    //--------------

    // Get context with jQuery - using jQuery's .get() method.
    var areaChartCanvas = $('#areaChart').get(0).getContext('2d')

    var areaChartData = {
        labels: <?php echo json_encode($labels)?>,
        datasets: [{
                label: 'Mauzo',
                backgroundColor: 'rgba(60,141,188,0.9)',
                borderColor: 'rgba(60,141,188,0.8)',
                pointRadius: false,
                pointColor: '#3b8bba',
                pointStrokeColor: 'rgba(60,141,188,1)',
                pointHighlightFill: '#fff',
                pointHighlightStroke: 'rgba(60,141,188,1)',
                data: <?php echo json_encode($amounts)?>
            },
            {}
        ]
    }

    var areaChartOptions = {
        maintainAspectRatio: false,
        responsive: true,
        legend: {
            display: false
        },
        scales: {
            xAxes: [{
                gridLines: {
                    display: false,
                }
            }],
            yAxes: [{
                gridLines: {
                    display: false,
                }
            }]
        }
    }

    // This will get the first returned node in the jQuery collection.
    new Chart(areaChartCanvas, {
        type: 'line',
        data: areaChartData,
        options: areaChartOptions
    })




    //-------------
    //- BAR CHART -
    //-------------
    var barChartCanvas = $('#barChart').get(0).getContext('2d')
    var barChartData = $.extend(true, {}, areaChartData)
    var temp0 = areaChartData.datasets[0]
    var temp1 = areaChartData.datasets[1]
    barChartData.datasets[0] = temp1
    barChartData.datasets[1] = temp0

    var barChartOptions = {
        responsive: true,
        maintainAspectRatio: false,
        datasetFill: false
    }

    new Chart(barChartCanvas, {
        type: 'bar',
        data: barChartData,
        options: barChartOptions
    })


})
</script>
@include('includes/footer')