@extends('main_frame')

@section('top-details')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Manage Access</h1>
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
                            <h3 class="card-title">Access For: {{$user_details->fullname}}</h3>
                        </div>
                        <!-- /.card-header -->

                        <!-- form start -->
                        {!! Form::model($user_details, ['route' => ['update-user-access',$user_details->id],'method' => 'PUT']) !!}
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <div class="custom-control custom-switch custom-switch-off-danger custom-switch-on-success">
                                                <input type="checkbox" name="manage_users" class="custom-control-input" id="customSwitch1" {{(in_array('manage_users',$access_array)
                                                ? 'checked' : '')}}>
                                                <label class="custom-control-label" for="customSwitch1">Manage User's</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <div class="custom-control custom-switch custom-switch-off-danger custom-switch-on-success">
                                                <input type="checkbox" name="manage_licence" class="custom-control-input" id="customSwitch2" {{(in_array('manage_licence',$access_array)
                                                ? 'checked' : '')}}>
                                                <label class="custom-control-label" for="customSwitch2">Manage Licence</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <div class="custom-control custom-switch custom-switch-off-danger custom-switch-on-success">
                                                <input type="checkbox" name="manage_prn" class="custom-control-input" id="customSwitch3" {{(in_array('manage_prn',$access_array)
                                                ? 'checked' : '')}}>
                                                <label class="custom-control-label" for="customSwitch3">Manage PRN</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <hr/>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <div class="custom-control custom-switch custom-switch-off-danger custom-switch-on-success">
                                                <input type="checkbox" name="payment_history" class="custom-control-input" id="customSwitch4" {{(in_array('payment_history',$access_array)
                                                ? 'checked' : '')}}>
                                                <label class="custom-control-label" for="customSwitch4">Payment History</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <div class="custom-control custom-switch custom-switch-off-danger custom-switch-on-success">
                                                <input type="checkbox" name="manage_municipals" class="custom-control-input" id="customSwitch5" {{(in_array('manage_municipals',$access_array)
                                                ? 'checked' : '')}}>
                                                <label class="custom-control-label" for="customSwitch5">Manage Municipal's</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <div class="custom-control custom-switch custom-switch-off-danger custom-switch-on-success">
                                                <input type="checkbox" name="manage_users" class="custom-control-input" id="customSwitch6" {{(in_array('manage_users',$access_array)
                                                ? 'checked' : '')}}>
                                                <label class="custom-control-label" for="customSwitch6">Manage User's</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <hr/>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <div class="custom-control custom-switch custom-switch-off-danger custom-switch-on-success">
                                                <input type="checkbox" name="profile" class="custom-control-input" id="customSwitch7" {{(in_array('profile',$access_array)
                                                ? 'checked' : '')}}>
                                                <label class="custom-control-label" for="customSwitch7">My Profile</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <div class="custom-control custom-switch custom-switch-off-danger custom-switch-on-success">
                                                <input type="checkbox" name="logs" class="custom-control-input" id="customSwitch8" {{(in_array('logs',$access_array)
                                                ? 'checked' : '')}}>
                                                <label class="custom-control-label" for="customSwitch8">Log's</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <!-- /.card-body -->

                            <div class="card-footer text-right">
                                <button type="submit" class="btn btn-primary">Update Access</button>
                            </div>
                        {!! Form::close() !!}
                    </div>
                    <!-- /.card -->
                </div>

            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
@endsection
