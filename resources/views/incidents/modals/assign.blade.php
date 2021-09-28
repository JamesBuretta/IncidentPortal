<!-- Modal -->
<div class="modal fade bd-example-modal-lg" id="edit-assigned-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <form method="post" action="{{ url('assign/incident')  }}">
        @csrf

        <div class="modal-dialog modal-md" role="document" >
            <div class="modal-content">
                <div class="modal-header modal-background">
                    <h5 class="modal-title" id="exampleModalLabel">Assign Technician</h5>
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


                                        <div class="col-md-12">

                                            <div class="form-group">

                                                    <label for="name">Select Technician*</label>
                                                    <select name="assigned_id" class="form-control" required>
                                                        <option value=""> -- Assign To -- </option>
                                                        @foreach($technicians as $technician)
                                                            <option value="{{$technician->id ?? ''}}">{{ucfirst($technician->fullname)}}</option>
                                                        @endforeach
                                                    </select>

                                            </div>

                                            <input type="hidden" name="id" value="" id="assigned-value-id">


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
