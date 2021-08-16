<!DOCTYPE html>
<html lang="en">

<meta http-equiv="content-type" content="text/html;charset=utf-8" />
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Incident Portal | Create Account</title>
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
        .image-register{
            max-height: 100px;
            border-radius: 50%;
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
        .register-box{
            width: 520px !important;
        }
        .login-section{
            display: none;
        }

    </style>
</head>
<body class="hold-transition login-page">
<div class="login-box register-box">
    <div class="login-logo">
        <a href="#"><b>Incidents</b> PORTAL</a>
    </div>
    <!-- /.login-logo -->
    <div class="card">
        <div class="card-body login-card-body">
            <p class="login-box-msg">
                <img src="{{asset('images/simba_oil.png')}}" class="image-register">
            </p>
            <form id="registerform" class="register register_form create-account-section"  method="POST">
                <div class="row">
                    <div class="col-md-12">
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
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group mb-3">
                            <input type="text" class="form-control" placeholder="Fullname" name="fullname" value="{{ old('fullname') }}" required>
                            @error('fullname')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>

                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group mb-3">
                            <select name="role_id" class="form-control" required>
                                <option value=""> -- Select Role -- </option>
                                @foreach($roles as $role)
                                    <option value="{{$role->id}}">{{ucfirst($role->role_name)}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group mb-3">
                            <select name="company_id" class="form-control" required>
                                <option value=""> -- Select Company -- </option>
                                @foreach($companies as $company)
                                    <option value="{{$company->id}}">{{ucfirst($company->name)}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group mb-3">
                            <select name="station_id" class="form-control" required>
                                <option value=""> -- Select Station -- </option>
                                @foreach($stations as $station)
                                    <option value="{{$station->id}}">{{ucfirst($station->name)}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group mb-3">
                            <input type="text" class="form-control" placeholder="Phone Number" name="phone" value="{{ old('phone') }}" required>
                            @error('phone')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="input-group mb-3">
                    <input type="password" class="form-control" placeholder="Password" name="password" required>
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-lock"></span>
                        </div>
                    </div>
                </div>

                <div class="input-group mb-3">
                    <input type="password" class="form-control" placeholder="Confirm Password" name="confirm" required>
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-lock"></span>
                        </div>
                    </div>
                </div>
                <div class="social-auth-links text-center mb-3">
                    <button type="submit" class="btn btn-block btn-primary register_btn">
                        <i class="fa fa-envelope mr-2"></i> Create Account
                    </button>
                </div>
            </form>
            <!-- /.social-auth-links -->
            <p class="mb-0 text-center create-account-section">
                <a href="{{route('auth_login')}}" class="text-center">Back to Login</a>
            </p>

            <div class="login-section">
                <div class="row">
                    <div class="col-md-12">
                        <hr/>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <a href="{{route('auth_register')}}" class="btn btn-block btn-primary">
                            Back
                        </a>
                    </div>
                    <div class="col-md-6">
                        <button type="button" onclick="systemLogin()" class="btn btn-block btn-primary login_popup">
                            <i class="fa fa-envelope mr-2"></i> Login
                        </button>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <hr/>
                        <p class="text-center">Powered By Simba Logistic</p>
                    </div>
                </div>
            </div>
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

    //Temporary Credentials Holder
    let conPass = [];
    function systemLogin(){
        //Disable Button
        $(".login_popup").html('<i class="fa fa-spin fa-spinner"></i>');
        $(".login_popup").prop("disabled",true);

        $.ajax({
            url: "{{ route('login') }}",
            type: 'POST',
            data: conPass,
            beforeSend: function () {
                //Add Loader Here
            },
            success: function () {
                let success_message = 'Successfully Logged In </br> Redirecting... <i class="fa fa-spin fa-spinner"></i>';
                toastr.success(success_message);
                setTimeout(() => { location.reload() },500);
            },
            error: function (jqXHR) {
                $(".login_btn").html('<i class="fa fa-envelope mr-2"></i> Sign In');
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
    }

    $(document).ready(function(){

        $(".register").submit(function(e) {
            e.preventDefault();
            $("#registerform").addClass("spinner spinner_style");
            $(".register_btn").html('<i class="fa fa-spin fa-spinner"></i>');
            $(".register_btn").prop("disabled",true);

            const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000
            });

            $.ajax({
                url: "{{ route('create_account') }}",
                type: 'POST',
                data: $("form.register").serialize(),
                beforeSend: function () {
                    //Add Loader Here
                },
                success: function (response) {
                    toastr.success('New Account Created Successfully');

                    $('.create-account-section').css('display','none');
                    $('.login-section').css('display','block');

                    //Refresh Csrf Token
                    refreshCsrf();

                    conPass = response;
                    console.log(JSON.stringify(response));
                },
                error: function (jqXHR) {
                    $(".register_btn").html('<i class="fa fa-envelope mr-2"></i> Sign In');
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
            $("#registerform").removeClass("spinner spinner_style");
            $(".register_btn").prop("disabled",false);
        });
    });
</script>
</body>

</html>
