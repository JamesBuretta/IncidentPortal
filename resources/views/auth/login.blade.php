<!DOCTYPE html>
<html lang="en">

<meta http-equiv="content-type" content="text/html;charset=utf-8" />
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Citizen Portal | Log in</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Toastr -->
    <link rel="stylesheet" href="{{asset('plugins/toastr/toastr.min.css')}}">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{asset('plugins/fontawesome-free/css/all.min.css')}}">
    <!-- Ionicons -->
    <link rel="stylesheet" href="{{asset('css/ionicons.min.css')}}">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="{{asset('plugins/icheck-bootstrap/icheck-bootstrap.min.css')}}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{asset('dist/css/adminlte.min.css')}}">
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">

    <style type="text/css">
        .image-login{
            max-height: 100px;
        }
        @keyframes spinner {
            from {transform:rotate(0deg);}
            to {transform: rotate(360deg);}
        }

        @keyframes success_spinner {
            from {transform:rotate(0deg);}
            to {transform: rotate(360deg);}
        }

        .success_spinner:before {
            content: '';
            box-sizing: border-box;
            position: absolute;
            top: 40%;
            left: 65%;
            width: 40px;
            height: 40px;
            margin-top: -10px;
            margin-left: -10px;
            border-radius: 50%;
            border: 2px solid #ccc;
            border-top-color: #333;
            animation: spinner .6s linear infinite;
            z-index: 9999;
        }

        .spinner:before {
            content: '';
            box-sizing: border-box;
            position: absolute;
            top: 43%;
            left: 50%;
            width: 40px;
            height: 40px;
            margin-top: -10px;
            margin-left: -10px;
            border-radius: 50%;
            border: 2px solid #ccc;
            border-top-color: #333;
            animation: spinner .6s linear infinite;
            z-index: 9999;

        }
        .spinner_style{
            opacity: 0.5;
        }

        .hide{
            display: none;
        }

    </style>
</head>
<body class="hold-transition login-page">
<div class="login-box">
    <div class="login-logo">
        <a href="#"><b>Citizen</b> PORTAL</a>
    </div>
    <!-- /.login-logo -->
    <div class="card">
        <div class="card-body login-card-body">
            <p class="login-box-msg">
                <img src="{{asset('images/lilongwe.jpg')}}" class="image-login">
            </p>

            @if(session('fail'))
                <script>
                    setTimeout(() => {
                        toastr.error('This credentials do not match our records');
                    },500);
                </script>
            @endif
            @if ($errors->any())
                <script>
                    setTimeout(() => {
                        toastr.error('This credentials do not match our records');
                    },500);
                </script>
            @endif

            <form id="loginform" class="login login_form"  method="POST">
                <div class="input-group mb-3">
                    <input type="email" class="form-control" placeholder="Email" name="email" value="{{ old('email') }}" required>
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-envelope"></span>
                        </div>
                    </div>
                    @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <div class="input-group mb-3">
                    <input type="password" class="form-control" placeholder="Password" name="password" required>
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-lock"></span>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <div class="icheck-primary">
                            <input type="checkbox" id="remember">
                            <label for="remember">
                                Remember Me
                            </label>
                        </div>
                    </div>
                    <!-- /.col -->
                    <div class="col-6">
                        <p style="margin-top: 5px;">
                            <a href="{{ route('auth_password_reset') }}">forgot your password ?</a>
                        </p>
                    </div>
                    <!-- /.col -->
                </div>

                <div class="social-auth-links text-center mb-3">
                    <button type="submit" class="btn btn-block btn-primary login_btn">
                        <i class="fa fa-envelope mr-2"></i> Log In
                    </button>
                </div>
            </form>


            <!-- /.social-auth-links -->
            <p class="mb-0 text-center">
                <a href="{{route('auth_register')}}" class="text-center">Register new Account</a>
            </p>
        </div>
        <!-- /.login-card-body -->
    </div>
</div>
<!-- /.login-box -->

<!-- jQuery -->
<script src="{{asset('plugins/jquery/jquery.min.js')}}"></script>
<!-- Bootstrap 4 -->
<script src="{{asset('plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{asset('dist/js/adminlte.min.js')}}"></script>
<!-- SweetAlert2 -->
<script src="{{asset('plugins/sweetalert2/sweetalert2.min.js')}}"></script>
<!-- Toastr -->
<script src="{{asset('plugins/toastr/toastr.min.js')}}"></script>

<script type="text/javascript">
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
</script>
<script>
    /* LOGIN */

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

    $(document).ready(function(){

        $(".login").submit(function(e) {
            e.preventDefault();
            $("#loginform").addClass("spinner spinner_style");
            $(".login_btn").html('<i class="fa fa-spin fa-spinner"></i>');
            $(".login_btn").prop("disabled",true);

            const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000
            });

            $.ajax({
                url: "{{ route('login') }}",
                type: 'POST',
                data: $("form.login").serialize(),
                beforeSend: function () {
                    //Add Loader Here
                },
                success: function () {
                   // let success_message = 'Successfully Logged In </br> Redirecting... <i class="fa fa-spin fa-spinner"></i>';
                    //toastr.success(success_message);
                    location.reload()
                    //setTimeout(() => {  },500);
                },
                error: function (jqXHR) {
                    $(".login_btn").html('<i class="fa fa-envelope mr-2"></i> Log In');
                    if (jqXHR.responseJSON) {
                        var errorsHtml1 = '';

                        errorsHtml1 += '<ul>';

                        $.each( jqXHR.responseJSON.errors, function( key, value ) {
                            errorsHtml1 += '<li>'+ value[0] + '</li>'; //showing only the first error.
                        });
                        errorsHtml1 += '</ul>';

                        toastr.error(errorsHtml1);

                        //Refresh Csrf Token
                        refreshCsrf();
                    }
                    else if(jqXHR.responseText){
                        var response = $.parseJSON(jqXHR.responseText);
                        var errorsHtml = '';

                        errorsHtml += '<ul>';

                        $.each( response.errors, function( key, value ) {
                            errorsHtml += '<li>'+ value[0] + '</li>'; //showing only the first error.
                        });
                        errorsHtml += '</ul>';

                        toastr.error(errorsHtml);

                        //Refresh Csrf Token
                        refreshCsrf();
                    }

                }
            });
        });
    });

    $(document).ready(function () {
        $(document).ajaxComplete(function () {
            $("#loginform").removeClass("spinner spinner_style");
            $(".login_btn").prop("disabled",false);
        });
    });
</script>
</body>

</html>
