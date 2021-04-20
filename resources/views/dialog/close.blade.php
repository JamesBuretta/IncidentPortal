<!-- Modal -->
<div class="modal hide fade" id="close" role="dialog" >
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">CONFIRMATION</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>

            </div>
            <div class="modal-body">
                <form action="{{ route('close') }}" method="post">
                    @csrf
                    @method('POST')

                    <div class="form-group">
                        <label for="name">Closing Comments*</label>
                        <textarea id="closing_comment" name="closing_comment"  rows="4" cols="50" class="form-control">

                        </textarea>
                    </div>

                    <input type="hidden" name="close_id" id="close_id">


                    <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>

                    <button type="submit" id="delete_user"  class="btn btn-success">Submit</button>
                </form>
            </div>
            <div class="modal-footer">

            </div>
        </div>

    </div>
</div>
