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
                @can('admin-access')
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
                        <a href="{{route('view-users')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-md-3 col-6">
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
               @endcan
                <!-- ./col -->
                <div class="{{ \Illuminate\Support\Facades\Gate::check('admin-access') ? 'col-md-3' : 'col-md-6' }} col-6">
                    <!-- small box -->
                    <div class="small-box bg-warning">
                        <div class="inner">
                            <h3>{{$my_business}}</h3>

                            <p>My Business</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-person-add"></i>
                        </div>
                        <a href="{{route('my-profile')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
                <div class="{{ \Illuminate\Support\Facades\Gate::check('admin-access') ? 'col-md-3' : 'col-md-6' }}  col-6">
                    <!-- small box -->
                    <div class="small-box bg-danger">
                        <div class="inner">
                            <h3>{{$my_payments}}</h3>

                            <p>Payment's</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-pie-graph"></i>
                        </div>
                        <a href="{{route('payments_info')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
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
                                <canvas  id="myChartBar"></canvas>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            @endcan

            <div class="row">

                <div class="col">

                    <div class="header">
                        Services
                    </div>

                    <ul class="list-group">
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            Business Registration
                            <span class="badge badge-primary badge-pill"><i class="fas fa-fax"></i></span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            PRN Request
                            <span class="badge badge-primary badge-pill"><i class="fas fa-file-contract"></i></span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            Licence Payment
                            <span class="badge badge-primary badge-pill"><i class="fas fa-mobile"></i></span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            Licence Renewal
                            <span class="badge badge-primary badge-pill"><i class="fas fa-stamp"></i></span>
                        </li>
                    </ul>

                </div>

                <div class="col">
                    <div class="header">
                        Advertisements
                    </div>
                <div id="carouselExample1" class="carousel slide z-depth-1-half" data-ride="carousel" data-interval="true">
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <img class="d-block w-100" src="https://mdbootstrap.com/img/Photos/Slides/img%20(45).jpg" alt="First slide">
                        </div>
                        <div class="carousel-item">
                            <img class="d-block w-100" src="https://mdbootstrap.com/img/Photos/Slides/img%20(46).jpg" alt="Second slide">
                        </div>
                        <div class="carousel-item">
                            <img class="d-block w-100" src="https://mdbootstrap.com/img/Photos/Slides/img%20(47).jpg" alt="Third slide">
                        </div>
                    </div>
                    <a class="carousel-control-prev" href="#carouselExample1" role="button" data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="carousel-control-next" href="#carouselExample1" role="button" data-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </a>
                </div>
                </div>
            </div>


            <!-- /.row (main row) -->
        </div><!-- /.container-fluid -->
    </section>
@endsection

@section('page-script')
  <script>
      //Global Variables
      var paymentBarChartGraph;

      //Load Section 1 Graph's
      window.addEventListener('load', function () {
          showPaymentGraph();
      });

      function showPaymentGraph(){
          var url_data = '{{ route("load_payment_graph_data") }}';

          $.ajax({
              url: url_data,
              type: 'GET',
              success: function (response) {
                  let tempArray = response[0];
                  let ctxBar = $("#myChartBar").get(0).getContext("2d");
                  ctxBar.height = 390;

                  let temp_label_container = [];
                  let temp_data_container = [];
                  let max_total_number = 0;
                  for(let i = 0; i < tempArray.length; i++){

                      if (tempArray[i]['pay_status'] === '1'){
                          let amountData = parseInt(tempArray[i]['amount_pay']) + parseInt(tempArray[i]['extra_amount']);
                          temp_label_container.push(tempArray[i]['owner_fullname']);
                          temp_data_container.push(amountData);

                          //Set TOp Column Data
                          if (amountData > max_total_number){
                              max_total_number = amountData;
                          }
                      }

                  }

                  let set_max_val = max_total_number + 2000;

                  //Bar Chart for Parmanent Levy
                  paymentBarChartGraph = new Chart(ctxBar, {
                      type: 'bar',
                      data: {
                          labels: temp_label_container,
                          datasets: [{
                              label: 'Recent Payment History',
                              data: temp_data_container,
                              backgroundColor: 'rgba(255, 99, 132, 1.0)',
                              borderColor: 'rgb(75, 192, 192)',
                              borderWidth: 1
                          }]
                      },
                      options: {
                          scales: {
                              y: { // defining min and max so hiding the dataset does not change scale range
                                  min: 0,
                                  max: set_max_val
                              }
                          },
                          responsive:true,
                          maintainAspectRatio: false,
                      }
                  });
              },
              error: function (jqXHR) {
                  console.log(jqXHR);
              }
          });
      }
  </script>
@endsection
