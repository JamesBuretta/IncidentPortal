@extends('main_frame')

@section('top-details')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">View FAQ</h1>
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
                    <!-- general form elements -->
                    <div class="card card-info card-outline">
                        <div class="card-header">
                            <div class="row">
                                <div class="col-md-9">
                                    <h3 class="card-title" style="margin-top: 5px;">View FAQ List</h3>
                                </div>
                                <div class="col-md-3">
                                    <div class="input-group input-group-sm">
                                        <input type="text" id="searchFilter" name="searchFilter" class="form-control">
                                        <span class="input-group-append">
                                            <button type="button" id="searchBtn" onclick="loadFAQ()" class="btn btn-info btn-flat">Search!</button>
                                          </span>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <div class="card-body">
                            <div id="accordion">
                                <!-- we are adding the .class so bootstrap.js collapse plugin detects it -->
                                <div id="faqList">
                                    <div style="width: 100%; text-align: center;"><i class="fa fa-spin fa-spinner fa-2x"></i></div>
                                </div>
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
<script>
     //lload All FAQ
     loadFAQ();

    function loadFAQ(){
        //Check if there is a value
        let filterVal = document.getElementById("searchFilter").value;
        //Disable Search Btn
        $('#searchBtn').attr("disabled", true);

        var url_data = '{{ route("load_faq_data", ":id") }}';
        url_data = url_data.replace(':id', filterVal === '' ? 'default' : filterVal);

        $.ajax({
            url: url_data,
            type: 'get',
            dataType: 'json',
            beforeSend: function(){
                $('#faqList').empty();
                $('#faqList').append('<div style="width: 100%; text-align: center;"><i class="fa fa-spin fa-spinner fa-2x"></i></div>');
            },
            success: function (result) {
                console.log(result.faq);
                $('#faqList').empty();

                if(result.faq.length === 0){
                    var dit = '<div class="card card-default">';
                    dit +='<div class="card-header">';
                    dit +='<div class="row">';
                    dit +='<div class="col-md-12 text-center">';
                    dit += ' No search result found...';
                    dit += ' </div>';
                    dit += ' </div>';
                    dit += '</div>';
                    dit += '</div>';

                    $('#faqList').append(dit);
                }else{
                    for (var i = 0; i < result.faq.length; i++) {
                        var dt = '<div class="card card-default">';
                        dt +='<div class="card-header">';
                        dt +='<div class="row">';
                        dt +='<div class="col-md-11">';
                        dt +='<h4 class="card-title">';
                        dt += '<a data-toggle="collapse" data-parent="#accordion" href="#collapse'+result.faq[i]['id']+'">';
                        dt +=  result.faq[i]['title'];
                        dt +=' </a>';
                        dt +=' </h4>';
                        dt +='</div>';
                        dt += '<div class="col-md-1 text-right">';
                        dt +=  ' <i class="fa fa-arrow-right"></i>';
                        dt +=   '</div>';
                        dt += ' </div>';
                        dt += '</div>';
                        dt += '<div id="collapse'+result.faq[i]['id']+'" class="panel-collapse collapse in">';
                        dt += '<div class="card-body">';
                        dt += result.faq[i]['answer'];
                        dt += ' </div>';
                        dt += '</div>';
                        dt += '</div>';

                        $('#faqList').append(dt);
                    }
                }

                //Restore Search Btn
                $('#searchBtn').attr("disabled", false);
            },
            error: function (xhr, status, error) {
                console.log(xhr);
            }
        });
    }

</script>
@endsection
