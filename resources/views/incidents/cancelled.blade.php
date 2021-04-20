<div class="col-md-12">
    <div class="table-responsive">
        <table id="example1"  class="table table-striped table-valign-middle">
            <thead>
            <tr>
                <th>Assigned To</th>
                <th>Caller Name</th>
                <th>Priority</th>
                <th>Impact</th>
                <th>Status</th>
                <th>Subject</th>
                <th>Opened Date</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
            @foreach($incidents as $details)
                <tr>
                    <td>{{$details->assigned->fullname ?? '--'}}</td>
                    <td>{{$details->callers->fullname ?? '--'}}</td>
                    <td>{{$details->priorities->name ?? '--'}}</td>
                    <td>{{$details->impacts->name ?? '--'}}</td>
                    <td>
                        @if($details->status->id == 1)
                            <span class="badge badge-secondary text-white text-capitalize">
                                    {{$details->status->name ?? '--'}}
                                    </span>
                        @endif

                        @if($details->status->id == 2)
                            <span class="badge badge-success text-white text-capitalize">
                                    {{$details->status->name ?? '--'}}
                                    </span>
                        @endif

                        @if($details->status->id == 3)
                            <span class="badge badge-danger text-white text-capitalize">
                                    {{$details->status->name ?? '--'}}
                                    </span>
                        @endif
                    </td>
                    <td>{{$details->subject ?? '--'}}</td>
                    <td>{{$details->created_datetime ?? '--'}}</td>
                    <td>
                        <div class="form-horizontal">
                            <a href="{{ url('view_incidents/'.$details->id) }}"   class="btn btn-primary">Update</a>
                            {{--                                    <a  href="#" onclick="handleClose('{{ url('close') }}','{{ $details->id }}')" class="btn btn-success" data-toggle="modal"   data-target="#close">Close</a>--}}
                            {{--                                    <a  href="#" onclick="handleCancel('{{ url('cancel') }}','{{ $details->id }}')" class="btn btn-danger" data-toggle="modal"   data-target="#cancel">Cancel</a>--}}
                        </div>
                    </td>
                </tr
            @endforeach
            </tbody>
        </table>
    </div>
</div>
@endif

@include('dialog.close')
@include('dialog.cancel')

</section>

