@extends('adminlte::page')
@section('content')
@if($message = session('uploaded'))
    <div class="alert alert-success alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <h4><i class="icon fa fa-info"></i> {{ $message }}!</h4>
    </div>
@endif
<div class="container-fluid" id="app">
    <table id="attendance-files-table" class="table table-condensed table-striped dataTable no-footer" style="width:100%">
        <thead class="bg-purple-gradient">
            <th>File Name</th>
            <th>Date Uploaded</th>
            <th># Rows</th>
            <th>Processed</th>
        </thead>
    </table>
</div>
@endsection
@push('css')
<meta name="csrf-token" content="{{@csrf_token()}}">
@endpush
@push('js')
<script src="{{ \asset('js/app.js') }}" type="text/javascript"></script>

<script type="text/javascript">
$(function() {
		const attendance_list = $('#attendance-files-table')
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