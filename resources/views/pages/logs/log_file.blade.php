@extends('main_frame')

@section('top-details')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">System Log's</h1>
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

                    <!-- general form elements -->
                    <div class="card card-info card-outline">
                        <div class="card-header">
                            <div class="row">
                                <div class="col-md-6">
                                    <h3 class="card-title">Log's</h3>
                                </div>
                                <div class="col-md-6 text-right">
                                    <button type="button" class="btn btn-primary btn-sm" onclick="triggerAlert()">Clear Log's</button>
                                </div>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="row" style="margin: 10px;">
                            <div class="col-md-12">
                                <table id="logs" class="table table-bordered table-striped">
                                    <thead>
                                    <tr>
                                        <th>Timestamp</th>
                                        <th>Type</th>
                                        <th>Message</th>
                                    </tr>
                                    </thead>
                                    <tbody></tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <!-- /.card -->
                </div>
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
@endsection

@section('page-script')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script type="text/javascript">
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    </script>
  <script>

      //Load Logs
      getLogs();
      function triggerAlert(){
          Swal.fire({
              title: 'Are you sure?',
              text: "You won't be able to revert this!",
              icon: 'warning',
              showCancelButton: true,
              confirmButtonColor: '#3085d6',
              cancelButtonColor: '#d33',
              confirmButtonText: 'Yes, delete it!'
          }).then((result) => {
              if (result.isConfirmed) {
                  removeLogs();
              }
          })
      }
      function getLogs(){
          //Refresh Csrf Token
          $.ajax({
              url: "{{env('LOG_URL').'/admin/api/log-reader'}}",
              type: 'get',
              dataType: 'json',
              beforeSend: function () {
                  $('<tr><td colspan="4"> <div class="loading" style="padding: 10px 0 10px 0;text-align: center;font-size:20px">Loading... <i class="fa fa-spinner fa-spin" style="font-size:20px"></i></div></td></tr>').appendTo('tbody');
              },
              success: function (result) {
                  let system_logs = result.data;

                  if (result.success === false){
                      document.getElementById("logs").deleteRow(1);
                      $('<tr><td colspan="4"> <div style="padding: 10px 0 10px 0;text-align: center;font-size:20px">'+result.message +'</div></td></tr>').appendTo('tbody');
                  }else{
                      if (!$.fn.DataTable.isDataTable('#logs')) {
                          $('#logs').DataTable({
                              "searching": true,
                              data: system_logs.logs,

                              columns: [
                                  {data: 'timestamp'},
                                  {data: 'type'},
                                  {data: 'message'}
                              ]
                          });
                      }

                  }


                  $('.loading').hide();

                  //Refresh Token
                  refreshCsrf();
              },
              error: function (xhr, status, error) {
                  console.log(xhr);
              }
          });
      }
      function removeLogs(){
          //Refresh Csrf Token
          $.ajax({
              url: "{{env('LOG_URL').'/admin/log-reader'}}",
              type: 'POST',
              data: {"clear":true},
              success: function (result) {
                  let response_message = result.message;

                  Swal.fire({
                      icon: 'success',
                      title: 'Success',
                      text: response_message
                  })

                  //Reload Logs
                  location.reload();
              },
              error: function (xhr, status, error) {
                  console.log(xhr);
              }
          });
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
