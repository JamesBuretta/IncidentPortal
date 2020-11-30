@extends('main_frame')

@section('custom-page-style')
    <style type="text/css">
        .custom-profile{
            border-radius: 50%;
        }
    </style>
@endsection
@section('top-details')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Profile</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">User Profile</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
@endsection

@section('main-content')
    <section class="content">
        <div class="container-fluid">
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
                </div>
                <div class="col-md-4">

                    <!-- Profile Image -->
                    <div class="card card-primary card-outline">
                        <div class="card-body box-profile">
                            <div class="text-center">
                                <img class="profile-user-img img-fluid img-circle"
                                     src="{{Auth::user()->profile == '-' ? 'images/user.png' : 'images/profiles/'.Auth::user()->profile}}"
                                     alt="User profile picture">
                            </div>

                            <h3 class="profile-username text-center">{{Auth::user()->name}}</h3>

                            <p class="text-muted text-center">{{ucfirst(Auth::user()->role['role_name'])}}</p>

                            <ul class="list-group list-group-unbordered mb-3">
                                <li class="list-group-item">
                                    <b>Email</b> <a class="float-right">{{Auth::user()->email}}</a>
                                </li>
                                <li class="list-group-item">
                                    <b>Name</b> <a class="float-right">{{Auth::user()->fullname}}</a>
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
                <!-- /.col -->
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header p-2">
                            <ul class="nav nav-pills">
                                <li class="nav-item"><a class="nav-link active" href="#profile_dashboard" data-toggle="tab">Profile Info</a></li>
                                <li class="nav-item"><a class="nav-link" href="#update_profile" data-toggle="tab">Update Profile</a></li>
                                <li class="nav-item"><a class="nav-link" href="#update_credentials" data-toggle="tab">Update Credentials</a></li>
                            </ul>
                        </div><!-- /.card-header -->
                        <div class="card-body">
                            <div class="tab-content">
                                <div class="active tab-pane" id="profile_dashboard">
                                    <!-- Post -->
                                    <div class="post">
                                        <!-- /.user-block -->
                                        <div class="row mb-3">
                                            @if(Auth::user()->access == 1)
                                            <div class="col-md-4 text-center">
                                                <img class="img-fluid custom-profile" src="{{asset('images/logo.png')}}" alt="Photo" style="height: 200px;">
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
                                                  <h4 style="text-align: center;">Registered Business</h4>
                                                <div class="table-responsive">
                                                    <table class="table table-striped table-valign-middle">
                                                        <thead>
                                                        <tr>
                                                            <th>Business Number</th>
                                                            <th>Business Name</th>
                                                            <th>Area</th>
                                                            <th>Status</th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        @foreach($business_details as $details)
                                                        <tr>
                                                            <td><a href="#">{{$details->business_number}}</a></td>
                                                            <td>{{$details->descrption_name}}</td>
                                                            <td>{{$details->main_category}}</td>
                                                            <td><span class="badge {{($details->account_status == 1) ? 'badge-info' : 'badge-warning'}}">{{($details->account_status == 1) ? 'Active' : 'Pending'}}</span></td>
                                                        </tr>
                                                        @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>

                                            </div>
                                        @endif
                                            <!-- /.col -->
                                        </div>
                                        <!-- /.row -->
                                    </div>
                                    <!-- /.post -->
                                </div>
                                <!-- /.tab-pane -->
                                <div class="tab-pane" id="update_profile">
                                    {!! Form::model(Auth::user(), ['route' => ['update_profile',Auth::user()->id],'method' => 'PUT']) !!}
                                        <div class="row">
                                            <div class="col-md-7">
                                                <div class="form-group">
                                                    <label>Email</label>
                                                    {{Form::email('email', null, ['placeholder' => 'Enter email ','class' => 'form-control','required' => ''])}}
                                                </div>
                                            </div>
                                            <div class="col-md-5">
                                                <div class="form-group">
                                                    <label>Municipal</label>
                                                    <select name="municipal_id" class="form-control">
                                                        <option> -- Default -- </option>
                                                        @foreach($municipals as $municipal)
                                                            <option value="{{$municipal->id}}" {{(Auth::user()->municipal_id == $municipal->id)? "selected":""}}> {{$municipal->municipal_description_name}} </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label>Fullname</label>
                                                    {{Form::text('fullname', null, ['placeholder' => 'Full name','class' => 'form-control','required' => ''])}}
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="exampleInputFile">Profile <small>(Optional)</small></label>
                                                    <div class="input-group">
                                                        <div class="custom-file">
                                                            <input type="file" name="profile" class="custom-file-input" id="exampleInputFile">
                                                            <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                                                        </div>
                                                        <div class="input-group-append">
                                                            <span class="input-group-text" id="">Upload</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                        <div class="col-md-12 text-right">
                                            <hr/>
                                            <button type="submit" class="btn btn-primary" style="float: right;">Update</button>
                                        </div>
                                    </div>
                                    {!! Form::close() !!}
                                </div>
                                <!-- /.tab-pane -->

                                <div class="tab-pane" id="update_credentials">
                                    {!! Form::model(Auth::user(), ['route' => ['update_credentials',Auth::user()->id],'method' => 'PUT']) !!}
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Old Password</label>
                                                <input type="password" name="old_password" class="form-control" id="exampleInputEmail1" placeholder="Old Password" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">New Password</label>
                                                <input type="password" name="new_password" class="form-control" id="exampleInputEmail1" placeholder="New Password" required>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Confirm New Password</label>
                                                <input type="password" name="confirm_new_password" class="form-control" id="exampleInputEmail1" placeholder="Confirm New Password" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12 text-right">
                                            <hr/>
                                            <button type="submit" class="btn btn-primary" style="float: right;">Update</button>
                                        </div>
                                    </div>
                                    {!! Form::close() !!}
                                </div>
                                <!-- /.tab-pane -->
                            </div>
                            <!-- /.tab-content -->
                        </div><!-- /.card-body -->
                    </div>
                    <!-- /.nav-tabs-custom -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
@endsection
