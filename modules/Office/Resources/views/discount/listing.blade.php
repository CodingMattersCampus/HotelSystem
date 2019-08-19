@extends('adminlte::page')
@section('css')
<meta name="csrf-token" content="{{@csrf_token()}}">
@endsection

@section('content')
<div id='app'>
    <div class="nav-tabs-custom" style=" box-shadow: 0 0 15px  rgb(0,0,0,0.2); " >
        <ul class="nav nav-tabs">   
            <li class="active">
                <a href="#senior_citizen" data-toggle="tab" aria-expanded="true">Senior Citizens</a>
            </li>
        </ul>
        <div class="tab-content">
            <div class="tab-pane active" id="senior_citizen">
                <table id="sc-table" class="table table-condensed table-striped dataTable no-footer" style="width:100%">
                    <thead class="bg-purple-gradient">
                        <th>Id</th>
                        <th>Transaction</th>
                        <th>Name</th>
                        <th>Senior Citizen ID</th>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

@push('js')
<script type="text/javascript">
	$(function(){
		$('#sc-table').DataTable({
        "dom": 'Bfrtip',
        "buttons": ['pageLength', 'pdf', 'csv'],
        "lengthMenu": [[50, 100, 500, -1], [50, 100, 500, "All"]],
        "serverSide": true,
        "deferRender": true,
        "columns": [
            { "data": "id", searchable: false, orderable: false },
            { "data": "transaction", searchable: true, orderable: false },
            { "data": "full_name", searchable: false, orderable: false },
            { "data": "sc_id", orderable: false, searchable: true },
        ],
        data: [],
        "ajax": {
            "url": "{{ \route('api.discount.seniors.all') }}",
            "method": "POST",
            "data": {
                "api_token": "{{ $token }}",
            },
        }
    });
	});
</script>
@endpush