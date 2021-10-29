@extends('main_frame')
@section('top-details')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Incident</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Create Incident</li>
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
                     Incidents
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
                            <strong>Fail!</strong> <br/>
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

@if(Request::is('create_incident'))
                    <form action="{{ url('create_incident') }}" method="POST">

                        {{ csrf_field() }}
                        {{ method_field('POST') }}

                        <div class="form-group">
                            <input type="hidden" name="caller_id" value="{{ Auth::user()->id }}" class="form-control">
                        </div>

                        @if(Auth::user()->role_id == 1)
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group mb-3">
                                    <label for="name">Assigned To*</label>
                                    <select name="assigned_id" class="form-control" required>
                                        <option value=""> -- Assign To -- </option>
                                        @foreach($callers as $role)
                                            <option value="{{$role->id}}">{{ucfirst($role->fullname)}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        @endif

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group mb-3">
                                    <label for="name">Impact*</label>
                                    <select name="impact_id" class="form-control" required>
                                        <option value=""> -- Impact -- </option>
                                        @foreach($impacts as $role)
                                            <option value="{{$role->id}}">{{ucfirst($role->name)}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group mb-3">
                                    <label for="name">Priority*</label>
                                    <select name="priority_id" class="form-control" required>
                                        <option value=""> -- Priority -- </option>
                                        @foreach($priorities as $role)
                                            <option value="{{$role->id}}">{{ucfirst($role->name)}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="name">Subject*</label>
                            <input type="text" name="subject"  class="form-control">
                        </div>

                        <div class="form-group">
                            <label for="name">Description*</label>
                            <textarea id="w3review" name="description"  rows="4" cols="50" class="form-control">
                            </textarea>

                        </div>


                        <div>
                            <input class="btn btn-success form-control" type="submit" value="Create Incident">
                        </div>


                    </form>
                </div>
            </div>
        </div>

@endif

@if(Request::is('view_incidents'))
            <div class="col-md-12">

                <div class="table-responsive">
                    <table id="example1"  class="table table-striped table-valign-middle">
                        <thead>
                        <tr>
                            <th>Image</th>
                            <th>Ticket ID</th>
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
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($incidents as $details)
                            <tr>

                                <td><img src={{ "https://incidents.pushads.co.tz/storage/app/public/".$details->image }} width="100px" height="100px" alt="No Image"></td>
                                <td>{{$details->incident_ticket ?? ' ' }}</td>
                                <td>{{$details->assigned }}</td>
                                <td>{{$details->caller }}</td>
                                <td>{{$details->priority }}</td>
                                <td>{{$details->impact }}</td>
                                <td>
                                    {{ $details->status }}
{{--                                    @if($details->status === "Un-attended")--}}
{{--                                    <span class="badge badge-primary text-white text-capitalize">--}}
{{--                                    {{$details->status ?? '--'}}--}}
{{--                                    </span>--}}
{{--                                    @endif--}}

{{--                                    @if($details->status === "Cancelled")--}}
{{--                                    <span class="badge badge-danger text-white text-capitalize">--}}
{{--                                    {{$details->status ?? '--'}}--}}
{{--                                    </span>--}}
{{--                                    @endif--}}

{{--                                    @if($details->status === "Closed")--}}
{{--                                    <span class="badge badge-danger text-capitalize">--}}
{{--                                    {{$details->status ?? '--'}}--}}
{{--                                    </span>--}}
{{--                                    @endif--}}
{{--                                    @if($details->status === "Approved")--}}
{{--                                        <span class="badge badge-success text-white text-capitalize">--}}
{{--                                        {{$details->status ?? '--'}}--}}
{{--                                        </span>--}}
{{--                                    @endif--}}
                                </td>
                                <td>{{urldecode($details->subject) ?? '--'}}</td>
                                <td>{{urldecode($details->description) ?? '--'}}</td>
                                <td>{{$details->created_datetime ?? '--'}}</td>
                                <td>{{$details->cancelled_datetime ?? '--'}}</td>
                                <td>{{$details->closed_datetime ?? '--'}}</td>
                                <td>
                                    <div class="form-horizontal">
{{--                                        @if ($details->status === "Un-attended")--}}

                                        <div class="row">

                                        @if($details->status == "Open")
                                        <a href="#"   class="btn btn-primary assign-technician" data-assigned-value-id="{{ $details->id }}">Assign</a>
                                        @endif

                                        @if($details->status == "Assigned")
                                            Awaiting Permit
                                        @endif


                                        @if($details->status == "In Progress")
                                            <a href="#"   class="btn btn-primary grant-permit">Grant/Revoke Permit</a>
                                        @endif

                                        @if($details->status == "Approved Work Permit")
                                            <a href="#"   class="btn btn-primary close-incident">Close Indident</a>
                                        @endif

                                        @if($details->status != "Closed")
                                            <a href="#"   class="btn btn-danger cancel-incident">Cancel</a>
                                        @endif

                                        </div>


{{--                                        @endif--}}
{{--                                    <a  href="#" onclick="handleClose('{{ url('close') }}','{{ $details->id }}')" class="btn btn-success" data-toggle="modal"   data-target="#close">Close</a>--}}
{{--                                    <a  href="#" onclick="handleCancel('{{ url('cancel') }}','{{ $details->id }}')" class="btn btn-danger" data-toggle="modal"   data-target="#cancel">Cancel</a>--}}
                                    </div>
                                </td>
                            </tr
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
@endif

        @include('dialog.close')
        @include('dialog.cancel')

        @include('incidents.modals.assign')
        @include('incidents.modals.cancel')
        @include('incidents.modals.permit')

</section>

@endsection

@section('page-script')
    <script>


{{--Assign Incident Logic--}}
            $(document).ready(function () {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $('body').on('click', '.assign-technician', function (event) {
            event.preventDefault();
            var assigned_id = $(this).data('assigned-value-id');


            $('#edit-assigned-modal').modal('show');
            $('#assigned-value-id').val(assigned_id);
        });
        });

{{----}}
$(document).ready(function () {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $('body').on('click', '.approve-permit', function (event) {
        event.preventDefault();
        var bin = $(this).data('bin_number');
        var id = $(this).data('id');
        var cat = $(this).data('category');
        var currency = $(this).data('currency');

        $('#edit-job-assessment-modal').modal('show');
        $('#bin_id').val(id);
        $('#bin_number').val(bin);
        $('#bin_category').val(cat);
        $('#bin_currency').val(currency);
    });
});


//TODO: Request Permit

$(document).ready(function () {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $('body').on('click', '.cancel-incident', function (event) {
        event.preventDefault();
        var bin = $(this).data('bin_number');
        var id = $(this).data('id');
        var cat = $(this).data('category');
        var currency = $(this).data('currency');

        $('#edit-cancel-modal').modal('show');
        $('#bin_id').val(id);
        $('#bin_number').val(bin);
        $('#bin_category').val(cat);
        $('#bin_currency').val(currency);
    });
});

//TODO: Close Incident / Submit Job

//TODO: Submit Job Card




        $('#example1').dataTable({
            order: [
                [9, 'desc']
            ]
        });


        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        function handleClose(url,id)
        {
            var form = document.getElementById('close');
            var id = document.getElementById('close_id').value=id;
            var comment = document.getElementById('closing_comment').value;

            form.action = url;
        }

        function handleCancel(url,id)
        {
            var form = document.getElementById('cancel');
            var id = document.getElementById('cancel_id').value=id;
            var comment = document.getElementById('cancel_comment').value;

            form.action = url;
        }

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
