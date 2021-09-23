@extends('main_frame')
@section('top-details')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row">
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


    <div class="card mb-4 d-print-none" id="orderReport">
        <body class="fixed-nav sticky-footer bg-dark" id="page-top">
        <div class="container">
            <div class="row">

                <div class="card-body">
                    <div class="table-responsive">

                        <img src="{{ asset('images/lusan_logo2.png') }}" alt="" align="left">

{{--                        <h4 align="center"><u><b>Job Description: Technician</b></u></h4>--}}
{{--                        <h4 align="center"><u><b>Spare parts required: Pump</b></u></h4>--}}
{{--                        <h4 align="center"><u><b>Other Comments : Pump Need to be renewed</b></u></h4>--}}
                        <h1 align="center"><b><u>JOB ASSESSEMENT FORM</u></b></h1>

                        <table class="table table-bordered"  width="100%" cellspacing="0">
                            <table>
                                <tbody>
                                <tr>
                                    <td colspan="3" width="638">
                                        <p><strong>Job Description: </strong></p>
                                        <p><strong>&nbsp;</strong></p>
                                        <p><strong>Spare parts required:</strong></p>
                                        <p><strong>&nbsp;</strong></p>
                                        <p><strong>Other Comments</strong></p>
                                        <p><strong>&nbsp;</strong></p>
                                    </td>

                                </tr>
                                <tr>
                                    <td colspan="3" width="638">
                                        <p><strong>WORKING PROCEDURES AND JOB HAZARD ANALYSIS</strong></p>
                                        <p><strong>&nbsp;</strong></p>
                                        <p><strong>A.&nbsp;&nbsp;&nbsp; </strong><strong>MAINTENANCE </strong></p>
                                        <p><strong>&nbsp;</strong></p>
                                        <p><strong>1.&nbsp;&nbsp;&nbsp;&nbsp; </strong><strong>Barricading working area</strong></p>
                                        <p><strong>Hazard: Moving vehicle</strong></p>
                                        <p><strong>Top Event: Hit by car</strong></p>
                                        <p><strong>Threats: Property damage and Injuries</strong></p>
                                        <p><strong>Control: Use of corns and warning tapes </strong></p>
                                        <p><strong>2.&nbsp;&nbsp;&nbsp;&nbsp; </strong><strong>Switching off emergency stop and placing LOTTO tag out </strong></p>
                                        <p><strong>Hazard: Product fumes</strong></p>
                                        <p><strong>Top Event: Exposure to product fumes</strong></p>
                                        <p><strong>Threats: Inhalation</strong></p>
                                        <p><strong>Control: Use of PPE, Fire extinguisher nearby</strong></p>
                                        <p><strong>Control: Isolation at get valve, use of PPE, Fire extinguisher nearby</strong></p>
                                        <p><strong>3.&nbsp;&nbsp;&nbsp;&nbsp; </strong><strong>Perform task</strong></p>
                                        <p><strong>Hazard: Product fumes</strong></p>
                                        <p><strong>Top Event: Exposure to product fumes</strong></p>
                                        <p><strong>Threats: Inhalation, skin contamination, explosion </strong></p>
                                        <p><strong>Control: Use of PPE, Fire extinguisher nearby</strong></p>
                                        <p><strong>4. Switching on dispenser pump and Testing</strong></p>
                                        <p><strong>5. Handover </strong></p>
                                        <p><strong>&nbsp;</strong></p>
                                        <p><strong>Other </strong></p>
                                        <p><strong>&nbsp;</strong></p>
                                        <p><strong>B. PUMP INSTALLATION </strong></p>
                                        <p><strong>1.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </strong><strong>Site Mobilization and permit request</strong></p>
                                        <p><strong>2.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </strong><strong>Transfer of dispenser pump to pump island</strong></p>
                                        <p><strong>Hazard: Site Surface</strong></p>
                                        <p><strong>Top Event: Slip/Trips</strong></p>
                                        <p><strong>Threats: Property damage and Injuries</strong></p>
                                        <p><strong>Control: Training of proper handling, Housekeeping, use of PPE</strong></p>
                                        <p><strong>3.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </strong><strong>Connect inlet and outlet pipe</strong></p>
                                        <p><strong>Hazard: Working posture</strong></p>
                                        <p><strong>Top Event: Fatigue </strong></p>
                                        <p><strong>Threats: Back pain</strong></p>
                                        <p><strong>Control: Training of proper handling, Work breaks use of PPE</strong></p>
                                        <p><strong>4.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </strong><strong>Transfer of submersible pump to manhole</strong></p>
                                        <p><strong>Hazard: Site Surface</strong></p>
                                        <p><strong>Top Event: Slip/Trips</strong></p>
                                        <p><strong>Threats: Property damage and Injuries</strong></p>
                                        <p><strong>Control: Training of proper handling, Housekeeping, use of PPE</strong></p>
                                        <p><strong>5.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </strong><strong>Assemble and install electrical control board </strong></p>
                                        <p><strong>Hazard: Electrical wires</strong></p>
                                        <p><strong>Top Event: Electrocution</strong></p>
                                        <p><strong>Threats: Injuries, death </strong></p>
                                        <p><strong>Control: Electrical Isolation, testing electrical flow, LOTTO tags, use of PPE</strong></p>
                                        <p><strong>6.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </strong><strong>Connect dispenser pump to electrical control board </strong></p>
                                        <p><strong>Hazard: Electrical wires</strong></p>
                                        <p><strong>Top Event: Electrocution</strong></p>
                                        <p><strong>Threats: Injuries, death </strong></p>
                                        <p><strong>Control: Electrical Isolation, testing electrical flow, LOTTO tags, use of PPE </strong></p>
                                        <p><strong>7.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </strong><strong>Connect submersible pump to electrical control board</strong></p>
                                        <p><strong>Hazard: Electrical wires</strong></p>
                                        <p><strong>Top Event: Electrocution</strong></p>
                                        <p><strong>Threats: Injuries, death </strong></p>
                                        <p><strong>Control: Electrical Isolation, testing electrical flow, LOTTO tags, use of PPE </strong></p>
                                        <p><strong>8.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </strong><strong>Run dispenser pump and submersible pump test </strong></p>
                                        <p><strong>Hazard: Product fumes</strong></p>
                                        <p><strong>Top Event: Exposure to product fumes</strong></p>
                                        <p><strong>Threats: Inhalation, skin contamination, explosion </strong></p>
                                        <p><strong>Control: Use of PPE, Fire extinguisher nearby</strong></p>
                                        <p><strong>9.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </strong><strong>Dispenser pump calibration </strong></p>
                                        <p><strong>Hazard: Product fumes</strong></p>
                                        <p><strong>Top Event: Exposure to product fumes</strong></p>
                                        <p><strong>Threats: Inhalation, skin contamination, explosion </strong></p>
                                        <p><strong>Control: Use of PPE, Fire extinguisher nearby</strong></p>
                                        <p><strong>10.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </strong><strong>Site hand over </strong></p>
                                        <p><strong>11.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </strong><strong>Demobilization</strong></p>
                                        <p><strong>&nbsp;</strong></p>
                                        <p><strong>Other</strong></p>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="3" width="638">
                                        <p><strong>Work Force</strong></p>
                                        <p><em>(Insert names)</em></p>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="3" width="638">
                                        <p><strong>Team Leader</strong></p>
                                        <p><em>(Insert names)</em></p>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="3" width="638">
                                        <p><strong>Equipment and Tools </strong></p>
                                        <p><em>(Insert list of equipment)</em></p>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="3" width="638">
                                        <p><strong>Permit Certificates required</strong></p>
                                        <p><em>(Insert permit certificate required)</em></p>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="3" width="638">
                                        <p><strong>JOB CARD</strong></p>
                                    </td>
                                </tr>
                                <tr>
                                    <td width="215">
                                        <p><strong>Job card No.</strong></p>
                                    </td>
                                    <td width="166">
                                        <p><strong>Job Summary:</strong></p>
                                        <p><strong>&nbsp;</strong></p>
                                        <p><strong>&nbsp;</strong></p>
                                    </td>
                                    <td width="257">
                                        <p><strong>Total Time Taken:</strong></p>
                                    </td>
                                </tr>
                                <tr>
                                    <td width="215">
                                        <p><strong>Outstanding work:</strong></p>
                                        <p><strong>&nbsp;</strong></p>
                                        <p><strong>&nbsp;</strong></p>
                                        <p><strong>&nbsp;</strong></p>
                                        <p><strong>&nbsp;</strong></p>
                                    </td>
                                    <td width="166">
                                        <p><strong>Spare parts used:</strong></p>
                                        <p><strong>&nbsp;</strong></p>
                                    </td>
                                    <td width="257">
                                        <p><strong>Comments:</strong></p>
                                        <p><strong>&nbsp;</strong></p>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </table>


                    </div>
                </div>

            </div>
        </div>

        </body>

    </div>

    <div class="card mb-4 d-none" id="lpoOMS">
        @include('job_assessment.job_assess_print')
    </div>




    <script>
        //add an event listener on the print btn
        function printDiv(divName) {
            var printContents = document.getElementById(divName).innerHTML;
            var originalContents = document.body.innerHTML;
            document.body.innerHTML = printContents;
            window.print();
            document.body.innerHTML = originalContents;

        }

        function display()
        {
            $('#printInvoice').click(function(){
                Popup($('.invoice')[0].outerHTML);
                function Popup(data)
                {
                    window.print();
                    return true;
                }
            });
        }


        function myFunction() {
            document.getElementById("generateReport").click(); // Click on the checkbox
        }
    </script>

@endsection
