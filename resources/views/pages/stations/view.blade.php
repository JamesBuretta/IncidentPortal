@extends('main_frame')

@section('top-details')
<div class="content-header">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Registered Stations</h1>
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




        <div class="row mb-3">
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
                    <strong>Fail!</strong> <br />
                    <ul>
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif
            </div>
        </div>


        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <table id="myTable" class="table table-hover">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Station Name</th>
                                    <th scope="col">Phone Number</th>
                                    <th scope="col">Email Address</th>
                                    <th scope="col">Longitude</th>
                                    <th scope="col">Lattitude</th>
                                    <th scope="col">Company</th>
                                    <th scope="col">Options</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($stations as $station)
                                <tr>
                                    <th>{{ $loop->iteration }}</th>
                                    <td>{{ $station->name }}</td>
                                    <td>{{ $station->phone_number }}</td>
                                    <td>{{ $station->email }}</td>
                                    <td>{{ $station->longt }}</td>
                                    <td>{{ $station->latt }}</td>
                                    <td>{{ $station->company->name }}</td>
                                    <td>
                                        <form action="{{ route('delete_station') }}" method="POST">
                                            {{ csrf_field() }}
                                            <a class="btn btn-info btn-sm" href="#" role="button" alt="View"><i class="fa fa-info-circle"></i></a>
                                            <a class="btn btn-primary btn-sm" href="{{ route('edit_station', $station->id)}}" role="button" alt="Edit"><i class="fa fa-edit"></i></a>
                                            <input type="hidden" class="form-control" name="station_id" value="{{$station->id}}">
                                            <button type="submit" class="btn btn-danger btn-sm"> <i class="fa fa-trash"></i> </button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>


    </div><!-- /.container-fluid -->
</section>
@endsection


@section('page-script')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script type="text/javascript">
    //load the data table
    $(document).ready(function() {

        $("#myTable").DataTable({
            "responsive": true,
            "lengthChange": false,
            "autoWidth": false,
            "buttons": ["print", "csv", "excel", "pdf"]
        }).buttons().container().appendTo('#myTable_wrapper .col-md-6:eq(0)');



    });



    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    function refreshCsrf() {
        //Refresh Csrf Token
        $.ajax({
            url: "{{route('refresh_token')}}",
            type: 'get',
            dataType: 'json',
            success: function(result) {
                $('meta[name="csrf-token"]').attr('content', result.token);
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': result.token
                    }
                });
            },
            error: function(xhr, status, error) {
                console.log(xhr);
            }
        });
    }

    function downloadReport(paymentID) {
        var url_data = '{{ route("download_invoice", ":id") }}';
        url_data = url_data.replace(':id', paymentID);

        //Button Loader
        $("#print_btn_" + paymentID).html('<i class="fa fa-spin fa-spinner" style="padding: 2px;"></i>');

        $.ajax({
            url: url_data,
            type: 'GET',
            success: function() {
                //Restore Button Loader
                $("#print_btn_" + paymentID).html('<i class="fa fa-print" style="padding: 2px;"></i>');
            },
            error: function(xhr, status, error) {
                //Restore Button Loader
                $("#print_btn_" + paymentID).html('<i class="fa fa-print" style="padding: 2px;"></i>');
                console.log(xhr);
            }
        });
    }
</script>
@endsection
