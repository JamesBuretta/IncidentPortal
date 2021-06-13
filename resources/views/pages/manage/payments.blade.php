@extends('main_frame')

@section('top-details')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">View Payment's History</h1>
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
                <div class="col-md-12">
                    @if (session('success'))
                        <div class="m-alert m-alert--outline m-alert--outline-2x alert alert-success alert-dismissible fade show" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            </button>
                            <strong>Success!</strong> {{ session('success') }}
                        </div>

                    @elseif(session('fail'))
                        <div class="m-alert m-alert--outline m-alert--outline-2x alert alert-danger alert-dismissible fade show" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            </button>
                            <strong>Fail!</strong> {{ session('fail') }}
                        </div>
                    @endif
                    @if ($errors->any())
                        <div class="m-alert m-alert--outline m-alert--outline-2x alert alert-danger alert-dismissible fade show" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            </button>
                            <strong>Fail!</strong> <br/>
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <!-- general form elements -->
                    <div class="card card-info card-outline">
                        <div class="card-header">
                            <h3 class="card-title">Payment's History</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="row" style="margin: 10px;">
                            <div class="col-md-12">

                                 <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>PRN</th>
                                        <th>Owner Name</th>
                                        <th>Business Number</th>
                                        <th>Amount (MK)</th>
                                        <th>Business Type</th>
                                        <th>Year</th>
                                        <th>Paid On</th>
                                        <th width="7%">Status</th>
                                        <th width="7%"></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php $counter = 1; ?>
                                    @for($i = 0; $i < sizeof($payments); $i++)
                                        <tr>
                                            <td>{{$counter}}</td>
                                            <td>{{$payments[$i]->PRN}}</td>
                                            <td>{{$payments[$i]->owner_fullname}}</td>
                                            <td>{{$payments[$i]->business_number}}</td>
                                            <td>{{$payments[$i]->amount_pay}}</td>
                                            <td>{{$payments[$i]->descrption_name}}</td>
                                            <td>{{\Carbon\Carbon::parse($payments[$i]->payment_date)->format('Y')}}</td>
                                            <td>{{($payments[$i]->pay_status == '1') ? \Carbon\Carbon::parse($payments[$i]->paid_date)->format('d M, Y') : '-'}}</td>
                                            <td>
                                                <span class="badge {{($payments[$i]->pay_status == '1') ? 'bg-success' : 'bg-danger'}}">{{($payments[$i]->pay_status == '1') ? 'Paid' : 'Un-Paid'}}</span>
                                            </td>
                                            <td>
                                                @if($payments[$i]->pay_status == '1')
                                                   <span class="badge bg-info" id="print_btn_{{$payments[$i]->entity_id}}" onclick="downloadReport({{$payments[$i]->entity_id}})">
                                                      <i class="fa fa-print" style="padding: 2px;"></i>
                                                   </span>
                                                @endif
                                            </td>

                                        </tr>
                                        <?php $counter++; ?>
                                    @endfor
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <!-- /.card -->
                </div>
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
@endsection


@section('page-script')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script type="text/javascript">
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        function refreshCsrf(){
            //Refresh Csrf Token
            $.ajax({
                url: "{{route('refresh_token')}}",
                type: 'get',
                dataType: 'json',
                success: function (result) {
                    $('meta[name="csrf-token"]').attr('content', result.token);
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': result.token
                        }
                    });
                },
                error: function (xhr, status, error) {
                    console.log(xhr);
                }
            });
        }

        function downloadReport(paymentID){
            var url_data = '{{ route("download_invoice", ":id") }}';
            url_data = url_data.replace(':id', paymentID);

            //Button Loader
            $("#print_btn_"+paymentID).html('<i class="fa fa-spin fa-spinner" style="padding: 2px;"></i>');

            $.ajax({
                url: url_data,
                type: 'GET',
                success: function () {
                    //Restore Button Loader
                    $("#print_btn_"+paymentID).html('<i class="fa fa-print" style="padding: 2px;"></i>');
                },
                error: function (xhr, status, error) {
                    //Restore Button Loader
                    $("#print_btn_"+paymentID).html('<i class="fa fa-print" style="padding: 2px;"></i>');
                    console.log(xhr);
                }
            });
        }
    </script>
@endsection
