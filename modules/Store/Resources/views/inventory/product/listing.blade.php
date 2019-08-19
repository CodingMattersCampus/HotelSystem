@extends('adminlte::page')
@section('content')
<div id="app" class="container-fluid">
<!--     <div class="row">
        <div class="chart-container" style="border:1px solid white;margin-bottom:15px; background-color:white;padding:10px 0 10px 10px;">
            <canvas id="myChart" height="110px" ></canvas>    
        </div>
    </div> -->
    <div class="row" style="margin-bottom: 10px">
        @if($message = session('message'))
            <div class="alert alert-info alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            {{ $message }}
          </div>
        @endif
        <button data-toggle="modal" data-target="#inventory_request_modal" class="btn btn-primary">Inventory Request</button>
        @include('store::inventory.product.inventory-request-modal')

    </div>
    <div class="row" style="margin-bottom: 20px">
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
                            <th>SKU</th>
                            <th>Name</th>
                            <th>Brand</th>
                            <th>Stocks</th>
                            <th>Price</th>
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
<script src="{{ \asset('js/app.js') }}" type="text/javascript"></script>
<script type="text/javascript">
function getRandomColor() {
    var letters = '0123456789ABCDEF';
    var color = '#';
    for (var i = 0; i < 6; i++) {
    color += letters[Math.floor(Math.random() * 16)];
    }
    return color;
}
function Dataset(label, stack, dataTo){
    this.label = label;
    this.stack = stack;
    this.datato = dataTo;
    this.data = [0,0,0,0,0,0,0,0,0,0,0,0]; //preset data
    this.backgroundColor = getRandomColor();             
}

$(function() {
    var config = {
        type: 'bar',
        data: {
            labels: ["January", "February", "March", "April", "May", "June", "July","August","September","October","November","December"],
            datasets: [{
                label: 'Inventory Count',
                backgroundColor: getRandomColor(),
                data: [ 0,3,0,5,6,1,0,0,3,4,1,2 ],
                stack: '1'
            },{
                label: 'Inventory Remitted',
                backgroundColor: getRandomColor(),
                data: [ 3,1,4,0,0,0,0,1,3,2,5,1 ],
                stack: '2'
            }]
        },
        options: {
            scales:  {
                xAxes:[{
                    stacked: true
                }],
                yAxes: [{
                    stacked: true,
                    ticks: {
                        beginAtZero:true
                    }
                }]
            }
        }
    }
    var request_table = $('#request-table').DataTable({
        "dom": 'f',
    });
    var product_table = $('#products-table').DataTable({
        "dom": 'Bfrtip',
        "buttons": ['pageLength', 'pdf', 'csv'],
        "lengthMenu": [[50, 250, 500, -1], [50, 250, 500, "All"]],
        "serverSide": true,
        "deferRender": true,
        "columns": [
            { "data": "sku", searchable: true, orderable: false },
            { "data": "name", searchable: true, orderable: false },
            { "data": "brand", searchable: true, orderable: false },
            { "data": "stocks", searchable: false, orderable: false },
            { "data": "price", searchable: false, orderable: false },
            { "data": "updated_at", orderable: false, searchable: false },
        ],
        "ajax": {
            "url": "{{\route('api.inventory.products.store')}}",
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

    // var ctx = document.getElementById("myChart"); 
    // var myChart = new Chart(ctx, config);
});
</script>
@endpush