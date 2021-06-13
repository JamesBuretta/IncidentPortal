@extends('main_frame')

@section('top-details')
<div class="content-header">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Allocate Assset</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Allocate Asset</li>
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
                        <form action="{{ route('allocate_asset') }}" method="POST">
                            {{ csrf_field() }}
                            <div class="row">
                            

                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label  class="form-label">Asset:</label>
                                        <select name="asset_id" class="form-control form-select" aria-label="Default select example">
                                            <option value="" selected>Select asset</option>
                                            @foreach($assets as $asset)
                                            <option value="{{$asset->id}}">{{$asset->serial_number}} - {{$asset->category->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label  class="form-label">Stations:</label>
                                        <select name="station_id" class="form-control form-select" aria-label="Default select example">
                                            <option value="" selected>Select Station</option>
                                            @foreach($stations as $station)
                                            <option value="{{$station->id}}">{{$station->name}} - {{$station->company->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                
                                
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label  class="form-label">Dispatch Date:</label>
                                        <input type="date" class="form-control" name="dispatch_date" value="{{old('dispatch_date')}}" placeholder="Enter dispatch date" required>
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

