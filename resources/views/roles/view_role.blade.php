@extends('main_frame');
@section('custom-page-style')
    <style type="text/css">
        .custom-profile{
            border-radius: 50%;
        }
    </style>
@endsection
@section('top-details')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Roles</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">View roles</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
@endsection
@section('main-content')

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">

        <div class="card">
            @if(session('notification') && session('color'))
                <div class="alert alert-{{ session('color') }} alert-dismissible fade show" role="alert">
                    {{ session('notification') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif

            <div class="card-header">
                <a class="btn btn-success btn-sm" href="{{ url('create_role') }}">
                    Create Role
                </a>
            </div>

            <div class="card-body">

                <div class="table-responsive">

                    <div class="card mb-4">

                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                    <tr>
                                        <th>
                                            Role Name
                                        </th>
                                        <th>
                                            Action
                                        </th>

                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($roles as $role)
                                        <tr data-entry-id="1" data-toggle="modal" data-target="#largeModal{{$role->id}}" id="loadingModel" data="{{$role->id}}">
                                            <td>
                                                {{$role->role_name}}


                                            </td>
                                            <td>

                                                {{--                                                                <a class="btn btn-danger btn-sm" href="{{ url('delete_role/'.$role->id) }}">--}}
                                                {{--                                                                    Delete Role--}}
                                                {{--                                                                </a>--}}

                                                <a class="btn btn-primary btn-sm" href="{{ url('view_roles/'.$role->id) }}">
                                                    Edit
                                                </a>

                                            </td>
                                        </tr>

                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

                </div>
            </div>
        </div>
    </section>

@endsection





