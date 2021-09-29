<!-- Modal -->
<!-- Modal -->
<div class="modal fade bd-example-modal-lg" id="edit-job-assessment-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <form method="post" action="{{ url('assign/incident')  }}">
        @csrf

        <div class="modal-dialog modal-md" role="document" >
            <div class="modal-content">
                <div class="modal-header modal-background">
                    <h5 class="modal-title" id="exampleModalLabel">Request Permit</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">

                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-body">

                                    <div class="row">

                                        <div class="row">

                                            <div class="form-group col-lg-6">

                                                <div class="form-group col-lg-6">
                                                    <label for="name">Job Desc*</label>
                                                    <input type="text" name="job_desc"  class="form-control">
                                                </div>

                                            </div>

                                            <div class="form-group col-lg-6">
                                                <label for="name">Spare Required*</label>
                                                <input type="text" name="spare_required"  class="form-control">
                                            </div>

                                        </div>


                                        <div class="row">
                                            <div class="form-group col-lg-6">
                                                <label for="name">Comments*</label>
                                                <input type="text" name="comments"  class="form-control">
                                            </div>

                                            <div class="form-group col-lg-6">
                                                <label for="name">Work Force*</label>
                                                <input type="text" name="work_force"  class="form-control">
                                            </div>
                                        </div>

                                        <div class="row">

                                            <div class="form-group col-lg-6">
                                                <label for="name">Team Leader*</label>
                                                <input type="text" name="team_leader"  class="form-control">
                                            </div>

                                            <div class="form-group col-lg-6">
                                                <label for="name">Equipment Tools List*</label>
                                                <input type="text" name="equipment_tools_list"  class="form-control">
                                            </div>
                                        </div>


                                        <div class="row">

                                            <div class="form-group col-lg-6">
                                                <label for="name">Permit Cert*</label>
                                                <input type="text" name="permit_cert"  class="form-control">
                                            </div>

                                            <div class="form-group col-lg-6">
                                                <label for="name">Job Summary*</label>
                                                <input type="textarea" name="job_summary"  class="form-control">
                                            </div>

                                        </div>


                                        <div class="row">

                                            <div class="form-group col-lg-6">
                                                <label for="name">Total Time Taken*</label>
                                                <input type="text" name="total_time_taken"  class="form-control">
                                            </div>

                                            <div class="form-group col-lg-6">
                                                <label for="name">Out Standing Work*</label>
                                                <input type="text" name="out_standing_work"  class="form-control">
                                            </div>

                                        </div>

                                        <div class="row">

                                            <div class="form-group col-lg-6">
                                                <label for="name">Spare Parts Used*</label>
                                                <input type="text" name="job_summary"  class="form-control">
                                            </div>

                                            <div class="form-group col-lg-6">
                                                <label for="name">Extra Comments*</label>
                                                <input type="text" name="extra_comments"  class="form-control">
                                            </div>

                                        </div>

                                    </div>

                                </div>
                            </div>

                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-success">Save</button>
                </div>
            </div>
        </div>
    </form>

</div>

{{--<div class="modal fade bd-example-modal-lg" id="edit-job-assessment-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">--}}
{{--    <form method="post" action="{{ url('assign/incident')  }}">--}}
{{--        @csrf--}}

{{--        <div class="modal-dialog modal-md" role="document" >--}}
{{--            <div class="modal-content">--}}
{{--                <div class="modal-header modal-background">--}}
{{--                    <h5 class="modal-title" id="exampleModalLabel">Job Assessment Form</h5>--}}
{{--                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">--}}
{{--                        <span aria-hidden="true">&times;</span>--}}
{{--                    </button>--}}
{{--                </div>--}}
{{--                <div class="modal-body">--}}

{{--                                    <div class="row">--}}


{{--                                        <div class="form-group">--}}
{{--                                            <label for="name">Job Desc*</label>--}}
{{--                                            <input type="text" name="job_desc"  class="form-control">--}}
{{--                                        </div>--}}
{{--                                    </div>--}}

{{--                                    <div class="row">--}}

{{--                                        <div class="form-group">--}}
{{--                                            <label for="name">Spare Required*</label>--}}
{{--                                            <input type="text" name="spare_required"  class="form-control">--}}
{{--                                        </div>--}}
{{--                                    </div>--}}

{{--                                    <div class="row">--}}
{{--                                        <div class="form-group">--}}
{{--                                            <label for="name">Comments*</label>--}}
{{--                                            <input type="text" name="comments"  class="form-control">--}}
{{--                                        </div>--}}
{{--                                    </div>--}}

{{--                                    <div class="row">--}}

{{--                                        <div class="form-group">--}}
{{--                                            <label for="name">Work Force*</label>--}}
{{--                                            <input type="text" name="work_force"  class="form-control">--}}
{{--                                        </div>--}}

{{--                                    </div>--}}

{{--                                    <div class="row">--}}
{{--                                        <div class="form-group">--}}
{{--                                            <label for="name">Team Leader*</label>--}}
{{--                                            <input type="text" name="team_leader"  class="form-control">--}}
{{--                                        </div>--}}
{{--                                    </div>--}}

{{--                                    <div class="row">--}}

{{--                                        <div class="form-group">--}}
{{--                                            <label for="name">Equipment Tools List*</label>--}}
{{--                                            <input type="text" name="equipment_tools_list"  class="form-control">--}}
{{--                                        </div>--}}

{{--                                    </div>--}}

{{--                                    <div class="row">--}}

{{--                                        <div class="form-group">--}}
{{--                                            <label for="name">Permit Cert*</label>--}}
{{--                                            <input type="text" name="permit_cert"  class="form-control">--}}
{{--                                        </div>--}}

{{--                                    </div>--}}

{{--                                    <div class="row">--}}

{{--                                        <div class="form-group">--}}
{{--                                            <label for="name">Job Summary*</label>--}}
{{--                                            <input type="textarea" name="job_summary"  class="form-control">--}}
{{--                                        </div>--}}

{{--                                    </div>--}}

{{--                                    <div class="row">--}}

{{--                                        <div class="form-group">--}}
{{--                                            <label for="name">Total Time Taken*</label>--}}
{{--                                            <input type="text" name="total_time_taken"  class="form-control">--}}
{{--                                        </div>--}}

{{--                                    </div>--}}

{{--                                    <div class="row">--}}

{{--                                        <div class="form-group">--}}
{{--                                            <label for="name">Out Standing Work*</label>--}}
{{--                                            <input type="text" name="out_standing_work"  class="form-control">--}}
{{--                                        </div>--}}

{{--                                    </div>--}}

{{--                                    <div class="row">--}}

{{--                                        <div class="form-group">--}}
{{--                                            <label for="name">Spare Parts Used*</label>--}}
{{--                                            <input type="text" name="job_summary"  class="form-control">--}}
{{--                                        </div>--}}

{{--                                    </div>--}}

{{--                                    <div class="row">--}}

{{--                                        <div class="form-group">--}}
{{--                                            <label for="name">Extra Comments*</label>--}}
{{--                                            <input type="text" name="extra_comments"  class="form-control">--}}
{{--                                        </div>--}}

{{--                                    </div>--}}

{{--                    <div class="modal-footer">--}}
{{--                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>--}}
{{--                        <button type="submit" class="btn btn-success">Save</button>--}}
{{--                    </div>--}}

{{--                    </div>--}}
{{--                </div>--}}


{{--            </div>--}}
{{--    </form>--}}

{{--</div>--}}
