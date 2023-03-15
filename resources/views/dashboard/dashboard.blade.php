@extends('layouts.dashboard.master')

@section('title', 'Ecommerce | Dashboard')
@section('style')
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Tempusdominus Bootstrap 4 -->
    <link rel="stylesheet" href="plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
    <!-- iCheck -->
    <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- JQVMap -->
    <link rel="stylesheet" href="plugins/jqvmap/jqvmap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="dist/css/adminlte.min.css">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="plugins/daterangepicker/daterangepicker.css">
    <!-- summernote -->
    <link rel="stylesheet" href="plugins/summernote/summernote-bs4.min.css">


@endsection


@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper" style="height:auto;">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Dashboard</h1>
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
                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-info">
                            <div class="inner">
                                <h3>{{ $totalnewOrders }}</h3>

                                <p>New Orders</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-bag"></i>
                            </div>
                            <a href="/admin/orders" class="small-box-footer">More info <i
                                    class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <!-- ./col -->
                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-success">
                            <div class="inner">
                                <h3>{{ $totalProducts }}<sup style="font-size: 20px"></sup></h3>

                                <p>Products Details</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-android-document"></i>
                            </div>
                            <a href="{{ route('product.index') }}" class="small-box-footer">More info <i
                                    class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <!-- ./col -->
                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-warning">
                            <div class="inner">
                                <h3>{{ $totalRegisteredUsers }}</h3>

                                <p>User Registrations</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-person-add"></i>
                            </div>
                            <a href="/admin/users" class="small-box-footer">More info <i
                                    class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <!-- ./col -->
                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-danger">
                            <div class="inner">
                                <h3>{{ $totalCategories }}</h3>

                                <p>Categories Details</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-ios-albums-outline"></i>
                            </div>
                            <a href="{{ route('category.index') }}" class="small-box-footer">More info <i
                                    class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <!-- ./col -->
                </div>
                <div class="row">
                    <div class="col-lg-3 col-6">

                        <div class="small-box bg-danger">
                            <div class="inner">
                                <h3> Rs {{ number_format($totalRevenue, 2) }}</h3>

                                <p>Total Earning</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-cash"></i>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.row -->
                <!-- Main row -->
                <div class="row">
                    <!-- Left col -->
                    <section class="col-lg-7 connectedSortable">
                        <!-- Bar chart -->
                        <div class="card card-primary card-outline">
                            <div class="card-header">
                                <h3 class="card-title">
                                    <i class="far fa-chart-bar"></i>
                                    Bar Chart
                                </h3>

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
                                <div id="chart" style="width: 79%; height: 500px;"></div>
                            </div>
                            <!-- /.card-body-->
                        </div>
                        <!-- /.card -->
                    </section>
                    <!-- right col -->
                    <section class="col-lg-5 connectedSortable">
                        <div class="card card-primary card-outline">
                            <div class="card-header">
                                <h3>Sales Details</h3>
                            </div>
                            <table class="table border">
                                <thead>
                                    <tr>
                                        <th>Date</th>
                                        <th>Total Sales</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($totalSalesPerMonth as $sale)
                                        <tr>
                                            <td>{{ date('F', mktime(0, 0, 0, $sale->delivery_month, 1)) }}</td>
                                            <td>Rs {{ number_format($sale->total_sales, 2) }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>

                        </div>
                        <!-- /.row (main row) -->
                </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-header -->
    </div>
@endsection
@section('script')
    <script src="https://cdn.jsdelivr.net/npm/echarts@5.2.2/dist/echarts.min.js"></script>

    <script type="text/javascript">
        // Initialize ECharts instance
        var chart = echarts.init(document.getElementById('chart'));
        // Specify chart configuration and data
        var option = {
            title: {
                text: 'Total Sales per Month in Rs'
            },
            tooltip: {},
            xAxis: {
                data: {!! json_encode($months) !!}
            },
            yAxis: {},
            series: [{
                name: 'Sales',
                type: 'bar',
                data: {!! json_encode($sales) !!}
            }]
        };

        // Use configuration item and data specified to show chart
        chart.setOption(option);
    </script>
    <!-- jQuery -->
    <script src="plugins/jquery/jquery.min.js"></script>
    <!-- jQuery UI 1.11.4 -->
    <script src="plugins/jquery-ui/jquery-ui.min.js"></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script>
        $.widget.bridge('uibutton', $.ui.button)
    </script>
    <!-- Bootstrap 4 -->
    <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- Sparkline -->
    <script src="plugins/sparklines/sparkline.js"></script>
    <!-- JQVMap -->
    <script src="plugins/jqvmap/jquery.vmap.min.js"></script>
    <script src="plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
    <!-- daterangepicker -->
    <script src="plugins/moment/moment.min.js"></script>
    <script src="plugins/daterangepicker/daterangepicker.js"></script>
    <!-- Tempusdominus Bootstrap 4 -->
    <script src="plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
    <!-- Summernote -->
    <script src="plugins/summernote/summernote-bs4.min.js"></script>
    <!-- overlayScrollbars -->
    <script src="plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
    <!-- AdminLTE App -->
    <script src="dist/js/adminlte.js"></script>
@endsection
