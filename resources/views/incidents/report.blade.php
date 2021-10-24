@extends('main_frame')
@section('top-details')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Incident Report</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Incidents Report</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
@endsection
@section('main-content')

<section class="content">
    <div class="container-fluid">
        <div class="card">
            <div class="card-header">
                Filter Incidents
            </div>

            <div class="card-body">
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

                <form action="{{ route('reports_filtered') }}" method="POST">

                    {{ csrf_field() }}
                    {{ method_field('POST') }}
                    <div class="row">

                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label for="name">From</label>
                                <input class="form-control" type="date" value="{{ $from_date ?? ''}}" id="formFileDisabled" name="from_date">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label for="name">To</label>
                                <input class="form-control" type="date" value="{{ $to_date ?? ''}}" id="formFileDisabled" name="to_date">
                            </div>
                        </div>
                    </div>

                    {{--  Filter based on User and Status  --}}

                    <div class="row">

                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="inputCompanyName" class="form-label">Impact</label>
                                <select name="impact_id" class="form-control form-select" aria-label="Default select example">
                                    <option value="" selected>Select Impact</option>
                                    @foreach($impacts as $impact)
                                        <option value="{{$impact->id}}">{{$impact->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="inputCompanyName" class="form-label">Priority</label>
                                <select name="priority_id" class="form-control form-select" aria-label="Default select example">
                                    <option value="" selected>Select Priority</option>
                                    @foreach($priorities as $priority)
                                        <option value="{{$priority->id}}">{{$priority->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                    </div>

                    <div class="row">

                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="inputCompanyName" class="form-label">Technician</label>
                                <select name="assigned_id" class="form-control form-select" aria-label="Default select example">
                                    <option value="" selected>Select Technician</option>
                                    @foreach($technicians as $impact)
                                        <option value="{{$impact->id}}">{{$impact->fullname}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="inputCompanyName" class="form-label">Client/Dealer</label>
                                <select name="caller_id" class="form-control form-select" aria-label="Default select example">
                                    <option value="" selected>Select Client/Dealer</option>
                                    @foreach($callers as $priority)
                                        <option value="{{$priority->id}}">{{$priority->fullname}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                    </div>


                    <div>
                        <input class="btn btn-success form-control" type="submit" value="Get Report">
                    </div>
                </form>

            </div>
        </div>


        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table id="example1" class="table table-striped table-valign-middle">
                        <thead>
                            <tr>
                                <th>Assigned To</th>
                                <th>Caller Name</th>
                                <th>Priority</th>
                                <th>Impact</th>
                                <th>Status</th>
                                <th>Subject</th>
                                <th>Description</th>
                                <th>Opened Date</th>
                                <th>Cancelled Date</th>
                                <th>Closed Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($incidents as $details)
                            <tr>
                                <td>{{$details->assigned }}</td>
                                <td>{{$details->caller }}</td>
                                <td>{{$details->priority }}</td>
                                <td>{{$details->impact }}</td>
                                <td>
                                   {{ $details->status }}
                                </td>
                                <td>{{urldecode($details->subject) ?? '--'}}</td>
                                <td>{{urldecode($details->description) ?? '--'}}</td>
                                <td>{{$details->created_datetime ?? '--'}}</td>
                                <td>{{$details->cancelled_datetime ?? '--'}}</td>
                                <td>{{$details->closed_datetime ?? '--'}}</td>

                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>






    </div>


    @include('dialog.close')
    @include('dialog.cancel')

</section>

@endsection

@section('page-script')
<script>

    $('#example1').dataTable({
        order: [
            [9, 'desc']
        ]
    });
</script>
@endsection
