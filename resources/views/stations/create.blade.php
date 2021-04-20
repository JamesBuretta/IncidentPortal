@extends('main_frame');
@section('top-details')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Create Stations</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Stations</li>
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
        <div class="card-header">
            Create Station
        </div>

        <div class="card-body">
            @if(session('notification') && session('color'))
                <div class="alert alert-{{ session('color') }} alert-dismissible fade show" role="alert">
                    {{ session('notification') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif

            @if($errors->any())
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    @foreach($errors->all() as $error)
                        <li class="list-group-item">
                            {{ $error }}
                        </li>
                    @endforeach
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif


            <form action="{{ url('create_station') }}" method="POST">

                {{ csrf_field() }}
                {{ method_field('POST') }}

                <div class="form-group">
                    <label for="name">Station*</label>
                    <input type="text" name="name" class="form-control">
                </div>

                <div>
                    <input class="btn btn-success form-control" type="submit" value="Add Station">
                </div>


            </form>
        </div>
    </div>

                </div>
            </div>
        </div>
    </section>


@endsection

@section('page-script')
    <script>
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

    </script>
@endsection
