@extends('main_frame')

@section('top-details')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">View Added Municipal's</h1>
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
                            <div class="row">
                                <div class="col-md-6">
                                    <h3 class="card-title"  style="padding-top: 5px;">View Municipal's</h3>
                                </div>
                                <div class="col-md-6 text-right">
                                    <a href="{{route('add-municipals')}}" class="btn btn-info">
                                        Add New
                                    </a>
                                </div>
                            </div>

                        </div>
                        <!-- /.card-header -->
                        <div class="row" style="margin: 10px;">
                            <div class="col-md-12">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>DB Name</th>
                                        <th>Description Title</th>
                                        <th width="15%">Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php $counter = 1; ?>
                                    @foreach($municipals as $municipal)
                                        <tr>
                                            <td>{{$counter}}</td>
                                            <td>{{($municipal->municipal_db_name)}}</td>
                                            <td>{{ucwords($municipal->municipal_description_name)}}</td>
                                            <td>
                                                <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#remove_municipal_{{$municipal->id}}">
                                                    <i class="fa fa-trash" style="margin: 0;"></i>
                                                </button>
                                                <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#update_municipal_{{$municipal->id}}">
                                                    <i class="fa fa-edit" style="margin: 0;"></i>
                                                </button>
                                                {!! Form::open(['method' => 'DELETE', 'route' => ['remove_municipal',$municipal->id]]) !!}
                                                <div class="modal fade" id="remove_municipal_{{$municipal->id}}" tabindex="-1" role="dialog" aria-labelledby="modalFormStyle1Label" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h4 class="modal-title">Remove Municipal</h4>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>

                                                            <div class="modal-body">
                                                                <p style="text-align: center;">Are you sure you want to delete information for this Municipal ?</p>
                                                                <hr/>
                                                                <button type="submit" class="btn btn-primary" style="float: right;">Confirm</button>
                                                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                {!! Form::close() !!}

                                                {!! Form::model($municipal, ['route' => ['update_municipal_details',$municipal->id],'method' => 'PUT']) !!}

                                                <div class="modal fade" id="update_municipal_{{$municipal->id}}" tabindex="-1" role="dialog" aria-labelledby="modalFormStyle1Label" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h4 class="modal-title">Edit Municipal</h4>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="modal-body">
                                                                    <div class="row">
                                                                        <div class="col-md-12">
                                                                            <div class="form-group">
                                                                                <label>DB Path</label>
                                                                                {{Form::text('municipal_db_name', null, ['placeholder' => 'DB Config Path','class' => 'form-control','required' => ''])}}
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row">
                                                                        <div class="col-md-12">
                                                                            <div class="form-group">
                                                                                <label>Municipal Title</label>
                                                                                {{Form::text('municipal_description_name', null, ['placeholder' => 'Municipal Title Description','class' => 'form-control','required' => ''])}}
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
