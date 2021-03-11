@extends('main_frame')

@section('top-details')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Business Licence Renewal</h1>
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
                        <div
                            class="m-alert m-alert--outline m-alert--outline-2x alert alert-success alert-dismissible fade show"
                            role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            </button>
                            <strong>Success!</strong> {{ session('success') }}
                        </div>

                    @elseif(session('fail'))
                        <div
                            class="m-alert m-alert--outline m-alert--outline-2x alert alert-danger alert-dismissible fade show"
                            role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            </button>
                            <strong>Fail!</strong> {{ session('fail') }}
                        </div>
                    @endif
                    @if ($errors->any())
                        <div
                            class="m-alert m-alert--outline m-alert--outline-2x alert alert-danger alert-dismissible fade show"
                            role="alert">
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
                            <h3 class="card-title">Request Renewal</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="row" style="margin: 10px;">
                            @if($available_details > 0)
                            <div class="col-md-12">
                                <div class="table-responsive">
                                    <table  id="example1" class="table table-striped table-valign-middle">
                                        <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Business Number</th>
                                            <th>Registration Name</th>
                                            <th>Business Name</th>
                                            <th>PRN</th>
                                            <th>Payment</th>
                                            <th>Area</th>
                                            <th>Business Status</th>
                                            <th></th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php $counter = 1; ?>
                                        @for($i = 0; $i < sizeof($business_details); $i++)
                                            <tr>
                                                <td>{{$counter}}</td>
                                                <td><a href="{{route('view_single_business',[$business_details[$i]['entity_id']])}}">{{$business_details[$i]['business_number']}}</a></td>
                                                <td>{{$business_details[$i]['registration_name']}}</td>
                                                <td>{{$business_details[$i]['description_name']}}</td>
                                                <td>{{$business_details[$i]['PRN']}}</td>
                                                <td>
                                                    <span class="badge {{($business_details[$i]['payment_status'] == 'paid') ? 'bg-success' : 'bg-danger'}}">{{($business_details[$i]['payment_status'] == 'paid') ? 'Paid' : 'Un-Paid'}}</span>
                                                </td>
                                                <td>{{$business_details[$i]['location']}}</td>
                                                <td>
                                                    <span class="badge {{($business_details[$i]['account_status'] == 1) ? 'bg-success' : 'bg-danger'}}">
                                                        {{($business_details[$i]['account_status'] == 1) ? 'Active' : 'In-Active'}}
                                                    </span>
                                                </td>
                                                <td>
                                                    <div class="row">
                                                    <button type="submit"
                                                            id="request_{{$business_details[$i]['entity']}}"
                                                            {{($business_details[$i]['PRN'] != '-' || $business_details[$i]['account_status'] != 1) ? 'disabled' : '' }}
                                                            {{($business_details[$i]['PRN'] == '-' && $business_details[$i]['account_status'] == 1) ? 'onclick=triggerConfirm('.'"'.$business_details[$i]['entity'].'"'.','.$business_details[$i]['business_number'].')' : '' }}
                                                            class="btn btn-primary btn-block">
                                                            Request
                                                    </button>
                                                    @if($business_details[$i]['payment_status'] == 'un-paid')
                                                            <button class="btn btn-success btn-block"  onclick="handleApprove('{{ url('request-prn',[$business_details[$i]['PRN']]) }}','{{ $business_details[$i]['PRN'] }}')" data-toggle="modal"   data-target="#approve">
                                                                Pay
                                                            </button>
                                                    @endif
                                                    </div>
                                                </td>
                                            </tr>
                                            <?php $counter++; ?>
                                        @endfor
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            @else
                                <div class="col-md-12">
                                    <div class="alert alert-info alert-dismissible" style="margin-top: 10px;">
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                        <h5><i class="icon fas fa-info"></i> Note!</h5>
                                        Your Account its Either an Admin or Your didnt provide PRIN & Municipal
                                    </div>
                                </div>
                            @endif
                        </div>

                    </div>
                    <!-- /.card -->
                </div>
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>

    @include('dialog.approve_dialog')
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

        function triggerConfirm(entity,business_number){
            Swal.fire({
                title: 'Do you want to request PRN for the year '+new Date().getFullYear()+'?',
                showDenyButton: false,
                showCancelButton: true,
                confirmButtonText: `Request`,
                denyButtonText: `Don't save`,
            }).then((result) => {
                /* Read more about isConfirmed, isDenied below */
                if (result.isConfirmed) {
                    sendAjaxRequest(entity,business_number);
                }
            })
        }

        function sendAjaxRequest(entity,num){
            //Disable Button's
            $("#request_"+entity).html('<i class="fa fa-spin fa-spinner"></i>');
            $("#request_"+entity).prop("disabled",true);

           //Request PRIN Number
            $.ajax({
                url: "{{route('business_request_prn')}}",
                type: 'POST',
                data: {"entity":entity,"business_number":num},
                success: function (result) {
                    let response_message = result.success;

                    Swal.fire({
                        icon: 'success',
                        title: 'Success',
                        text: response_message
                    })

                    //Reload Page
                    setTimeout(() => { location.reload() },1000);
                },
                error: function (xhr, status, error) {
                    console.log(xhr);
                }
            });
        }
    </script>
    <script>
        function handleApprove(url,prn_number)
        {
            var form = document.getElementById('approveOrder');
            var text = document.getElementById('myText1').innerHTML = "Are you sure want to make payment for Business Licence with PRN : "+prn_number+"?";

            form.action = url;
        }
    </script>
@endsection




