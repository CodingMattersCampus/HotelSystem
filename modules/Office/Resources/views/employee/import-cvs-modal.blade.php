<div class="col-lg-4 col-xs-6">
    <!-- small box -->
    <div class="small-box bg-green">
        <div class="inner" data-toggle="modal" data-target="#attendance-modal">
            <h3>Attendance</h3>
            <p>Upload CSV File</p>
        </div>
        <div class="icon">
            <i class="ion ion-android-time"></i>
        </div>
        <a href="{{ route('office.employee.attendance') }}" class="small-box-footer">See Time Records <i class="fa fa-arrow-circle-right"></i></a>
    </div>
</div>
<!-- Modal -->
<div id="attendance-modal" class="modal fade" role="dialog" >
    <div class="modal-dialog">
            <!-- Modal content-->
        <div class="modal-content" style="border-radius:10px;">
            <div class="modal-body" >
                <div class="card bg-gray-light" style="padding: 20px 30px">
                    <form method="POST" enctype="multipart/form-data" action="{{ route('office.employee.attendance.record') }}" >
                        @csrf
                        <div class="row">
                            <h4 class="text-center text-bold">Payroll Date</h4>
                            <div class="col-md-6 form-group {{ $errors->has('from') ? 'has-error' : '' }}">
                                <label for="#from">From <i class="text-danger">*</i> :
                                @if ($errors->has('from'))
                                    <span class="text-warning">{{ $errors->first('from') }}</span>
                                @endif
                                </label>
                                <input placeholder="From" class="form-control" type="text" id="from" data-provide="datepicker" name="from"  style=" border-radius:10px; border:1px solid rgb(217, 221, 227); padding:8px" required>
                            </div>
                            <div class="col-md-6 form-group {{ $errors->has('to') ? 'has-error' : '' }}">
                                <label for="#to">To <i class="text-danger">*</i> :
                                @if ($errors->has('to'))
                                    <span class="text-warning">{{ $errors->first('to') }}</span>
                                @endif
                                </label>
                                <input  placeholder="To" class="form-control" type="text" id="to" data-provide="datepicker" name="to"  style=" border-radius:10px; border:1px solid rgb(217, 221, 227); padding:8px" required>
                            </div>
                        </div>
                        <div class="form-group {{ $errors->has('attendance') ? 'has-error' : '' }}">
                            <label>Send CVS/Excel file</label>
                            <input type="file" name="attendance">
                            @if ($errors->has('attendance'))
                                <span class="text-warning">{{ $errors->first('attendance') }}</span>
                            @endif
                        </div>
                        <button class="btn btn-block btn-primary">Submit</button>
                    </form>             
                </div>
            </div>
        </div>
    </div>
</div>

@push('js')
<script type="text/javascript">
    $(function(){
        attendance_modal = $('#attendance-modal')
        const attendance_list = attendance_modal
            .find('#attendance-files-table')
            .dataTable({
                "dom": 'rtip',
                "buttons": ['pageLength', 'pdf', 'csv'],
                "lengthMenu": [[5, 25, 50, -1], [5, 25, 50, "All"]],
                "serverSide": true,
                "paginate": false,
                "deferRender": true,
                "columns": [
                    { "data": "name", searchable: true, orderable: true },
                    { "data": "created_at", searchable: true, orderable: false },
                    { "data": "rows", searchable: false, orderable: false },
                    { "data": "processed", orderable: false, searchable: true },
                ],
                "ajax": {
                    "url": "{{\route('api.office.employee.attendance.files')}}",
                    "method": "POST",
                    "data": {
                        "api_token": "{{ $token }}",
                    },
                }
            });
    });
</script>
@endpush