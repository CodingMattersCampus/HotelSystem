@extends('adminlte::page')
@section('content')
<div class="row" style="margin: 0;font-family: sans-serif;font-weight: 100;height:100%;width:100%">
    <div class="col-md-3">
        <div class="box box-primary">
            <div class="box-header">
                <div class="info-box">
                    <span class="info-box-icon bg-green"><i class="fa fa-linen-hunt"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text"></span>
                        <span class="info-box-number text-info">{{$linen->name}}</span>
                    </div>
                    <div class="info-box-more">
                        <h5>&nbsp;&nbsp;&nbsp;<small class="text-muted">{{$linen->slug}}</small></h5>
                    </div>
                    <!-- /.info-box-content -->
                </div>
            </div>
            <div class="box-body box-profile">
                <p class="text-center" style="font-style: italic;">Available stock: </p>
                <h3 class="text-muted text-center text-success text-bold">{{ $linen->availableStocks() }}</h3>
                <hr>
                <div class="row text-center">
                    <div class="col-md-6 col-sm-6">
                        <p class="box-title text-bold">Laundry</p>
                        <p> {{ $linen->laundry }} </p>
                    </div>
                    <div class="col-md-6 col-sm-6">
                        <p class="box-title text-bold">Rooms</p>
                        <p> {{ $linen->rooms }} </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-9">
        @if($message = session('editmessage'))
        <div class="alert alert-info alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <h4><i class="icon fa fa-info"></i> Alert!</h4>
            {{ $message }}
        </div>
        @endif
        <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
                <li class="active">
                    <a href="#Inventory" data-toggle="tab" aria-expanded="true">Inventory ({{$linen->stocks}})</a>
                </li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane active" id="Inventory">
                    <table id="linens-transaction-table" class="table table-responsive table-striped table-hover" style="width: 100%;">
                        <thead class="bg-purple-gradient">
                        <tr>
                            <th>#</th>
                            <th>Transaction</th>
                            <th>Date</th>
                            <th>Description</th>
                            <th>User</th>
                            <th>In</th>
                            <th>Out</th>
                            <th>Room</th>
                            <th>Inventory</th>
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
@endpush
@push('js')
<script src="{{ \asset('js/app.js') }}" type="text/javascript"></script>
<script type="text/javascript">
$(function() {
    var table = $('#linens-transaction-table').DataTable({
        "dom": 'Bfrtip',
        "buttons": ['pageLength', 'pdf', 'csv'],
        "lengthMenu": [[50, 250, 500, -1], [50, 250, 500, "All"]],
        "serverSide": true,
        "deferRender": true,
        "columns": [
            { 'data': 'id', searchable: true, orderable:true },
            { 'data': 'transaction', searchable: true, orderable:true },
            { 'data': 'created_at', searchable: true, orderable:true },
            { 'data': 'description', searchable: true, orderable:true },
            { 'data': 'user', searchable: true, orderable:true },
            { 'data': 'in', searchable: true, orderable:true },
            { 'data': 'out', searchable: true, orderable:true },
            { 'data': 'room', searchable: true, orderable:true },
            { 'data': 'inventory', searchable: true, orderable:true },
        ],
        "ajax": {
            "url": "{{\route('api.inventory.linens.transactions', compact('linen'))}}",
            "method": "POST",
            "data": {
                "api_token": "{{ $token }}",
            },
        }
    });
});
</script>
@endpush