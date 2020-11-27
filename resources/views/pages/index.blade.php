@extends('main_frame')

@section('top-details')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Dashboard</h1>
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
@endsection

@section('main-content')
    <section class="content">
        <div class="container-fluid">
            <!-- Small boxes (Stat box) -->
            <div class="row">
                <div class="col-lg-3 col-6 connectedSortable">
                    <!-- small box -->
                    <div class="small-box bg-info">
                        <div class="inner">
                            <h3>{{$total_users}}</h3>

                            <p>System Users</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-bag"></i>
                        </div>
                        <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-success">
                        <div class="inner">
                            <h3>{{$total_municipals}}</h3>

                            <p>Total Municipals</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-stats-bars"></i>
                        </div>
                        <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-warning">
                        <div class="inner">
                            <h3>{{$my_business}}</h3>

                            <p>My Business</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-person-add"></i>
                        </div>
                        <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-danger">
                        <div class="inner">
                            <h3>{{$my_payments}}</h3>

                            <p>Payment's</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-pie-graph"></i>
                        </div>
                        <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
            </div>
            <!-- /.row -->
            <!-- Main row -->
            <div class="row">
{{--                <div class="col-md-6">--}}
{{--                    <div class="card">--}}
{{--                        <div class="card-header border-0">--}}
{{--                            <div class="d-flex justify-content-between">--}}
{{--                                <h3 class="card-title">Online Store Visitors</h3>--}}
{{--                                <a href="javascript:void(0);">View Report</a>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <div class="card-body">--}}
{{--                            <div class="d-flex">--}}
{{--                                <p class="d-flex flex-column">--}}
{{--                                    <span class="text-bold text-lg">820</span>--}}
{{--                                    <span>Visitors Over Time</span>--}}
{{--                                </p>--}}
{{--                                <p class="ml-auto d-flex flex-column text-right">--}}
{{--                                        <span class="text-success">--}}
{{--                                          <i class="fas fa-arrow-up"></i> 12.5%--}}
{{--                                        </span>--}}
{{--                                    <span class="text-muted">Since last week</span>--}}
{{--                                </p>--}}
{{--                            </div>--}}
{{--                            <!-- /.d-flex -->--}}

{{--                            <div class="position-relative mb-4">--}}
{{--                                <canvas id="visitors-chart" height="200"></canvas>--}}
{{--                            </div>--}}

{{--                            <div class="d-flex flex-row justify-content-end">--}}
{{--                                      <span class="mr-2">--}}
{{--                                        <i class="fas fa-square text-primary"></i> This Week--}}
{{--                                      </span>--}}

{{--                                <span>--}}
{{--                                        <i class="fas fa-square text-gray"></i> Last Week--}}
{{--                                      </span>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <!-- /.card -->--}}
{{--                </div>--}}
{{--                <!-- /.col-md-6 -->--}}
{{--                <div class="col-md-6">--}}
{{--                    <div class="card">--}}
{{--                        <div class="card-header border-0">--}}
{{--                            <div class="d-flex justify-content-between">--}}
{{--                                <h3 class="card-title">Sales</h3>--}}
{{--                                <a href="javascript:void(0);">View Report</a>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <div class="card-body">--}}
{{--                            <div class="d-flex">--}}
{{--                                <p class="d-flex flex-column">--}}
{{--                                    <span class="text-bold text-lg">$18,230.00</span>--}}
{{--                                    <span>Sales Over Time</span>--}}
{{--                                </p>--}}
{{--                                <p class="ml-auto d-flex flex-column text-right">--}}
{{--                    <span class="text-success">--}}
{{--                      <i class="fas fa-arrow-up"></i> 33.1%--}}
{{--                    </span>--}}
{{--                                    <span class="text-muted">Since last month</span>--}}
{{--                                </p>--}}
{{--                            </div>--}}
{{--                            <!-- /.d-flex -->--}}

{{--                            <div class="position-relative mb-4">--}}
{{--                                <canvas id="sales-chart" height="200"></canvas>--}}
{{--                            </div>--}}

{{--                            <div class="d-flex flex-row justify-content-end">--}}
{{--                  <span class="mr-2">--}}
{{--                    <i class="fas fa-square text-primary"></i> This year--}}
{{--                  </span>--}}

{{--                                <span>--}}
{{--                    <i class="fas fa-square text-gray"></i> Last year--}}
{{--                  </span>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <!-- /.card -->--}}
{{--                </div>--}}
{{--                <!-- /.col-md-6 -->--}}
            </div>
            <!-- /.row (main row) -->
        </div><!-- /.container-fluid -->
    </section>
@endsection
