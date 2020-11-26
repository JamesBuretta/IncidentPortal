@extends('main_frame')

@section('top-details')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">View Payment's</h1>
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
                            <h3 class="card-title">Payment's</h3>
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
                                        <th width="10%">Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php $counter = 1; ?>
                                    @for($i = 0; $i < sizeof($payments); $i++)
                                        <tr>
                                            <td>{{$counter}}</td>
                                            <td><a href="#">{{$payments[$i]->PRN}}</a></td>
                                            <td>{{$payments[$i]->owner_fullname}}</td>
                                            <td>{{$payments[$i]->business_number}}</td>
                                            <td>{{$payments[$i]->amount_pay}}</td>
                                            <td>{{$payments[$i]->descrption_name}}</td>
                                            <td>
                                                <span class="badge {{($payments[$i]->pay_status == '1') ? 'bg-success' : 'bg-danger'}}">{{($payments[$i]->pay_status == '1') ? 'Paid' : 'Un-Paid'}}</span>
                                            </td>
{{--                                            <td>--}}
{{--                                                <button type="submit"--}}
{{--                                                        id="request_{{$payments[$i]['entity']}}"--}}
{{--                                                        {{($payments[$i]['PRN'] != '-' || $payments[$i]['account_status'] != 1) ? 'disabled' : '' }}--}}
{{--                                                        {{($payments[$i]['PRN'] == '-' && $payments[$i]['account_status'] == 1) ? 'onclick=triggerConfirm('.'"'.$payments[$i]['entity'].'"'.','.$payments[$i]['business_number'].')' : '' }}--}}
{{--                                                        class="btn btn-primary btn-block">--}}
{{--                                                    Request--}}
{{--                                                </button>--}}
{{--                                            </td>--}}
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
