@extends('adminlte::page')
@section('content')
<div class="container-fluid" id="app">
    <div class="row">
        <!-- ./col -->
        @include('office::employee.employee-modal')
        <!-- ./col -->
        @include('office::employee.import-cvs-modal')
        <!-- ./col -->
        <div class="col-lg-4 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-red">
                <div class="inner">
                    <h3>65</h3>

                    <p>Resigned/Terminated</p>
                </div>
                <div class="icon">
                    <i class="ion ion-pie-graph"></i>
                </div>
                <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <!-- ./col -->
    </div>
    <div class="row" style="padding-left:15px; padding-right:15px;">
      
        <div >
            <div class="card bg-gray-light">
                <div class="row-fluid">
                    <div class="box box-primary collapsed-box">
                        <div class="box-header">
                            <h3 class="box-title">Employee Summary</h3>
                        </div>
                    </div>
                </div>
                <div class="container-fluid">
                    <table id="employees-table" class="table table-responsive table-striped table-hover">
                        <thead class="bg-purple-gradient">
                        <tr>
                            <th>Last Name</th>
                            <th>First Name</th>
                            <th>Role</th>
                            <th>Username</th>
                        </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@push('css')
<meta name="csrf-token" content="{{@csrf_token()}}">
<link rel="stylesheet" type="text/css" href="{{ \asset('vendor/bootstrap-datepicker/css/bootstrap-datepicker.css') }}">
@endpush
@push('js')
<script src="{{ \asset('vendor/bootstrap-datepicker/js/bootstrap-datepicker.js') }}"></script>

<script type="text/javascript">
$(function() {
    $('#employee-form').validate();
    var table = $('#employees-table').DataTable({
        "dom": 'Bfrtip',
        "buttons": ['pageLength', 'pdf', 'csv'],
        "lengthMenu": [[5, 25, 50, -1], [5, 25, 50, "All"]],
        "serverSide": true,
        "deferRender": true,
        "columns": [
            { "data": "last_name", searchable: true, orderable: true },
            { "data": "first_name", searchable: true, orderable: false },
            { "data": "role", searchable: true, orderable: false },
            { "data": "username", orderable: false, searchable: true },
        ],
        "ajax": {
            "url": "{{\route('api.office.employees.all')}}",
            "method": "POST",
            "data": {
                "api_token": "{{ $token }}",
            },
        }
    });
    //click rows
    $('#employees-table tbody').on('click', 'tr', function () {
        var data = table.row( this ).data();
        window.location.href = ""+ data['code'] +"/profile";
    });
});
</script>
@endpush