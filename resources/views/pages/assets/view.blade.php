@extends('main_frame')

@section('top-details')
<div class="content-header">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Registered Assets</h1>
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
                                    <th scope="col">Serial Number</th>
                                    <th scope="col">MD Number</th>
                                    <th scope="col">GRN Number</th>
                                    <th scope="col">Date Received</th>
                                    <th scope="col">Category</th>
                                    <th scope="col">Manufacturer</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Options</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($assets as $asset)
                                <tr>
                                    <th scope="row">{{ $loop->iteration }}</th>
                                    <td>{{ $asset->serial_number }}</td>
                                    <td>{{ $asset->md_number }}</td>
                                    <td>{{ $asset->grn_number }}</td>
                                    <td>{{ $asset->date_received }}</td>
                                    <td>{{ $asset->category->name }}</td>
                                    <td>{{ $asset->category->vendor->name }}</td>
                                    <td><span class="badge @if($asset->status == 'Operational') bg-success @else bg-danger @endif"> {{ $asset->status }} </span></td>

                                    <td>
                                        <form action="{{ route('delete_asset') }}" method="POST">
                                            {{ csrf_field() }}
                                            <a class="btn btn-info btn-sm" href="#" role="button" alt="View"><i class="fa fa-info-circle"></i></a>
                                            <a class="btn btn-primary btn-sm" href="{{ route('edit_asset', $asset->id)}}" role="button" alt="Edit"><i class="fa fa-edit"></i></a>
                                            <input type="hidden" class="form-control" name="asset_id" value="{{$asset->id}}">
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

    {{--function downloadReport(paymentID) {--}}
    {{--    var url_data = '{{ route("download_invoice", ":id") }}';--}}
    {{--    url_data = url_data.replace(':id', paymentID);--}}

    {{--    //Button Loader--}}
    {{--    $("#print_btn_" + paymentID).html('<i class="fa fa-spin fa-spinner" style="padding: 2px;"></i>');--}}

    {{--    $.ajax({--}}
    {{--        url: url_data,--}}
    {{--        type: 'GET',--}}
    {{--        success: function() {--}}
    {{--            //Restore Button Loader--}}
    {{--            $("#print_btn_" + paymentID).html('<i class="fa fa-print" style="padding: 2px;"></i>');--}}
    {{--        },--}}
    {{--        error: function(xhr, status, error) {--}}
    {{--            //Restore Button Loader--}}
    {{--            $("#print_btn_" + paymentID).html('<i class="fa fa-print" style="padding: 2px;"></i>');--}}
    {{--            console.log(xhr);--}}
    {{--        }--}}
    {{--    });--}}
    {{--}--}}
</script>
@endsection
