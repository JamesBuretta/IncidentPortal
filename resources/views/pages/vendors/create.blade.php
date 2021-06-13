@extends('main_frame')

@section('top-details')
<div class="content-header">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Add Vendors</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Add Vendor</li>
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
                        <form action="{{ route('save_vendor') }}" method="POST">
                            {{ csrf_field() }}
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label for="inputCompanyName" class="form-label">Vendor Name:</label>
                                        <input type="text" class="form-control" name="name" value="{{old('name')}}" placeholder="Enter vendor name" required>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label for="inputCompanyName" class="form-label">Phone Number:</label>
                                        <input type="text" class="form-control" name="phone_number" value="{{old('phone_number')}}" placeholder="Enter vendor phone number" required>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label for="inputCompanyName" class="form-label">Email Address:</label>
                                        <input type="text" class="form-control" name="email_address" value="{{old('email_address')}}" placeholder="Enter vendor email address" required>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label for="inputCompanyName" class="form-label">Decription:</label>
                                        <textarea name="description" class="form-control" name="description" id="" cols="30" rows="5" placeholder="Enter Vendor descriptions">{{old('description')}}</textarea>
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

