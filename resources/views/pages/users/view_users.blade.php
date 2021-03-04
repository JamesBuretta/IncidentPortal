@extends('main_frame')

@section('top-details')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">View All User's</h1>
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
                            <h3 class="card-title">View User's</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="row" style="margin: 10px;">
                            <div class="col-md-12">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Phone Number</th>
                                        <th>Access</th>
                                        <th>Municipal</th>
                                        <th>Status</th>
                                        <th width="15%">Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php $counter = 1; ?>
                                    @foreach($users as $user)
                                        <tr>
                                            <td>{{$counter}}</td>
                                            <td>{{ucwords($user->fullname)}}</td>
                                            <td>{{$user->email}}</td>
                                            <td>{{$user->phone_number}}</td>
                                            <td>{{ucfirst($user->portalAccess['access_name'])}}</td>
                                            <td>{{($user->municipal_id == '-') ? "-" : $user->municipal['municipal_description_name']}}</td>
                                            <td>{!! ($user->status == 1) ? '<span class="badge bg-success">Active</span>' : '<span class="badge bg-danger">Disabled</span>'  !!}</td>
                                            <td>
                                                <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#change_pass_{{$user->id}}">
                                                    <i class="fa fa-lock" style="margin: 0;"></i>
                                                </button>
                                                <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#remove_user_{{$user->id}}">
                                                    <i class="fa fa-trash" style="margin: 0;"></i>
                                                </button>
                                                <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#update_user_{{$user->id}}">
                                                    <i class="fa fa-edit" style="margin: 0;"></i>
                                                </button>
                                                @if($user->portalAccess['access_name'] != 'superadmin')
                                                    <a href="{{route('user_access',$user->id)}}" class="btn btn-primary btn-sm">
                                                        <i class="fa fa-eye" style="margin: 0;"></i>
                                                    </a>
                                                @endif
                                                <!-- Modal -->
                                                {!! Form::model($user, ['route' => ['user_password_reset',$user->id],'method' => 'PUT']) !!}
                                                <div class="modal fade" id="change_pass_{{$user->id}}" tabindex="-1" role="dialog" aria-labelledby="modalFormStyle1Label" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h4 class="modal-title">Credentials Update</h4>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <p style="text-align: center;">Are you sure you want to reset password for this user ?</p>
                                                                <hr/>
                                                                <button type="submit" class="btn btn-primary" style="float: right;">Confirm</button>
                                                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                {!! Form::close() !!}
                                                {!! Form::open(['method' => 'DELETE', 'route' => ['remove_user',$user->id]]) !!}
                                                <div class="modal fade" id="remove_user_{{$user->id}}" tabindex="-1" role="dialog" aria-labelledby="modalFormStyle1Label" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h4 class="modal-title">Remove User</h4>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>

                                                            <div class="modal-body">
                                                                <p style="text-align: center;">Are you sure you want to delete information for this user ?</p>
                                                                <hr/>
                                                                <button type="submit" class="btn btn-primary" style="float: right;">Confirm</button>
                                                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                {!! Form::close() !!}

                                                {!! Form::model($user, ['route' => ['update_user_details',$user->id],'method' => 'PUT']) !!}

                                                <div class="modal fade" id="update_user_{{$user->id}}" tabindex="-1" role="dialog" aria-labelledby="modalFormStyle1Label" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h4 class="modal-title">Edit User</h4>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="modal-body">
                                                                    <div class="row">
                                                                        <div class="col-md-5">
                                                                            <div class="form-group">
                                                                                <label>Access</label>
                                                                                <select name="access" class="form-control">
                                                                                    <option value=""> -- Default -- </option>
                                                                                    @foreach($user_accesses as $access)
                                                                                        <option value="{{$access->id}}" {{($user->access == $access->id)? "selected":""}}> {{$access->access_name}} </option>
                                                                                    @endforeach
                                                                                </select>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-7">
                                                                            <div class="form-group">
                                                                                <label>Municipal</label>
                                                                                <select name="municipal_id" class="form-control">
                                                                                    <option value=""> -- Default -- </option>
                                                                                    @foreach($municipals as $municipal)
                                                                                        <option value="{{$municipal->id}}" {{($user->municipal_id == $municipal->id)? "selected":""}}> {{$municipal->municipal_description_name}} </option>
                                                                                    @endforeach
                                                                                </select>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row">
                                                                        <div class="col-md-12">
                                                                            <div class="form-group">
                                                                                <label>Email</label>
                                                                                {{Form::email('email', null, ['placeholder' => 'Enter email ','class' => 'form-control','required' => ''])}}
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row">
                                                                        <div class="col-md-7">
                                                                            <div class="form-group">
                                                                                <label>Fullname</label>
                                                                                {{Form::text('fullname', null, ['placeholder' => 'Full name','class' => 'form-control','required' => ''])}}
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-5">
                                                                            <div class="form-group">
                                                                                <label>Account Status</label>
                                                                                <select name="account_status" class="form-control" required>
                                                                                    <option> -- Default -- </option>
                                                                                    <option value="1" {{($user->status == 1)? "selected":""}}> Activate </option>
                                                                                    <option value="0" {{($user->status == 2)? "selected":""}}> De-Activate </option>
                                                                                </select>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <hr/>
                                                                    <button type="submit" class="btn btn-primary" style="float: right;">Update</button>
                                                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!-- /.modal-content -->
                                                    </div>
                                                    <!-- /.modal-dialog -->
                                                </div>
                                                <!-- /.modal -->
                                                {!! Form::close() !!}
                                            </td>
                                        </tr>

                                        <?php $counter ++; ?>
                                    @endforeach
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
