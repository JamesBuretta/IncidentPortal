@extends('main_frame')
@section('top-details')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Job Assessments</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">View Job Assessments</li>
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
                    Job Assessments Details
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

<div class="col-md-12">
    <div class="table-responsive">
        <table id="example1"  class="table table-striped table-valign-middle">
            <thead>
            <tr>
                <th>Job Desc</th>
                <th>Spare Required</th>
                <th>Comments</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
            @foreach($jobs as $job)
                <tr>

                    <td>{{$job->job_desc ?? '-' }}</td>
                    <td>{{$job->spare_required ?? '-' }}</td>
                    <td>{{$job->comments ?? '-' }}</td>
                    <td>
                        <div class="form-horizontal">
                            {{--                                        @if ($job->status === "Un-attended")--}}

                            <a href="{{ url('job_assessment/'.$job->id) }}"   class="btn btn-primary">View</a>

                            {{--                                        @endif--}}
                            {{--                                    <a  href="#" onclick="handleClose('{{ url('close') }}','{{ $job->id }}')" class="btn btn-success" data-toggle="modal"   data-target="#close">Close</a>--}}
                            {{--                                    <a  href="#" onclick="handleCancel('{{ url('cancel') }}','{{ $job->id }}')" class="btn btn-danger" data-toggle="modal"   data-target="#cancel">Cancel</a>--}}
                        </div>
                    </td>
                </tr
            @endforeach
            </tbody>
        </table>
    </div>
</div>

</div>
</div>
</div>
</section>

@endsection

@section('page-script')
    <script>


        $('#example1').dataTable({
            order: [
                [1, 'desc']
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


