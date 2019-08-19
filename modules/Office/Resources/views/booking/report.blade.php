@extends('adminlte::page')
@section('content')
<div class="container-fluid" id="app">
<div class="row">
        <div class="chart-container" style="border:1px solid white;margin-bottom:15px; background-color:white;padding:10px 0 10px 10px;">
            <canvas id="myChart" height="130px" ></canvas>    
        </div>
    </div>
   <div class="row">
   <div class="card bg-gray-light">
        <div class="row-fluid">
            <div class="box box-primary collapsed-box">
                <div class="box-header">
                    <h3 class="box-title">Bookings Summary</h3>
                </div>
            </div>
        </div>
        <div class="container-fluid">
            <table id="bookings-table" class="table table-responsive table-striped table-hover">
                <thead class="bg-purple-gradient">
                <tr>
                    <th>#</th>
                    <th>Transaction</th>
                    <th>CheckedIn By</th>
                    <th>Room</th>
                    <th>Checked In</th>
                    <th>Checked Out</th>
                    <th>CheckedOut By</th>
                    <th>Rate</th>
                    <th>Orders</th>
                    <th>Penalties</th>
                    <th>Transfers</th>
                    <th>Extensions</th>
                    <th>Referral</th>
                    <th>Net Sales</th>
                </tr>
                </thead>
            </table>
        </div>
    </div>
   </div>
    
</div>
@endsection
@push('css')
<meta name="csrf-token" content="{{@csrf_token()}}">
@endpush
@push('js')
<script type="text/javascript">
var config = {
    type: 'bar',
    data: {
        labels: ["January", "February", "March", "April", "May", "June", "July","August","September","October","November","December"],
        datasets: [
            {
                label:'Net Sales',
                key: 'sub_net_sales',
                data: [0,0,0,0,0,0,0,0,0,0,0,0],
                type: 'line',
                lineTension: 0,
                fill: false,
                borderColor:'#000000'
            },
            {
                label: 'Taxi Fee',
                key: 'taxi_fees',
                data: [0,0,0,0,0,0,0,0,0,0,0,0],
                backgroundColor: '#FC1616',
                borderColor:'#FC1616',
                borderWidth: 1
            },
            {
                label: 'Booking Rates',
                key: 'booking_rates',
                data: [0,0,0,0,0,0,0,0,0,0,0,0],
                backgroundColor: '#003afa',
                borderColor:'#003afa',
                borderWidth: 1
                
            },
            {
                label: 'Transfers',
                key: 'transfers',
                data: [0,0,0,0,0,0,0,0,0,0,0,0],
                backgroundColor: '#E8B838',
                borderColor: '#E8B838',
                borderWidth: 1
            },
            {
                label: 'Extensions',
                key: 'extends',
                data: [0,0,0,0,0,0,0,0,0,0,0,0],
                backgroundColor: '#FF99D4',
                borderColor: '#FF99D4',
                borderWidth: 1
            },
            {
                label: 'Orders',
                key: 'orders',
                data: [0,0,0,0,0,0,0,0,0,0,0,0],
                backgroundColor: '#559102',
                borderColor: '#559102',
                borderWidth: 1
            },
            {
                label: 'Penalties',
                key: 'penalties',
                data: [0,0,0,0,0,0,0,0,0,0,0,0],
                backgroundColor: '#63aa00',
                borderColor: '#63aa00',
                borderWidth: 1
            },
        ]
    },
    options: {
        responsive:true,
        scales:  {
            xAxes:[{
                stacked: true
            }],
            yAxes: [{
                stacked:true,
                ticks: {
                    beginAtZero:true
                }
            }]
        }
    }
}

$(function() {
var ctx = document.getElementById("myChart"); 
var myChart = new Chart(ctx, config);
var current = new Date;
var chartdata = {
    addNulltoNextMonths:function(start=1){
        for (var i = 0; i < config.data.datasets.length; i++) {
            for (var j = start; j < config.data.datasets[i].data.length; j++) {
                config.data.datasets[i].data[j].push(null);
            }
        }
    },
    getDataAjax:function(i = 0){
        $.ajax({
            url: "{{\route('api.store.bookings.chart')}}",
            method: 'POST',
            data: {
                "api_token": "{{ $token }}",
                "month": i, 
            },
            dataType: 'json',
            success(d){
                Object.keys(d.data).forEach(a=>{
                    index = config.data.datasets.findIndex(c=>c.key==a);
                    value = d.data[a];
                    if(a == 'taxi_fees'){
                        value = -value;
                    }
                    config.data.datasets[index].data[i-1] = value
                });
            },
            error(e){
                console.log('error', e);
            }
        }).done(function(){
            myChart.update()
        });
    },
    getAllData:function(){
        for (var i = 1; i <= 12; i++) {
            this.getDataAjax(i);
        }
    }
}
chartdata.getAllData();

});
</script>
<script type="text/javascript" async>
    const table = $('#bookings-table').DataTable({
        "dom": 'Bfrtip',
        "buttons": ['pageLength', 'pdf', 'csv'],
        "lengthMenu": [[50, 100, 500, -1], [50, 100, 500, "All"]],
        "serverSide": true,
        "deferRender": true,
        "columns": [
            { "data": "id", searchable: false, orderable: false },
            { "data": "booking_number", searchable: true, orderable: false },
            { "data": "checkin_by", orderable: false, searchable: true },
            { "data": "room", searchable: true, orderable: false },
            { "data": "checkin", searchable: true, orderable: false },
            { "data": "checkout", orderable: false, searchable: true },
            { "data": "checkout_by", orderable: false, searchable: true },
            { "data": "rate", orderable: false, searchable: true },
            { "data": "total_orders", orderable: false, searchable: true },
            { "data": "total_penalties", orderable: false, searchable: true },
            { "data": "transfers", orderable: false, searchable: true },
            { "data": "extends", orderable: false, searchable: true },
            { "data": "taxi", orderable: false, searchable: true },
            { "data": "net_sales", orderable: false, searchable: true },
        ],
        "ajax": {
            "url": "{{\route('api.store.bookings.all')}}",
            "method": "POST",
            "data": {
                "api_token": "{{ $token }}",
            },
        }
    });
    //click rows
    $('#bookings-table tbody').on('click', 'tr', function () {
        const data = table.row( this ).data();
        window.location.href = ""+ data['code'] +"/summary";
    });

    // fetch updates every 1 hour
    setInterval( function () {
        table.ajax.reload();
        chartdata.getDataAjax(current.getMonth());
    }, 360000 );
</script>
@endpush