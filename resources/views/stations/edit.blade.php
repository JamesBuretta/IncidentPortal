@extends('main_frame');
@section('top-details')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Roles</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Editing Roles</li>
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
    <div class="card">
        <div class="card-header">
            Edit Station
        </div>

        <div class="card-body">
            @if(isset($notification) && isset($color))
                <div class="alert alert-{{ $color }} alert-dismissible fade show" role="alert">
                    {{ $notification }}
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


            <form action="{{ url('update_station') }}" method="POST">

                @csrf
                @method('PUT')

                <input type="hidden" name="id" value="{{ $station->id }}">
                <div class="form-group">
                    <label for="name">Station*</label>
                    <input type="text" name="name" value="{{ $station->name }}" class="form-control">
                </div>


                <div>
                    <input class="btn btn-success form-control" type="submit" value="Edit Station">
                </div>

                <div>
                    <a class="btn-primary col-lg-6" href="{{ url('view_stations') }}"><-Back</a>
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
