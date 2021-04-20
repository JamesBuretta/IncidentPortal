@extends('main_frame')
@section('top-details')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Incidents</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Editing Incident</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
@endsection
@section('main-content')
    <section class="content">

    <div class="card">
        <div class="card-header">
            Update Incident
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


            <form action="{{ url('update_incident/'.$incident->id) }}" method="POST">

                    {{ csrf_field() }}
                    {{ method_field('PUT') }}

                    <div class="form-group">
                        <input type="hidden" name="caller_id" value="{{ $incident->caller_id }}" class="form-control">
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group mb-3">
                                <label for="name">Assigned To*</label>
                                <select name="assigned_id" class="form-control" required>
                                    <option value=""> -- Assign To -- </option>
                                    @foreach($callers as $role)
                                        <option value="{{$role->id ?? ''}}" @if($incident->assigned_id == $role->id) selected="selected" @endif>{{ucfirst($role->fullname)}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group mb-3">
                                <label for="name">Impact*</label>
                                <select name="impact_id" class="form-control" required>
                                    <option value=""> -- Impact -- </option>
                                    @foreach($impacts as $role)
                                        <option value="{{$role->id ?? ''}}" @if($incident->impact_id == $role->id) selected="selected" @endif>{{ucfirst($role->name)}}</option>
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
                                        <option value="{{$role->id ?? ''}}" @if($incident->priority_id == $role->id) selected="selected" @endif>{{ucfirst($role->name)}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="name">Subject*</label>
                        <input type="text" name="subject" value="{{ $incident->subject }}"  class="form-control">
                    </div>

                    <div class="form-group">
                        <label for="name">Description*</label>
                        <textarea id="w3review" name="description" rows="4" cols="50" class="form-control">

                            {{ $incident->description }}

                        </textarea>
                    </div>


                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group mb-3">
                            <select name="status_id" class="form-control" id="selected_status" onchange="updateComment()" required>
                                <option value=""> -- Status -- </option>
                                @foreach($status as $role)
                                    <option   value="{{$role->id ?? ''}}" @if($incident->status_id == $role->id) id="selected_status" selected="selected" @endif>{{ucfirst($role->name)}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>

                <div class="form-group" id="cancel_view">
                    <label for="name">Cancelling Comments</label>
                    <textarea id="w3review" name="closing_comment" id="close_value" rows="4" cols="50" class="form-control">

                            {{ $incident->closing_comments }}

                        </textarea>
                </div>


                <div class="form-group" id="close_view">
                    <label for="name">Closing Comments</label>
                    <textarea id="w3review" name="cancel_comment" rows="4" id="cancel_value" cols="50" class="form-control" >

                            {{ $incident->cancel_comments }}

                        </textarea>
                </div>


                    <div>
                        <input class="btn btn-success form-control" type="submit" value="Edit Incident">
                    </div>


                </form>

        </div>
    </div>
    </section>

@endsection

@section('page-script')

    <script>

        $(document).ready(function(){
            $(document.getElementById('selected_status')).change(function(){
                $( "select option:selected").each(function() {
                    if ($(this).attr("value") == 1) {
                        $("#close_view").hide();
                        $("#cancel_view").hide();
                    } else if ($(this).attr("value") == 2) {
                        $("#close_view").show();
                        $("#cancel_view").hide();
                    } else if ($(this).attr("value") == 3) {
                        $("#close_view").hide();
                        $("#cancel_view").show();
                    }

                });
            });
        });

    </script>
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
