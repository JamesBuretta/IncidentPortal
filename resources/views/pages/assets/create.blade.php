@extends('main_frame')

@section('top-details')
<div class="content-header">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Add Assets</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Add Asset</li>
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
                        <form action="{{ route('save_asset') }}" method="POST">
                            {{ csrf_field() }}
                            
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label for="inputCompanyName" class="form-label">Serial Number:</label>
                                        <input type="text" class="form-control" name="serial_number" value="{{old('serial_number')}}" placeholder="Enter serial numer" required>
                                    </div>
                                </div>


                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label for="inputCompanyName" class="form-label">MD Number:</label>
                                        <input type="text" class="form-control" name="md_number" value="{{old('md_number')}}" placeholder="Enter MD numer" required>
                                    </div>
                                </div>


                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label for="inputCompanyName" class="form-label">GRN Number:</label>
                                        <input type="text" class="form-control" name="grn_number" value="{{old('grn_number')}}" placeholder="Enter GRN numer" required>
                                    </div>
                                </div>


                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label for="inputCompanyName" class="form-label">Date Received:</label>
                                        <input type="date" class="form-control" name="date_received" value="{{old('date_received')}}" required>
                                    </div>
                                </div>


                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label for="inputCompanyName" class="form-label">Status:</label>
                                        <select name="status" class="form-control form-select" aria-label="Default select example">
                                            <option value="Operational" selected>Operational</option>
                                            <option value="Faulty">Faulty</option>
                                        </select>
                                    </div>
                                </div>


                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label for="inputCompanyName" class="form-label">Categories:</label>
                                        <select name="category_id" class="form-control form-select" aria-label="Default select example">
                                            <option value="" selected>Select category</option>
                                            @foreach($categories as $category)
                                            <option value="{{$category->id}}">{{$category->name}}</option>
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