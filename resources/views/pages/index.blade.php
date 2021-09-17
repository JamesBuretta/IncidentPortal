@extends('main_frame')

@if(Route::is('dashboard'))
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
@endif

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

            <div class="col-lg-3 col-3 connectedSortable">
                <!-- small box -->
                <div class="small-box bg-yellow">
                    <div class="inner">
                        <h3>{{$inprogress}}</h3>

                        <p>Awaiting Approval</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-bag"></i>
                    </div>
                    <a href="{{route('view_incidents')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>

            <div class="col-lg-3 col-3 connectedSortable">
                <!-- small box -->
                <div class="small-box bg-success">
                    <div class="inner">
                        <h3>{{$closed}}</h3>

                        <p>Closed</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-bag"></i>
                    </div>
                    <a href="{{route('view_incidents')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-3 connectedSortable">
                <!-- small box -->
                <div class="small-box bg-danger">
                    <div class="inner">
                        <h3>{{$cancelled}}</h3>

                        <p>Cancelled</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-bag"></i>
                    </div>
                    <a href="{{route('view_incidents')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>

            <div class="col-md-3 col-6">
                <!-- small box -->
                <div class="small-box bg-primary">
                    <div class="inner">
                        <h3>{{$assigned}}</h3>

                        <p>Approved</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-stats-bars"></i>
                    </div>
                    <a href="{{ url('profile') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>


        </div>
        <!-- /.row -->
        @can('admin-access')
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        Recent Payment's History
                    </div>
                    <div class="card-body">
                        <div style="height: 350px !important;" class="graph-container graph-container-bar">
                            <canvas id="myChartBar"></canvas>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        @endcan


        <div class="row">
            <div class="col-md-6">
            <div id="donutchart" style="width: 100%; height: 500px;"></div>


                <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
                <script type="text/javascript">
                    // Load the Visualization API and the corechart package.
                    google.charts.load('current', {
                        'packages': ['corechart', 'bar']
                    });

                    // Set a callback to run when the Google Visualization API is loaded.
                    google.charts.setOnLoadCallback(drawChart);

                    // Callback that creates and populates a data table,
                    // instantiates the pie chart, passes in the data and
                    // draws it.
                    function drawChart() {
                        var sum = {{ $inprogress }} + {{ $closed }} + {{ $assigned }} + {{ $cancelled }};
                        // Create the data table.
                        var data = new google.visualization.DataTable();
                        data.addColumn('string', 'Topping');
                        data.addColumn('number', 'Slices');
                        data.addRows([
                            ['Inprogress', {{ $inprogress }}],
                            ['Closed', {{ $closed }}],
                            ['Assigned', {{ $assigned }}],
                            ['Canceled', {{ $cancelled }}]
                        ]);

                        // Set chart options
                        var options = {
                            'title': sum+ ' Total Incidents Plotted By Status',
                            'pieHole': 0.4,
                            'backgroundColor': 'transparent'
                        };

                        // Instantiate and draw our chart, passing in some options.
                        var chart = new google.visualization.PieChart(document.getElementById('donutchart'));
                        chart.draw(data, options);
                        drawChart2();
                    }

                    function drawChart2() {
                        var dataset = <?php echo $incidents_total_daily; ?>;
                        console.log(dataset);
                        var data = google.visualization.arrayToDataTable(dataset);


                        var options = {
                        chart: {
                            title: 'Incidents Perfomance',
                            subtitle: 'Incidents of the past seven days.',

                        },
                        'backgroundColor': 'transparent',
                        };

                        var chart = new google.charts.Bar(document.getElementById('columnchart_material'));

                        chart.draw(data, google.charts.Bar.convertOptions(options));
                    }
                </script>
            </div>
            <div class="col-md-6">
            <div id="columnchart_material" style="width: 100%; height: 500px;"></div>
            </div>
        </div>

        <!-- /.row (main row) -->
    </div><!-- /.container-fluid -->
</section>
@endsection

@section('page-script')

@endsection
