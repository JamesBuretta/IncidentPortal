@extends('main_frame')

@section('top-details')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">View Business</h1>
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
                            <h3 class="card-title">Business</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="row" style="margin: 10px;">
                            @if(Auth::user()->access == 1)
                                <div class="col-md-4 text-center">
                                    <img class="img-fluid custom-profile" src="{{asset('images/lilongwe.jpg')}}" alt="Photo" style="height: 200px;">
                                </div>
                                <div class="col-md-8">
                                    <div class="alert alert-info alert-dismissible" style="margin-top: 8%;">
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                        <h5><i class="icon fas fa-info"></i> Note!</h5>
                                        Owner business will be listed here.. You have logged in as Admin in the System
                                    </div>
                                </div>
                            @else
                            <div class="col-md-12">
                                <div class="table-responsive">
                                    <table id="example1"  class="table table-striped table-valign-middle">
                                        <thead>
                                        <tr>
                                            <th>Business Number</th>
                                            <th>Business Name</th>
                                            <th>Area</th>
                                            <th>Status</th>
                                            <th></th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($business_details as $details)
                                            <tr>
                                                <td><a href="#">{{$details->business_number}}</a></td>
                                                <td>{{$details->descrption_name}}</td>
                                                <td>{{$details->main_category}}</td>
                                                <td><span class="badge {{($details->account_status == 1) ? 'badge-info' : 'badge-warning'}}">{{($details->account_status == 1) ? 'Active' : 'Pending'}}</span></td>
                                                <td>
                                                    <a href="{{route('view_single_business',[$details->entity_id])}}">
                                                        <i class="fa fa-eye"></i>
                                                    </a>

                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
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
@endsection
