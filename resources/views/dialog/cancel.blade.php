<!-- Modal -->
<div class="modal hide fade" id="cancel" role="dialog" >
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">CONFIRMATION</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>

            </div>
            <div class="modal-body">
                <form action="{{ route('cancel') }}" method="post">
                    @csrf
                    @method('POST')

                    <div class="form-group">
                        <label for="name">Cancellation Comments*</label>
                        <textarea id="cancel_comment" name="cancel_comment"  rows="4" cols="50" class="form-control">

                        </textarea>
                    </div>

                    <input type="hidden" name="cancel_id" id="cancel_id">


                    <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>

                    <button type="submit" id="delete_user"  class="btn btn-success">Submit</button>
                </form>
            </div>
            <div class="modal-footer">

            </div>
        </div>

    </div>
</div>
