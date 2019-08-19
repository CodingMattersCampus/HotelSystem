@extends('adminlte::page')
@section('content')
<div id="app" class="container-fluid">
    <div class="row" style="margin-bottom: 10px">
        <button data-toggle="modal" data-target="#purchase_receive_modal" class="btn btn-primary">Purchase Receive</button>
        @include('office::inventory.product.purchase-receive-modal')
    </div>
    <div class="row" style="margin-bottom: 10px">
        <div class="card bg-gray-light">
            <div class="row-fluid">
                <div class="box box-primary collapsed-box">
                    <div class="box-header">
                        <h3 class="box-title">Products Summary</h3>
                    </div>
                </div>
            </div>
            <div class="container-fluid">
                <table id="products-table" class="table table-responsive table-striped table-hover" style="width: 100%;">
                    <thead class="bg-purple-gradient">
                        <tr>
                            <th>Name</th>
                            <th>Brand</th>
                            <th>SKU</th>
                            <th>Stocks</th>
                            <th>Cost</th>
                            <th>Inventory</th>
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
    const product_table = $('#products-table').DataTable({
        "dom": 'Bfrtip',
        "buttons": ['pageLength', 'pdf', 'csv'],
        "lengthMenu": [[50, 250, 500, -1], [50, 250, 500, "All"]],
        "serverSide": true,
        "deferRender": true,
        "columns": [
            { "data": "name", searchable: true, orderable: false },
            { "data": "brand", searchable: true, orderable: false },
            { "data": "sku", searchable: true, orderable: false },
            { "data": "stocks", searchable: false, orderable: true },
            { "data": "cost", searchable: false, orderable: true },
            { "data": "stored", searchable: true, orderable: false },
            { "data": "updated_at", orderable: false, searchable: false },
        ],
        "ajax": {
            "url": "{{\route('api.inventory.products')}}",
            "method": "POST",
            "data": {
                "api_token": "{{ $token }}",
            },
        }
    });
    //click rows
    $('#products-table tbody').on('click', 'tr', function () {
        var data = product_table.row( this ).data();
        window.location.href = ""+ data['sku'] +"/details";
    });
});
</script>
@endpush