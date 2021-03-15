<!-- Modal -->
<div class="modal hide fade" id="approve" role="dialog" >
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Confirm</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>

            </div>
            <div class="modal-body">
                <p id="myText1"></p>
            </div>
            <div class="modal-footer">
                <form action="{{ url('pay/licence') }}" method="post" id="approveOrder">
                    @csrf
                    @method('POST')
                    <div class="form-group">
                        <label for="name">Enter Phone Number*</label>
                        <input type="phone" id="phone_number_id" name="phone_number"  class="form-control"/>
                        <input type="hidden" name="PRN" id="prn_id">

                    </div>
                    <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>

                    <button type="submit" id="delete_user"  class="btn btn-success">Submit</button>
                </form>
            </div>
        </div>

    </div>
</div>
