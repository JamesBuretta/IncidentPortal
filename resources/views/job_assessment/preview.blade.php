<!-- Modal -->
<div class="modal fade bd-example-modal-lg" id="job-assessement-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <form method="post" action="{{url('/')}}">

        {{csrf_field()}}
        <div class="modal-dialog modal-md" role="document" >
            <div class="modal-content">
                <div class="modal-header modal-background">
                    <h5 class="modal-title" id="exampleModalLabel">Job Assessement Details</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">

                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-body">

                                    <div class="row">
                                        <div class="table-responsive">
                                            <table id="example1"  class="table table-striped table-valign-middle">
                                                <thead>
                                                <tr>
                                                    <th>Label</th>
                                                    <th>Data</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td>INCIDENT</td>
                                                        <td>{{$job->incident_id ?? '-' }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td>TEAM LEADER</td>
                                                        <td>{{$job->team_leader ?? '-' }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td>EQUIPMENT LIST</td>
                                                        <td>{{$job->equipment_tools_list ?? '-' }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td>SPARE PARTS</td>
                                                        <td>{{$job->spare_parts_used ?? '-' }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td>RAISED BY</td>
                                                        <td>{{$job->users->fullname ?? '-' }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td>JOB SUMMARY</td>
                                                        <td>{{$job->job_summary ?? '-' }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td>TIME TAKEN</td>
                                                        <td>{{$job->total_time_taken ?? '-' }}</td>
                                                    </tr>


                                                </tbody>
                                            </table>
                                        </div>
                                    </div>

                                </div>
                            </div>

                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-danger">Cancel</button>
                    <button type="submit" class="btn btn-success">Approve</button>
                </div>
            </div>
        </div>
    </form>

</div>
