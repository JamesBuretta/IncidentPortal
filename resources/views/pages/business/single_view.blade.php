@extends('main_frame')

@section('top-details')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">View Single Business</h1>
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
                        <div class="card card-primary card-outline">
                            <div class="card-body box-profile">
                                <ul class="list-group list-group-unbordered mb-3">
                                    <li class="list-group-item">
                                        <b>Business Name</b> <a class="float-right">{{Auth::user()->email}}</a>
                                    </li>
                                    <li class="list-group-item">
                                        <b>Owner Name</b> <a class="float-right">{{$business_details[0]->owner_fullname}}</a>
                                    </li>
                                    <li class="list-group-item">
                                        <b>Business Number</b> <a class="float-right">{{$business_details[0]->business_number}}</a>
                                    </li>
                                    <li class="list-group-item">
                                        <b>Manager Name</b> <a class="float-right">{{$business_details[0]->manager_name == "" ? '-' : $business_details[0]->manager_name}}</a>
                                    </li>
                                    <li class="list-group-item">
                                        <b>Business Category</b> <a class="float-right">{{$business_details[0]->descrption_name}}</a>
                                    </li>
                                    <li class="list-group-item">
                                        <b>Business Account Status</b> <a class="float-right"><span class="badge {{($business_details[0]->account_status == 1) ? 'badge-info' : 'badge-danger'}}">{{($business_details[0]->account_status == 1) ? 'Active' : 'In-Active'}}</span>   </a>
                                    </li>
                                    <li class="list-group-item">
                                        <b>Business TPIN</b> <a class="float-right">{{$business_details[0]->tin_number}}</a>
                                    </li>
                                    <li class="list-group-item">
                                        <b>P.O Box</b> <a class="float-right">{{$business_details[0]->po_box}}</a>
                                    </li>
                                    <li class="list-group-item">
                                        <b>District</b> <a class="float-right">{{$business_details[0]->district}}</a>
                                    </li>
                                    <li class="list-group-item">
                                        <b>Ward</b> <a class="float-right">{{$business_details[0]->ward}}</a>
                                    </li>
                                    <li class="list-group-item">
                                        <b>Street</b> <a class="float-right">{{$business_details[0]->street}}</a>
                                    </li>
                                    <li class="list-group-item">
                                        <b>Municipal</b> <a class="float-right">{{ (Auth::user()->municipal_id == '-') ? '-' : ucfirst(Auth::user()->municipal['municipal_description_name'])}}</a>
                                    </li>
                                </ul>
                            </div>
                            <!-- /.card-body -->
                        </div>
                    <!-- /.card -->
                </div>
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
@endsection
