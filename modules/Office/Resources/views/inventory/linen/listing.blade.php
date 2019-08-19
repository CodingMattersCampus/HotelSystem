@extends('adminlte::page')
@section('content')
<div id="app" class="container-fluid">
    <div class="row" style="margin-bottom: 10px">
        {{-- @include('office::inventory.linen.laundry-modal') --}}
        {{-- @include('office::inventory.linen.restock-modal') --}}
    </div>
    <div class="row">
        <div class="card bg-gray-light">
            <div class="row-fluid">
                <div class="box box-primary collapsed-box">
                    <div class="box-header">
                        <h3 class="box-title">Linens Summary</h3>
                    </div>
                </div>
            </div>
            <div class="container-fluid">
                <table id="linens-table" class="table table-responsive table-striped table-hover">
                    <thead class="bg-purple-gradient">
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Rooms</th>
                        <th>Laundry</th>
                        <th>Store</th>
                        <th>Total</th>
                        <th>Date Updated</th>
                    </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
@section('css')
<meta name="csrf-token" content="{{@csrf_token()}}">
@endsection
@push('js')
<script type="text/javascript">
$(function() {
    var table = $('#linens-table').DataTable({
        "dom": 'Bfrtip',
        "buttons": ['pageLength', 'pdf', 'csv'],
        "lengthMenu": [[50, 250, 500, -1], [50, 250, 500, "All"]],
        "serverSide": true,
        "deferRender": true,
        "columns": [
            { "data": "id", searchable: true, orderable: true },
            { "data": "name", searchable: true, orderable: false },
            { "data": "rooms", searchable: false, orderable: false },
            { "data": "laundry", searchable: false, orderable: false },
            { "data": "store", searchable: false, orderable: false },
            { "data": "stocks", searchable: false, orderable: false },
            { "data": "updated_at", orderable: false, searchable: false },
        ],
        "ajax": {
            "url": "{{\route('api.inventory.linens')}}",
            "method": "POST",
            "data": {
                "api_token": "{{ $token }}",
            },
        }
    });
    //click rows
    $('#linens-table tbody').on('click', 'tr', function () {
        var data = table.row( this ).data();
        window.location.href = ""+ data['slug'] +"/details";
    });


});
</script>
@endpush