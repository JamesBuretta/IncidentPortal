@extends('main_frame')

@section('top-details')
<div class="content-header">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Edit Station</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Edit Station</li>
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
                    <div class="card-header">
                        Please fill in all fields.
                    </div>
                    <div class="card-body">
                        <form action="{{ route('update_station') }}" method="POST">
                            {{ csrf_field() }}
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label for="inputstationName" class="form-label">station Name:</label>
                                        <input type="text" class="form-control" name="name" value="{{$station->name}}" placeholder="Enter station name" required>
                                        <input type="hidden" class="form-control" name="station_id" value="{{$station->id}}">
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label for="inputstationName" class="form-label">Phone Number:</label>
                                        <input type="text" class="form-control" name="phone_number" value="{{$station->phone_number}}" placeholder="Enter station phone number" required>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label for="inputstationName" class="form-label">Email Address:</label>
                                        <input type="text" class="form-control" name="email" value="{{$station->email}}" placeholder="Enter station email address" required>
                                    </div>
                                </div>

                                
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label for="inputCompanyName" class="form-label">Longitude:</label>
                                        <input type="text" class="form-control" name="longt" value="{{$station->longt}}" placeholder="Enter longitude gps position" required>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label for="inputCompanyName" class="form-label">Lattitude:</label>
                                        <input type="text" class="form-control" name="latt" value="{{$station->latt}}" placeholder="Enter lattitude gps position" required>
                                    </div>
                                </div>



                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label for="inputCompanyName" class="form-label">Company:</label>
                                        <select name="company_id" class="form-control form-select" aria-label="Default select example">
                                            <option value="" selected>Select company</option>
                                            @foreach($companies as $company)
                                            <option value="{{$company->id}}"  @if($company->id == $station->company_id) selected @endif >{{$company->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>



                            </div>
                            <hr />
                            <button type="submit" class="btn btn-primary">Save</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>


    </div><!-- /.container-fluid -->
</section>
@endsection

