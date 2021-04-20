@extends('main_frame')

@section('top-details')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>@yield('title')</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">@yield('desc')</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
@endsection

@section('main-content')
    <section class="content">
    @if(Request::is('view_roles'))
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
    @endif

    @if(Request::is('view_stations'))
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
                <a class="btn btn-success btn-sm" href="{{ url('create_station') }}">
                    Create Station
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
                                            Station Name
                                        </th>
                                        <th>
                                            Action
                                        </th>

                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($stations as $station)
                                        <tr data-entry-id="1" data-toggle="modal" data-target="#largeModal{{$station->id}}" id="loadingModel" data="{{$station->id}}">
                                            <td>
                                                {{$station->name}}
                                            </td>
                                            <td>

                                                {{--                                                                <a class="btn btn-danger btn-sm" href="{{ url('delete_station/'.$station->id) }}">--}}
                                                {{--                                                                    Delete Station--}}
                                                {{--                                                                </a>--}}

                                                <a class="btn btn-primary btn-sm" href="{{ url('view_station/'.$station->id) }}">
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
    @endif

    @if(Request::is('create_stations'))
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
                <a class="btn btn-success btn-sm" href="{{ url('create_station') }}">
                    Create Station
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
                                            Station Name
                                        </th>
                                        <th>
                                            Action
                                        </th>

                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($stations as $station)
                                        <tr data-entry-id="1" data-toggle="modal" data-target="#largeModal{{$station->id}}" id="loadingModel" data="{{$station->id}}">
                                            <td>
                                                {{$station->name}}
                                            </td>
                                            <td>

                                                {{--                                                                <a class="btn btn-danger btn-sm" href="{{ url('delete_station/'.$station->id) }}">--}}
                                                {{--                                                                    Delete Station--}}
                                                {{--                                                                </a>--}}

                                                <a class="btn btn-primary btn-sm" href="{{ url('view_station/'.$station->id) }}">
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
    @endif

    </section>
@endsection


@section('page-script')
    <script>
        //lload All FAQ
        loadFAQ();

        function loadFAQ(){
            //Check if there is a value
            let filterVal = document.getElementById("searchFilter").value;
            //Disable Search Btn
            $('#searchBtn').attr("disabled", true);

            var url_data = '{{ route("load_faq_data", ":id") }}';
            url_data = url_data.replace(':id', filterVal === '' ? 'default' : filterVal);

            $.ajax({
                url: url_data,
                type: 'get',
                dataType: 'json',
                beforeSend: function(){
                    $('#faqList').empty();
                    $('#faqList').append('<div style="width: 100%; text-align: center;"><i class="fa fa-spin fa-spinner fa-2x"></i></div>');
                },
                success: function (result) {
                    console.log(result.faq);
                    $('#faqList').empty();

                    if(result.faq.length === 0){
                        var dit = '<div class="card card-default">';
                        dit +='<div class="card-header">';
                        dit +='<div class="row">';
                        dit +='<div class="col-md-12 text-center">';
                        dit += ' No search result found...';
                        dit += ' </div>';
                        dit += ' </div>';
                        dit += '</div>';
                        dit += '</div>';

                        $('#faqList').append(dit);
                    }else{
                        for (var i = 0; i < result.faq.length; i++) {
                            var dt = '<div class="card card-default">';
                            dt +='<div class="card-header">';
                            dt +='<div class="row">';
                            dt +='<div class="col-md-11">';
                            dt +='<h4 class="card-title">';
                            dt += '<a data-toggle="collapse" data-parent="#accordion" href="#collapse'+result.faq[i]['id']+'">';
                            dt +=  result.faq[i]['title'];
                            dt +=' </a>';
                            dt +=' </h4>';
                            dt +='</div>';
                            dt += '<div class="col-md-1 text-right">';
                            dt +=  ' <i class="fa fa-arrow-right"></i>';
                            dt +=   '</div>';
                            dt += ' </div>';
                            dt += '</div>';
                            dt += '<div id="collapse'+result.faq[i]['id']+'" class="panel-collapse collapse in">';
                            dt += '<div class="card-body">';
                            dt += result.faq[i]['answer'];
                            dt += ' </div>';
                            dt += '</div>';
                            dt += '</div>';

                            $('#faqList').append(dt);
                        }
                    }

                    //Restore Search Btn
                    $('#searchBtn').attr("disabled", false);
                },
                error: function (xhr, status, error) {
                    console.log(xhr);
                }
            });
        }

    </script>
@endsection
