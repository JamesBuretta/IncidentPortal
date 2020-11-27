@extends('main_frame')

@section('top-details')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Business Licence</h1>
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
                            <h3 class="card-title">Request Licence (For New Business)</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        @if($available_details > 0)
                        <form action="{{ route('request_business_licence') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Owner Name</label>
                                            <input type="text" name="owner_name" class="form-control" value="{{ old('owner_name') }}" id="exampleInputEmail1" placeholder="Owner Name" required>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Manager Name</label>
                                            <input type="text" name="manager_name" class="form-control" value="{{ old('manager_name') }}" id="exampleInputEmail1" placeholder="Manager Name" required>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Business Name</label>
                                            <input type="text" name="business_name" class="form-control" value="{{ old('business_name') }}"  id="exampleInputEmail1" placeholder="Business Name" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Business Number</label>
                                            <input type="text" name="business_number" class="form-control"  value="{{ old('business_number') }}"  id="exampleInputEmail1" placeholder="Business Number" required>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Hamlet</label>
                                            <select name="hamlet" class="form-control" required>
                                                <option value=""> -- Default -- </option>
                                                @for($i = 0; $i < sizeof($hamlets); $i++)
                                                    <option value="{{$hamlets[$i]->hamlet_id}}">{{ucfirst($hamlets[$i]->hamlet_name)}}</option>
                                                @endfor
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Permanent Levy</label>
                                            <select id="permanent_levy" name="permanent_levy" class="form-control" onchange="getLevyChannel()" required>
                                                <option value=""> -- Default -- </option>
                                                @for($i = 0; $i < sizeof($permanent_levy); $i++)
                                                    <option value="{{$permanent_levy[$i]->type_id}}">{{ucfirst($permanent_levy[$i]->type_name)}}</option>
                                                @endfor
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Permanent Levy Channels</label>
                                            <select id="permanent_levy_channel" name="permanent_levy_channel" class="form-control" required>
                                                <option value=""> -- Default -- </option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Registered Area</label>
                                            <select name="registered_area" class="form-control" required>
                                                <option value=""> -- Default -- </option>
                                                @for($i = 0; $i < sizeof($registered_area); $i++)
                                                    <option value="{{$registered_area[$i]->area_id}}">{{ucfirst($registered_area[$i]->main_category)}}</option>
                                                @endfor
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Block</label>
                                            <input type="text" name="block" class="form-control" value="{{ old('block') }}" id="exampleInputEmail1" placeholder="Block" required>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">House No</label>
                                            <input type="text" name="house_number" class="form-control" value="{{ old('house_number') }}" id="exampleInputEmail1" placeholder="House No" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="exampleInputFile">Image <small>(Optional)</small></label>
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
                            </div>
                            <!-- /.card-body -->

                            <div class="card-footer text-right">
                                <button type="submit" class="btn btn-primary">Add New</button>
                            </div>
                        </form>
                        @else
                            <div class="col-md-12">
                                <div class="alert alert-info alert-dismissible" style="margin-top: 10px;">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                    <h5><i class="icon fas fa-info"></i> Note!</h5>
                                    Your Account its Either an Admin or Your didnt provide PRIN & Municipal
                                </div>
                            </div>
                        @endif
                    </div>
                    <!-- /.card -->
                </div>
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
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

    function getLevyChannel($data_selected) {
        let permanent_levy = $('#permanent_levy').val();

        var url_data = '{{ route("get_levy_channel",[":levy"] ) }}';
        url_data = url_data.replace(':levy', permanent_levy);


            $.ajax({
                url: url_data,
                type: 'GET',
                beforeSend: function () {
                    //Before Sent
                },
                success: function (response) {
                    console.log(response);
                    var sourceType = '';
                    sourceType += '<option value=""> --- Select Levy Channel --- </option>';
                    $.each( response.levy_channels, function( key, value) {
                        sourceType += '<option value="'+ value.descr_id +'">' + value.descrption_name +'</option>'; //showing only the first error.
                    });

                    $("#permanent_levy_channel").html(sourceType);
                },
                error: function (jqXHR) {
                    console.log(jqXHR);
                }
            });

    }
</script>
@endsection
