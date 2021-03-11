<!DOCTYPE html>
<html>
<head>
    <!-- <meta charset="utf-8"> -->
    <title>Pagebreak - Test</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <link href="{{ public_path('css/bootstrap3.css') }}" rel="stylesheet">
    <style type="text/css">
        /* optional styles */
        @page {
            margin: 100px 25px;
            footer: page-footer;
        }

        header {
            position: fixed;
            top: -60px;
            left: 0px;
            right: 0px;
            height: 30px;

            /** Extra personal styles **/
            padding: 10px 5px 0 5px;
            background-color: #C0C0C0;
            color: black;
            text-align: center;
            line-height: 35px;
        }

        #idFooter {
            position: fixed;
            bottom: -30px;
            left: 0px;
            right: 0px;
            height: 50px;

            /** Extra personal styles **/
            background-color: #C0C0C0;
            color: black;
            text-align: center;
            line-height: 35px;
        }

        #report {
            font-family: Arial, Helvetica, sans-serif;
            border-collapse: collapse;
            width: 100%;
        }

        #report td, #report th {
            border: 1px solid #ddd;
            padding: 8px;
        }

        #report tr:nth-child(even){background-color: #f2f2f2;}

        #report tr:hover {background-color: #ddd;}

        #report th {
            padding-top: 12px;
            padding-bottom: 12px;
            text-align: left;
            background-color: #4CAF50;
            color: white;
        }
    </style>
</head>
<body>
<header>
    <table style="width:100%;max-width:100%;">
        <tr>
            <td style="width: 50%;text-align: left;">
                <div style="width: 100%;">
                    Citizen Portal
                </div>
            </td>
            <td style="width: 50%;text-align: right;">
                <div style="width: 100%;">
                    Malawi
                </div>
            </td>
        </tr>
    </table>
</header>

<table style="width:100%;max-width:100%;margin-bottom: 30px;">
    <tr>
        <?php $randomNumber = rand(11111,99999);  ?>
        <td style="width: 30%">
            {!! QrCode::encoding('UTF-8')->generate('Payment Successful. Invoice #'.$randomNumber); !!}
        </td>
        <td style="width: 70%;text-align:right;">
            <div style="width: 70%;text-align:left;"></div>
            <div style="width: 30%;text-align:left;">
                <span style="color:#000000;font-family:Arial;font-size:20px;">Payment Invoice</span> <br/>
                <span style="color:#000000;font-family:Arial;font-size:16px;">Invoice # {{$randomNumber}}</span> <br/>
                <span style="color:#000000;font-family:Arial;font-size:16px;">Payment # {{$payment_number}}</span> <br/>
                <span style="color:#000000;font-family:Arial;font-size:17px;">{{date('m/d/Y', time())}}</span> <br/>
            </div>
        </td>
    </tr>
</table>
<div style="width: 100%;text-align: center;margin-bottom: 20px;">
    <span style="color:#000000;font-family:Arial;font-size:20px;"><strong>PAYMENT INVOICE</strong></span>
</div>
<table id="report" class="table table-bordered table-striped">
    <thead>
    <tr>
        <th>S/N</th>
        <th>Owner Name</th>
        <th>Business Name</th>
        <th>Business Number</th>
        <th>Business Licence</th>
        <th>Charges Amount</th>
        <th>Extra Amount</th>
    </tr>
    </thead>
    <tbody>
        <tr>
            <td>1</td>
            <td>{{$owner_name}}</td>
            <td>{{$business_name}}</td>
            <td>{{$business_number}}</td>
            <td>{{$business_licence}}</td>
            <td>{{$amount}}</td>
            <td>{{$extra_amount}}</td>
        </tr>
    </tbody>
</table>
<hr/>
<table style="width:100%;max-width:100%;">
    <tr>
        <td style="width: 30%">
            Total Amount Paid
        </td>
        <td style="width: 70%;text-align:right;">
            {{$paid_amount}}
        </td>
    </tr>
</table>
<hr/>
<!-- optional -->
<htmlpagefooter id="idFooter" name="page-footer">
    <div style="text-align: center;width: 100%">
        {PAGENO}
    </div>
</htmlpagefooter>
</body>
</html>





